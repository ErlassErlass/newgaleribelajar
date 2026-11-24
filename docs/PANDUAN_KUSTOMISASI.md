# Panduan Kustomisasi

Sebagian besar isi website kini diubah lewat **panel admin**, tanpa menyentuh kode. Lihat [PANDUAN_ADMIN.md](PANDUAN_ADMIN.md).

## Diubah dari Admin (tanpa developer)

| Ingin mengubah | Menu admin |
|---|---|
| Link Shopee, WhatsApp, telepon, email, jam layanan, alamat, media sosial | Sistem › Pengaturan Situs |
| Video YouTube (tab *Why Erlass?* & galeri) | Sistem › Pengaturan Situs › Video |
| Kata terlarang di komentar | Sistem › Pengaturan Situs › Moderasi Komentar |
| Teks hero, foto slider, judul tiap bagian beranda, tampil/sembunyi bagian | Sistem › Pengaturan Beranda |
| Produk, foto produk, link Shopee per produk | Katalog › Produk |
| Kolom produk LMS di beranda | Katalog › Kolom Produk LMS |
| FAQ katalog & template FAQ produk | Katalog › Pertanyaan (FAQ) |
| Kategori artikel | Konten › Kategori Artikel |
| Foto galeri | Konten › Galeri Foto |

## Diubah oleh Developer

### Nilai bawaan
- `config/erlass.php`: kontak, link, dan video bawaan (dipakai bila belum diatur di admin; juga bisa lewat `.env`, lihat `.env.example`)
- `config/homepage.php`: teks bawaan beranda dan daftar bagiannya
- `config/gallery.php`: kategori & sub-kategori galeri foto
- `config/moderation.php`: daftar kata terlarang bawaan

### Foto produk tanpa admin
Taruh file di `public/img/products/` dengan nama kode produk (`msj01.jpg`) atau nama produk (`microbit-learning-kit.webp`). Format: webp, jpg, jpeg, png.

### Tampilan sampul otomatis
`app/Support/ProductCover.php`: tema warna & ilustrasi ditentukan dari kata di nama produk (`NAME_THEMES`) atau kategori (`CATEGORY_THEMES`), warna di `PALETTES`.

### Warna & font
- Palet merek di `resources/css/app.css` (`@theme`) dan langsung di kelas Tailwind (`#023047`, `#219ebc`, `#8ecae6`, `#ffb703`, `#fb8500`).
- Font Plus Jakarta Sans dimuat dari Google Fonts di `resources/views/layouts/app.blade.php`.

### Latar 3D hero
`resources/js/hero-3d.js`: warna partikel (`particlesMaterial`) dan jumlah partikel (`particlesCount`).

### Menambah halaman atau bagian beranda
1. Tambah markup di `resources/views/welcome.blade.php` dengan `<section id="nama">`.
2. Tambah entri `nama` di `config/homepage.php` (`label`, `visible`, `badge`, `title`, `subtitle`) dan pakai `{{ $hp['sections']['nama']['title'] }}` di view; bungkus dengan `@if($hp['sections']['nama']['visible'] ?? true)`.
3. Form Pengaturan Beranda otomatis menampilkan bagian baru.

## Setelah Mengubah Kode

```bash
npm run build              # bila mengubah CSS/JS atau menambah kelas Tailwind
php artisan optimize:clear # bila mengubah file config
php artisan test           # pastikan tidak ada yang rusak
```
