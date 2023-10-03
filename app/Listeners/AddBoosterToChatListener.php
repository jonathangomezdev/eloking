<?php

namespace App\Listeners;

use App\ChatRoomMember;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddBoosterToChatListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        ChatRoomMember::create([
            'user_id' => $event->order->booster()->id,
            'chat_room_id' => $event->order->chatRoom->id,
        ]);
    }
}
