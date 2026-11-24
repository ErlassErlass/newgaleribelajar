<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use \App\Support\LogsActivity;

    use \App\Support\FlushesSiteCache;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'taken_at' => 'date',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        return Str::startsWith($this->image_path, ['http://', 'https://'])
            ? $this->image_path
            : asset($this->image_path);
    }

    public function getCategoryLabelAttribute(): string
    {
        return config("gallery.categories.{$this->category}.label", 'Umum');
    }

    public function getSubcategoryLabelAttribute(): ?string
    {
        return $this->subcategory
            ? config("gallery.categories.{$this->category}.subs.{$this->subcategory}")
            : null;
    }
}
