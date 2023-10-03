<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoosterOrder extends Model
{
    protected $fillable = [
        'order_id', 'booster_id', 'active', 'drop_comment', 'progressed_rank', 'current_lp',
        'total', 'earning', 'penalty'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function booster()
    {
        return $this->belongsTo(User::class, 'booster_id', 'id');
    }
}
