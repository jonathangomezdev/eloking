<?php

namespace App\Notifications;

use App\ChatRoomMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChatMessageNotification extends Notification
{
    use Queueable;

    public $chatRoomMessage;
    public $message;
    public $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ChatRoomMessage $chatRoomMessage)
    {
        $this->chatRoomMessage = $chatRoomMessage;
        $this->message = "<b>{$chatRoomMessage->sender->username}</b> sent you a message";
        $this->actionUrl = \URL::to('/panel/orders/' . $chatRoomMessage->chatRoom->order->order_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function toDatabase($notifiable)
    {
        return [
            'user' => [
                'initial' => substr($this->chatRoomMessage->sender->name, 0, 1),
            ],
            'message' => $this->message,
            'chat_room_id' => $this->chatRoomMessage->chat_room_id,
            'action_url' => $this->actionUrl,
        ];
    }

    /**
     * @param $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return (new BroadcastMessage([
            'message' => $this->message,
            'timeFromNow' => now()->diffForHumans(),
            'unreadCount' => $notifiable->notifications()->whereNull('read_at')->count(),
            'user' => [
                'initial' => substr($this->chatRoomMessage->sender->name, 0, 1),
            ],
            'action_url' => $this->actionUrl,
        ]));
    }
}
