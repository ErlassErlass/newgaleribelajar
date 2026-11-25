<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Primary meta tags. Pages override with sections: title, description, keywords, og_type, og_image, canonical, robots --}}
    <title>@yield('title', __('Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah'))</title>
    <meta name="title" content="@yield('title', __('Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah'))">
    <meta name="description" content="@yield('description', __('Erlass Academy: pembelajaran Coding, Robotika, Micro:bit, Python, Web Development, dan LMS untuk sekolah SD, SMP, SMA. Kurikulum terstruktur, instruktur profesional, bersertifikat.'))">
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
    <meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'id_ID' }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('title', __('Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah'))">
    <meta property="og:description" content="@yield('description', __('Membangun generasi kreatif melalui teknologi. Program Coding, Robotika, Micro:bit, Python & LMS untuk 400+ sekolah di Indonesia.'))">
    <meta property="og:image" content="@yield('og_image', asset('img/og-preview.jpg'))">
    <meta property="og:image:alt" content="@yield('title', 'Erlass Academy')">

    <!-- Twitter / X card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('Erlass Academy - Coding, Robotika, Micro:bit & LMS untuk Sekolah'))">
    <meta name="twitter:description" content="@yield('description', __('Membangun generasi kreatif melalui teknologi bersama Erlass Academy.'))">
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
      "inLanguage": "{{ app()->getLocale() === 'en' ? 'en' : 'id-ID' }}",
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
    $n = fn (string $key) => __('navbar.'.$key);
    $navItems = [
        ['label' => $n('home'), 'href' => $homeUrl],
        ['label' => $n('products'), 'children' => [
            ['label' => $n('catalog'), 'desc' => $n('catalog_desc'), 'href' => route('products.index')],
            ['label' => $n('featured'), 'desc' => $n('featured_desc'), 'href' => $homeUrl.'#products'],
            ['label' => $n('shopee'), 'desc' => $n('shopee_desc'), 'href' => config('erlass.shopee')],
        ]],
        ['label' => $n('programs'), 'children' => [
            ['label' => $n('education'), 'desc' => $n('education_desc'), 'href' => $homeUrl.'#program'],
            ['label' => $n('solutions'), 'desc' => $n('solutions_desc'), 'href' => $homeUrl.'#solutions'],
            ['label' => $n('partnership'), 'desc' => $n('partnership_desc'), 'href' => $homeUrl.'#collaborate'],
        ]],
        ['label' => $n('about'), 'children' => [
            ['label' => $n('about_erlass'), 'desc' => $n('about_erlass_desc'), 'href' => $homeUrl.'#tentang'],
            ['label' => $n('why'), 'desc' => $n('why_desc'), 'href' => $homeUrl.'#why-erlass'],
            ['label' => $n('partners'), 'desc' => $n('partners_desc'), 'href' => $homeUrl.'#partners'],
        ]],
        ['label' => $n('articles'), 'children' => [
            ['label' => $n('all_articles'), 'desc' => $n('all_articles_desc'), 'href' => $articlesUrl],
            ['label' => $n('competition'), 'desc' => $n('competition_desc'), 'href' => route('articles.index', ['kategori' => 'kompetisi'])],
            ['label' => $n('gallery'), 'desc' => $n('gallery_desc'), 'href' => route('gallery')],
            ['label' => $n('program_info'), 'desc' => $n('program_info_desc'), 'href' => route('articles.index', ['kategori' => 'info-program'])],
        ]],
        ['label' => $n('contact'), 'href' => $homeUrl.'#contact'],
    ];

    $currentLocale = app()->getLocale();
    $languages = ['id' => $n('lang_id'), 'en' => $n('lang_en')];
    $searchTags = ['Scratch', 'Python', 'Micro:bit', 'Robotik'];
    $erlass = config('erlass');
    $waUrl = 'https://wa.me/'.$erlass['whatsapp'];
@endphp
<body class="bg-slate-50 font-sans text-[#023047] antialiased overflow-x-hidden selection:bg-[#219ebc] selection:text-white">
    <a href="#main-content" class="sr-only focus:not-sr-only bg-[#219ebc] text-white px-4 py-2 absolute top-0 left-0 z-[110]">{{ __('Lewati ke konten utama') }}</a>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200/80" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 sm:h-20 items-center gap-4">
                <!-- Brand Logo -->
                <a href="{{ $homeUrl }}" class="shrink-0 flex items-center" aria-label="{{ __('Erlass Prokreatif Indonesia - Beranda') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Erlass Prokreatif Indonesia" width="640" height="211" class="h-9 sm:h-11 w-auto">
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-0.5" aria-label="{{ __('Navigasi utama') }}">
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

                <div class="flex items-center gap-1.5 sm:gap-2">
                    <!-- Search toggle -->
                    <button type="button" id="search-toggle" class="p-2.5 rounded-xl text-slate-600 hover:text-[#219ebc] hover:bg-[#8ecae6]/20 transition-colors" aria-label="{{ $n('search_open') }}" aria-expanded="false" aria-controls="nav-search" title="{{ $n('search_hint') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 20l-3.5-3.5"/></svg>
                    </button>

                    <!-- LMS Erlass Academy badge → /lms (Intrakurikuler, Course, Asesmen), with a small consult button under it -->
                    <div class="flex flex-col items-stretch gap-1">
                    <a href="{{ route('lms.index') }}" @if(request()->routeIs('lms.index')) aria-current="page" @endif class="lms-badge relative shrink-0 inline-flex items-center gap-2 pl-1.5 pr-2 sm:pr-2.5 py-1.5 rounded-full text-white text-xs sm:text-sm font-extrabold whitespace-nowrap hover:-translate-y-0.5 transition-transform" title="{{ $n('lms_products_desc') }}">
                        <span class="grid place-items-center w-6 h-6 rounded-full bg-white/25" aria-hidden="true">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4L2 9l10 5 10-5-10-5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 11v4.5c0 1.4 2.7 3 6 3s6-1.6 6-3V11"/></svg>
                        </span>
                        <span class="hidden xl:inline">{{ $n('lms_badge') }}</span>
                        <span class="xl:hidden">LMS</span>
                        <span class="hidden sm:inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-[#ffb703] text-[#023047] text-[10px] uppercase tracking-wider">
                            <span class="relative flex w-1.5 h-1.5" aria-hidden="true"><span class="absolute inline-flex w-full h-full rounded-full bg-[#fb8500] opacity-75 motion-safe:animate-ping"></span><span class="relative inline-flex w-1.5 h-1.5 rounded-full bg-[#fb8500]"></span></span>
                            {{ $n('lms_new') }}
                        </span>
                        {{-- Phones: just a pulsing dot instead of the pill, to save width --}}
                        <span class="sm:hidden relative flex w-2 h-2" aria-hidden="true"><span class="absolute inline-flex w-full h-full rounded-full bg-[#ffb703] opacity-75 motion-safe:animate-ping"></span><span class="relative inline-flex w-2 h-2 rounded-full bg-[#ffb703]"></span></span>
                    </a>
                    {{-- Small consult CTA (from sm up; phones get the full button in the menu drawer) --}}
                    <a href="{{ $homeUrl }}#contact" class="hidden sm:flex items-center justify-center gap-1 px-2.5 py-0.5 rounded-full bg-gradient-to-r from-[#fb8500] to-[#ffb703] text-white text-[11px] font-bold leading-4 whitespace-nowrap shadow-sm hover:shadow-md hover:shadow-orange-500/25 hover:brightness-105 transition">
                        {{ $n('consult') }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    </div>

                    <!-- Language switcher (desktop) -->
                    <div class="relative group nav-dropdown hidden lg:block">
                        <button type="button" class="nav-dropdown-btn flex items-center gap-1 px-2.5 py-2 rounded-xl text-sm font-bold text-slate-700 border border-[#8ecae6]/70 group-hover:border-[#219ebc] group-hover:text-[#219ebc] group-focus-within:text-[#219ebc] transition-colors" aria-haspopup="true" aria-expanded="false" aria-label="{{ $n('language') }}: {{ $languages[$currentLocale] ?? $currentLocale }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-width="2" d="M3 12h18M12 3c2.5 2.8 3.6 5.8 3.6 9s-1.1 6.2-3.6 9c-2.5-2.8-3.6-5.8-3.6-9S9.5 5.8 12 3z"/></svg>
                            {{ strtoupper($currentLocale) }}
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180 group-focus-within:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute right-0 top-full pt-2 w-44 invisible opacity-0 translate-y-1 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition-all duration-150">
                            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-1.5">
                                @foreach($languages as $code => $name)
                                <a href="{{ route('lang.switch', $code) }}" hreflang="{{ $code }}" lang="{{ $code }}" @if($code === $currentLocale) aria-current="true" @endif class="flex items-center gap-3 px-3 py-2.5 rounded-xl outline-none hover:bg-[#8ecae6]/15 focus:bg-[#8ecae6]/15 {{ $code === $currentLocale ? 'text-[#219ebc]' : 'text-[#023047]' }}">
                                    <span class="w-8 text-center text-[11px] font-extrabold rounded-md py-0.5 {{ $code === $currentLocale ? 'bg-[#219ebc] text-white' : 'bg-[#8ecae6]/30 text-[#023047]' }}">{{ strtoupper($code) }}</span>
                                    <span class="text-sm font-semibold flex-1">{{ $name }}</span>
                                    @if($code === $currentLocale)<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>@endif
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors" aria-label="{{ $n('menu') }}" aria-expanded="false" aria-controls="mobile-menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Search panel -->
        <div id="nav-search" class="hidden border-t border-[#8ecae6]/40 bg-gradient-to-b from-[#8ecae6]/15 to-white">
            <form id="nav-search-form" action="{{ route('products.index') }}" method="GET" role="search" class="max-w-3xl mx-auto px-4 sm:px-6 py-5">
                <div class="flex items-center gap-2 rounded-2xl bg-white border-2 border-[#8ecae6] focus-within:border-[#219ebc] shadow-sm pl-4 pr-1.5 py-1.5 transition-colors">
                    <svg class="w-5 h-5 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M20 20l-3.5-3.5"/></svg>
                    <label for="nav-search-input" class="sr-only">{{ $n('search') }}</label>
                    <input id="nav-search-input" type="search" name="q" maxlength="100" required autocomplete="off" placeholder="{{ $n('search_placeholder') }}" class="flex-1 min-w-0 bg-transparent border-0 outline-none focus:ring-0 text-sm sm:text-base text-[#023047] placeholder:text-slate-400 py-2">
                    <button type="submit" class="shrink-0 px-4 sm:px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] text-white text-sm font-bold shadow-md hover:brightness-105 transition">{{ $n('search') }}</button>
                    <button type="button" id="search-close" class="shrink-0 p-2 rounded-lg text-slate-400 hover:text-[#023047] hover:bg-slate-100" aria-label="{{ $n('search_close') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-width="2" d="M6 6l12 12M18 6L6 18"/></svg>
                    </button>
                </div>
                <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs">
                    <fieldset class="flex items-center gap-1.5">
                        <legend class="sr-only">{{ $n('search_in') }}</legend>
                        <span class="font-semibold text-slate-500 mr-1" aria-hidden="true">{{ $n('search_in') }}:</span>
                        <label class="cursor-pointer"><input type="radio" name="search_scope" value="{{ route('products.index') }}" class="peer sr-only" checked><span class="inline-block px-3 py-1 rounded-full border border-[#8ecae6] text-[#023047] font-semibold peer-checked:bg-[#219ebc] peer-checked:border-[#219ebc] peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-[#219ebc]/40 transition-colors">{{ $n('search_products') }}</span></label>
                        <label class="cursor-pointer"><input type="radio" name="search_scope" value="{{ $articlesUrl }}" class="peer sr-only"><span class="inline-block px-3 py-1 rounded-full border border-[#8ecae6] text-[#023047] font-semibold peer-checked:bg-[#219ebc] peer-checked:border-[#219ebc] peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-[#219ebc]/40 transition-colors">{{ $n('search_articles') }}</span></label>
                    </fieldset>
                    <div class="flex flex-wrap items-center gap-1.5">
                        <span class="font-semibold text-slate-500 mr-1">{{ $n('search_popular') }}:</span>
                        @foreach($searchTags as $tag)
                        <a href="{{ route('products.index', ['q' => $tag]) }}" class="px-2.5 py-1 rounded-full bg-[#ffb703]/20 text-[#023047] font-semibold hover:bg-[#ffb703]/40 transition-colors">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-slate-200 px-4 pt-3 pb-6 space-y-1 max-h-[calc(100dvh-4rem)] overflow-y-auto">
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
            <div class="pt-3 border-t border-slate-100 space-y-3">
                <div class="flex items-center gap-2 px-3" role="group" aria-label="{{ $n('language') }}">
                    <span class="text-xs font-semibold text-slate-500 mr-auto">{{ $n('language') }}</span>
                    @foreach($languages as $code => $name)
                    <a href="{{ route('lang.switch', $code) }}" hreflang="{{ $code }}" lang="{{ $code }}" @if($code === $currentLocale) aria-current="true" @endif class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border transition-colors {{ $code === $currentLocale ? 'bg-[#219ebc] border-[#219ebc] text-white' : 'border-[#8ecae6] text-[#023047] hover:bg-[#8ecae6]/20' }}">
                        {{ strtoupper($code) }} <span class="font-semibold">{{ $name }}</span>
                    </a>
                    @endforeach
                </div>
                <a href="{{ $homeUrl }}#contact" class="mobile-nav-link block w-full text-center px-4 py-3 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] text-white font-bold text-sm shadow-md hover:brightness-105 transition">{{ $n('consult') }}</a>
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
                    <h2 id="newsletter-title" class="text-xl sm:text-2xl font-extrabold tracking-tight">{{ __('Berlangganan Buletin Informasi') }}</h2>
                    <p class="text-sm sm:text-base text-white/85 mt-1">{{ __('Dapatkan info terbaru program, kompetisi, artikel & promo Erlass Academy.') }}</p>
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
                            <label for="newsletter-email" class="sr-only">{{ __('Alamat email') }}</label>
                            <input id="newsletter-email" type="email" name="email" required autocomplete="email" value="{{ old('email') && $errors->newsletter->any() ? old('email') : '' }}"
                                   placeholder="{{ __('Masukkan alamat email Anda...') }}"
                                   class="w-full h-14 sm:h-16 rounded-full bg-white pl-6 pr-16 sm:pr-20 text-sm sm:text-base text-slate-800 placeholder:text-slate-400 shadow-inner outline-none ring-4 ring-white/20 focus:ring-[#ffb703]/60 transition">
                            <button type="submit" aria-label="{{ __('Berlangganan') }}" class="absolute right-1.5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-[#fb8500] hover:bg-[#e07600] text-white flex items-center justify-center shadow-lg transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 -rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                            </button>
                        </form>
                        @if($errors->newsletter->any())
                            <p class="mt-2 pl-4 text-sm font-semibold text-[#ffb703]" role="alert">{{ $errors->newsletter->first() }}</p>
                        @else
                            <p class="mt-2 pl-4 text-xs text-white/75">{{ __('Bisa berhenti kapan saja. Lihat') }} <a href="{{ route('privacy') }}" class="underline hover:text-white">{{ __('Kebijakan Privasi') }}</a>.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Corporate Footer -->
    <footer class="bg-gradient-to-br from-[#219ebc] via-[#0b8fc6] to-[#0369a1] text-white/90 relative z-20">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-12 gap-x-6 gap-y-10 lg:gap-10">
                <!-- Col 1: Profil Perusahaan + Sosial Media -->
                <div class="col-span-2 lg:col-span-4 space-y-5">
                    <a href="{{ $homeUrl }}" class="inline-block" aria-label="{{ __('Erlass Prokreatif Indonesia - Beranda') }}">
                        <img src="{{ asset('img/logo-white.png') }}" alt="Erlass Prokreatif Indonesia" width="640" height="211" class="h-12 w-auto" loading="lazy">
                    </a>
                    <p class="text-white/90 text-sm leading-relaxed max-w-sm">
                        {{ __(':company — penyedia solusi teknologi pendidikan terintegrasi: Coding, Robotika, Micro:bit, Python, Web Development, dan LMS Erlass Academy untuk sekolah jenjang SD, SMP, hingga SMA di Indonesia.', ['company' => $erlass['company']]) }}
                    </p>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Ikuti Kami') }}</p>
                        <div class="flex flex-wrap items-center gap-3">
                            @foreach(['instagram' => 'Instagram', 'tiktok' => 'TikTok', 'youtube' => 'YouTube', 'facebook' => 'Facebook', 'facebook_group' => __('Grup Facebook')] as $key => $label)
                            @if(!empty($erlass['social'][$key]))
                            <a href="{{ $erlass['social'][$key] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __($label) }} Erlass" title="{{ __($label) }}" class="w-10 h-10 rounded-xl bg-white/15 ring-1 ring-white/25 hover:bg-white hover:text-[#0284c7] text-white flex items-center justify-center transition-colors">
                                @include('partials.brand-icon', ['name' => $key, 'class' => 'w-5 h-5'])
                            </a>
                            @endif
                            @endforeach
                            <a href="{{ $erlass['shopee'] }}" target="_blank" rel="noopener" aria-label="{{ __('Toko Shopee Erlass') }}" title="Shopee" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#ee4d2d] text-white flex items-center justify-center transition-colors">
                                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Informasi Produk -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">{{ __('Produk') }}</h4>
                    <ul class="space-y-2.5 text-sm text-white/90">
                        <li><a href="{{ route('products.index') }}" class="hover:text-[#ffe08a] transition-colors font-semibold">{{ __('Katalog Produk') }}</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'coding-informatika']) }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Coding & Informatika') }}</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'robotika-edukasi']) }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Robotika Edukasi') }}</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'microbit-iot']) }}" class="hover:text-[#ffe08a] transition-colors">Micro:bit & IoT</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'modul-cetak']) }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Modul & LKPD') }}</a></li>
                        <li><a href="{{ route('products.index', ['kategori' => 'erlass-academy-lms']) }}" class="hover:text-[#ffe08a] transition-colors">{{ __('LMS Erlass Academy') }}</a></li>
                        <li><a href="{{ $erlass['shopee'] }}" target="_blank" rel="noopener" class="hover:text-[#ffe08a] transition-colors">{{ __('Shopee Erlass ↗') }}</a></li>
                    </ul>
                </div>

                <!-- Col 3: Program & Perusahaan -->
                <div class="lg:col-span-2">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">{{ __('Perusahaan') }}</h4>
                    <ul class="space-y-2.5 text-sm text-white/90">
                        <li><a href="{{ $homeUrl }}#tentang" class="hover:text-[#ffe08a] transition-colors">{{ __('Tentang Kami') }}</a></li>
                        <li><a href="{{ $homeUrl }}#why-erlass" class="hover:text-[#ffe08a] transition-colors">{{ __('Mengapa Erlass') }}</a></li>
                        <li><a href="{{ $homeUrl }}#program" class="hover:text-[#ffe08a] transition-colors">{{ __('Program Pendidikan') }}</a></li>
                        <li><a href="{{ $homeUrl }}#solutions" class="hover:text-[#ffe08a] transition-colors">{{ __('Solusi Sekolah') }}</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Artikel & Kegiatan') }}</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Kebijakan Privasi') }}</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-[#ffe08a] transition-colors">{{ __('Syarat & Ketentuan') }}</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak & Alamat -->
                <div class="col-span-2 lg:col-span-4">
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">{{ __('Hubungi Kami') }}</h4>
                    <div class="space-y-3 text-sm text-white/90">
                        <p class="text-[#ffb703] font-bold text-lg">{{ $erlass['phone_display'] }}</p>
                        <p class="text-xs leading-relaxed">{!! nl2br(e(__($erlass['office_hours']))) !!}</p>
                        <p class="text-xs">Email: <a href="mailto:{{ $erlass['email'] }}" class="text-slate-200 hover:underline">{{ $erlass['email'] }}</a></p>
                        <a href="{{ $waUrl }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20konsultasi%20program%20sekolah" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-semibold text-xs transition-colors shadow">
                            <span>{{ __('Chat WhatsApp Resmi') }}</span>
                        </a>
                        <div class="text-xs space-y-1 pt-3">
                            <p class="font-semibold text-white">{{ __('Kantor Pusat') }}</p>
                            <p>{{ $erlass['address_hq'] }}</p>
                            <p class="font-semibold text-white pt-2">{{ __('Kantor Operasional') }}</p>
                            <p>{{ $erlass['address_ops'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="border-t border-[#8ecae6]/20 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-white/90 gap-4 text-center md:text-left">
                <p>&copy; {{ date('Y') }} {{ $erlass['company'] }}. Seluruh hak cipta dilindungi undang-undang.</p>
                <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2">
                    <a href="{{ route('privacy') }}" class="hover:text-white">{{ __('Kebijakan Privasi') }}</a>
                    <a href="{{ route('terms') }}" class="hover:text-white">{{ __('Syarat & Ketentuan') }}</a>
                    <a href="#main-content" class="hover:text-white">{{ __('Kembali ke Atas ↑') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="{{ $waUrl }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20berkonsultasi%20mengenai%20solusi%20pendidikan%20untuk%20sekolah%20kami" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-xl hover:scale-105 active:scale-95 transition-all duration-300" style="animation: wa-pulse 2s infinite;" aria-label="{{ __('Konsultasi WhatsApp Erlass') }}">
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

    <!-- Scroll-to-top button (appears after scrolling) -->
    <button type="button" id="scroll-top-btn" aria-label="{{ __('Gulir ke atas') }}" title="{{ __('Gulir ke atas') }}"
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
                const open = !menu.classList.contains('hidden');
                btn.setAttribute('aria-expanded', String(open));
                // Only one header panel at a time
                const search = document.getElementById('nav-search');
                if (open && search && !search.classList.contains('hidden')) document.getElementById('search-toggle').click();
            });
            // Close the drawer after choosing a section link
            menu.querySelectorAll('.mobile-nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();

        // Header search: toggle button, "/" shortcut, Escape to close, scope chips pick catalog vs articles
        (function () {
            const panel = document.getElementById('nav-search');
            const toggle = document.getElementById('search-toggle');
            const form = document.getElementById('nav-search-form');
            if (!panel || !toggle || !form) return;
            const input = document.getElementById('nav-search-input');
            const setOpen = function (open) {
                panel.classList.toggle('hidden', !open);
                toggle.setAttribute('aria-expanded', String(open));
                if (open) {
                    const menu = document.getElementById('mobile-menu');
                    if (menu && !menu.classList.contains('hidden')) document.getElementById('mobile-menu-btn').click();
                    input.focus();
                }
            };
            toggle.addEventListener('click', function () { setOpen(panel.classList.contains('hidden')); });
            document.getElementById('search-close').addEventListener('click', function () { setOpen(false); toggle.focus(); });
            panel.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { setOpen(false); toggle.focus(); }
            });
            document.addEventListener('keydown', function (e) {
                const t = e.target;
                const typing = t.isContentEditable || /^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName);
                if (e.key === '/' && !typing && !e.ctrlKey && !e.metaKey && !e.altKey) { e.preventDefault(); setOpen(true); }
            });
            form.addEventListener('submit', function () {
                const scope = form.querySelector('input[name="search_scope"]:checked');
                if (scope) form.action = scope.value;
                // Keep the scope out of the result URL (disabled inputs are not submitted)
                form.querySelectorAll('input[name="search_scope"]').forEach(function (r) { r.disabled = true; });
                setTimeout(function () { form.querySelectorAll('input[name="search_scope"]').forEach(function (r) { r.disabled = false; }); }, 0);
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
