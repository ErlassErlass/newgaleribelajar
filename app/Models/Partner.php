<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodlan',
        'name',
        'slug',
        'city',
        'province',
        'level',
        'type',
        'logo_url',
        'website',
        'total_deals',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'total_deals' => 'integer',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($partner) {
            if (empty($partner->slug)) {
                $partner->slug = Str::slug($partner->name . ($partner->city ? '-' . $partner->city : ''));
            }
        });
    }
}

