<?php

namespace App\Listeners;

use App\ChatRoomMessage;
use App\Notifications\OrderCompletedNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderCompletedNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $event->order->user->notify(
                new OrderCompletedNotification($event->order)
            );
        } catch (\Exception $ex) {
            Log::debug('Failed to deliver email ' . json_encode($ex));
        }

        $this->addBotMessages($event->order);
    }

    private function addBotMessages($order)
    {
        $messages = [
            'Congratulations! 🎉 The order is now completed. If you enjoyed the boost, feel free to <span class="message-action leave-a-tip-modal">leave a tip</span> through the Boost Actions menu.',
            'Thank you for using Eloking. If you have any questions feel free to <span class="message-action contact-support-action">contact our support agent</span>. Stay strong 💪'
        ];

        array_map(function($message) use ($order) {
            ChatRoomMessage::create([
                'chat_room_id'  => $order->chatRoom->id,
                'message' => $message,
                'user_id' => User::bot()->id,
                'is_comment' => false,
            ]);
        }, $messages);
    }
}
