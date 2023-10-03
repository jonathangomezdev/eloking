<?php

namespace App\Service\BoosterPayout;

use App\BoosterOrder;
use App\BoosterPayout;
use App\Order;
use App\Service\BoosterPayoutService;
use App\Service\Service;
use App\User;

class AllBoosterPayoutsService extends Service
{
    /**
     * It will handle entire request for listing all or particular booster payouts
     * @param $args
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handle($args)
    {
        abort_if(! $this->validateRequest(), 404);

        $payload = $this->getResponsePayload();

        $payload['completedOrders'] = $this->getCompletedOrdersAndPrepareForView();

        return view('panel.booster.payouts.index', $payload);
    }

    /**
     * It will return completed orders and manipulate earning for the booster
     * @return array
     */
    private function getCompletedOrdersAndPrepareForView()
    {
        return $this->calculatePayouts($this->getCompletedOrders());
    }

    /**
     * It will return payload to return to view
     * @return array
     */
    private function getResponsePayload()
    {
        $boosterId = $this->request->boosterId;
        if (! (auth()->user()->hasRole('admin') || auth()->user()->hasRole('accountant'))) {
            $boosterId = auth()->id();
        }
        return [
            'completedOrders' => [],
            'payouts' => $this->getBoosterPayouts($boosterId),
            'boosters' => $this->getAllBoosters(),
        ];
    }

    /**
     * It will check if we should load all completed orders for a booster
     * @return bool
     */
    private function shouldLoadCompletedOrders()
    {
        return $this->isBoosterSelected() && auth()->user()->hasRole('admin');
    }

    /**
     * Check if the user is allowed to check payout
     * @return bool
     */
    private function validateRequest()
    {
        if (auth()->user()->hasRole('admin') || is_null($this->request->boosterId)) {
            return true;
        }

        return $this->request->boosterId == auth()->id();
    }

    /**
     * Check if booster is selected
     * @return mixed
     */
    private function isBoosterSelected()
    {
        return $this->request->boosterId;
    }

    /**
     * It will return completed orders of given booster
     * @return mixed
     */
    private function getCompletedOrders()
    {
        return Order::
                    filter($this->request->all())
                    ->ordersNotYetPaid($this->request->boosterId)
                    ->where('status', Order::STATUS_COMPLETED)
                    ->get();
    }

    /**
     * It will return all payouts a booster
     * @param $boosterId
     * @return mixed
     */
    private function getBoosterPayouts($boosterId)
    {
        $query = BoosterPayout::filter($this->request->all())->latest();
        if ($boosterId) {
            $query->where('booster_id', $boosterId);
        }
        return $query->paginate();
    }

    /**
     * It will return all boosters
     * @return mixed
     */
    private function getAllBoosters()
    {
        return User::query()->select('username', 'id')->role('booster')->get();
    }

    /**
     * It will loop over all orders and get their earnings
     * @param $completedOrders
     * @return mixed
     */
    private function calculatePayouts($completedOrders)
    {
        return $completedOrders->map(function($order) {
            $boosterOrder = BoosterOrder::where('order_id', $order->id)->where('booster_id', $this->request->boosterId)->first();

            $payout = $order->booster_earning_EUR;

            if ($order->isDropped()) {
                if (isset($boosterOrder->total)) {
                    $payout = $boosterOrder->total;
                } else {
                    $prevBoosterPayment = BoosterOrder::where('order_id', $order->id)->whereNotNull('drop_comment')->first();
                    $payout = $prevBoosterPayment->total < 0 ? $payout + ($prevBoosterPayment->total * -1) : $payout - $prevBoosterPayment->total;
                }
            }

            $order->payout_eligible = $payout;
            return $order;
        });
    }
}
