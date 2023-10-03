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

class OrderStatusChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $previousStatus;
    public $botMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $previousStatus)
    {
        $this->order = $order;
        $this->previousStatus = $previousStatus;

        $this->botMessage = "Orders status has been changed from " . $this->refineStatusName($previousStatus) . " to " . $this->refineStatusName($order->status) . " 🙂";
    }

    private function refineStatusName($name)
    {
        return join(' ', array_map('ucfirst', explode('_', $name)));
    }
}
