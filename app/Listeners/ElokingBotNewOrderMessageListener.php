<?php

namespace App\Listeners;

use App\User;
use App\ChatRoomMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ElokingBotNewOrderMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        $messages = [
            'Hey, thank you for your order! The booster will be with you shortly 🔥',
        ];

        if ($order->gametype === 'valorant' && !$order->isDuo()) {
            $messages[] = $this->getValorantMessage($order);
        } elseif ($order->gametype === 'lol') {
            $messages[] = $this->getLolMessage($order);
        } elseif ($order->gametype === 'csgo' && !$order->isDuo()) {
            $messages[] = $this->getCsgoMessage($order);
        }

        $this->addMessages($order, $messages);
    }

    private function addMessages($order, $messages)
    {
        return array_map(function($message) use ($order) {
            return ChatRoomMessage::create([
                'chat_room_id' => $order->chatRoom->id,
                'message' => $message,
                'user_id' => User::bot()->id,
            ]);
        }, $messages);
    }

    private function getValorantMessage($order)
    {
        return "While you wait you can <span class='message-action game-credentials-modal-open'>add your account credentials</span> and <span class='message-action select-agent'>select agents</span> through the Boost Actions menu 😇";
    }

    private function getLolMessage($order)
    {
        if (! $order->isDuo()) {
            return "While you wait you can <span class='message-action game-credentials-modal-open'>add your account credentials</span> and <span class='message-action select-champions'>select champions</span> through the Boost Actions menu. 😇";
        }

        return "While you wait you can <span class='message-action select-champions'>select champions</span> through the Boost Actions menu. You can also let the booster know your preferred spell key set and lane free of charge 👌";
    }

    private function getCsgoMessage($order)
    {
        return "While you wait you can <span class='message-action game-credentials-modal-open'>add your account credentials</span> free of charge 👌";
    }
}
