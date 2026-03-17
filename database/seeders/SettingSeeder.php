<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Tenwek Hospital', 'type' => 'string'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'We Treat ~ Jesus Heals', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'phone_primary', 'value' => '0700 499 699', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'phone_alt', 'value' => '0740 346 537 / 0728 091 900', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'email', 'value' => 'customer.experience@tenwekhosp.org', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'address', 'value' => 'P.O Box 39-20400 Bomet, Kenya', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'ambulance_phone', 'value' => '0727 033 725', 'type' => 'string'],
            ['group' => 'social', 'key' => 'twitter', 'value' => 'https://twitter.com/tenwekhospital', 'type' => 'string'],
            ['group' => 'social', 'key' => 'facebook', 'value' => 'https://www.facebook.com/tenwekhospital', 'type' => 'string'],
            ['group' => 'social', 'key' => 'youtube', 'value' => 'https://www.youtube.com/tenwekhospital', 'type' => 'string'],
            ['group' => 'social', 'key' => 'instagram', 'value' => 'https://www.instagram.com/tenwekhospital', 'type' => 'string'],
            ['group' => 'seo', 'key' => 'meta_title_default', 'value' => 'Tenwek Hospital | We Treat ~ Jesus Heals', 'type' => 'string'],
            ['group' => 'seo', 'key' => 'meta_description_default', 'value' => 'Tenwek Hospital is a Level 5 Teaching and Referral Mission Hospital in Bomet County, Kenya. Compassionate healthcare, cardiothoracic centre, training.', 'type' => 'string'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(
                ['key' => $s['key']],
                $s
            );
        }
    }
}
