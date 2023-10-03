<?php

namespace App\Events;

use App\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderMadeExtraPaymentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $botMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, string $amount)
    {
        $this->order = $order;
        $this->botMessage = "Just made extra payment of {$amount} for the order. ";
    }
}
