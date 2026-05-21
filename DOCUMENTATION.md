# 📖 Dokumentasi Proyek Galeribelajar.com (Erlass)

> **Versi:** 2.0  
> **Terakhir Diperbarui:** 21 Mei 2026  
> **Stack:** Laravel 12 + Tailwind CSS 4 + Vite 7 + GSAP + Lenis + Three.js

---

## Daftar Isi

1. [Gambaran Umum](#1-gambaran-umum)
2. [Struktur Folder](#2-struktur-folder)
3. [Teknologi & Dependencies](#3-teknologi--dependencies)
4. [Identitas Visual (Design System)](#4-identitas-visual-design-system)
5. [Halaman & Routing](#5-halaman--routing)
6. [Breakdown Section Landing Page](#6-breakdown-section-landing-page)
7. [JavaScript Modules](#7-javascript-modules)
8. [CSS Architecture](#8-css-architecture)
9. [Internasionalisasi (i18n)](#9-internasionalisasi-i18n)
10. [Cara Menjalankan Lokal](#10-cara-menjalankan-lokal)
11. [Troubleshooting](#11-troubleshooting)

---

## 1. Gambaran Umum

**Galeribelajar.com** adalah website landing page B2B untuk **Erlass** (PT Erlass Prokreatif Indonesia) — mitra pendidikan yang menyediakan program **Coding, Robotika, IoT, AI, dan P5** untuk sekolah K-12 di Indonesia. Website ini dibangun menggunakan framework Laravel dengan pendekatan Blade Components, dan menyertakan animasi interaktif menggunakan GSAP + Lenis + Three.js. Tema visual menggunakan *kids storybook aesthetic* yang playful dan profesional.

---

## 2. Struktur Folder

```
galeribelajar/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── LeadController.php          # Form submission handler
│   │   └── Middleware/
│   │       └── SetLocale.php               # Middleware switcher bahasa
│   └── ...
├── public/
│   ├── build/                              # Output Vite (CSS + JS compiled)
│   ├── fonts/                              # Font kustom (Scribble Show, Quicktext, dll)
│   └── img/                                # Gambar dan aset statis
├── resources/
│   ├── css/
│   │   ├── app.css                         # Master CSS: tokens, fonts, theme
│   │   └── cursor.css                      # Styling custom cursor
│   ├── js/
│   │   ├── app.js                          # Entry point: inisialisasi semua module
│   │   ├── lenis.js                        # Smooth scroll + bridge GSAP
│   │   ├── hero.js                         # Animasi hero headline + CTA
│   │   ├── hero-3d.js                      # Partikel Three.js background
│   │   ├── scroll-animations.js            # Animasi scroll per section
│   │   ├── cursor.js                       # Custom cursor (dot + circle)
│   │   ├── magnetic.js                     # Efek magnet pada tombol
│   │   ├── card-hover.js                   # Efek 3D tilt pada kartu produk
│   │   └── bootstrap.js                    # Axios setup
│   ├── lang/
│   │   ├── id/content.php                  # Terjemahan Indonesia
│   │   └── en/content.php                  # Terjemahan Inggris
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Master layout (Navbar + Footer global)
│       ├── components/
│       │   ├── hero.blade.php              # Komponen Hero section
│       │   └── magnetic-btn.blade.php      # Komponen tombol magnet
│       ├── sections/
│       │   ├── why-choose-us.blade.php     # Section "Why Choose Us"
│       │   ├── clients.blade.php           # Section klien/partner
│       │   ├── products.blade.php          # Section produk (versi lama)
│       │   ├── product-detail.blade.php    # Detail produk
│       │   └── why-us.blade.php            # Section why-us (versi lama)
│       ├── programs/
│       │   ├── coding.blade.php            # Halaman program Coding
│       │   └── robotics.blade.php          # Halaman program Robotika
│       ├── welcome.blade.php               # LANDING PAGE UTAMA
│       └── gallery.blade.php               # Halaman galeri
├── routes/
│   └── web.php                             # Definisi route
├── package.json                            # NPM dependencies
└── vite.config.js                          # Konfigurasi Vite bundler
```

---

## 3. Teknologi & Dependencies

### Backend
| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| PHP | 8.4.5 | Runtime server |
| Laravel | 12.x | Framework web |
| Blade | - | Template engine |

### Frontend (Build Tools)
| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| Vite | 7.x | Bundler & dev server |
| Tailwind CSS | 4.x | Utility-first CSS framework |
| PostCSS | - | CSS processing |

### Frontend (Runtime Libraries)
| Library | Versi | Kegunaan |
|---------|-------|----------|
| GSAP | 3.14 | Animasi (timeline, scroll-triggered) |
| Lenis | 1.3 | Smooth scroll |
| Three.js | 0.182 | 3D particles background |

### Font
| Nama Font | Format | Sumber | Penggunaan |
|-----------|--------|--------|------------|
| Source Sans 3 | Variable | Google Fonts (CDN) | Teks utama (`font-sans`) |
| Playfair Display | Variable | Google Fonts (CDN) | Heading/judul (`font-serif`) |
| Scribble Show | OTF | Lokal (`/fonts/`) | Aksen dekoratif |
| Quicktext | OTF | Lokal (`/fonts/`) | Aksen chat/bubble |
| Super Popstar | TTF | Lokal (`/fonts/`) | Aksen judul playful |

---

## 4. Identitas Visual (Design System)

### Palet Warna (Kids Book Theme)
| Token | Hex | Preview | Penggunaan |
|-------|-----|---------|------------|
| `kids-yellow` | `#ffd600` | 🟡 | Background Hero, tombol CTA utama |
| `kids-blue` | `#99e1ff` | 🔵 | Shadow tombol, footer background |
| `kids-navy` | `#1d758b` | 🫐 | Teks utama, heading |
| `kids-pink` | `#ffb3c6` | 🩷 | Badge label, dekorasi |
| `kids-mint` | `#a2e8dd` | 🟢 | Tombol CTA, badge "New" |
| `kids-orange` | `#ff7f50` | 🟠 | Border produk, link "Learn More" |

### Palet Warna (Brand / Corporate)
| Token | Hex | Penggunaan |
|-------|-----|------------|
| `erlass-dark` | `#001bb7` | Warna brand gelap |
| `erlass-blue` | `#0046ff` | Warna brand utama |
| `erlass-orange` | `#ff8040` | Aksen brand |

### Tipografi
| Fungsi | Font | CSS Class | Contoh Penggunaan |
|--------|------|-----------|-------------------|
| **Teks umum** | Source Sans 3 | `font-sans` | Paragraf, tombol, deskripsi |
| **Heading** | Playfair Display | `font-serif` | Judul section, nama buku |
| **Aksen** | Scribble Show | `font-popstar` | Dekorasi judul playful |

### Gaya Tombol (Button Pattern)
```
┌─────────────────────────────┐
│     Teks Tombol (Bold)      │  ← bg-kids-yellow / bg-kids-mint
│                             │
└─────────────────────────────┘
  ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓   ← shadow-[0_8px_0_#99e1ff] (efek 3D)
```
- Rounded full (pill shape)
- Shadow solid biru sebagai efek timbul 3D
- Hover: scale 1.05 + shadow membesar

---

## 5. Halaman & Routing

| Route | Method | View | Keterangan |
|-------|--------|------|------------|
| `/` | GET | `welcome` | Landing page utama |
| `/gallery` | GET | `gallery` | Halaman galeri foto |
| `/programs/coding` | GET | `programs.coding` | Detail program Coding |
| `/programs/robotics` | GET | `programs.robotics` | Detail program Robotika |
| `/leads` | POST | - | Submit form (LeadController) |
| `/lang/{locale}` | GET | - | Ganti bahasa (id/en) |

---

## 6. Breakdown Section Landing Page

Halaman utama (`welcome.blade.php`) terdiri dari section-section berikut, diurutkan dari atas ke bawah:

### 6.0 — Navbar (Global)
**File:** `layouts/app.blade.php`

- Posisi: Fixed di atas, z-index 50
- Efek: Glassmorphism (`backdrop-filter: blur`)
- Desktop: Logo "ERLASS" | Menu (Home, About, Programs, Gallery) | CTA "Gabung Sekarang" | Switcher ID/EN
- Mobile: Hamburger button → slide-in drawer dari kanan (z-60), backdrop blur, auto-close on link click

### 6.0b — WhatsApp Floating Button (Global)
**File:** `layouts/app.blade.php`

- Posisi: Fixed bottom-right (z-50)
- Animasi: CSS pulse hijau (`wa-pulse`)
- Link: `wa.me/6282311341381` dengan pre-filled message
- Muncul di semua halaman

---

### 6.1 — Hero Section
**File:** `components/hero.blade.php`

- Background: `bg-kids-yellow` 
- Animasi JS: `hero.js` (text split + stagger), `hero-3d.js` (particle canvas)
- CTA: "Lihat Program" (→ `#programs`) + "Tentang Kami" (→ `#about`)
- Dekoratif: Paper planes, balloons, book stacks, rainbow (SVG), cloud wave

---

### 6.2 — About Erlass
**File:** `welcome.blade.php` (section `id="about"`)

- Layout: Centered, single column
- Badge: "Erlass Mitra Pendidikan" (pink)
- Heading: "Bukan Sekadar Penyedia Program"
- Stats grid: 150+ Sekolah | 2.000+ Siswa | 140.000+ Guru | 70+ Instruktur
- CTA: "Lihat Program Kami" → `#programs`
- Dekoratif: Handprint SVGs di sisi kanan (hidden on mobile)

---

### 6.3 — Why Choose Us
**File:** `sections/why-choose-us.blade.php`

- Layout: 3 kolom kartu
- Kartu 1: "Modul Siap Pakai & PBL" (border biru)
- Kartu 2: "Mendukung Kurikulum P5" (border kuning)
- Kartu 3: "Support Promosi Sekolah" (border oranye)
- Hover: Naik 2px + shadow solid muncul (warna sesuai border)

---

### 6.4 — Programs (Katalog Program)
**File:** `welcome.blade.php` (section `id="programs"`)

- Layout: 3 kolom kartu program
- Kartu 1: "Koding Scratch & Python" 💻 → link ke `/programs/coding`
- Kartu 2: "Robotika & IoT" 🤖 → link ke `/programs/robotics`
- Kartu 3: "P5 & Pelatihan Guru" 🎓 (Coming Soon)
- Hover: Shadow solid + naik 2px (warna border masing-masing)

---

### 6.5 — Clients Marquee
**File:** `sections/clients.blade.php`

- 2 baris marquee scrolling (berlawanan arah)
- Baris 1: Logo klien 1–10 (animasi `marquee-left`)
- Baris 2: Logo partner 11–20 (animasi `marquee-right`)
- Gambar: Dari `public/img/cp/` (31 file logo sekolah mitra)
- Hover: Pause animasi, grayscale → full color

---

### 6.6 — Testimoni
**File:** `welcome.blade.php` (section `id="testimoni"`)

- Layout: 3 kolom kartu testimonial
- Badge: "Kisah Sukses" (pink)
- 3 testimonial: Wakasek SD, Orang Tua SMP, Guru TIK SMP
- Rating: ★★★★★ (gold stars)
- Avatar: Initial letter circle (warna biru/pink/mint)

---

### 6.7 — Contact / Lead Form
**File:** `welcome.blade.php` (section `id="contact"`)

- Background: `bg-kids-yellow`
- Form fields: Nama, Telepon, Email, Nama Sekolah, Program (dropdown), Pesan
- Submit: POST ke `/leads` (LeadController)
- Direct WhatsApp link: `wa.me/6282311341381` di bawah form

---

### 6.8 — Footer (Global)
**File:** `layouts/app.blade.php`

- Background gelap (`bg-card`)
- 3 kolom: ERLASS info + alamat, Programs list, Contact + Social Icons
- Social: Instagram, YouTube, TikTok, Facebook
- Copyright: PT Erlass Prokreatif Indonesia

---

## 7. JavaScript Modules

Semua module diinisialisasi di `app.js` secara **sequential** dengan **error boundary** terpisah per module. Jika satu module gagal, module lain tetap jalan.

### 7.1 — Lenis (Smooth Scroll)
**File:** `resources/js/lenis.js`

```javascript
const lenis = new Lenis({
    duration: 1.4,                    // Kecepatan scroll
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    smoothWheel: true,
});

// Bridge ke GSAP ScrollTrigger (WAJIB)
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => { lenis.raf(time * 1000); });
```

### 7.2 — Hero 3D (Three.js)
**File:** `resources/js/hero-3d.js`

- Target: `<canvas id="hero-canvas">`
- Menampilkan 700 partikel indigo floating
- Interaksi: Partikel mengikuti pergerakan mouse
- Fallback: Jika WebGL tidak tersedia, canvas disembunyikan

### 7.3 — Hero Animations (GSAP)
**File:** `resources/js/hero.js`

- Text splitting: Headline dipecah menjadi kata-kata individual
- Timeline GSAP: Badge → Words → Subheadline → CTA → Decorations
- Floating loop: Elemen dengan `data-speed` naik-turun terus-menerus

### 7.4 — Scroll Animations (GSAP ScrollTrigger)
**File:** `resources/js/scroll-animations.js`

| Target | Animasi | Trigger |
|--------|---------|---------|
| `.about-image` | Scale dari 0.8 + rotate | Section `#about` masuk 70% viewport |
| `.about-content > *` | Slide dari kanan | Section `#about` masuk 60% viewport |
| `.book-card` | Slide dari bawah + stagger | Section `#products` masuk 75% viewport |
| `.blog-card` | Slide + scale dari 0.95 | Section `#blogs` masuk 75% viewport |
| `.section-reveal` | Fade-up dari opacity 0 | Setiap section masuk 85% viewport |

### 7.5 — Custom Cursor
**File:** `resources/js/cursor.js` + `resources/css/cursor.css`

- Hanya aktif di perangkat dengan mouse (`pointer: fine`)
- Membuat 2 elemen: titik kecil (dot) + lingkaran besar (circle)
- Kursor native baru disembunyikan SETELAH custom cursor berhasil dibuat (class `custom-cursor-active`)
- States: `explore`, `play`, `drag`, `default`, base

### 7.6 — Magnetic Button
**File:** `resources/js/magnetic.js`

- Target: Elemen dengan class `.x-magnetic-btn`
- Blade component: `<x-magnetic-btn href="#" class="...">Teks</x-magnetic-btn>`
- Efek: Tombol "ditarik" mengikuti posisi mouse dalam radius 80px

### 7.7 — Card Hover (3D Tilt)
**File:** `resources/js/card-hover.js`

- Target: `.product-card`
- Efek: Kartu miring mengikuti posisi mouse (max 8 derajat)
- Mouse gradient: Radial gradient mengikuti posisi mouse (`--mouse-x`, `--mouse-y`)

---

## 8. CSS Architecture

### File Utama: `resources/css/app.css`

```
app.css
├── @import Google Fonts (Source Sans 3, Playfair Display)
├── @import tailwindcss
├── @import tw-animate-css
├── @import shadcn/tailwind.css
├── @import cursor.css
├── @theme { ... }          ← Font tokens, color tokens
├── @theme inline { ... }   ← Shadcn/UI design tokens
├── :root { ... }           ← CSS variables (oklch colors)
├── .dark { ... }           ← Dark mode variables
├── @font-face { ... }      ← Scribble Show, Quicktext, Super Popstar
├── .glass-pro              ← Glassmorphism navbar
├── .glow-btn               ← Gradient CTA button
└── .product-card::before   ← Mouse-tracking gradient overlay
```

### File Cursor: `resources/css/cursor.css`

```
cursor.css
├── body.custom-cursor-active { cursor: none }   ← Hanya aktif jika JS sukses
├── .custom-cursor-dot        ← Titik kecil (8px, #222)
├── .custom-cursor-circle     ← Lingkaran besar (40px, border #222)
└── .custom-cursor-text       ← Teks di dalam lingkaran
```

---

## 9. Internasionalisasi (i18n)

Website mendukung 2 bahasa:

| Kode | Bahasa | File |
|------|--------|------|
| `id` | Indonesia | `resources/lang/id/content.php` |
| `en` | English | `resources/lang/en/content.php` |

**Cara kerja:**
1. User klik switcher ID/EN di navbar
2. Route `/lang/{locale}` menyimpan bahasa ke session
3. Middleware `SetLocale` membaca session dan set `app()->setLocale()`
4. Di Blade, teks ditampilkan dengan `{{ __('content.nav.home') }}`

---

## 10. Cara Menjalankan Lokal

### Prasyarat
- PHP 8.4+
- Composer
- Node.js 20+
- Laragon (atau XAMPP/Herd)

### Langkah

```bash
# 1. Install PHP dependencies
composer install

# 2. Install JS dependencies
npm install

# 3. Copy environment file (jika belum ada)
cp .env.example .env
php artisan key:generate

# 4. Untuk development (auto-reload):
npm run dev

# 5. Untuk production build:
npm run build

# 6. Jalankan server Laravel:
php artisan serve
# Atau gunakan Laragon → otomatis di http://galeribelajar.test
```

### URL Lokal
| Metode | URL |
|--------|-----|
| Laragon Virtual Host | `http://galeribelajar.test` |
| PHP Artisan Serve | `http://localhost:8000` |

---

## 11. Troubleshooting

### ❌ "Kursor hilang"
**Penyebab:** CSS `cursor: none` dijalankan sebelum JS custom cursor berhasil dibuat.  
**Solusi:** Sudah diperbaiki — cursor native hanya disembunyikan setelah class `custom-cursor-active` ditambahkan oleh JS.

### ❌ "Halaman tidak bisa di-scroll"
**Penyebab:** `lenis.start()` berada di `try-catch` yang sama dengan module lain. Jika module lain error, Lenis tidak pernah dimulai.  
**Solusi:** Sudah diperbaiki — setiap module punya `try-catch` terpisah. Lenis diprioritaskan pertama.

### ❌ "GSAP: Reduced motion detected. Animations disabled."
**Penyebab:** Windows mengaktifkan "Reduce Motion" → scroll animations diblokir total → section dengan `opacity:0` tidak pernah muncul.  
**Solusi:** Sudah diperbaiki — pengecekan reduced motion dihapus karena animasi hanya fade/slide sederhana.

### ❌ "TypeError: can't access property 'two' of null"
**Penyebab:** Three.js gagal membuat WebGL renderer (browser/driver tidak mendukung).  
**Solusi:** Sudah diperbaiki — WebGL renderer dibungkus `try-catch`, jika gagal maka canvas disembunyikan.

### ⚠️ "Unchecked runtime.lastError: Could not establish connection"
**Penyebab:** Error dari ekstensi browser Chrome (ad blocker, password manager, dll).  
**Solusi:** **Bukan error kita.** Aman diabaikan.

### ⚠️ Font warnings saat build
```
/fonts/Scribble Show.otf didn't resolve at build time
```
**Penyebab:** Font kustom di-load dari `/public/fonts/` secara runtime, bukan via Vite.  
**Solusi:** Normal dan tidak berpengaruh. Font tetap ter-load saat website dibuka.
