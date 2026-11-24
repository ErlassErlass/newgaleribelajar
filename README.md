# 🏫 Erlass — Solusi Teknologi & Pendidikan B2B (erlass.co.id)

> **Website Resmi & Katalog Digital PT Erlass Prokreatif Indonesia**  
> *Mempersiapkan Generasi Masa Depan Melalui Teknologi dan Inovasi.*  
> **Domain Resmi:** [https://erlass.co.id](https://erlass.co.id) | **Staging Environment:** [https://newgaleri.erlass.institute](https://newgaleri.erlass.institute)

---

## 📌 Ringkasan Proyek

Repositori ini berisi basis kode lengkap untuk website korporat dan landing page B2B **PT Erlass Prokreatif Indonesia**. Website ini dirancang khusus untuk membangun kredibilitas korporat, menyajikan solusi kurikulum teknologi terintegrasi, serta memfasilitasi penangkapan prospek kerja sama (*lead generation*) dari kepala sekolah, ketua yayasan pendidikan, dinas pendidikan, dan mitra industri.

Seluruh data master kategori, produk, dan sekolah mitra disinkronkan secara langsung dari basis data operasional **Erlass CRM** (`erlass_data`).

---

## 🎨 Identitas Visual & Palet Warna Resmi

Website mengadopsi standar palet resmi dari [Coolors (erlass-palette)](https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500) yang berkesan modern, elegan, dan profesional (B2B EdTech):

| Warna | Hex | Karakter / Peran Semantik Desain |
|---|---|---|
| **Prussian Navy** | `#023047` | Latar belakang hero banner, navbar announcement, footer, heading teks utama kontras tinggi |
| **Blue-Green / Cyan** | `#219ebc` | Aksen brand utama, ikon fitur, tautan hover, status aktif, border fokus |
| **Light Sky Blue** | `#8ecae6` | Border halus, grid dekoratif latar belakang, pill badges, subtle hover glow |
| **Selective Yellow** | `#ffb703` | Highlight metrik kuantitatif (*400+ sekolah mitra*, *1.100+ SP deals*), badge kategori |
| **UT Orange** | `#fb8500` | Tombol aksi konversi tinggi (*Primary CTA*: *Konsultasi Sekolah*, *Ajukan Penawaran*) |

---

## 🚀 4 Solusi Pendidikan Utama (Core Solutions)

1. **Coding & Informatika:** Kurikulum koding visual Scratch, pemrograman teks Python berjenjang, serta buku modul LKPD berstandar Kurikulum Merdeka dari jenjang SD hingga SMA.
2. **Robotic & Micro:bit:** Eksplorasi rekayasa robotika praktis dengan board BBC micro:bit v2, sensor IoT, kit Erboblox, dan mobil pintar otonom (*smart car*).
3. **Erlass Academy LMS:** Platform digital manajemen pembelajaran sekolah modern (monitoring kelas, bank soal CBT, rapor digital, dashboard analitik).
4. **Student Assessment:** Asesmen Potensi, Minat, dan Bakat (PMB) siswa kelas 1–12 untuk panduan penjurusan akademik dan perencanaan karier masa depan.

---

## 📊 Integrasi Data Riil Erlass CRM

- **Sekolah Mitra Terverifikasi:** **407 sekolah** di seluruh Indonesia dengan status kontrak `Deal` pada jenjang TK/SD/SMP/SMA/SMK (contoh: *SDS Al-Azhar 4, SDI Teladan Suci, SD Bangun Mandiri, SDIT Cordova, SMPK Ignatius Slamet Riyadi*).
- **Total Kontrak SP:** **1.162+ transaksi kontrak program** terlaksana.
- **Katalog Produk:** **130 produk** terdaftar dengan SKU resmi (`ECR01`, `MLK01`, `RE01`, `LMS-PMB01`, `MSJ01`–`MSJ06`) dan metrik deal yang disinkronkan langsung dari CRM.
- **Kategori Produk:** 7 kategori resmi (Coding & Informatika, Micro:bit & IoT, Robotika Edukasi, Asesmen Bakat, LMS Erlass Academy, Modul Cetak & LKPD, Modul Digital PDF).

---

## 🗺️ Peta Navigasi & Rute Halaman

| Rute URL | Metode | Deskripsi Halaman |
|---|---|---|
| `/` | `GET` | **Landing Page Utama:** Hero, Social Proof Marquee (407 Sekolah), 4 Solusi, 5 Pilar Why Erlass, Katalog CRM, Kemitraan & Formulir Lead B2B |
| `/gallery` | `GET` | **Dokumentasi & Galeri Implementasi:** Rekam jejak foto workshop guru (ToT), laboratorium komputer, dan praktikum robotik siswa |
| `/programs/coding` | `GET` | **Solusi Kurikulum Koding:** Silabus berjenjang Scratch & Python |
| `/programs/robotics` | `GET` | **Solusi Lab Robotika:** Spesifikasi hardware kit Micro:bit starter & smart car |
| `/programs/{slug}` | `GET` | **Detail Program Dinamis:** Tampilan detail kurikulum program tertentu |
| `/admin` | `GET` | **Filament Admin Panel:** Manajemen kategori, produk, sekolah mitra, dan daftar lead |

---

## 🛠️ Tech Stack & Dependencies

- **Backend:** Laravel 12 (PHP 8.3 / 8.4), Eloquent ORM, MySQL
- **Admin Panel:** Filament PHP v4 (Resources: `Categories`, `Products`, `Partners`)
- **Styling:** Tailwind CSS v4 (`@tailwindcss/vite`)
- **Frontend Bundler:** Vite 7
- **Animasi & Interaktivitas:** GSAP (ScrollTrigger), Lenis Smooth Scroll, Three.js 3D Particles
- **Database:** MySQL (`newgaleribelajar_db` untuk website, `erlass_data` untuk source CRM)

---

## 💻 Panduan Instalasi & Menjalankan Lokal

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

### 3. Konfigurasi Environment (`.env`)
Salin berkas contoh environment dan generate application key:
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi database MySQL di `.env`:
```ini
APP_NAME=Erlass
APP_ENV=local
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newgaleribelajar_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seeder Data CRM (Offline Ready)
Jalankan migrasi database beserta seeder otomatis:
```bash
php artisan migrate --seed
```
> [!TIP]
> Perintah di atas menjalankan `CrmDataSeeder` yang otomatis mengimpor **7 kategori**, **130 produk**, dan **407 sekolah mitra** dari berkas JSON offline (`database/seeders/data/`), sehingga Anda tidak memerlukan koneksi langsung ke server CRM saat mengembangkan di lokal.
>
> Jika tersambung ke jaringan server internal, Anda dapat melakukan sinkronisasi live kapan saja dengan:
> ```bash
> php artisan app:sync-crm-data
> ```

### 5. Kompilasi Aset Frontend
```bash
# Mode pengembangan aktif (hot reload):
npm run dev

# Kompilasi produksi (CSS & JS):
npm run build
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Akses website melalui peramban di: **`http://127.0.0.1:8000`**  
Panel Admin Filament: **`http://127.0.0.1:8000/admin`**  
- **Email:** `admin@erlass.co.id`
- **Password:** `password`

---

## 🧪 Menjalankan Pengujian Otomatis

```bash
php artisan test
```
Seluruh unit test dan feature test (termasuk validasi form penawaran lead dan kepatuhan consent UU PDP) sudah teruji dan lulus 100%.

---

## 🛡️ Standar Kualitas & Kepatuhan Regulasi

- **Standar Anti-AI Slop:** Seluruh copywriting disusun berdasarkan data korporat faktual tanpa kata-kata klise hiperbolis, tanpa ornamen kekanak-kanakan, dan menggunakan ikon vektor inline SVG profesional.
- **Kepatuhan Privasi Data:** Formulir konsultasi dan penawaran program dilengkapi klausul persetujuan eksplisit kepatuhan **UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)**.

---

## 📄 Lisensi & Hak Cipta
Hak Cipta © 2026 **PT Erlass Prokreatif Indonesia**. Seluruh hak dilindungi undang-undang.
