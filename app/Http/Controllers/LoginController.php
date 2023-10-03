<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    private $maxAttempts = 10;
    private $lockHours = 1;

    public function show()
    {
        if (auth()->check()) {
            return redirect(\URL::to('/panel/orders'));
        }

        $title = 'Member Login';
        return view('panel.member.login', [
            'title' => $title,
            'meta_description' => config('seo_meta.description.login'),
        ]);
    }

    public function login(Request $request)
    {
        $valid = [
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
        $payload = $request->only('password');

        if (preg_match('/(.+)@(.+)\.(.+)/', $request->username)) { // check if valid email
            $valid = array_merge([
                'username' => 'required|exists:users,email',
            ], $valid);
            $payload = array_merge($payload, ['email' => $request->username]);
        } else {
            $valid = array_merge([
                'username' => 'required|exists:users,username',
            ], $valid);
            $payload = $request->only('username', 'password');
        }

        $request->validate($valid, [
            'username.exists' => 'Incorrect credentials.',
        ]);

        if (! auth()->attempt($payload, true)) {
            return redirect()->back()->withErrors([
                'username' => 'Incorrect credentials.',
            ]);
        }

        // set remember me expire time
        $rememberTokenExpireMinutes = (60 * 24)*30; // 30 days

        // first we need to get the "remember me" cookie's key, this key is generate by laravel randomly
        // it looks like: remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d
        $rememberTokenName = Auth::getRecallerName();

        // reset that cookie's expire time
        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);

        // the code below is just copy from AuthenticatesUsers
        $request->session()->regenerate();

        return redirect()->to('/panel/orders');
    }
}
