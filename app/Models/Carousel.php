<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carousel extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function slides(): HasMany
    {
        return $this->hasMany(CarouselSlide::class)->orderBy('sort_order')->orderBy('id');
    }
}
