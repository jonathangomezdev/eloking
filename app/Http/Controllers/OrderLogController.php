<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderLog;
use Illuminate\Http\Request;

class OrderLogController extends Controller
{
    public function index()
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $title = 'Order Log';

        return view('panel.admin.order.log', [
            'orders' => OrderLog::latest()->paginate(40),
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $order = Order::byOrderId($request->order);

        $order->moveToLog();

        session()->flash("success", "Order successfully moved to log");
        return redirect()->to(\URL::to('/panel/orders'));
    }

    public function destroy()
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        OrderLog::truncate();

        session()->flash("success", "Order log table cleaned.");
        return redirect()->back();
    }
}
