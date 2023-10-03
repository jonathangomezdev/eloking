<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public $order;
    public $message;
    public $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $gametype = strtolower($order->gametype);
        if ($gametype === 'csgo') {
            $gametype = 'CS:GO';
        } else if ($gametype === 'lol') {
            $gametype = 'League of Legends';
        } else {
            $gametype = ucfirst($gametype);
        }

        $this->message = "New order <b>#{$order->order_id}</b> for <b>{$gametype}</b>";
        $this->actionUrl = \URL::to('/panel/orders/' . $order->order_id);
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
            'gametype' => $this->order->gametype,
            'message' => $this->message,
            'timeFromNow' => now()->diffForHumans(),
            'unreadCount' => $notifiable->notifications()->whereNull('read_at')->count(),
            'action_url' => $this->actionUrl,
        ]));
    }
}
