<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تشغيل Seeder الخاص بالأهداف كلها
        $this->call(GoalsSeeder::class);
    }
}
