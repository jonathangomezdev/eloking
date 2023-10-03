<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayoutMethod extends Model
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    protected $fillable = [
        'user_id', 'method', 'details', 'active'
    ];

    protected $casts = [
        'details' => 'array',
    ];
}
