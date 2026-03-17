<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'order'];

    protected $casts = ['order' => 'integer'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_category_id');
    }
}
