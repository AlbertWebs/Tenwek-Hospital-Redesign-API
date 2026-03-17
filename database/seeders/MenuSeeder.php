<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $header = Menu::firstOrCreate(
            ['key' => 'header'],
            ['name' => 'Header Menu', 'location' => 'header', 'description' => 'Main navigation']
        );
        $header->update(['location' => 'header']);

        $items = [
            ['label' => 'Home', 'route' => 'home', 'url' => null, 'order' => 0],
            ['label' => 'About Tenwek', 'route' => 'about.tenwek', 'url' => null, 'order' => 1],
            ['label' => 'Cardiothoracic Centre', 'route' => 'ctc.overview', 'url' => null, 'order' => 2],
            ['label' => 'Clinical Services', 'route' => 'clinical-services.index', 'url' => null, 'order' => 3],
            ['label' => 'Training', 'route' => 'training.index', 'url' => null, 'order' => 4],
            ['label' => 'Community & Mission', 'route' => 'community.index', 'url' => null, 'order' => 5],
            ['label' => 'News', 'route' => 'news.index', 'url' => null, 'order' => 6],
            ['label' => 'Careers', 'route' => 'careers.index', 'url' => null, 'order' => 7],
            ['label' => 'Contact', 'route' => 'contact.index', 'url' => null, 'order' => 8],
        ];

        MenuItem::where('menu_id', $header->id)->delete();
        foreach ($items as $item) {
            MenuItem::create([
                'menu_id' => $header->id,
                'label' => $item['label'],
                'route' => $item['route'],
                'url' => $item['url'],
                'order' => $item['order'],
                'is_visible' => true,
            ]);
        }

        $footer = Menu::firstOrCreate(
            ['key' => 'footer'],
            ['name' => 'Footer Menu', 'location' => 'footer', 'description' => 'Footer links']
        );
        $footer->update(['location' => 'footer']);

        $footerItems = [
            ['label' => 'About Tenwek', 'route' => 'about.tenwek', 'order' => 0],
            ['label' => 'Mission & Vision', 'route' => 'about.mission', 'order' => 1],
            ['label' => 'Contact', 'route' => 'contact.index', 'order' => 2],
            ['label' => 'Visiting Hours', 'route' => 'contact.visiting', 'order' => 3],
            ['label' => 'Donate', 'url' => '/contact#donate', 'route' => null, 'order' => 4],
            ['label' => 'Book Appointment', 'route' => 'book-appointment', 'order' => 5],
        ];

        MenuItem::where('menu_id', $footer->id)->delete();
        foreach ($footerItems as $item) {
            MenuItem::create([
                'menu_id' => $footer->id,
                'label' => $item['label'],
                'route' => $item['route'] ?? null,
                'url' => $item['url'] ?? null,
                'order' => $item['order'],
                'is_visible' => true,
            ]);
        }
    }
}
