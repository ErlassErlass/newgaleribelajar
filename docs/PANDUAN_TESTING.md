# Panduan Pengujian Manual (Manual Testing)

Berikut adalah langkah-langkah untuk melakukan tes manual guna memastikan website berjalan dengan baik secara visual dan fungsional.

## 1. Persiapan Lingkungan Test

Pastikan server development berjalan:
1.  Jalankan `npm run build` (atau `npm run dev` untuk hot-reload).
2.  Buka Browser (Chrome/Edge/Firefox) dan akses `http://galeribelajar.test` atau `http://127.0.0.1:8000`.

## 2. Checklist Pengujian Visual — Landing Page

### Navbar
- [ ] Logo "ERLASS" terlihat di kiri atas.
- [ ] Menu desktop: Home, Tentang Kami, Program, Galeri, Gabung Sekarang.
- [ ] Language switcher ID/EN berfungsi.
- [ ] **Mobile**: Hamburger button muncul → klik → drawer slide dari kanan → klik link → drawer menutup.

### Hero Section
- [ ] Background kuning (`kids-yellow`) terlihat.
- [ ] Heading animasi muncul (text split word-by-word).
- [ ] CTA: "Lihat Program" (mint) + "Tentang Kami" (putih).
- [ ] Background 3D: partikel titik-titik muncul di belakang.

### About Erlass
- [ ] Badge "Erlass Mitra Pendidikan" (pink).
- [ ] Stats: 150+ Sekolah, 2.000+ Siswa, 140.000+ Guru, 70+ Instruktur.
- [ ] CTA "Lihat Program Kami" scroll ke section Programs.

### Why Choose Us
- [ ] 3 kartu: Modul PBL, P5, Support Promosi.
- [ ] Hover: shadow muncul + kartu naik.

### Programs
- [ ] 3 kartu program: Coding 💻, Robotika 🤖, P5 🎓.
- [ ] Klik "Koding Scratch & Python" → navigasi ke `/programs/coding`.
- [ ] Klik "Robotika & IoT" → navigasi ke `/programs/robotics`.

### Clients Marquee
- [ ] 2 baris logo sekolah mitra bergerak (berlawanan arah).
- [ ] Hover: animasi pause, gambar dari grayscale → full color.

### Testimoni
- [ ] 3 kartu testimonial terlihat (⭐⭐⭐⭐⭐).
- [ ] Avatar initial letter (S, R, A) dengan warna berbeda.

### Contact Form
- [ ] Background kuning, form putih di tengah.
- [ ] Fields: Nama, Telepon, Email, Nama Sekolah, Program (dropdown), Pesan.
- [ ] Tombol "Kirim Permintaan Konsultasi" bisa diklik.
- [ ] Link WhatsApp di bawah form mengarah ke `wa.me/6282311341381`.

### WhatsApp Floating Button
- [ ] Tombol hijau bulat di pojok kanan bawah, selalu terlihat.
- [ ] Animasi pulse hijau berdenyut.
- [ ] Klik → buka WhatsApp ke nomor CS Alya.

### Footer
- [ ] 3 kolom: ERLASS + alamat, Programs, Contact + Social.
- [ ] Social icons: Instagram, YouTube, TikTok, Facebook.

## 3. Checklist Responsivitas

- [ ] Tekan `F12` → klik icon Mobile (Ctrl+Shift+M).
- [ ] Cek tampilan di "iPhone SE" / "Samsung Galaxy S8".
- [ ] Teks tidak terpotong.
- [ ] Kartu program tersusun ke bawah (stacking).
- [ ] Hamburger menu muncul dan berfungsi.
- [ ] WhatsApp button tidak overlap dengan konten.

## 4. Checklist Halaman Internal

### `/programs/coding`
- [ ] Hero "Future Skills" + heading "Coding & AI".
- [ ] 3 level learning path (Scratch → Python → AI).
- [ ] Tools section (Scratch, Python, HTML5, CSS3, JS, VS Code).

### `/programs/robotics`
- [ ] Hero + deskripsi kit robotika.
- [ ] CTA bawah berfungsi.

### `/gallery`
- [ ] Video thumbnail dengan play button.
- [ ] Instagram marquee bergerak.
- [ ] Photo grid masonry layout.

## Troubleshooting

- **Background hitam polos?**
  Cek console browser (`F12` → `Console`). Jika ada error Three.js, pastikan `npm run build` sudah jalan.

- **Style berantakan?**
  Hapus `public/hot` lalu jalankan `npm run build`, kemudian refresh.

- **Form tidak submit?**
  Pastikan route POST `/leads` ada di `routes/web.php` dan `LeadController` ter-setup.
