<?php
namespace App\Traits\Filters;

trait UserFilters
{
    use Filterable;

    protected $filters = [
        'name',
        'email',
        'role',
        'active',
        'sortBy',
        'booster',
    ];

    public function name($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    public function email($query, $email)
    {
        return $query->where('email', 'like', "%{$email}%");
    }

    public function role($query, $role)
    {
        return $query->role($role);
    }

    public function active($query, $isActive)
    {
        return $query->where('active', $isActive == 'active');
    }

    public function sortBy($query, $value)
    {
        $sortOrder = request('sortOrder') ?? 'desc';
        if ($value === 'role') {
            return;
        }
        return $query->orderBy($value, $sortOrder);
    }

    public function search($query, $value)
    {
        return $query->where(function($clause) use ($value) {
            return $clause
                        ->where('name', 'like', '%'.$value.'%')
                        ->orWhere('username', 'like', '%'.$value.'%')
                        ->orWhere('discord', 'like', '%'.$value.'%');
        });
    }
}
