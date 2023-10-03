<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_intent_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'captured',
        'charge_id',
        'paid',
        'refunded',
        'receipt_url',
        'card_last4',
        'card_exp',
        'card_brand',
        'order_id',
        'type',
        'amount_EUR',
    ];
}
