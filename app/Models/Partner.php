<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use \App\Support\FlushesSiteCache;

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

        // Remove an uploaded logo file once it is replaced or the school is deleted
        static::updated(function (Partner $partner) {
            if ($partner->wasChanged('logo_url')) {
                static::deleteUploadedLogo($partner->getOriginal('logo_url'));
            }
        });
        static::deleted(fn (Partner $partner) => static::deleteUploadedLogo($partner->logo_url));
    }

    /** Public URL of the school logo, or null when none is set (an uploaded path or an external URL). */
    public function logoUrl(): ?string
    {
        $logo = trim((string) $this->logo_url);
        if ($logo === '') {
            return null;
        }

        return Str::startsWith($logo, ['http://', 'https://']) ? $logo : asset($logo);
    }

    protected static function deleteUploadedLogo(?string $path): void
    {
        if ($path && Str::startsWith($path, 'uploads/partners/')) {
            \Illuminate\Support\Facades\Storage::disk('uploads')->delete($path);
        }
    }
}

