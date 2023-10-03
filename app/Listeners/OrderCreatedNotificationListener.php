<?php

namespace App\Listeners;

use App\Notifications\NewOrderAvailableForPickupNotification;
use App\Notifications\OrderCreatedNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderCreatedNotificationListener
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
            $this->sendNotifications($event);
        } catch (\Exception $ex) {
            Log::debug('Failed to deliver email ' . json_encode($ex));
        }
    }

    private function sendNotifications($event)
    {
        $event->order->user->notify(
            new OrderCreatedNotification($event->order)
        );

        Notification::send(
            User::whereActive(true)->whereIn('id', function($q) use ($event) {
                return $q->select('user_id')->from('booster_game_restrictions')->where('game', $event->order->gametype);
            })->role('booster')->get(),
            new NewOrderAvailableForPickupNotification($event->order)
        );
    }
}
