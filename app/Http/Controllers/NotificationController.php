<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllSeen()
    {
        auth()->user()->notifications()->update([
            'read_at' => now()
        ]);
    }
}
