<?php

namespace App\Support;

use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Cache for public page data (homepage lists, catalog counts, llms.txt...).
 * Every key carries a version number; flush() bumps the version, so any admin edit
 * makes all public pages fresh on the next request without tracking individual keys.
 */
class SiteCache
{
    private const VERSION_KEY = 'site-cache.version';

    public static function remember(string $key, int $seconds, Closure $callback): mixed
    {
        return Cache::remember(self::key($key), $seconds, $callback);
    }

    public static function flush(): void
    {
        Cache::forever(self::VERSION_KEY, self::version() + 1);
    }

    private static function key(string $key): string
    {
        return 'site-cache.'.self::version().'.'.$key;
    }

    private static function version(): int
    {
        return (int) Cache::get(self::VERSION_KEY, 1);
    }
}
