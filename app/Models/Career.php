<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'employment_type',
        'description',
        'requirements',
        'responsibilities',
        'closing_date',
        'is_published',
        'order',
    ];

    protected $casts = [
        'closing_date' => 'date',
        'is_published' => 'boolean',
        'order' => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOpen($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('closing_date')->orWhere('closing_date', '>=', now()->toDateString());
        });
    }
}
