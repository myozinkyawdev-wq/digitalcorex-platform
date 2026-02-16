<?php

namespace Database\Seeders;

use App\Enums\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserStatus;
use App\Models\User;
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
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '+959780780780',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'role' => UserRole::ADMIN(),
            'status' => UserStatus::ACTIVE(),
        ]);
    }
}
