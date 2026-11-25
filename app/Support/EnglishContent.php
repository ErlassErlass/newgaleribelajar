<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Fills the English columns (products.summary_en/description_en, articles.title_en/excerpt_en/body_en)
 * for the seeded catalog and articles. Only empty English fields are written, so anything an admin
 * typed is never overwritten. Runs from the migration and the DatabaseSeeder; safe to run again.
 *
 * Products: the seeded texts follow a handful of sentence patterns, translated here with the product
 * name / code kept. Articles: the seeded ones are translated by slug. Texts that match nothing stay
 * empty (the page then shows Indonesian) and can be filled in the admin panel.
 */
class EnglishContent
{
    private const LEVELS = ['SD' => 'elementary school', 'SMP' => 'junior high school', 'SMA' => 'senior high school'];

    /**
     * @param  bool  $refreshGenerated  also rewrite English texts that are still exactly what an earlier
     *                                  version of this class generated (never ones an admin edited)
     * @return array{products: int, articles: int} rows updated
     */
    public static function fill(bool $refreshGenerated = false): array
    {
        $done = ['products' => 0, 'articles' => 0];

        // Products need every English column (name_en arrived in a second migration)
        if (Schema::hasColumn('products', 'name_en') && Schema::hasColumn('products', 'summary_en')) {
            foreach (DB::table('products')->get(['id', 'name', 'summary', 'description', 'name_en', 'summary_en', 'description_en']) as $p) {
                // The English texts mention the product by its English name
                $nameEn = filled($p->name_en) ? $p->name_en : self::productName((string) $p->name);
                $withName = fn (?string $text) => $text && $nameEn ? str_replace($p->name, $nameEn, $text) : $text;
                $summary = self::productText((string) $p->summary);
                $description = self::productText((string) $p->description);
                // Empty, or untouched output of the first run (generated before English names existed)
                $replace = fn (?string $current, ?string $generated) => blank($current) || ($refreshGenerated && $current === $generated);
                $set = array_filter([
                    'name_en' => blank($p->name_en) ? $nameEn : null,
                    'summary_en' => $replace($p->summary_en, $summary) ? $withName($summary) : null,
                    'description_en' => $replace($p->description_en, $description) ? $withName($description) : null,
                ]);
                // Nothing to change when the regenerated text is identical
                $set = array_filter($set, fn ($v, $k) => $v !== $p->{$k}, ARRAY_FILTER_USE_BOTH);
                if ($set) {
                    DB::table('products')->where('id', $p->id)->update($set);
                    $done['products']++;
                }
            }
        }

        if (Schema::hasColumn('articles', 'title_en')) {
            foreach (self::ARTICLES as $slug => $en) {
                $row = DB::table('articles')->where('slug', $slug)->first(['id', 'title_en', 'excerpt_en', 'body_en']);
                if (! $row) {
                    continue;
                }
                $set = array_filter([
                    'title_en' => blank($row->title_en) ? $en['title'] : null,
                    'excerpt_en' => blank($row->excerpt_en) ? $en['excerpt'] : null,
                    'body_en' => blank($row->body_en) ? $en['body'] : null,
                ]);
                if ($set) {
                    DB::table('articles')->where('id', $row->id)->update($set);
                    $done['articles']++;
                }
            }
        }

        SiteCache::flush();

        return $done;
    }

    /**
     * English name for a seeded product, or null when the name is already English / a brand
     * (Arduino Learning Kit, Python Course LMS, PTM …): the page then keeps the original name.
     */
    public static function productName(string $id): ?string
    {
        $id = trim($id);
        $levels = ['SD' => 'Elementary', 'SMP' => 'Junior High', 'SMA' => 'Senior High'];
        $level = fn (string $l) => $levels[$l] ?? $l;
        // Small fixes for the words inside names
        $words = fn (string $s) => strtr($s, ['Koding Scratch' => 'Scratch Coding', 'Modul' => 'Module', 'Sewa ' => 'Rented ']);

        $patterns = [
            '/^Asesmen Potensi, Minat dan Bakat Siswa Kelas (\S+)$/u' => fn ($m) => "Student Potential, Interest & Talent Assessment Grades {$m[1]}",
            '/^Informatika (SD|SMP|SMA)$/u' => fn ($m) => $level($m[1]).' Informatics',
            '/^Koding KA (SD|SMP|SMA)$/u' => fn ($m) => $level($m[1]).' AI Coding',
            '/^Inkul Informatika \+ Koding KA Kelas (\d+)$/u' => fn ($m) => "Informatics + AI Coding Curriculum Grade {$m[1]}",
            '/^Inkul Koding KA \+ Informatika Kelas (\d+)$/u' => fn ($m) => "AI Coding + Informatics Curriculum Grade {$m[1]}",
            '/^Inkul Coding Scratch$/u' => fn () => 'Scratch Coding Curriculum',
            '/^Modul LKPD TIK Jilid (\d+)$/u' => fn ($m) => "ICT Worksheet Module Vol. {$m[1]}",
            '/^Modul Scratch Jilid (\d+)$/u' => fn ($m) => "Scratch Module Vol. {$m[1]}",
            '/^Modul Project (.+)$/u' => fn ($m) => "{$m[1]} Project Module",
            '/^Modul (.+)$/u' => fn ($m) => "{$m[1]} Module",
            '/^Ekskul Robotik (.+)$/u' => fn ($m) => $words($m[1]).' Robotics Club',
            '/^Ekskul (.+)$/u' => fn ($m) => $words($m[1]).' Club',
            '/^Robotik (.+)$/u' => fn ($m) => "{$m[1]} Robotics",
            '/^Kursus LMS (.+)$/u' => fn ($m) => $words($m[1]).' LMS Course',
            '/^Projek IOT$/u' => fn () => 'IoT Project',
            '/^Pusat Sumber Daya Guru$/u' => fn () => 'Teacher Resource Center',
        ];

        foreach ($patterns as $re => $make) {
            if (preg_match($re, $id, $m)) {
                return $make($m);
            }
        }

        return null;
    }

    /** English for one seeded product summary/description, or null when it matches no known pattern. */
    public static function productText(string $id): ?string
    {
        $id = trim($id);
        if ($id === '') {
            return null;
        }
        $level = fn (string $l) => self::LEVELS[$l] ?? $l;
        $name = fn (string $n) => preg_replace('/^Asesmen Potensi, Minat dan Bakat (.+)$/u', 'Potential, Interest and Talent Assessment $1', $n);

        $patterns = [
            '/^Program edukasi teknologi (.+) untuk meningkatkan kompetensi digital generasi muda\.$/u'
                => fn ($m) => "{$m[1]} is a technology education program that builds digital skills for the next generation.",
            '/^Asesmen potensi, minat, dan bakat berbasis LMS Erlass Academy untuk siswa kelas (\S+), dengan laporan hasil untuk sekolah dan orang tua\.$/u'
                => fn ($m) => "A potential, interest, and talent assessment on the Erlass Academy LMS for grades {$m[1]}, with result reports for schools and parents.",
            '/^Kumpulan perangkat ajar, modul, dan materi pendukung guru Informatika & Koding yang dapat diakses gratis di LMS Erlass Academy\.$/u'
                => fn () => 'A collection of teaching kits, modules, and support materials for Informatics & Coding teachers, free to access on the Erlass Academy LMS.',
            '/^Intrakurikuler Informatika berbasis LMS Erlass Academy untuk jenjang (SD|SMP|SMA): materi, aktivitas, dan asesmen siap pakai sesuai Kurikulum Merdeka\.$/u'
                => fn ($m) => "Informatics curriculum on the Erlass Academy LMS for {$level($m[1])}: ready-to-use materials, activities, and assessments aligned with the Merdeka Curriculum.",
            '/^Intrakurikuler Koding & Kecerdasan Artifisial \(KA\) berbasis LMS Erlass Academy untuk jenjang (SD|SMP|SMA): berpikir komputasional, pemrograman, dan pengenalan AI\.$/u'
                => fn ($m) => "Coding & Artificial Intelligence curriculum on the Erlass Academy LMS for {$level($m[1])}: computational thinking, programming, and an introduction to AI.",
            '/^Kursus pemrograman visual Scratch di LMS Erlass Academy: membuat animasi, cerita interaktif, dan game sederhana\.$/u'
                => fn () => 'A Scratch visual programming course on the Erlass Academy LMS: create animations, interactive stories, and simple games.',
            '/^Kursus Micro:bit di LMS Erlass Academy: memprogram LED, sensor, dan proyek IoT sederhana\.$/u'
                => fn () => 'A Micro:bit course on the Erlass Academy LMS: program LEDs, sensors, and simple IoT projects.',
            '/^Kursus Python di LMS Erlass Academy: algoritma, struktur data dasar, hingga pengenalan analisis data dan AI\.$/u'
                => fn () => 'A Python course on the Erlass Academy LMS: from algorithms and basic data structures to an introduction to data analysis and AI.',
            '/^Kursus HTML di LMS Erlass Academy: membangun halaman web pertama dengan HTML dan CSS dari nol hingga publikasi\.$/u'
                => fn () => 'An HTML course on the Erlass Academy LMS: build your first web page with HTML and CSS, from scratch to publishing.',
            '/^Paket pembelajaran (.+) \(Kode: ([^)]+)\) dirancang terintegrasi dengan perangkat, kurikulum, modul praktikum, dan pendampingan instruktur profesional Erlass\.$/u'
                => fn ($m) => "The {$name($m[1])} learning package (code: {$m[2]}) comes fully integrated with equipment, curriculum, lab modules, and support from Erlass's professional instructors.",
            '/^(.+) adalah ruang belajar gratis di platform LMS Erlass Academy berisi perangkat ajar, contoh modul, dan materi pengembangan guru untuk mata pelajaran Informatika serta Koding & Kecerdasan Artifisial \(KA\)\.$/u'
                => fn ($m) => "{$m[1]} is a free learning space on the Erlass Academy LMS with teaching kits, sample modules, and teacher development materials for Informatics and Coding & Artificial Intelligence.",
            '/^(.+) adalah paket intrakurikuler dengan LMS Erlass Academy: guru mendapat materi, aktivitas kelas, dan asesmen siap pakai; siswa belajar dan dinilai langsung di platform\.$/u'
                => fn ($m) => "{$m[1]} is a curriculum package with the Erlass Academy LMS: teachers get ready-to-use materials, class activities, and assessments; students learn and are assessed directly on the platform.",
            '/^(.+) adalah kursus mandiri di platform LMS Erlass Academy, lengkap dengan video, latihan, proyek, dan sertifikat penyelesaian\.$/u'
                => fn ($m) => "{$m[1]} is a self-paced course on the Erlass Academy LMS, complete with videos, exercises, projects, and a certificate of completion.",
        ];

        foreach ($patterns as $re => $make) {
            if (preg_match($re, $id, $m)) {
                return $make($m);
            }
        }

        return null;
    }

    /** English versions of the seeded articles (ArticleSeeder), by slug. */
    private const ARTICLES = [
        'erlass-coding-robotic-competition' => [
            'title' => 'Erlass Coding & Robotic Competition: A Stage for Students to Showcase Their Tech Projects',
            'excerpt' => 'A coding and robotics competition for elementary to high school students that challenges their creativity, teamwork, and problem-solving skills.',
            'body' => "The Erlass Coding & Robotic Competition is an annual event that brings together students from partner schools to present their best work in programming and robotics.\n\nParticipants can enter several categories, from building games with Scratch and Micro:bit projects to line-follower robot challenges. Each category is tailored to the participants' school level.\n\nMore than just a contest, the competition is a learning space where students practice presenting, work as a team, and receive direct feedback from industry judges.\n\nSchools that would like to register a team can contact the Erlass team through the consultation form or the official WhatsApp.",
        ],
        'dokumentasi-kelas-robotika-sekolah-mitra' => [
            'title' => 'Activity Highlights: Robotics Class at a Partner School',
            'excerpt' => 'A look inside a robotics class: students build, program, and test their own robots with Erlass instructors.',
            'body' => "Erlass robotics classes are designed so students learn by doing. Each session starts with an introduction to the concept, followed by building, programming, and testing the robot.\n\nStudents work in small groups so every member has a role: builder, programmer, or tester. This approach trains communication and shared responsibility.\n\nAt the end of the semester, students' projects are presented at a school showcase so parents and teachers can see how their skills have grown.",
        ],
        'mengapa-coding-sejak-sekolah-dasar' => [
            'title' => 'Why Should Coding Be Introduced in Elementary School?',
            'excerpt' => "Coding isn't just about computers. It trains children's logic, creativity, and perseverance from an early age.",
            'body' => "Many people think coding is only for older students. In fact, with visual approaches such as Scratch, elementary school children can start learning programming concepts in a fun way.\n\nThrough coding, children learn to break problems into small steps, try different solutions, and fix their mistakes. This skill is known as computational thinking and is useful across many subjects.\n\nThe Erlass Academy curriculum builds coding lessons step by step, from basic logic to creating games and interactive animations, so students can progress at their own school level.",
        ],
        'pendaftaran-ekstrakurikuler-coding-robotika' => [
            'title' => 'Registration Now Open for the Coding & Robotics Extracurricular Program',
            'excerpt' => 'Schools can now register the Coding & Robotics extracurricular program for the new school year with Erlass Academy.',
            'body' => "Erlass Academy is now accepting registrations for its Coding & Robotics extracurricular program for elementary, junior high, and senior high schools.\n\nThe program includes instructors who come to your school, practice equipment, learning modules, access to the Erlass Academy LMS, and certificates for students who complete the program.\n\nFor information on schedules, quotas, and partnership options, please contact the Erlass consulting team through the consultation form on our website or the official WhatsApp.",
        ],
    ];
}
