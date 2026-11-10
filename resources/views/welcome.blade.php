@extends('layouts.app')

@section('title', 'Erlass - Solusi Pembelajaran Coding, Robotik, LMS & Asesmen Sekolah')

@section('content')

<!-- ============================================
     HERO SECTION — Professional EdTech Corporate
     Colors: #023047 (Navy) · #219ebc (Cyan) · #8ecae6 (Sky) · #ffb703 (Amber) · #fb8500 (Orange)
     ============================================ -->
<section class="relative bg-gradient-to-b from-[#023047] via-[#032539] to-[#021f30] text-white pt-24 pb-20 overflow-hidden">
    <!-- Subtle Background Grid & Glow -->
    <div class="absolute inset-0 hero-grid-pattern opacity-40 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[#219ebc]/20 blur-[120px] rounded-full pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-4xl mx-auto space-y-6">
            
            <!-- Category Tag Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#023047]/90 border border-[#8ecae6]/30 text-[#8ecae6] text-xs sm:text-sm font-semibold tracking-wide shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[#ffb703] animate-pulse"></span>
                <span>Mitra Resmi Transformasi Digital Sekolah di Indonesia</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                Mempersiapkan Generasi Masa Depan Melalui <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8ecae6] via-[#219ebc] to-[#ffb703]">Teknologi dan Inovasi</span>
            </h1>

            <!-- Tagline / Subtitle -->
            <p class="text-base sm:text-xl text-slate-300 leading-relaxed max-w-3xl mx-auto font-normal">
                Solusi pembelajaran terintegrasi: <strong class="text-white font-semibold">Coding, Robotik, Informatika, Kecerdasan Artifisial, Asesmen Bakat, dan LMS</strong> berstandar Kurikulum Merdeka untuk jenjang SD, SMP, hingga SMA.
            </p>

            <!-- Dual CTAs -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#solutions" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-[#219ebc] to-[#0284c7] hover:from-[#1b859f] hover:to-[#026c9c] text-white font-bold text-base shadow-lg hover:shadow-cyan-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Jelajahi Solusi Pendidikan</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <a href="#contact" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-[#fb8500] to-[#ffb703] hover:from-[#e07600] hover:to-[#e6a500] text-white font-bold text-base shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Konsultasi Sekolah</span>
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Verified Key Proof Strip -->
            <div class="pt-12 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 border-t border-[#8ecae6]/15 text-left">
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
<section id="partners" class="py-12 bg-white border-y border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
        <p class="text-xs font-bold uppercase tracking-widest text-[#023047]/60">
            Telah Dipercaya oleh {{ $totalSchools }}+ Sekolah Unggulan di Seluruh Indonesia
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

<!-- ============================================
     SECTION 1: OUR EDUCATION SOLUTIONS (4 Solusi Utama)
     ============================================ -->
<section id="solutions" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                Our Education Solutions
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight">
                Solusi Pendidikan Terintegrasi untuk Sekolah Anda
            </h2>
            <p class="text-slate-600 text-base leading-relaxed">
                Dirancang spesifik untuk mendukung peningkatan mutu akademik, literasi teknologi, dan pemetaan potensi siswa secara menyeluruh.
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

<!-- ============================================
     SECTION 2: WHY ERLASS? 5 PILAR SOLUSI PENDIDIKAN
     ============================================ -->
<section id="why-erlass" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#ffb703]/20 text-[#023047] text-xs font-bold tracking-wider uppercase">
                    Why Erlass?
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#023047] tracking-tight leading-tight">
                    Bukan Sekadar Produk, Tetapi Solusi Pendidikan
                </h2>
                <p class="text-slate-600 text-base leading-relaxed">
                    Erlass memadukan kurikulum berstandar Kurikulum Merdeka, perangkat praktikum teruji, dan pendampingan instruktur berpengalaman agar program teknologi di sekolah Anda berjalan konsisten dan terukur.
                </p>
                <div class="pt-2">
                    <a href="#contact" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#023047] hover:bg-[#219ebc] text-white font-bold text-sm shadow-md transition-all">
                        <span>Jadwalkan Konsultasi Sekolah</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- 5 Pillars Grid -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <!-- Pilar 1 -->
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Kurikulum Adaptif</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Terstruktur dari dasar logika hingga implementasi nyata, selaras dengan capaian pembelajaran Kurikulum Merdeka dan P5.
                    </p>
                </div>

                <!-- Pilar 2 -->
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Platform Digital Terintegrasi</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Dilengkapi LMS Erlass Academy untuk memantau kehadiran, progres materi, submission tugas, dan asesmen secara real-time.
                    </p>
                </div>

                <!-- Pilar 3 -->
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-lg bg-[#8ecae6]/25 text-[#219ebc] flex items-center justify-center font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-base font-bold text-[#023047] mb-2">Perangkat Pembelajaran Lengkap</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Penyediaan learning kit Micro:bit, robotik Erboblox/Jimu, serta modul cetak dan panduan praktikum resmi tanpa membebani sekolah.
                    </p>
                </div>

                <!-- Pilar 4 -->
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:bg-white hover:border-[#219ebc]/40 hover:shadow-md transition-all">
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

        </div>
    </div>
</section>

<!-- ============================================
     SECTION 3: FEATURED PRODUCTS FROM ERLASS CRM
     ============================================ -->
<section id="products" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase mb-3">
                    Katalog Unggulan
                </div>
                <h2 class="text-3xl font-extrabold text-[#023047] tracking-tight">
                    Program & Perangkat Paling Banyak Diminati Sekolah
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Data riil terverifikasi berdasarkan ratusan implementasi SP deal aktif di sekolah mitra Erlass.
                </p>
            </div>
            <div>
                <a href="#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-[#8ecae6]/50 text-[#023047] hover:border-[#219ebc] text-xs font-bold shadow-xs transition-all">
                    <span>Unduh Brosur & Katalog PDF</span>
                    <svg class="w-4 h-4 text-[#219ebc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $prod)
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:border-[#219ebc]/50 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="inline-block px-2.5 py-1 rounded-md bg-[#8ecae6]/20 text-[#023047] font-mono text-[11px] font-bold">
                            {{ $prod->sku }}
                        </span>
                        <span class="text-[11px] font-semibold text-[#fb8500] bg-[#fb8500]/10 px-2.5 py-0.5 rounded-full">
                            {{ $prod->deal_count }}+ Sekolah Deal
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-[#023047] mb-2 leading-snug">
                        {{ $prod->name }}
                    </h3>

                    <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-3">
                        {{ $prod->summary ?? $prod->description }}
                    </p>

                    <div class="flex flex-wrap gap-1 mb-4">
                        @if(is_array($prod->education_levels))
                            @foreach($prod->education_levels as $lvl)
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-[#023047] text-[10px] font-semibold">
                                {{ $lvl }}
                            </span>
                            @endforeach
                        @endif
                        <span class="px-2 py-0.5 rounded bg-[#8ecae6]/30 text-[#023047] text-[10px] font-semibold">
                            {{ $prod->product_type ?? 'Jasa' }}
                        </span>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-auto">
                    <a href="#contact" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-100 hover:bg-[#023047] text-slate-700 hover:text-white font-bold text-xs transition-colors">
                        <span>Pilih Program Ini</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================================
     SECTION 4: LET'S COLLABORATE (Mitra & Institusi)
     ============================================ -->
<section id="collaborate" class="py-24 bg-[#023047] text-white relative overflow-hidden">
    <div class="absolute inset-0 hero-grid-pattern opacity-25 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#8ecae6]/20 text-[#8ecae6] text-xs font-bold tracking-wider uppercase">
                Let's Collaborate
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Mari Wujudkan Transformasi Pendidikan Bersama Erlass
            </h2>
            <p class="text-slate-300 text-base leading-relaxed">
                Kami siap berkolaborasi merancang skema kerja sama yang fleksibel, akuntabel, dan berdampak nyata bagi ekosistem pendidikan Anda.
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

<!-- ============================================
     SECTION 5: LEAD FORM (Konsultasi & Permintaan Penawaran)
     ============================================ -->
<section id="contact" class="py-24 bg-slate-100 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12 space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#219ebc]/10 text-[#219ebc] text-xs font-bold tracking-wider uppercase">
                Konsultasi & Penawaran
            </div>
            <h2 class="text-3xl font-extrabold text-[#023047] tracking-tight">
                Mulai Kolaborasi Bersama Tim Ahli Erlass
            </h2>
            <p class="text-slate-600 text-sm max-w-xl mx-auto">
                Isi formulir di bawah ini. Tim konsultan pendidikan kami akan menghubungi Anda untuk memberikan penjelasan kurikulum, demonstrasi sistem, dan proposal penawaran resmi.
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
                    <label for="program" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-2">
                        Solusi Program yang Diminati
                    </label>
                    <select id="program" name="program" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-slate-800 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] bg-white">
                        <option value="">-- Pilih Solusi / Kategori --</option>
                        <option value="coding-informatika">Coding & Informatika (Scratch / Python / LKPD)</option>
                        <option value="microbit-robotik">Robotic & Micro:bit Learning Kit</option>
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

@endsection
