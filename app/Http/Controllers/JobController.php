<?php

namespace App\Http\Controllers;

use App\BoosterGameRestriction;
use App\Order;
use App\Service\BoosterPayoutService;
use App\Service\Job\RenderAllJobsService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JobController extends Controller
{
    public function index(Request $request)
    {
        return RenderAllJobsService::run($request);
    }
}
