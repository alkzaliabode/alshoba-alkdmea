<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class TaskUserRoleSeeder extends Seeder
{
    public function run()
    {
        $role = Role::firstOrCreate(
            ['name' => 'tasks-user', 'guard_name' => 'web']
        );

        User::whereIn('email', [
            'emp1@example.com',
            'emp2@example.com',
            'emp3@example.com',
            'emp4@example.com',
            'emp5@example.com',
            'emp6@example.com',
            'emp7@example.com',
            'emp8@example.com',
            'emp9@example.com',
            'emp10@example.com',
           ])->each(function ($user) use ($role) {
            $user->syncRoles([$role->name]);
        });
    }
}