<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('email', 'admin@tenwekhosp.org')->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@tenwekhosp.org',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
