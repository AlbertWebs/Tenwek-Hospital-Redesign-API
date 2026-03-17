<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'label',
        'url',
        'route',
        'page_id',
        'open_in_new_tab',
        'icon',
        'css_class',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'open_in_new_tab' => 'boolean',
        'is_visible' => 'boolean',
        'order' => 'integer',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    /** Resolved href: page slug, route, or url. */
    public function getHrefAttribute(): string
    {
        if ($this->page_id && $this->relationLoaded('page') && $this->page) {
            $slug = $this->page->slug;
            return $slug === 'home' ? url('/') : url('/' . $slug);
        }
        if (!empty($this->route) && \Illuminate\Support\Facades\Route::has($this->route)) {
            return route($this->route);
        }
        return $this->url ?? '#';
    }

    /** Target attribute for links. */
    public function getTargetAttribute(): string
    {
        return $this->open_in_new_tab ? '_blank' : '_self';
    }
}
