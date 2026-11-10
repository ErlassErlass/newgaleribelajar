<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\Partner;

class SyncCrmDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-crm-data {--force : Force truncate and re-sync all records}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync categories, products, and deal partner schools from Erlass CRM database (erlass_data)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Memulai Sinkronisasi Data dari Erlass CRM ===');

        try {
            DB::connection('crm')->getPdo();
            $this->info('✓ Terhubung ke database Erlass CRM (erlass_data).');
        } catch (\Exception $e) {
            $this->error('Gagal terhubung ke database CRM: ' . $e->getMessage());
            return 1;
        }

        $this->syncCategories();
        $this->syncProducts();
        $this->syncPartners();

        $this->info('=== Sinkronisasi Data Selesai dengan Sukses ===');
        return 0;
    }

    protected function syncCategories()
    {
        $this->line("\n[1/3] Menyinkronkan Kategori...");

        // Map CRM category names to clean, professional website categories
        $categoryMapping = [
            'Pelatihan Jasa Pemrograman Scratch' => [
                'name' => 'Coding & Informatika',
                'slug' => 'coding-informatika',
                'description' => 'Program pembelajaran pemrograman visual Scratch, logika komputasi, dan kurikulum informatika terstruktur untuk jenjang SD hingga SMP.',
                'icon' => 'code',
                'sort_order' => 1,
            ],
            'Mikrokontroller Microbit' => [
                'name' => 'Micro:bit & IoT',
                'slug' => 'microbit-iot',
                'description' => 'Pembelajaran elektronika cerdas, sensor, dan Internet of Things (IoT) berbasis board BBC micro:bit yang interaktif.',
                'icon' => 'cpu',
                'sort_order' => 2,
            ],
            'Robotik' => [
                'name' => 'Robotika Edukasi',
                'slug' => 'robotika-edukasi',
                'description' => 'Pengembangan mechanical engineering, algoritma pergerakan, dan perakitan robot menggunakan kit Erboblox, Jimu, dan Explorer.',
                'icon' => 'bot',
                'sort_order' => 3,
            ],
            'Assesmen' => [
                'name' => 'Asesmen Bakat & Potensi Siswa',
                'slug' => 'asesmen-potensi-siswa',
                'description' => 'Instrumen evaluasi psikometrik dan pemetaan minat bakat siswa terstandarisasi untuk panduan penjurusan dan pengembangan diri.',
                'icon' => 'clipboard-check',
                'sort_order' => 4,
            ],
            'Produk Digital LMS' => [
                'name' => 'Erlass Academy LMS',
                'slug' => 'erlass-academy-lms',
                'description' => 'Platform Learning Management System terintegrasi untuk manajemen kelas, materi digital, tugas, dan ujian sekolah.',
                'icon' => 'layout',
                'sort_order' => 5,
            ],
            'Modul Cetak' => [
                'name' => 'Modul Belajar & LKPD Cetak',
                'slug' => 'modul-cetak',
                'description' => 'Buku kerja siswa dan Lembar Kerja Peserta Didik (LKPD) komprehensif berstandar Kurikulum Merdeka.',
                'icon' => 'book-open',
                'sort_order' => 6,
            ],
            'Modul Pdf' => [
                'name' => 'E-Book & Modul Digital PDF',
                'slug' => 'modul-pdf',
                'description' => 'Bahan ajar digital interaktif berformat PDF siap pakai untuk guru dan siswa di sekolah.',
                'icon' => 'file-text',
                'sort_order' => 7,
            ],
        ];

        $crmCategories = DB::connection('crm')->table('spdata_masterkategoriproduk')->get();

        $count = 0;
        foreach ($crmCategories as $crmCat) {
            $catInfo = $categoryMapping[$crmCat->nama] ?? [
                'name' => $crmCat->nama,
                'slug' => Str::slug($crmCat->nama),
                'description' => 'Kategori produk edukasi Erlass: ' . $crmCat->nama,
                'icon' => 'folder',
                'sort_order' => 99,
            ];

            Category::updateOrCreate(
                ['crm_id' => $crmCat->id],
                [
                    'name' => $catInfo['name'],
                    'slug' => $catInfo['slug'],
                    'description' => $catInfo['description'],
                    'icon' => $catInfo['icon'],
                    'sort_order' => $catInfo['sort_order'],
                    'is_active' => true,
                ]
            );
            $count++;
        }

        $this->info("✓ Berhasil menyinkronkan {$count} kategori.");
    }

    protected function syncProducts()
    {
        $this->line("\n[2/3] Menyinkronkan Produk...");

        // Deal counts per product from spdata_spdetail
        $dealCounts = DB::connection('crm')
            ->table('spdata_spdetail')
            ->where('status_sp', 'Deal')
            ->select('kode_produk', DB::raw('COUNT(*) as total'))
            ->groupBy('kode_produk')
            ->pluck('total', 'kode_produk')
            ->toArray();

        // Map category IDs in local DB
        $categories = Category::all()->keyBy('name');
        $codingCat = $categories->get('Coding & Informatika');
        $microbitCat = $categories->get('Micro:bit & IoT');
        $robotikCat = $categories->get('Robotika Edukasi');
        $asesmenCat = $categories->get('Asesmen Bakat & Potensi Siswa');
        $lmsCat = $categories->get('Erlass Academy LMS');
        $modulCat = $categories->get('Modul Belajar & LKPD Cetak');

        $crmProducts = DB::connection('crm')->table('produk')->get();
        $imported = 0;

        foreach ($crmProducts as $prod) {
            // Skip dummy/test products like '21234'
            if (is_numeric($prod->KodProd) || empty(trim($prod->NamProd))) {
                continue;
            }

            // Determine matching category
            $categoryId = null;
            $crmCatName = $prod->kategori ?? '';
            $sku = trim($prod->KodProd);
            $name = trim($prod->NamProd);

            if (str_contains($name, 'Asesmen') || str_starts_with($sku, 'LMS-PMB')) {
                $categoryId = $asesmenCat?->id;
            } elseif (str_starts_with($sku, 'ERR') || str_starts_with($sku, 'MB') || str_starts_with($sku, 'MLK')) {
                $categoryId = $microbitCat?->id;
            } elseif (str_starts_with($sku, 'RB') || str_starts_with($sku, 'RE') || str_starts_with($sku, 'RJ')) {
                $categoryId = $robotikCat?->id;
            } elseif (str_starts_with($sku, 'ECR') || str_contains($name, 'Scratch') || str_contains($name, 'Koding') || str_contains($name, 'Python')) {
                $categoryId = $codingCat?->id;
            } elseif (str_starts_with($sku, 'ILMS') || str_starts_with($sku, 'KLMS') || str_contains($name, 'LMS')) {
                $categoryId = $lmsCat?->id;
            } elseif (str_starts_with($sku, 'MSJ') || str_starts_with($sku, 'MLJ')) {
                $categoryId = $modulCat?->id;
            } else {
                $categoryId = $codingCat?->id;
            }

            // Determine education levels
            $levels = [];
            if (preg_match('/(SD|Kelas [1-6]|Jilid [1-6])/i', $name)) {
                $levels[] = 'SD';
            }
            if (preg_match('/(SMP|Kelas [7-9])/i', $name)) {
                $levels[] = 'SMP';
            }
            if (preg_match('/(SMA|SMK|Kelas 1[0-2])/i', $name)) {
                $levels[] = 'SMA/SMK';
            }
            if (empty($levels)) {
                $levels = ['SD', 'SMP'];
            }

            $dealCount = $dealCounts[$sku] ?? 0;
            $isFeatured = $dealCount >= 10;

            Product::updateOrCreate(
                ['sku' => $sku],
                [
                    'category_id' => $categoryId,
                    'name' => $name,
                    'slug' => Str::slug($name . '-' . $sku),
                    'summary' => "Program edukasi teknologi {$name} untuk meningkatkan kompetensi digital generasi muda.",
                    'description' => "Paket pembelajaran {$name} (Kode: {$sku}) dirancang terintegrasi dengan perangkat, kurikulum, modul praktikum, dan pendampingan instruktur profesional Erlass.",
                    'product_type' => $prod->Tipe_Produk ?? 'Jasa',
                    'education_levels' => $levels,
                    'features' => [
                        'Kurikulum adaptif sesuai Kurikulum Merdeka',
                        'Panduan instruktur & modul komprehensif',
                        'Sertifikat pelatihan resmi dari Erlass Institute',
                        'Monitoring perkembangan kemampuan siswa berkala',
                    ],
                    'status' => ($prod->Status === 'nonaktif') ? 'draft' : 'published',
                    'is_featured' => $isFeatured,
                    'deal_count' => $dealCount,
                    'sort_order' => $dealCount > 0 ? (1000 - $dealCount) : 500,
                ]
            );
            $imported++;
        }

        $this->info("✓ Berhasil menyinkronkan {$imported} produk.");
    }

    protected function syncPartners()
    {
        $this->line("\n[3/3] Menyinkronkan Data Sekolah Mitra (SP Deals)...");

        $schools = DB::connection('crm')->table('spdata_spheader as sh')
            ->join('master_pelanggan as mp', 'sh.kod_lan', '=', 'mp.kodlan')
            ->where('sh.status_sp', 'Deal')
            ->whereIn('mp.Jenjang', ['TK', 'SD', 'SMP', 'SMA', 'SMK'])
            ->where('mp.NamLan', 'NOT LIKE', '%PAMERAN%')
            ->where('mp.NamLan', 'NOT LIKE', '%SHOPEE%')
            ->where('mp.NamLan', 'NOT LIKE', '%ERLASS POP%')
            ->where('mp.NamLan', 'NOT LIKE', '%SOLIDARITAS%')
            ->where('mp.NamLan', 'NOT LIKE', '%CAFE%')
            ->select(
                'mp.kodlan',
                'mp.NamLan as name',
                'mp.Kota as city',
                'mp.Provinsi as province',
                'mp.Jenjang as level',
                DB::raw('COUNT(sh.no_sp) as total_deals')
            )
            ->groupBy('mp.kodlan', 'mp.NamLan', 'mp.Kota', 'mp.Provinsi', 'mp.Jenjang')
            ->orderByDesc('total_deals')
            ->get();

        $count = 0;
        foreach ($schools as $index => $school) {
            $name = trim($school->name);
            $city = trim($school->city ?? 'Jabodetabek');
            $isFeatured = ($index < 30); // Top 30 featured on homepage showcase

            Partner::updateOrCreate(
                ['kodlan' => $school->kodlan],
                [
                    'name' => $name,
                    'slug' => Str::slug($name . '-' . $school->kodlan),
                    'city' => $city,
                    'province' => trim($school->province ?? ''),
                    'level' => $school->level,
                    'type' => 'school',
                    'total_deals' => $school->total_deals,
                    'is_featured' => $isFeatured,
                    'sort_order' => $index + 1,
                ]
            );
            $count++;
        }

        $this->info("✓ Berhasil menyinkronkan {$count} sekolah mitra berstatus Deal.");
    }
}
