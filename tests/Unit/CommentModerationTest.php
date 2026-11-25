<?php

namespace Tests\Unit;

use App\Support\CommentModeration;
use Tests\TestCase;

class CommentModerationTest extends TestCase
{
    public function test_rude_toxic_and_spam_comments_are_held(): void
    {
        foreach ([
            'Dasar 4nj1ng lu', 'a.n.j.i.n.g', 'b a n g s a t', 'kamu goblokkk', 'bgst emang', 'dasar bodoh',
            'gw bunuh lu', 'slot gacor maxwin', 'slotgacor88 bos', 'situs judol', 'fucking stupid',
            'kurang ajar banget', 'k0nt0l', 'perek', 'sange',
        ] as $text) {
            $this->assertNotNull(CommentModeration::check('Budi', $text), "should be held: $text");
        }
    }

    public function test_normal_comments_pass(): void
    {
        foreach ([
            'Perekonomian Indonesia tumbuh', 'Mengocok telur untuk kue', 'Membeli setangkai bunga',
            'Liburan ke pantai', 'Program sosial anak sekolah', 'Pasang energi positif',
            'SMPS Kusuma Bangsa Tajurhalang', 'Terima kasih Erlass, sangat membantu guru',
            'Kapan pendaftaran kompetisi dibuka?', 'Peringkat sekolah kami naik',
        ] as $text) {
            $this->assertNull(CommentModeration::check('Budi', $text), "should pass: $text");
        }
    }
}
