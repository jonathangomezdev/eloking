<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderChampion extends Model
{
    protected $fillable = [
        'order_id', 'champion_id'
    ];
}
