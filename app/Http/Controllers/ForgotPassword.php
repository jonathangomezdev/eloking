<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPassword extends Controller
{
    public function sendEmailToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $isSent = $status === Password::RESET_LINK_SENT;

        return response()->json([
            'success' => $isSent,
            'message' => 'If there is a user with this email address, they have been sent a reset password link.',
        ]);
    }

    public function passwordResetForm(Request $request)
    {
        return view('password.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $userType = 'member';
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                $userType = $user->user_type;
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->to('/' . $userType . '/login')->with('success', 'Password reset successful.')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
