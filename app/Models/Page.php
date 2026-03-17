<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'template',
        'page_type',
        'listing_type',
        'status',
        'meta_title',
        'meta_description',
        'intro',
        'og_image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    public function isManaged(): bool
    {
        return ($this->page_type ?? 'managed') === 'managed';
    }

    public function isListing(): bool
    {
        return ($this->page_type ?? 'managed') === 'listing';
    }

    /**
     * Get admin route for listing pages (e.g. admin.careers.index, admin.posts.index).
     */
    public function getListingAdminRoute(): ?string
    {
        $map = [
            'careers' => 'admin.careers.index',
            'news' => 'admin.posts.index',
        ];
        return $map[$this->listing_type ?? ''] ?? null;
    }

    /**
     * Get label for "Manage Content" (e.g. "Manage Jobs", "Manage Posts").
     */
    public function getListingAdminLabel(): ?string
    {
        $map = [
            'careers' => 'Manage Jobs',
            'news' => 'Manage Posts',
        ];
        return $map[$this->listing_type ?? ''] ?? 'Manage Content';
    }
}
