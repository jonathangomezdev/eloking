<?php

namespace App\Listeners;

use App\ChatRoomMember;
use App\ChatRoomMessage;
use App\Notifications\NewChatMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Pusher\Pusher;

class NewMessageNotifierListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $chatRoomMessage = $event->message;
        $sender = $chatRoomMessage->sender;

        $chatRoomMembers = ChatRoomMember::whereChatRoomId($chatRoomMessage->chat_room_id)->where('user_id', '<>', $sender->id)->get();

        $notifiableMembers = $chatRoomMembers->filter(function($member) use ($sender) {
            return $sender->id != $member->user_id;
        });

        $notifiableMembers->each(function($member) use ($chatRoomMessage) {
            if (
                !Cache::get('user.' . $member->user_id . '.room.' . $chatRoomMessage->chat_room_id . '.online') &&
                $this->lastNotifiedMoreThanAnHourAgo($chatRoomMessage, $member)
            ) {
                $member->user->notify(new NewChatMessageNotification($chatRoomMessage));
            }
        });
    }

    /**
     * @param ChatRoomMessage $chatRoomMessage
     * @param ChatRoomMember $chatRoomMember
     * @return bool
     */
    public function lastNotifiedMoreThanAnHourAgo(ChatRoomMessage $chatRoomMessage, ChatRoomMember $chatRoomMember)
    {
        return !$chatRoomMember
                ->user
                ->notifications()
                ->where('type', NewChatMessageNotification::class)
                ->whereBetween('created_at', [now()->subHour(), now()])
                ->where('data->chat_room_id', $chatRoomMessage->chat_room_id)
                ->exists();
    }
}
