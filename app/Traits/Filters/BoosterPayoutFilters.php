<?php

namespace App\Traits\Filters;

use Carbon\Carbon;

trait BoosterPayoutFilters
{
    use Filterable;

    public function boosterId($query, $value)
    {
        return $query->where('booster_id', $value);
    }

    public function historySearch($query, $value)
    {
        $value = '%' . $value . '%';
        return $query->where(function($clause) use ($value) {
            $clause
                ->orWhereIn('id', function($q) use ($value) {
                    return $q->select('booster_payout_id')->from('booster_payout_orders')->whereIn('order_id', function($qr) use ($value) {
                        return $qr->select('id')->from('orders')->where('order_id', 'like', $value);
                    });
                })
                ->orWhere('status', 'like', $value);
        });
    }

    public function historyDates($query, $value)
    {
        $dates = array_map(function($date) {
            return Carbon::parse($date);
        }, explode(' - ', $value));

        return $query->where('created_at', '>=', $dates[0]->toDateTimeString())->where('created_at', '<=', $dates[1]->toDateTimeString());
    }
}
