<?php

namespace App\Http\Controllers;

use App\BoosterGameRestriction;
use App\BoosterOrder;
use App\ChatRoomMember;
use App\Events\OrderPickedUpEvent;
use App\Events\OrderStatusChangedEvent;
use App\Notifications\OrderGotPickedUpNotification;
use App\Notifications\YouPickedUpOrderNotification;
use App\Order;
use App\Service\BoosterOrderDropService;
use App\Service\BoosterOrderService;
use App\User;
use Illuminate\Http\Request;

class BoosterOrderController extends Controller
{
    public function store(Request $request)
    {
        $order   = Order::find($request->order);

        abort_if(! BoosterGameRestriction::where('user_id', auth()->id())->where('game', $order->gametype)->exists(), 404);

        if ($order->status !== Order::STATUS_READY_FOR_PICKUP) {
            session()->flash('success', "Order was picked up by someone else a few seconds ago");
            return redirect()->back();
        }

        // if the booster has order in progress or ready for a different game then, Booster cannot pick this order
        if (! BoosterOrderService::shouldAllowPickup($order, auth()->id())) {
            session()->flash('success', "Please complete the orders that are in progress before picking up new orders.");
            return redirect()->back();
        }

        if ((isset($order->payload['options']) && in_array('coaching', $order->payload['options'])) && ! BoosterOrderService::shouldAllowCoachingOrders(auth()->user())) {
            session()->flash('success', "You are not allowed to pickup coaching orders.");
            return redirect()->back();
        }

        BoosterOrder::create([
            'order_id' => $order->id,
            'booster_id' => auth()->id(),
        ]);

        $order->update([
            'status' => Order::STATUS_READY,
        ]);

        event(new OrderPickedUpEvent($order));

        session()->flash('success', "You successfully picked up order #{$order->order_id}");
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $order = Order::byOrderId($request->order);
        $booster = $order->booster();

        ChatRoomMember::where('chat_room_id', $order->chatRoom->id)->where('user_id', $booster->id)->delete();

        BoosterOrder::where('order_id', $order->id)->delete();

        $order->update([
            'status' => Order::STATUS_READY_FOR_PICKUP,
        ]);

        session()->flash('success', 'Booster has been removed.');
        return redirect()->back();
    }

    public function drop(Request $request)
    {
        $request->validate([
            'reason' => 'required',
            'progressed_rank' => 'required',
            'current_lp' => 'nullable',
            'no_penalty' => 'nullable',
        ]);

        BoosterOrderDropService::run($request);

        session()->flash('success', "Order has been dropped");
        return redirect()->to(\URL::to('/panel/orders'));
    }
}
