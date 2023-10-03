<?php

namespace App\Listeners;

use App\User;
use App\ChatRoomMessage;
use App\OrderComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrderCommentListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $bot = User::bot();

        if (! $event->order->chatRoom || ! $event->botMessage) {
            return;
        }

        ChatRoomMessage::create([
            'message'       => $event->botMessage,
            'chat_room_id'  => $event->order->chatRoom->id,
            'is_comment'    => $event->botMessageAsComment ?? false,
            'user_id'       => $bot->id,
        ]);
    }
}
