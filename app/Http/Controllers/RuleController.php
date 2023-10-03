<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!(auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin')), 404);

        $title = 'Booster Rules';

        return view('panel.booster.rules', [
            'title' => $title,
        ]);
    }
}
