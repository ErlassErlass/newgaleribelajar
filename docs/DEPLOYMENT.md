# Panduan Deploy ke Server Produksi

Untuk developer atau admin server yang memasang dan memperbarui website di produksi.

## Prasyarat Server

- PHP **8.2+** dengan ekstensi `pdo_mysql`, `gd` (dengan WebP), `intl`, `mbstring`, `zip`, `curl`
- MySQL 8 / MariaDB 10.6+
- Composer 2, Node.js 20+ (hanya bila build aset dilakukan di server)
- Apache dengan `mod_rewrite`, `mod_headers`, `mod_expires`, `mod_deflate` (sudah dikonfigurasi di `public/.htaccess`), atau Nginx yang setara
- Document root mengarah ke folder **`public/`**

## Pengaturan `.env` Produksi

```ini
APP_ENV=production
APP_DEBUG=false
APP_URL=https://erlass.co.id

SESSION_SECURE_COOKIE=true      # cookie hanya lewat HTTPS
# TRUSTED_PROXIES=*             # isi HANYA jika di belakang Cloudflare / load balancer

# Opsional, bisa juga diatur dari admin (Sistem › Pengaturan Situs)
# ERLASS_SHOPEE_URL=https://shopee.co.id/erlassproind
# ERLASS_WHATSAPP=6282311341381
```

> `APP_URL` harus alamat asli situs. Nilai ini dipakai untuk link di sitemap, `llms.txt`, dan gambar.

## Instalasi Pertama

```bash
git clone https://github.com/ErlassErlass/newgaleribelajar.git
cd newgaleribelajar
composer install --no-dev --optimize-autoloader
cp .env.example .env && php artisan key:generate   # lalu isi .env
php artisan migrate --seed --force
php artisan erlass:sync-contacts                    # isi Kontak Promosi dari data lama (aman diulang)
php artisan optimize                                # cache config, route, view
```

Aset frontend (`public/build`) dan aset Livewire/Filament (`public/vendor`, `public/js/filament`, `public/css/filament`) sudah ikut di repositori, jadi `npm run build` tidak wajib di server.

Folder yang harus bisa ditulis web server: `storage/`, `bootstrap/cache/`, dan **`public/uploads/`** (hasil upload dari admin).

## Memperbarui Server (Update Rutin)

```bash
php artisan down
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force           # JANGAN migrate:fresh (menghapus semua data)
php artisan optimize:clear && php artisan optimize
php artisan up
```

Seeder **tidak perlu** dijalankan saat update, kecuali ada catatan di [CHANGELOG](../CHANGELOG.md). Perhatikan: `DatabaseSeeder` mereset password akun `admin@erlass.co.id`.

Seeder yang aman dijalankan ulang bila diperlukan:

```bash
php artisan db:seed --class=LmsCatalogSeeder --force   # produk LMS & penanda Shopee
php artisan db:seed --class=FaqSeeder --force          # hanya mengisi bila tabel FAQ kosong
php artisan db:seed --class=GallerySeeder --force      # foto galeri awal
```

## Cron Scheduler (Wajib)

Dibutuhkan untuk menghapus Riwayat Perubahan yang lebih dari 365 hari:

```cron
* * * * * cd /path/ke/newgaleribelajar && php artisan schedule:run >> /dev/null 2>&1
```

Cek jadwal: `php artisan schedule:list`.

## Setelah Deploy: Daftar Periksa

- [ ] Login ke `/admin` dengan akun Super Admin, lalu **ganti kata sandi**
- [ ] Buat akun untuk Admin dan Content Writer di **Sistem › Pengguna & Role**
- [ ] Periksa **Sistem › Pengaturan Situs** (link Shopee, WhatsApp, jam layanan, video)
- [ ] Buka beranda, katalog, artikel, galeri, lalu cek video YouTube dan font tampil normal (aktifnya CSP di produksi)
- [ ] Buka `https://erlass.co.id/sitemap.xml` dan `https://erlass.co.id/llms.txt`, pastikan link memakai domain asli
- [ ] Daftarkan sitemap di Google Search Console

## Catatan Keamanan

- `APP_DEBUG` wajib `false` di produksi, agar pesan error tidak membocorkan isi `.env`.
- Hanya akun **aktif** dengan role valid yang bisa masuk `/admin`. Login dibatasi 5 percobaan per menit, dan login gagal tercatat di Riwayat Perubahan.
- Header keamanan (CSP, HSTS, X-Frame-Options, dll.) dipasang oleh `app/Http/Middleware/SecurityHeaders.php`. CSP tidak aktif saat `APP_ENV=local` agar Vite dev server berjalan.
- Bila server PHP gagal mengambil data YouTube (error cURL 60 / SSL), atur `curl.cainfo` di `php.ini`. Halaman tetap tampil tanpa angka views.
