<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Products sold on the Erlass Academy LMS (erlass.academy) and the official Shopee store.
 * Runs after CrmDataSeeder: adds the LMS products and flags existing CRM products by channel.
 */
class LmsCatalogSeeder extends Seeder
{
    /** Existing CRM SKUs that are listed on Shopee. */
    private const SHOPEE_SKUS = [
        'MSJ01', 'MSJ02', 'MSJ03', 'MSJ04', 'MSJ05', 'MSJ06', // Modul Scratch Jilid 1-6
        'MSJ07', // Modul Project Scratch
        'MSJ08', // Modul Project Pictoblox AI
        'RE01',  // Robotik Explorer
        'MLK01', // Microbit Learning Kit
        'RB01',  // Robotik Erboblox
    ];

    /** Asesmen SKU => class range (renamed to the Shopee/LMS naming). */
    private const ASSESSMENTS = [
        'LMS-PMB01' => ['1-3', ['SD']],
        'LMS-PMB02' => ['4-6', ['SD']],
        'LMS-PMB03' => ['7-9', ['SMP']],
        'LMS-PMB04' => ['10-12', ['SMA', 'SMK']],
    ];

    public function run(): void
    {
        $lms = Category::where('slug', 'erlass-academy-lms')->value('id');
        $assessment = Category::where('slug', 'asesmen-potensi-siswa')->value('id');

        $features = [
            'Akses materi & video pembelajaran di LMS Erlass Academy',
            'Kuis, tugas, dan penilaian otomatis',
            'Pemantauan progres belajar siswa oleh guru',
            'Selaras Kurikulum Merdeka',
        ];

        $products = [
            // Free teacher resource hub
            [
                'sku' => 'LMS-PSDG', 'name' => 'Pusat Sumber Daya Guru', 'category_id' => $lms,
                'lms_group' => 'sumber-guru', 'is_free' => true, 'on_shopee' => false,
                'lms_url' => 'https://erlass.academy/course/view.php?id=54',
                'education_levels' => ['SD', 'SMP', 'SMA'],
                'summary' => 'Kumpulan perangkat ajar, modul, dan materi pendukung guru Informatika & Koding yang dapat diakses gratis di LMS Erlass Academy.',
                'description' => 'Pusat Sumber Daya Guru adalah ruang belajar gratis di platform LMS Erlass Academy berisi perangkat ajar, contoh modul, dan materi pengembangan guru untuk mata pelajaran Informatika serta Koding & Kecerdasan Artifisial (KA).',
                'features' => ['Gratis untuk guru', 'Perangkat ajar & contoh modul', 'Materi Informatika dan Koding KA', 'Akses langsung lewat LMS Erlass Academy'],
            ],

            // Intrakurikuler dengan LMS
            ...$this->intra('INF', 'Informatika', 'Intrakurikuler Informatika berbasis LMS Erlass Academy untuk jenjang %s: materi, aktivitas, dan asesmen siap pakai sesuai Kurikulum Merdeka.', $lms, $features),
            ...$this->intra('KKA', 'Koding KA', 'Intrakurikuler Koding & Kecerdasan Artifisial (KA) berbasis LMS Erlass Academy untuk jenjang %s: berpikir komputasional, pemrograman, dan pengenalan AI.', $lms, $features),

            // Course dengan LMS
            $this->course('LMS-SCR', 'Coding Scratch Course LMS', ['SD', 'SMP'], 'Kursus pemrograman visual Scratch di LMS Erlass Academy: membuat animasi, cerita interaktif, dan game sederhana.', $lms, $features),
            $this->course('LMS-MB', 'Microbit Course LMS', ['SD', 'SMP'], 'Kursus Micro:bit di LMS Erlass Academy: memprogram LED, sensor, dan proyek IoT sederhana.', $lms, $features),
            $this->course('LMS-PY', 'Python Course LMS', ['SMP', 'SMA'], 'Kursus Python di LMS Erlass Academy: algoritma, struktur data dasar, hingga pengenalan analisis data dan AI.', $lms, $features),
            $this->course('LMS-HTML', 'HTML Course LMS', ['SMP', 'SMA'], 'Kursus HTML di LMS Erlass Academy: membangun halaman web pertama dengan HTML dan CSS dari nol hingga publikasi.', $lms, $features),
        ];

        foreach ($products as $i => $p) {
            Product::updateOrCreate(['sku' => $p['sku']], array_merge([
                'slug' => Str::slug($p['name']),
                'product_type' => 'Jasa',
                'status' => 'published',
                'on_lms' => true,
                'is_featured' => true,
                'deal_count' => 0,
                'sort_order' => 10 + $i,
                'lms_order' => $i,
            ], $p));
        }

        $order = 40;
        foreach (self::ASSESSMENTS as $sku => [$range, $levels]) {
            $name = "Asesmen Potensi, Minat dan Bakat Siswa Kelas {$range}";
            Product::where('sku', $sku)->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $assessment,
                'education_levels' => json_encode($levels),
                'summary' => "Asesmen potensi, minat, dan bakat berbasis LMS Erlass Academy untuk siswa kelas {$range}, dengan laporan hasil untuk sekolah dan orang tua.",
                'on_lms' => true,
                'on_shopee' => true,
                'lms_group' => 'asesmen',
                'is_featured' => true,
                'lms_order' => $order - 40,
                'sort_order' => $order++,
            ]);
        }

        Product::whereIn('sku', self::SHOPEE_SKUS)->update(['on_shopee' => true]);
    }

    private function intra(string $prefix, string $subject, string $summary, ?int $category, array $features): array
    {
        $out = [];
        foreach (['SD' => ['SD'], 'SMP' => ['SMP'], 'SMA' => ['SMA', 'SMK']] as $level => $levels) {
            $name = "{$subject} {$level}";
            $out[] = [
                'sku' => "{$prefix}-{$level}",
                'name' => $name,
                'category_id' => $category,
                'lms_group' => 'intrakurikuler',
                'on_shopee' => true,
                'education_levels' => $levels,
                'summary' => sprintf($summary, $level),
                'description' => "{$name} adalah paket intrakurikuler dengan LMS Erlass Academy: guru mendapat materi, aktivitas kelas, dan asesmen siap pakai; siswa belajar dan dinilai langsung di platform.",
                'features' => $features,
            ];
        }

        return $out;
    }

    private function course(string $sku, string $name, array $levels, string $summary, ?int $category, array $features): array
    {
        return [
            'sku' => $sku,
            'name' => $name,
            'category_id' => $category,
            'lms_group' => 'course',
            'on_shopee' => true,
            'education_levels' => $levels,
            'summary' => $summary,
            'description' => "{$name} adalah kursus mandiri di platform LMS Erlass Academy, lengkap dengan video, latihan, proyek, dan sertifikat penyelesaian.",
            'features' => $features,
        ];
    }
}
