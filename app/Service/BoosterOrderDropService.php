<?php

namespace App\Service;

use App\BoosterOrder;
use App\ChatRoomMember;
use App\Order;

class BoosterOrderDropService
{
    public $order;
    public $booster;
    public $request;

    public static function run($request)
    {
        $service = new self;
        $service->order = Order::byOrderId($request->order);
        $service->booster = $service->order->booster();
        $service->request = $request;

        if ($service->takenFiveMinutesFromNow() && ! ($service->hasMadeAnyProgress())) {
            $service->setOrderForPickup();
            $service->clearOrderMessages();
            $service->removeBooster();
            return $service->removeBoosterFromChatRoom();
        }

        $service->setBoosterOrderInactive();
        $service->setOrderDropped();
        $service->setOrderForPickup();

        if (! $service->hasMadeAnyProgress()) {
            return $service->updateBoosterOrder([
                'drop_comment' => $request->reason,
                'progressed_rank' => $request->progressed_rank,
                'current_lp' => $request->current_lp,
                'active' => false,
                'penalty' => $service->getPenalty(),
                'total' => $service->getPenalty() * -1,
                'earning' => 0,
            ]);
        }

        $calculatedPayout = BoosterPayoutService::calculateOrderPayout($service->order, $service->booster->id);

        return $service->updateBoosterOrder([
            'drop_comment' => $request->reason,
            'progressed_rank' => $request->progressed_rank,
            'current_lp' => $request->current_lp,
            'active' => false,
            'penalty' => $service->getPenalty(),
            'total' => $calculatedPayout - $service->getPenalty(),
            'earning' => $calculatedPayout,
        ]);
    }

    private function updateBoosterOrder($payload)
    {
        return BoosterOrder::where('order_id', $this->order->id)->where('booster_id', $this->booster->id)->update($payload);
    }

    private function updateOrder($payload)
    {
        return $this->order->update($payload);
    }

    private function hasMadeAnyProgress()
    {
        return
            ! ($this->request->progressed_rank == $this->order->payload['currentRank'] &&
            $this->request->current_lp == $this->order->payload['currentLp']);
    }

    private function setOrderForPickup()
    {
        return $this->updateOrder([
            'status' => Order::STATUS_READY_FOR_PICKUP,
        ]);
    }

    /**
     * It checks if the order was taken minutes from now
     * @return boolean
     */
    private function takenFiveMinutesFromNow()
    {
        return BoosterOrder::
                where('order_id', $this->order->id)
                ->where('booster_id', $this->booster->id)
                ->where('created_at', '>', now()->subMinutes(5)->toDateTimeString())
                ->exists();
    }

    private function setBoosterOrderInactive()
    {
        $this->updateBoosterOrder([
            'active' => false,
        ]);
    }

    private function clearOrderMessages()
    {
        $firstMessage = $this->order->chatRoom->messages()->oldest()->take(2)->first();
        $this->order->chatRoom->messages()->where('id', '!=', $firstMessage->id)->delete();
    }

    private function removeBooster()
    {
        BoosterOrder::where('booster_id', $this->booster->id)->where('order_id', $this->order->id)->delete();
    }

    private function removeBoosterFromChatRoom()
    {
        return ChatRoomMember::where('chat_room_id', $this->order->chatRoom->id)->where('user_id', $this->booster->id)->delete();
    }

    private function getPenalty()
    {
        if ($this->request->filled('no_penalty') && auth()->user()->hasRole('admin')) {
            return 0;
        }
        return round(($this->order->booster_earning_EUR / 100) * Order::DROP_PENALTY, 2);
    }

    private function setOrderDropped()
    {
        return $this->updateBoosterOrder([
            'drop_comment' => $this->request->reason,
            'progressed_rank' => $this->request->progressed_rank,
            'current_lp' => $this->request->current_lp,
            'active' => false,
        ]);
    }
}
