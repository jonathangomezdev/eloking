<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpDeskFaqCategories extends Model
{
    public function getCategoriesAttribute()
    {
        if (!$this->relationLoaded('categories')) {
            $faqs = HelpDeskFaq::whereRaw("FIND_IN_SET('" . $this->name . "', categories)")->get();
            return $faqs;
        }
    }
}
