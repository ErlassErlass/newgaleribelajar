@extends('layouts.app')

@section('title', $program->name . ' - Solusi Pendidikan Erlass')
@section('description', $program->short_description ?? 'Program solusi pendidikan unggulan PT Erlass Prokreatif Indonesia.')

@section('content')
<!-- Back to home floating action -->
<div class="fixed top-24 left-4 sm:left-8 z-50">
    <a href="{{ route('home') }}#programs" class="group flex items-center justify-center w-11 h-11 bg-white rounded-xl shadow-md border border-slate-200 text-[#023047] hover:border-[#219ebc] hover:text-[#219ebc] transition-all duration-200">
        <svg class="w-5 h-5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
</div>

<main class="pt-20 bg-slate-50 min-h-screen">
    <!-- Header Banner -->
    <section class="relative bg-[#023047] text-white pt-24 pb-32 overflow-hidden hero-grid-pattern">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#219ebc]/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-[#8ecae6]/30 text-[#8ecae6] text-xs font-bold tracking-wider uppercase mb-6">
                <span>Solusi Pendidikan Terintegrasi</span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                {{ $program->name }}
            </h1>
            <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                {{ $program->short_description }}
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-30">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-12">
                @if($program->thumbnail_image)
                    <div class="mb-8 rounded-xl overflow-hidden aspect-video bg-slate-100 border border-slate-200">
                        <img src="{{ asset('storage/' . $program->thumbnail_image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="prose max-w-none text-slate-700 leading-relaxed space-y-6">
                    @if($program->content)
                        {!! $program->content !!}
                    @else
                        <div class="text-center py-12 text-slate-400">
                            <p>Informasi kurikulum dan silabus lengkap sedang diperbarui oleh tim akademik Erlass.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Lead Consultation CTA -->
            <div class="mt-12 bg-white rounded-2xl p-8 sm:p-10 border border-[#8ecae6]/50 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="text-center sm:text-left">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Konsultasi Kurikulum</span>
                    <h3 class="text-xl font-extrabold text-[#023047] mt-1">Implementasikan {{ $program->name }} di Sekolah Anda</h3>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-md">Diskusikan kebutuhan pelatihan guru, pengadaan perangkat, serta silabus terintegrasi bersama tim kami.</p>
                </div>
                <a href="{{ route('home') }}#contact" class="px-6 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow hover:shadow-orange-500/25 shrink-0 transition-all duration-200">
                    Ajukan Penawaran
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
