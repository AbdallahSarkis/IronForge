<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        User::updateOrCreate(
            ['email' => 'john@example.com'],
            ['name' => 'John Doe', 'role' => 'member', 'password' => $password]
        );

        User::updateOrCreate(
            ['email' => 'sarah@example.com'],
            ['name' => 'Sarah Johnson', 'role' => 'coach', 'password' => $password]
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'role' => 'admin', 'password' => $password]
        );
    }
}
