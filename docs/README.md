# Dokumentasi Erlass — Solusi Teknologi & Pendidikan B2B

Selamat datang di dokumentasi teknis website **Erlass** (`erlass.co.id`). Website ini adalah website corporate dan landing page B2B resmi untuk **PT Erlass Prokreatif Indonesia** yang menyediakan program Coding, Robotika, Micro:bit, LMS Kaizen, dan Asesmen Potensi Siswa untuk sekolah di Indonesia.

## 📚 Tautan Cepat Dokumentasi

- [Instalasi & Setup](PANDUAN_INSTALASI.md) — Cara menjalankan project ini di lingkungan lokal.
- [Arsitektur & Tech Stack](ARSITEKTUR.md) — Penjelasan arsitektur Laravel 12, Vite 7, Three.js, GSAP, dan Lenis.
- [Panduan Kustomisasi](PANDUAN_KUSTOMISASI.md) — Cara mengganti warna, konten, dan konfigurasi.
- [Panduan Pengujian](PANDUAN_TESTING.md) — Skenario pengujian fungsional dan form lead.
- [Dokumentasi Lengkap Proyek](../DOCUMENTATION.md) — Dokumentasi teknis mendalam (arsitektur CSS, integrasi CRM, Filament admin).

## 🚀 Fitur Utama Website

- **Palet Warna Resmi Coolors:** Menggunakan palet `#8ecae6`, `#219ebc`, `#023047`, `#ffb703`, `#fb8500`.
- **Integrasi Data Erlass CRM:** 407 sekolah mitra SP Deal dan 130 produk terhubung langsung ke basis data operasional.
- **Modern B2B Styling:** Standar antarmuka profesional tanpa ornamen kekanak-kanakan (anti-AI slop).
- **Interactive 3D Hero:** Background jaringan partikel interaktif menggunakan Three.js.
- **Smooth Scroll & Micro-Interactions:** Lenis smooth scroll dan GSAP ScrollTrigger.
- **Filament v4 Admin Panel:** Manajemen konten kategori, produk, sekolah mitra, dan pelacakan lead masuk.
- **UU PDP Compliance:** Formulir penawaran dilengkapi persetujuan eksplisit kepatuhan UU No. 27 Tahun 2022.
- **Integrasi WhatsApp Resmi:** Tombol mengambang (*floating button*) langsung menuju customer service resmi Erlass.

## 🗺️ Rute Halaman

| Route | Halaman |
|---|---|
| `/` | Landing page utama (Hero → Solusi → 5 Pilar Nilai → Produk CRM → Sekolah Mitra → Form Lead) |
| `/programs/coding` | Detail kurikulum Coding & Informatika (Scratch & Python) |
| `/programs/robotics` | Detail kurikulum Robotika & Micro:bit Learning Kit |
| `/gallery` | Dokumentasi foto & video kegiatan pelatihan sekolah |
| `/admin` | Panel admin Filament untuk manajemen data |
