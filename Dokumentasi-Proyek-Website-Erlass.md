# Dokumentasi Proyek Website Erlass

Paket dokumentasi untuk website corporate dan katalog produk digital Erlass: PRD, TRD, AFD, DBD, BSD, dan IPD. Seluruh dokumen disusun dari brief homepage dan struktur Corporate Profile yang diberikan.

## 0. Ringkasan Konsep Homepage

**Navigasi:** Logo Erlass | Solutions · Program · Partner · About

**Hero**
- Headline: *Mempersiapkan Generasi Masa Depan Melalui Teknologi dan Inovasi.*
- Tagline: Solusi pembelajaran Coding, Robotik, Informatika, Kecerdasan Artifisial, Asesmen, dan LMS untuk sekolah Indonesia.
- CTA utama: **Jelajahi Solusi** (scroll/menuju katalog). CTA sekunder: **Konsultasi Sekolah** (form konsultasi).

**Our Education Solutions** (4 kartu)
1. Coding & Informatika
2. Robotic & Micro:bit
3. Erlass Academy LMS
4. Student Assessment

**Why Erlass?** Bukan Sekadar Produk, Tetapi Solusi Pendidikan. Lima pilar: kurikulum, platform digital, perangkat pembelajaran, pendampingan guru, ekosistem belajar terintegrasi.

**Let's Collaborate** Mari Wujudkan Transformasi Pendidikan Bersama Erlass. Untuk sekolah, dinas pendidikan, lembaga pendidikan, dan mitra bisnis. CTA: **Hubungi Tim Erlass**.

**Saran tambahan yang disarankan (opsional):** bar logo sekolah/mitra (social proof), angka dampak (jumlah sekolah, guru terlatih, siswa), 2 sampai 3 testimoni, dan tombol WhatsApp melayang, karena sekolah di Indonesia umumnya berkonsultasi lewat WhatsApp.

**Sitemap**
- Home
- Tentang Erlass: Visi dan Misi, Sejarah, Tim dan Manajemen, Legalitas dan Sertifikasi, Partner dan Mitra Strategis, Kontak dan Lokasi
- Katalog Produk Digital: Coding, Robotik, LMS Erlass Academy, Tes Minat Bakat dan Potensi Siswa, Pelatihan Guru, Ekstrakurikuler
- Video Demo Produk
- Download Brosur dan Katalog PDF
- Form Permintaan Penawaran

---

## 1. PRD: Product Requirement Documentation

### 1.1 Latar Belakang dan Tujuan
Erlass menyediakan solusi pembelajaran teknologi untuk sekolah. Website saat ini perlu menjadi etalase korporat sekaligus alat generasi prospek (lead). Tujuan bisnis:
1. Membangun kredibilitas Erlass sebagai penyedia solusi pendidikan terintegrasi.
2. Memudahkan sekolah, dinas, dan mitra menemukan produk dan meminta penawaran.
3. Mengumpulkan lead berkualitas melalui form konsultasi dan penawaran.

### 1.2 Target Pengguna (Persona)
| Persona | Kebutuhan | Aksi utama |
|---|---|---|
| Kepala sekolah / yayasan | Menilai kredibilitas, harga, dampak | Konsultasi, minta penawaran |
| Guru / koordinator TIK | Detail kurikulum, perangkat, pelatihan | Unduh katalog, lihat demo |
| Dinas pendidikan | Legalitas, skala program, kemitraan | Hubungi tim, unduh profil |
| Mitra bisnis / reseller | Peluang kolaborasi | Form kemitraan |
| Orang tua (sekunder) | Memahami program ekstrakurikuler | Lihat katalog ekskul |

### 1.3 Metrik Keberhasilan (KPI)
- Jumlah pengajuan form konsultasi dan penawaran per bulan.
- Conversion rate pengunjung ke lead (target awal 2 sampai 3 persen).
- Jumlah unduhan brosur/katalog.
- Rata-rata waktu di halaman dan view video demo.
- Skor Core Web Vitals "Good" di perangkat seluler.

### 1.4 Ruang Lingkup
**Masuk (in scope):** semua halaman di sitemap, CMS untuk konten, form lead dengan notifikasi email/WhatsApp, katalog produk, pustaka video demo, unduhan PDF, SEO dasar, analitik, dwibahasa (ID default, EN opsional fase 2).

**Di luar lingkup (fase ini):** e-commerce dan pembayaran online, portal login LMS (LMS tetap aplikasi terpisah, website hanya tautan masuk), aplikasi mobile.

### 1.5 Kebutuhan Fungsional
| ID | Kebutuhan | Prioritas |
|---|---|---|
| FR-01 | Homepage dengan hero, 4 kartu solusi, Why Erlass, Let's Collaborate | Must |
| FR-02 | Halaman Tentang Erlass dengan 6 subhalaman | Must |
| FR-03 | Katalog produk dengan 6 kategori, daftar dan detail produk | Must |
| FR-04 | Form Konsultasi Sekolah (CTA hero) | Must |
| FR-05 | Form Permintaan Penawaran (pilih produk, jumlah siswa, kebutuhan) | Must |
| FR-06 | Halaman Video Demo Produk (embed YouTube) | Should |
| FR-07 | Unduh Brosur dan Katalog PDF, opsional gerbang lead (isi nama dan email) | Should |
| FR-08 | Halaman Partner dan Mitra Strategis dengan logo | Should |
| FR-09 | Pencarian dan filter katalog (jenjang, kategori) | Could |
| FR-10 | Panel admin: kelola produk, artikel, video, dokumen, lead | Must |
| FR-11 | Notifikasi lead ke email tim sales dan tombol WhatsApp | Must |
| FR-12 | Peta dan informasi kontak kantor | Must |
| FR-13 | Versi bahasa Inggris | Could |

### 1.6 Kebutuhan Non-Fungsional
- Responsif, mobile-first (mayoritas pengguna Indonesia di seluler).
- Performa: LCP kurang dari 2,5 detik pada jaringan 4G.
- Aksesibilitas mengacu WCAG 2.1 AA.
- Keamanan: HTTPS, proteksi spam form, validasi input.
- Kepatuhan UU Pelindungan Data Pribadi (UU PDP): persetujuan eksplisit dan kebijakan privasi pada setiap form.
- SEO: metadata, sitemap.xml, schema.org Organization.

### 1.7 Asumsi dan Risiko
- Konten (teks, foto, brosur, legalitas) disediakan Erlass sebelum fase konten. Risiko: keterlambatan konten adalah penyebab utama molornya jadwal.
- Detail harga tidak dipublikasikan, penawaran dilakukan lewat form.
- Dokumen legalitas yang ditampilkan perlu persetujuan internal.

---

## 2. TRD: Technical Requirement Documentation

### 2.1 Arsitektur yang Direkomendasikan
Pendekatan: **website dengan headless CMS**, agar tim non-teknis dapat mengelola konten sementara performa tetap tinggi.

| Lapisan | Rekomendasi | Alternatif |
|---|---|---|
| Frontend | Next.js (React) dengan SSG/ISR, Tailwind CSS | Astro, Nuxt |
| CMS | Strapi (self-host) atau Directus | WordPress headless, Sanity |
| Basis data | PostgreSQL | MySQL |
| Penyimpanan file | Object storage S3-compatible (brosur PDF, gambar) | Disk server + CDN |
| Hosting | VPS di Indonesia atau Singapura (frontend dapat di Vercel) | Cloud lain |
| CDN dan DNS | Cloudflare | - |
| Email transaksional | SMTP / layanan email (Resend, SES) | - |
| Analitik | Google Analytics 4 + Search Console | Plausible |

Catatan: jika tim Erlass lebih nyaman dengan ekosistem WordPress dan anggaran terbatas, WordPress dengan tema kustom dapat memenuhi seluruh kebutuhan PRD dengan biaya lebih rendah. Pilihan ini perlu diputuskan di awal.

### 2.2 Komponen Sistem
1. **Situs publik:** halaman dirender statis, katalog diambil dari CMS lewat API, revalidasi saat konten berubah.
2. **CMS / panel admin:** kelola produk, kategori, artikel, video, dokumen, mitra, tim.
3. **Layanan lead:** endpoint API untuk form, simpan ke database, kirim notifikasi email dan webhook WhatsApp.
4. **Penyimpanan media:** gambar dioptimasi otomatis (WebP/AVIF), PDF melalui URL bertanda tangan bila memakai gerbang lead.

### 2.3 Antarmuka API (ringkas)
| Metode | Endpoint | Fungsi |
|---|---|---|
| GET | /api/products | Daftar produk (filter kategori, jenjang) |
| GET | /api/products/{slug} | Detail produk |
| GET | /api/categories | Daftar kategori |
| GET | /api/videos | Daftar video demo |
| GET | /api/downloads | Daftar dokumen unduhan |
| POST | /api/leads/consultation | Kirim form konsultasi |
| POST | /api/leads/quotation | Kirim form permintaan penawaran |
| POST | /api/downloads/{id}/request | Minta tautan unduhan (gerbang lead) |

### 2.4 Keamanan
- HTTPS wajib (TLS via Cloudflare), HSTS.
- CAPTCHA tak terlihat (Cloudflare Turnstile) dan rate limiting pada endpoint form.
- Sanitasi dan validasi input sisi server, parameterized query.
- Peran admin berbasis akses (admin, editor, sales) dengan autentikasi kuat.
- Pencadangan database harian, retensi 14 hari minimal.
- Penyimpanan data pribadi minimum dan kebijakan retensi sesuai UU PDP.

### 2.5 Performa dan SEO
- Gambar responsif dan lazy loading, font dengan subset, JS seminimal mungkin.
- Cache CDN untuk aset statis.
- URL bersih berbahasa Indonesia, canonical, Open Graph, sitemap.xml, robots.txt.

### 2.6 Lingkungan dan DevOps
- Tiga lingkungan: local, staging, production.
- Git (branch utama dilindungi), CI/CD untuk build dan deploy otomatis.
- Pemantauan uptime dan error (UptimeRobot, Sentry).

### 2.7 Kompatibilitas
Dua versi terakhir Chrome, Safari, Edge, Firefox; Android 9+ dan iOS 14+. Rentang lebar layar 360 px sampai 1920 px.

---

## 3. AFD: App Flow Documentation

### 3.1 Alur Utama Pengunjung
**Alur A: Sekolah menjelajahi solusi lalu meminta penawaran**
1. Masuk ke Homepage.
2. Klik **Jelajahi Solusi** atau salah satu kartu solusi.
3. Melihat Katalog Produk, memfilter kategori/jenjang.
4. Membuka Detail Produk, menonton video demo, mengunduh brosur.
5. Klik **Minta Penawaran**, mengisi form (data sekolah, produk, jumlah siswa, kebutuhan).
6. Sistem memvalidasi, menyimpan lead, mengirim email konfirmasi ke pengirim dan notifikasi ke tim sales.
7. Halaman terima kasih dengan estimasi waktu respons.

**Alur B: Konsultasi langsung**
1. Homepage, klik **Konsultasi Sekolah**.
2. Isi form singkat (nama, sekolah, kontak, topik) atau pilih WhatsApp.
3. Lead tersimpan, tim menghubungi dalam 1 hari kerja.

**Alur C: Mitra dan dinas pendidikan**
1. Homepage bagian Let's Collaborate, klik **Hubungi Tim Erlass**.
2. Pilih tipe pengirim (sekolah, dinas, lembaga, mitra bisnis), isi form.
3. Lead diberi label tipe dan diteruskan ke tim yang sesuai.

**Alur D: Verifikasi kredibilitas**
1. Menu About, buka Legalitas dan Sertifikasi, Tim, Partner.
2. Kembali ke katalog atau menghubungi tim.

### 3.2 Alur Admin
1. Login ke panel admin.
2. Kelola konten: tambah/edit produk, unggah brosur, tambah video, publikasikan.
3. Konten melewati status draft, review, publish; situs memperbarui halaman terkait otomatis.
4. Kelola lead: lihat daftar, ubah status (baru, dihubungi, penawaran dikirim, berhasil, tidak lanjut), ekspor CSV.

### 3.3 Peta Navigasi
- Header: Solutions (mengarah ke katalog kategori), Program (ekstrakurikuler dan pelatihan guru), Partner, About (6 subhalaman). CTA tetap di header: Konsultasi.
- Footer: tautan cepat, kontak, media sosial, kebijakan privasi.

### 3.4 Penanganan Kondisi Khusus
- Validasi gagal: pesan galat di tiap kolom, data tidak hilang.
- Gagal kirim: tawarkan tombol WhatsApp sebagai jalur cadangan.
- Halaman tidak ditemukan: halaman 404 dengan tautan ke katalog dan kontak.
- Unduhan bergerbang: tautan dikirim lewat email, berlaku terbatas.

---

## 4. DBD: Design Brief Documentation

### 4.1 Tujuan dan Kesan Merek
Website harus terasa **modern, hangat, tepercaya, dan edukatif**. Tujuannya memberi keyakinan pada kepala sekolah sekaligus menarik minat guru dan siswa. Hindari tampilan terlalu korporat yang kaku atau terlalu kekanak-kanakan.

### 4.2 Arah Visual & Palet Warna Resmi
- **Palet Warna Resmi (Coolors):** `["#8ecae6","#219ebc","#023047","#ffb703","#fb8500"]` (Tautan: [https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500](https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500))
  - `#023047` (**Prussian Navy / Deep Navy**): Warna dasar korporat, latar belakang hero banner, footer, kartu gelap, serta tipografi kontras tinggi (heading).
  - `#219ebc` (**Blue Green / Cyan Accent**): Warna primer aksen brand, tautan navigasi, ikon solusi, status aktif, dan garis tepi fokus.
  - `#8ecae6` (**Light Sky Blue**): Warna aksen sekunder untuk garis pembatas halus, pola grid dekoratif latar belakang, pill badge, dan subtle hover glow.
  - `#ffb703` (**Selective Yellow / Amber**): Warna penanda metrik kuantitatif, rating bintang, label kategori khusus, dan aksen visual hangat.
  - `#fb8500` (**UT Orange / Vivid Orange**): Warna pemicu konversi utama (CTA Primary buttons seperti "Konsultasi Sekolah", "Ajukan Penawaran", "Kirim Formulir").
- **Latar Belakang & Netral:** Latar dasar putih bersih (`#ffffff`) dan abu-abu netral sejuk (`#f8fafc` / `#f1f5f9`) dengan garis pemisah slate (`#e2e8f0`).
- **Tipografi:** Sans-serif modern dan tegas: *Plus Jakarta Sans* untuk seluruh heading, tombol, dan body text untuk keterbacaan tinggi di layar seluler maupun desktop.
- **Fotografi & Ikon:** Menggunakan foto dokumentasi kegiatan nyata di sekolah mitra Erlass dan ikon vektor monoline inline SVG (menghilangkan emoji berlebihan).
- **Bentuk & Kedalaman:** Sudut membulat modern (`rounded-xl` / `rounded-2xl`), bayangan lembut berlapis (subtle multi-layer shadows), dan efek glassmorphism profesional.
- **Gerak & Aksesibilitas:** Transisi halus 200–300ms, infinite marquee social proof yang berhenti saat kursor diarahkan (hover pause), serta kepatuhan penuh terhadap preferensi `prefers-reduced-motion`.

### 4.3 Struktur Homepage (urutan bagian)
| # | Bagian | Isi | Catatan desain |
|---|---|---|---|
| 1 | Header | Logo, Solutions, Program, Partner, About, tombol Konsultasi | Menempel di atas, ringkas di seluler |
| 2 | Hero | Headline, tagline, 2 tombol, gambar/foto siswa | Tombol utama solid, sekunder outline |
| 3 | Our Education Solutions | 4 kartu: ikon, judul, deskripsi satu baris, tautan | Grid 2x2 desktop, tumpuk di seluler |
| 4 | Social proof | Logo sekolah/mitra, angka dampak | Opsional tetapi disarankan |
| 5 | Why Erlass? | Judul, paragraf, 5 pilar dengan ikon | Boleh latar warna lembut |
| 6 | Let's Collaborate | Judul, audiens, tombol Hubungi Tim Erlass | Blok kontras warna utama |
| 7 | Footer | Navigasi, kontak, sosial, privasi | - |

### 4.4 Komponen yang Perlu Dirancang
Tombol (utama, sekunder, teks), kartu solusi, kartu produk, kartu video, kartu tim, logo mitra, form (kolom, galat, sukses), tab dan filter, aksordion FAQ, banner CTA, header dan footer.

### 4.5 Aksesibilitas dan Responsif
Kontras teks minimal 4,5:1, target sentuh minimal 44 px, fokus terlihat jelas untuk keyboard, teks alternatif untuk gambar. Titik putus: 360, 768, 1024, 1440 px.

### 4.6 Tone Penulisan
Bahasa Indonesia yang jelas dan hangat, berorientasi manfaat bagi sekolah, hindari jargon berlebihan. Gunakan sapaan konsisten ("Anda" atau "kita", pilih salah satu).

### 4.7 Hasil Kerja Desain
Moodboard, wireframe low-fidelity (homepage, katalog, detail produk, form), desain high-fidelity desktop dan seluler, panduan gaya dan pustaka komponen di Figma.

---

## 5. BSD: Backend Schema Documentation

Asumsi PostgreSQL. Semua tabel memiliki `id` (UUID), `created_at`, `updated_at`. Untuk dukungan dua bahasa, kolom teks dapat dibuat berpasangan (`*_id`, `*_en`) atau memakai fitur lokalisasi CMS.

### 5.1 Daftar Tabel

**categories**
| Kolom | Tipe | Keterangan |
|---|---|---|
| name | varchar | Nama kategori (Coding, Robotik, LMS, Asesmen, Pelatihan Guru, Ekstrakurikuler) |
| slug | varchar unik | URL |
| description | text | Deskripsi singkat |
| icon | varchar | Referensi ikon |
| sort_order | int | Urutan tampil |

**products**
| Kolom | Tipe | Keterangan |
|---|---|---|
| category_id | FK categories | Kategori |
| name | varchar | Nama produk |
| slug | varchar unik | URL |
| summary | varchar | Ringkasan satu kalimat |
| description | text | Deskripsi lengkap |
| education_levels | varchar[] | SD, SMP, SMA/SMK, dst. |
| features | jsonb | Daftar fitur dan manfaat |
| cover_image | varchar | URL gambar |
| status | enum | draft, published |
| is_featured | boolean | Tampil di homepage |

**product_media**
| Kolom | Tipe | Keterangan |
|---|---|---|
| product_id | FK products | - |
| type | enum | image, video |
| url | varchar | Lokasi file atau URL video |
| caption | varchar | Keterangan |

**videos**
| Kolom | Tipe | Keterangan |
|---|---|---|
| title | varchar | Judul |
| youtube_url | varchar | Tautan video |
| product_id | FK products, nullable | Produk terkait |
| category_id | FK categories, nullable | Kategori |
| status | enum | draft, published |

**downloads**
| Kolom | Tipe | Keterangan |
|---|---|---|
| title | varchar | Judul dokumen |
| file_url | varchar | Lokasi PDF |
| category_id | FK categories, nullable | Kategori |
| is_gated | boolean | Perlu isi data sebelum unduh |
| download_count | int | Penghitung |

**leads**
| Kolom | Tipe | Keterangan |
|---|---|---|
| type | enum | consultation, quotation, collaboration, download |
| sender_type | enum | school, education_office, institution, business_partner, other |
| full_name | varchar | Nama kontak |
| organization | varchar | Nama sekolah/lembaga |
| email | varchar | Email |
| phone | varchar | Telepon/WhatsApp |
| city | varchar | Kota/kabupaten |
| student_count | int, nullable | Perkiraan jumlah siswa |
| message | text | Kebutuhan |
| consent_given | boolean | Persetujuan UU PDP |
| status | enum | new, contacted, quoted, won, lost |
| source | varchar | UTM / halaman asal |
| assigned_to | FK users, nullable | Penanggung jawab |

**lead_products** (relasi banyak ke banyak: produk yang diminati)
| Kolom | Tipe |
|---|---|
| lead_id | FK leads |
| product_id | FK products |

**partners**
| Kolom | Tipe | Keterangan |
|---|---|---|
| name | varchar | Nama mitra |
| logo_url | varchar | Logo |
| type | enum | school, strategic, technology |
| website | varchar | Situs mitra |
| sort_order | int | Urutan |

**team_members**
| Kolom | Tipe | Keterangan |
|---|---|---|
| name | varchar | Nama |
| position | varchar | Jabatan |
| photo_url | varchar | Foto |
| bio | text | Profil singkat |
| group | enum | management, team |

**legal_documents**
| Kolom | Tipe | Keterangan |
|---|---|---|
| title | varchar | Nama (NIB, akta, sertifikat) |
| number | varchar | Nomor dokumen |
| issued_by | varchar | Penerbit |
| file_url | varchar, nullable | Berkas |

**pages** (konten statis: visi misi, sejarah, kebijakan privasi)
| Kolom | Tipe |
|---|---|
| slug | varchar unik |
| title | varchar |
| content | text/richtext |
| status | enum |

**offices** (kontak dan lokasi)
| Kolom | Tipe |
|---|---|
| name, address, phone, email | varchar |
| latitude, longitude | decimal |
| is_main | boolean |

**users** (admin)
| Kolom | Tipe | Keterangan |
|---|---|---|
| name, email | varchar | Identitas |
| password_hash | varchar | Hash kata sandi |
| role | enum | admin, editor, sales |
| is_active | boolean | - |

### 5.2 Relasi Utama
- categories 1 ke N products.
- products 1 ke N product_media.
- products N ke N leads melalui lead_products.
- products dan categories 1 ke N videos dan downloads (opsional).
- users 1 ke N leads (penanggung jawab).

### 5.3 Indeks dan Aturan
- Indeks unik pada `slug`; indeks pada `products.category_id`, `leads.status`, `leads.created_at`.
- Hapus lunak (soft delete) untuk produk dan lead.
- Data pribadi lead dihapus atau dianonimkan setelah masa retensi yang ditetapkan kebijakan privasi.
- Seluruh perubahan penting dicatat dalam log audit.

---

## 6. IPD: Implementation Plan Documentation

### 6.1 Fase dan Jadwal (estimasi 10 sampai 12 minggu)
| Fase | Minggu | Kegiatan | Hasil |
|---|---|---|---|
| 0. Inisiasi | 1 | Kickoff, finalisasi ruang lingkup, putuskan teknologi (headless atau WordPress), daftar konten | Dokumen lingkup disepakati |
| 1. Riset dan IA | 1 sampai 2 | Validasi persona, sitemap akhir, wireframe | Wireframe disetujui |
| 2. Desain UI | 2 sampai 4 | Moodboard, desain homepage, katalog, detail, form, pustaka komponen | Desain high-fidelity desktop dan seluler |
| 3. Pengembangan backend dan CMS | 4 sampai 7 | Skema basis data, CMS, API, layanan lead, notifikasi | API dan panel admin berfungsi |
| 4. Pengembangan frontend | 5 sampai 9 | Implementasi halaman, integrasi API, responsif, SEO teknis | Situs staging lengkap |
| 5. Konten | 4 sampai 9 (paralel) | Penulisan teks, foto, video, brosur, data produk, legalitas | Konten terisi di CMS |
| 6. Pengujian | 9 sampai 10 | Fungsional, lintas peramban, performa, aksesibilitas, keamanan, UAT oleh Erlass | Daftar perbaikan selesai |
| 7. Peluncuran | 11 | Migrasi domain, DNS, pemantauan, pelatihan admin | Situs live |
| 8. Pascaluncur | 12 dan seterusnya | Pemantauan, perbaikan cepat, evaluasi KPI | Laporan 30 hari |

### 6.2 Tim yang Dibutuhkan
Project manager, UI/UX designer, frontend developer, backend developer, content writer/editor, QA, serta perwakilan Erlass sebagai pemilik produk dan pengambil keputusan.

### 6.3 Prioritas Rilis
- **Rilis 1 (MVP):** Homepage, Tentang Erlass, Katalog produk (6 kategori), Form Konsultasi dan Penawaran, Kontak, SEO dasar, analitik.
- **Rilis 2:** Video demo, unduhan brosur dengan gerbang lead, halaman Partner lengkap, filter katalog.
- **Rilis 3:** Versi bahasa Inggris, studi kasus dan artikel, integrasi CRM.

### 6.4 Pengujian dan Kriteria Penerimaan
- Semua kebutuhan Must pada PRD lulus uji fungsional.
- Form mengirim lead dan notifikasi diterima kurang dari 1 menit.
- Lighthouse seluler: performa dan aksesibilitas di atas 90.
- Tidak ada galat kritis pada Chrome, Safari, Edge, Firefox terbaru.
- UAT ditandatangani Erlass.

### 6.5 Risiko dan Mitigasi
| Risiko | Dampak | Mitigasi |
|---|---|---|
| Konten terlambat | Jadwal molor | Tetapkan tenggat konten per minggu, gunakan teks sementara |
| Perubahan ruang lingkup | Biaya dan waktu naik | Proses persetujuan perubahan, jadwalkan ke rilis berikutnya |
| Spam pada form | Lead tidak berkualitas | Turnstile, rate limit, validasi |
| Kepatuhan data pribadi | Risiko hukum | Persetujuan eksplisit, kebijakan privasi, retensi data |
| Ketergantungan satu orang | Operasional terhenti | Dokumentasi dan pelatihan lebih dari satu admin |

### 6.6 Pemeliharaan
Pembaruan keamanan bulanan, pencadangan harian, tinjauan analitik bulanan, dan pembaruan konten produk setiap kali ada perubahan kurikulum atau perangkat.

---

## 7. Realisasi Implementasi & Integrasi Data Erlass CRM (November 2026)

Implementasi teknis pada website `newgaleribelajar` telah disesuaikan dengan infrastruktur nyata server dan data aktual dari **Erlass CRM** (`erlass_data`):

### 7.1 Integrasi Data Erlass CRM
1. **Koneksi Database Langsung:**
   - Menambahkan konfigurasi koneksi database `crm` pada `config/database.php` yang terhubung ke basis data MySQL `erlass_data`.
2. **Kategori Produk (`categories`):**
   - Disinkronkan dari `spdata_masterkategoriproduk` ke tabel `categories` (7 kategori utama: Coding & Informatika, Micro:bit & IoT, Robotika Edukasi, Asesmen Bakat Siswa, Erlass Academy LMS, Modul Cetak & LKPD, serta Modul Digital PDF).
3. **Katalog Produk (`products`):**
   - Disinkronkan dari tabel `produk` (130 produk terdaftar).
   - Dilengkapi relasi jumlah deal riil dari tabel `spdata_spdetail` (SKU unggulan seperti `ECR01`, `MLK01`, `RE01`, `LMS-PMB01`, `MSJ01` s/d `MSJ06`).
4. **Sekolah Mitra (`partners`):**
   - Menyaring data riil dari relasi `spdata_spheader` dan `master_pelanggan` dengan filter `status_sp = 'Deal'` dan jenjang sekolah (`TK`, `SD`, `SMP`, `SMA`, `SMK`).
   - Berhasil memetakan **407 Sekolah Mitra Riil** di seluruh Indonesia dengan 1.100+ transaksi kontrak SP terlaksana (contoh: *SDS Al-Azhar 4, SDI Teladan Suci, SD Bangun Mandiri, SDIT Cordova, SDS Muhammadiyah 23, SMPK Ignatius Slamet Riyadi*).
5. **Command Otomatisasi Sinkronisasi:**
   - Disediakan artisan command `php artisan app:sync-crm-data` untuk memperbarui data sewaktu-waktu tanpa downtime.

### 7.2 Standar Desain B2B Profesional & Palet Warna Resmi
- **Palet Warna Resmi (Coolors):** Menerapkan palet resmi `["#8ecae6","#219ebc","#023047","#ffb703","#fb8500"]` (sumber: [https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500](https://coolors.co/palette/8ecae6-219ebc-023047-ffb703-fb8500)) secara konsisten pada:
  - Header & Pengumuman Atas (`#023047`, `#8ecae6`, `#fb8500`)
  - Hero Section (`#023047`, `#219ebc`, `#ffb703`, `#fb8500`)
  - Kartu 4 Solusi Edukasi & 5 Pilar Nilai
  - Social Proof Marquee (407 Sekolah Mitra Terverifikasi)
  - Formulir Konsultasi B2B & Tombol Konversi
  - Footer Korporat, Halaman Galeri, Detail Program, dan Halaman Error (404/500)
- **Eliminasi Gaya Kartun (Playful Kids):** Menghapus ornamen kekanak-kanakan (balon udara, tumpukan buku kartun, cap tangan anak-anak, warna kuning/pink mencolok).
- **Prinsip Anti-AI Slop:**
  - Menghilangkan kata-kata hiperbolis AI klise (*revolusioner*, *lanskap mutakhir*, *testament to*, *menyelami*, dll).
  - Menghapus emoji berlebihan pada heading dan kartu layanan; menggantinya dengan ikon inline SVG profesional.
  - Memprioritaskan data faktual (407 sekolah mitra, 1.100+ kontrak SP, alamat kantor fisik riil, nomor kontak resmi).
  - Formulir konsultasi B2B dilengkapi persetujuan eksplisit kepatuhan **UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)**.

---

## Langkah Berikutnya yang Disarankan
1. Konfirmasi pilihan teknologi (headless CMS atau WordPress) dan anggaran.
2. Kirim aset: logo vektor, foto, brosur, data legalitas, daftar mitra.
3. Setujui sitemap dan struktur homepage di bagian 0 sebagai dasar wireframe.
