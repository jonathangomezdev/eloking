<?php

namespace App\Http\Controllers;

use App\Events\InvoiceGeneratedEvent;
use App\Events\InvoiceRegenerateEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderCreatedEvent;
use App\Events\OrderMadeExtraPaymentEvent;
use App\Events\OrderPaymentCompletedEvent;
use App\Events\OrderPaymentFailedEvent;
use App\Champion;
use App\Events\OrderStartedEvent;
use App\Events\OrderStatusChangedEvent;
use App\Events\OrderUpdatedEvent;
use App\Notifications\TrustpilotReviewRequestNotification;
use App\Order;
use App\OrderChampion;
use App\ChatRoomMessage;
use App\Payment;
use \App\Rank;
use App\User;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $payload = [];

        if (auth()->user()->hasRole('admin')) {
            $orders = Order::incomplete()->filter($request->all());
            $payload['orders'] = $orders->latest()->paginate(10, ['*'], 'orders_page');
            $payload['completedOrders'] = Order::completed()->latest()->paginate(10, ['*'], 'orders_completed_page');
            $payload['users'] = User::select('id', 'name')->where('name', '!=', 'Eloking BOT')->get();
        } else {
            $payload['orders'] = Order::whereUserId(auth()->id())->incomplete()->latest()->paginate(10, ['*'], 'orders_page');
            $payload['completedOrders'] = Order::whereUserId(auth()->id())->completed()->latest()->paginate(10, ['*'], 'orders_completed_page');
        }

        return view('panel.orders.grid', $payload);
    }

    public function create(Request $request)
    {
        return view('panel.orders.create', [
            'gameType' => $request->gameType,
            'ranks' =>  Rank::list($request->gameType),
        ]);
    }

    public function show(Request $request)
    {
        $order = Order::whereOrderId($request->order)->first();
        abort_if(! $order, 404);
        if (! (
            $order->user_id === auth()->id() ||  // is the user who created order?
            auth()->user()->hasRole('admin') || // is the user admin?
            ($order->booster() && auth()->id() == $order->booster()->id) // is this the booster assigned to this order?
        )) {
            abort(404);
        }

        return view('panel.orders.show', [
            'order' => $order,
            'lolChamps' => Champion::where('gametype', 'lol')->get(),
            'valorantChamps' => Champion::where('gametype', 'valorant')->get(),
            'champions' => Champion::whereIn('id', function($query) use ($order) {
                    return $query
                        ->select('champion_id')
                        ->from('order_champions')
                        ->where('order_id', $order->id);
                })->get(),
            'ranks' => Rank::wherePlatform($order->platform)->whereType($order->type)->whereGametype($order->gametype)->orderBy('sequence')->get(),
        ]);
    }

    /**
     * It will create order
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function store(Request $request)
    {
        if (!$request->gametype || !$request->platform || !$request->type || is_null($request->currentRank) || !$request->desiredRank || !$request->customer_id) {
            throw new \Exception('Invalid input provided.');
        }

        $rank = new Rank();
        $data = $rank->calculate($request->gametype, $request->platform, $request->type, intval($request->currentRank),
            intval($request->desiredRank), $request->input('options'), $request->currentLp, $request->currentLPMaster, $request->desiredLPMaster);

        $order = Order::create([
            'total_EUR' => $data['total_EUR'],
            'total'     => $data['total'],
            'currency'  => $data['currency'],
            'type'      => $request->type,
            'payload'   => $request->all(),
            'user_id'   => $request->customer_id,
            'status'    => Order::STATUS_PAYMENT_PENDING,
            'gametype'  => $request->gametype,
            'booster_earning_EUR' => ($data['total_EUR'] / 100) * config('prices.booster.default_cut_percent'),
            'platform'  => $request->platform,
            'region'    => $request->region,
            'order_total_EUR' => $data['total_EUR'],
        ]);

        event(new OrderCreatedEvent($order));

        return $order;
    }

    /**
     * It will mark order successful
     * @param Request $request
     * @return mixed
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function orderSuccess(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'payment_id' => 'required'
        ]);

        $order = Order::byOrderId($request->order_id);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = PaymentIntent::retrieve($request->payment_id);
        if ($payment['status'] === 'succeeded') {
            $order->update([
                'status' => Order::STATUS_READY_FOR_PICKUP,
                'payment_id' => $request->payment_id,
                'payment_gateway' => Order::STRIPE_GATEWAY,
            ]);
            event(new OrderPaymentCompletedEvent($order));
        } else {
            $order->update(['status' => Order::STATUS_PAYMENT_FAILED]);
            event(new OrderPaymentFailedEvent($order));
        }

        PaymentIntent::update($request->payment_id, [
            'metadata' => [
                'order_id' => $order->order_id,
                'customer_email' => $order->user->email,
                'customer_id' => $order->user->id,
            ],
            'description' => 'Customer ' . $order->user->name . ' (Customer ID ' . $order->user->id . ') Eloking Order ID #' . $order->order_id
        ]);

        return $order->fresh()->load('user');
    }

    public function edit(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $order = Order::whereOrderId($request->order)->first();

        $type = $order->type === 'placement' ? 'win' : $order->type;

        return view('panel.admin.order.edit', [
            'order' => $order,
            'ranks' => Rank::wherePlatform($order->platform)->whereType($type)->whereGametype($order->gametype)->orderBy('sequence')->get(),
        ]);
    }

    public function update(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $order = Order::whereOrderId($request->order)->first();

        $payload = $request->validate([
            'gametype' => 'required',
            'type' => 'required',
            'status' => 'required',
            'platform' => 'required',
            'booster_earning_EUR' => 'required',
            'total' => 'required',
            'currency' => 'required',
            'total_EUR' => 'required',
            'order_total_EUR' => 'required',
        ]);
        $payload['payload'] = $order->payload;
        $payload['payload']['options'] = $request->addons;

        $payload['payload']['desiredRank'] = $request->desiredRank;
        $payload['payload']['currentRank'] = $request->currentRank;

        $previousOrderStats = $order->status;

        $order->update($payload);

        event(new OrderUpdatedEvent($order));

        if ($previousOrderStats != $request->status) {
            event(new OrderStatusChangedEvent($order, $previousOrderStats));
        }

        /**
         * When the admin marks an order completed through edit page. It doesn't do things which is supposed be done
         * after an order is completed. So, here checking if the order is marked completed now. If yes, trigger event
         * which will do all required work for order when it's completed.
         */
        if ($request->status === Order::STATUS_COMPLETED && $previousOrderStats != Order::STATUS_COMPLETED) {
            event(new OrderCompletedEvent($order));
        }

        if ($previousOrderStats === Order::STATUS_COMPLETED) {
            event(new InvoiceRegenerateEvent($order));
        }

        session()->flash('success', 'Order has been updated');
        return redirect()->back();
    }

    public function extraPaymentIntent(Request $request, Order $order)
    {
        $data = $order->calculatePrice();
        $amount = convertToCurrency($order->order_total_EUR - $order->total_EUR, $order->currency);

        if ($amount <= 0) {
            return response([
                'success' => false,
                'message' => 'Your order doesnt seems to require extra payment. Please contact admin.',
            ], 422);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => $amount * 100, // converting from dollar to cents
            'currency' => $order->currency,
            'payment_method_types' => ['card'],
            'description' => 'Order #' . $order->id,
        ]);

        return [
            'intent' => $intent,
            'totalformatted' => currencyFormatted($amount, $order->currency, true),
        ];
    }

    public function extraPaymentCompleted(Request $request, Order $order)
    {
        $request->validate([
            'paymentIntent' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = PaymentIntent::retrieve($request->paymentIntent);

        if ($payment['status'] === 'succeeded') {
            $price = $order->calculatePrice();

            $order->total = currency($order->total + ($payment->amount / 100));
            $order->total_EUR = $order->order_total_EUR;
            $order->save();

            foreach ($payment->charges->data as $charge) {
                $payload = [
                    'amount' => $charge->amount / 100,
                    'currency' => $charge->currency,
                    'payment_intent_id' => $charge->payment_intent,
                    'charge_id' => $charge->id,
                    'captured' => $charge->captured,
                    'paid' => $charge->paid,
                    'status' => $charge->status,
                    'payment_method' => $charge->payment_method_details->type,
                    'refunded' => $charge->refunded,
                    'receipt_url' => $charge->receipt_url,
                    'order_id' => $order->id,
                    'amount_EUR' => $order->total_EUR,
                ];

                if ($charge->payment_method_details->type === 'card') {
                    $payload['card_last4'] = $charge->payment_method_details->card->last4;
                    $payload['card_exp'] = $charge->payment_method_details->card->exp_month  . '/' . $charge->payment_method_details->card->exp_year;
                    $payload['card_brand'] = $charge->payment_method_details->card->network;
                }

                Payment::create($payload);
            }

            event(new OrderMadeExtraPaymentEvent($order, currencyFormatted($payment->amount / 100, $order->currency, true)));

            return [
                'success' => true,
            ];
        }

        return [
            'success' => false,
        ];
    }

    /**
     * It will allow assigned booster or admin to start an order
     * @param Request $request
     * @return bool[]|mixed
     */
    public function startOrder(Request $request)
    {
        $order = Order::byOrderId($request->order);

        abort_if(! ($order->isThisAssignedBooster(auth()->id()) || auth()->user()->hasRole('admin')), 404) ;

        if ($order->status !== Order::STATUS_READY) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot start an order which is not in ready state.'
            ], 422);
        }

        $order->update([
            'status' => Order::STATUS_IN_PROGRESS,
        ]);

        event(new OrderStartedEvent($order));

        return [
            'success' => true,
        ];
    }
}
