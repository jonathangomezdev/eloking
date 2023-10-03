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

class OrderUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $botMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        if (request()->filled('inform_customer')) {
            $message = request()->inform_customer_message;

            if ($message) {
                $this->botMessage = $message;
            }else if (($order->calculatePrice()['total_EUR'] - $order->total_EUR) > 0) {
                $this->botMessage = "Order Updated. You are required to make extra payment for the order.";
            } else {
                $this->botMessage = "Order got updated.";
            }
        }
    }
}
