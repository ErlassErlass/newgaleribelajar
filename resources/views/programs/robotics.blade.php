@extends('layouts.app')

@section('title', 'Solusi Laboratorium Robotik & Micro:bit - Solusi Erlass')
@section('description', 'Perangkat praktik robotika edukasi, modul sensor Micro:bit, dan pelatihan perakitan mekatronika terpadu untuk sekolah.')

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-[#023047] text-white overflow-hidden hero-grid-pattern">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#219ebc]/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
        <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 backdrop-blur border border-[#8ecae6]/30 text-[#8ecae6] text-xs font-bold tracking-wider uppercase">
            <span>Perangkat & Lab Robotik</span>
        </div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight">
            Laboratorium Robotik & Micro:bit Learning Kit
        </h1>
        <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Paket perangkat keras edukatif yang dirancang untuk membimbing siswa memahami mekanisme fisik, aktuator, mikrokontroler, dan integrasi Internet of Things (IoT).
        </p>
    </div>
</section>

<!-- Hardware Highlights -->
<section class="py-16 sm:py-24 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Komponen Pembelajaran</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">Perangkat Siap Pakai & Aman untuk Lingkungan Sekolah</h2>
            <p class="text-slate-600 text-sm mt-2">Setiap unit dirancang modular dengan standar durabilitas tinggi dan panduan langkah demi langkah.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Kit 1 -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-[#219ebc] shadow-sm hover:shadow-lg transition-all group">
                <span class="inline-block px-3 py-1 rounded bg-[#8ecae6]/20 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Pemula</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">Micro:bit Starter Lab Kit</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Board BBC micro:bit v2 dengan modul display LED matriks, sensor accelerometer, kompas, dan radio nirkabel.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Board micro:bit v2 resmi dengan speaker bawaan</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Kabel konektor buaya & baterai pack</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>12 skenario eksperimen sains terpandu</span>
                    </li>
                </ul>
            </div>

            <!-- Kit 2 -->
            <div class="bg-white rounded-2xl p-8 border-2 border-[#219ebc] shadow-md hover:shadow-xl transition-all group">
                <span class="inline-block px-3 py-1 rounded bg-[#219ebc]/10 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Menengah</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">Autonomous Mobile Robot (Smart Car)</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Sasis robot dua roda dengan sensor ultrasonik penghindar rintangan, sensor garis inframerah, dan kontrol kemudi.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Sistem penggerak motor DC presisi</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Algoritma line tracking & obstacle avoidance</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Modul kendali Bluetooth via aplikasi</span>
                    </li>
                </ul>
            </div>

            <!-- Kit 3 -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 hover:border-[#219ebc] shadow-sm hover:shadow-lg transition-all group">
                <span class="inline-block px-3 py-1 rounded bg-[#8ecae6]/20 text-[#023047] text-xs font-bold uppercase tracking-wider mb-4">Lanjutan</span>
                <h3 class="text-xl font-bold text-[#023047] mb-2">IoT Smart Agriculture & Weather Station</h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">Kit sensor lingkungan untuk proyek pemantauan kelembapan tanah, suhu udara, intensitas cahaya, dan pompa otomatis.</p>
                <ul class="space-y-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Sensor kelembapan tanah, DHT11 & LDR</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Relay penggerak pompa mini submersible</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#219ebc] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Dashboard monitoring data IoT secara real-time</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 sm:py-20 bg-[#023047] text-white text-center">
    <div class="max-w-3xl mx-auto px-4 space-y-6">
        <h2 class="text-2xl sm:text-3xl font-extrabold">Rencanakan Laboratorium Robotik di Sekolah Anda</h2>
        <p class="text-sm sm:text-base text-slate-300">Kami menyediakan paket pengadaan hardware, rak penyimpanan khusus, dan sertifikasi instruktur bagi guru pembimbing.</p>
        <div>
            <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-8 py-3.5 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-lg hover:shadow-orange-500/25 transition-all duration-200">
                Konsultasikan Pengadaan Lab Robotika
            </a>
        </div>
    </div>
</section>

@endsection
