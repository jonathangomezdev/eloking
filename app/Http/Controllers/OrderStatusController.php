<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function update(Request $request, Order $order)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);
        $request->validate([
            'status' => 'required',
        ]);

        $status = $order->update([
            'status' => $request->status,
        ]);

        return [
            'success' => $status,
        ];
    }
}
