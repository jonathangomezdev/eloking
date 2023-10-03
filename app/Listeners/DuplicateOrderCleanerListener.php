<?php

namespace App\Listeners;

use App\Order;
use App\OrderLog;
use App\Events\OrderDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DuplicateOrderCleanerListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        if (! $this->userHasPendingOrders($order->user_id)) {
            // user does not have any pending orders. So, returning.
            return true;
        }

        $failedOrders = $this->getMatchingFailedOrders($order);

        $failedOrders->each(function($failedOrder) {
            $this->deleteFailedOrder($failedOrder);
        });
    }

    /**
     * It will delete failed order
     * @param Order $failedOrder
     * 
     * @return void
     */ 
    private function deleteFailedOrder(Order $failedOrder)
    {
        $failedOrder->moveToLog();
        event(new OrderDeletedEvent($failedOrder));
    }

    /**
     * It will return all matching failed orders for given order
     * @param Order $order
     * 
     * @return Collection
     */ 
    private function getMatchingFailedOrders(Order $order)
    {
        return Order::whereUserId($order->user_id)
            ->where('platform', $order->platform)
            ->where('type', $order->type)
            ->where('total_EUR', $order->total_EUR)
            ->where('total', $order->total)
            ->where('currency', $order->currency)
            ->where('gametype', $order->gametype)
            ->whereJsonContains('payload', $order->payload)
            ->where('status', Order::STATUS_PAYMENT_PENDING)
            ->where('created_at', '>=', $this->getLastGarbageHour())
            ->get();
    }

    /**
     * It will check if the user has payment failed orders
     * @param int $userId
     * @return bool
     */ 
    private function userHasPendingOrders($userId)
    {
        return Order::whereUserId($userId)
                ->whereStatus(Order::STATUS_PAYMENT_PENDING)
                ->where('created_at', '>=', $this->getLastGarbageHour())
                ->exists();
    }

    /**
     * It will return hours (time) from when to pickup all orders for pending review
     * 
     * @return Carbon\Carbon
     */ 
    private function getLastGarbageHour()
    {
        return now()->subHours(Order::GARBAGE_COLLECT_PENDING_ORDER_AFTER_HOURS);
    }
}
