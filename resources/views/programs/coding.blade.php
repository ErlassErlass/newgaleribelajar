@extends('layouts.app')

@section('title', 'Kurikulum Koding & Informatika Sekolah - Solusi Erlass')
@section('description', 'Kurikulum Informatika terstruktur berbasis Scratch, Python, dan Computational Thinking untuk jenjang SD, SMP, hingga SMA.')

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-[#023047] text-white overflow-hidden hero-grid-pattern">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#219ebc]/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 backdrop-blur border border-[#8ecae6]/30 text-[#8ecae6] text-xs font-bold tracking-wider uppercase">
            <span>Solusi Kurikulum Sekolah</span>
        </div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight">
            Kurikulum Koding & Informatika Terstruktur
        </h1>
        <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Membekali siswa dari jenjang dasar hingga menengah dengan keterampilan computational thinking, logika pemrograman, dan pembuatan proyek perangkat lunak nyata.
        </p>
    </div>
</section>

<!-- Learning Levels -->
<section class="py-16 sm:py-24 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Alur Jenjang Belajar</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">Pembelajaran Bertahap Berdasarkan Perkembangan Usia</h2>
            <p class="text-slate-600 text-sm mt-2">Mulai dari konsep visual blok logika hingga sintaks pemrograman berbasis teks standar industri.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Level 1 -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-[#219ebc] shadow-sm hover:shadow-lg transition-all group">
                <span class="inline-block px-3 py-1 rounded bg-[#8ecae6]/20 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Jenjang Dasar (SD 1-3)</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">Visual Logic & Block Coding</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Membangun fondasi logika berpikir komputasional melalui pembuatan animasi dan cerita interaktif tanpa hambatan sintaks.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Pengenalan urutan (sequencing) & loop</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Scratch Jr & antarmuka visual</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Buku aktivitas & panduan guru lengkap</span>
                    </li>
                </ul>
            </div>

            <!-- Level 2 -->
            <div class="bg-white rounded-2xl p-8 border-2 border-[#219ebc] shadow-md hover:shadow-xl transition-all group relative">
                <div class="absolute -top-3 right-6 bg-[#fb8500] text-white text-[11px] font-bold px-3 py-0.5 rounded-full uppercase tracking-wider">
                    Paling Banyak Diadopsi
                </div>
                <span class="inline-block px-3 py-1 rounded bg-[#219ebc]/10 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Jenjang Lanjutan (SD 4-6 & SMP)</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">Game Development & Computational Thinking</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Menerapkan konsep algoritma, variabel, percabangan kondisi, dan koordinat untuk memprogram game mandiri.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Scratch 3.0 & logika modular</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Variabel kondisi, broadcast pesan & kloning</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>LKPD terstruktur & rubrik asesmen</span>
                    </li>
                </ul>
            </div>

            <!-- Level 3 -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-[#219ebc] shadow-sm hover:shadow-lg transition-all group">
                <span class="inline-block px-3 py-1 rounded bg-[#8ecae6]/20 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Jenjang Menengah (SMP & SMA)</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">Python & Text-Based Programming</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Transisi menuju bahasa pemrograman profesional dengan pemecahan masalah matematika, analisis data, dan otomatisasi.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Sintaks Python fundamental & struktur data</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Integrasi Micro:bit & sensor hardware</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Persiapan kompetisi & portofolio digital</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Tools & Ecosystem -->
<section class="py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <span class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-6 block">Platform & Alat yang Digunakan</span>
        <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6">
            <span class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 text-xs font-bold text-[#023047] shadow-sm">MIT Scratch 3.0</span>
            <span class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 text-xs font-bold text-[#023047] shadow-sm">Python 3.x</span>
            <span class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 text-xs font-bold text-[#023047] shadow-sm">BBC micro:bit</span>
            <span class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 text-xs font-bold text-[#023047] shadow-sm">MakeCode Editor</span>
            <span class="px-5 py-2.5 bg-white rounded-xl border border-slate-200 text-xs font-bold text-[#023047] shadow-sm">Erlass Academy LMS</span>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 sm:py-20 bg-[#023047] text-white text-center">
    <div class="max-w-3xl mx-auto px-4 space-y-6">
        <h2 class="text-2xl sm:text-3xl font-extrabold">Tertarik Mengadopsi Kurikulum Koding di Sekolah Anda?</h2>
        <p class="text-sm sm:text-base text-slate-300">Tim akademik Erlass menyediakan silabus komprehensif, sampel buku materi, dan pelatihan pendampingan bagi guru pengampu.</p>
        <div>
            <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-8 py-3.5 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-lg hover:shadow-orange-500/25 transition-all duration-200">
                Konsultasikan Kurikulum Sekolah
            </a>
        </div>
    </div>
</section>

@endsection
