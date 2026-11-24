# Arsitektur & Teknologi

Untuk developer yang akan melanjutkan pengembangan.

## Gambaran Umum

```
Pengunjung ──► routes/web.php ──► Controller ──► Model (Eloquent/MySQL) ──► Blade view
                                       │
                                       └─► SiteCache (data halaman publik, auto-refresh saat admin menyimpan)

Admin ──► /admin (Filament v5 + Livewire) ──► Resource/Page ──► Policy (cek role) ──► Model
                                                                                  └─► LogsActivity ──► activity_logs
```

## Struktur Folder Penting

| Folder / file | Isi |
|---|---|
| `app/Http/Controllers/` | `HomeController`, `ProductController` (katalog, detail, sampul SVG), `ArticleController`, `ArticleCommentController`, `GalleryController`, `LeadController`, `SubscriberController`, `SitemapController`, `LlmsController` |
| `app/Models/` | `Product`, `Category`, `LmsGroup`, `Faq`, `Article`, `ArticleCategory`, `ArticleComment`, `Gallery`, `Contact`, `Subscriber`, `Lead`, `Setting`, `ActivityLog`, `User`, ... |
| `app/Filament/Resources/` | Menu-menu panel admin (satu folder per menu) |
| `app/Filament/Pages/` | `SiteSettings` (Pengaturan Situs), `HomepageSettings` (Pengaturan Beranda) |
| `app/Policies/` | Hak akses per role. `AdminContentPolicy` = Admin & Super Admin; `ArticlePolicy` = aturan alur artikel; `UserPolicy` & `ActivityLogPolicy` = Super Admin |
| `app/Support/` | Kelas bantu: `ProductCover` (sampul SVG), `SiteCache`, `LogsActivity`, `CommentModeration`, `YoutubeFeed` |
| `app/Http/Middleware/SecurityHeaders.php` | Header keamanan untuk semua halaman |
| `config/erlass.php` | Data perusahaan bawaan (kontak, link, media sosial, video) |
| `config/homepage.php` | Teks bawaan beranda |
| `config/gallery.php` | Kategori & sub-kategori galeri |
| `config/moderation.php` | Daftar kata terlarang bawaan |
| `resources/views/` | `welcome` (beranda), `products/`, `articles/`, `gallery`, `legal/`, `layouts/app`, `partials/` |
| `database/seeders/` | `CrmDataSeeder` (data CRM offline), `LmsCatalogSeeder`, `ArticleSeeder`, `GallerySeeder`, `FaqSeeder` |
| `tests/Feature/` | `AdminPanelTest`, `PublicSiteTest` |

## Konsep Penting

### Pengaturan dari admin menimpa config
Tabel `settings` (key/value JSON) diisi dari **Pengaturan Situs** dan **Pengaturan Beranda**. Saat aplikasi berjalan, `Setting::applyToConfig()` (dipanggil di `AppServiceProvider`) menimpa `config('erlass.*')` dan `config('homepage')`. Jadi di view cukup memakai `config('erlass.shopee')`; nilainya otomatis yang terbaru dari admin.

### Cache halaman publik
`App\Support\SiteCache` menyimpan data beranda, FAQ, dan `llms.txt` dengan nomor versi. Model konten yang memakai trait `FlushesSiteCache` (Product, Article, Gallery, Faq, LmsGroup, ...) menaikkan versi setiap kali disimpan, sehingga situs langsung memakai data baru tanpa perlu membersihkan cache manual.

### Produk & rombel
Data CRM punya beberapa baris produk dengan nama sama (beda kode rombel, mis. ECR01–ECR07). Scope `Product::uniqueTitles()` menampilkan satu baris per judul dan menjumlahkan `deal_count` ke `group_deals`. Halaman rombel selain yang pertama dialihkan (301) ke halaman utama.

### Sampul produk
`Product::cover_url` memilih: `cover_image` (upload admin) → file di `public/img/products/{kode}.{ext}` atau `{nama-produk}.{ext}` → sampul SVG otomatis dari `ProductCover` (`/katalog/cover/{sku}.svg`).

### Kolom LMS di beranda
Tabel `lms_groups` berisi kolom; produk masuk kolom lewat `products.lms_group` (= slug kolom) dan diurutkan dengan `products.lms_order`. Slug khusus `sumber-guru` dipakai untuk banner "Gratis untuk Guru".

### FAQ
Tabel `faqs` dengan `scope` `catalog` atau `product` (template). `Product::faqItems()` menggabungkan template dan/atau `products.faqs` sesuai `faq_mode`, lalu mengganti variabel `{produk}`, `{jenjang}`, dst. (`Faq::render()`).

### Role & alur artikel
`users.role` = `super_admin` | `admin` | `writer`. `User::canAccessPanel()` hanya mengizinkan akun aktif dengan role valid. Status artikel `draft` → `review` → `published` / `rejected`; kolom `is_published` diselaraskan otomatis dari status. Writer hanya melihat artikelnya sendiri (`ArticleResource::getEloquentQuery`).

### Riwayat perubahan
Trait `LogsActivity` pada model penting mencatat created/updated/deleted bila ada user login, dengan diff sebelum → sesudah (kolom JSON di-diff per bagian). Login/logout/login gagal dicatat lewat listener di `AppServiceProvider`. Kolom berisik (`views`, `updated_at`) diabaikan; kata sandi disamarkan.

### Penghitung views
Dihitung sekali per sesi pengunjung (`ProductController@show`, `ArticleController@show`) dengan increment di level query, tanpa event model, supaya cache tidak ikut terhapus di setiap kunjungan.

## Frontend

- **Tailwind CSS v4**: konfigurasi CSS-first di `resources/css/app.css`. Setelah menambah kelas baru di Blade, jalankan `npm run build`.
- **Vite 7**: entry `resources/css/app.css` dan `resources/js/app.js`; hasil build di `public/build` (ikut di-commit).
- **GSAP + Lenis**: animasi scroll (`resources/js/scroll-animations.js`, `lenis.js`).
- **Three.js**: latar partikel hero (`resources/js/hero-3d.js`, dimuat dinamis).
- Skrip kecil per halaman (carousel katalog, tab video, pemutar galeri) ditulis inline di Blade masing-masing.

## Keamanan

- Policy per model; Filament otomatis menyembunyikan menu & tombol yang tidak diizinkan.
- Form publik dilindungi CSRF, honeypot, dan rate limit (`throttle`).
- Upload admin hanya gambar dengan batas ukuran, disimpan di `public/uploads` (eksekusi PHP diblokir lewat `.htaccess`).
- CSP aktif di luar mode lokal; sumber eksternal yang diizinkan: Google Fonts, YouTube.
