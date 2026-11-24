<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/** Default FAQs (the texts that used to be hard-coded in the catalog views). Only seeds an empty table. */
class FaqSeeder extends Seeder
{
    public function run(): void
    {
        if (Faq::exists()) {
            return;
        }

        $catalog = [
            ['Apa saja produk yang tersedia di katalog Erlass Academy?', 'Erlass Academy menyediakan {total_produk} produk dalam kategori {kategori_katalog}. Produk terdiri dari program/layanan (ekskul, intrakurikuler, pelatihan guru), produk LMS, dan produk fisik (modul cetak, Micro:bit Learning Kit, kit robotika).'],
            ['Untuk jenjang apa produk Erlass?', 'Produk Erlass dirancang untuk siswa SD, SMP, hingga SMA/SMK dan selaras dengan Kurikulum Merdeka mata pelajaran Informatika. Setiap produk mencantumkan jenjang yang direkomendasikan.'],
            ['Bagaimana cara membeli produk Erlass?', 'Sekolah dapat mengajukan penawaran melalui formulir konsultasi atau WhatsApp {whatsapp}. Modul, learning kit, dan produk LMS juga dapat dibeli di toko Shopee resmi Erlass ({shopee}).'],
            ['Apakah Erlass menyediakan instruktur ke sekolah?', 'Ya. Program ekskul dan intrakurikuler Erlass sudah termasuk kurikulum, modul, perangkat, serta pendampingan instruktur profesional dan sertifikat untuk siswa.'],
        ];

        $product = [
            ['Apa itu {produk}?', '{produk} adalah {jenis} dari Erlass Academy dalam kategori {kategori} untuk jenjang {jenjang}. {ringkasan}'],
            ['Untuk jenjang apa {produk} cocok digunakan?', '{produk} direkomendasikan untuk jenjang {jenjang} dan selaras dengan Kurikulum Merdeka.'],
            ['Bagaimana cara memesan {produk}?', 'Sekolah dapat meminta penawaran melalui WhatsApp Erlass {whatsapp} atau formulir konsultasi di erlass.co.id. {info_pembelian}'],
            ['Apa yang didapat sekolah dari {produk}?', '{fitur}'],
        ];

        foreach ([Faq::SCOPE_CATALOG => $catalog, Faq::SCOPE_PRODUCT => $product] as $scope => $items) {
            foreach ($items as $i => [$q, $a]) {
                Faq::create(['scope' => $scope, 'question' => $q, 'answer' => $a, 'sort_order' => $i, 'is_active' => true]);
            }
        }
    }
}
