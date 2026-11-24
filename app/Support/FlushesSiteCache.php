<?php

namespace App\Support;

/** Add to any model shown on public pages: saving or deleting it refreshes the page caches. */
trait FlushesSiteCache
{
    public static function bootFlushesSiteCache(): void
    {
        static::saved(fn () => SiteCache::flush());
        static::deleted(fn () => SiteCache::flush());
    }
}
