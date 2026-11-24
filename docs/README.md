# Dokumentasi Website Erlass

Dokumentasi website **erlass.co.id** (PT Erlass Prokreatif Indonesia): website korporat, katalog produk, artikel, dan galeri, dikelola lewat panel admin berbasis role.

## Pilih Dokumen Sesuai Kebutuhan

| Saya ingin... | Baca |
|---|---|
| Mengelola isi website (artikel, produk, pengaturan) | [PANDUAN_ADMIN.md](PANDUAN_ADMIN.md) |
| Menjalankan project di komputer sendiri | [PANDUAN_INSTALASI.md](PANDUAN_INSTALASI.md) |
| Memasang / memperbarui website di server | [DEPLOYMENT.md](DEPLOYMENT.md) |
| Memahami struktur kode | [ARSITEKTUR.md](ARSITEKTUR.md) |
| Mengubah tampilan, nilai bawaan, atau menambah bagian | [PANDUAN_KUSTOMISASI.md](PANDUAN_KUSTOMISASI.md) |
| Menjalankan pengujian | [PANDUAN_TESTING.md](PANDUAN_TESTING.md) |
| Melihat apa saja yang berubah | [../CHANGELOG.md](../CHANGELOG.md) |

## Ringkasan Fitur

- **Beranda dinamis**: hero & slider, Produk Digital LMS, Katalog Unggulan, Why Erlass dengan video; semua bisa diatur dari admin.
- **Katalog produk**: filter lengkap, sampul otomatis, label Shopee & LMS, FAQ per produk, jumlah dilihat.
- **Artikel**: kategori, hashtag, pin, komentar dengan moderasi otomatis, alur persetujuan Writer → Admin.
- **Galeri**: video YouTube + rekomendasi, arsip foto berkategori.
- **Pemasaran**: Lead konsultasi, Kontak Promosi (dengan izin UU PDP) dan ekspor CSV, newsletter.
- **Admin**: 3 role (Super Admin, Admin, Content Writer), Pengaturan Situs & Beranda, Riwayat Perubahan.
- **SEO/GEO, keamanan, performa**: JSON-LD, sitemap, `llms.txt`, header keamanan, cache otomatis, gambar WebP.

## Rute Utama

| Rute | Halaman |
|---|---|
| `/` | Beranda |
| `/katalog`, `/katalog/{slug}` | Katalog & detail produk |
| `/artikel`, `/artikel/{slug}` | Artikel & detail artikel |
| `/gallery` | Galeri video & foto |
| `/programs/{slug}` | Detail program |
| `/admin` | Panel admin |
