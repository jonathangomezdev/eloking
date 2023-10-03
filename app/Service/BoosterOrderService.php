<?php

namespace App\Service;

use App\BoosterOrder;
use App\Order;
use App\User;

class BoosterOrderService
{
    public static function shouldAllowPickup(Order $order, $boosterId)
    {
        $pendingOrders = BoosterOrderService::getBoosterPendingOrders($boosterId);
        $booster = User::find($boosterId);

        if ($pendingOrders->count() === 0) {
            return true;
        }

        $cloneOrders = $pendingOrders->push($order);

        if(
            $cloneOrders->groupBy('platform')->count() <= $booster->max_allowed_platforms && $pendingOrders->count() <= $booster->max_allowed_pickups
        ) {
            return true;
        }


        return false;
    }

    /**
     * It will return booster's pending orders
     * @param int $boosterId
     * @return mixed
     */
    public static function getBoosterPendingOrders($boosterId)
    {
        return Order::whereIn('id', function($q) use ($boosterId) {
            return $q->select('order_id')->from('booster_orders')->where('booster_id', $boosterId)->whereNull('drop_comment')->get();
        })->whereIn('status', [Order::STATUS_READY, Order::STATUS_IN_PROGRESS])->get();
    }

    public static function shouldAllowCoachingOrders(User $user)
    {
        return $user->allow_coaching_orders;
    }
}
