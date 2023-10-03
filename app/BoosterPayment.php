<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoosterPayment extends Model
{
    protected $fillable = [
        'booster_id',
        'order_id',
        'status'
    ];

    const STATUS_PAYMENT_HELD = 'held';
    const STATUS_PAYMENT_DISTRIBUTED = 'payment_distributed';
}
