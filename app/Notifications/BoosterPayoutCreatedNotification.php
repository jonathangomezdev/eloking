<?php

namespace App\Notifications;

use App\BoosterPayout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BoosterPayoutCreatedNotification extends Notification
{
    use Queueable;

    public $boosterPayout;
    public $message;
    public $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BoosterPayout $boosterPayout)
    {
        $this->boosterPayout = $boosterPayout;
        $this->message = "Payout created for you.";
        $this->actionUrl = \URL::to('/panel/booster/payouts');
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
                'initial' => substr($this->boosterPayout->booster->name, 0, 1),
            ],
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
            'message' => $this->message,
            'timeFromNow' => now()->diffForHumans(),
            'unreadCount' => $notifiable->notifications()->whereNull('read_at')->count(),
            'user' => [
                'initial' => substr($this->boosterPayout->booster->name, 0, 1),
            ],
            'action_url' => $this->actionUrl,
        ]));
    }
}
