<?php

namespace App\Traits\Filters;

use Carbon\Carbon;

trait OrderFilters
{
    use Filterable;

    public function search($query, $value)
    {
        $value = '%' . $value . '%';
        return $query->where(function($q) use ($value) {
            return $q
                ->orWhere('order_id', 'like', $value)
                ->orWhereIn('user_id', function($q1) use ($value) {
                    return $q1->select('id')->from('users')->where('name', 'like', $value)->orWhere('username', 'like', $value)->orWhere('email', 'like', $value);
                })
                ->orWhereIn('id', function($q2) use ($value) {
                    return $q2->select('order_id')->from('booster_orders')->whereIn('booster_id', function($q3) use ($value) {
                        return $q3->select('id')->from('users')->where('name', 'like', $value)->orWhere('username', 'like', $value)->orWhere('email', 'like', $value);
                    });
                });
        });
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function gameType($query, $value)
    {
        $value = '%' . $value . '%';
        return $query->where('gametype', 'like', $value);
    }

    public function dates($query, $value)
    {
        $dates = array_map(function($val) {
            return Carbon::parse($val);
        }, explode(' - ', $value));

        return $query->where('created_at', '>=', $dates[0]->toDateTimeString())->where('created_at', '<=', $dates[1]->toDateTimeString());
    }

    public function type($query, $value)
    {
        return $query->where('type', 'like', '%' . $value . '%');
    }

    public function boosterId($query, $value)
    {
        return $query->boosterOrders($value);
    }
}
