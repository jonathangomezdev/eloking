<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderGotPickedUpNotification extends Notification
{
    use Queueable;

    public $order;
    public $message;
    public $userInitial;
    public $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->message = "Your Order <b>#{$order->order_id}</b> got picked up by <b>" . auth()->user()->username . '</b>.';
        $this->userInitial = substr($this->order->booster()->username, 0, 1);
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
            'user' => [
                'initial' => $this->userInitial,
            ],
            'message' => $this->message,
            'action_url' => $this->actionUrl,
        ];
    }

    /**
     * @return BroadcastMessage
     */
    public function toBroadcast()
    {
        return (new BroadcastMessage([
            'message' => $this->message,
            'timeFromNow' => now()->diffForHumans(),
            'unreadCount' => auth()->user()->notifications()->whereNull('read_at')->count(),
            'user' => [
                'initial' => $this->userInitial,
            ],
            'action_url' => $this->actionUrl,
        ]));
    }
}
