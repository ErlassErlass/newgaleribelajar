<?php

return [
    'coding' => [
        'badge' => 'Future Skills',
        'title' => 'Coding & Artificial Intelligence',
        'subtitle' => 'Membangun logika berpikir komputasional (Computational Thinking) dari level dasar hingga Machine Learning untuk masa depan anak.',
        
        'path_title' => 'Learning Path',
        'path_subtitle' => 'Kurikulum kami dirancang bertahap sesuai usia dan perkembangan kognitif anak.',
        
        'levels' => [
            [
                'badge' => 'SD (7-12 Tahun)',
                'title' => 'Beginner: Visual Coding',
                'desc' => 'Pengenalan logika pemrograman menggunakan Scratch. Fokus pada pembuatan game, animasi, dan storytelling interaktif tanpa perlu mengetik kode.',
                'features' => ['Sequence & Loops', 'Conditional Logic', 'Variables Basics'],
                'icon' => '🐱',
                'color' => 'kids-blue'
            ],
            [
                'badge' => 'SMP (13-15 Tahun)',
                'title' => 'Intermediate: Python',
                'desc' => 'Transisi ke Text-Based Coding. Belajar sintaks Python, struktur data sederhana, dan logika algoritma yang lebih kompleks.',
                'features' => ['Python Syntax', 'Functions & Modules', 'Simple Algorithms'],
                'icon' => '🐍',
                'color' => 'kids-yellow'
            ],
            [
                'badge' => 'SMA (16+ Tahun)',
                'title' => 'Advanced: AI & Web',
                'desc' => 'Penerapan coding untuk teknologi masa depan: Artificial Intelligence dan Web Development (HTML, CSS, JS).',
                'features' => ['Machine Learning Intro', 'Neural Networks', 'API & Databases'],
                'icon' => '🧠',
                'color' => 'kids-mint'
            ]
        ],
        
        'mastery_badge' => 'Skill Development',
        'mastery_title' => 'What They Will Master',
        'mastery_skills' => [
            [
                'title' => 'Logical Thinking',
                'desc' => 'Memecahkan masalah besar menjadi langkah-langkah logis.',
                'icon' => '🧩',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Creative Confidence',
                'desc' => 'Berani mengekspresikan ide menjadi karya digital nyata.',
                'icon' => '🎨',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Attention to Detail',
                'desc' => 'Ketelitian dalam penulisan kode (syntax) dan debugging error.',
                'icon' => '🔍',
                'color' => 'kids-mint'
            ],
            [
                'title' => 'Persistence',
                'desc' => 'Tidak mudah menyerah saat menghadapi tantangan atau bugs.',
                'icon' => '🤝',
                'color' => 'kids-pink'
            ]
        ],
        
        'tools_title' => 'Tools & Technologies We Teach',
        'cta_title' => 'Siap Mencetak Programmer Masa Depan?',
        'cta_subtitle' => 'Bergabung dengan 2.000+ siswa lainnya yang telah memulai perjalanan digital mereka bersama Erlass.',
        'cta_button' => 'Daftar Ekskul Koding'
    ],

    'robotics' => [
        'badge' => 'Engineering & Innovation',
        'title' => 'Robotics & IoT',
        'subtitle' => 'Menghubungkan kode dengan dunia nyata. Dari mekanik dasar hingga Internet of Things (IoT) yang cerdas.',
        
        'kits_title' => 'Learning Kits & Modules',
        'kits_subtitle' => 'Kami menggunakan perangkat standar industri pendidikan untuk memastikan siswa memahami konsep elektronika dan pemrograman hardware.',
        
        'kits' => [
            [
                'title' => 'Robotic Explorer',
                'desc' => 'Fokus pada konsep elektronika dasar, mekanik, dan sensor. Siswa merakit robot yang dapat bergerak dan merespons lingkungan fisik.',
                'features' => ['Konsep Rangkaian Listrik', 'Sensor Cahaya & Sentuh'],
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Micro:bit Learning',
                'desc' => 'Pocket-sized computer yang mengenalkan hubungan software dan hardware. Sangat visual dengan LED matrix 5x5.',
                'features' => ['Accelerometer & Compass', 'Radio Communication'],
                'image' => 'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Arduino & IoT',
                'desc' => 'Level lanjut menggunakan bahasa C++. Membuat sistem otomasi rumah pintar (Smart Home) dan proyek Internet of Things.',
                'features' => ['Bahasa Pemrograman C++', 'Wi-Fi Modules (ESP8266)'],
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-pink'
            ]
        ],
        
        'projects_badge' => 'Project Based Learning',
        'projects_title' => '100+ Proyek STEM',
        'projects_subtitle' => 'Kami percaya cara terbaik belajar engineering adalah dengan membangun. Kurikulum kami mencakup ratusan proyek praktis.',
        'projects_link' => 'Hubungi Kami &rarr;',
        
        'project_list' => [
            [
                'title' => 'Smart Garden',
                'desc' => 'Sensor kelembaban tanah otomatis menyiram tanaman.',
                'icon' => '🌱',
                'color' => 'kids-mint'
            ],
            [
                'title' => 'Smart Trash Bin',
                'desc' => 'Tempat sampah otomatis terbuka saat mendeteksi tangan.',
                'icon' => '🗑️',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Home Automation',
                'desc' => 'Kontrol lampu dan kipas via Smartphone (IoT).',
                'icon' => '🏠',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Line Follower',
                'desc' => 'Robot mobil otonom mengikuti garis lintasan.',
                'icon' => '🚗',
                'color' => 'kids-pink'
            ]
        ]
    ]
];
