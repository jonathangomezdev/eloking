<?php

namespace App;

use App\Traits\Filters\BlogPostFilters;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use BlogPostFilters;

    protected $fillable = [
        'title',
        'content',
        'category',
        'slug',
        'image',
        'status',
        'schedule_publish_at',
        'meta_keywords',
        'meta_description',
        'page_title',
    ];

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';

    /**
     * It will return a formatted string for category
     * @return string|void
     */
    public function category()
    {
        switch ($this->category) {
            case 'csgo':
                return 'CS:GO';
            case 'valorant':
                return 'Valorant';
            case 'lol':
                return 'League of Legends';
            default:
                return '';
        }
    }
}
