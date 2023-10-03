<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $fillable = [
        'name', 'gametype',
    ];

    public function getImageFileName()
    {
        return strtolower(str_replace(['@', '.', ' ', '&', "'", "/"], '', $this->name)) . '.png';
    }
}
