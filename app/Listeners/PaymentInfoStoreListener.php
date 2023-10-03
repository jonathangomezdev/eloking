<?php

namespace App\Listeners;

use App\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentInfoStoreListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $order = $event->order;

        if (! $order->stripe_payment_intent_id) {
            return;
        }
        $payment = PaymentIntent::retrieve($order->stripe_payment_intent_id);

        if ($payment['status'] !== 'succeeded') {
            return;
        }

        $price = $order->calculatePrice();

        $order->total_EUR = $price['total_EUR'];
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
    }
}
