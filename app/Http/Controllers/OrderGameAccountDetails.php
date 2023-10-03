<?php

namespace App\Http\Controllers;

use App\GameAccountDetails;
use App\Order;
use Illuminate\Http\Request;

class OrderGameAccountDetails extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request, Order $order)
    {

        if ($order->user_id != auth()->id()) {
            abort(404);
        }

        $credentials = [
            'username' => 'required',
            'password' => 'required'
        ];

        $payload = [
            'username' => encrypt($request->username),
            'password' => encrypt($request->password),
            'faceit_email' => encrypt(''),
            'faceit_password' => encrypt(''),
            'order_id' => $order->id, 
        ];

        if($order->gametype === 'csgo' && $order->platform === 'faceit') {

            $credentials = array_merge([
                'faceit_email' => 'required',
                'faceit_password' => 'required',
            ], $credentials);

            $payload = array_replace_recursive($payload, [
                'faceit_email' => encrypt($request->faceit_email),
                'faceit_password' => encrypt($request->faceit_password),
            ]);
        }

        $request->validate($credentials);
        GameAccountDetails::create($payload);

        session()->flash('success', 'Game account details has been saved.');
        return redirect()->back();
    }

    public function destroy(Request $request, Order $order)
    {
        if (auth()->id() != $order->user_id) {
            abort(404);
        }
        GameAccountDetails::where('order_id', $order->id)->delete();
        session()->flash('success', 'Details have been deleted.');
        return redirect()->back();
    }
}
