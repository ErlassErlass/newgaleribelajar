<?php

/*
| Comment moderation. A comment matching any of these is held back (not shown publicly)
| and appears as "Perlu Ditinjau" in the admin Comments screen, where an admin can still
| approve it. Admins can also add words from the Pengaturan Situs page; all lists are used.
|
| Matching ignores letter case, repeated letters (anjiiing), common number/symbol swaps (4nj1ng)
| and dots or spaces between letters.
|
| - blocked_words: also caught inside longer text, so only distinctive words go here
|   (words of 4 letters or fewer are still matched as whole words only).
| - blocked_words_whole: matched as whole words/phrases only. Use this for words that appear
|   inside normal words, e.g. "perek" (perekonomian), "sange" (pasang energi), "sialan" (sosial anak).
*/

return [
    'blocked_words' => [
        // Umpatan & makian
        'anjing', 'anjir', 'bangsat', 'bajingan', 'kampret', 'keparat', 'brengsek', 'bedebah',
        'cecunguk', 'kunyuk', 'tolol', 'goblok', 'goblog', 'idiot', 'dungu', 'sinting',
        'jancok', 'jancuk', 'diancuk', 'dancok', 'bacot', 'pukimak', 'cukimai', 'kimak',
        'belegug', 'keparat',
        // Kata cabul / tidak senonoh
        'kontol', 'memek', 'ngentot', 'entot', 'jembut', 'pepek', 'pantek', 'titit',
        'lonte', 'pelacur', 'jablay', 'bencong', 'sundal', 'bokep', 'porno', 'masturbasi',
        'onani', 'ngaceng', 'colmek',
        // Judi online, pinjol & spam
        'slot gacor', 'judi online', 'judi bola', 'togel', 'maxwin', 'casino', 'kasino',
        'pinjol', 'judol', 'gacor', 'sbobet', 'bandar togel', 'situs slot', 'slot online',
        'bonus new member', 'deposit pulsa', 'pragmatic play', 'link alternatif',
        'obat aborsi', 'cytotec', 'viagra',
        // English
        'fucking', 'fucker', 'fucked', 'motherfucker', 'asshole', 'bitch', 'bastard',
        'dickhead', 'faggot', 'nigger', 'nigga', 'whore', 'pussy', 'retard', 'dumbass',
        'shit', 'porn', 'fuck',
    ],

    'blocked_words_whole' => [
        // Singkatan & plesetan umpatan
        'anj', 'anjg', 'ajg', 'njir', 'njing', 'anjay', 'bgst', 'bngst', 'bgsd', 'kntl', 'mmk',
        'jnck', 'gblk', 'tlol', 'asw', 'asu', 'cok', 'jamput', 'cuki', 'puki', 'kehed', 'koplok',
        'babi', 'bego', 'bodoh', 'bloon', 'tai', 'taik', 'sialan', 'kurang ajar', 'kampungan',
        'otak udang', 'mampus', 'modar', 'matamu', 'ndasmu', 'raimu', 'pekok',
        'dasar bodoh', 'dasar babi', 'dasar monyet', 'dasar anjing', 'dasar goblok',
        // Cabul
        'perek', 'sange', 'ngewe', 'coli', 'toket', 'tetek', 'peler', 'pler', 'tempik', 'turuk',
        'itil', 'mesum', 'bugil', 'jilmek', 'jembud',
        // Ancaman, perundungan & kebencian (SARA)
        'bunuh diri', 'mati aja', 'mati saja', 'gue bunuh', 'gw bunuh', 'aku bunuh', 'bunuh lu',
        'bunuh kau', 'sampah masyarakat', 'kafir', 'kadrun', 'cebong', 'kampret lu',
        // Judi & spam
        'toto', 'zeus', 'scatter', 'jackpot', 'rtp', 'wd cepat', 'taruhan',
        // English
        'dick', 'cunt', 'slut', 'stupid', 'wtf', 'stfu', 'kys', 'kill yourself', 'go die',
    ],
];
