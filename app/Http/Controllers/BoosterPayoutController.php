<?php

namespace App\Http\Controllers;

use App\BoosterOrder;
use App\BoosterPayout;
use App\Events\BoosterPayoutCreatedEvent;
use App\BoosterPayoutOrder;
use App\Order;
use App\Rank;
use App\Service\BoosterPayout\AllBoosterPayoutsService;
use App\Service\BoosterPayoutService;
use App\User;
use Illuminate\Http\Request;

class BoosterPayoutController extends Controller
{
    public function index(Request $request)
    {
        return AllBoosterPayoutsService::run($request);
    }

    public function create(User $user)
    {
        $user->boosting->load('order.user');
        return view('panel.booster.payouts.create', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        if (! auth()->user()->hasRole('admin')) {
            abort(404);
        }

        $request->validate([
            'orderIds' => 'required|array',
            'boosterId' => 'required'
        ]);

        $orders = Order::find($request->orderIds);
        $orders = BoosterPayoutService::calculatePayout($orders, $request->boosterId);
        $total = $orders->sum('payout_eligible');
        $orders->each(function ($order) use (&$total, $request) {
            if (! $order->isOrderDropper($request->boosterId)) {
                $total += $order->totalTip(true);
            }
        });

        $total -= BoosterPayout::where('booster_id', $request->boosterId)->whereNull('paid_at')->sum('fee');

        if ($total < 1) {
            session()->flash('success', 'Not enough amount after deducting fees.');
            return redirect()->back();
        }

        $payout = BoosterPayout::create([
            'payout_amount_eur' => $total,
            'booster_id' => $request->boosterId,
            'status' => BoosterPayout::STATUS_PAYOUT_PENDING,
        ]);

        BoosterPayout::where('booster_id', $request->boosterId)->whereNull('paid_at')->update([
            'paid_at' => now(),
            'booster_payout_id' => $payout->id,
        ]);

        event(new BoosterPayoutCreatedEvent($payout));

        foreach ($request->orderIds as $orderId) {
            BoosterPayoutOrder::create([
                'order_id' => $orderId,
                'booster_payout_id' => $payout->id,
            ]);
        }

        session()->flash('success', 'Payout has been created');
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        return view('panel.admin.payout.edit', [
            'payout' => BoosterPayout::find($request->payout),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $payout = BoosterPayout::find($request->payout);

        abort_if(! (auth()->user()->hasRole('admin') || $payout->status === BoosterPayout::STATUS_PAYOUT_COMPLETED), 404);

        $payout->update($request->validate([
            'payout_amount_eur' => 'required',
            'status' => 'required',
            'fee' => 'nullable',
            'note' => 'nullable',
        ]));

        session()->flash('success', 'Payout has been updated.');
        return redirect()->back();
    }
}
