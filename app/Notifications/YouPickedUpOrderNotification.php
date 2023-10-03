<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YouPickedUpOrderNotification extends Notification
{
    use Queueable;

    public $order;
    public $userInitial;
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
        $this->userInitial = substr(auth()->user()->name, 0, 1);
        $this->message = "You picked up order <b>#{$this->order->order_id}</b>";
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
