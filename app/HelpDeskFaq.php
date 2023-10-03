<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpDeskFaq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'categories',
    ];

    public function getCategoriesAttribute()
    {
        return explode(',', $this->attributes['categories']);
    }

    public function setCategoriesAttribute($value)
    {
        $this->attributes['categories'] = implode(',', $value);
    }
}
