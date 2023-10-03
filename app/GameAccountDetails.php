<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameAccountDetails extends Model
{
    protected $fillable = [
        'username', 'password', 'faceit_email', 'faceit_password', 'order_id',
    ];

    /**
     * Get the order for which the game account details were added
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
