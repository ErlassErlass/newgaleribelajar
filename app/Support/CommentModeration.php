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
        $sentence = ' '.implode(' ', $words).' ';

        // "Pieces" searched for longer blocked words: every word on its own ("goblokkk", "anjingnya"),
        // plus runs of spelled-out single letters joined up ("a n j i n g", "a.n.j.i.n.g").
        // Words are never glued to their neighbours, so "Kusuma Bangsa Tajur" does not become "bangsat".
        $pieces = $words;
        $run = '';
        foreach ([...$words, ''] as $w) {
            if (strlen($w) === 1) {
                $run .= $w;
                continue;
            }
            if (strlen($run) > 1) {
                $pieces[] = $run;
            }
            $run = '';
        }

        $blocked = array_merge(
            (array) config('moderation.blocked_words', []),
            (array) config('erlass.blocked_words_extra', []) // added by admins in Pengaturan Situs
        );

        foreach ($blocked as $phrase) {
            $phrase = trim(preg_replace('/[^a-z]+/', ' ', mb_strtolower((string) $phrase)));
            if ($phrase === '') {
                continue;
            }
            if (strlen($phrase) <= 4) {
                // Short words: whole words only ("tai" must not hit "pantai")
                $hit = str_contains($sentence, ' '.$phrase.' ');
            } else {
                // Phrases match as written ("slot gacor") or glued into one word ("slotgacor88")
                $hit = str_contains($phrase, ' ') && str_contains($sentence, ' '.$phrase.' ');
                $needle = str_replace(' ', '', $phrase);
                foreach ($hit ? [] : $pieces as $piece) {
                    if (str_contains($piece, $needle)) {
                        $hit = true;
                        break;
                    }
                }
            }
            if ($hit) {
                return 'Mengandung kata tidak pantas';
            }
        }

        // Whole words/phrases only: words that also appear inside harmless words
        foreach ((array) config('moderation.blocked_words_whole', []) as $phrase) {
            $phrase = trim(preg_replace('/[^a-z]+/', ' ', mb_strtolower((string) $phrase)));
            if ($phrase !== '' && str_contains($sentence, ' '.$phrase.' ')) {
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
