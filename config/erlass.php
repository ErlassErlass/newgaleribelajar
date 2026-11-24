<?php

/*
|--------------------------------------------------------------------------
| Erlass Company Profile
|--------------------------------------------------------------------------
| Single source for contact info & social links rendered in the header,
| footer, and legal pages. Override via .env without touching views.
*/

return [
    'company' => 'PT Erlass Prokreatif Indonesia',
    'brand' => 'Erlass Academy',

    'phone_display' => '+62 823-1134-1381',
    'whatsapp' => env('ERLASS_WHATSAPP', '6282311341381'),
    'email' => env('ERLASS_EMAIL', 'info@erlass.co.id'),
    // One line per schedule (shown as separate lines in the footer)
    'office_hours' => "Senin – Jumat: 08:00 – 16:00 WIB\nSabtu: 08:00 – 13:00 WIB",

    'address_hq' => 'Pejaten Office Park Blok D, Jl. Warung Buncit Raya No. 79, Jakarta Selatan',
    'address_ops' => 'Jalan Boulevard Silk Town No. 12, Tangerang Selatan',

    // true: comments appear immediately; false: they wait until is_approved is set in the database
    'comments_auto_approve' => env('ERLASS_COMMENTS_AUTO_APPROVE', true),

    // Official marketplace store; product pages fall back to this when a product has no shopee_url
    'shopee' => env('ERLASS_SHOPEE_URL', 'https://shopee.co.id/erlassproind'),

    // Erlass Academy LMS platform
    'lms' => env('ERLASS_LMS_URL', 'https://erlass.academy'),

    // YouTube channel; its public RSS feed adds view counts & dates to the videos below
    'youtube_channel_id' => env('ERLASS_YOUTUBE_CHANNEL_ID', 'UCMHR_rMvZo-7mKIWuhZ8o_A'),

    // Erlass videos, in display order. Used by the "Why Erlass?" tabs (first 3) and the /gallery playlist (all).
    // youtube_id = the part after v= in a YouTube link (or after youtu.be/ or /shorts/).
    'videos' => [
        ['title' => 'ERLASS Spotlight: SD Strada Wiyatasana dan Prestasinya', 'youtube_id' => 'Ob3BFyAJNvI', 'label' => 'Spotlight', 'desc' => 'Mengenal lebih dekat sekolah mitra Erlass dan prestasi siswanya.'],
        ['title' => 'Peluncuran LMS Erlass Academy', 'youtube_id' => 'vZEc4n_AkyU', 'label' => 'LMS', 'desc' => 'Inovasi pembelajaran Informatika masa depan lewat LMS Erlass Academy.'],
        ['title' => 'Ekstrakurikuler Robotik SD Muhammadiyah 06 Jakarta', 'youtube_id' => '9DF3xq7fT2w', 'label' => 'Ekskul', 'desc' => 'Suasana ekskul robotika Erlass di sekolah mitra.'],
        ['title' => 'Solusi Pembelajaran Digital MI PKP', 'youtube_id' => 'jzzloyqe36w', 'label' => 'Studi Kasus', 'desc' => 'Penerapan solusi pembelajaran digital Erlass di madrasah.'],
        ['title' => 'Baru Kenal Coding tapi Langsung Jadi Juara?', 'youtube_id' => '4ChxzPxI9xQ', 'label' => 'Kompetisi', 'desc' => 'Cerita siswa yang baru belajar coding dan langsung berprestasi di kompetisi.'],
        ['title' => 'Serunya Belajar Bahasa Inggris Bersama Erlass Academy', 'youtube_id' => 'SocEHPOGMCQ', 'label' => 'Kegiatan', 'desc' => 'Kelas English Course Erlass Academy.'],
        ['title' => 'Robotic Explorer', 'youtube_id' => 'YqSCKc9sJJE', 'label' => 'Produk', 'desc' => 'Kit Robotik Explorer untuk pembelajaran robotika di sekolah.'],
        ['title' => 'Kelas Jadi Lebih Aktif dengan Coding bareng Erlass', 'youtube_id' => 'Ccmx0Riymsg', 'label' => 'Coding', 'desc' => 'Belajar coding Scratch yang aktif dan menyenangkan.'],
        ['title' => 'Cara Membuat Karakter Scratch Bisa Melompat', 'youtube_id' => 'hXA9g4n78Wk', 'label' => 'Tutorial', 'desc' => 'Tutorial singkat pemrograman Scratch.'],
    ],


    'social' => [
        'instagram' => env('ERLASS_INSTAGRAM_URL', 'https://www.instagram.com/komunitaserlass/'),
        'tiktok' => env('ERLASS_TIKTOK_URL', 'https://www.tiktok.com/@erlasspro.id'),
        'youtube' => env('ERLASS_YOUTUBE_URL', 'https://www.youtube.com/@erlassprokreatifindonesia'),
        'facebook' => env('ERLASS_FACEBOOK_URL', 'https://www.facebook.com/people/komunitaserlass/100085820361415/'),
        'facebook_group' => env('ERLASS_FACEBOOK_GROUP_URL', 'https://www.facebook.com/groups/258454375448341/'),
    ],
];
