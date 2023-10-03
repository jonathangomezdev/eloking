<?php

namespace App\Http\Controllers;

use App\BoosterPayout;
use Illuminate\Http\Request;

class BoosterPayoutStatusController extends Controller
{
    public function update(Request $request, BoosterPayout $payout)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $payout->update($request->only('status'));

        return true;
    }
}

