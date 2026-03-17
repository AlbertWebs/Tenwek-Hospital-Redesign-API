<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    protected $fillable = ['page_id', 'type', 'name', 'order', 'content', 'settings'];

    protected $casts = [
        'content' => 'array',
        'settings' => 'array',
        'order' => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
