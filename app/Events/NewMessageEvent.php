<?php

namespace App\Events;

use App\ChatRoomMessage;
use App\Order;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatRoomMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order.room.' . $this->message->chat_room_id);
    }

    public function broadcastWith()
    {
        $username = User::find($this->message->user_id)->username;

        return [
            'message' => $this->message->message,
            'sender_initial'  => substr($username, 0, 1),
            'sender_username'  => $username,
            'sender_id' => $this->message->user_id,
            'created_at' => $this->message->created_at->diffForHumans(),
        ];
    }
}
