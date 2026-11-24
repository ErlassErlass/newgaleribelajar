<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleComment extends Model
{
    use \App\Support\LogsActivity;

    protected $guarded = [];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_flagged' => 'boolean',
        'marketing_consent' => 'boolean',
    ];

    protected $hidden = ['email', 'ip_address'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->approved()->oldest();
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('is_approved', true);
    }

    public function getInitialsAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->name)) ?: [];
        $initials = mb_substr($parts[0] ?? '?', 0, 1).(isset($parts[1]) ? mb_substr($parts[1], 0, 1) : '');

        return mb_strtoupper($initials);
    }
}
