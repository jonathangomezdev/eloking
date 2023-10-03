<?php

namespace App\Service\Job;

use App\BoosterGameRestriction;
use App\BoosterOrder;
use App\Order;
use App\Service\BoosterPayoutService;
use App\Service\Service;
use Illuminate\Pagination\LengthAwarePaginator;

class RenderAllJobsService extends Service
{
    public function handle($args)
    {
        abort_if(! $this->validateRequest(), 404);

        $orders = $this->hasGamePermissions()
                    ? $this->getOrdersForPickup()
                    : $this->getDummyPaginatedOrderList();

        return view('panel.jobs.index', [
            'orders' => $orders,
            'pickedUpOrders' => $this->getPickedUpOrders(),
            'title' => 'Jobs',
        ]);
    }

    private function validateRequest()
    {
        return auth()->user()->hasRole('booster');
    }

    private function getDummyPaginatedOrderList()
    {
        return new LengthAwarePaginator(
            [],
            0,
            10,
            1,
            ['path' => url('')]
        );
    }

    private function hasGamePermissions()
    {
        return BoosterGameRestriction::whereUserId(auth()->id())->exists();
    }

    /**
     * It will return list of orders available for pickup
     * @return LengthAwarePaginator
     */
    private function getOrdersForPickup()
    {
        $orders = Order::readyForPickup()
            ->allowedGameForBooster()
            ->whereNotIn('id', function($q) {
                return $q->select('order_id')->from('booster_orders')->where('booster_id', auth()->id());
            })
            ->latest()
            ->paginate(10, ['*'], 'ordersPage');

        return $this->convertToPagination($this->calculatePayout($orders), $orders);
    }

    private function getPickedUpOrders()
    {
        $orders = Order::
            whereIn('status', [Order::STATUS_READY, Order::STATUS_IN_PROGRESS, Order::STATUS_COMPLETED, Order::STATUS_REFUNDED])
            ->whereIn('id', function($q) {
                return $q->select('order_id')->from('booster_orders')->where('booster_id', auth()->id());
            })
            ->orderBy('status', 'desc')
            ->paginate(10, ['*'], 'pickedupOrdersPage');

        return $this->convertToPagination($orders->map(function($order) {
            $order->payout_eligible = BoosterPayoutService::calculateOrderPayout($order, auth()->id());
            return $order;
        }), $orders);
    }

    private function calculatePayout($orders)
    {
        return $orders->map(function($order) {
            $payout = $order->booster_earning_EUR;
            if ($order->isDropped()) {
                $droppedOrderData = $this->getDroppedOrderData($order);

                if ($droppedOrderData->total < 0) {
                    $payout = $order->booster_earning_EUR + ($droppedOrderData->total * -1) ;
                } else {
                    $payout = $order->booster_earning_EUR - $droppedOrderData->total;
                }
            }

            $order->payout_eligible = $payout;

            return $order;
        });
    }

    private function getDroppedOrderData($order)
    {
        return BoosterOrder::where('order_id', $order->id)->whereNotNull('drop_comment')->first();
    }

    private function convertToPagination($orders, $metadata)
    {
        return new LengthAwarePaginator(
            $orders,
            $metadata->total(),
            $metadata->perPage(),
            $metadata->currentPage(),
            [
                'path' => $metadata->path(),
                'pageName' => $metadata->getPageName(),
            ]
        );
    }
}
