# 🏫 Erlass — Solusi Teknologi & Pendidikan B2B (erlass.co.id)

> **Website Resmi PT Erlass Prokreatif Indonesia**  
> *Mempersiapkan Generasi Masa Depan Melalui Teknologi dan Inovasi.*  
> **Domain Resmi:** `https://erlass.co.id` | **Staging Environment:** `https://newgaleri.erlass.institute`

---

## 📌 Ringkasan Proyek

Repositori ini adalah basis kode untuk website korporat dan landing page B2B **PT Erlass Prokreatif Indonesia**. Website ini dirancang khusus untuk membangun kredibilitas korporat, menyajikan portofolio kurikulum teknologi, serta menangkap prospek (*lead generation*) dari kepala sekolah, ketua yayasan pendidikan, dinas pendidikan, dan mitra bisnis.

Data produk, kategori, dan sekolah mitra disinkronkan secara langsung dari basis data operasional **Erlass CRM** (`erlass_data`).

---

## 🎨 Identitas Visual & Palet Warna Resmi

Menggunakan standar palet resmi dari [Coolors (erlass-palette)](https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500):

| Warna | Hex | Peran Desain |
|---|---|---|
| **Prussian Navy** | `#023047` | Latar belakang hero banner, navbar announcement, footer, heading teks utama kontras tinggi |
| **Blue-Green / Cyan** | `#219ebc` | Aksen brand utama, ikon fitur, tautan hover, status aktif, border fokus |
| **Light Sky Blue** | `#8ecae6` | Border halus, grid dekoratif latar belakang, pill badges, subtle hover glow |
| **Selective Yellow** | `#ffb703` | Highlight metrik kuantitatif (400+ sekolah mitra, 1.100+ SP deals), badge kategori |
| **UT Orange** | `#fb8500` | Tombol aksi konversi tinggi (*Primary CTA*: *Konsultasi Sekolah*, *Ajukan Penawaran*) |

---

## 🚀 4 Solusi Pendidikan Utama (Core Solutions)

1. **Coding & Informatika:** Kurikulum koding visual Scratch, Python tingkat lanjut, buku modul LKPD berjenjang kelas 1–6 SD hingga SMA.
2. **Robotic & Micro:bit:** Eksplorasi robotika terpadu dengan Micro:bit v2, sensor IoT, Erboblox, dan autonomous smart car.
3. **Erlass Academy LMS:** Platform pembelajaran terintegrasi (manajemen kelas, bank soal CBT, rapor berkala, dashboard analitik).
4. **Student Assessment:** Asesmen Potensi, Minat, dan Bakat (PMB) siswa kelas 1–12 untuk panduan penjurusan akademik dan karier.

---

## 📊 Data Faktual Riil Erlass CRM

- **Sekolah Mitra Terverifikasi:** **407 sekolah** di seluruh Indonesia dengan status kontrak `Deal` pada jenjang TK/SD/SMP/SMA/SMK.
- **Total Kontrak SP:** **1.162+ transaksi kontrak program** terlaksana.
- **Katalog Produk:** **130 produk** terdaftar dengan SKU resmi dan kategori yang disinkronkan dari CRM.

---

## 🛠️ Tech Stack

- **Backend Framework:** Laravel 12 (PHP 8.3 / 8.4)
- **Admin Panel:** Filament PHP v4
- **Styling:** Tailwind CSS v4 (`@tailwindcss/vite`)
- **Frontend Bundler:** Vite 7
- **Animasi & Interaktivitas:** GSAP (ScrollTrigger), Lenis Smooth Scroll, Three.js 3D Particles
- **Database:** MySQL (Database utama `newgaleribelajar_db`, integrasi CRM `erlass_data`)

---

## 💻 Panduan Instalasi Lokal

### 1. Clone Repositori
```bash
git clone git@github.com:ErlassErlass/newgaleribelajar.git
cd newgaleribelajar
```

### 2. Install Dependensi PHP & Node.js
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (.env)
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi database MySQL di `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newgaleribelajar_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrasi & Database Seeder (Data CRM Otomatis)
```bash
php artisan migrate --seed
```
*Seeder `CrmDataSeeder` akan otomatis mengisi 7 kategori, 130 produk, dan 407 sekolah mitra secara offline tanpa memerlukan koneksi langsung ke server CRM.*

### 5. Kompilasi Aset Frontend
```bash
# Untuk pengembangan lokal:
npm run dev

# Untuk build produksi:
npm run build
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Akses website melalui peramban di `http://127.0.0.1:8000`.

---

## 🛡️ Standar Kualitas & Kepatuhan
- **Anti-AI Slop:** Seluruh narasi menggunakan fakta korporat nyata, menghilangkan kata klise hiperbolis, dan menggunakan ikon vektor inline SVG.
- **Kepatuhan Regulasi:** Formulir penawaran dilengkapi persetujuan eksplisit kepatuhan **UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)**.
