<?php

/*
|--------------------------------------------------------------------------
| Homepage content (defaults)
|--------------------------------------------------------------------------
| Edited in the admin panel: Sistem › Pengaturan Beranda. Saved values are stored
| in the settings table (key "homepage") and merged over these defaults at boot.
*/

return [
    'hero' => [
        'badge' => 'Erlass Academy · Coding & Robotika untuk Sekolah',
        'title' => 'Membangun Generasi Kreatif Melalui',
        'title_highlight' => 'Teknologi',
        'description' => 'Erlass Academy menghadirkan pembelajaran Coding, Robotika, Micro:bit, Python, dan Web Development yang terstruktur dan menyenangkan — lengkap dengan instruktur profesional, LMS, dan pendampingan program untuk sekolah jenjang SD, SMP, hingga SMA.',
        'cta_primary' => 'Jelajahi Produk',
        'cta_secondary' => 'Konsultasi Sekarang',
        // Photo on the first banner slide (the one with the main title above)
        'image' => 'img/gallery/teamwork.webp',
        'slides' => [
            ['image' => 'img/gallery/coding-class.webp', 'tag' => 'Coding & Programming', 'title' => 'Belajar Coding Jadi Seru Sejak SD', 'caption' => 'Siswa SD belajar logika pemrograman visual bersama guru.'],
            ['image' => 'img/gallery/robotics-class.webp', 'tag' => 'Robotika', 'title' => 'Rakit & Program Robot Sendiri', 'caption' => 'Merakit robot dan sensor di laboratorium sekolah.'],
            ['image' => 'img/gallery/presentation.webp', 'tag' => 'Asesmen', 'title' => 'Asesmen Potensi Minat dan Bakat', 'caption' => 'Kenali potensi, minat, dan bakat siswa kelas 1–12 untuk panduan penjurusan dan karier.'],
        ],
    ],

    // Order here = order in the admin form. "visible" hides the whole section.
    'sections' => [
        'partners' => [
            'label' => 'Sekolah Mitra (logo berjalan)',
            'visible' => true,
            'title' => 'Telah Dipercaya oleh {jumlah}+ Sekolah Unggulan di Seluruh Indonesia',
        ],
        'produk' => [
            'label' => 'Produk LMS Erlass Academy',
            'visible' => true,
            'badge' => 'Platform LMS Erlass Academy',
            'title' => 'Produk Digital di LMS Erlass Academy',
            'subtitle' => 'Intrakurikuler, course, dan asesmen yang dijalankan langsung di platform erlass.academy, lengkap dengan materi, tugas, dan pemantauan progres siswa.',
        ],
        'solutions' => [
            'label' => 'Solusi Sekolah',
            'visible' => true,
            'badge' => 'Solusi Sekolah',
            'title' => 'Solusi Pendidikan Terintegrasi untuk Sekolah Anda',
            'subtitle' => 'Dirancang spesifik untuk mendukung peningkatan mutu akademik, literasi teknologi, dan pemetaan potensi siswa secara menyeluruh.',
        ],
        'tentang' => [
            'label' => 'Tentang Kami',
            'visible' => true,
            'badge' => 'Tentang Kami',
            'title' => 'Erlass Academy, Mitra Sekolah dalam Pendidikan Teknologi',
            'subtitle' => 'Erlass Academy adalah lini pendidikan dari PT Erlass Prokreatif Indonesia yang berfokus pada pembelajaran Coding, Robotika, Micro:bit, Python, dan Web Development. Kami memadukan kurikulum, perangkat praktik, platform LMS, dan pendampingan instruktur agar program teknologi di sekolah berjalan konsisten dan terukur.',
        ],
        'why-erlass' => [
            'label' => 'Why Erlass? (5 Pilar & Video)',
            'visible' => true,
            'badge' => 'Why Erlass?',
            'title' => 'Bukan Sekadar Produk, Tetapi Solusi Pendidikan',
            'subtitle' => 'Erlass memadukan kurikulum berstandar Kurikulum Merdeka, perangkat praktikum teruji, dan pendampingan instruktur berpengalaman agar program teknologi di sekolah Anda berjalan konsisten dan terukur.',
        ],
        'program' => [
            'label' => 'Program Pendidikan',
            'visible' => true,
            'badge' => 'Program Pendidikan',
            'title' => 'Program untuk Seluruh Ekosistem Sekolah',
            'subtitle' => 'Dari kepala sekolah, guru, hingga siswa — setiap program dirancang fleksibel untuk jalur ekstrakurikuler maupun intrakurikuler.',
        ],
        'products' => [
            'label' => 'Katalog Unggulan (carousel)',
            'visible' => true,
            'badge' => 'Katalog Unggulan',
            'title' => 'Program & Perangkat Paling Banyak Diminati Sekolah',
            'subtitle' => 'Modul, learning kit, dan program ekskul yang paling sering dipilih sekolah mitra Erlass.',
        ],
        'aktivitas' => [
            'label' => 'Aktivitas & Informasi',
            'visible' => true,
            'badge' => 'Aktivitas & Informasi',
            'title' => 'Kabar Terbaru dari Erlass',
            'subtitle' => 'Kompetisi, dokumentasi kegiatan, artikel, dan informasi program terbaru untuk sekolah mitra.',
        ],
        'collaborate' => [
            'label' => 'Kemitraan',
            'visible' => true,
            'badge' => "Let's Collaborate",
            'title' => 'Mari Wujudkan Transformasi Pendidikan Bersama Erlass',
            'subtitle' => 'Kami siap berkolaborasi merancang skema kerja sama yang fleksibel, akuntabel, dan berdampak nyata bagi ekosistem pendidikan Anda.',
        ],
        'contact' => [
            'label' => 'Formulir Konsultasi',
            'visible' => true,
            'badge' => 'Konsultasi & Penawaran',
            'title' => 'Mulai Kolaborasi Bersama Tim Ahli Erlass',
            'subtitle' => 'Isi formulir di bawah ini. Tim konsultan pendidikan kami akan menghubungi Anda untuk memberikan penjelasan kurikulum, demonstrasi sistem, dan proposal penawaran resmi.',
        ],
    ],
];
