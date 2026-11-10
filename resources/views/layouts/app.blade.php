<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Erlass - Solusi Pembelajaran Coding, Robotik, LMS & Asesmen Sekolah')</title>
    <meta name="title" content="@yield('title', 'Erlass - Solusi Pembelajaran Coding, Robotik, LMS & Asesmen Sekolah')">
    <meta name="description" content="@yield('description', 'Mitra resmi transformasi pendidikan teknologi: Coding & Informatika, Robotik, Micro:bit, Erlass Academy LMS, dan Asesmen Siswa untuk sekolah jenjang SD, SMP, SMA di Indonesia.')">
    <meta name="keywords" content="koding sekolah, robotik sekolah, kurikulum merdeka informatika, microbit sekolah, LMS erlass academy, asesmen potensi siswa, pelatihan guru koding, kemitraan sekolah koding">
    <meta name="author" content="PT Erlass Prokreatif Indonesia">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#023047">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Erlass - Solusi Pembelajaran Teknologi & Asesmen Sekolah')">
    <meta property="og:description" content="Mempersiapkan Generasi Masa Depan Melalui Teknologi dan Inovasi. Solusi Coding, Robotik, LMS, dan Asesmen terpercaya untuk 400+ sekolah di Indonesia.">
    <meta property="og:image" content="{{ asset('img/og-preview.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Schema.org / JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "EducationalOrganization",
      "name": "PT Erlass Prokreatif Indonesia",
      "alternateName": "Erlass Institute",
      "url": "https://galeribelajar.com",
      "logo": "{{ asset('img/cp/11.png') }}",
      "description": "Penyedia solusi terintegrasi pembelajaran Coding, Robotika, Micro:bit, LMS, dan Asesmen Bakat Siswa.",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Pejaten Office Park Blok D, Jl. Warung Buncit Raya No. 79",
        "addressLocality": "Jakarta Selatan",
        "addressRegion": "DKI Jakarta",
        "addressCountry": "ID"
      },
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+6282311341381",
        "contactType": "customer service",
        "areaServed": "ID"
      }
    }
    </script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-slate-50 font-sans text-[#023047] antialiased overflow-x-hidden selection:bg-[#219ebc] selection:text-white">
    <a href="#main-content" class="sr-only focus:not-sr-only bg-[#219ebc] text-white px-4 py-2 absolute top-0 left-0 z-[110]">Lewati ke konten utama</a>

    <!-- Top Announcement Bar -->
    <div class="bg-[#023047] text-slate-300 text-xs py-2 px-4 border-b border-[#8ecae6]/20">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2 font-medium">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#fb8500] text-white uppercase tracking-wider">Update 2026</span>
                <span>Dipercaya oleh 400+ Sekolah & 1.100+ Kontrak Program Pendidikan di Seluruh Indonesia.</span>
            </div>
            <div class="flex items-center gap-4 text-slate-300">
                <a href="#contact" class="hover:text-[#ffb703] transition-colors">Konsultasi Kurikulum</a>
                <span class="text-slate-600">|</span>
                <a href="https://wa.me/6282311341381" target="_blank" class="hover:text-[#8ecae6] transition-colors flex items-center gap-1 font-semibold">
                    <span>Hotline: +62 823-1134-1381</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200/80" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Brand Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#219ebc] to-[#023047] flex items-center justify-center text-white font-black text-xl shadow-md group-hover:scale-105 transition-transform">
                            E
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-2xl tracking-tight text-[#023047] leading-none">ERLASS</span>
                            <span class="text-[10px] font-bold text-[#219ebc] tracking-wider uppercase">Education Solutions</span>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <nav class="hidden lg:flex space-x-1 items-center">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Beranda
                    </a>
                    <a href="#solutions" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Solusi Pendidikan
                    </a>
                    <a href="#why-erlass" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Mengapa Erlass
                    </a>
                    <a href="#partners" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Sekolah Mitra
                    </a>
                    <a href="#products" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Katalog Produk
                    </a>
                    <a href="#collaborate" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">
                        Kemitraan
                    </a>
                </nav>

                <!-- Actions: Language + CTA -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="#contact" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-sm shadow-md hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                        <span>Konsultasi Sekolah</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Menu" aria-expanded="false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-slate-200 px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Beranda</a>
            <a href="#solutions" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Solusi Pendidikan</a>
            <a href="#why-erlass" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Mengapa Erlass</a>
            <a href="#partners" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Sekolah Mitra</a>
            <a href="#products" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Katalog Produk</a>
            <a href="#collaborate" class="block px-3 py-2 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">Kemitraan</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="#contact" class="block w-full text-center px-4 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">Konsultasi Sekolah Sekarang</a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main id="main-content" class="min-h-screen"> 
        @yield('content')
    </main>

    <!-- Professional Corporate Footer -->
    <footer class="bg-[#023047] text-slate-300 relative z-20 border-t border-[#8ecae6]/20">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                <!-- Col 1: Identity & Address -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#219ebc] to-[#023047] flex items-center justify-center text-white font-black text-xl shadow-md">
                            E
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-white">ERLASS</span>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed max-w-sm">
                        PT Erlass Prokreatif Indonesia — Penyedia solusi teknologi pendidikan terintegrasi: Coding, Robotika, Micro:bit, LMS Kaizen, dan Asesmen Potensi Siswa untuk akselerasi masa depan pendidikan Indonesia.
                    </p>
                    <div class="text-xs text-slate-300 space-y-1 pt-2">
                        <p class="font-semibold text-white">Kantor Pusat:</p>
                        <p>Pejaten Office Park Blok D, Jl. Warung Buncit Raya No. 79, Jakarta Selatan</p>
                        <p class="font-semibold text-white pt-2">Kantor Operasional:</p>
                        <p>Jalan Boulevard Silk Town No. 12, Tangerang Selatan</p>
                    </div>
                </div>

                <!-- Col 2: Solusi Edukasi -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Solusi Pendidikan</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="#solutions" class="hover:text-[#8ecae6] transition-colors">Coding & Informatika</a></li>
                        <li><a href="#solutions" class="hover:text-[#8ecae6] transition-colors">Robotic & Micro:bit</a></li>
                        <li><a href="#solutions" class="hover:text-[#8ecae6] transition-colors">Erlass Academy LMS</a></li>
                        <li><a href="#solutions" class="hover:text-[#8ecae6] transition-colors">Student Assessment</a></li>
                        <li><a href="#products" class="hover:text-[#8ecae6] transition-colors">Modul LKPD Cetak & Digital</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kemitraan & Layanan -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Kemitraan</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="#partners" class="hover:text-[#8ecae6] transition-colors">Direktori Sekolah Mitra (400+)</a></li>
                        <li><a href="#collaborate" class="hover:text-[#8ecae6] transition-colors">Kerja Sama Yayasan</a></li>
                        <li><a href="#collaborate" class="hover:text-[#8ecae6] transition-colors">Program Dinas Pendidikan</a></li>
                        <li><a href="#why-erlass" class="hover:text-[#8ecae6] transition-colors">Pelatihan & Sertifikasi Guru</a></li>
                        <li><a href="#contact" class="hover:text-[#8ecae6] transition-colors">Permintaan Penawaran (RFP)</a></li>
                    </ul>
                </div>

                <!-- Col 4: Hubungi Kami -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
                    <div class="space-y-3 text-sm text-slate-300">
                        <p class="text-[#ffb703] font-bold text-lg">+62 823-1134-1381</p>
                        <p class="text-xs">Senin – Jumat: 08:30 – 17:00 WIB</p>
                        <p class="text-xs">Email: <a href="mailto:info@erlass.co.id" class="text-slate-200 hover:underline">info@erlass.co.id</a></p>
                        <div class="pt-2">
                            <a href="https://wa.me/6282311341381?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20konsultasi%20program%20sekolah" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-semibold text-xs transition-colors shadow">
                                <span>Chat WhatsApp Resmi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Compliance -->
            <div class="border-t border-[#8ecae6]/20 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-300 gap-4">
                <p>&copy; {{ date('Y') }} PT Erlass Prokreatif Indonesia. Seluruh hak cipta dilindungi undang-undang.</p>
                <div class="flex items-center gap-6">
                    <span class="text-slate-300">Kepatuhan UU PDP (Pelindungan Data Pribadi)</span>
                    <a href="#main-content" class="text-slate-300 hover:text-white">Kembali ke Atas ↑</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282311341381?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20berkonsultasi%20mengenai%20solusi%20pendidikan%20untuk%20sekolah%20kami" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-xl hover:scale-105 active:scale-95 transition-all duration-300" style="animation: wa-pulse 2s infinite;" aria-label="Konsultasi WhatsApp Erlass">
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

    <!-- Mobile menu toggle script -->
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
                this.setAttribute('aria-expanded', !menu.classList.contains('hidden'));
            }
        });
    </script>
</body>
</html>
