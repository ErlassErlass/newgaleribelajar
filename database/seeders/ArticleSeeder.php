<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

/**
 * Sample articles so the "Aktivitas & Informasi" section and /artikel pages
 * have content. Review and replace with real news before going live.
 */
class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Erlass Coding & Robotic Competition: Wadah Siswa Unjuk Karya Teknologi',
                'slug' => 'erlass-coding-robotic-competition',
                'tags' => ['KompetisiRobotika', 'LombaCoding', 'RobotikaPelajar', 'STEM'],
                'category' => 'kompetisi',
                'cover_image' => 'img/gallery/competition.webp',
                'excerpt' => 'Kompetisi coding dan robotika tingkat SD hingga SMA untuk menantang kreativitas, kerja sama tim, dan kemampuan problem solving siswa.',
                'body' => "Erlass Coding & Robotic Competition adalah ajang tahunan yang mempertemukan siswa dari berbagai sekolah mitra untuk menampilkan karya terbaik mereka di bidang pemrograman dan robotika.\n\nPeserta dapat mengikuti beberapa kategori, mulai dari pembuatan game dengan Scratch, proyek Micro:bit, hingga tantangan robot line follower. Setiap kategori disesuaikan dengan jenjang pendidikan peserta.\n\nLebih dari sekadar perlombaan, kompetisi ini menjadi ruang belajar bagi siswa untuk berlatih presentasi, bekerja dalam tim, dan menerima masukan langsung dari juri praktisi.\n\nSekolah yang ingin mendaftarkan timnya dapat menghubungi tim Erlass melalui formulir konsultasi atau WhatsApp resmi.",
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Dokumentasi Kegiatan: Kelas Robotika di Sekolah Mitra',
                'slug' => 'dokumentasi-kelas-robotika-sekolah-mitra',
                'tags' => ['KelasRobotika', 'EkskulRobotika', 'BelajarRobotika', 'STEM'],
                'category' => 'kegiatan',
                'cover_image' => 'img/gallery/robotics-class.webp',
                'excerpt' => 'Melihat suasana kelas robotika: siswa merakit, memprogram, dan menguji robot buatan mereka sendiri bersama instruktur Erlass.',
                'body' => "Kelas robotika Erlass dirancang agar siswa belajar langsung melalui praktik. Setiap pertemuan diawali dengan pengenalan konsep, dilanjutkan perakitan, pemrograman, dan pengujian robot.\n\nSiswa bekerja dalam kelompok kecil sehingga setiap anggota mendapat peran: perakit, programmer, maupun penguji. Pola ini melatih komunikasi dan tanggung jawab bersama.\n\nDi akhir semester, karya siswa ditampilkan dalam showcase sekolah sehingga orang tua dan guru dapat melihat perkembangan keterampilan mereka.",
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Mengapa Coding Perlu Dikenalkan Sejak Sekolah Dasar?',
                'slug' => 'mengapa-coding-sejak-sekolah-dasar',
                'tags' => ['CodingAnak', 'BelajarCoding', 'Scratch', 'KurikulumMerdeka'],
                'category' => 'artikel',
                'cover_image' => 'img/gallery/coding-class.webp',
                'excerpt' => 'Coding bukan hanya soal komputer. Pembelajaran ini melatih logika, kreativitas, dan ketekunan anak sejak dini.',
                'body' => "Banyak orang mengira coding hanya cocok untuk siswa yang sudah besar. Padahal, dengan pendekatan visual seperti Scratch, anak usia SD dapat mulai belajar konsep pemrograman secara menyenangkan.\n\nMelalui coding, anak belajar memecah masalah menjadi langkah-langkah kecil, mencoba berbagai solusi, dan memperbaiki kesalahan. Kemampuan ini dikenal sebagai berpikir komputasional dan berguna di berbagai mata pelajaran.\n\nKurikulum Erlass Academy menyusun materi coding secara bertahap, dari logika dasar hingga pembuatan game dan animasi interaktif, sehingga siswa dapat berkembang sesuai jenjangnya.",
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'Pendaftaran Program Ekstrakurikuler Coding & Robotika Dibuka',
                'slug' => 'pendaftaran-ekstrakurikuler-coding-robotika',
                'tags' => ['EkskulCoding', 'EkskulRobotika', 'Microbit', 'SekolahDigital'],
                'category' => 'info-program',
                'cover_image' => 'img/gallery/microbit.webp',
                'excerpt' => 'Sekolah kini dapat mendaftarkan program ekstrakurikuler Coding & Robotika untuk tahun ajaran baru bersama Erlass Academy.',
                'body' => "Erlass Academy membuka pendaftaran program ekstrakurikuler Coding & Robotika untuk sekolah jenjang SD, SMP, dan SMA.\n\nProgram mencakup instruktur yang datang ke sekolah, perangkat praktik, modul pembelajaran, akses LMS Erlass Academy, serta sertifikat bagi siswa yang menuntaskan program.\n\nUntuk informasi jadwal, kuota, dan skema kerja sama, silakan hubungi tim konsultan Erlass melalui formulir konsultasi di website atau WhatsApp resmi.",
                'published_at' => now()->subDays(1),
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(['slug' => $data['slug']], $data + ['is_published' => true]);
        }
    }
}
