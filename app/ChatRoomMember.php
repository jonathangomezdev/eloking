<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomMember extends Model
{
    protected $fillable = [
        'user_id', 'chat_room_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
