<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Superadmin User',
            'email' => 'superadmin@cityplanner.biz',
            'password' => bcrypt('Test@1234'),
            'is_superadmin' => 1
        ]);
    }
}
