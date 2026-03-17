<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Services\PublicPagesSync;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure every public site page has a Page record so each can be edited individually.
        PublicPagesSync::sync();

        $pages = [
            [
                'title' => 'Patient Guide',
                'slug' => 'patient-guide',
                'template' => 'default',
                'status' => 'published',
                'meta_title' => 'Patient Guide | Tenwek Hospital',
                'meta_description' => 'Information for patients and visitors at Tenwek Hospital.',
                'order' => 0,
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'template' => 'contact',
                'status' => 'published',
                'meta_title' => 'Contact Us | Tenwek Hospital',
                'meta_description' => 'Get in touch with Tenwek Hospital. Phone, email, visiting hours.',
                'order' => 1,
            ],
        ];

        foreach ($pages as $data) {
            $page = Page::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            if ($page->slug === 'patient-guide' && $page->sections()->count() === 0) {
                $page->sections()->createMany([
                    ['type' => 'hero', 'name' => 'Welcome', 'order' => 0, 'content' => ['heading' => 'Patient Guide', 'subheading' => 'Your care, our mission']],
                    ['type' => 'text', 'name' => 'Introduction', 'order' => 1, 'content' => ['body' => '<p>This guide helps you prepare for your visit to Tenwek Hospital. We are committed to providing compassionate, quality care.</p>']],
                    ['type' => 'cta', 'name' => 'Contact CTA', 'order' => 2, 'content' => ['title' => 'Need help?', 'button_text' => 'Contact us', 'button_url' => '/contact']],
                ]);
            }
        }
    }
}
