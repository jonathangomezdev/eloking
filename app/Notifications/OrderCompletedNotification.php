<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompletedNotification extends Notification
{
    use Queueable;

    public $order;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->message = "Order <b>#{$this->order->order_id}</b> placed successfully for <b>{$this->order->gametype}</b>";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function toDatabase($notifiable)
    {
        return [
            'gametype' => $this->order->gametype,
            'message' => $this->message,
        ];
    }

    /**
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return (new BroadcastMessage([
            'gametype' => $this->order->gametype,
            'message' => $this->message,
            'timeFromNow' => now()->diffForHumans(),
            'unreadCount' => $notifiable->notifications()->whereNull('read_at')->count(),
        ]));
    }
}
