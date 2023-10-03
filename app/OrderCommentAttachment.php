<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCommentAttachment extends Model
{
    protected $fillable = [
        'order_comment_id', 'location', 'filename',
    ];
}
