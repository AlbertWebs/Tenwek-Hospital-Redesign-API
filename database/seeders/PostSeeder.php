<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $categories = [
            ['name' => 'News', 'slug' => 'news', 'order' => 0],
            ['name' => 'Announcements', 'slug' => 'announcements', 'order' => 1],
            ['name' => 'Stories', 'slug' => 'stories', 'order' => 2],
        ];
        foreach ($categories as $c) {
            PostCategory::firstOrCreate(['slug' => $c['slug']], $c);
        }

        $newsId = PostCategory::where('slug', 'news')->first()?->id;
        $storiesId = PostCategory::where('slug', 'stories')->first()?->id;

        $posts = [
            [
                'title' => 'Tenwek Hospital Earns ISO 9001:2015 Certification',
                'slug' => 'tenwek-iso-9001-2015-certification',
                'excerpt' => 'Tenwek Hospital has achieved ISO 9001:2015 certification, reflecting our commitment to quality management systems.',
                'body' => '<p>We are pleased to announce that Tenwek Hospital has been certified to the ISO 9001:2015 standard. This certification demonstrates our ongoing commitment to quality in healthcare delivery and continuous improvement.</p>',
                'post_category_id' => $newsId,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'meta_title' => 'Tenwek Hospital ISO 9001:2015 Certification',
                'user_id' => $user?->id,
            ],
            [
                'title' => 'AGC Tenwek Hospital Mental Health Conference 2025',
                'slug' => 'mental-health-conference-2025',
                'excerpt' => 'Join us for the Mental Health Conference 2025. A gathering for professionals and community members.',
                'body' => '<p>AGC Tenwek Hospital will host the Mental Health Conference 2025. Details on dates, registration, and programme will be shared soon.</p>',
                'post_category_id' => $newsId,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'user_id' => $user?->id,
            ],
            [
                'title' => 'CTC Fellowship Intake 2025 – Applications Open',
                'slug' => 'ctc-fellowship-intake-2025',
                'excerpt' => 'Applications are open for the Cardiothoracic Surgery Fellowship programme.',
                'body' => '<p>Our Cardiothoracic Centre is accepting applications for the Fellowship programme. Train with our team in adult and paediatric cardiac surgery.</p>',
                'post_category_id' => $newsId,
                'status' => 'published',
                'published_at' => now()->subDay(),
                'user_id' => $user?->id,
            ],
            [
                'title' => 'Escape from the Jaws of a Lion',
                'slug' => 'escape-from-the-jaws-of-a-lion',
                'excerpt' => 'A patient story of survival and the dedicated care at Tenwek.',
                'body' => '<p>This powerful story highlights the resilience of our patients and the skill of our teams. Content for presentation demo.</p>',
                'post_category_id' => $storiesId,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'user_id' => $user?->id,
            ],
            [
                'title' => 'Visiting Hours Update – March 2025',
                'slug' => 'visiting-hours-update-march-2025',
                'excerpt' => 'Updated visiting hours and guidelines for families and visitors.',
                'body' => '<p>Please note the updated visiting hours: Morning 6:00–6:45 am, Lunch 1:00–2:00 pm, Evening 4:00–5:00 pm.</p>',
                'post_category_id' => PostCategory::where('slug', 'announcements')->first()?->id,
                'status' => 'draft',
                'published_at' => null,
                'user_id' => $user?->id,
            ],
        ];

        foreach ($posts as $data) {
            Post::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
