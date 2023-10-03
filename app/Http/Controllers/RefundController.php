<?php

namespace App\Http\Controllers;

use App\Events\OrderRefundedEvent;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Order;
use Illuminate\Http\Request;
use Stripe\Refund;
use Stripe\Stripe;

class RefundController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Stripe\Exception\ApiErrorException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $order = Order::byOrderId($request->order);
        abort_if(! auth()->user()->hasRole('admin') || !$order, 404);

        if ($order->status == Order::STATUS_REFUNDED) {
            session()->flash('success', 'Order already refunded.');
            return redirect()->back();
        }

        $refundRequest = [];

        if ($request->amount > $order->total_EUR) {
            session()->flash('error', 'Refund amount cannot be greater than ' . $order->total_EUR);
            return redirect()->back();
        }

        if (! $request->filled('fullRefund') && $request->amount) {
            $refundRequest['amount'] = $request->amount * 100;
        }

        $amount = $request->filled('fullRefund') ? $order->total : $request->amount;
        if ($order->payment_gateway === Order::PAYPAL_GATEWAY) {
            $amount = $order->total;
        }

        if ($request->filled('offlineRefund')) {
            $refunded = true;
        } elseif ($order->payment_gateway === Order::STRIPE_GATEWAY) {
            $refunded = $this->processStripeRefund($order, $refundRequest);
        } elseif ($order->payment_gateway === Order::PAYPAL_GATEWAY) {
            $refunded = $this->processPayPalRefund($order);
        }

        if ($refunded) {
            $refundEUR = convertCurrency($amount, $order->currency, 'EUR');
            $order->update([
                'status' => Order::STATUS_REFUNDED,
                'total_refunded_EUR' => $refundEUR
            ]);
            event(new OrderRefundedEvent($order));
        }

        session()->flash('success', 'Order has been refunded.');
        return redirect()->back();
    }

    /**
     * @param $order
     * @param $refundRequest
     * @return bool
     * @throws \Stripe\Exception\ApiErrorException
     */
    protected function processStripeRefund($order, $refundRequest)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $refund = Refund::create(array_merge(['payment_intent' => $order->payment_id], $refundRequest));
        return $refund->status === 'succeeded';
    }

    /**
     * @param $order
     * @param $refundRequest
     * @return bool|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    protected function processPayPalRefund($order)
    {
        $provider = new PayPalClient;

        $provider->getAccessToken();
        $note = 'Order #' . $order->order_id;
        $provider->setCurrency($order->currency);
        $refund = $provider->refundCapturedPayment($order->payment_id, $order->order_id, $order->total, $note);

        if (isset($refund['type']) && $refund['type'] === 'error') {
            session()->flash('error', 'Something went wrong. Please try again later.');
            \Log::debug(json_encode($refund));
            return redirect()->back();
        }

        return $refund['status'] === 'COMPLETED';
    }
}
