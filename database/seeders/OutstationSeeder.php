<?php

namespace Database\Seeders;

use App\Models\Outstation;
use Illuminate\Database\Seeder;

class OutstationSeeder extends Seeder
{
    public function run(): void
    {
        if (Outstation::query()->exists()) {
            return;
        }

        Outstation::create([
            'name' => 'Example Satellite Clinic',
            'slug' => 'example-satellite-clinic',
            'summary' => 'Demonstration outstation entry. Replace or delete in production.',
            'content' => '<p>This is sample content for an outstation landing page. Add services, visiting hours, and leadership from the admin panel.</p>',
            'address' => "Tenwek Hospital Outreach\nNear Bomet, Kenya\nP.O Box 39-20400",
            'latitude' => -0.3791,
            'longitude' => 35.1174,
            'phone' => '0700 499 699',
            'email' => 'customer.experience@tenwekhosp.org',
            'order' => 0,
            'is_published' => true,
        ]);
    }
}
