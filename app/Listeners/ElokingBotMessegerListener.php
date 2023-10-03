<?php

namespace App\Listeners;

use App\ChatRoomMessage;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ElokingBotMessegerListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ChatRoomMessage::create([
            'chat_room_id'  => $event->order->chatRoom->id,
            'message' => $event->botMessage,
            'user_id' => User::bot()->id,
            'is_comment' => false,
        ]);
    }
}
