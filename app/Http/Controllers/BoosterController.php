<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BoosterController extends Controller
{
    public function show(Request $request, User $user)
    {
        if (! $user->hasRole('admin')) {
            $user = auth()->user();
        }

        $title = 'Booster Payout';

        return view('panel.booster.show', [
            'booster' => $user,
            'title' => $title,
        ]);
    }
}
