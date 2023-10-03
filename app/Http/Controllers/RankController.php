<?php

namespace App\Http\Controllers;

use App\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    /**
     * Calculates price of certain boost.
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        if (!$request->gametype || !$request->platform || !$request->type || is_null($request->currentRank) ||
            !$request->desiredRank) {
            return null;
        }
        $rank = new Rank();
        $data = $rank->calculate($request->gametype, $request->platform, $request->type, intval($request->currentRank),
            intval($request->desiredRank), $request->input('options'), $request->currentLp, $request->currentLPMaster, $request->desiredLPMaster);

        return response()->json($data, 200);
    }
}
