<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Announcement::create([
            'content' => '🎉 Pendaftaran Batch 2 Koding & Robotik telah dibuka! Dapatkan diskon 20% untuk pendaftaran Early Bird.',
            'url_link' => '#contact',
            'is_active' => true,
        ]);
        
        \App\Models\Announcement::create([
            'content' => '🚀 Ikuti lomba cerdas cermat teknologi tingkat SD-SMP se-Indonesia bersana Erlass!',
            'url_link' => '#',
            'is_active' => true,
        ]);
    }
}
