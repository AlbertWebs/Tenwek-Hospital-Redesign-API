<?php

namespace App\Services;

use App\Models\Page;

class PublicPagesSync
{
    /**
     * Create or update Page records for every entry in config('public-pages.pages').
     * Each public page gets its own record so it can be edited individually in the admin.
     */
    public static function sync(): int
    {
        $items = config('public-pages.pages', []);
        $count = 0;

        foreach ($items as $item) {
            $path = $item['path'];
            $slug = $path === '' ? 'home' : $path;
            $pageType = $item['type'] ?? 'managed';
            $listingType = $item['listing_type'] ?? null;

            Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $item['title'],
                    'template' => static::templateForPath($path),
                    'page_type' => $pageType,
                    'listing_type' => $listingType,
                    'status' => 'published',
                    'meta_title' => ($item['meta_title'] ?? null) ?: $item['title'] . ' | Tenwek Hospital',
                    'meta_description' => $item['meta_description'] ?? null,
                    'order' => $item['order'] ?? 0,
                ]
            );
            $count++;
        }

        return $count;
    }

    protected static function templateForPath(string $path): string
    {
        if ($path === '' || $path === 'home') return 'home';
        if (str_starts_with($path, 'contact')) return 'contact';
        return 'default';
    }
}
