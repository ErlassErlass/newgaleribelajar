<?php

namespace App\Models;

use App\Support\FlushesSiteCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class ArticleCategory extends Model
{
    use \App\Support\LogsActivity;

    use FlushesSiteCache;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    private const CACHE_KEY = 'article-categories';

    protected static function booted(): void
    {
        // Renaming a slug moves its articles along, so none end up without a category
        static::updated(function (ArticleCategory $category) {
            if ($category->wasChanged('slug')) {
                Article::where('category', $category->getOriginal('slug'))->update(['category' => $category->slug]);
            }
        });
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category', 'slug');
    }

    /**
     * slug => name. Active categories for filters and forms; pass false to include
     * inactive ones too (so old articles still show their label).
     *
     * @return array<string, string>
     */
    public static function options(bool $activeOnly = true): array
    {
        $all = Cache::rememberForever(self::CACHE_KEY, fn () => self::query()
            ->orderBy('sort_order')->orderBy('name')
            ->get(['slug', 'name', 'is_active'])
            ->map(fn ($c) => ['slug' => $c->slug, 'name' => $c->name, 'active' => $c->is_active])
            ->all());

        return collect($all)
            ->when($activeOnly, fn ($c) => $c->where('active', true))
            ->pluck('name', 'slug')
            ->all();
    }
}
