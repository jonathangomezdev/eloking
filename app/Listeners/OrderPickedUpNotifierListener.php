<?php

namespace App\Listeners;

use App\ChatRoomMessage;
use App\Notifications\OrderGotPickedUpNotification;
use App\Notifications\YouPickedUpOrderNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderPickedUpNotifierListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        try {
            $order->user->notify(new OrderGotPickedUpNotification($order));
            $order->booster()->notify(new YouPickedUpOrderNotification($order));
        } catch(\Exception $ex) {
            Log::debug('Failed to deliver email ' . json_encode($ex));
        }

        ChatRoomMessage::create([
            'chat_room_id'  => $event->order->chatRoom->id,
            'message' => 'Your order was picked up by ' . $order->booster()->username . ' 🎮',
            'user_id' => User::bot()->id,
            'is_comment' => false,
        ]);
    }
}
