<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $items = [
            ['name' => 'Tenwek Hospital building', 'file_name' => 'tenwek-building.jpg', 'path' => 'demo/tenwek-building.jpg', 'mime_type' => 'image/jpeg', 'size' => 0, 'alt' => 'Tenwek Hospital'],
            ['name' => 'Cardiac surgery', 'file_name' => 'cardiac-surgery.jpg', 'path' => 'demo/cardiac-surgery.jpg', 'mime_type' => 'image/jpeg', 'size' => 0, 'alt' => 'Cardiac surgery at CTC'],
            ['name' => 'Team photo', 'file_name' => 'team.jpg', 'path' => 'demo/team.jpg', 'mime_type' => 'image/jpeg', 'size' => 0, 'alt' => 'Tenwek team'],
        ];

        foreach ($items as $item) {
            Media::firstOrCreate(
                ['path' => $item['path']],
                array_merge($item, ['disk' => 'public', 'caption' => null, 'user_id' => $user?->id])
            );
        }
    }
}
