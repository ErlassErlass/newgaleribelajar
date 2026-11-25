@extends('layouts.app')

@php
    $lmsUrl = config('erlass.lms');
    $productCount = $lmsGroups->sum(fn ($g) => $g->products->count());
@endphp

@section('title', __('LMS Erlass Academy – Intrakurikuler, Course & Asesmen untuk Sekolah'))
@section('description', __('LMS Erlass Academy: materi Intrakurikuler Informatika & Koding KA, course berbasis proyek (Scratch, Micro:bit, Python, HTML), dan asesmen potensi, minat & bakat siswa SD, SMP, SMA.'))
@section('keywords', __('lms erlass academy, lms sekolah, informatika sd smp sma, koding kecerdasan artifisial, course scratch, course python, asesmen minat bakat siswa'))
@section('canonical', route('lms.index'))

@section('content')

{{-- Hero: light sky-blue → white → warm yellow, no dark blocks --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#8ecae6]/35 via-white to-[#ffb703]/20 border-b border-[#8ecae6]/40">
    <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-[#ffb703]/25 blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute -bottom-28 -left-20 w-80 h-80 rounded-full bg-[#219ebc]/20 blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-14 sm:pt-20 sm:pb-16 text-center">
        <span class="lms-badge inline-flex items-center gap-2 pl-2 pr-2.5 py-1.5 rounded-full text-white text-sm font-extrabold">
            <span class="grid place-items-center w-6 h-6 rounded-full bg-white/25" aria-hidden="true">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4L2 9l10 5 10-5-10-5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 11v4.5c0 1.4 2.7 3 6 3s6-1.6 6-3V11"/></svg>
            </span>
            {{ __('LMS Erlass Academy') }}
            <span class="px-1.5 py-0.5 rounded-full bg-[#ffb703] text-[#023047] text-[10px] uppercase tracking-wider">{{ __('navbar.lms_new') }}</span>
        </span>

        <h1 class="mt-6 text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#023047] tracking-tight leading-tight">
            {{ __('Belajar Informatika & Koding') }}<br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#219ebc] via-[#1a87a6] to-[#fb8500]">{{ __('Lebih Mudah, Kapan Saja') }}</span>
        </h1>
        <p class="mt-5 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
            {{ __('Materi intrakurikuler siap pakai, course berbasis proyek, dan asesmen bakat siswa dalam satu platform. Guru tinggal mengajar, siswa belajar dengan seru.') }}
        </p>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ $lmsUrl }}" target="_blank" rel="noopener" class="lms-cta inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-white font-extrabold shadow-md">
                {{ __('navbar.lms_cta') }}
                <svg class="lms-cta-arrow w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-white border-2 border-[#8ecae6] hover:border-[#219ebc] text-[#023047] font-bold transition-colors">
                {{ __('Konsultasi untuk Sekolah') }}
            </a>
        </div>

        {{-- Jump links: one per column, with its product count highlighted --}}
        <div class="mt-10">
            @include('partials.lms-jump', ['jumpBase' => ''])
        </div>
    </div>
</section>

<section class="py-16 sm:py-20 bg-white" aria-label="{{ __('Produk LMS') }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($lmsGroups->isEmpty() && ! $resourceHub)
            <p class="text-center text-slate-500">{{ __('Produk LMS segera hadir. Hubungi kami untuk informasi terbaru.') }}</p>
        @else
            @include('partials.lms-hub')
            @include('partials.lms-groups')
        @endif

        <div class="mt-12 rounded-3xl bg-gradient-to-r from-[#8ecae6]/30 via-white to-[#ffb703]/25 border border-[#8ecae6]/50 p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-5 text-center md:text-left">
            <div>
                <p class="text-xl font-extrabold text-[#023047]"><span class="text-[#fb8500]">{{ $productCount }}+</span> {{ __('produk digital siap dipakai sekolah Anda') }}</p>
                <p class="text-sm text-slate-600 mt-1">{{ __('Bandingkan semua produk LMS lengkap dengan filter jenjang di katalog.') }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                <a href="{{ route('products.index', ['tersedia' => 'lms']) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#219ebc] hover:bg-[#1a87a6] text-white font-bold text-sm shadow-md transition-colors">{{ __('navbar.lms_all') }}</a>
                <a href="{{ $lmsUrl }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white border border-[#8ecae6] hover:border-[#219ebc] text-[#023047] font-bold text-sm transition-colors">{{ __('Masuk ke erlass.academy ↗') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection
