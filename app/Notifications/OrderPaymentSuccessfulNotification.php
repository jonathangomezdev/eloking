<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaymentSuccessfulNotification extends Notification
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
        $gameName = $this->order->gametype == 'lol' ? 'Legue of legends' : $this->order->gametype;
        $this->message = "Successfully paid for Order <b>#{$this->order->order_id}</b> placed for <b>{$gameName}</b>";
        $this->actionUrl = \URL::to('/panel/orders');
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
