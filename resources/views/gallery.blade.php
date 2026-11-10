@extends('layouts.app')

@section('title', 'Dokumentasi & Galeri Implementasi - PT Erlass Prokreatif Indonesia')
@section('description', 'Dokumentasi nyata kegiatan pelatihan guru, implementasi laboratorium koding, perakitan robotika, dan asesmen digital di ratusan sekolah mitra Erlass di seluruh Indonesia.')

@section('content')

<!-- Gallery Hero -->
<section class="relative pt-32 pb-20 bg-[#023047] text-white overflow-hidden hero-grid-pattern">
    <!-- Subtle glow accents -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#219ebc]/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#8ecae6]/15 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-[#8ecae6]/30 text-[#8ecae6] text-xs font-bold tracking-wider uppercase">
            <svg class="w-4 h-4 text-[#ffb703]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span>Dokumentasi Implementasi & Pelatihan</span>
        </div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
            Rekam Jejak Transformasi Pendidikan <br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8ecae6] via-[#219ebc] to-[#ffb703]">Bersama 400+ Sekolah Mitra</span>
        </h1>
        <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Dokumentasi faktual penerapan kurikulum koding, perakitan robotika, asesmen bakat digital, dan pelatihan guru (ToT) yang terlaksana secara terstruktur di berbagai kota di Indonesia.
        </p>
    </div>
</section>

<!-- Video Feature -->
<section class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 bg-white border-b border-slate-200">
    <div class="max-w-5xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Video Pelaksanaan Program</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">Simulasi & Pembelajaran Interaktif di Kelas</h2>
            <p class="text-slate-600 text-sm mt-2">Gambaran langsung interaksi siswa dan guru saat mengaplikasikan kurikulum teknologi Erlass.</p>
        </div>

        <div class="relative rounded-2xl overflow-hidden aspect-video shadow-xl group border border-slate-200 bg-[#023047]">
            <div class="absolute inset-0 bg-gradient-to-t from-[#023047]/90 via-[#023047]/30 to-transparent z-10 pointer-events-none"></div>
            <img src="{{ asset('img/gallery/presentation.png') }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Presentasi Proyek Siswa Erlass" loading="lazy">
            
            <!-- Play Button Overlay -->
            <div class="absolute inset-0 z-20 flex items-center justify-center">
                <div class="w-20 h-20 bg-gradient-to-tr from-[#fb8500] to-[#ffb703] rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300 text-white cursor-pointer">
                    <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </div>
            
            <div class="absolute bottom-6 left-6 right-6 z-20 text-white flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="inline-block px-3 py-1 rounded bg-[#219ebc] text-white text-xs font-bold uppercase tracking-wide mb-2">Studi Kasus</span>
                    <h3 class="text-xl sm:text-2xl font-bold">Presentasi Karya & Proyek Berbasis Masalah</h3>
                    <p class="text-slate-300 text-xs sm:text-sm">Siswa mempresentasikan logika algoritma dan rancangan purwarupa di hadapan guru dan teman sekelas.</p>
                </div>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 text-white text-xs font-bold shrink-0 transition-colors">
                    <span>Ajukan Demo Serupa</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Community Marquee Stream -->
<section class="py-16 bg-slate-50 border-b border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Aktivitas Komunitas Pendidikan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">Kegiatan Lapangan & Pelatihan Guru</h2>
        </div>
        <a href="https://instagram.com/komunitaserlass" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-bold text-[#219ebc] hover:text-[#023047] transition-colors">
            <span>Ikuti @komunitaserlass di Instagram</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
        </a>
    </div>

    <!-- Infinite Marquee Track -->
    <div class="relative w-full overflow-hidden">
        <div class="flex animate-marquee whitespace-nowrap gap-6 pl-6 hover:[animation-play-state:paused]">
            @php
                $instaImages = [
                    ['img' => asset('img/gallery/coding-class.png'), 'label' => 'Kelas Koding Terstruktur', 'desc' => 'Pembelajaran computational thinking berbasis blok visual.'],
                    ['img' => asset('img/gallery/robotics-class.png'), 'label' => 'Praktikum Robotika', 'desc' => 'Perakitan komponen mekatronika dan integrasi sensor.'],
                    ['img' => asset('img/gallery/teamwork.png'), 'label' => 'Kolaborasi Siswa', 'desc' => 'Penyelesaian tantangan studi kasus secara berkelompok.'],
                    ['img' => asset('img/gallery/presentation.png'), 'label' => 'Evaluasi & Uji Coba', 'desc' => 'Demonstrasi program dan demonstrasi purwarupa cerdas.'],
                    ['img' => asset('img/gallery/competition.png'), 'label' => 'Persiapan Lomba & Eksibisi', 'desc' => 'Pendampingan siswa menuju kompetisi robotik tingkat nasional.'],
                    ['img' => asset('img/gallery/microbit.png'), 'label' => 'Eksperimen Micro:bit', 'desc' => 'Pengenalan konsep Internet of Things (IoT) pada jenjang menengah.'],
                ];
            @endphp

            @foreach($instaImages as $item)
            <div class="shrink-0 w-80 bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item['label'] }}" loading="lazy">
                </div>
                <div class="p-5 whitespace-normal">
                    <span class="inline-block px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#8ecae6]/20 text-[#023047] mb-2">{{ $item['label'] }}</span>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach

            <!-- Duplicate for continuous stream -->
            @foreach($instaImages as $item)
            <div class="shrink-0 w-80 bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all group" aria-hidden="true">
                <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item['label'] }}" loading="lazy">
                </div>
                <div class="p-5 whitespace-normal">
                    <span class="inline-block px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#8ecae6]/20 text-[#023047] mb-2">{{ $item['label'] }}</span>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Photo Masonry Section -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Arsip Foto Kegiatan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">Dokumentasi Laboratorium & Fasilitas</h2>
            <p class="text-slate-600 text-sm mt-2">Dukungan modul fisik, kit praktikum, dan lingkungan belajar terstruktur yang disediakan bagi sekolah mitra.</p>
        </div>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6">
            @php
                $masonryItems = [
                    ['src' => 'img/gallery/coding-class.png', 'title' => 'Laboratorium Komputer Terpadu', 'category' => 'Kurikulum Informatika'],
                    ['src' => 'img/gallery/robotics-class.png', 'title' => 'Workshop Perakitan Kit Robotik', 'category' => 'Hardware & Micro:bit'],
                    ['src' => 'img/gallery/teamwork.png', 'title' => 'Diskusi Kelompok & Algoritma', 'category' => 'Computational Thinking'],
                    ['src' => 'img/gallery/presentation.png', 'title' => 'Sesi Evaluasi Hasil Proyek', 'category' => 'Student Assessment'],
                    ['src' => 'img/gallery/competition.png', 'title' => 'Simulasi Tantangan Otomasi', 'category' => 'STEM Education'],
                    ['src' => 'img/gallery/microbit.png', 'title' => 'Praktik Sensor Lingkungan Micro:bit', 'category' => 'IoT & Embedded System'],
                ];
            @endphp

            @foreach($masonryItems as $photo)
            <div class="break-inside-avoid mb-6 rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm hover:shadow-lg transition-all group">
                <div class="relative overflow-hidden bg-slate-100">
                    <img src="{{ asset($photo['src']) }}" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $photo['title'] }}" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#023047]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-5 flex flex-col justify-end text-white">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#ffb703]">{{ $photo['category'] }}</span>
                        <h4 class="text-sm font-bold mt-0.5">{{ $photo['title'] }}</h4>
                    </div>
                </div>
                <div class="p-4 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#023047]">{{ $photo['title'] }}</span>
                        <p class="text-[11px] text-slate-500">{{ $photo['category'] }}</p>
                    </div>
                    <span class="w-7 h-7 rounded-full bg-slate-100 group-hover:bg-[#219ebc] group-hover:text-white flex items-center justify-center text-slate-400 transition-colors text-xs font-bold">
                        →
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Corporate CTA Section -->
<section class="py-16 sm:py-20 bg-[#023047] text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#219ebc]/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight">
            Ingin Mengimplementasikan Program Serupa di Sekolah Anda?
        </h2>
        <p class="text-sm sm:text-base text-slate-300 max-w-xl mx-auto leading-relaxed">
            Tim konsultan kurikulum Erlass siap berkunjung dan mempresentasikan kurikulum, perangkat kit, serta skema pendampingan guru yang disesuaikan dengan kebutuhan sekolah Anda.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('home') }}#contact" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5 transition-all duration-200">
                Jadwalkan Konsultasi & Presentasi
            </a>
            <a href="https://wa.me/6281283838383?text=Halo%20Tim%20Erlass,%20saya%20tertarik%20dengan%20dokumentasi%20program%20dan%20ingin%20berkonsultasi%20untuk%20sekolah%20kami" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2">
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 35s linear infinite;
    }
</style>
@endsection
