# Panduan Admin per Role

Panduan singkat untuk setiap pengguna panel admin (**`/admin`**). Cukup baca bagian sesuai role Anda. Untuk penjelasan lengkap tiap menu, lihat [PANDUAN_ADMIN.md](PANDUAN_ADMIN.md).

| Role | Untuk siapa | Baca bagian |
|---|---|---|
| **Content Writer** | Penulis artikel | [A. Content Writer](#a-content-writer) |
| **Admin** | Tim konten & pemasaran | [B. Admin](#b-admin) |
| **Super Admin** | Penanggung jawab website | [B. Admin](#b-admin) + [C. Super Admin](#c-super-admin) |

Panduan ini juga tampil di panel admin, menu **Panduan** tepat di bawah Dashboard. Mengubah file ini langsung mengubah isi halaman tersebut.

**Berlaku untuk semua role**

- Masuk di `https://<alamat-website>/admin` dengan email dan kata sandi yang diberikan Super Admin.
- Menu di kiri hanya menampilkan apa yang boleh Anda buka. Kalau sebuah menu tidak ada, berarti memang bukan wewenang role Anda.
- Setiap perubahan **langsung tampil di website** setelah disimpan. Tidak perlu menunggu atau menghapus cache.
- Lupa kata sandi atau akun terkunci: hubungi Super Admin.
- Jangan berbagi akun. Setiap perubahan tercatat atas nama akun yang dipakai.

---

## A. Content Writer

**Tugas Anda:** menulis artikel lalu mengajukannya ke Admin untuk diterbitkan. Menu yang tersedia hanya **Konten › Artikel**.

### Yang bisa dan tidak bisa

| Bisa | Tidak bisa |
|---|---|
| Membuat artikel baru (selalu mulai sebagai **Draf**) | Menerbitkan artikel sendiri |
| Mengedit artikel milik sendiri yang berstatus **Draf** atau **Perlu Revisi** | Mengedit artikel orang lain |
| Menghapus draf milik sendiri | Mengedit artikel yang sedang **Menunggu Persetujuan** atau sudah **Terbit** |
| Mengajukan artikel untuk disetujui | Menyematkan (pin) artikel, mengelola komentar, produk, atau pengaturan |

### Alur kerja

1. **Konten › Artikel › Buat** → isi judul, ringkasan, isi, kategori, gambar sampul, dan hashtag → **Simpan**.
2. Periksa lagi, lalu klik **Ajukan Persetujuan**. Status berubah menjadi **Menunggu Persetujuan** dan artikel terkunci.
3. Admin akan memilih salah satu:
   - **Setujui & Terbitkan** → artikel tampil di website.
   - **Minta Revisi** → status menjadi **Perlu Revisi** dan **catatan Admin** muncul di bagian *Penerbitan* pada form. Perbaiki sesuai catatan, lalu **Ajukan Persetujuan** lagi.

### Checklist sebelum mengajukan

- [ ] Judul jelas, sekitar 50–70 karakter.
- [ ] Ringkasan ± 150 karakter. Ringkasan ini tampil di kartu artikel dan di Google.
- [ ] Isi: pisahkan paragraf dengan **satu baris kosong**.
- [ ] Gambar sampul JPG/PNG/WebP, maks. 2 MB, ukuran ideal 1600×1000 px. Pakai foto sendiri atau foto berizin.
- [ ] Hashtag 3–6 buah, tanpa `#` dan tanpa spasi (contoh: `KompetisiRobotika`).
- [ ] Kategori sudah dipilih.
- [ ] *(Opsional)* **Versi Bahasa Inggris (EN)**: isi judul, ringkasan, dan isi dalam bahasa Inggris. Kalau dikosongkan, pengunjung mode EN tetap melihat versi Indonesia.
- [ ] *(Opsional)* **SEO**: kalau dikosongkan, sistem memakai judul dan ringkasan. Panduan panjang ideal ada di [PANDUAN_ADMIN.md › SEO](PANDUAN_ADMIN.md#13-panduan-pengisian-seo).

> **Jangan mengubah Slug URL** setelah artikel terbit, karena link yang sudah dibagikan akan rusak.

---

## B. Admin

**Tugas Anda:** mengelola seluruh isi website, menyetujui artikel, memoderasi komentar, dan mengurus data pemasaran. Admin **tidak** bisa mengelola akun pengguna atau melihat Riwayat Perubahan.

### Rutinitas yang disarankan

| Kapan | Apa yang dicek | Menu |
|---|---|---|
| Setiap hari | Artikel yang menunggu persetujuan (angka di samping menu) | Konten › Artikel |
| Setiap hari | Komentar berstatus **Perlu Ditinjau** | Konten › Komentar |
| Setiap hari | Lead konsultasi baru, lalu ditindaklanjuti lewat WhatsApp | Pemasaran › Lead Konsultasi |
| Setiap minggu | Produk baru/berubah, foto, dan versi EN | Katalog › Produk |
| Saat ada sekolah baru | Data sekolah dan logo | Katalog › Sekolah Mitra |
| Saat ada kampanye | Banner beranda dan pengumuman | Sistem › Pengaturan Beranda, Konten › Pengumuman |

### 1. Artikel: menyetujui dan menerbitkan

- Buka artikel berstatus **Menunggu Persetujuan**, baca, lalu pilih:
  - **Setujui & Terbitkan**, atau
  - **Minta Revisi** dengan catatan yang jelas (wajib diisi). Catatan ini yang dibaca penulis.
- **Tarik dari Situs**: menyembunyikan artikel yang sudah terbit (kembali menjadi draf).
- **Sematkan (pin)**: artikel tampil paling atas di halaman Artikel dan di beranda. Hanya untuk artikel yang sudah terbit. Sematkan secukupnya, 1–3 artikel.
- Admin juga bisa langsung menulis dan menerbitkan artikel sendiri.
- Kategori artikel dikelola di **Konten › Kategori Artikel**.

### 2. Komentar

- Komentar yang berisi kata kasar, judi online, tautan, atau ditulis huruf kapital semua otomatis **ditahan**.
- Aksi: **Tampilkan**, **Sembunyikan**, **Edit**, **Hapus**. Bisa sekaligus untuk beberapa komentar dengan mencentangnya.
- Tambah kata terlarang di **Sistem › Pengaturan Situs › Moderasi Komentar**.

### 3. Katalog

| Menu | Yang perlu diketahui |
|---|---|
| **Produk** | Nama, SKU, kategori, jenis, jenjang, foto (kosongkan untuk memakai sampul otomatis), **Tampil/Disembunyikan**, **Unggulan** (masuk carousel beranda), Shopee, LMS, FAQ. Isi bagian **Versi Bahasa Inggris (EN)** agar katalog tampil dalam bahasa Inggris. Kolom **EN** di tabel menandai produk yang belum diterjemahkan (filter *Versi Inggris*). |
| **Kategori Produk** | Nama dan slug (otomatis), deskripsi, ikon, sakelar **Aktif**. Urutan diatur dengan seret-lepas. Tabel menampilkan jumlah produk per kategori. |
| **Sekolah Mitra** | Data sekolah, **logo** (PNG/JPG/WebP, persegi, maks. 1 MB; PNG transparan paling bagus), dan sakelar **Di beranda**. Maks. 40 sekolah tampil di deretan *"Telah dipercaya oleh"*, urut dari angka **Urutan** terkecil. Pakai filter **Belum ada logo** untuk mencari sekolah yang logonya belum diunggah. Tanpa logo, yang tampil adalah label jenjang (SD/SMP/…). |
| **Kolom Produk LMS** | Kolom Intrakurikuler/Course/Asesmen di halaman `/lms` dan tombol loncat di beranda. Tambah/keluarkan produk, seret untuk mengurutkan. Kolom kosong tidak tampil. |
| **Pertanyaan (FAQ)** | FAQ katalog dan template FAQ produk. Variabel seperti `{produk}` dan `{jenjang}` otomatis diisi sesuai produk. Daftar variabel ada di [PANDUAN_ADMIN.md › FAQ](PANDUAN_ADMIN.md#6-pertanyaan-faq). |

> Produk yang disembunyikan tetap tersimpan. Pilih **Disembunyikan** daripada menghapus produk bila hanya ingin menonaktifkan sementara.

### 4. Konten lain

- **Galeri Foto**: pilih kategori dan sub-kategori, foto maks. 3 MB, seret untuk mengurutkan.
- **Program**: halaman program (Coding, Robotika, dll.).
- **Pengumuman**: info singkat yang tampil di kotak *Informasi Program Terbaru* di beranda. Matikan sakelar aktif bila sudah tidak berlaku.

### 5. Pengaturan Beranda (Sistem › Pengaturan Beranda)

- **Hero / banner geser:**
  - *Slide pertama*: label, judul, kata yang diwarnai, deskripsi, teks dua tombol, dan foto.
  - *Slide berikutnya*: setiap slide berisi foto, label, judul, dan keterangan. Bisa ditambah, dihapus, dan diurutkan.
  - Pakai foto **landscape** yang terang, maks. 3 MB. Judul slide singkat, 3–6 kata, agar tidak terpotong di HP.
- **Bagian Beranda:** ubah label, judul, dan deskripsi tiap bagian, atau **sembunyikan** bagian tertentu.
- Tombol **Lihat Beranda** untuk mengecek hasil. Tombol **Kembalikan ke Bawaan** mengembalikan semua isi beranda ke awal. Hati-hati, isian Anda akan hilang.
- Teks beranda yang Anda ubah tidak otomatis diterjemahkan ke mode EN. Minta developer menambahkan terjemahannya bila perlu.

### 6. Pengaturan Situs (Sistem › Pengaturan Situs)

| Tab | Isi |
|---|---|
| Toko & Platform | Link Shopee, link LMS |
| Kontak | WhatsApp (format `62…`), telepon, email, jam layanan (satu jadwal per baris), alamat |
| Media Sosial | Instagram, TikTok, YouTube, Facebook |
| Video | Daftar video YouTube: 3 video pertama tampil di *Why Erlass?* di beranda, semuanya di Galeri |
| Moderasi Komentar | Komentar tampil otomatis, kata terlarang tambahan |

> Salah ketik nomor WhatsApp membuat semua tombol "Konsultasi" tidak berfungsi. Cek ulang setelah mengubahnya.

### 7. Pemasaran dan data pribadi

- **Lead Konsultasi**: isian form konsultasi. Segera tindak lanjuti.
- **Kontak Promosi**: email dari komentar, newsletter, dan form. **Ekspor CSV** hanya mengunduh kontak yang memberi izin promosi.
- **Subscriber Newsletter**: daftar pendaftar newsletter.
- Bila seseorang minta berhenti dihubungi, matikan **Izin promosi**-nya.

> Sesuai **UU PDP**: kirim promosi hanya ke kontak dengan *Izin promosi = Ya*. Jangan menyimpan file ekspor di tempat umum atau mengirimnya ke pihak luar. Setiap ekspor tercatat.

---

## C. Super Admin

Super Admin bisa melakukan **semua yang ada di bagian B**, ditambah:

### 1. Pengguna & Role (Sistem › Pengguna & Role)

- **Tambah akun**: nama, email, role, status aktif, dan kata sandi (min. 10 karakter, berisi huruf dan angka). Berikan kata sandi secara pribadi, jangan lewat grup.
- **Pilih role seminimal mungkin**: penulis cukup **Content Writer**. Beri **Admin** hanya untuk yang memang mengelola konten dan data pemasaran. **Super Admin** cukup 1–2 orang.
- **Karyawan keluar atau pindah tugas**: segera **nonaktifkan** akunnya. Akun nonaktif tidak bisa login, dan riwayatnya tetap tersimpan.
- Saat mengedit akun, kosongkan kata sandi bila tidak ingin menggantinya.
- Anda tidak bisa menghapus atau menurunkan role akun Anda sendiri. Ini mencegah website kehilangan Super Admin.

### 2. Riwayat Perubahan (Sistem › Riwayat Perubahan)

- Mencatat siapa menambah, mengubah, atau menghapus data, beserta login, login gagal, logout, dan ekspor data.
- Klik **Detail** untuk melihat nilai **sebelum → sesudah**. Gunakan ini bila ada isi website yang berubah tanpa diketahui.
- Banyak **login gagal** dari satu email bisa jadi tanda percobaan pembobolan. Ganti kata sandi akun tersebut.
- Log tidak bisa diubah atau dihapus, dan otomatis dibersihkan setelah 365 hari.

### 3. Tanggung jawab lain

- **Hapus permanen** data hanya bisa dilakukan Super Admin. Pastikan data memang tidak dibutuhkan lagi.
- Koordinasikan dengan developer untuk hal yang tidak bisa diatur dari admin: kategori galeri (`config/gallery.php`), terjemahan teks tetap ke bahasa Inggris (`resources/lang/en.json`), dan pembaruan server (lihat [DEPLOYMENT.md](DEPLOYMENT.md)).
- Tinjau daftar pengguna sebulan sekali. Pastikan tidak ada akun yang tidak dikenal atau akun lama yang masih aktif.

---

## Ringkasan hak akses

| Menu | Content Writer | Admin | Super Admin |
|---|:---:|:---:|:---:|
| Artikel: tulis & ajukan | ✅ (milik sendiri) | ✅ | ✅ |
| Artikel: setujui, terbitkan, tarik, sematkan | — | ✅ | ✅ |
| Kategori Artikel, Komentar, Galeri, Program, Pengumuman | — | ✅ | ✅ |
| Produk, Kategori Produk, Sekolah Mitra, Kolom LMS, FAQ | — | ✅ | ✅ |
| Lead, Kontak Promosi (ekspor), Subscriber | — | ✅ | ✅ |
| Pengaturan Situs & Pengaturan Beranda | — | ✅ | ✅ |
| Hapus permanen data | — | — | ✅ |
| Pengguna & Role | — | — | ✅ |
| Riwayat Perubahan | — | — | ✅ |
