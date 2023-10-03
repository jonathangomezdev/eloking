<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoosterGameRestriction extends Model
{
    protected $fillable = [
        'game', 'user_id',
    ];
}
