<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoosterPayoutOrder extends Model
{
    protected $fillable = [
        'order_id', 'booster_payout_id'
    ];
}
