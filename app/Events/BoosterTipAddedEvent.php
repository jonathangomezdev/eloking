<?php

namespace App\Events;

use App\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BoosterTipAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $payment;
    public $botMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $payment)
    {
        $this->order = $order;
        $this->payment = $payment;
        $this->botMessage = $order->user->username . " just left a " . currencyFormatted($payment->amount / 100, $payment->currency, true) . " tip 💸";
    }
}
