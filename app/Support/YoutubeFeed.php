<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Reads the channel's public RSS feed (latest ~15 videos) for view counts and publish dates.
 * Cached for 6 hours; any failure just returns no stats, so the page never breaks.
 */
class YoutubeFeed
{
    /** @return array<string, array{views: ?int, published: ?string}> keyed by video id */
    public static function stats(): array
    {
        $channel = config('erlass.youtube_channel_id');
        if (! $channel) {
            return [];
        }

        return Cache::remember("youtube.feed.{$channel}", now()->addHours(6), function () use ($channel) {
            try {
                $res = Http::timeout(5)->get('https://www.youtube.com/feeds/videos.xml', ['channel_id' => $channel]);
                if (! $res->successful()) {
                    return [];
                }
                $xml = @simplexml_load_string($res->body());
                if (! $xml) {
                    return [];
                }

                $out = [];
                foreach ($xml->entry as $entry) {
                    $yt = $entry->children('http://www.youtube.com/xml/schemas/2015');
                    $media = $entry->children('http://search.yahoo.com/mrss/');
                    $id = (string) $yt->videoId;
                    $stats = $media->group?->community?->statistics;
                    $out[$id] = [
                        'views' => $stats ? (int) $stats->attributes()->views : null,
                        'published' => (string) $entry->published ?: null,
                    ];
                }

                return $out;
            } catch (Throwable) {
                return [];
            }
        });
    }

    /** Configured videos (with an id), enriched with feed stats when available. */
    public static function videos(): array
    {
        $stats = self::stats();

        return array_values(array_map(
            fn ($v) => $v + ($stats[$v['youtube_id']] ?? ['views' => null, 'published' => null]),
            array_filter(config('erlass.videos', []), fn ($v) => ! empty($v['youtube_id']))
        ));
    }
}
