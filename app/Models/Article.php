<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use \App\Support\HasEnglishContent;

    /** Columns with an English twin (<field>_en) shown on the public site in EN. See HasEnglishContent. */
    protected array $englishFields = ['title', 'excerpt', 'body'];

    use \App\Support\LogsActivity;

    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'is_pinned' => 'boolean',
        'pinned_at' => 'datetime',
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_REVIEW = 'review';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_REJECTED = 'rejected';

    public const STATUSES = [
        self::STATUS_DRAFT => 'Draf',
        self::STATUS_REVIEW => 'Menunggu Persetujuan',
        self::STATUS_PUBLISHED => 'Terbit',
        self::STATUS_REJECTED => 'Perlu Revisi',
    ];

    /** Brand hashtags appended to every share so all posts build one searchable stream. */
    public const BRAND_TAGS = ['ErlassAcademy', 'ErlassProkreatif'];

    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('published_at');
    }

    /** Pinned articles first (latest pin on top), then newest. Replaces any earlier ordering. */
    /** What article cards show: everything except the long bodies, so listings stay light as articles grow. */
    public const CARD_COLUMNS = [
        'id', 'title', 'title_en', 'slug', 'category', 'excerpt', 'excerpt_en', 'cover_image', 'tags', 'views',
        'is_published', 'is_pinned', 'pinned_at', 'published_at', 'created_at', 'updated_at',
    ];

    public function scopeForCards(Builder $query): Builder
    {
        return $query->select(array_map(fn ($c) => $this->getTable().'.'.$c, self::CARD_COLUMNS));
    }

    public function scopePinnedFirst(Builder $query): Builder
    {
        return $query->reorder()
            ->orderByDesc('is_pinned')
            ->orderByDesc('pinned_at')
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            // Rows created without a status (seeders, imports) follow their is_published flag
            if (! $article->status) {
                $article->status = $article->is_published ? self::STATUS_PUBLISHED : self::STATUS_DRAFT;
            }
            // The public site only reads is_published; keep it in step with the review status
            if ($article->isDirty('status') || ! $article->exists) {
                $article->is_published = $article->status === self::STATUS_PUBLISHED;
                if ($article->is_published && ! $article->published_at) {
                    $article->published_at = now();
                }
            }
            // Only live articles can stay pinned
            if (! $article->is_published) {
                $article->is_pinned = false;
            }
            // Keep pinned_at in step with is_pinned however the flag is changed
            if ($article->isDirty('is_pinned')) {
                $article->pinned_at = $article->is_pinned ? now() : null;
            }
        });

        static::saved(fn () => \App\Support\SiteCache::flush());
        static::deleted(fn () => \App\Support\SiteCache::flush());
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function scopeWithTag(Builder $query, string $tag): Builder
    {
        return $query->whereJsonContains('tags', $tag);
    }

    public function getCategoryLabelAttribute(): string
    {
        // Categories are managed in the admin (ArticleCategory); include inactive ones for old articles
        return ArticleCategory::options(false)[$this->category] ?? ucfirst(str_replace('-', ' ', (string) $this->category));
    }

    /** @return string[] */
    public function getParagraphsAttribute(): array
    {
        return array_values(array_filter(array_map('trim', preg_split("/\R\s*\R/", (string) $this->body))));
    }

    /** Article tags plus brand tags, unique, without '#'. */
    public function getShareTagsAttribute(): array
    {
        return array_values(array_unique(array_merge($this->tags ?? [], self::BRAND_TAGS)));
    }

    public function getSeoTitleAttribute(): string
    {
        // The meta fields are written in Indonesian: in English, use the translated title instead
        $meta = static::wantsEnglishContent() && $this->hasEnglish('title') ? null : $this->meta_title;

        return $meta ?: Str::limit($this->title, 60, '');
    }

    public function getSeoDescriptionAttribute(): string
    {
        $meta = static::wantsEnglishContent() && ($this->hasEnglish('excerpt') || $this->hasEnglish('body')) ? null : $this->meta_description;

        return $meta ?: Str::limit($this->excerpt ?: strip_tags($this->body), 160);
    }

    public function getReadMinutesAttribute(): int
    {
        return max(1, (int) ceil(str_word_count((string) $this->body) / 200));
    }

    /** Older neighbour in the published timeline. */
    public function previousArticle(): ?self
    {
        return static::published()
            ->forCards()
            ->where('published_at', '<', $this->published_at)
            ->first();
    }

    /** Newer neighbour in the published timeline. */
    public function nextArticle(): ?self
    {
        return static::query()
            ->forCards()
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->where('published_at', '>', $this->published_at)
            ->orderBy('published_at')
            ->first();
    }
}
