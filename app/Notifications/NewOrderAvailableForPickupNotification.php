<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderAvailableForPickupNotification extends Notification
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
        $this->message = "New order is available for pick up";
        $this->actionUrl = \URL::to('/panel/jobs');
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
