<?php

namespace App\Listeners;

use App\ChatRoomMessage;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BotMessageForPickedUpOrderListener
{
    protected $message;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = 'Please do not play without the booster as it may increase the order size. If you wish to play while the booster is working on this order, please contact Live Chat. There we will guide you through options so you can enjoy the boost and play the game at the same time. 😊';
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (! $event->order->chatRoom->messages()->where('message', $this->message)->exists()) {
            ChatRoomMessage::create([
                'chat_room_id' => $event->order->chatRoom->id,
                'message' => $this->message,
                'user_id' => User::bot()->id,
            ]);
        }
    }
}
