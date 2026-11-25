# Panduan Panel Admin

Panduan untuk tim yang mengelola isi website lewat **`/admin`**. Setiap menu hanya tampil untuk role yang berhak. Versi ringkas per role: [PANDUAN_PER_ROLE.md](PANDUAN_PER_ROLE.md).

## Daftar Isi

1. [Role dan hak akses](#1-role-dan-hak-akses)
2. [Artikel](#2-artikel)
3. [Komentar](#3-komentar)
4. [Produk dan katalog](#4-produk-dan-katalog)
5. [Kolom Produk LMS di beranda](#5-kolom-produk-lms-di-beranda)
6. [Pertanyaan (FAQ)](#6-pertanyaan-faq)
7. [Galeri foto](#7-galeri-foto)
8. [Kontak Promosi, Lead, dan Subscriber](#8-kontak-promosi-lead-dan-subscriber)
9. [Pengaturan Situs](#9-pengaturan-situs)
10. [Pengaturan Beranda](#10-pengaturan-beranda)
11. [Pengguna dan role](#11-pengguna-dan-role)
12. [Riwayat Perubahan](#12-riwayat-perubahan)
13. [Panduan pengisian SEO](#13-panduan-pengisian-seo)

---

## 1. Role dan hak akses

| Role | Untuk siapa | Yang bisa dilakukan |
|---|---|---|
| **Super Admin** | Penanggung jawab website | Semua menu, termasuk Pengguna & Role dan Riwayat Perubahan |
| **Admin** | Tim konten & pemasaran | Semua konten: produk, artikel (menyetujui & menerbitkan), komentar, galeri, FAQ, kontak, Pengaturan Situs & Beranda. Tidak bisa mengelola pengguna |
| **Content Writer** | Penulis artikel | Hanya menu **Artikel**: membuat dan mengedit draf miliknya sendiri, lalu mengajukannya ke Admin |

Akun yang dinonaktifkan tidak bisa masuk panel admin.

---

## 2. Artikel

Menu: **Konten › Artikel**. Kategori artikel dikelola di **Konten › Kategori Artikel** (Admin).

### Alur penerbitan

```
Draf ──(Writer: Ajukan Persetujuan)──► Menunggu Persetujuan
                                         │
                ┌───(Admin: Minta Revisi + catatan)───┐
                ▼                                     ▼
          Perlu Revisi ──(Writer: perbaiki & ajukan lagi)    Admin: Setujui & Terbitkan ──► Terbit
```

- **Content Writer** membuat artikel. Artikel baru selalu berstatus **Draf**. Setelah selesai, klik **Ajukan Persetujuan**. Selama menunggu, artikel tidak bisa diedit.
- **Admin** melihat jumlah artikel yang menunggu di samping menu Artikel, lalu memilih **Setujui & Terbitkan** atau **Minta Revisi** (wajib menulis catatan untuk penulis).
- Artikel yang sudah terbit bisa **Ditarik dari Situs** (kembali menjadi draf).
- **Sematkan (pin):** artikel yang disematkan tampil paling atas di halaman Artikel dan di beranda. Hanya artikel yang sudah terbit yang bisa disematkan.

### Tips menulis

- Isi artikel: pisahkan paragraf dengan **satu baris kosong**.
- Gambar sampul: JPG/PNG/WebP, maksimal 2 MB, disarankan 1600×1000 px.
- Hashtag: 3–6 hashtag tanpa `#` dan tanpa spasi, contoh `KompetisiRobotika`.
- Jangan mengubah **Slug URL** setelah artikel terbit, karena link yang sudah dibagikan akan rusak.

---

## 3. Komentar

Menu: **Konten › Komentar**. Angka di samping menu menunjukkan komentar yang belum tampil.

- Komentar yang mengandung **kata tidak pantas, judi online, tautan, atau ditulis huruf kapital semua** otomatis ditahan dengan status **Perlu Ditinjau**.
- Komentar lain langsung tampil bila opsi *Komentar tampil otomatis* aktif (Pengaturan Situs › Moderasi Komentar).
- Aksi per komentar: **Tampilkan**, **Sembunyikan**, **Edit**, **Hapus**. Centang beberapa komentar untuk aksi sekaligus.
- Kata terlarang bisa ditambah di **Pengaturan Situs › Moderasi Komentar**.

---

## 4. Produk dan katalog

Menu: **Katalog › Produk**.

| Bagian form | Keterangan |
|---|---|
| Informasi Produk | Nama, kode (SKU), slug, kategori, jenis (Produk Fisik / Program), ringkasan, deskripsi, jenjang, poin "yang didapat sekolah" |
| Tampilan & Status | Foto produk (kosongkan untuk memakai sampul otomatis), Tampil/Disembunyikan, Unggulan (masuk carousel beranda), jumlah sekolah pengguna, urutan |
| Penjualan & Platform | **Tersedia di Shopee** + link produk (kosong = halaman toko), **Produk LMS** + kolom di beranda + link LMS, **Gratis** |
| Pertanyaan Umum (FAQ) | Pakai template, pertanyaan khusus, atau keduanya (lihat bagian 6) |
| SEO (opsional) | Lihat bagian 13 |

**Foto produk tanpa form:** taruh file di `public/img/products/` dengan nama kode produk (`msj01.jpg`) atau nama produk (`microbit-learning-kit.jpg`). Foto otomatis menggantikan sampul buatan.

Produk dengan judul sama (beda kode rombel, misalnya ECR01–ECR07) tampil **satu kali** di katalog. Jumlah sekolahnya dijumlahkan.

---

## 5. Kolom Produk LMS di beranda

Menu: **Katalog › Kolom Produk LMS**. Mengatur bagian *"Produk Digital di LMS Erlass Academy"* di beranda.

- **Tambah Kolom**: judul, deskripsi, warna garis. Seret baris untuk mengubah urutan kolom; sakelar **Tampil** untuk menyembunyikan.
- Klik **Atur kolom & produk** untuk:
  - **Tambah produk ke kolom** (cari nama/kode, bisa banyak sekaligus);
  - seret ikon ⠿ untuk mengurutkan produk;
  - **Keluarkan** produk (produk tetap ada di katalog);
  - menyalakan/mematikan label **Shopee**.
- Satu produk hanya bisa berada di satu kolom. Kolom kosong tidak tampil di beranda.
- Banner hijau **"Gratis untuk Guru"** diisi dengan memilih *Banner "Gratis untuk Guru"* di isian **Kolom di beranda** pada form produk.

---

## 6. Pertanyaan (FAQ)

Menu: **Katalog › Pertanyaan (FAQ)**, dengan dua tab:

- **Pertanyaan Seputar Katalog**: tampil di bawah halaman `/katalog`.
- **Template Pertanyaan Umum Produk**: tampil di setiap halaman produk.

Pertanyaan dan jawaban boleh memakai **variabel** yang otomatis diganti sesuai produk:

| Variabel | Diisi dengan |
|---|---|
| `{produk}` | Nama produk |
| `{jenjang}` | Jenjang, mis. "SD, SMP" |
| `{kategori}` | Kategori produk |
| `{jenis}` | Produk fisik / program / course LMS ... |
| `{ringkasan}`, `{deskripsi}`, `{fitur}` | Isi dari form produk |
| `{sekolah}` | Jumlah sekolah pengguna |
| `{whatsapp}` | Nomor WhatsApp Erlass |
| `{info_pembelian}` | Kalimat Shopee/LMS bila produk tersedia di sana |
| `{total_produk}`, `{kategori_katalog}` | Khusus FAQ katalog |
| `{shopee}` | Link toko Shopee |

Di form produk, pilih **Sumber pertanyaan**: template saja, pertanyaan khusus saja, atau template + khusus.

---

## 7. Galeri foto

Menu: **Konten › Galeri Foto**. Pilih **Kategori** (Guru, Umum, Siswa, Anak, Erlass Festival), lalu **Sub-kategori**. Foto maksimal 3 MB. Seret baris untuk mengubah urutan.

Daftar kategori dan sub-kategori diatur di `config/gallery.php` (perlu developer).

---

## 8. Kontak Promosi, Lead, dan Subscriber

Menu: **Pemasaran**.

- **Lead Konsultasi**: isian form konsultasi dari beranda.
- **Kontak Promosi**: email yang terkumpul otomatis dari komentar, newsletter, dan form konsultasi. Kolom **Izin promosi** menunjukkan apakah kontak bersedia menerima promosi.
  - **Ekspor CSV (yang memberi izin)** mengunduh daftar yang boleh dihubungi untuk promosi (bisa dibuka di Excel/Google Sheets).
  - Matikan **Izin promosi** bila seseorang meminta berhenti menerima email.
  - Setiap ekspor tercatat di Riwayat Perubahan.
- **Subscriber Newsletter**: daftar pendaftar newsletter.

> Sesuai UU PDP, gunakan untuk promosi hanya kontak yang **Izin promosi = Ya**.

---

## 9. Pengaturan Situs

Menu: **Sistem › Pengaturan Situs**. Perubahan langsung berlaku di situs.

| Tab | Isi |
|---|---|
| Toko & Platform | Link toko Shopee, link LMS |
| Kontak | WhatsApp (format `62...`), telepon, email, **jam layanan** (satu jadwal per baris), alamat |
| Media Sosial | Instagram, TikTok, YouTube, Facebook, Grup Facebook |
| Video | YouTube Channel ID dan daftar video (3 video pertama tampil di bagian *Why Erlass?*, semuanya di Galeri) |
| Moderasi Komentar | Komentar tampil otomatis, kata terlarang tambahan |

ID video YouTube adalah 11 karakter setelah `v=` atau `youtu.be/`.

---

## 10. Pengaturan Beranda

Menu: **Sistem › Pengaturan Beranda**.

- **Hero (banner geser)**: slide pertama berisi label kecil, judul, kata yang diwarnai, deskripsi, teks dua tombol, dan foto. **Slide berikutnya** masing-masing berisi foto, label, judul, dan keterangan (bisa ditambah dan diurutkan).
- **Bagian Beranda**: untuk tiap bagian (Sekolah Mitra, Produk LMS, Solusi, Tentang Kami, Why Erlass, Program, Katalog Unggulan, Aktivitas, Kemitraan, Formulir) bisa mengubah label, judul, deskripsi, dan **menyembunyikan** bagian tersebut.
- Tombol kanan atas: **Lihat Beranda** dan **Kembalikan ke Bawaan**.

---

## 11. Pengguna dan role

Menu: **Sistem › Pengguna & Role** (Super Admin).

- Tambah akun: nama, email, **role**, status aktif, kata sandi (minimal 10 karakter, berisi huruf dan angka).
- Kosongkan kata sandi saat mengedit bila tidak ingin menggantinya.
- Super Admin tidak bisa menghapus atau menurunkan role akunnya sendiri.

---

## 12. Riwayat Perubahan

Menu: **Sistem › Riwayat Perubahan** (Super Admin).

- Mencatat siapa menambah, mengubah, atau menghapus data penting (artikel, produk, pengaturan, pengguna, komentar, kontak, kategori, FAQ, kolom LMS, galeri), serta login, login gagal, logout, dan ekspor data.
- Klik **Detail** untuk melihat nilai **sebelum → sesudah**.
- Filter berdasarkan aksi, jenis data, pengguna, dan rentang tanggal.
- Log tidak bisa diubah atau dihapus. Log lebih dari 365 hari dihapus otomatis.

---

## 13. Panduan pengisian SEO

Kolom SEO bersifat **opsional**. Kalau dikosongkan, sistem memakai judul dan ringkasan. Penghitung karakter berubah merah bila terlalu panjang.

| Kolom | Ideal | Contoh |
|---|---|---|
| Judul di Google (artikel) | 40–45 karakter (" \| Erlass Academy" ditambahkan otomatis) | Erlass Robotic Competition 2026: Jadwal & Cara Daftar |
| Judul di Google (produk) | maks. 40 karakter (" \| Katalog Erlass Academy" ditambahkan otomatis) | Modul Scratch Jilid 1 untuk SD – Belajar Coding |
| Deskripsi di Google | 120–155 karakter | Modul Scratch Jilid 1 untuk siswa SD kelas 1: belajar coding visual lewat proyek seru, sesuai Kurikulum Merdeka. Pesan via WA atau Shopee. |
| Ringkasan | ± 150 karakter | Buku kerja coding Scratch untuk siswa SD kelas 1 dengan proyek animasi dan game sederhana. |
| Slug URL | huruf kecil & tanda hubung | `modul-scratch-jilid-1` |
