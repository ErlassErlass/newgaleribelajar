<?php

namespace App\Support;

/**
 * Flags comments that need a human look before they go live:
 * blocked words (config/moderation.php), links, or text written all in capitals.
 */
class CommentModeration
{
    /** @return string|null reason the comment was flagged, or null when it looks fine */
    public static function check(string $name, string $body): ?string
    {
        $text = mb_strtolower($name.' '.$body);
        // Undo common obfuscation: 4nj1ng, a.n.j.i.n.g, anjiiing
        $plain = strtr($text, ['4' => 'a', '1' => 'i', '!' => 'i', '3' => 'e', '0' => 'o', '5' => 's', '@' => 'a', '$' => 's']);
        $words = preg_split('/[^a-z]+/', $plain, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $words = array_map(fn ($w) => preg_replace('/(.)\1{2,}/', '$1', $w), $words);
        $squashed = implode('', $words);

        $blocked = array_merge(
            (array) config('moderation.blocked_words', []),
            (array) config('erlass.blocked_words_extra', []) // added by admins in Pengaturan Situs
        );

        foreach ($blocked as $phrase) {
            $phrase = mb_strtolower(trim((string) $phrase));
            if ($phrase === '') {
                continue;
            }
            $needle = preg_replace('/[^a-z]/', '', $phrase);
            // Short words must match a whole word ("tai" must not hit "pantai");
            // longer ones are also caught when spaced or dotted out.
            $hit = strlen($needle) <= 4
                ? in_array($needle, $words, true) || str_contains(' '.implode(' ', $words).' ', ' '.$phrase.' ')
                : str_contains($squashed, $needle);
            if ($hit) {
                return 'Mengandung kata tidak pantas';
            }
        }

        if (preg_match('#https?://|www\.#i', $body)) {
            return 'Mengandung tautan';
        }

        $letters = preg_replace('/[^a-zA-Z]/', '', $body);
        if (strlen($letters) > 20 && strtoupper($letters) === $letters) {
            return 'Ditulis huruf kapital semua';
        }

        return null;
    }
}
