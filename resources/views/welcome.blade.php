@extends('layouts.app')

@section('title', __('Erlass - Solusi Pembelajaran Coding, Robotik, LMS & Asesmen Sekolah'))

@section('content')
@php $hp = config('homepage'); @endphp

<!-- ============================================
     HERO — full-width banner slider (bright themes, swipe/arrows/dots, autoplay with progress bar)
     Slide 1 = the main title from Pengaturan Beranda; the next slides = "Slide berikutnya" in the same page.
     ============================================ -->
@php
    $extraSlides = collect($hp['hero']['slides'] ?? [])->filter(fn ($x) => filled($x['image'] ?? null))->values();
    $bannerSlides = collect([[
        'main' => true,
        'img' => $hp['hero']['image'] ?? null ?: ($extraSlides->first()['image'] ?? 'img/gallery/teamwork.webp'),
        'pill' => $hp['hero']['badge'] ?? '',
    ]])->merge($extraSlides->map(fn ($x) => [
        'main' => false,
        'img' => $x['image'],
        'pill' => $x['tag'] ?? '',
        'title' => filled($x['title'] ?? null) ? $x['title'] : ($x['tag'] ?? ''),
        'caption' => $x['caption'] ?? '',
    ]))->values();

    // Bright themes, cycled per slide: [section background, heading, body text, pill, highlight, decor circle]
    $heroThemes = [
        ['bg' => 'bg-gradient-to-br from-[#8ecae6]/45 via-white to-[#ffb703]/25', 'h' => 'text-[#023047]', 'p' => 'text-slate-600', 'pill' => 'bg-white text-[#0369a1] ring-1 ring-[#8ecae6]', 'hl' => 'text-[#0369a1] hero-mark px-1', 'dot' => 'bg-[#ffb703]', 'circle' => 'bg-[#8ecae6]/40'],
        ['bg' => 'bg-gradient-to-br from-[#0e7490] via-[#0b6e99] to-[#0369a1]', 'h' => 'text-white', 'p' => 'text-white', 'pill' => 'bg-white text-[#0369a1]', 'hl' => 'text-white', 'dot' => 'bg-[#ffb703]', 'circle' => 'bg-white/15'],
        ['bg' => 'bg-gradient-to-br from-[#fff4dc] via-[#ffe6b8] to-[#ffd27a]', 'h' => 'text-[#023047]', 'p' => 'text-slate-700', 'pill' => 'bg-white text-[#b45309] ring-1 ring-[#ffb703]', 'hl' => 'text-transparent bg-clip-text bg-gradient-to-r from-[#c2410c] to-[#b45309]', 'dot' => 'bg-[#ffb703]', 'circle' => 'bg-white/45'],
        ['bg' => 'bg-gradient-to-br from-[#d8f3f8] via-[#eefafc] to-[#c9ecf7]', 'h' => 'text-[#023047]', 'p' => 'text-slate-600', 'pill' => 'bg-[#0369a1] text-white', 'hl' => 'text-[#023047]', 'dot' => 'bg-white', 'circle' => 'bg-[#219ebc]/15'],
    ];
    $slideCount = $bannerSlides->count();
@endphp
<section id="hero-slider" class="relative overflow-hidden" aria-roledescription="carousel" aria-label="{{ __('Sorotan Erlass Academy') }}">
    <div class="hero-track flex transition-transform duration-700 ease-[cubic-bezier(.22,.8,.2,1)] motion-reduce:transition-none">
        @foreach($bannerSlides as $i => $slide)
        @php $t = $heroThemes[$i % count($heroThemes)]; @endphp
        <div class="hero-slide relative w-full shrink-0 {{ $t['bg'] }}" role="group" aria-roledescription="slide"
             aria-label="{{ __(':current dari :total', ['current' => $i + 1, 'total' => $slideCount]) }}" @if($i !== 0) aria-hidden="true" inert @endif>
            {{-- Decoration differs per slide; it stays on the photo side and the edges so the text sits on one calm tone --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                @switch($i % 4)
                @case(0)
                    {{-- Light: big soft circle, dot grid, yellow ring --}}
                    <div class="absolute -right-40 top-1/2 -translate-y-1/2 w-[620px] h-[620px] rounded-full bg-[#8ecae6]/35 hidden lg:block"></div>
                    <svg class="absolute right-[6%] top-6 w-44 h-28 text-[#219ebc]/35" viewBox="0 0 176 112" fill="currentColor"><pattern id="hero-dots-{{ $i }}" width="16" height="16" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="3"/></pattern><rect width="176" height="112" fill="url(#hero-dots-{{ $i }})"/></svg>
                    <div class="absolute right-[40%] bottom-12 w-16 h-16 rounded-full border-[6px] border-[#ffb703]/60 hidden lg:block"></div>
                    @break
                @case(1)
                    {{-- Blue: white rings, plus signs, soft wave along the bottom --}}
                    <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full border-[28px] border-white/10"></div>
                    <div class="absolute right-[12%] -top-10 w-40 h-40 rounded-full border-2 border-white/25 hidden lg:block"></div>
                    <svg class="absolute right-[42%] top-14 w-24 h-24 text-white/35 hidden lg:block" viewBox="0 0 96 96" fill="currentColor"><path d="M14 4h4v10h10v4H18v10h-4V18H4v-4h10zM70 50h4v10h10v4H74v10h-4V64H60v-4h10z"/></svg>
                    <svg class="absolute inset-x-0 bottom-0 w-full h-24 text-white/10" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="currentColor"><path d="M0 64c240 56 480-64 720-16s480 72 720 16v56H0z"/></svg>
                    @break
                @case(2)
                    {{-- Warm: tilted rounded blocks (robot-kit feel) and a dashed gear-like ring --}}
                    <div class="absolute -right-16 -top-20 w-80 h-80 rounded-[3rem] rotate-12 bg-white/50"></div>
                    <div class="absolute right-[30%] -bottom-24 w-60 h-60 rounded-[2.5rem] -rotate-12 bg-[#ffb703]/25 hidden lg:block"></div>
                    <div class="absolute right-[5%] bottom-14 w-24 h-24 rounded-full border-4 border-dashed border-[#fb8500]/45 hidden sm:block"></div>
                    @break
                @default
                    {{-- Sky (assessment): target rings and scattered colored dots --}}
                    <svg class="absolute -right-48 top-1/2 -translate-y-1/2 w-[720px] h-[720px] text-[#219ebc] hidden lg:block" viewBox="0 0 720 720" fill="none" stroke="currentColor"><circle cx="360" cy="360" r="350" stroke-opacity=".12" stroke-width="2"/><circle cx="360" cy="360" r="270" stroke-opacity=".16" stroke-width="2"/><circle cx="360" cy="360" r="190" stroke-opacity=".2" stroke-width="2"/></svg>
                    <span class="absolute right-[44%] top-16 w-4 h-4 rounded-full bg-[#ffb703] hidden lg:block"></span>
                    <span class="absolute right-[8%] top-10 w-3 h-3 rounded-full bg-[#fb8500]"></span>
                    <span class="absolute right-[38%] bottom-14 w-5 h-5 rounded-full bg-[#219ebc]/50 hidden lg:block"></span>
                    <span class="absolute right-[4%] bottom-24 w-2.5 h-2.5 rounded-full bg-[#0369a1]/60"></span>
                @endswitch
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 pt-10 pb-20 sm:pt-14 lg:py-20 grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-8 lg:gap-12 items-center min-h-[560px]">
                <div class="space-y-5 text-center lg:text-left order-2 lg:order-1">
                    @if(filled($slide['pill']))
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs sm:text-sm font-bold shadow-sm {{ $t['pill'] }}">
                        <span class="w-2 h-2 rounded-full {{ $t['dot'] }}" aria-hidden="true"></span>
                        {{ __($slide['pill']) }}
                    </span>
                    @endif

                    @if($slide['main'])
                    {{-- Only the first slide carries the page's <h1> --}}
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.08] {{ $t['h'] }}">
                        {{ __($hp['hero']['title']) }}
                        @if(filled($hp['hero']['title_highlight']))<span class="{{ $t['hl'] }}">{{ __($hp['hero']['title_highlight']) }}</span>@endif
                    </h1>
                    <p class="text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0 {{ $t['p'] }}">{{ __($hp['hero']['description']) }}</p>
                    @else
                    <p class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.08] {{ $t['hl'] }}" role="heading" aria-level="2">{{ __($slide['title']) }}</p>
                    @if(filled($slide['caption']))
                    <p class="text-base sm:text-xl leading-relaxed max-w-xl mx-auto lg:mx-0 font-medium {{ $t['p'] }}">{{ __($slide['caption']) }}</p>
                    @endif
                    @endif

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3">
                        <a href="#contact" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] text-[#023047] font-bold shadow-lg shadow-orange-500/25 hover:-translate-y-0.5 hover:brightness-105 transition flex items-center justify-center gap-2">
                            {{ __($hp['hero']['cta_secondary']) }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white/90 backdrop-blur border-2 border-white text-[#023047] font-bold hover:bg-white hover:-translate-y-0.5 transition flex items-center justify-center gap-2 shadow-sm">
                            {{ __($hp['hero']['cta_primary']) }}
                        </a>
                    </div>
                </div>

                <div class="relative order-1 lg:order-2">
                    <div class="absolute -inset-4 rounded-[2.5rem] bg-gradient-to-tr from-[#ffb703]/40 to-[#219ebc]/30 blur-2xl pointer-events-none" aria-hidden="true"></div>
                    <div class="relative aspect-[16/10] lg:aspect-[4/3] rounded-[2rem] overflow-hidden ring-4 ring-white/80 shadow-2xl bg-white {{ ['', 'lg:rotate-2', 'lg:-rotate-2', ''][$i % 4] }}">
                        <img src="{{ asset($slide['img']) }}" alt="{{ $slide['main'] ? __('Foto kegiatan belajar Erlass') : __($slide['caption'] ?: $slide['title']) }}"
                             class="w-full h-full object-cover" @if($i === 0) fetchpriority="high" @else loading="lazy" @endif>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($slideCount > 1)
    {{-- Arrows --}}
    <button type="button" class="hero-prev hidden sm:grid absolute left-3 lg:left-5 top-1/2 -translate-y-1/2 z-10 w-12 h-12 place-items-center rounded-full bg-white/90 text-[#023047] shadow-lg ring-1 ring-black/5 hover:bg-white hover:scale-105 transition" aria-label="{{ __('Slide sebelumnya') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" class="hero-next hidden sm:grid absolute right-3 lg:right-5 top-1/2 -translate-y-1/2 z-10 w-12 h-12 place-items-center rounded-full bg-white/90 text-[#023047] shadow-lg ring-1 ring-black/5 hover:bg-white hover:scale-105 transition" aria-label="{{ __('Slide berikutnya') }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Dots + counter --}}
    <div class="absolute inset-x-0 bottom-5 z-10 flex items-center justify-center gap-2">
        @foreach($bannerSlides as $i => $slide)
        <button type="button" class="hero-dot h-2.5 rounded-full transition-all duration-300 ring-1 ring-[#023047]/30 {{ $i === 0 ? 'w-9 bg-[#fb8500]' : 'w-2.5 bg-white' }}" data-index="{{ $i }}" aria-label="{{ __('Tampilkan slide :n', ['n' => $i + 1]) }}" @if($i === 0) aria-current="true" @endif></button>
        @endforeach
    </div>
    <div class="absolute left-5 bottom-4 z-10 hidden sm:flex items-center gap-2 font-extrabold text-[#023047] bg-white/80 backdrop-blur px-3 py-1 rounded-full text-sm shadow-sm" aria-hidden="true">
        <span class="hero-counter text-base">01</span><span class="w-6 h-px bg-current opacity-50"></span><span class="opacity-60">{{ str_pad((string) $slideCount, 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- Autoplay progress --}}
    <div class="absolute inset-x-0 bottom-0 h-1 bg-white/40 z-10" aria-hidden="true">
        <div class="hero-progress h-full w-0 bg-gradient-to-r from-[#fb8500] to-[#ffb703]"></div>
    </div>
    @endif
</section>

{{-- Key numbers, right under the banner --}}
<section class="relative bg-white border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-0 py-8 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="p-4 sm:p-5 rounded-2xl bg-[#8ecae6]/15 ring-1 ring-[#8ecae6]/50">
            <p class="text-2xl sm:text-3xl font-black text-[#219ebc]">{{ $totalSchools }}+</p>
            <p class="text-xs sm:text-sm text-slate-600 font-semibold">{{ __('Sekolah Mitra Terverifikasi') }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-[#ffb703]/15 ring-1 ring-[#ffb703]/50">
            <p class="text-2xl sm:text-3xl font-black text-[#c98a00]">{{ number_format($totalDeals, 0, ',', '.') }}+</p>
            <p class="text-xs sm:text-sm text-slate-600 font-semibold">{{ __('Kontrak SP Terlaksana') }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-[#fb8500]/10 ring-1 ring-[#fb8500]/40">
            <p class="text-2xl sm:text-3xl font-black text-[#fb8500]">{{ count($categories) }} {{ __('Pilar') }}</p>
            <p class="text-xs sm:text-sm text-slate-600 font-semibold">{{ __('Solusi Edukasi Digital') }}</p>
        </div>
        <div class="p-4 sm:p-5 rounded-2xl bg-[#219ebc]/10 ring-1 ring-[#219ebc]/40">
            <p class="text-2xl sm:text-3xl font-black text-[#0284c7]">100%</p>
            <p class="text-xs sm:text-sm text-slate-600 font-semibold">{{ __('Kurikulum Merdeka & P5') }}</p>
        </div>
    </div>
</section>

<!-- ============================================
     SOCIAL PROOF MARQUEE — 400+ Sekolah Mitra SP Deals
     ============================================ -->
@if($hp['sections']['partners']['visible'] ?? true)
<section id="partners" class="py-12 bg-white border-y border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
        <p class="text-xs font-bold uppercase tracking-widest text-[#023047]/60">
            {{ str_replace('{jumlah}', $totalSchools, __($hp['sections']['partners']['title'])) }}
        </p>
    </div>

    <!-- Infinite Marquee Row 1 -->
    <div class="flex whitespace-nowrap overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex gap-4 animate-marquee-left">
            @foreach($partners->take(20) as $school)
                @include('partials.partner-chip', ['school' => $school, 'warm' => false, 'hidden' => false])
            @endforeach
            {{-- Duplicated for seamless loop --}}
            @foreach($partners->take(20) as $school)
                @include('partials.partner-chip', ['school' => $school, 'warm' => false, 'hidden' => true])
            @endforeach
        </div>
    </div>

    <!-- Infinite Marquee Row 2 (Reverse direction) -->
    <div class="flex whitespace-nowrap overflow-hidden mt-4 [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex gap-4 animate-marquee-right">
            @foreach($partners->skip(20)->take(20) as $school)
                @include('partials.partner-chip', ['school' => $school, 'warm' => true, 'hidden' => false])
            @endforeach
            {{-- Duplicated for seamless loop --}}
            @foreach($partners->skip(20)->take(20) as $school)
                @include('partials.partner-chip', ['school' => $school, 'warm' => true, 'hidden' => true])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ============================================
     PRODUK PLATFORM LMS ERLASS ACADEMY
     ============================================ -->
@if($hp['sections']['produk']['visible'] ?? true)
{{-- Homepage keeps it short: the free teacher banner, then one button per LMS column that opens /lms at that column.
     The full product columns live on the /lms page. --}}
<section id="produk" class="py-24 bg-white relative" aria-labelledby="lms-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 id="lms-heading" class="sr-only">{{ __($hp['sections']['produk']['title'] ?? __('Produk LMS Erlass Academy')) }}</h2>

        @include('partials.lms-hub')
        @include('partials.lms-jump', ['jumpBase' => route('lms.index')])
    </div>
</section>
@endif

<!-- ============================================
     SOLUSI SEKOLAH (4 Solusi Utama)
     ============================================ -->
@if($hp['sections']['solutions']['visible'] ?? true)
<section id="solutions" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                {{ __($hp['sections']['solutions']['badge']) }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                {{ __($hp['sections']['solutions']['title']) }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                {{ __($hp['sections']['solutions']['subtitle']) }}
            </p>
        </div>

        <!-- 4 Core Solution Cards (Bento Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Solution 1: Coding & Informatika -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#219ebc]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#8ecae6]/20 text-[#219ebc] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#219ebc] uppercase tracking-wider">{{ __('Solusi 01') }}</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">{{ __('Coding & Informatika') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ __('Kurikulum koding visual Scratch, Python tingkat lanjut, dan buku kerja informatika berjenjang dari kelas 1 SD hingga SMA.') }}
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> {{ __('Ekskul Coding Scratch & Python') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> {{ __('Modul Belajar LKPD TIK Jilid 1–6') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> {{ __('Projek Portofolio & Game Coding') }}
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#219ebc] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>{{ __('Minta Penawaran Program') }}</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 2: Robotic & Micro:bit -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#fb8500]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#fb8500]/15 text-[#fb8500] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#fb8500] uppercase tracking-wider">{{ __('Solusi 02') }}</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">{{ __('Robotic & Micro:bit') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ __('Eksplorasi rekayasa robotika praktis dengan Micro:bit Learning Kit, Erboblox, Jimu Robot, dan mikrokontroler sensor IoT.') }}
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> {{ __('Paket Kit Micro:bit & Aksesoris') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> {{ __('Robotik Explorer & Erboblox') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> {{ __('Praktik Sensor & Mekatronika') }}
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#fb8500] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>{{ __('Minta Penawaran Program') }}</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 3: Erlass Academy LMS -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#023047]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#8ecae6]/30 text-[#023047] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#023047] uppercase tracking-wider">{{ __('Solusi 03') }}</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Erlass Academy LMS</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ __('Platform manajemen pembelajaran modern untuk monitoring kemajuan belajar siswa, tugas, bank soal digital, dan rapor berkala.') }}
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> {{ __('Manajemen Kelas & Materi Digital') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> {{ __('Bank Soal & Ujian CBT Sekolah') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> {{ __('Dashboard Analitik Kepala Sekolah') }}
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#023047] hover:text-[#219ebc] pt-4 border-t border-slate-100 transition-colors">
                    <span>{{ __('Minta Penawaran Program') }}</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 4: Student Assessment -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#ffb703]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#ffb703]/20 text-[#b47a00] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#b47a00] uppercase tracking-wider">{{ __('Solusi 04') }}</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Student Assessment</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ __('Asesmen Potensi, Minat, dan Bakat (PMB) siswa dari kelas 1 hingga 12 untuk panduan penjurusan akademik dan karier masa depan.') }}
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> {{ __('Pemetaan Psikometrik Ilmiah') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> {{ __('Laporan Individual per Siswa') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> {{ __('Rekomendasi Konseling & Penjurusan') }}
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#b47a00] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>{{ __('Minta Penawaran Program') }}</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

        </div>
    </div>
</section>
@endif

<!-- ============================================
     TENTANG KAMI + KEUNGGULAN ERLASS
     ============================================ -->
@php
    $advantages = [
        ['title' => __('Kurikulum Terstruktur'), 'desc' => __('Materi berjenjang dari dasar logika hingga proyek nyata, selaras dengan capaian Kurikulum Merdeka dan P5.'), 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['title' => __('Instruktur Profesional'), 'desc' => __('Pengajar berpengalaman dan tersertifikasi yang hadir langsung di sekolah maupun secara daring.'), 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
        ['title' => __('Pembelajaran Interaktif'), 'desc' => __('Belajar sambil praktik: membuat game, merakit robot, dan memprogram perangkat secara langsung.'), 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664zM21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['title' => __('Sertifikat Pembelajaran'), 'desc' => __('Setiap siswa yang menuntaskan program mendapatkan sertifikat sebagai bukti kompetensi dan portofolio.'), 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
        ['title' => __('Pendampingan Program Sekolah'), 'desc' => __('Tim Erlass mendampingi sekolah mulai dari perencanaan, pelaksanaan, hingga evaluasi program secara berkala.'), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
    ];
@endphp
@if($hp['sections']['tentang']['visible'] ?? true)
<section id="tentang" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#ffb703]/20 text-[#023047] text-xs font-bold tracking-wider uppercase">
                    {{ __($hp['sections']['tentang']['badge']) }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">
                    {{ __($hp['sections']['tentang']['title']) }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ __($hp['sections']['tentang']['subtitle']) }}
                </p>
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                    <img src="{{ asset('img/gallery/teamwork.webp') }}" alt="{{ __('Siswa bekerja sama dalam proyek teknologi') }}" class="w-full h-56 object-cover" loading="lazy">
                </div>
                <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#023047] hover:bg-[#219ebc] text-white font-bold text-sm shadow-md transition-all">
                    <span>{{ __('Jadwalkan Konsultasi Sekolah') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Keunggulan Erlass -->
            <div class="lg:col-span-7" id="keunggulan">
                <h3 class="text-sm font-bold uppercase tracking-wider text-[#219ebc] mb-5">{{ __('Keunggulan Erlass') }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach($advantages as $i => $adv)
                    <div class="{{ $loop->last ? 'sm:col-span-2 bg-gradient-to-r from-[#023047] to-[#219ebc] text-white border-transparent shadow-md' : 'bg-slate-50 border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md' }} p-6 rounded-2xl border transition-all">
                        <div class="w-11 h-11 rounded-xl {{ $loop->last ? 'bg-white/10 text-[#ffb703]' : 'bg-[#8ecae6]/25 text-[#219ebc]' }} flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $adv['icon'] }}"></path></svg>
                        </div>
                        <h4 class="text-base font-bold {{ $loop->last ? 'text-white' : 'text-[#023047]' }} mb-2">{{ __($adv['title']) }}</h4>
                        <p class="text-sm leading-relaxed {{ $loop->last ? 'text-slate-100' : 'text-slate-600' }}">{{ __($adv['desc']) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
@endif

<!-- ============================================
     SECTION 2: WHY ERLASS? 5 PILAR SOLUSI PENDIDIKAN
     ============================================ -->
@if($hp['sections']['why-erlass']['visible'] ?? true)
<section id="why-erlass" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            @php $whyVideos = array_slice(array_values(array_filter(config('erlass.videos', []), fn ($v) => !empty($v['youtube_id']))), 0, 3); @endphp
            <div class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#ffb703]/20 text-[#023047] text-xs font-bold tracking-wider uppercase">
                    {{ __($hp['sections']['why-erlass']['badge']) }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">
                    {{ __($hp['sections']['why-erlass']['title']) }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ __($hp['sections']['why-erlass']['subtitle']) }}
                </p>

                {{-- Switch the right-hand panel between the 5 pillars and Erlass videos --}}
                @if($whyVideos)
                <div class="flex flex-wrap gap-3" role="group" aria-label="{{ __('Tampilkan pilar atau video Erlass') }}">
                    <button type="button" data-why-tab="pillars" aria-pressed="true" class="why-tab group w-28 rounded-xl border-2 p-1.5 text-left bg-white border-slate-200 hover:border-[#219ebc] aria-pressed:border-[#fb8500] aria-pressed:shadow-md transition-all">
                        <span class="flex items-center justify-center h-14 rounded-lg bg-gradient-to-br from-[#023047] to-[#219ebc] text-white text-lg font-extrabold">5</span>
                        <span class="block mt-1.5 px-0.5 text-[11px] font-bold text-[#023047] leading-tight">{{ __('5 Pilar Erlass') }}</span>
                    </button>
                    @foreach($whyVideos as $i => $video)
                    <button type="button" data-why-tab="video" data-video-id="{{ $video['youtube_id'] }}" data-video-title="{{ $video['title'] }}" aria-pressed="false" class="why-tab group w-28 rounded-xl border-2 p-1.5 text-left bg-white border-slate-200 hover:border-[#219ebc] aria-pressed:border-[#fb8500] aria-pressed:shadow-md transition-all">
                        <span class="relative block h-14 rounded-lg overflow-hidden bg-slate-200">
                            <img src="https://i.ytimg.com/vi/{{ $video['youtube_id'] }}/mqdefault.jpg" alt="" loading="lazy" class="w-full h-full object-cover">
                            <span class="absolute inset-0 flex items-center justify-center bg-black/25 group-hover:bg-black/10 transition-colors">
                                <span class="w-7 h-7 rounded-full bg-white/95 flex items-center justify-center shadow">
                                    <svg class="w-3.5 h-3.5 text-[#fb8500] translate-x-px" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                        </span>
                        <span class="block mt-1.5 px-0.5 text-[11px] font-bold text-[#023047] leading-tight line-clamp-2">{{ $video['title'] }}</span>
                    </button>
                    @endforeach
                </div>
                @endif

            </div>

            <!-- 5 Pillars Grid -->
            <div class="lg:col-span-7" data-why-panel>
            <div data-why-pillars class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <!-- Pilar 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">{{ __('Kurikulum Adaptif') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('Terstruktur dari dasar logika hingga implementasi nyata, selaras dengan capaian pembelajaran Kurikulum Merdeka dan P5.') }}
                    </p>
                </div>

                <!-- Pilar 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">{{ __('Platform Digital Terintegrasi') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('Dilengkapi LMS Erlass Academy untuk memantau kehadiran, progres materi, submission tugas, dan asesmen secara real-time.') }}
                    </p>
                </div>

                <!-- Pilar 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">{{ __('Perangkat Pembelajaran Lengkap') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('Penyediaan learning kit Micro:bit, robotik Erboblox/Jimu, serta modul cetak dan panduan praktikum resmi tanpa membebani sekolah.') }}
                    </p>
                </div>

                <!-- Pilar 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        4
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">{{ __('Pendampingan & Pembinaan Guru') }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        {{ __('Instruktur berpengalaman mengajar langsung ke sekolah didampingi sertifikasi dan pelatihan ToT (Training of Trainer) berkala bagi guru.') }}
                    </p>
                </div>

                <!-- Pilar 5 (Spans 2 columns) -->
                <div class="sm:col-span-2 p-6 rounded-2xl bg-gradient-to-r from-[#023047] to-[#219ebc] text-white shadow-md">
                    <div class="w-10 h-10 rounded-lg bg-white/10 text-[#8ecae6] flex items-center justify-center font-bold mb-4">
                        5
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">{{ __('Ekosistem Belajar Berkelanjutan') }}</h3>
                    <p class="text-slate-100 text-xs leading-relaxed">
                        {{ __('Menghubungkan sekolah dengan kompetisi koding & robotika nasional, pameran karya siswa, seminar edukasi, dan jejaring komunitas sekolah se-Indonesia.') }}
                    </p>
                </div>

            </div>

            {{-- Video player: replaces the pillar cards while a video tab is active --}}
            <div data-why-player class="hidden">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-[#023047] shadow-xl" data-why-frame></div>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-sm font-bold text-[#023047]" data-why-title></p>
                    <button type="button" data-why-close class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">{{ __('← Kembali ke 5 Pilar') }}</button>
                </div>
                <div class="mt-5 flex justify-center sm:justify-start">
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 hover:border-[#219ebc] text-[#023047] font-bold text-sm shadow-xs transition-all">
                        <svg class="w-4 h-4 text-[#219ebc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.6-4.6a2 2 0 012.8 0L16 16m-2-2l1.6-1.6a2 2 0 012.8 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ __('Dokumentasi Kegiatan') }}</span>
                    </a>
                </div>
            </div>
            </div>

        </div>
    </div>
</section>
@endif
<script>
// "Why Erlass?" panel: video tabs replace the 5 pillar cards; the iframe is only created on click
(function () {
    var panel = document.querySelector("[data-why-panel]");
    var tabs = document.querySelectorAll("[data-why-tab]");
    if (!panel || !tabs.length) return;
    var pillars = panel.querySelector("[data-why-pillars]");
    var player = panel.querySelector("[data-why-player]");
    var frame = panel.querySelector("[data-why-frame]");
    var title = panel.querySelector("[data-why-title]");

    function select(tab) {
        tabs.forEach(function (t) { t.setAttribute("aria-pressed", t === tab ? "true" : "false"); });
        if (tab.dataset.whyTab === "video") {
            frame.innerHTML = "";
            var iframe = document.createElement("iframe");
            iframe.className = "absolute inset-0 w-full h-full";
            iframe.src = "https://www.youtube-nocookie.com/embed/" + encodeURIComponent(tab.dataset.videoId) + "?autoplay=1&rel=0&modestbranding=1";
            iframe.title = tab.dataset.videoTitle;
            iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
            iframe.allowFullscreen = true;
            frame.appendChild(iframe);
            title.textContent = tab.dataset.videoTitle;
            pillars.classList.add("hidden");
            player.classList.remove("hidden");
        } else {
            frame.innerHTML = ""; // stops playback
            player.classList.add("hidden");
            pillars.classList.remove("hidden");
        }
    }
    tabs.forEach(function (t) { t.addEventListener("click", function () { select(t); }); });
    var close = panel.querySelector("[data-why-close]");
    if (close) close.addEventListener("click", function () { select(document.querySelector("[data-why-tab=pillars]")); });
})();
</script>

<!-- ============================================
     PROGRAM PENDIDIKAN (5 program)
     ============================================ -->
@php
    $eduPrograms = [
        [
            'title' => __('Program untuk Sekolah'), 'audience' => __('Kepala Sekolah & Yayasan'), 'span' => 'lg:col-span-2', 'accent' => '#219ebc',
            'desc' => __('Paket implementasi pembelajaran teknologi menyeluruh: kurikulum, perangkat, LMS, dan evaluasi program.'),
            'points' => [__('Perencanaan program tahunan'), __('Pengadaan kit & modul'), __('Laporan capaian berkala')],
        ],
        [
            'title' => __('Program untuk Guru'), 'audience' => __('Guru TIK & Mapel'), 'span' => 'lg:col-span-2', 'accent' => '#fb8500',
            'desc' => __('Pelatihan dan sertifikasi guru agar mampu mengajarkan coding dan robotika secara mandiri.'),
            'points' => [__('Training of Trainer (ToT)'), __('Workshop & webinar rutin'), __('Sertifikat pelatihan')],
        ],
        [
            'title' => __('Program untuk Siswa'), 'audience' => __('Siswa SD – SMA'), 'span' => 'lg:col-span-2', 'accent' => '#b47a00',
            'desc' => __('Kelas pengembangan keterampilan digital, proyek portofolio, dan persiapan kompetisi teknologi.'),
            'points' => [__('Kelas berjenjang'), __('Proyek & portofolio'), __('Pembinaan kompetisi')],
        ],
        [
            'title' => __('Program Ekstrakurikuler'), 'audience' => __('Di luar jam pelajaran'), 'span' => 'lg:col-span-3', 'accent' => '#219ebc',
            'desc' => __('Ekskul Coding & Robotika mingguan dengan instruktur Erlass, lengkap dengan perangkat praktik dan showcase karya di akhir semester.'),
            'points' => [__('Instruktur datang ke sekolah'), __('Perangkat praktik disediakan'), __('Showcase & sertifikat')],
        ],
        [
            'title' => __('Program Intrakurikuler'), 'audience' => __('Mata Pelajaran'), 'span' => 'lg:col-span-3', 'accent' => '#fb8500',
            'desc' => __('Integrasi materi Informatika & Koding-KA ke dalam Mata Pelajaran sesuai Kurikulum Merdeka, didukung buku digital dan LMS.'),
            'points' => [__('Modul Ajar Guru'), __('Materi Siswa'), __('Asesmen (Tugas, Kuis, dan Refleksi) terintegrasi LMS'), __('Progress Siswa Terpantau'), __('Sistem Penilaian Mudah')],
        ],
    ];
@endphp
@if($hp['sections']['program']['visible'] ?? true)
<section id="program" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#fb8500]/10 text-[#fb8500] text-xs font-bold tracking-wider uppercase">
                {{ __($hp['sections']['program']['badge']) }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                {{ __($hp['sections']['program']['title']) }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                {{ __($hp['sections']['program']['subtitle']) }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
            @foreach($eduPrograms as $prog)
            <div class="{{ $prog['span'] }} bg-white rounded-2xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition-all flex flex-col border-t-4" style="border-top-color: {{ $prog['accent'] }}">
                <span class="text-[11px] font-bold uppercase tracking-wider" style="color: {{ $prog['accent'] }}">{{ __($prog['audience']) }}</span>
                <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">{{ __($prog['title']) }}</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-5">{{ __($prog['desc']) }}</p>
                <ul class="space-y-2 text-sm text-slate-600 mb-6">
                    @foreach($prog['points'] as $point)
                    <li class="flex items-start gap-2"><span class="font-bold" style="color: {{ $prog['accent'] }}">✓</span> {{ __($point) }}</li>
                    @endforeach
                </ul>
                <a href="#contact" class="mt-auto inline-flex items-center gap-1.5 text-sm font-bold text-[#023047] hover:text-[#219ebc] pt-4 border-t border-slate-100 transition-colors">
                    <span>{{ __('Konsultasikan Program') }}</span>
                    <span aria-hidden="true">→</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ============================================
     SECTION 3: FEATURED PRODUCTS FROM ERLASS CRM
     ============================================ -->
@if($hp['sections']['products']['visible'] ?? true)
<section id="products" class="py-24 bg-slate-50 relative" aria-labelledby="products-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase mb-3">
                {{ __($hp['sections']['products']['badge']) }}
            </div>
            <h2 id="products-heading" class="text-3xl font-extrabold text-[#023047] tracking-tight">
                {{ __($hp['sections']['products']['title']) }}
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                {{ __($hp['sections']['products']['subtitle']) }}
            </p>
        </div>

        <div data-carousel>
            <div class="flex items-center justify-between gap-4 mb-4">
                <p class="text-sm sm:text-base font-semibold text-slate-400" aria-live="polite" data-carousel-status>{{ __('Halaman 1') }}</p>
                <div class="flex gap-3">
                    <button type="button" data-carousel-prev aria-label="{{ __('Produk sebelumnya') }}" class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-[#1d4ed8] hover:border-[#1d4ed8] disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center shadow-xs transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" data-carousel-next aria-label="{{ __('Produk berikutnya') }}" class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-[#1d4ed8] hover:border-[#1d4ed8] disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center shadow-xs transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <ul data-carousel-track class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth py-3 -mx-4 px-4 sm:mx-0 sm:px-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" aria-label="{{ __('Produk unggulan') }}">
                @foreach($featuredProducts as $prod)
                <li class="snap-start shrink-0 w-[78%] sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-4.5rem)/4)]">
                    @include('products._card', ['product' => $prod])
                </li>
                @endforeach
            </ul>

            <div class="flex justify-center gap-2 mt-8" data-carousel-dots></div>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-[#1d4ed8]/5 hover:bg-[#1d4ed8]/10 text-[#1d4ed8] font-bold text-base transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.25C10.5 5 8.5 4.5 6 4.5c-1.2 0-2.2.1-3 .4v14c.8-.3 1.8-.4 3-.4 2.5 0 4.5.5 6 1.75m0-14c1.5-1.25 3.5-1.75 6-1.75 1.2 0 2.2.1 3 .4v14c-.8-.3-1.8-.4-3-.4-2.5 0-4.5.5-6 1.75m0-14v14"/></svg>
                {{ __('Lihat Semua Produk') }}
            </a>
            <a href="{{ config('erlass.shopee') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-slate-100 hover:bg-[#ee4d2d] text-[#023047] hover:text-white font-bold text-base transition-colors">
                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                {{ __('Belanja di Shopee Erlass') }}
            </a>
        </div>
    </div>
</section>
@endif
<script>
// Paged product carousel: arrows + dots + "Halaman x dari y"; native scroll-snap does the sliding
document.querySelectorAll('[data-carousel]').forEach(function (root) {
    var track = root.querySelector('[data-carousel-track]');
    var prev = root.querySelector('[data-carousel-prev]');
    var next = root.querySelector('[data-carousel-next]');
    var dots = root.querySelector('[data-carousel-dots]');
    var status = root.querySelector('[data-carousel-status]');
    if (!track) return;

    function pages() { return Math.max(1, Math.round(track.scrollWidth / track.clientWidth)); }
    function current() {
        var max = track.scrollWidth - track.clientWidth;
        if (max <= 0) return 0;
        return Math.round((track.scrollLeft / max) * (pages() - 1));
    }
    function go(i) {
        var max = track.scrollWidth - track.clientWidth;
        var n = pages();
        track.scrollTo({ left: n > 1 ? (max * i) / (n - 1) : 0, behavior: 'smooth' });
    }
    function render() {
        var n = pages(), c = current();
        status.textContent = 'Halaman ' + (c + 1) + ' dari ' + n;
        prev.disabled = c === 0;
        next.disabled = c >= n - 1;
        if (dots.children.length !== n) {
            dots.innerHTML = '';
            for (var i = 0; i < n; i++) {
                var b = document.createElement('button');
                b.type = 'button';
                b.setAttribute('aria-label', 'Ke halaman ' + (i + 1));
                b.addEventListener('click', go.bind(null, i));
                dots.appendChild(b);
            }
        }
        Array.prototype.forEach.call(dots.children, function (b, i) {
            b.className = 'h-2.5 rounded-full transition-all ' + (i === c ? 'w-14 bg-[#1d4ed8]' : 'w-2.5 bg-slate-300 hover:bg-slate-400');
            b.setAttribute('aria-current', i === c ? 'true' : 'false');
        });
    }
    prev.addEventListener('click', function () { go(Math.max(0, current() - 1)); });
    next.addEventListener('click', function () { go(Math.min(pages() - 1, current() + 1)); });
    var t;
    track.addEventListener('scroll', function () { clearTimeout(t); t = setTimeout(render, 60); }, { passive: true });
    window.addEventListener('resize', render);
    render();
});
</script>

<!-- ============================================
     AKTIVITAS & INFORMASI ERLASS
     ============================================ -->
@if($hp['sections']['aktivitas']['visible'] ?? true)
<section id="aktivitas" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                    {{ __($hp['sections']['aktivitas']['badge']) }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                    {{ __($hp['sections']['aktivitas']['title']) }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ __($hp['sections']['aktivitas']['subtitle']) }}
                </p>
            </div>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-[#8ecae6]/50 text-[#023047] hover:border-[#219ebc] text-sm font-bold shadow-xs transition-all self-start md:self-auto">
                {{ __('Lihat Semua Artikel →') }}
            </a>
        </div>

        <!-- Row 1: Kompetisi + Info Program Terbaru -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 relative rounded-3xl overflow-hidden min-h-[360px] flex items-end shadow-lg">
                <img src="{{ asset('img/gallery/competition.webp') }}" alt="{{ __('Siswa merayakan kemenangan kompetisi robotika') }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-[#023047] via-[#023047]/70 to-transparent"></div>
                <div class="relative p-7 sm:p-10 space-y-4 text-white max-w-xl">
                    <span class="inline-block px-3 py-1 rounded-md bg-[#ffb703] text-[#023047] text-xs font-bold uppercase tracking-wider">{{ __('Kompetisi') }}</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold leading-tight">Erlass Coding & Robotic Competition</h3>
                    <p class="text-slate-200 text-sm sm:text-base leading-relaxed">
                        {{ __('Ajang unjuk karya siswa SD–SMA di bidang coding, Micro:bit, dan robotika. Latih kreativitas, kerja sama tim, dan keberanian tampil.') }}
                    </p>
                    <div class="flex flex-wrap gap-3 pt-1">
                        <a href="#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">{{ __('Daftarkan Tim Sekolah') }}</a>
                        <a href="{{ route('articles.index', ['kategori' => 'kompetisi']) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-sm transition-colors">{{ __('Info Kompetisi') }}</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs flex flex-col">
                <h3 class="text-sm font-bold uppercase tracking-wider text-[#fb8500] mb-5">{{ __('Informasi Program Terbaru') }}</h3>
                <ul class="space-y-4 flex-1">
                    @if($announcements->isNotEmpty())
                        @foreach($announcements as $info)
                        <li class="pb-4 border-b border-slate-100 last:border-0 last:pb-0">
                            <a href="{{ $info->url_link ?: '#contact' }}" class="group block">
                                <p class="text-[11px] text-slate-500 font-semibold">{{ $info->created_at?->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-semibold text-[#023047] group-hover:text-[#219ebc] leading-snug mt-1">{{ $info->content }}</p>
                            </a>
                        </li>
                        @endforeach
                    @else
                        @forelse($latestArticles as $info)
                        <li class="pb-4 border-b border-slate-100 last:border-0 last:pb-0">
                            <a href="{{ route('articles.show', $info->slug) }}" class="group block">
                                <p class="text-[11px] text-slate-500 font-semibold">{{ __($info->category_label) }} · {{ $info->published_at?->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-semibold text-[#023047] group-hover:text-[#219ebc] leading-snug mt-1">{{ $info->title }}</p>
                            </a>
                        </li>
                        @empty
                        <li class="text-sm text-slate-500">{{ __('Belum ada informasi terbaru. Hubungi tim kami untuk jadwal program terkini.') }}</li>
                        @endforelse
                    @endif
                </ul>
                <a href="https://wa.me/{{ config('erlass.whatsapp') }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20info%20program%20terbaru" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba59] text-white font-bold text-sm transition-colors">
                    {{ __('Tanya via WhatsApp') }}
                </a>
            </div>
        </div>

        <!-- Row 2: Dokumentasi Kegiatan -->
        <div class="mt-16">
            <div class="flex items-center justify-between gap-4 mb-5">
                <h3 class="text-xl font-bold text-[#023047]">{{ __('Dokumentasi Kegiatan') }}</h3>
                <a href="{{ route('gallery') }}" class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">{{ __('Lihat Galeri →') }}</a>
            </div>
            @php
                $docPhotos = [
                    ['img' => 'img/gallery/coding-class.webp',   'label' => __('Kelas Coding')],
                    ['img' => 'img/gallery/robotics-class.webp', 'label' => __('Praktik Robotika')],
                    ['img' => 'img/gallery/presentation.webp',   'label' => __('Presentasi Proyek')],
                    ['img' => 'img/gallery/teamwork.webp',       'label' => __('Kerja Tim Siswa')],
                ];
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($docPhotos as $photo)
                <a href="{{ route('gallery') }}" class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-200">
                    <img src="{{ asset($photo['img']) }}" alt="{{ __($photo['label']) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <span class="absolute left-3 bottom-3 px-2.5 py-1 rounded-md bg-[#023047]/85 text-white text-xs font-semibold">{{ __($photo['label']) }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Row 3: Berita & Artikel -->
        @if($latestArticles->isNotEmpty())
        <div class="mt-16">
            <h3 class="text-xl font-bold text-[#023047] mb-5">{{ __('Berita & Artikel') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestArticles->take(3) as $article)
                    @include('articles._card', ['article' => $article])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif

<!-- ============================================
     SECTION 4: LET'S COLLABORATE (Mitra & Institusi)
     ============================================ -->
@if($hp['sections']['collaborate']['visible'] ?? true)
<section id="collaborate" class="py-24 bg-gradient-to-br from-[#219ebc] via-[#0b8fc6] to-[#0369a1] text-white relative overflow-hidden">
    <div class="absolute inset-0 hero-grid-pattern opacity-25 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#8ecae6]/20 text-[#ffe9a8] text-xs font-bold tracking-wider uppercase">
                {{ __($hp['sections']['collaborate']['badge']) }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                {{ __($hp['sections']['collaborate']['title']) }}
            </h2>
            <p class="text-white/90 text-base leading-relaxed">
                {{ __($hp['sections']['collaborate']['subtitle']) }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Box 1: Sekolah -->
            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/25 flex flex-col justify-between hover:border-white hover:bg-white/15 transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-white text-[#219ebc] shadow-sm flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ __('Sekolah & Madrasah') }}</h3>
                    <p class="text-white/90 text-xs leading-relaxed mb-6">
                        {{ __('Penyelenggaraan ekstrakurikuler koding & robotik, pengadaan modul TIK, dan workshop teknologi terjadwal.') }}
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-white underline-offset-4 hover:underline hover:text-[#ffe08a] flex items-center gap-1">
                    <span>{{ __('Ajukan Kerja Sama Sekolah →') }}</span>
                </a>
            </div>

            <!-- Box 2: Yayasan -->
            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/25 flex flex-col justify-between hover:border-white hover:bg-white/15 transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-white text-[#c98a00] shadow-sm flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ __('Yayasan Pendidikan') }}</h3>
                    <p class="text-white/90 text-xs leading-relaxed mb-6">
                        {{ __('Standardisasi kurikulum digital multi-cabang sekolah, pemetaan potensi siswa massal, dan LMS terpusat.') }}
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-white underline-offset-4 hover:underline hover:text-[#ffe08a] flex items-center gap-1">
                    <span>{{ __('Konsultasi Skala Yayasan →') }}</span>
                </a>
            </div>

            <!-- Box 3: Dinas Pendidikan -->
            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/25 flex flex-col justify-between hover:border-white hover:bg-white/15 transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-white text-[#fb8500] shadow-sm flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ __('Dinas Pendidikan') }}</h3>
                    <p class="text-white/90 text-xs leading-relaxed mb-6">
                        {{ __('Program literasi komputasi wilayah, pelatihan kompetensi guru TIK, dan kompetisi inovasi teknologi daerah.') }}
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-white underline-offset-4 hover:underline hover:text-[#ffe08a] flex items-center gap-1">
                    <span>{{ __('Program Kemitraan Dinas →') }}</span>
                </a>
            </div>

            <!-- Box 4: Mitra Bisnis -->
            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/25 flex flex-col justify-between hover:border-white hover:bg-white/15 transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-white text-[#0284c7] shadow-sm flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ __('Mitra Bisnis & CSR') }}</h3>
                    <p class="text-white/90 text-xs leading-relaxed mb-6">
                        {{ __('Penyaluran CSR edukasi teknologi, distributor perangkat belajar, dan kolaborasi strategis industri EdTech.') }}
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-white underline-offset-4 hover:underline hover:text-[#ffe08a] flex items-center gap-1">
                    <span>{{ __('Hubungi Kemitraan Bisnis →') }}</span>
                </a>
            </div>

        </div>

    </div>
</section>
@endif

<!-- ============================================
     SECTION 5: LEAD FORM (Konsultasi & Permintaan Penawaran)
     ============================================ -->
@if($hp['sections']['contact']['visible'] ?? true)
<section id="contact" class="py-24 bg-slate-100 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12 space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                {{ __($hp['sections']['contact']['badge']) }}
            </div>
            <h2 class="text-3xl font-extrabold text-[#023047] tracking-tight">
                {{ __($hp['sections']['contact']['title']) }}
            </h2>
            <p class="text-slate-600 text-sm max-w-xl mx-auto">
                {{ __($hp['sections']['contact']['subtitle']) }}
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200/80 shadow-md">
            
            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-start gap-3" role="alert">
                    <svg class="w-5 h-5 mt-0.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold text-sm">{{ __('Formulir Terkirim Berhasil') }}</h3>
                        <p class="text-xs mt-1 text-emerald-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('leads.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="type" value="consultation">
                <input type="hidden" name="source" value="homepage_corporate">
                
                <!-- Honeypot -->
                <div class="hidden" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>

                <!-- Row 1: Sender Type & Full Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="sender_type" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Tipe Pengirim / Institusi') }} <span class="text-red-500">*</span>
                        </label>
                        <select id="sender_type" name="sender_type" required class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] bg-white">
                            <option value="school" {{ old('sender_type') == 'school' ? 'selected' : '' }}>{{ __('Sekolah (Kepala Sekolah / Guru / TIK)') }}</option>
                            <option value="institution" {{ old('sender_type') == 'institution' ? 'selected' : '' }}>{{ __('Yayasan Pendidikan') }}</option>
                            <option value="education_office" {{ old('sender_type') == 'education_office' ? 'selected' : '' }}>{{ __('Dinas Pendidikan') }}</option>
                            <option value="business_partner" {{ old('sender_type') == 'business_partner' ? 'selected' : '' }}>{{ __('Mitra Bisnis / Vendor') }}</option>
                            <option value="parent" {{ old('sender_type') == 'parent' ? 'selected' : '' }}>{{ __('Orang Tua Siswa') }}</option>
                            <option value="other" {{ old('sender_type') == 'other' ? 'selected' : '' }}>{{ __('Lainnya') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Nama Lengkap Kontak') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="{{ __('Contoh: Budi Santoso, S.Pd.') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Phone & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Nomor WhatsApp / Telepon') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="{{ __('Contoh: 081234567890') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                        @error('phone')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Alamat Email Resmi') }}
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Contoh: :email', ['email' => 'sekolah@yayasan.sch.id']) }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>
                </div>

                <!-- Row 3: School Name, City & Student Count -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label for="school_name" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Nama Sekolah / Instansi') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name') }}" required placeholder="{{ __('Contoh: SDI Teladan Suci') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>

                    <div>
                        <label for="city" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Kota / Kabupaten') }}
                        </label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="{{ __('Contoh: Jakarta Timur') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>

                    <div>
                        <label for="student_count" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            {{ __('Perkiraan Siswa') }}
                        </label>
                        <input type="number" id="student_count" name="student_count" value="{{ old('student_count') }}" placeholder="{{ __('Contoh: 150') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>
                </div>

                <!-- Row 4: Program of Interest -->
                <div>
                    <label for="program-select" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                        {{ __('Solusi Program yang Diminati') }}
                    </label>
                    <select id="program-select" name="program" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] bg-white">
                        <option value="">{{ __('-- Pilih Solusi / Kategori --') }}</option>
                        <option value="coding-informatika">{{ __('Coding & Informatika (Scratch / Python / LKPD)') }}</option>
                        <option value="microbit-robotik">{{ __('Robotika & Micro:bit Learning Kit') }}</option>
                        <option value="python">{{ __('Python (SMP – SMA)') }}</option>
                        <option value="web-development">Web Development (HTML, CSS, JavaScript)</option>
                        <option value="erlass-academy-lms">{{ __('Erlass Academy LMS (Platform Digital Sekolah)') }}</option>
                        <option value="student-assessment">{{ __('Student Assessment (Asesmen Bakat & Potensi Siswa)') }}</option>
                        <option value="teacher-training">{{ __('Pelatihan & Pendampingan Guru (ToT)') }}</option>
                        <option value="all-solutions">{{ __('Paket Solusi Terintegrasi Lengkap') }}</option>
                    </select>
                </div>

                <!-- Row 5: Message / Specific Needs -->
                <div>
                    <label for="message" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                        {{ __('Rincian Kebutuhan & Catatan Khusus') }}
                    </label>
                    <textarea id="message" name="message" rows="3" placeholder="{{ __('Jelaskan kebutuhan sekolah Anda, jadwal yang diinginkan, atau pertanyaan spesifik mengenai kurikulum...') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] resize-none">{{ old('message') }}</textarea>
                </div>

                <!-- Consent UU PDP -->
                <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-50 border border-[#8ecae6]/40">
                    <input type="checkbox" id="consent_given" name="consent_given" value="1" checked required class="mt-0.5 rounded text-[#219ebc] focus:ring-[#219ebc]">
                    <label for="consent_given" class="text-xs text-slate-600 leading-relaxed">
                        {{ __('Saya menyetujui pemrosesan data kontak di atas oleh PT Erlass Prokreatif Indonesia semata-mata untuk keperluan komunikasi penawaran dan konsultasi pendidikan, sesuai ketentuan') }} <strong class="text-[#023047]">{{ __('UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)') }}</strong>.
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-base shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>{{ __('Kirim Permintaan Konsultasi & Penawaran') }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <p class="text-center text-xs text-slate-500 mt-3 font-medium">
                        {{ __('Tim konsultan pendidikan kami akan menghubungi via WhatsApp atau email dalam 1x24 jam kerja.') }}
                    </p>
                </div>

            </form>

        </div>

    </div>
</section>
@endif

<script>
    // Hero banner slider: slides sideways, autoplay with a progress bar, arrows, dots, swipe and keyboard.
    // Pauses on hover/focus and while the tab is hidden; no autoplay with reduced motion.
    (function () {
        const root = document.getElementById('hero-slider');
        if (!root) return;
        const track = root.querySelector('.hero-track');
        const slides = root.querySelectorAll('.hero-slide');
        const dots = root.querySelectorAll('.hero-dot');
        const counter = root.querySelector('.hero-counter');
        const bar = root.querySelector('.hero-progress');
        if (slides.length < 2) return;
        const DELAY = 6000;
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        let current = 0, timer = null;

        function restartBar() {
            if (!bar || reduce) return;
            bar.style.transition = 'none';
            bar.style.width = '0';
            void bar.offsetWidth; // restart the CSS transition
            bar.style.transition = 'width ' + DELAY + 'ms linear';
            bar.style.width = '100%';
        }
        function show(i) {
            current = (i + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            slides.forEach(function (s, idx) {
                const on = idx === current;
                s.setAttribute('aria-hidden', on ? 'false' : 'true');
                s.inert = !on; // links on hidden slides are not reachable with Tab
            });
            dots.forEach(function (d, idx) {
                const on = idx === current;
                d.classList.toggle('w-9', on);
                d.classList.toggle('bg-[#fb8500]', on);
                d.classList.toggle('w-2.5', !on);
                d.classList.toggle('bg-white', !on);
                if (on) d.setAttribute('aria-current', 'true'); else d.removeAttribute('aria-current');
            });
            if (counter) counter.textContent = String(current + 1).padStart(2, '0');
        }
        function stop() {
            if (timer) clearInterval(timer);
            timer = null;
            if (bar) { bar.style.transition = 'none'; bar.style.width = '0'; }
        }
        function start() {
            if (reduce) return;
            stop();
            restartBar();
            timer = setInterval(function () { show(current + 1); restartBar(); }, DELAY);
        }
        function go(i) { show(i); start(); }

        root.querySelector('.hero-prev').addEventListener('click', function () { go(current - 1); });
        root.querySelector('.hero-next').addEventListener('click', function () { go(current + 1); });
        dots.forEach(function (d) { d.addEventListener('click', function () { go(Number(d.dataset.index)); }); });
        root.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') go(current - 1);
            if (e.key === 'ArrowRight') go(current + 1);
        });

        // Swipe on touch screens
        let x0 = null;
        track.addEventListener('touchstart', function (e) { x0 = e.touches[0].clientX; stop(); }, { passive: true });
        track.addEventListener('touchend', function (e) {
            if (x0 === null) return;
            const dx = e.changedTouches[0].clientX - x0;
            x0 = null;
            if (Math.abs(dx) > 50) go(current + (dx < 0 ? 1 : -1)); else start();
        }, { passive: true });

        root.addEventListener('mouseenter', stop);
        root.addEventListener('mouseleave', start);
        root.addEventListener('focusin', stop);
        root.addEventListener('focusout', function (e) { if (!root.contains(e.relatedTarget)) start(); });
        document.addEventListener('visibilitychange', function () { document.hidden ? stop() : start(); });
        start();
    })();

</script>

@endsection
