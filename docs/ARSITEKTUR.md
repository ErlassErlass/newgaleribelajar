# Arsitektur & Teknologi

## Core Framework: Laravel 12
Project ini menggunakan versi terbaru Laravel untuk struktur yang kokoh, keamanan, dan kemudahan pengembangan.
- **Routing**: Didefinisikan di `routes/web.php` (6 routes: home, gallery, coding, robotics, leads, lang).
- **Views**: Menggunakan Blade Templating Engine dengan pendekatan Components & Sections.
- **Asset Handling**: Terintegrasi via `laravel-vite-plugin`.
- **Internationalization**: Middleware `SetLocale` + file `resources/lang/{id,en}/content.php`.

## Frontend Stack

### 1. Tailwind CSS v4
Engine terbaru Tailwind untuk styling tanpa runtime overload.
- **Konfigurasi**: CSS-first config di `resources/css/app.css` (Tailwind v4 mendeteksi dari CSS langsung).
- **Design System**: Menggunakan Shadcn-compatible design tokens (`oklch` colors).
- **Tema**: Kids Storybook Aesthetic (yellow, blue, pink, mint, navy) + Corporate palette (erlass-dark, erlass-blue, erlass-orange).

### 2. Three.js (Grafis 3D)
Digunakan untuk background interaktif "Hero" di halaman utama.
- **File**: `resources/js/hero-3d.js`.
- **Logika**: Membuat `THREE.Scene` dengan 700 partikel indigo yang merespons gerakan mouse.
- **Performa**: WebGL renderer dengan alpha channel (transparan) dan anti-aliasing.
- **Fallback**: Jika WebGL tidak tersedia, canvas disembunyikan secara graceful.

### 3. GSAP (Animasi)
GreenSock Animation Platform menangani animasi elemen DOM.
- **Hero**: Text splitting + staggered word reveal (`resources/js/hero.js`).
- **Scroll**: Section reveal, slide-in, dan scale animations (`resources/js/scroll-animations.js`).
- **Integrasi**: ScrollTrigger plugin dibridge dengan Lenis untuk smooth scroll compatibility.

### 4. Lenis (Smooth Scroll)
Smooth scroll library yang ringan.
- **File**: `resources/js/lenis.js`.
- **Bridge**: `lenis.on('scroll', ScrollTrigger.update)` — wajib agar GSAP ScrollTrigger sinkron dengan Lenis.
- **Config**: `duration: 1.4`, `smoothWheel: true`.

### 5. Vite 7
Build tool yang memproses CSS, JS, dan aset lainnya.
- **Hot Replacement**: Update instan saat file diedit (saat jalan `npm run dev`).
- **Optimasi**: Tree-shaking dan minifikasi otomatis saat `npm run build`.
- **Catatan**: Jika styling tidak muncul, hapus `public/hot` lalu jalankan `npm run build`.

## Interaction Modules

| Module | File | Fungsi |
|--------|------|--------|
| Custom Cursor | `cursor.js` + `cursor.css` | Kursor dot+circle (hanya desktop) |
| Magnetic Button | `magnetic.js` | Tombol "ditarik" mendekati mouse |
| Card Hover | `card-hover.js` | 3D tilt effect + mouse gradient pada kartu |
