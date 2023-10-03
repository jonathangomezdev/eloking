<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $payload = [])
    {
        $this->user = $user;
        $this->payload = $payload;
    }
}
