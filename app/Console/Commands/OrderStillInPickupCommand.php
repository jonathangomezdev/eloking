<?php

namespace App\Console\Commands;

use App\ChatRoomMessage;
use App\Order;
use App\User;
use Illuminate\Console\Command;

class OrderStillInPickupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:order:still-in-pickup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will add message via chat bot in order chat room.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Looking for orders still in ready for pickup after X minutes");
        $orders = $this->ordersReadyForPickup();
        $this->info("Found {$orders->count()} still in ready for pickup");

        $orders->each(function($order) {
            $messages = [
                "It looks like we can't find a booster for your order in 30 minutes. &#128542;️",
                "Please contact our <span class='message-action contact-support-action'>customer service</span> if you are short on time & we will refund your money - no questions asked."
            ];

            foreach ($messages as $message) {
                ChatRoomMessage::create([
                    'chat_room_id' => $order->chatRoom->id,
                    'message' => $message,
                    'user_id' => User::bot()->id,
                ]);
            }
        });


        $this->info("Done!");
        return 0;
    }

    private function ordersReadyForPickup()
    {
        return Order::where('status', Order::STATUS_READY_FOR_PICKUP)
            ->where('created_at', '>=', now()->subMinutes(30)->seconds(0)->toDateTimeString())
            ->where('created_at', '<=', now()->subMinutes(30)->seconds(59)->toDateTimeString())
            ->get();
    }
}
