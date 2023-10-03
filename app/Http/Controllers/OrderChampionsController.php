<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderChampion;
use Illuminate\Http\Request;

class OrderChampionsController extends Controller
{
    public function store(Request $request, Order $order)
    {
        foreach ($request->champions as $champion) {
            OrderChampion::create([
                'order_id' => $order->id,
                'champion_id' => $champion
            ]);
        }
        return [
            'success' => true,
        ];
    }

    public function update(Request $request, Order $order)
    {
        OrderChampion::where('order_id', $order->id)->delete();
        foreach ($request->champions as $champion) {
            OrderChampion::create([
                'order_id' => $order->id,
                'champion_id' => $champion
            ]);
        }
        return [
            'success' => true,
        ];
    }
}
