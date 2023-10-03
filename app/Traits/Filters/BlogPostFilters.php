<?php
namespace App\Traits\Filters;

trait BlogPostFilters
{
    use Filterable;

    public function gametype($query, $value)
    {
        return $query->where('category', $value);
    }

    public function search($query, $value)
    {
        $value = '%' . $value . '%';
        return $query->where(function($clause) use ($value) {
            return $clause
                ->where('title', 'like', $value)
                ->orWhere('content', 'like', $value);
        });
    }

    public function status($query, $value)
    {
        return $query->where('status', $value);
    }
}
