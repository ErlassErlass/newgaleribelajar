<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Primary meta tags. Pages override with sections: title, description, keywords, og_type, og_image, canonical, robots --}}
    <title>@yield('title', 'Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah')</title>
    <meta name="title" content="@yield('title', 'Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah')">
    <meta name="description" content="@yield('description', 'Erlass Academy: pembelajaran Coding, Robotika, Micro:bit, Python, Web Development, dan LMS untuk sekolah SD, SMP, SMA. Kurikulum terstruktur, instruktur profesional, bersertifikat.')">
    <meta name="keywords" content="@yield('keywords', 'erlass, erlass academy, kursus coding anak, ekskul robotika sekolah, belajar coding SD, microbit sekolah, python untuk pelajar, web development pelajar, LMS sekolah, kurikulum merdeka informatika, pelatihan guru coding, lomba robotika pelajar')">
    <meta name="author" content="PT Erlass Prokreatif Indonesia">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1')">
    <meta name="theme-color" content="#023047">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo-icon-32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-icon-180.png') }}">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">
    <link rel="alternate" type="text/plain" title="llms.txt" href="{{ route('llms') }}">

    <!-- Open Graph (Facebook, WhatsApp, LinkedIn, Telegram previews) -->
    <meta property="og:site_name" content="Erlass Academy">
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('title', 'Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah')">
    <meta property="og:description" content="@yield('description', 'Membangun generasi kreatif melalui teknologi. Program Coding, Robotika, Micro:bit, Python & LMS untuk 400+ sekolah di Indonesia.')">
    <meta property="og:image" content="@yield('og_image', asset('img/og-preview.jpg'))">
    <meta property="og:image:alt" content="@yield('title', 'Erlass Academy')">

    <!-- Twitter / X card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah')">
    <meta name="twitter:description" content="@yield('description', 'Membangun generasi kreatif melalui teknologi bersama Erlass Academy.')">
    <meta name="twitter:image" content="@yield('og_image', asset('img/og-preview.jpg'))">

    {{-- Page-specific meta & JSON-LD (article tags, breadcrumbs, etc.) --}}
    @stack('head')

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
      "url": "https://erlass.co.id",
      "logo": "{{ asset('img/logo.png') }}",
      "sameAs": [
        "https://www.instagram.com/komunitaserlass/",
        "https://www.tiktok.com/@@erlasspro.id",
        "https://www.youtube.com/@@erlassprokreatifindonesia",
        "https://www.facebook.com/people/komunitaserlass/100085820361415/",
        "https://www.facebook.com/groups/258454375448341/",
        "{{ config('erlass.shopee') }}"
      ],
      "brand": { "@@type": "Brand", "name": "Erlass Academy" },
      "knowsAbout": ["Coding untuk anak", "Robotika pendidikan", "Micro:bit", "Python", "Web Development", "Learning Management System", "Kurikulum Merdeka Informatika"],
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
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "WebSite",
      "name": "Erlass Academy",
      "url": "{{ route('home') }}",
      "inLanguage": "id-ID",
      "potentialAction": {
        "@@type": "SearchAction",
        "target": "{{ route('articles.index') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
@php
    $homeUrl = route('home');
    $articlesUrl = route('articles.index');
    // Top-level menu; items with 'children' render as dropdowns (desktop) / accordions (mobile)
    $navItems = [
        ['label' => 'Beranda', 'href' => $homeUrl],
        ['label' => 'Produk', 'children' => [
            ['label' => 'Katalog Produk', 'desc' => 'Semua modul, kit & program lengkap dengan foto', 'href' => route('products.index')],
            ['label' => 'Produk LMS Erlass Academy', 'desc' => 'Intrakurikuler, course, asesmen & sumber guru gratis', 'href' => $homeUrl.'#produk'],
            ['label' => 'Katalog Unggulan', 'desc' => 'Program & perangkat paling diminati sekolah', 'href' => $homeUrl.'#products'],
            ['label' => 'Toko Shopee Erlass', 'desc' => 'Beli modul & learning kit satuan', 'href' => config('erlass.shopee')],
        ]],
        ['label' => 'Program', 'children' => [
            ['label' => 'Program Pendidikan', 'desc' => 'Sekolah, guru, siswa, ekskul & intrakurikuler', 'href' => $homeUrl.'#program'],
            ['label' => 'Solusi Sekolah', 'desc' => 'Solusi pembelajaran terintegrasi', 'href' => $homeUrl.'#solutions'],
            ['label' => 'Kemitraan', 'desc' => 'Sekolah, yayasan, dinas & mitra bisnis', 'href' => $homeUrl.'#collaborate'],
        ]],
        ['label' => 'Tentang Kami', 'children' => [
            ['label' => 'Tentang Erlass', 'desc' => 'Profil & keunggulan Erlass Academy', 'href' => $homeUrl.'#tentang'],
            ['label' => 'Mengapa Erlass', 'desc' => '5 pilar solusi pendidikan', 'href' => $homeUrl.'#why-erlass'],
            ['label' => 'Sekolah Mitra', 'desc' => '400+ sekolah di seluruh Indonesia', 'href' => $homeUrl.'#partners'],
        ]],
        ['label' => 'Artikel', 'children' => [
            ['label' => 'Semua Artikel', 'desc' => 'Berita & informasi terbaru', 'href' => $articlesUrl],
            ['label' => 'Kompetisi', 'desc' => 'Erlass Coding & Robotic Competition', 'href' => route('articles.index', ['kategori' => 'kompetisi'])],
            ['label' => 'Dokumentasi Kegiatan', 'desc' => 'Galeri foto & video kegiatan', 'href' => route('gallery')],
            ['label' => 'Info Program', 'desc' => 'Pendaftaran & jadwal program', 'href' => route('articles.index', ['kategori' => 'info-program'])],
        ]],
        ['label' => 'Kontak', 'href' => $homeUrl.'#contact'],
    ];
    $erlass = config('erlass');
    $waUrl = 'https://wa.me/'.$erlass['whatsapp'];
@endphp
<body class="bg-slate-50 font-sans text-[#023047] antialiased overflow-x-hidden selection:bg-[#219ebc] selection:text-white">
    <a href="#main-content" class="sr-only focus:not-sr-only bg-[#219ebc] text-white px-4 py-2 absolute top-0 left-0 z-[110]">Lewati ke konten utama</a>

    <!-- Top Announcement Bar -->
    <div class="bg-[#023047] text-slate-300 text-xs py-2 px-4 border-b border-[#8ecae6]/20">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-2 text-center lg:text-left">
            <div class="flex items-center gap-2 font-medium">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#fb8500] text-white uppercase tracking-wider shrink-0">Update 2026</span>
                <span>Dipercaya oleh 400+ Sekolah & 1.100+ Kontrak Program Pendidikan.</span>
            </div>
            <div class="hidden lg:flex items-center gap-4 text-slate-300 whitespace-nowrap">
                <a href="{{ $homeUrl }}#contact" class="hover:text-[#ffb703] transition-colors">Konsultasi Kurikulum</a>
                <span class="text-slate-600">|</span>
                <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#8ecae6] transition-colors font-semibold">Hotline: {{ $erlass['phone_display'] }}</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200/80" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 sm:h-20 items-center gap-4">
                <!-- Brand Logo -->
                <a href="{{ $homeUrl }}" class="shrink-0 flex items-center" aria-label="Erlass Prokreatif Indonesia - Beranda">
                    <img src="{{ asset('img/logo.png') }}" alt="Erlass Prokreatif Indonesia" width="640" height="211" class="h-9 sm:h-11 w-auto">
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-0.5" aria-label="Navigasi utama">
                    @foreach($navItems as $item)
                        @if(!empty($item['children']))
                        <div class="relative group nav-dropdown">
                            <button type="button" class="nav-dropdown-btn flex items-center gap-1 px-3 py-2 text-sm font-semibold text-slate-700 group-hover:text-[#219ebc] group-focus-within:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors" aria-haspopup="true" aria-expanded="false">
                                {{ $item['label'] }}
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-180 group-focus-within:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute left-0 top-full pt-2 w-72 invisible opacity-0 translate-y-1 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition-all duration-150">
                                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-2">
                                    @foreach($item['children'] as $child)
                                    <a href="{{ $child['href'] }}" class="block px-4 py-3 rounded-xl hover:bg-slate-50 focus:bg-slate-50 outline-none group/item">
                                        <span class="block text-sm font-bold text-[#023047] group-hover/item:text-[#219ebc]">{{ $child['label'] }}</span>
                                        <span class="block text-xs text-slate-500 mt-0.5">{{ $child['desc'] }}</span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <a href="{{ $item['href'] }}" class="px-3 py-2 text-sm font-semibold text-slate-700 hover:text-[#219ebc] hover:bg-slate-50 rounded-lg transition-colors">{{ $item['label'] }}</a>
                        @endif
                    @endforeach
                </nav>

                <div class="flex items-center gap-2">
                    <!-- CTA -->
                    <a href="{{ $homeUrl }}#contact" class="hidden sm:flex px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-sm shadow-md hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 items-center gap-2 whitespace-nowrap">
                        <span>Konsultasi Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Menu" aria-expanded="false" aria-controls="mobile-menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-slate-200 px-4 pt-3 pb-6 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
            @foreach($navItems as $item)
                @if(!empty($item['children']))
                <details class="group/acc rounded-lg">
                    <summary class="flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        {{ $item['label'] }}
                        <svg class="w-5 h-5 text-slate-400 transition-transform group-open/acc:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <div class="ml-3 pl-3 border-l-2 border-[#8ecae6]/50 mt-1 mb-2 space-y-0.5">
                        @foreach($item['children'] as $child)
                        <a href="{{ $child['href'] }}" class="mobile-nav-link block px-3 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-[#219ebc]">{{ $child['label'] }}</a>
                        @endforeach
                    </div>
                </details>
                @else
                <a href="{{ $item['href'] }}" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-semibold text-slate-700 hover:bg-slate-100">{{ $item['label'] }}</a>
                @endif
            @endforeach
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ $homeUrl }}#contact" class="mobile-nav-link block w-full text-center px-4 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">Konsultasi Sekarang</a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main id="main-content" class="min-h-screen"> 
        @yield('content')
    </main>

    <!-- Newsletter band: top half on page background, bottom half on the footer -->
    <section id="newsletter" class="relative z-30 px-4 sm:px-6 lg:px-8 pt-12 bg-[linear-gradient(to_bottom,transparent_50%,#023047_50%)]" aria-labelledby="newsletter-title">
        <div class="relative max-w-7xl mx-auto overflow-hidden rounded-3xl bg-gradient-to-r from-[#219ebc] via-[#1b8fb0] to-[#0284c7] shadow-2xl shadow-[#023047]/30 ring-1 ring-white/20">
            <svg class="absolute -right-10 -top-16 w-64 h-64 text-white/10 pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l10 10-10 10L2 12z"/><path d="M12 7l5 5-5 5-5-5z"/></svg>
            <div class="relative grid grid-cols-1 lg:grid-cols-[auto_1fr_minmax(0,28rem)] items-center gap-5 sm:gap-6 p-6 sm:p-8 lg:px-10">
                <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-white/15 items-center justify-center shrink-0">
                    <svg class="w-8 h-8 text-[#ffb703]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                </div>
                <div class="text-white">
                    <h2 id="newsletter-title" class="text-xl sm:text-2xl font-extrabold tracking-tight">Berlangganan Buletin Informasi</h2>
                    <p class="text-sm sm:text-base text-white/85 mt-1">Dapatkan info terbaru program, kompetisi, artikel & promo Erlass Academy.</p>
                </div>
                <div>
                    @if(session('newsletter_success'))
                        <div class="flex items-center gap-3 rounded-2xl bg-white px-5 py-4 text-sm font-semibold text-emerald-700" role="status">
                            <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ session('newsletter_success') }}
                        </div>
                    @else
                        <form action="{{ route('subscribe.store') }}" method="POST" class="relative" novalidate>
                            @csrf
                            <input type="hidden" name="source" value="{{ request()->path() === '/' ? 'home' : request()->path() }}">
                            <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                            <label for="newsletter-email" class="sr-only">Alamat email</label>
                            <input id="newsletter-email" type="email" name="email" required autocomplete="email" value="{{ old('email') && $errors->newsletter->any() ? old('email') : '' }}"
                                   placeholder="Masukkan alamat email Anda..."
                                   class="w-full h-14 sm:h-16 rounded-full bg-white pl-6 pr-16 sm:pr-20 text-sm sm:text-base text-slate-800 placeholder:text-slate-400 shadow-inner outline-none ring-4 ring-white/20 focus:ring-[#ffb703]/60 transition">
                            <button type="submit" aria-label="Berlangganan" class="absolute right-1.5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-[#fb8500] hover:bg-[#e07600] text-white flex items-center justify-center shadow-lg transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 -rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                            </button>
                        </form>
                        @if($errors->newsletter->any())
                            <p class="mt-2 pl-4 text-sm font-semibold text-[#ffb703]" role="alert">{{ $errors->newsletter->first() }}</p>
                        @else
                            <p class="mt-2 pl-4 text-xs text-white/75">Bisa berhenti kapan saja. Lihat <a href="{{ route('privacy') }}" class="underline hover:text-white">Kebijakan Privasi</a>.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Corporate Footer -->
    <footer class="bg-[#023047] text-slate-300 relative z-20">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-12 gap-x-6 gap-y-10 lg:gap-10">
                <!-- Col 1: Profil Perusahaan + Sosial Media -->
                <div class="col-span-2 lg:col-span-4 space-y-5">
                    <a href="{{ $homeUrl }}" class="inline-block" aria-label="Erlass Prokreatif Indonesia - Beranda">
                        <img src="{{ asset('img/logo-white.png') }}" alt="Erlass Prokreatif Indonesia" width="640" height="211" class="h-12 w-auto" loading="lazy">
                    </a>
                    <p class="text-slate-300 text-sm leading-relaxed max-w-sm">
                        {{ $erlass['company'] }} — penyedia solusi teknologi pendidikan terintegrasi: Coding, Robotika, Micro:bit, Python, Web Development, dan LMS Erlass Academy untuk sekolah jenjang SD, SMP, hingga SMA di Indonesia.
                    </p>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">Ikuti Kami</p>
                        <div class="flex flex-wrap items-center gap-3">
                            @foreach(['instagram' => 'Instagram', 'tiktok' => 'TikTok', 'youtube' => 'YouTube', 'facebook' => 'Facebook', 'facebook_group' => 'Grup Facebook'] as $key => $label)
                            @if(!empty($erlass['social'][$key]))
                            <a href="{{ $erlass['social'][$key] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }} Erlass" title="{{ $label }}" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#219ebc] text-white flex items-center justify-center transition-colors">
                                @include('partials.brand-icon', ['name' => $key, 'class' => 'w-5 h-5'])
                            </a>
                            @endif
                            @endforeach
                            <a href="{{ $erlass['shopee'] }}" target="_blank" rel="noopener" aria-label="Toko Shopee Erlass" title="Shopee" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#ee4d2d] text-white flex items-center justify-center transition-colors">
                                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Informasi Produk -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Produk</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="{{ route('products.index') }}" class="hover:text-[#8ecae6] transition-colors font-semibold">Katalog Produk</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'coding-informatika']) }}" class="hover:text-[#8ecae6] transition-colors">Coding & Informatika</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'robotika-edukasi']) }}" class="hover:text-[#8ecae6] transition-colors">Robotika Edukasi</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'microbit-iot']) }}" class="hover:text-[#8ecae6] transition-colors">Micro:bit & IoT</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'modul-cetak']) }}" class="hover:text-[#8ecae6] transition-colors">Modul & LKPD</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'erlass-academy-lms']) }}" class="hover:text-[#8ecae6] transition-colors">LMS Erlass Academy</a></li>
                        <li><a href="{{ $erlass['shopee'] }}" target="_blank" rel="noopener" class="hover:text-[#8ecae6] transition-colors">Shopee Erlass ↗</a></li>
                    </ul>
                </div>

                <!-- Col 3: Program & Perusahaan -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Perusahaan</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="{{ $homeUrl }}#tentang" class="hover:text-[#8ecae6] transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ $homeUrl }}#why-erlass" class="hover:text-[#8ecae6] transition-colors">Mengapa Erlass</a></li>
                        <li><a href="{{ $homeUrl }}#program" class="hover:text-[#8ecae6] transition-colors">Program Pendidikan</a></li>
                        <li><a href="{{ $homeUrl }}#solutions" class="hover:text-[#8ecae6] transition-colors">Solusi Sekolah</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-[#8ecae6] transition-colors">Artikel & Kegiatan</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-[#8ecae6] transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-[#8ecae6] transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak & Alamat -->
                <div class="col-span-2 lg:col-span-4">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
                    <div class="space-y-3 text-sm text-slate-300">
                        <p class="text-[#ffb703] font-bold text-lg">{{ $erlass['phone_display'] }}</p>
                        <p class="text-xs leading-relaxed">{!! nl2br(e($erlass['office_hours'])) !!}</p>
                        <p class="text-xs">Email: <a href="mailto:{{ $erlass['email'] }}" class="text-slate-200 hover:underline">{{ $erlass['email'] }}</a></p>
                        <a href="{{ $waUrl }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20konsultasi%20program%20sekolah" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-semibold text-xs transition-colors shadow">
                            <span>Chat WhatsApp Resmi</span>
                        </a>
                        <div class="text-xs space-y-1 pt-3">
                            <p class="font-semibold text-white">Kantor Pusat</p>
                            <p>{{ $erlass['address_hq'] }}</p>
                            <p class="font-semibold text-white pt-2">Kantor Operasional</p>
                            <p>{{ $erlass['address_ops'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="border-t border-[#8ecae6]/20 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-300 gap-4 text-center md:text-left">
                <p>&copy; {{ date('Y') }} {{ $erlass['company'] }}. Seluruh hak cipta dilindungi undang-undang.</p>
                <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2">
                    <a href="{{ route('privacy') }}" class="hover:text-white">Kebijakan Privasi</a>
                    <a href="{{ route('terms') }}" class="hover:text-white">Syarat & Ketentuan</a>
                    <a href="#main-content" class="hover:text-white">Kembali ke Atas ↑</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="{{ $waUrl }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20berkonsultasi%20mengenai%20solusi%20pendidikan%20untuk%20sekolah%20kami" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-xl hover:scale-105 active:scale-95 transition-all duration-300" style="animation: wa-pulse 2s infinite;" aria-label="Konsultasi WhatsApp Erlass">
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

    <!-- Scroll-to-top button (appears after scrolling) -->
    <button type="button" id="scroll-top-btn" aria-label="Gulir ke atas" title="Gulir ke atas"
            class="fixed bottom-24 right-7 z-50 w-12 h-12 rounded-full bg-white text-[#023047] border border-slate-200 shadow-lg flex items-center justify-center hover:bg-[#023047] hover:text-white transition-all duration-300 opacity-0 translate-y-4 pointer-events-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>

    <!-- Mobile menu toggle script -->
    <script>
        // Newsletter: after a failed submit the page reloads at the top, so scroll to the error
        (function () {
            const nl = document.getElementById('newsletter');
            if (nl && nl.querySelector('[role="alert"]')) nl.scrollIntoView({ block: 'center' });
        })();

        (function () {
            const btn = document.getElementById('scroll-top-btn');
            if (!btn) return;
            const toggle = function () {
                const show = window.scrollY > 600;
                btn.classList.toggle('opacity-0', !show);
                btn.classList.toggle('translate-y-4', !show);
                btn.classList.toggle('pointer-events-none', !show);
            };
            window.addEventListener('scroll', toggle, { passive: true });
            toggle();
            btn.addEventListener('click', function () {
                const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
            });
        })();
        (function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (!btn || !menu) return;
            btn.addEventListener('click', function () {
                menu.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', String(!menu.classList.contains('hidden')));
            });
            // Close the drawer after choosing a section link
            menu.querySelectorAll('.mobile-nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();

        // Desktop dropdowns open via CSS hover/focus-within; keep aria-expanded in sync and close on Escape
        document.querySelectorAll('.nav-dropdown').forEach(function (dd) {
            const trigger = dd.querySelector('.nav-dropdown-btn');
            const set = function (open) { trigger.setAttribute('aria-expanded', String(open)); };
            dd.addEventListener('mouseenter', function () { set(true); });
            dd.addEventListener('mouseleave', function () { set(dd.contains(document.activeElement)); });
            dd.addEventListener('focusin', function () { set(true); });
            dd.addEventListener('focusout', function (e) { if (!dd.contains(e.relatedTarget)) set(false); });
            dd.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { document.activeElement.blur(); set(false); }
            });
        });
    </script>
</body>
</html>
