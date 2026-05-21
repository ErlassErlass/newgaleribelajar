# Panduan Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan website Erlass di komputer lokal Anda.

## Prasyarat

- **PHP**: Versi 8.4 atau lebih baru.
- **Composer**: Dependency manager untuk PHP.
- **Node.js**: Versi 20+ (untuk build aset frontend).
- **Laragon**: Lingkungan server lokal (disarankan untuk Windows, otomatis membuat virtual host).

## Langkah Instalasi

1.  **Clone/Copy Project**
    Pastikan file project berada di direktori web server Anda (contoh: `c:/laragon/www/galeribelajar`).

2.  **Install Backend Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    ```
    Perintah ini akan menginstall Tailwind CSS v4, Vite 7, Three.js, GSAP, dan Lenis.

4.  **Konfigurasi Environment**
    Copy file contoh environment:
    ```bash
    cp .env.example .env
    ```
    Generate application key:
    ```bash
    php artisan key:generate
    ```

5.  **Build Aset**
    Untuk production build (siap pakai tanpa dev server):
    ```bash
    npm run build
    ```
    Untuk development (hot reload - perubahan langsung terlihat):
    ```bash
    npm run dev
    ```
    > **Catatan**: Jika menggunakan `npm run dev`, file `public/hot` akan dibuat. Ketika selesai dev, stop server dan hapus `public/hot` agar Laravel kembali menggunakan built assets.

6.  **Jalankan Server**
    Jika menggunakan Laragon dengan fitur *auto virtual host*, buka `http://galeribelajar.test`.
    Atau gunakan built-in server Laravel:
    ```bash
    php artisan serve
    ```
    Lalu buka `http://127.0.0.1:8000` di browser.

## URL Lokal

| Metode | URL |
|--------|-----|
| Laragon Virtual Host | `http://galeribelajar.test` |
| PHP Artisan Serve | `http://localhost:8000` |

## Troubleshooting Umum

- **Style berantakan / HTML polos?** → Hapus `public/hot` lalu jalankan `npm run build`.
- **Warning `proc_open` di Version.php?** → Git tidak ada di PATH. Aman diabaikan (sudah di-suppress).
- **Font warning saat build?** → Normal. Font custom di-load runtime dari `/public/fonts/`.
