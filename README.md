# 🏫 Erlass — Solusi Teknologi & Pendidikan B2B (erlass.co.id)

> **Website Resmi & Katalog Digital PT Erlass Prokreatif Indonesia**
> *Mempersiapkan Generasi Masa Depan Melalui Teknologi dan Inovasi.*
> **Domain Resmi:** [https://erlass.co.id](https://erlass.co.id) | **Staging:** [https://newgaleri.erlass.institute](https://newgaleri.erlass.institute)

---

## 📌 Ringkasan Proyek

Repositori ini berisi website korporat, katalog produk, dan portal informasi **PT Erlass Prokreatif Indonesia**. Website dipakai untuk:

- menampilkan **katalog produk** (modul, learning kit, program ekskul, produk LMS) lengkap dengan tautan **Shopee** dan **LMS Erlass Academy**;
- menerbitkan **artikel, berita, dan dokumentasi kegiatan**;
- menangkap **prospek kerja sama** (form konsultasi, newsletter, komentar) untuk tim pemasaran;
- dikelola sepenuhnya lewat **panel admin** dengan pembagian role.

Data master kategori, produk, dan sekolah mitra disinkronkan dari basis data operasional **Erlass CRM**.

📖 Dokumentasi lengkap ada di folder [`docs/`](docs/README.md). Riwayat perubahan: [`CHANGELOG.md`](CHANGELOG.md).

---

## ✨ Fitur Utama

| Area | Fitur |
|---|---|
| **Beranda** | Hero & slider foto, Produk Digital LMS (kolom dari admin), Katalog Unggulan (carousel), Why Erlass dengan tab video, artikel terbaru, form konsultasi. Semua judul & bagian bisa diatur dari admin |
| **Katalog** (`/katalog`) | Filter kategori/jenjang/jenis/Shopee/LMS, urutan populer/terbaru/paling dilihat, sampul otomatis per produk, FAQ katalog & FAQ tiap produk, jumlah dilihat |
| **Artikel** (`/artikel`) | Kategori (dikelola admin), hashtag, pencarian, 10 per halaman, artikel disematkan (pin), komentar berbalas dengan moderasi otomatis |
| **Galeri** (`/gallery`) | Pemutar video YouTube + rekomendasi video, arsip foto berkategori (Guru, Umum, Siswa, Anak, Erlass Festival) dan sub-kategori |
| **Panel Admin** (`/admin`) | CRUD semua fitur, 3 role (Super Admin, Admin, Content Writer), alur persetujuan artikel, moderasi komentar, Kontak Promosi + ekspor CSV, Pengaturan Situs & Beranda, Riwayat Perubahan |
| **SEO & GEO** | Meta tag & Open Graph, JSON-LD (Product, Article, FAQPage, Breadcrumb), sitemap dinamis, `/llms.txt` untuk mesin pencari AI |
| **Keamanan & Performa** | Header keamanan (CSP, HSTS, dll.), pembatasan spam, gambar WebP, cache halaman otomatis, kompresi & cache browser |

---

## 🗺️ Rute Halaman

| Rute | Keterangan |
|---|---|
| `/` | Beranda |
| `/katalog` | Katalog produk (filter: `?kategori=`, `?jenjang=`, `?jenis=`, `?tersedia=shopee\|lms`, `?urut=`, `?q=`) |
| `/katalog/{slug}` | Detail produk |
| `/katalog/cover/{sku}.svg` | Sampul produk otomatis |
| `/artikel` | Daftar artikel (`?kategori=`, `?tag=`, `?q=`) |
| `/artikel/{slug}` | Detail artikel + komentar |
| `/gallery` | Galeri video & foto (`?kategori=`, `?sub=`) |
| `/programs/{slug}` | Detail program |
| `/kebijakan-privasi`, `/syarat-ketentuan` | Halaman legal |
| `/sitemap.xml`, `/llms.txt`, `/robots.txt` | SEO & GEO |
| `POST /leads`, `POST /berlangganan`, `POST /artikel/{slug}/komentar` | Form konsultasi, newsletter, komentar (dibatasi anti-spam) |
| `/admin` | Panel admin Filament |

---

## 👥 Role Panel Admin

| Kemampuan | Super Admin | Admin | Content Writer |
|---|:-:|:-:|:-:|
| Menulis artikel & mengedit draf sendiri | ✓ | ✓ | ✓ |
| Menyetujui, menerbitkan, menyematkan artikel | ✓ | ✓ | – |
| Produk, kategori, kolom LMS, FAQ, galeri, mitra, program, pengumuman | ✓ | ✓ | – |
| Moderasi komentar, lead, Kontak Promosi, subscriber | ✓ | ✓ | – |
| Pengaturan Situs & Pengaturan Beranda | ✓ | ✓ | – |
| Pengguna & role, Riwayat Perubahan | ✓ | – | – |

Panduan pemakaian per menu: [`docs/PANDUAN_ADMIN.md`](docs/PANDUAN_ADMIN.md).

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+, MySQL
- **Admin Panel:** Filament v5 (Livewire)
- **Frontend:** Blade, Tailwind CSS v4, Vite 7
- **Animasi:** GSAP (ScrollTrigger), Lenis, Three.js
- **Pengujian:** PHPUnit + Livewire testing (SQLite in-memory)

---

## 💻 Menjalankan di Lokal

```bash
git clone https://github.com/ErlassErlass/newgaleribelajar.git
cd newgaleribelajar
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Atur koneksi MySQL di `.env` (`DB_DATABASE=newgaleribelajar_db`, dst.), lalu:

```bash
php artisan migrate --seed   # tabel + data CRM offline (7 kategori, ±140 produk, 407 sekolah) + data awal
npm run build                # atau: npm run dev (hot reload)
php artisan serve
```

- Website: **http://127.0.0.1:8000**
- Admin: **http://127.0.0.1:8000/admin** — akun Super Admin dibuat oleh `DatabaseSeeder` (`admin@erlass.co.id`, password `Erlass101`).

> [!WARNING]
> Ganti password akun admin setelah login pertama. `DatabaseSeeder` memakai `updateOrCreate`, sehingga **menjalankan seeder lagi akan mereset password akun ini**. Jangan jalankan `php artisan migrate:fresh` di server produksi karena menghapus seluruh isi database.

Sinkronisasi live dari server CRM (bila tersambung): `php artisan app:sync-crm-data`.

Panduan detail: [`docs/PANDUAN_INSTALASI.md`](docs/PANDUAN_INSTALASI.md) · Deploy ke server: [`docs/DEPLOYMENT.md`](docs/DEPLOYMENT.md).

---

## 🧪 Pengujian Otomatis

```bash
php artisan test
```

23 uji (267 pengecekan) memeriksa semua halaman publik, semua halaman admin, hak akses tiap role, penyimpanan form, dan tombol aksi. Uji berjalan di database SQLite memori sehingga **tidak menyentuh database MySQL**. Detail: [`docs/PANDUAN_TESTING.md`](docs/PANDUAN_TESTING.md).

---

## 🎨 Palet Warna Resmi

| Warna | Hex | Peran |
|---|---|---|
| Prussian Navy | `#023047` | Hero, footer, heading |
| Blue-Green | `#219ebc` | Aksen utama, tautan, fokus |
| Light Sky Blue | `#8ecae6` | Border halus, badge |
| Selective Yellow | `#ffb703` | Highlight angka & badge |
| UT Orange | `#fb8500` | Tombol aksi utama |

---

## 🛡️ Kepatuhan & Privasi

- Form konsultasi dan komentar dilengkapi persetujuan sesuai **UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)**. Ekspor Kontak Promosi hanya mengambil kontak yang memberi izin, dan setiap ekspor tercatat di Riwayat Perubahan.
- Email pemberi komentar tidak pernah ditampilkan di situs.

---

## 📄 Lisensi & Hak Cipta

Hak Cipta © 2026 **PT Erlass Prokreatif Indonesia**. Seluruh hak dilindungi undang-undang.
