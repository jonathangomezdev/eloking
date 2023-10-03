<?php

namespace App\Listeners;

use App\Notifications\OrderPaymentSuccessfulNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderPaymentSuccessfulNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->order->user->notify(
            new OrderPaymentSuccessfulNotification($event->order)
        );
    }
}
