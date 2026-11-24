<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Throwable;

/** One row per important admin action. Read-only in the admin panel (Super Admin). */
class ActivityLog extends Model
{
    use MassPrunable;

    public const UPDATED_AT = null;

    /** Keep the trail for this many days (cleaned by `php artisan model:prune`, scheduled daily). */
    public const RETENTION_DAYS = 365;

    public const EVENTS = [
        'created' => 'Menambah',
        'updated' => 'Mengubah',
        'deleted' => 'Menghapus',
        'login' => 'Login',
        'login_failed' => 'Gagal login',
        'logout' => 'Logout',
        'export' => 'Ekspor data',
    ];

    /** Friendly names for the logged models. */
    public const SUBJECTS = [
        Article::class => 'Artikel',
        ArticleCategory::class => 'Kategori Artikel',
        ArticleComment::class => 'Komentar',
        Product::class => 'Produk',
        LmsGroup::class => 'Kolom Produk LMS',
        Faq::class => 'FAQ',
        Setting::class => 'Pengaturan',
        User::class => 'Pengguna',
        Contact::class => 'Kontak Promosi',
        Category::class => 'Kategori Produk',
        Gallery::class => 'Galeri',
    ];

    protected $guarded = [];

    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subDays(self::RETENTION_DAYS));
    }

    public function getSubjectNameAttribute(): string
    {
        return self::SUBJECTS[$this->subject_type] ?? class_basename((string) $this->subject_type);
    }

    /**
     * Write a log row. Never throws: an audit failure must not break the admin action itself.
     */
    public static function record(string $event, ?Model $subject = null, array $changes = [], ?string $description = null, ?User $user = null, ?string $label = null): void
    {
        try {
            $user ??= auth()->user();

            static::create([
                'user_id' => $user?->id,
                'user_name' => $user?->name,
                'user_role' => $user?->role,
                'event' => $event,
                'subject_type' => $subject ? get_class($subject) : null,
                'subject_id' => $subject?->getKey(),
                'subject_label' => $label ?? ($subject && method_exists($subject, 'activityLabel') ? $subject->activityLabel() : null),
                'changes' => $changes ?: null,
                'description' => $description ? mb_substr($description, 0, 500) : null,
                'ip_address' => request()?->ip(),
            ]);
        } catch (Throwable $e) {
            report($e);
        }
    }
}
