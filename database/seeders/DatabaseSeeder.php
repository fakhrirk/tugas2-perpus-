<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'fahribalap123@gmail.com',
            'password' => Hash::make('password123'), // Password yang kita ketahui
        ]);

        // User tamu untuk testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}