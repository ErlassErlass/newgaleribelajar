<?php

namespace App\Models;

use App\Support\FlushesSiteCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** A column in the homepage "Produk Digital di LMS" section. */
class LmsGroup extends Model
{
    use \App\Support\LogsActivity;

    use FlushesSiteCache;

    /** Reserved group: shown as the green "Gratis untuk Guru" banner above the columns, not as a column. */
    public const BANNER = 'sumber-guru';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        // Renaming a slug keeps its products in the column
        static::updated(function (LmsGroup $group) {
            if ($group->wasChanged('slug')) {
                Product::where('lms_group', $group->getOriginal('slug'))->update(['lms_group' => $group->slug]);
            }
        });
        // Deleting a column releases its products (they stay in the catalog)
        static::deleting(fn (LmsGroup $group) => Product::where('lms_group', $group->slug)->update(['lms_group' => null]));
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'lms_group', 'slug')->orderBy('lms_order')->orderBy('name');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    /** slug => title for the product form, including the banner slot. @return array<string, string> */
    public static function options(): array
    {
        return self::query()->orderBy('sort_order')->pluck('title', 'slug')->all()
            + [self::BANNER => 'Banner "Gratis untuk Guru" (di atas kolom)'];
    }
}
