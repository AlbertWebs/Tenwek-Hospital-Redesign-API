<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtcService extends Model
{
    protected $table = 'ctc_services';

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'order', 'is_visible'];

    protected $casts = [
        'order' => 'integer',
        'is_visible' => 'boolean',
    ];
}
