<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomMessageAttachment extends Model
{
    protected $fillable = [
        'chat_room_message_id', 'location', 'name',
    ];

    public function getLocation()
    {
        return \URL::to('/' . str_replace('public', 'storage', $this->location));
    }
}
