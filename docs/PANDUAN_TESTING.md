# Panduan Pengujian

## 1. Pengujian Otomatis

```bash
php artisan test
```

Uji berjalan di **database SQLite di memori** (diatur di `phpunit.xml`), sehingga aman dijalankan kapan saja tanpa menyentuh database MySQL. Setiap uji membuat ulang tabel dan menjalankan seeder.

| File | Yang diuji |
|---|---|
| `tests/Feature/PublicSiteTest.php` | Semua halaman publik & filter, halaman 404, isi beranda, JSON-LD & sitemap valid, pengalihan rombel, views sekali per sesi, moderasi komentar & Kontak Promosi, newsletter, form konsultasi, header keamanan |
| `tests/Feature/AdminPanelTest.php` | Semua halaman admin terbuka, hak akses tiap role, simpan ulang form data yang ada, form tambah data (produk, galeri + upload, kolom LMS, kategori, FAQ, pengguna, kontak), kolom LMS (tambah/keluarkan/urutkan produk), alur artikel Writer → Admin, moderasi komentar, ekspor CSV, Pengaturan Situs & Beranda, Riwayat Perubahan, filter tabel produk |
| `tests/Feature/LeadTest.php` | Form konsultasi |

Menjalankan sebagian uji:

```bash
php artisan test --filter=AdminPanelTest
php artisan test --filter=test_article_review_workflow
```

**Aturan:** setiap menambah fitur atau tombol admin, tambahkan ujinya. Pengujian lama yang hanya membuka halaman tidak menangkap error yang baru muncul saat tombol diklik, sehingga uji harus memanggil aksinya (`callAction`, `callTableAction`, `call('save')`).

> Peringatan: jangan pernah mengubah `DB_CONNECTION` di `phpunit.xml` ke MySQL. Uji memakai `RefreshDatabase` yang mengosongkan database.

## 2. Pengujian Manual (sebelum rilis)

### Situs publik
- [ ] Beranda: slider hero, kolom Produk LMS, carousel Katalog Unggulan (panah & titik), tab video di *Why Erlass?*, artikel terbaru, form konsultasi
- [ ] Katalog: filter, pencarian, urutan, halaman berikutnya; detail produk (tombol WhatsApp/Shopee/LMS, FAQ, jumlah dilihat)
- [ ] Artikel: kategori, hashtag, pencarian, artikel disematkan di atas, navigasi halaman; kirim komentar dan balasan
- [ ] Galeri: putar video, pilih video lain dari panel rekomendasi, filter kategori & sub-kategori foto
- [ ] Footer: jam layanan, media sosial, Shopee, newsletter
- [ ] Tampilan HP (lebar ±390 px): menu, carousel, tabel tidak meluber

### Panel admin
- [ ] Login dengan tiap role, pastikan menu yang tampil sesuai
- [ ] Writer: buat artikel → Ajukan Persetujuan; Admin: Minta Revisi → Setujui & Terbitkan → Sematkan
- [ ] Ubah link Shopee di Pengaturan Situs, lalu cek tombol Shopee di katalog
- [ ] Ubah judul hero di Pengaturan Beranda, lalu cek beranda, lalu **Kembalikan ke Bawaan**
- [ ] Kolom Produk LMS: tambah produk, urutkan, keluarkan
- [ ] Riwayat Perubahan mencatat semua langkah di atas
