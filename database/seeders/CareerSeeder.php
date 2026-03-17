<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Registered Nurse – ICU',
                'slug' => 'registered-nurse-icu',
                'department' => 'Nursing',
                'location' => 'Tenwek Hospital, Bomet',
                'employment_type' => 'Full-time',
                'description' => "We are looking for a qualified Registered Nurse to join our ICU team. You will provide high-quality care to critically ill patients in a supportive, mission-driven environment.",
                'requirements' => "Valid KNC registration. Minimum 2 years experience in critical care. BLS/ACLS certification preferred.",
                'responsibilities' => "Patient assessment and care, medication administration, collaboration with multidisciplinary team.",
                'closing_date' => now()->addWeeks(4),
                'is_published' => true,
                'order' => 0,
            ],
            [
                'title' => 'Medical Officer – Casualty',
                'slug' => 'medical-officer-casualty',
                'department' => 'Casualty & Emergency',
                'location' => 'Tenwek Hospital, Bomet',
                'employment_type' => 'Full-time',
                'description' => "Tenwek Hospital seeks a Medical Officer to work in our busy Casualty and Emergency unit.",
                'requirements' => "MBChB or equivalent. Registered with KMPDC. Experience in emergency medicine an advantage.",
                'responsibilities' => "Triage, assessment, and management of emergency patients.",
                'closing_date' => now()->addWeeks(3),
                'is_published' => true,
                'order' => 1,
            ],
        ];

        foreach ($jobs as $job) {
            Career::firstOrCreate(
                ['slug' => $job['slug']],
                $job
            );
        }
    }
}
