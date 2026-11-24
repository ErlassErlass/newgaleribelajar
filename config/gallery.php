<?php

/*
|--------------------------------------------------------------------------
| Photo archive categories (/gallery)
|--------------------------------------------------------------------------
| Each main category has sub-categories. A photo row in the `galleries` table
| stores the main key in `category` and the sub key in `subcategory`.
| Add or rename entries here; keys are used in URLs (?kategori=guru&sub=tot).
*/

return [
    'categories' => [
        'guru' => [
            'label' => 'Guru',
            'desc' => 'Pelatihan, workshop, dan pendampingan guru sekolah mitra.',
            'subs' => [
                'tot' => 'Training of Trainer (ToT)',
                'workshop' => 'Workshop & Webinar',
                'pendampingan' => 'Pendampingan Mengajar',
                'sertifikasi' => 'Sertifikasi Guru',
            ],
        ],
        'umum' => [
            'label' => 'Umum',
            'desc' => 'Seminar, sosialisasi, kunjungan, dan kerja sama Erlass.',
            'subs' => [
                'seminar' => 'Seminar & Sosialisasi',
                'kunjungan' => 'Kunjungan Sekolah',
                'kemitraan' => 'Kemitraan & MoU',
                'fasilitas' => 'Laboratorium & Fasilitas',
            ],
        ],
        'siswa' => [
            'label' => 'Siswa',
            'desc' => 'Kegiatan belajar siswa SD, SMP, dan SMA bersama Erlass.',
            'subs' => [
                'ekskul-coding' => 'Ekskul Coding',
                'robotika' => 'Robotika',
                'microbit' => 'Micro:bit & IoT',
                'intrakurikuler' => 'Intrakurikuler Informatika',
                'presentasi' => 'Presentasi Proyek',
            ],
        ],
        'anak' => [
            'label' => 'Anak',
            'desc' => 'Kelas coding dan robotika untuk anak usia dini & SD kelas awal.',
            'subs' => [
                'kelas-coding' => 'Kelas Coding Anak',
                'robot-anak' => 'Robot Anak',
                'bermain-belajar' => 'Bermain & Belajar',
            ],
        ],
        'festival' => [
            'label' => 'Erlass Festival',
            'desc' => 'Kompetisi, pameran karya, dan perayaan prestasi siswa.',
            'subs' => [
                'kompetisi' => 'Kompetisi Coding & Robotika',
                'pameran' => 'Pameran Karya',
                'penghargaan' => 'Penghargaan & Juara',
            ],
        ],
    ],
];
