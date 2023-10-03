<?php

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $roles = [
        'admin',
        'booster',
        'member',
        'accountant',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $roleName) {
            if (! Role::where('name', $roleName)->exists()) {
                $role = $this->createRole($roleName);
                $user = $this->createUser($roleName);
                $user->roles()->sync($role);
            }
        }
    }

    private function createRole($roleName)
    {
        if (Role::whereName($roleName)->exists()) {
            return Role::whereName($roleName)->first();
        }
        return Role::create(['name' => $roleName]);
    }

    private function createUser($roleName)
    {
        if (User::where('username', $roleName)->exists()) {
            return User::where('username', $roleName)->first();
        }

        return factory(User::class)->create([
            'email'     => $roleName.'@email.com',
            'username'  => $roleName,
            'password'  => Hash::make('password123')
        ]);
    }
}
