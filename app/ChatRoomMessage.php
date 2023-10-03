<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomMessage extends Model
{
    protected $fillable = [
        'chat_room_id', 'message', 'user_id', 'is_comment'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function attachments()
    {
        return $this->hasMany(ChatRoomMessageAttachment::class, 'chat_room_message_id', 'id');
    }
}
