<?php

namespace App\Listeners;

use App\Notifications\OrderRefundedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderRefundNotifierListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $event->order->user->notify(
                new OrderRefundedNotification($event->order)
            );
        } catch (\Exception $ex) {
            Log::debug('Failed to deliver email ' . json_encode($ex));
        }
    }
}
