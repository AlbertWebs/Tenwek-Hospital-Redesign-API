<?php

namespace Database\Seeders;

use App\Models\CtcService;
use Illuminate\Database\Seeder;

class CtcSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['title' => 'Adult Cardiac Surgery', 'slug' => 'adult-cardiac', 'excerpt' => 'Comprehensive adult cardiac surgical care.', 'order' => 0],
            ['title' => 'Pediatric Cardiac Surgery', 'slug' => 'pediatric-cardiac', 'excerpt' => 'Specialised care for children with heart conditions.', 'order' => 1],
            ['title' => 'Cardiothoracic Surgery', 'slug' => 'cardiothoracic', 'excerpt' => 'Thoracic and general cardiothoracic procedures.', 'order' => 2],
        ];

        foreach ($services as $s) {
            CtcService::firstOrCreate(
                ['slug' => $s['slug']],
                array_merge($s, ['body' => null, 'is_visible' => true])
            );
        }
    }
}
