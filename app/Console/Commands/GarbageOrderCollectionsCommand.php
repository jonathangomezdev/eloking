<?php

namespace App\Console\Commands;

use App\Order;
use App\OrderLog;
use App\Events\OrderDeletedEvent;
use Illuminate\Console\Command;

class GarbageOrderCollectionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:order:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will move pending orders to order log table and delete orders table entry for that order';

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
        $this->info("Starting to look for pending orders");
        // get all orders in pending status for more than 48 (variable) hours.
        $orders = $this->getPendingOrders();

        $this->info("Found {$orders->count()} pending orders from before" . Order::GARBAGE_COLLECT_PENDING_ORDER_AFTER_HOURS ." hours.");
        $this->info("Moving Orders");

        $count = 0;
        $orders->each(function($order) use (&$count) {
            $this->info("---------------------------------");
            $this->info("Moving order #{$order->order_id}");
            $log = $order->moveToLog();
            event(new OrderDeletedEvent($order));
            $count++;

            $this->info("Done");

            $this->info("---------------------------------");
        });

        $this->info("Operation successful. Total Moved {$count}");

        return 0;
    }

    /**
     * It will return all pending orders from orders table with more than 48 hours of pending status
     * 
     * @return Collection
     */ 
    private function getPendingOrders()
    {
        return Order::whereStatus(Order::STATUS_PAYMENT_PENDING)
                    ->where('created_at', '<', now()->subHours(Order::GARBAGE_COLLECT_PENDING_ORDER_AFTER_HOURS))
                    ->get();
    }
}
