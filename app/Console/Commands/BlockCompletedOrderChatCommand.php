<?php

namespace App\Console\Commands;

use App\ChatRoom;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BlockCompletedOrderChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:orders:blockCompletedOrderChat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'After certain time it will block access to chat in order view.';

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
        $this->info("Looking for completed orders in {$this->getHoursRequiredToCompleteForCompletedOrers()} hours.");
        $orders = $this->getCompletedOrdersInHours($this->getHoursRequiredToCompleteForCompletedOrers());
        $this->info("Found {$orders->count()} total orders completed");

        $this->info("Setting chat room inactive for all found completed orders");
        ChatRoom::whereIn('order_id', $orders->pluck('id')->toArray())->update([
            'active' => false,
        ]);

        $this->info("Successful");
        return 0;
    }

    private function getCompletedOrdersInHours($hours)
    {
        return Order::where('status', Order::STATUS_COMPLETED)
                    ->where('completed_at', '>=', now()->subHours($hours)->minutes(0)->seconds(0)->toDateTimeString())
                    ->where('completed_at', '<=', now()->subHours($hours)->minutes(59)->seconds(59)->toDateTimeString())
                    ->get();
    }

    /**
     * @return int
     */
    private function getHoursRequiredToCompleteForCompletedOrers()
    {
        return Order::COMPLETED_ORDER_CHAT_CLOSE_AFTER_HOURS;
    }
}
