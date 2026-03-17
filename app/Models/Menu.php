<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = ['name', 'key', 'location', 'description'];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->whereNull('parent_id')->orderBy('order');
    }

    public function allItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->orderBy('order');
    }

    /** Get menu by location (header, footer). */
    public static function getByLocation(string $location): ?self
    {
        return self::where('location', $location)->first();
    }
}
