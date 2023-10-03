<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use App\ChatRoomMember;
use App\ChatRoomMessage;
use Illuminate\Http\Request;
use App\Events\NewMessageEvent;
use App\Events\OrderCompletedEvent;
use Illuminate\Support\Facades\Cache;

class ChatRoomMessageController extends Controller
{
    public function store(Request $request, ChatRoom $chatRoom)
    {
        if (! (ChatRoomMember::where('user_id', auth()->id())->where('chat_room_id', $chatRoom->id)->exists() || auth()->user()->hasRole('admin'))) {
            abort(404);
        }

        $request->validate(['message' => 'required|min:1']);

        $message = ChatRoomMessage::create([
            'chat_room_id' => $chatRoom->id,
            'message' => $request->message,
            'user_id' => auth()->id(),
            'is_comment' => (bool)$request->asComment,
        ]);

        if ((bool)$request->markOrderCompleted && ($request->hasFile('attachments') || auth()->user()->hasRole('admin'))) {
            $chatRoom->order->update([
                'status' => \App\Order::STATUS_COMPLETED,
            ]);
            event(new OrderCompletedEvent($chatRoom->order));

            if ($request->hasFile('attachments')) {
                \File::ensureDirectoryExists(storage_path('/app/public/message-attachments'));
                $message->attachments()->create([
                    'location' => $request->file('attachments')->store('/public/message-attachments/'),
                    'name' => $request->file('attachments')->getClientOriginalName(),
                ]);
            }
        }

        Cache::put('user.' . auth()->id() . '.room.' . $chatRoom->id . '.online', true, now()->addMinutes(2)); // keep showing user is online to next 2 minutes

        if (! (bool)$request->asComment) {
            event(new NewMessageEvent($message));
        }

        return [
            'success' => true,
        ];
    }

    public function update(Request $request, ChatRoom $chatRoom, ChatRoomMessage $chatRoomMessage)
    {
        if ($chatRoomMessage->user_id != auth()->id()) {
            abort(404);
        }

        $chatRoomMessage->update([
            'message' => $request->message,
        ]);

        return [
            'success' => true,
        ];
    }
}
