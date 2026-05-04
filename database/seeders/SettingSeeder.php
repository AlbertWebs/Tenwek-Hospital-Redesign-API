<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('site_settings.items', []) as $key => $meta) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'group' => $meta['group'] ?? 'general',
                    'key' => $key,
                    'value' => (string) ($meta['default'] ?? ''),
                    'type' => 'string',
                ]
            );
        }

        $heroCarousel = [
            ['image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Tenwek Hospital care environment'],
            ['image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Clinical excellence'],
            ['image' => 'https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=1920&q=80', 'alt' => 'Hospital community'],
        ];

        foreach ([
            ['group' => 'hero', 'key' => 'hero_type', 'value' => 'video', 'type' => 'string'],
            ['group' => 'hero', 'key' => 'hero_video_embed_url', 'value' => 'https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1', 'type' => 'string'],
            ['group' => 'hero', 'key' => 'hero_carousel_slides', 'value' => json_encode($heroCarousel), 'type' => 'json'],
            ['group' => 'hero', 'key' => 'hero_managed_carousel_id', 'value' => '0', 'type' => 'integer'],
        ] as $row) {
            Setting::updateOrCreate(
                ['key' => $row['key']],
                $row
            );
        }
    }
}
