# Panduan Instalasi Lokal

## Prasyarat

- **PHP 8.2+** dengan ekstensi `pdo_mysql`, `pdo_sqlite` (untuk uji otomatis), `gd`, `intl`, `mbstring`
- **Composer 2**
- **Node.js 20+**
- **MySQL** (mis. lewat Laragon atau XAMPP di Windows)

## Langkah

```bash
git clone https://github.com/ErlassErlass/newgaleribelajar.git
cd newgaleribelajar
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Isi koneksi database di `.env`:

```ini
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newgaleribelajar_db
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `newgaleribelajar_db`, lalu:

```bash
php artisan migrate --seed
npm run dev          # terminal 1: aset dengan hot reload
php artisan serve    # terminal 2: http://127.0.0.1:8000
```

Panel admin: `http://127.0.0.1:8000/admin`, akun `admin@erlass.co.id` (Super Admin, kata sandi ada di `DatabaseSeeder`).

## Isi Data Awal (Seeder)

| Seeder | Isi |
|---|---|
| `CrmDataSeeder` | 7 kategori, 130 produk, 407 sekolah mitra dari `database/seeders/data/*.json` |
| `LmsCatalogSeeder` | Produk LMS (Informatika, Koding KA, Course LMS, Asesmen, Pusat Sumber Daya Guru) dan penanda Shopee |
| `ArticleSeeder` | Contoh artikel |
| `GallerySeeder` | Foto galeri awal |
| `FaqSeeder` | FAQ katalog & template FAQ produk (hanya bila tabel kosong) |

Kolom LMS beranda (`lms_groups`) dan kategori artikel dibuat oleh migrasi.

## Masalah yang Sering Muncul

| Gejala | Penyebab & solusi |
|---|---|
| Setelah `migrate:fresh --seed` menu admin hanya berisi Artikel | Akun belum Super Admin. Seeder terbaru sudah mengaturnya; jalankan `php artisan db:seed` lagi |
| Tampilan tanpa gaya (CSS tidak termuat) | Ada file `public/hot` tapi `npm run dev` tidak jalan. Jalankan `npm run dev`, atau hapus `public/hot` dan jalankan `npm run build` |
| Kelas Tailwind baru tidak berpengaruh | Jalankan `npm run build` (atau biarkan `npm run dev` berjalan) |
| Angka views video YouTube tidak muncul | PHP lokal belum punya sertifikat CA (cURL error 60). Atur `curl.cainfo` di `php.ini`. Tidak memengaruhi fitur lain |
| Perubahan config tidak terlihat | `php artisan optimize:clear` |
