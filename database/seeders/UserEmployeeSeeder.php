<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserEmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
           ['name' => 'Emp1', 'email' => 'emp1@example.com'],
            ['name' => 'Emp2', 'email' => 'emp2@example.com'],
            ['name' => 'Emp3', 'email' => 'emp3@example.com'],
            ['name' => 'Emp4', 'email' => 'emp4@example.com'],
            ['name' => 'Emp5', 'email' => 'emp5@example.com'],
             ['name' => 'Emp6', 'email' => 'emp6@example.com'],
            ['name' => 'Emp7', 'email' => 'emp7@example.com'],
            ['name' => 'Emp8', 'email' => 'emp8@example.com'],
            ['name' => 'Emp9', 'email' => 'emp9@example.com'],
            ['name' => 'Emp10', 'email' => 'emp10@example.com'],
        ];

        foreach ($employees as $emp) {
            User::updateOrCreate(
                ['email' => $emp['email']],
                [
                    'name' => $emp['name'],
                    'password' => Hash::make('password123'), // كلمة المرور الافتراضية
                ]
            );
        }
    }
}