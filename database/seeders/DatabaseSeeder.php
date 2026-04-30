<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            MenuSeeder::class,
            PageSeeder::class,
            PostSeeder::class,
            CtcSeeder::class,
            CareerSeeder::class,
            OutstationSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
