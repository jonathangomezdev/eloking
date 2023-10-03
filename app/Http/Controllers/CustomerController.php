<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    /**
     * It will get customer if doesn't exists then create
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function show(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (User::whereEmail($request->email)->exists()) {
            return User::whereEmail($request->email)->first();
        }

        $username = User::generateUsername($request->email);

        $user = factory(User::class)->create([
            'name' => $username,
            'email' => $request->email,
            'email_verified_at' => null,
            'active' => false,
            'username' => $username,
        ]);

        $user->roles()->attach(Role::whereName('member')->first());

        return $user;
    }

    /**
     * It will set password for a user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePassword(Request $request)
    {
        $request->validate([
            'password'  => 'required|min:8',
            'order_id'  => 'required|exists:orders,order_id',
        ]);

        $order = Order::byOrderId($request->order_id);
        $order->user->update([
            'password'          => Hash::make($request->password),
            'active'            => 1,
            'email_verified_at' => now()
        ]);

        Auth::loginUsingId($order->user->id);

        return redirect()->to('/panel/orders');
    }
}
