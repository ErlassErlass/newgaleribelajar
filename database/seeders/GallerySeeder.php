<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

/**
 * Starter photos for the /gallery archive, using the images already in public/img/gallery.
 * Add real documentation photos as new rows (image_path relative to public/).
 */
class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['img/gallery/coding-class.webp', 'Kelas Koding Terstruktur', 'Pembelajaran computational thinking berbasis blok visual.', 'siswa', 'ekskul-coding'],
            ['img/gallery/robotics-class.webp', 'Praktikum Perakitan Robot', 'Perakitan komponen mekatronika dan integrasi sensor.', 'siswa', 'robotika'],
            ['img/gallery/microbit.webp', 'Eksperimen Sensor Micro:bit', 'Pengenalan konsep Internet of Things (IoT).', 'siswa', 'microbit'],
            ['img/gallery/presentation.webp', 'Presentasi Proyek Siswa', 'Siswa mempresentasikan logika algoritma dan purwarupa karyanya.', 'siswa', 'presentasi'],
            ['img/gallery/teamwork.webp', 'Diskusi Kelompok & Algoritma', 'Penyelesaian tantangan studi kasus secara berkelompok.', 'umum', 'fasilitas'],
            ['img/gallery/competition.webp', 'Erlass Coding & Robotic Competition', 'Siswa merayakan kemenangan kompetisi robotika.', 'festival', 'kompetisi'],
        ];

        foreach ($photos as $i => [$path, $title, $desc, $cat, $sub]) {
            Gallery::updateOrCreate(['image_path' => $path], [
                'title' => $title,
                'description' => $desc,
                'category' => $cat,
                'subcategory' => $sub,
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }
    }
}
