# Changelog

Catatan perubahan website erlass.co.id. Format: tanggal, lalu perubahan per kelompok.

## 2026-11-26: Navbar Baru, Bahasa Inggris, Banner Geser, Halaman LMS

> **Saat deploy wajib menjalankan `php artisan migrate`** (kolom versi bahasa Inggris untuk produk dan artikel), lalu `php artisan optimize:clear`.

### Ditambahkan
- **Navbar**: pencarian (katalog/artikel, pintasan `/`), pilihan bahasa **ID/EN**, lencana **LMS Erlass Academy** dengan tombol kecil Konsultasi di bawahnya.
- **Halaman `/lms`**: Intrakurikuler, Course, dan Asesmen dengan LMS; tombol loncat per kolom juga tampil di beranda di bawah Pusat Sumber Daya Guru.
- **Mode bahasa Inggris**: seluruh teks situs diterjemahkan; produk dan artikel punya isian **Versi Bahasa Inggris (EN)** di admin (kolom & filter "EN" di tabel). Produk dan 4 artikel bawaan sudah terisi.
- **Banner geser di beranda** (autoplay, panah, titik, geser di HP); slide dan fotonya diatur di Pengaturan Beranda. Slide ke-4: Asesmen Potensi Minat dan Bakat.
- **Logo sekolah mitra**: unggah logo di admin Sekolah Mitra, tampil di deretan "Telah dipercaya oleh"; filter "belum ada logo" dan sakelar tampil di beranda.
- **Menu Panduan** di panel admin (di bawah Dashboard) dengan panduan sesuai role; sumbernya `docs/PANDUAN_PER_ROLE.md`.
- Daftar kata terlarang komentar diperluas menjadi ±170 kata/frasa (umpatan, singkatan kasar, cabul, ancaman, SARA, judi online, bahasa Inggris).

### Diubah
- Warna situs lebih cerah: header halaman bertema terang, kontras teks/tombol mengikuti WCAG, hiasan banner berbeda tiap slide.
- Bar pengumuman atas dan item LMS di dropdown Produk dihapus; bagian LMS di beranda diringkas.
- Admin Sekolah Mitra dan Kategori Produk dirapikan (label Indonesia, slug otomatis, filter).
- Tombol "Dokumentasi Kegiatan" di bagian Why Erlass dipindah ke bawah video; tombol konsultasi di bagian itu dihapus.
- Bahasa bawaan situs selalu Indonesia.

### Diperbaiki
- Filter komentar tidak lagi salah menahan kata normal seperti "Kusuma Bangsa" dan "perekonomian".
- Halaman produk error di mode EN; peringatan PHP di filter katalog.
- Listing artikel tidak lagi memuat isi artikel penuh (lebih ringan); query beranda yang tidak terpakai dihapus.

## 2026-11-25: Katalog, Artikel, Panel Admin Berbasis Role

### Ditambahkan
- **Katalog produk** (`/katalog`): filter kategori/jenjang/jenis/Shopee/LMS, urutan populer/terbaru/paling dilihat, sampul produk otomatis, halaman detail dengan tombol WhatsApp/Shopee/LMS.
- **Produk LMS Erlass Academy**: Intrakurikuler (Informatika & Koding KA SD/SMP/SMA), Course LMS (Scratch, Micro:bit, Python, HTML), Asesmen Kelas 1-3 s.d. 10-12, Pusat Sumber Daya Guru (gratis).
- **Kolom Produk LMS** di beranda yang bisa ditambah dan diisi produk dari admin.
- **FAQ**: Pertanyaan Seputar Katalog dan template Pertanyaan Umum produk dengan variabel; FAQ khusus per produk.
- **Artikel** (`/artikel`): kategori dari admin, hashtag, pencarian, 10 per halaman, pin, komentar berbalas, jumlah dilihat.
- **Moderasi komentar otomatis** (kata kasar, judi online, tautan, huruf kapital semua).
- **Galeri**: pemutar video YouTube dengan rekomendasi; arsip foto berkategori dan sub-kategori.
- **Panel admin**: role Super Admin / Admin / Content Writer, alur persetujuan artikel, Komentar, Kontak Promosi (+ ekspor CSV), Subscriber, Pengguna & Role, Pengaturan Situs, Pengaturan Beranda, **Riwayat Perubahan**.
- **SEO/GEO**: JSON-LD, sitemap dinamis, `llms.txt`, robots.txt untuk crawler AI; contoh pengisian SEO di form admin.
- **Uji otomatis**: 23 uji untuk situs publik dan panel admin.
- Dokumentasi: `docs/PANDUAN_ADMIN.md`, `docs/DEPLOYMENT.md`, dan pembaruan dokumen lain.

### Diubah
- Beranda: bagian "Enam kategori" diganti Produk Digital LMS; Katalog Unggulan menjadi carousel; tab video di Why Erlass; kartu Program Intrakurikuler diperbarui.
- Jam layanan: Senin–Jumat 08:00–16:00 WIB, Sabtu 08:00–13:00 WIB.
- Produk dengan judul sama (beda kode rombel) tampil sekali di katalog.
- Akses panel admin: hanya akun aktif dengan role valid (sebelumnya semua akun).

### Keamanan & Performa
- Header keamanan (CSP, HSTS, X-Frame-Options, dll.), `TRUSTED_PROXIES` opsional, blokir file tersembunyi & PHP di folder upload.
- Gambar galeri WebP (±5 MB → ±0,8 MB), cache data halaman otomatis, kompresi & cache browser.

### Diperbaiki
- Nomor WhatsApp yang salah di halaman galeri.
- Form Produk admin yang error pada kolom jenjang dan fitur.
- Tombol "Tambah produk ke kolom" di Kolom Produk LMS.
- Error "Undefined variable" di beranda setelah update (cache data lama).

### Catatan Upgrade
```bash
php artisan migrate --force
php artisan db:seed --class=LmsCatalogSeeder --force
php artisan db:seed --class=FaqSeeder --force
php artisan db:seed --class=GallerySeeder --force
php artisan erlass:sync-contacts
php artisan optimize:clear && php artisan optimize
```
Pasang cron `php artisan schedule:run` (lihat [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)).
