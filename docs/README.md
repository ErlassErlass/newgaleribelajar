# Dokumentasi Erlass - Mitra Pendidikan K-12

Selamat datang di dokumentasi website **Erlass** (`erlass.co.id`). Website ini adalah website corporate dan landing page B2B resmi untuk PT Erlass Prokreatif Indonesia yang menyediakan program Coding, Robotika, Micro:bit, LMS Kaizen, dan Asesmen Siswa untuk sekolah di Indonesia.

## Tautan Cepat

- [Instalasi & Setup](PANDUAN_INSTALASI.md) - Cara menjalankan project ini.
- [Arsitektur & Tech Stack](ARSITEKTUR.md) - Penjelasan tentang Laravel 12, Vite, Three.js, GSAP, dan Lenis.
- [Panduan Kustomisasi](PANDUAN_KUSTOMISASI.md) - Cara mengganti warna, konten, dan efek 3D.
- [Panduan Pengujian](PANDUAN_TESTING.md) - Cara melakukan tes manual.
- [Dokumentasi Lengkap](../DOCUMENTATION.md) - Dokumentasi teknis detail (section breakdown, JS modules, CSS architecture).

## Sekilas Project

Website ini berfungsi sebagai wajah digital **PT Erlass Prokreatif Indonesia**. Fitur utamanya:

- **3D Interactive Hero**: Background jaringan partikel interaktif menggunakan Three.js.
- **Modern Styling**: Tailwind CSS v4 dengan kids storybook aesthetic.
- **Smooth Scroll**: Lenis untuk pengalaman scroll yang halus.
- **Smooth Animations**: GSAP (GreenSock) untuk animasi reveal saat scroll.
- **Internationalization**: Dukungan bahasa Indonesia dan Inggris.
- **Lead Form**: Form kontak untuk sekolah/mitra pendidikan.
- **Mobile Responsive**: Hamburger menu + responsive layout.
- **WhatsApp Integration**: Floating button untuk kontak langsung CS Alya.

## Halaman

| Route | Halaman |
|-------|---------|
| `/` | Landing page utama (Hero → About → Why Us → Programs → Clients → Testimoni → Contact) |
| `/programs/coding` | Detail program Coding & AI |
| `/programs/robotics` | Detail program Robotika & IoT |
| `/gallery` | Galeri foto & video kegiatan |

## Struktur Direktori

- `resources/views` - Template Blade (Struktur HTML).
- `resources/views/components` - Komponen reusable (Hero, Magnetic Button).
- `resources/views/sections` - Section partials (Why Choose Us, Clients).
- `resources/views/programs` - Halaman detail program.
- `resources/css` - Entry point CSS (Tailwind + custom styles).
- `resources/js` - Logika JavaScript (Three.js, GSAP, Lenis, Cursor).
- `resources/lang` - File terjemahan (id/en).
- `public/img/cp` - Aset gambar Company Profile (31 logo sekolah mitra).
