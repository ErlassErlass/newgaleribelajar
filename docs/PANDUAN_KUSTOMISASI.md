# Panduan Kustomisasi

## Mengubah Konten

### Teks & Lokalisasi
Konten teks tersentralisasi di file bahasa:
- **Indonesia**: `resources/lang/id/content.php`
- **English**: `resources/lang/en/content.php`

Semua teks *hard-coded* di landing page (Hero, About, Why Us, Programs, Clients, Testimoni, Contact form, hingga Footer) kini sudah terhubung penuh ke *translation keys* `__()`. Untuk mengganti konten apapun, cukup edit *key-value* di dalam file-file tersebut. Switcher bahasa (ID/EN) di Navbar akan langsung mengaplikasikan perubahan secara otomatis.

### Gambar
Gambar company profile (logo sekolah mitra) berada di `public/img/cp/`.
- Ganti file `1.png` s/d `31.png` dengan logo baru yang berukuran sama. Komponen client-marquee akan memuat semua 31 logo ke dalam 3 baris secara otomatis.
- Pastikan format PNG dengan background transparan untuk hasil terbaik.

### Testimoni
Testimoni kini juga diatur lewat fungsi lokalisasi. Edit *array* `testimoni.items` di dalam file `resources/lang/id/content.php` untuk menambahkan atau mengubah nama, jabatan, dan kutipan sesuai data sekolah mitra.

## Memodifikasi Background 3D

Logika 3D terdapat di file `resources/js/hero-3d.js`.

### Mengubah Warna Partikel
Cari definisi `particlesMaterial`:
```javascript
const particlesMaterial = new THREE.PointsMaterial({
    color: 0x4f46e5, // Ganti kode Hex ini (contoh: 0xffd700 untuk Emas)
    ...
});
```

### Mengubah Jumlah / Kepadatan Partikel
Sesuaikan variabel `particlesCount`:
```javascript
const particlesCount = 700; // Naikkan untuk lebih padat, turunkan untuk performa lebih ringan
```

## Styling (CSS)

### Warna Tema
Edit palet warna di `resources/css/app.css`:
```css
@theme {
    --color-kids-yellow: #ffd600;    /* Hero background, CTA utama */
    --color-kids-blue: #99e1ff;      /* Shadow tombol */
    --color-kids-navy: #1d758b;      /* Teks heading */
    --color-kids-pink: #ffb3c6;      /* Badge */
    --color-kids-mint: #a2e8dd;      /* CTA sekunder */
    --color-kids-orange: #ff7f50;    /* Aksen */
}
```

### Font
Font utama dikonfigurasi di `resources/css/app.css`:
- `font-sans`: Source Sans 3 (teks paragraf)
- `font-serif`: Playfair Display (heading)
- `font-popstar`: Scribble Show (dekoratif)

Untuk mengganti, update `@theme` dan `<link>` di `layouts/app.blade.php`.

### WhatsApp Nomor
Ubah nomor di `layouts/app.blade.php` — cari `wa.me/6282311341381` dan ganti ke nomor baru.

## Setelah Perubahan

Selalu jalankan `npm run build` setelah mengubah file CSS atau JS agar perubahan ter-compile ke production.
