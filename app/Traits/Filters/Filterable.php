<?php
namespace App\Traits\Filters;

trait Filterable
{
    public function scopeFilter($query, $payload)
    {
        $payload = array_filter($payload);
        foreach ($payload as $filter => $value) {
            if (method_exists($this, $filter) && !is_null($value)) {
                $this->$filter($query, $value);
            }
        }
    }
}
