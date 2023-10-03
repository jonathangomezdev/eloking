<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class FailedOrderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function fullPayIntent(Request $request)
    {
        $order = Order::byOrderId($request->order);

        abort_if(! ($order->user_id == auth()->id() || auth()->user()->hasRole('admin')), 404);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => $order->total * 100, // converting from dollar to cents
            'currency' => $order->currency,
            'payment_method_types' => ['card'],
            'description' => 'Order #' . $order->id,
        ]);

        return response()->json([
            'intent' => $intent,
        ]);
    }
}
