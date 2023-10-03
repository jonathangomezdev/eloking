<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'order_id', 'active'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatRoomMessage::class);
    }
}
