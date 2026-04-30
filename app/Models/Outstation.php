<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outstation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'summary',
        'content',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'order',
        'is_published',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_published' => 'boolean',
        'order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function hasMapCoordinates(): bool
    {
        return $this->latitude !== null
            && $this->longitude !== null
            && $this->latitude != 0
            && $this->longitude != 0;
    }
}
