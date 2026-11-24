<?php

/*
| Comment moderation. A comment matching any of these is held back (not shown publicly)
| and appears as "Perlu Ditinjau" in the admin Comments screen. Admins can also add
| words from the Pengaturan Situs page; both lists are used.
| Words of 4 letters or fewer are matched as whole words only ("tai" does not hit "pantai").
*/

return [
    'blocked_words' => [
        // Umpatan & kata kasar umum
        'anjing', 'anjir', 'bangsat', 'bajingan', 'babi', 'kampret', 'keparat', 'brengsek',
        'tolol', 'goblok', 'goblog', 'bego', 'idiot', 'dungu', 'sinting',
        'kontol', 'memek', 'ngentot', 'entot', 'jembut', 'pepek', 'titit', 'pantek',
        'lonte', 'pelacur', 'jablay', 'perek', 'bencong', 'asu', 'jancok', 'jancuk',
        'tai', 'taik', 'bacot',
        // Judi online & spam
        'slot gacor', 'judi online', 'togel', 'maxwin', 'casino', 'kasino', 'pinjol',
        // English
        'fuck', 'shit', 'bitch', 'asshole', 'porn',
    ],
];
