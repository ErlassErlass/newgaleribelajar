@extends('layouts.app')

@section('title', 'Erlass - Solusi Pembelajaran Coding, Robotik, LMS & Asesmen Sekolah')

@section('content')
@php $hp = config('homepage'); @endphp

<!-- ============================================
     HERO SECTION — Professional EdTech Corporate
     Colors: #023047 (Navy) · #219ebc (Cyan) · #8ecae6 (Sky) · #ffb703 (Amber) · #fb8500 (Orange)
     ============================================ -->
<section class="relative bg-gradient-to-b from-[#023047] via-[#032539] to-[#021f30] text-white pt-24 pb-20 overflow-hidden">
    <!-- Subtle Background Grid & Glow -->
    <div class="absolute inset-0 hero-grid-pattern opacity-40 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#219ebc]/20 blur-[120px] rounded-full pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Hero copy -->
            <div class="space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#023047]/90 border border-[#8ecae6]/30 text-[#8ecae6] text-xs sm:text-sm font-semibold tracking-wide shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#ffb703] animate-pulse"></span>
                    <span>{{ $hp['hero']['badge'] }}</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-[3.4rem] font-extrabold tracking-tight text-white leading-[1.15]">
                    {{ $hp['hero']['title'] }} @if(filled($hp['hero']['title_highlight']))<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8ecae6] via-[#219ebc] to-[#ffb703]">{{ $hp['hero']['title_highlight'] }}</span>@endif
                </h1>

                <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    {{ $hp['hero']['description'] }}
                </p>

                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#produk" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-[#219ebc] to-[#0284c7] hover:from-[#1b859f] hover:to-[#026c9c] text-white font-bold text-base shadow-lg hover:shadow-cyan-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>{{ $hp['hero']['cta_primary'] }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <a href="#contact" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-base shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>{{ $hp['hero']['cta_secondary'] }}</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Hero photo slider -->
            @php
                $heroSlides = collect($hp['hero']['slides'] ?? [])->filter(fn ($x) => filled($x['image'] ?? null))->map(fn ($x) => ['img' => $x['image'], 'tag' => $x['tag'] ?? '', 'caption' => $x['caption'] ?? ''])->values()->all();
            @endphp
            <div class="relative" id="hero-slider" aria-roledescription="carousel" aria-label="Foto kegiatan belajar Erlass">
                <div class="absolute -inset-3 bg-gradient-to-tr from-[#219ebc]/40 to-[#ffb703]/30 rounded-[2rem] blur-2xl pointer-events-none"></div>
                <div class="relative aspect-[4/3] rounded-3xl overflow-hidden border border-[#8ecae6]/30 shadow-2xl bg-[#032539]">
                    @foreach($heroSlides as $i => $slide)
                    <figure class="hero-slide absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}" aria-roledescription="slide" aria-label="{{ $i + 1 }} dari {{ count($heroSlides) }}" @if($i !== 0) aria-hidden="true" @endif>
                        <img src="{{ asset($slide['img']) }}" alt="{{ $slide['caption'] }}" class="w-full h-full object-cover" @if($i === 0) fetchpriority="high" @else loading="lazy" @endif>
                        <figcaption class="absolute inset-x-0 bottom-0 p-5 pt-16 bg-gradient-to-t from-[#023047]/95 via-[#023047]/60 to-transparent text-left">
                            <span class="inline-block px-2.5 py-1 rounded-md bg-[#ffb703] text-[#023047] text-[11px] font-bold uppercase tracking-wider">{{ $slide['tag'] }}</span>
                            <p class="mt-2 text-sm text-white font-medium">{{ $slide['caption'] }}</p>
                        </figcaption>
                    </figure>
                    @endforeach
                </div>
                <div class="relative mt-4 flex items-center justify-center gap-2">
                    @foreach($heroSlides as $i => $slide)
                    <button type="button" class="hero-dot h-2.5 rounded-full transition-all {{ $i === 0 ? 'w-8 bg-[#ffb703]' : 'w-2.5 bg-white/30 hover:bg-white/60' }}" data-index="{{ $i }}" aria-label="Tampilkan slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto">
            <!-- Verified Key Proof Strip -->
            <div class="mt-14 pt-10 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 border-t border-[#8ecae6]/15 text-left">
                <div class="p-4 rounded-xl bg-[#023047]/60 border border-[#8ecae6]/20">
                    <p class="text-2xl sm:text-3xl font-black text-[#8ecae6]">{{ $totalSchools }}+</p>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium">Sekolah Mitra Terverifikasi</p>
                </div>
                <div class="p-4 rounded-xl bg-[#023047]/60 border border-[#8ecae6]/20">
                    <p class="text-2xl sm:text-3xl font-black text-[#ffb703]">{{ number_format($totalDeals, 0, ',', '.') }}+</p>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium">Kontrak SP Terlaksana</p>
                </div>
                <div class="p-4 rounded-xl bg-[#023047]/60 border border-[#8ecae6]/20">
                    <p class="text-2xl sm:text-3xl font-black text-[#fb8500]">{{ count($categories) }} Pilar</p>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium">Solusi Edukasi Digital</p>
                </div>
                <div class="p-4 rounded-xl bg-[#023047]/60 border border-[#8ecae6]/20">
                    <p class="text-2xl sm:text-3xl font-black text-[#219ebc]">100%</p>
                    <p class="text-xs sm:text-sm text-slate-300 font-medium">Kurikulum Merdeka & P5</p>
                </div>
            </div>

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
            {{ str_replace('{jumlah}', $totalSchools, $hp['sections']['partners']['title']) }}
        </p>
    </div>

    <!-- Infinite Marquee Row 1 -->
    <div class="flex whitespace-nowrap overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex gap-4 animate-marquee-left">
            @foreach($partners->take(20) as $school)
            <div class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-slate-50 border border-[#8ecae6]/40 shadow-xs hover:border-[#219ebc] hover:bg-sky-50/50 transition-all shrink-0">
                <div class="w-8 h-8 rounded-lg bg-[#219ebc]/10 text-[#219ebc] flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $school->level ?? 'SCH' }}
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-[#023047] leading-tight">{{ $school->name }}</p>
                    <p class="text-[10px] text-slate-500">{{ $school->city ?? 'Indonesia' }} · {{ $school->total_deals }} Program</p>
                </div>
            </div>
            @endforeach
            {{-- Duplicated for seamless loop --}}
            @foreach($partners->take(20) as $school)
            <div class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-slate-50 border border-[#8ecae6]/40 shadow-xs hover:border-[#219ebc] hover:bg-sky-50/50 transition-all shrink-0" aria-hidden="true">
                <div class="w-8 h-8 rounded-lg bg-[#219ebc]/10 text-[#219ebc] flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $school->level ?? 'SCH' }}
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-[#023047] leading-tight">{{ $school->name }}</p>
                    <p class="text-[10px] text-slate-500">{{ $school->city ?? 'Indonesia' }} · {{ $school->total_deals }} Program</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Infinite Marquee Row 2 (Reverse direction) -->
    <div class="flex whitespace-nowrap overflow-hidden mt-4 [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="flex gap-4 animate-marquee-right">
            @foreach($partners->skip(20)->take(20) as $school)
            <div class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-slate-50 border border-[#8ecae6]/40 shadow-xs hover:border-[#fb8500] hover:bg-amber-50/50 transition-all shrink-0">
                <div class="w-8 h-8 rounded-lg bg-[#ffb703]/20 text-[#023047] flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $school->level ?? 'SCH' }}
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-[#023047] leading-tight">{{ $school->name }}</p>
                    <p class="text-[10px] text-slate-500">{{ $school->city ?? 'Indonesia' }} · {{ $school->total_deals }} Program</p>
                </div>
            </div>
            @endforeach
            {{-- Duplicated for seamless loop --}}
            @foreach($partners->skip(20)->take(20) as $school)
            <div class="inline-flex items-center gap-3 px-5 py-3 rounded-xl bg-slate-50 border border-[#8ecae6]/40 shadow-xs hover:border-[#fb8500] hover:bg-amber-50/50 transition-all shrink-0" aria-hidden="true">
                <div class="w-8 h-8 rounded-lg bg-[#ffb703]/20 text-[#023047] flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $school->level ?? 'SCH' }}
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-[#023047] leading-tight">{{ $school->name }}</p>
                    <p class="text-[10px] text-slate-500">{{ $school->city ?? 'Indonesia' }} · {{ $school->total_deals }} Program</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ============================================
     PRODUK PLATFORM LMS ERLASS ACADEMY
     ============================================ -->
@php
    $lmsHome = config('erlass.lms');
@endphp
@if($hp['sections']['produk']['visible'] ?? true)
<section id="produk" class="py-24 bg-white relative" aria-labelledby="lms-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                {{ $hp['sections']['produk']['badge'] }}
            </div>
            <h2 id="lms-heading" class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                {{ $hp['sections']['produk']['title'] }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                {{ $hp['sections']['produk']['subtitle'] }}
            </p>
        </div>

        {{-- Free teacher resource hub --}}
        @if($resourceHub)
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#023047] to-[#219ebc] text-white p-6 sm:p-10 mb-8 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-6 items-center">
            <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="relative">
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-400 text-[#023047] text-xs font-extrabold uppercase tracking-wider">Gratis untuk Guru</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold mt-3">{{ $resourceHub->name }}</h3>
                <p class="text-slate-100 mt-2 max-w-2xl leading-relaxed">{{ $resourceHub->summary }}</p>
            </div>
            <div class="relative flex flex-col sm:flex-row md:flex-col gap-3">
                <a href="{{ $resourceHub->lms_url }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-[#023047] font-bold shadow-md hover:-translate-y-0.5 transition-transform">
                    Akses Gratis Sekarang →
                </a>
                <a href="{{ route('products.show', $resourceHub->slug) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 font-bold text-sm transition-colors">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endif

        {{-- Product groups --}}
        @php
            // 1 column: full width · 2: two · 4: four on wide screens · otherwise three per row
            $lmsGrid = match ($lmsGroups->count()) {
                1 => '',
                2 => 'lg:grid-cols-2',
                4 => 'lg:grid-cols-2 xl:grid-cols-4',
                default => 'lg:grid-cols-3',
            };
        @endphp
        <div class="grid grid-cols-1 {{ $lmsGrid }} gap-6">
            @foreach($lmsGroups as $group)
                @php $items = $group->products; @endphp
                <div class="bg-slate-50 rounded-3xl border border-slate-200/80 p-6 flex flex-col">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-2.5 h-8 rounded-full" style="background: {{ $group->color }}"></span>
                        <h3 class="text-lg font-extrabold text-[#023047]">{{ $group->title }}</h3>
                    </div>
                    @if($group->description)<p class="text-sm text-slate-600 leading-relaxed mb-5">{{ $group->description }}</p>@else<div class="mb-3"></div>@endif
                    <ul class="space-y-3 flex-1">
                        @foreach($items as $item)
                        <li>
                            <a href="{{ route('products.show', $item->slug) }}" class="group flex items-center gap-4 p-2.5 pr-4 rounded-2xl bg-white border border-slate-200/80 hover:border-[#219ebc] hover:shadow-md transition-all">
                                <img src="{{ $item->cover_url }}" alt="" width="48" height="64" loading="lazy" class="w-12 h-16 rounded-lg object-cover ring-1 ring-slate-200 shrink-0">
                                <span class="flex-1 min-w-0">
                                    <span class="block text-sm font-bold text-[#023047] group-hover:text-[#219ebc] leading-snug">{{ $item->name }}</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">{{ $item->levels_label }}</span>
                                </span>
                                @if($item->on_shopee)
                                <span class="shrink-0 inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#ee4d2d]/10 text-[#ee4d2d] text-[10px] font-bold" title="Tersedia di Shopee Erlass">
                                    @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-3 h-3']) Shopee
                                </span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('products.index', ['tersedia' => 'lms']) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#023047] hover:bg-[#219ebc] text-white font-bold text-sm shadow-md transition-colors">
                Lihat Semua Produk LMS
            </a>
            <a href="{{ $lmsHome }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 hover:border-[#219ebc] text-[#023047] font-bold text-sm transition-colors">
                Masuk ke erlass.academy ↗
            </a>
        </div>
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
                {{ $hp['sections']['solutions']['badge'] }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                {{ $hp['sections']['solutions']['title'] }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                {{ $hp['sections']['solutions']['subtitle'] }}
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
                    <span class="text-xs font-bold text-[#219ebc] uppercase tracking-wider">Solusi 01</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Coding & Informatika</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Kurikulum koding visual Scratch, Python tingkat lanjut, dan buku kerja informatika berjenjang dari kelas 1 SD hingga SMA.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> Ekskul Coding Scratch & Python
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> Modul Belajar LKPD TIK Jilid 1–6
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#219ebc] font-bold">✓</span> Projek Portofolio & Game Coding
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#219ebc] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>Minta Penawaran Program</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 2: Robotic & Micro:bit -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#fb8500]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#fb8500]/15 text-[#fb8500] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#fb8500] uppercase tracking-wider">Solusi 02</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Robotic & Micro:bit</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Eksplorasi rekayasa robotika praktis dengan Micro:bit Learning Kit, Erboblox, Jimu Robot, dan mikrokontroler sensor IoT.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> Paket Kit Micro:bit & Aksesoris
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> Robotik Explorer & Erboblox
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#fb8500] font-bold">✓</span> Praktik Sensor & Mekatronika
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#fb8500] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>Minta Penawaran Program</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 3: Erlass Academy LMS -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#023047]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#8ecae6]/30 text-[#023047] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#023047] uppercase tracking-wider">Solusi 03</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Erlass Academy LMS</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Platform manajemen pembelajaran modern untuk monitoring kemajuan belajar siswa, tugas, bank soal digital, dan rapor berkala.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> Manajemen Kelas & Materi Digital
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> Bank Soal & Ujian CBT Sekolah
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#023047] font-bold">✓</span> Dashboard Analitik Kepala Sekolah
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#023047] hover:text-[#219ebc] pt-4 border-t border-slate-100 transition-colors">
                    <span>Minta Penawaran Program</span>
                    <span class="text-sm">→</span>
                </a>
            </div>

            <!-- Solution 4: Student Assessment -->
            <div class="product-card bg-white rounded-2xl p-7 border border-slate-200/80 flex flex-col justify-between shadow-xs hover:border-[#ffb703]/60">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#ffb703]/20 text-[#b47a00] flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-[#b47a00] uppercase tracking-wider">Solusi 04</span>
                    <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">Student Assessment</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Asesmen Potensi, Minat, dan Bakat (PMB) siswa dari kelas 1 hingga 12 untuk panduan penjurusan akademik dan karier masa depan.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> Pemetaan Psikometrik Ilmiah
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> Laporan Individual per Siswa
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#b47a00] font-bold">✓</span> Rekomendasi Konseling & Penjurusan
                        </li>
                    </ul>
                </div>
                <a href="#contact" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#b47a00] hover:text-[#023047] pt-4 border-t border-slate-100 transition-colors">
                    <span>Minta Penawaran Program</span>
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
        ['title' => 'Kurikulum Terstruktur', 'desc' => 'Materi berjenjang dari dasar logika hingga proyek nyata, selaras dengan capaian Kurikulum Merdeka dan P5.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['title' => 'Instruktur Profesional', 'desc' => 'Pengajar berpengalaman dan tersertifikasi yang hadir langsung di sekolah maupun secara daring.', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
        ['title' => 'Pembelajaran Interaktif', 'desc' => 'Belajar sambil praktik: membuat game, merakit robot, dan memprogram perangkat secara langsung.', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664zM21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['title' => 'Sertifikat Pembelajaran', 'desc' => 'Setiap siswa yang menuntaskan program mendapatkan sertifikat sebagai bukti kompetensi dan portofolio.', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
        ['title' => 'Pendampingan Program Sekolah', 'desc' => 'Tim Erlass mendampingi sekolah mulai dari perencanaan, pelaksanaan, hingga evaluasi program secara berkala.', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
    ];
@endphp
@if($hp['sections']['tentang']['visible'] ?? true)
<section id="tentang" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#ffb703]/20 text-[#023047] text-xs font-bold tracking-wider uppercase">
                    {{ $hp['sections']['tentang']['badge'] }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">
                    {{ $hp['sections']['tentang']['title'] }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ $hp['sections']['tentang']['subtitle'] }}
                </p>
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                    <img src="{{ asset('img/gallery/teamwork.webp') }}" alt="Siswa bekerja sama dalam proyek teknologi" class="w-full h-56 object-cover" loading="lazy">
                </div>
                <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#023047] hover:bg-[#219ebc] text-white font-bold text-sm shadow-md transition-all">
                    <span>Jadwalkan Konsultasi Sekolah</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Keunggulan Erlass -->
            <div class="lg:col-span-7" id="keunggulan">
                <h3 class="text-sm font-bold uppercase tracking-wider text-[#219ebc] mb-5">Keunggulan Erlass</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach($advantages as $i => $adv)
                    <div class="{{ $loop->last ? 'sm:col-span-2 bg-gradient-to-r from-[#023047] to-[#219ebc] text-white border-transparent shadow-md' : 'bg-slate-50 border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md' }} p-6 rounded-2xl border transition-all">
                        <div class="w-11 h-11 rounded-xl {{ $loop->last ? 'bg-white/10 text-[#ffb703]' : 'bg-[#8ecae6]/25 text-[#219ebc]' }} flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $adv['icon'] }}"></path></svg>
                        </div>
                        <h4 class="text-base font-bold {{ $loop->last ? 'text-white' : 'text-[#023047]' }} mb-2">{{ $adv['title'] }}</h4>
                        <p class="text-sm leading-relaxed {{ $loop->last ? 'text-slate-100' : 'text-slate-600' }}">{{ $adv['desc'] }}</p>
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
                    {{ $hp['sections']['why-erlass']['badge'] }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">
                    {{ $hp['sections']['why-erlass']['title'] }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ $hp['sections']['why-erlass']['subtitle'] }}
                </p>

                {{-- Switch the right-hand panel between the 5 pillars and Erlass videos --}}
                @if($whyVideos)
                <div class="flex flex-wrap gap-3" role="group" aria-label="Tampilkan pilar atau video Erlass">
                    <button type="button" data-why-tab="pillars" aria-pressed="true" class="why-tab group w-28 rounded-xl border-2 p-1.5 text-left bg-white border-slate-200 hover:border-[#219ebc] aria-pressed:border-[#fb8500] aria-pressed:shadow-md transition-all">
                        <span class="flex items-center justify-center h-14 rounded-lg bg-gradient-to-br from-[#023047] to-[#219ebc] text-white text-lg font-extrabold">5</span>
                        <span class="block mt-1.5 px-0.5 text-[11px] font-bold text-[#023047] leading-tight">5 Pilar Erlass</span>
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

                <div class="pt-2 flex flex-col items-start gap-3">
                    <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#023047] hover:bg-[#219ebc] text-white font-bold text-sm shadow-md transition-all">
                        <span>Jadwalkan Konsultasi Sekolah</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 hover:border-[#219ebc] text-[#023047] font-bold text-sm shadow-xs transition-all">
                        <svg class="w-4 h-4 text-[#219ebc]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.6-4.6a2 2 0 012.8 0L16 16m-2-2l1.6-1.6a2 2 0 012.8 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Dokumentasi Kegiatan</span>
                    </a>
                </div>
            </div>

            <!-- 5 Pillars Grid -->
            <div class="lg:col-span-7" data-why-panel>
            <div data-why-pillars class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <!-- Pilar 1 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Kurikulum Adaptif</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Terstruktur dari dasar logika hingga implementasi nyata, selaras dengan capaian pembelajaran Kurikulum Merdeka dan P5.
                    </p>
                </div>

                <!-- Pilar 2 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Platform Digital Terintegrasi</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Dilengkapi LMS Erlass Academy untuk memantau kehadiran, progres materi, submission tugas, dan asesmen secara real-time.
                    </p>
                </div>

                <!-- Pilar 3 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Perangkat Pembelajaran Lengkap</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Penyediaan learning kit Micro:bit, robotik Erboblox/Jimu, serta modul cetak dan panduan praktikum resmi tanpa membebani sekolah.
                    </p>
                </div>

                <!-- Pilar 4 -->
                <div class="p-6 rounded-2xl bg-white border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        4
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Pendampingan & Pembinaan Guru</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Instruktur berpengalaman mengajar langsung ke sekolah didampingi sertifikasi dan pelatihan ToT (Training of Trainer) berkala bagi guru.
                    </p>
                </div>

                <!-- Pilar 5 (Spans 2 columns) -->
                <div class="sm:col-span-2 p-6 rounded-2xl bg-gradient-to-r from-[#023047] to-[#219ebc] text-white shadow-md">
                    <div class="w-10 h-10 rounded-lg bg-white/10 text-[#8ecae6] flex items-center justify-center font-bold mb-4">
                        5
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Ekosistem Belajar Berkelanjutan</h3>
                    <p class="text-slate-100 text-xs leading-relaxed">
                        Menghubungkan sekolah dengan kompetisi koding & robotika nasional, pameran karya siswa, seminar edukasi, dan jejaring komunitas sekolah se-Indonesia.
                    </p>
                </div>

            </div>

            {{-- Video player: replaces the pillar cards while a video tab is active --}}
            <div data-why-player class="hidden">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-[#023047] shadow-xl" data-why-frame></div>
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-sm font-bold text-[#023047]" data-why-title></p>
                    <button type="button" data-why-close class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">← Kembali ke 5 Pilar</button>
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
            'title' => 'Program untuk Sekolah', 'audience' => 'Kepala Sekolah & Yayasan', 'span' => 'lg:col-span-2', 'accent' => '#219ebc',
            'desc' => 'Paket implementasi pembelajaran teknologi menyeluruh: kurikulum, perangkat, LMS, dan evaluasi program.',
            'points' => ['Perencanaan program tahunan', 'Pengadaan kit & modul', 'Laporan capaian berkala'],
        ],
        [
            'title' => 'Program untuk Guru', 'audience' => 'Guru TIK & Mapel', 'span' => 'lg:col-span-2', 'accent' => '#fb8500',
            'desc' => 'Pelatihan dan sertifikasi guru agar mampu mengajarkan coding dan robotika secara mandiri.',
            'points' => ['Training of Trainer (ToT)', 'Workshop & webinar rutin', 'Sertifikat pelatihan'],
        ],
        [
            'title' => 'Program untuk Siswa', 'audience' => 'Siswa SD – SMA', 'span' => 'lg:col-span-2', 'accent' => '#b47a00',
            'desc' => 'Kelas pengembangan keterampilan digital, proyek portofolio, dan persiapan kompetisi teknologi.',
            'points' => ['Kelas berjenjang', 'Proyek & portofolio', 'Pembinaan kompetisi'],
        ],
        [
            'title' => 'Program Ekstrakurikuler', 'audience' => 'Di luar jam pelajaran', 'span' => 'lg:col-span-3', 'accent' => '#219ebc',
            'desc' => 'Ekskul Coding & Robotika mingguan dengan instruktur Erlass, lengkap dengan perangkat praktik dan showcase karya di akhir semester.',
            'points' => ['Instruktur datang ke sekolah', 'Perangkat praktik disediakan', 'Showcase & sertifikat'],
        ],
        [
            'title' => 'Program Intrakurikuler', 'audience' => 'Mata Pelajaran', 'span' => 'lg:col-span-3', 'accent' => '#fb8500',
            'desc' => 'Integrasi materi Informatika & Koding-KA ke dalam Mata Pelajaran sesuai Kurikulum Merdeka, didukung buku digital dan LMS.',
            'points' => ['Modul Ajar Guru', 'Materi Siswa', 'Asesmen (Tugas, Kuis, dan Refleksi) terintegrasi LMS', 'Progress Siswa Terpantau', 'Sistem Penilaian Mudah'],
        ],
    ];
@endphp
@if($hp['sections']['program']['visible'] ?? true)
<section id="program" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#fb8500]/10 text-[#fb8500] text-xs font-bold tracking-wider uppercase">
                {{ $hp['sections']['program']['badge'] }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                {{ $hp['sections']['program']['title'] }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                {{ $hp['sections']['program']['subtitle'] }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
            @foreach($eduPrograms as $prog)
            <div class="{{ $prog['span'] }} bg-white rounded-2xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition-all flex flex-col border-t-4" style="border-top-color: {{ $prog['accent'] }}">
                <span class="text-[11px] font-bold uppercase tracking-wider" style="color: {{ $prog['accent'] }}">{{ $prog['audience'] }}</span>
                <h3 class="text-xl font-bold text-[#023047] mt-1 mb-3">{{ $prog['title'] }}</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-5">{{ $prog['desc'] }}</p>
                <ul class="space-y-2 text-sm text-slate-600 mb-6">
                    @foreach($prog['points'] as $point)
                    <li class="flex items-start gap-2"><span class="font-bold" style="color: {{ $prog['accent'] }}">✓</span> {{ $point }}</li>
                    @endforeach
                </ul>
                <a href="#contact" class="mt-auto inline-flex items-center gap-1.5 text-sm font-bold text-[#023047] hover:text-[#219ebc] pt-4 border-t border-slate-100 transition-colors">
                    <span>Konsultasikan Program</span>
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
                {{ $hp['sections']['products']['badge'] }}
            </div>
            <h2 id="products-heading" class="text-3xl font-extrabold text-[#023047] tracking-tight">
                {{ $hp['sections']['products']['title'] }}
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                {{ $hp['sections']['products']['subtitle'] }}
            </p>
        </div>

        <div data-carousel>
            <div class="flex items-center justify-between gap-4 mb-4">
                <p class="text-sm sm:text-base font-semibold text-slate-400" aria-live="polite" data-carousel-status>Halaman 1</p>
                <div class="flex gap-3">
                    <button type="button" data-carousel-prev aria-label="Produk sebelumnya" class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-[#1d4ed8] hover:border-[#1d4ed8] disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center shadow-xs transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" data-carousel-next aria-label="Produk berikutnya" class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-[#1d4ed8] hover:border-[#1d4ed8] disabled:opacity-40 disabled:pointer-events-none flex items-center justify-center shadow-xs transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <ul data-carousel-track class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth py-3 -mx-4 px-4 sm:mx-0 sm:px-0 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" aria-label="Produk unggulan">
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
                Lihat Semua Produk
            </a>
            <a href="{{ config('erlass.shopee') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-slate-100 hover:bg-[#ee4d2d] text-[#023047] hover:text-white font-bold text-base transition-colors">
                @include('partials.brand-icon', ['name' => 'shopee', 'class' => 'w-5 h-5'])
                Belanja di Shopee Erlass
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
                    {{ $hp['sections']['aktivitas']['badge'] }}
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                    {{ $hp['sections']['aktivitas']['title'] }}
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    {{ $hp['sections']['aktivitas']['subtitle'] }}
                </p>
            </div>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-[#8ecae6]/50 text-[#023047] hover:border-[#219ebc] text-sm font-bold shadow-xs transition-all self-start md:self-auto">
                Lihat Semua Artikel →
            </a>
        </div>

        <!-- Row 1: Kompetisi + Info Program Terbaru -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 relative rounded-3xl overflow-hidden min-h-[360px] flex items-end shadow-lg">
                <img src="{{ asset('img/gallery/competition.webp') }}" alt="Siswa merayakan kemenangan kompetisi robotika" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-[#023047] via-[#023047]/70 to-transparent"></div>
                <div class="relative p-7 sm:p-10 space-y-4 text-white max-w-xl">
                    <span class="inline-block px-3 py-1 rounded-md bg-[#ffb703] text-[#023047] text-xs font-bold uppercase tracking-wider">Kompetisi</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold leading-tight">Erlass Coding & Robotic Competition</h3>
                    <p class="text-slate-200 text-sm sm:text-base leading-relaxed">
                        Ajang unjuk karya siswa SD–SMA di bidang coding, Micro:bit, dan robotika. Latih kreativitas, kerja sama tim, dan keberanian tampil.
                    </p>
                    <div class="flex flex-wrap gap-3 pt-1">
                        <a href="#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">Daftarkan Tim Sekolah</a>
                        <a href="{{ route('articles.index', ['kategori' => 'kompetisi']) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-sm transition-colors">Info Kompetisi</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs flex flex-col">
                <h3 class="text-sm font-bold uppercase tracking-wider text-[#fb8500] mb-5">Informasi Program Terbaru</h3>
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
                                <p class="text-[11px] text-slate-500 font-semibold">{{ $info->category_label }} · {{ $info->published_at?->translatedFormat('d M Y') }}</p>
                                <p class="text-sm font-semibold text-[#023047] group-hover:text-[#219ebc] leading-snug mt-1">{{ $info->title }}</p>
                            </a>
                        </li>
                        @empty
                        <li class="text-sm text-slate-500">Belum ada informasi terbaru. Hubungi tim kami untuk jadwal program terkini.</li>
                        @endforelse
                    @endif
                </ul>
                <a href="https://wa.me/{{ config('erlass.whatsapp') }}?text=Halo%20Tim%20Erlass%2C%20saya%20ingin%20info%20program%20terbaru" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba59] text-white font-bold text-sm transition-colors">
                    Tanya via WhatsApp
                </a>
            </div>
        </div>

        <!-- Row 2: Dokumentasi Kegiatan -->
        <div class="mt-16">
            <div class="flex items-center justify-between gap-4 mb-5">
                <h3 class="text-xl font-bold text-[#023047]">Dokumentasi Kegiatan</h3>
                <a href="{{ route('gallery') }}" class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">Lihat Galeri →</a>
            </div>
            @php
                $docPhotos = [
                    ['img' => 'img/gallery/coding-class.webp',   'label' => 'Kelas Coding'],
                    ['img' => 'img/gallery/robotics-class.webp', 'label' => 'Praktik Robotika'],
                    ['img' => 'img/gallery/presentation.webp',   'label' => 'Presentasi Proyek'],
                    ['img' => 'img/gallery/teamwork.webp',       'label' => 'Kerja Tim Siswa'],
                ];
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($docPhotos as $photo)
                <a href="{{ route('gallery') }}" class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-200">
                    <img src="{{ asset($photo['img']) }}" alt="{{ $photo['label'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <span class="absolute left-3 bottom-3 px-2.5 py-1 rounded-md bg-[#023047]/85 text-white text-xs font-semibold">{{ $photo['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Row 3: Berita & Artikel -->
        @if($latestArticles->isNotEmpty())
        <div class="mt-16">
            <h3 class="text-xl font-bold text-[#023047] mb-5">Berita & Artikel</h3>
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
<section id="collaborate" class="py-24 bg-[#023047] text-white relative overflow-hidden">
    <div class="absolute inset-0 hero-grid-pattern opacity-25 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#8ecae6]/20 text-[#8ecae6] text-xs font-bold tracking-wider uppercase">
                {{ $hp['sections']['collaborate']['badge'] }}
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                {{ $hp['sections']['collaborate']['title'] }}
            </h2>
            <p class="text-slate-300 text-base leading-relaxed">
                {{ $hp['sections']['collaborate']['subtitle'] }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Box 1: Sekolah -->
            <div class="p-6 rounded-2xl bg-[#032539]/80 border border-[#8ecae6]/20 flex flex-col justify-between hover:border-[#219ebc] transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-[#219ebc]/20 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Sekolah & Madrasah</h3>
                    <p class="text-slate-300 text-xs leading-relaxed mb-6">
                        Penyelenggaraan ekstrakurikuler koding & robotik, pengadaan modul TIK, dan workshop teknologi terjadwal.
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-[#8ecae6] hover:text-white flex items-center gap-1">
                    <span>Ajukan Kerja Sama Sekolah →</span>
                </a>
            </div>

            <!-- Box 2: Yayasan -->
            <div class="p-6 rounded-2xl bg-[#032539]/80 border border-[#8ecae6]/20 flex flex-col justify-between hover:border-[#ffb703] transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-[#ffb703]/20 text-[#ffb703] flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Yayasan Pendidikan</h3>
                    <p class="text-slate-300 text-xs leading-relaxed mb-6">
                        Standardisasi kurikulum digital multi-cabang sekolah, pemetaan potensi siswa massal, dan LMS terpusat.
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-[#ffb703] hover:text-white flex items-center gap-1">
                    <span>Konsultasi Skala Yayasan →</span>
                </a>
            </div>

            <!-- Box 3: Dinas Pendidikan -->
            <div class="p-6 rounded-2xl bg-[#032539]/80 border border-[#8ecae6]/20 flex flex-col justify-between hover:border-[#fb8500] transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-[#fb8500]/20 text-[#fb8500] flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Dinas Pendidikan</h3>
                    <p class="text-slate-300 text-xs leading-relaxed mb-6">
                        Program literasi komputasi wilayah, pelatihan kompetensi guru TIK, dan kompetisi inovasi teknologi daerah.
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-[#fb8500] hover:text-white flex items-center gap-1">
                    <span>Program Kemitraan Dinas →</span>
                </a>
            </div>

            <!-- Box 4: Mitra Bisnis -->
            <div class="p-6 rounded-2xl bg-[#032539]/80 border border-[#8ecae6]/20 flex flex-col justify-between hover:border-[#8ecae6] transition-all">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-[#8ecae6]/20 text-[#8ecae6] flex items-center justify-center font-bold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Mitra Bisnis & CSR</h3>
                    <p class="text-slate-300 text-xs leading-relaxed mb-6">
                        Penyaluran CSR edukasi teknologi, distributor perangkat belajar, dan kolaborasi strategis industri EdTech.
                    </p>
                </div>
                <a href="#contact" class="text-xs font-bold text-[#8ecae6] hover:text-white flex items-center gap-1">
                    <span>Hubungi Kemitraan Bisnis →</span>
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
                {{ $hp['sections']['contact']['badge'] }}
            </div>
            <h2 class="text-3xl font-extrabold text-[#023047] tracking-tight">
                {{ $hp['sections']['contact']['title'] }}
            </h2>
            <p class="text-slate-600 text-sm max-w-xl mx-auto">
                {{ $hp['sections']['contact']['subtitle'] }}
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200/80 shadow-md">
            
            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-start gap-3" role="alert">
                    <svg class="w-5 h-5 mt-0.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold text-sm">Formulir Terkirim Berhasil</h3>
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
                            Tipe Pengirim / Institusi <span class="text-red-500">*</span>
                        </label>
                        <select id="sender_type" name="sender_type" required class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] bg-white">
                            <option value="school" {{ old('sender_type') == 'school' ? 'selected' : '' }}>Sekolah (Kepala Sekolah / Guru / TIK)</option>
                            <option value="institution" {{ old('sender_type') == 'institution' ? 'selected' : '' }}>Yayasan Pendidikan</option>
                            <option value="education_office" {{ old('sender_type') == 'education_office' ? 'selected' : '' }}>Dinas Pendidikan</option>
                            <option value="business_partner" {{ old('sender_type') == 'business_partner' ? 'selected' : '' }}>Mitra Bisnis / Vendor</option>
                            <option value="parent" {{ old('sender_type') == 'parent' ? 'selected' : '' }}>Orang Tua Siswa</option>
                            <option value="other" {{ old('sender_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Nama Lengkap Kontak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso, S.Pd." class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Phone & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Nomor WhatsApp / Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                        @error('phone')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Alamat Email Resmi
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: sekolah@yayasan.sch.id" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>
                </div>

                <!-- Row 3: School Name, City & Student Count -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label for="school_name" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Nama Sekolah / Instansi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name') }}" required placeholder="Contoh: SDI Teladan Suci" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>

                    <div>
                        <label for="city" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Kota / Kabupaten
                        </label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="Contoh: Jakarta Timur" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>

                    <div>
                        <label for="student_count" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                            Perkiraan Siswa
                        </label>
                        <input type="number" id="student_count" name="student_count" value="{{ old('student_count') }}" placeholder="Contoh: 150" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc]">
                    </div>
                </div>

                <!-- Row 4: Program of Interest -->
                <div>
                    <label for="program-select" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                        Solusi Program yang Diminati
                    </label>
                    <select id="program-select" name="program" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] bg-white">
                        <option value="">-- Pilih Solusi / Kategori --</option>
                        <option value="coding-informatika">Coding & Informatika (Scratch / Python / LKPD)</option>
                        <option value="microbit-robotik">Robotika & Micro:bit Learning Kit</option>
                        <option value="python">Python (SMP – SMA)</option>
                        <option value="web-development">Web Development (HTML, CSS, JavaScript)</option>
                        <option value="erlass-academy-lms">Erlass Academy LMS (Platform Digital Sekolah)</option>
                        <option value="student-assessment">Student Assessment (Asesmen Bakat & Potensi Siswa)</option>
                        <option value="teacher-training">Pelatihan & Pendampingan Guru (ToT)</option>
                        <option value="all-solutions">Paket Solusi Terintegrasi Lengkap</option>
                    </select>
                </div>

                <!-- Row 5: Message / Specific Needs -->
                <div>
                    <label for="message" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                        Rincian Kebutuhan & Catatan Khusus
                    </label>
                    <textarea id="message" name="message" rows="3" placeholder="Jelaskan kebutuhan sekolah Anda, jadwal yang diinginkan, atau pertanyaan spesifik mengenai kurikulum..." class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] resize-none">{{ old('message') }}</textarea>
                </div>

                <!-- Consent UU PDP -->
                <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-50 border border-[#8ecae6]/40">
                    <input type="checkbox" id="consent_given" name="consent_given" value="1" checked required class="mt-0.5 rounded text-[#219ebc] focus:ring-[#219ebc]">
                    <label for="consent_given" class="text-xs text-slate-600 leading-relaxed">
                        Saya menyetujui pemrosesan data kontak di atas oleh PT Erlass Prokreatif Indonesia semata-mata untuk keperluan komunikasi penawaran dan konsultasi pendidikan, sesuai ketentuan <strong class="text-[#023047]">UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)</strong>.
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-base shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                        <span>Kirim Permintaan Konsultasi & Penawaran</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <p class="text-center text-xs text-slate-500 mt-3 font-medium">
                        Tim konsultan pendidikan kami akan menghubungi via WhatsApp atau email dalam 1x24 jam kerja.
                    </p>
                </div>

            </form>

        </div>

    </div>
</section>
@endif

<script>
    // Hero photo slider: auto-rotates, pauses on hover/focus, respects reduced motion
    (function () {
        const root = document.getElementById('hero-slider');
        if (!root) return;
        const slides = root.querySelectorAll('.hero-slide');
        const dots = root.querySelectorAll('.hero-dot');
        if (slides.length < 2) return;
        let current = 0, timer = null;

        function show(i) {
            current = (i + slides.length) % slides.length;
            slides.forEach(function (s, idx) {
                const on = idx === current;
                s.classList.toggle('opacity-100', on);
                s.classList.toggle('opacity-0', !on);
                s.setAttribute('aria-hidden', on ? 'false' : 'true');
            });
            dots.forEach(function (d, idx) {
                const on = idx === current;
                d.classList.toggle('w-8', on);
                d.classList.toggle('bg-[#ffb703]', on);
                d.classList.toggle('w-2.5', !on);
                d.classList.toggle('bg-white/30', !on);
                d.setAttribute('aria-current', on ? 'true' : 'false');
            });
        }
        function start() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            stop();
            timer = setInterval(function () { show(current + 1); }, 5000);
        }
        function stop() { if (timer) clearInterval(timer); timer = null; }

        dots.forEach(function (d) {
            d.addEventListener('click', function () { show(Number(d.dataset.index)); start(); });
        });
        root.addEventListener('mouseenter', stop);
        root.addEventListener('mouseleave', start);
        root.addEventListener('focusin', stop);
        root.addEventListener('focusout', start);
        start();
    })();

</script>

@endsection
