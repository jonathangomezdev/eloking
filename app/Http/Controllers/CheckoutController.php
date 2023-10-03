<?php

namespace App\Http\Controllers;

use App\Events\OrderPaymentCompletedEvent;
use App\Events\OrderPaymentFailedEvent;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Rank;
use App\Service\PayPalService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function intent(Request $request)
    {
        if (!$request->gametype || !$request->platform || !$request->type || is_null($request->currentRank) ||
            !$request->desiredRank) {
        	throw new \Exception('Invalid inputs provided.');
        }

        $rank = new Rank();
        $data = $rank->calculate($request->gametype, $request->platform, $request->type, intval($request->currentRank),
            intval($request->desiredRank), $request->input('options'), $request->currentLp, $request->currentLPMaster, $request->desiredLPMaster);


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = \Stripe\PaymentIntent::create([
        	'amount' => $data['total'] * 100, // converting from dollar to cents
        	'currency' => session('user.currency'),
        	'payment_method_types' => ['card'],
        ]);
        return response()->json([
            'intent' => $intent,
        ]);
    }

    public function intentForPaypal(Request $request)
    {
        if (!$request->gametype || !$request->platform || !$request->type || is_null($request->currentRank) ||
            !$request->desiredRank) {
            throw new \Exception('Invalid inputs provided.');
        }

        $rank = new Rank();
        $data = $rank->calculate($request->gametype, $request->platform, $request->type, intval($request->currentRank),
            intval($request->desiredRank), $request->input('options'), $request->currentLp, $request->currentLPMaster, $request->desiredLPMaster);

        $data['region'] = $request->region;

        session()->put('ELOKING_ORDER_PRICE', json_encode($data));
        session()->put('ELOKING_ORDER', json_encode($request->all()));

        $provider = new PayPalClient;

        $provider->getAccessToken();

        $payload = [
            'intent' => "CAPTURE",
            'purchase_units' => [
                [
                    "amount" => [
                        "currency_code" => session('user.currency'),
                        "value" => $data['total'],
                    ]
                ]
            ],
            'return_url' => $request->return_url,
        ];

        $paypalOrder = $provider->createOrder($payload);

        session()->put('PAYPAL_ORDER_ID', $paypalOrder['id']);

        return $paypalOrder;
    }

    public function paypalIntentVerification(Request $request)
    {
        $provider = new PayPalClient;

        $provider->getAccessToken();

        $res = $provider->showOrderDetails(session('PAYPAL_ORDER_ID'));
        $capture = $provider->capturePaymentOrder(session('PAYPAL_ORDER_ID'));

        Log::debug($res);
        Log::debug($capture);

        if (!isset($res['status']) || $res['status'] !== 'APPROVED') {
            session()->forget('PAYPAL_ORDER_ID');
            session()->forget('ELOKING_ORDER');
            session()->forget('ELOKING_ORDER_PRICE');
            return [
                'success' => false,
                'message' => 'Failed to capture the payment.'
            ];
        }

        $captureId = $capture['purchase_units'][0]['payments']['captures'][0]['id'];

        $elokingOrder = json_decode(session()->get('ELOKING_ORDER'));
        $price = json_decode(session()->get('ELOKING_ORDER_PRICE'), true);

        if (! auth()->check()) {
            if (User::whereEmail($res['payer']['email_address'])->exists()) {
                $user = User::whereEmail($res['payer']['email_address'])->first();
            } else {
                $user = User::create([
                    'email' => $res['payer']['email_address'],
                    'username' => User::generateUsername($res['payer']['email_address']),
                    'name' => $res['payer']['name']['given_name'] . ' ' . $res['payer']['name']['surname'],
                    'country' => $res['payer']['address']['country_code'],
                    'password' => Hash::make(uniqid(true)),
                    'status' => false,
                ]);
            }
        } else {
            $user = auth()->user();
        }

        $order = Order::create([
            'total_EUR' => $price['total_EUR'],
            'total'     => $price['total'],
            'currency'  => $price['currency'],
            'type'      => $elokingOrder->type,
            'payload'   => $elokingOrder,
            'user_id'   => $user->id,
            'status' => Order::STATUS_READY_FOR_PICKUP,
            'gametype'  => $elokingOrder->gametype,
            'booster_earning_EUR' => ($price['total_EUR'] / 100) * config('prices.booster.default_cut_percent'),
            'platform'  => $elokingOrder->platform,
            'region'    => $price['region'],
            'order_total_EUR' => $price['total_EUR'],
            'payment_id' => $captureId,
            'payment_gateway' => Order::PAYPAL_GATEWAY,
        ]);

        event(new OrderPaymentCompletedEvent($order));

        session()->forget('PAYPAL_ORDER_ID');
        session()->forget('ELOKING_ORDER');
        session()->forget('ELOKING_ORDER_PRICE');

        return [
            'success' => $res['status'] === "APPROVED",
            'customer' => $user,
            'order' => $order
        ];
    }
}
