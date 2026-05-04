<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CarouselSlide extends Model
{
    protected $fillable = ['carousel_id', 'sort_order', 'image_path', 'disk', 'alt_text'];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::deleting(function (CarouselSlide $slide) {
            $slide->deleteImageFile();
        });
    }

    public function carousel(): BelongsTo
    {
        return $this->belongsTo(Carousel::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/'.$this->image_path);
    }

    public function deleteImageFile(): void
    {
        if ($this->image_path === '') {
            return;
        }
        $disk = $this->disk ?: 'public';
        if (Storage::disk($disk)->exists($this->image_path)) {
            Storage::disk($disk)->delete($this->image_path);
        }
    }
}
