<?php

namespace App\Http\Controllers;

use App\Events\BoosterTipAddedEvent;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Stripe\Balance;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class BoosterTipController extends Controller
{
    public function paymentIntent(Request $request, Order $order)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => $request->amount * 100, // converting from dollar to cents
            'currency' => $order->currency,
            'payment_method_types' => ['card'],
        ]);

        return [
            'intent' => $intent,
            'amountFormatted' => currencyFormatted($request->amount, $order->currency, true),
        ];
    }

    public function paymentCompleted(Request $request, Order $order)
    {
        $request->validate([
            'paymentIntent' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = PaymentIntent::retrieve($request->paymentIntent);

        if ($payment['status'] === 'succeeded') {

            foreach ($payment->charges->data as $charge) {

                if (strtoupper($charge->currency) != 'EUR') {
                    $amountEUR = convertCurrency($charge->amount / 100, $charge->currency, 'EUR');
                } else {
                    $amountEUR = $charge->amount / 100;
                }

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
                    'type' => 'tip',
                    'amount_EUR' => $amountEUR,
                ];

                if ($charge->payment_method_details->type === 'card') {
                    $payload['card_last4'] = $charge->payment_method_details->card->last4;
                    $payload['card_exp'] = $charge->payment_method_details->card->exp_month  . '/' . $charge->payment_method_details->card->exp_year;
                    $payload['card_brand'] = $charge->payment_method_details->card->network;
                }

                Payment::create($payload);
            }

            event(new BoosterTipAddedEvent($order, $payment));
        }
    }
}
