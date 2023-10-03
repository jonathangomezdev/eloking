<?php

namespace App\Listeners;

use App\ChatRoom;
use App\ChatRoomMember;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class CreateChatRoomForOrderListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $room = ChatRoom::create([
            'order_id' => $event->order->id,
            'active' => true,
        ]);

        $bot = User::bot();
        $this->addMemberToRoom($room, [$event->order->user_id, $bot->id]);
    }

    private function addMemberToRoom($room, $userIds)
    {
        foreach($userIds as $userId) {
            ChatRoomMember::create([
                'chat_room_id' => $room->id,
                'user_id' => $userId,
            ]);
        }
    }
}
