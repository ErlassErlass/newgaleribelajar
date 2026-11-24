<?php

namespace App\Models;

use App\Support\SiteCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Throwable;

/**
 * Key/value site settings edited in the admin panel. Keys are config paths under "erlass."
 * (e.g. "shopee", "social.instagram", "videos") and override config/erlass.php at boot.
 */
class Setting extends Model
{
    use \App\Support\LogsActivity;

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = ['value' => 'json'];

    private const CACHE_KEY = 'site-settings';

    protected static function booted(): void
    {
        static::saved(fn () => self::forgetCache());
        static::deleted(fn () => self::forgetCache());
    }

    /** Readable names for the activity log. */
    public const LABELS = [
        'shopee' => 'Link toko Shopee',
        'lms' => 'Link LMS Erlass Academy',
        'whatsapp' => 'Nomor WhatsApp',
        'phone_display' => 'Nomor telepon',
        'email' => 'Email',
        'office_hours' => 'Jam layanan',
        'address_hq' => 'Alamat kantor pusat',
        'address_ops' => 'Alamat operasional',
        'social.instagram' => 'Instagram',
        'social.tiktok' => 'TikTok',
        'social.youtube' => 'YouTube',
        'social.facebook' => 'Facebook',
        'social.facebook_group' => 'Grup Facebook',
        'youtube_channel_id' => 'YouTube Channel ID',
        'videos' => 'Daftar video',
        'comments_auto_approve' => 'Komentar tampil otomatis',
        'blocked_words_extra' => 'Kata terlarang tambahan',
        'homepage' => 'Pengaturan Beranda',
    ];

    public function activityLabel(): string
    {
        return self::LABELS[$this->key] ?? $this->key;
    }

    /** @return array<string, mixed> key => value */
    public static function allCached(): array
    {
        try {
            return Cache::rememberForever(self::CACHE_KEY, function () {
                if (! Schema::hasTable('settings')) {
                    return [];
                }

                return self::query()->pluck('value', 'key')->all();
            });
        } catch (Throwable) {
            return []; // DB not reachable (fresh install, CI): fall back to config files
        }
    }

    /** Push stored settings into config('erlass.*') for this request. */
    public static function applyToConfig(): void
    {
        foreach (self::allCached() as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            if ($key === 'homepage' && is_array($value)) {
                // Homepage content: merge over config/homepage.php so new default fields keep working
                $merged = array_replace_recursive(config('homepage', []), $value);
                // Lists are replaced whole, not merged item by item
                if (isset($value['hero']['slides'])) {
                    $merged['hero']['slides'] = array_values($value['hero']['slides']);
                }
                config(['homepage' => $merged]);

                continue;
            }
            config(['erlass.'.$key => $value]);
        }
    }

    public static function put(string $key, mixed $value): void
    {
        self::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function forgetCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        SiteCache::flush();
    }
}
