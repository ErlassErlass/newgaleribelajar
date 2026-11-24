@extends('layouts.app')

@section('title', 'Dokumentasi & Galeri Implementasi - PT Erlass Prokreatif Indonesia')
@section('canonical', route('gallery', array_filter(['kategori' => $category, 'sub' => $sub])))
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

<!-- Video Playlist -->
@php $firstVideo = $videos[0] ?? null; @endphp
@if($firstVideo)
<section id="video" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 bg-[#021f30] text-white border-b border-slate-800" data-playlist>
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 sm:mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#ff0000] text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-red-600/30">
                @include('partials.brand-icon', ['name' => 'youtube', 'class' => 'w-4 h-4'])
                Video Erlass
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold mt-4 tracking-tight">Galeri Video & Kegiatan</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_400px] gap-8 items-start">
            {{-- Main player --}}
            <div>
                <div class="relative rounded-2xl overflow-hidden aspect-video shadow-2xl bg-black group" data-player>
                    <button type="button" class="absolute inset-0 w-full h-full text-left" data-player-poster aria-label="Putar video">
                        <img src="https://i.ytimg.com/vi/{{ $firstVideo['youtube_id'] }}/hqdefault.jpg" alt="" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700" data-player-thumb>
                        <span class="absolute inset-0 bg-gradient-to-t from-[#023047] via-[#023047]/30 to-transparent"></span>
                        <span class="absolute inset-0 flex items-center justify-center">
                            <span class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gradient-to-tr from-[#fb8500] to-[#ffb703] flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 ml-1 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </span>
                        <span class="absolute bottom-5 left-5 right-5 sm:bottom-7 sm:left-7">
                            <span class="inline-block px-3 py-1 rounded bg-[#219ebc] text-white text-xs font-bold uppercase tracking-wide mb-2" data-player-label>{{ $firstVideo['label'] ?? 'Video' }}</span>
                            <span class="block text-xl sm:text-3xl font-extrabold" data-player-heading>{{ $firstVideo['title'] }}</span>
                            <span class="hidden sm:block text-slate-200 text-sm mt-1 max-w-2xl" data-player-desc>{{ $firstVideo['desc'] ?? '' }}</span>
                        </span>
                    </button>
                </div>
                <div class="mt-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#ff6b6b]"><span class="w-2 h-2 rounded-full bg-[#ff3b3b]"></span> Sedang Ditampilkan</p>
                        <h3 class="text-xl sm:text-2xl font-bold mt-1" data-player-title>{{ $firstVideo['title'] }}</h3>
                        <a href="https://www.youtube.com/watch?v={{ $firstVideo['youtube_id'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 mt-2 text-sm font-bold text-[#ff6b6b] hover:text-white" data-player-link>Buka di YouTube ↗</a>
                    </div>
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white/10 hover:bg-white/20 border border-white/20 text-white text-sm font-bold shrink-0 transition-colors">
                        Ajukan Demo Serupa <span aria-hidden="true">›</span>
                    </a>
                </div>
            </div>

            {{-- Playlist --}}
            <aside class="rounded-2xl bg-white/5 border border-white/10 p-5 lg:sticky lg:top-28">
                <div class="flex items-center justify-between gap-3 pb-4 mb-4 border-b border-white/10">
                    <h3 class="font-bold">Rekomendasi Video</h3>
                    @if(count($videos) > 1)
                    <span class="px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-slate-300">{{ count($videos) - 1 }} video lainnya</span>
                    @endif
                </div>
                <ul class="space-y-3 max-h-[560px] overflow-y-auto pr-1 [scrollbar-width:thin]">
                    @foreach($videos as $i => $v)
                    <li>
                        <button type="button" data-playlist-item aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                                data-id="{{ $v['youtube_id'] }}" data-title="{{ $v['title'] }}" data-label="{{ $v['label'] ?? 'Video' }}" data-desc="{{ $v['desc'] ?? '' }}"
                                class="w-full flex items-center gap-4 p-2.5 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 aria-[current=true]:border-[#ff3b3b] aria-[current=true]:bg-[#ff3b3b]/10 text-left transition-colors">
                            <span class="relative w-32 shrink-0 aspect-video rounded-lg overflow-hidden bg-black">
                                <img src="https://i.ytimg.com/vi/{{ $v['youtube_id'] }}/mqdefault.jpg" alt="" loading="lazy" class="w-full h-full object-cover">
                                <span class="absolute inset-0 flex items-center justify-center"><span class="w-8 h-8 rounded-full bg-black/60 flex items-center justify-center"><svg class="w-4 h-4 ml-0.5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg></span></span>
                            </span>
                            <span class="min-w-0">
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-[#8ecae6]">{{ $v['label'] ?? 'Video' }}</span>
                                <span class="block text-sm font-bold leading-snug line-clamp-2 mt-0.5">{{ $v['title'] }}</span>
                                @if($v['views'] !== null || $v['published'])
                                <span class="flex items-center gap-3 mt-1 text-xs text-slate-400">
                                    @if($v['views'] !== null)
                                    <span class="inline-flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12z"/><circle cx="12" cy="12" r="3"/></svg>{{ number_format($v['views'], 0, ',', '.') }} views</span>
                                    @endif
                                    @if($v['published'])
                                    <span>{{ \Illuminate\Support\Carbon::parse($v['published'])->translatedFormat('d M Y') }}</span>
                                    @endif
                                </span>
                                @endif
                            </span>
                        </button>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ config('erlass.social.youtube') }}" target="_blank" rel="noopener" class="mt-4 flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-[#ff0000] hover:bg-[#d90000] text-white text-sm font-bold transition-colors">
                    @include('partials.brand-icon', ['name' => 'youtube', 'class' => 'w-4 h-4'])
                    Lihat Semua di YouTube
                </a>
            </aside>
        </div>
    </div>
</section>
<script>
// Playlist: poster first; the YouTube iframe is only created when a video is played
(function () {
    var root = document.querySelector('[data-playlist]');
    if (!root) return;
    var player = root.querySelector('[data-player]');
    var poster = root.querySelector('[data-player-poster]');
    var current = { id: @json($firstVideo['youtube_id']), title: @json($firstVideo['title']) };

    function play() {
        player.querySelectorAll('iframe').forEach(function (f) { f.remove(); });
        var iframe = document.createElement('iframe');
        iframe.className = 'absolute inset-0 w-full h-full';
        iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(current.id) + '?autoplay=1&rel=0&modestbranding=1';
        iframe.title = current.title;
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        player.appendChild(iframe);
        poster.classList.add('hidden');
    }
    poster.addEventListener('click', play);

    root.querySelectorAll('[data-playlist-item]').forEach(function (item) {
        item.addEventListener('click', function () {
            root.querySelectorAll('[data-playlist-item]').forEach(function (i) { i.setAttribute('aria-current', i === item ? 'true' : 'false'); });
            current = { id: item.dataset.id, title: item.dataset.title };
            root.querySelector('[data-player-thumb]').src = 'https://i.ytimg.com/vi/' + item.dataset.id + '/hqdefault.jpg';
            root.querySelector('[data-player-label]').textContent = item.dataset.label;
            root.querySelector('[data-player-heading]').textContent = item.dataset.title;
            root.querySelector('[data-player-desc]').textContent = item.dataset.desc;
            root.querySelector('[data-player-title]').textContent = item.dataset.title;
            root.querySelector('[data-player-link]').href = 'https://www.youtube.com/watch?v=' + item.dataset.id;
            play();
            if (window.innerWidth < 1024) player.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
})();
</script>
@endif

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
                    ['img' => asset('img/gallery/coding-class.webp'), 'label' => 'Kelas Koding Terstruktur', 'desc' => 'Pembelajaran computational thinking berbasis blok visual.'],
                    ['img' => asset('img/gallery/robotics-class.webp'), 'label' => 'Praktikum Robotika', 'desc' => 'Perakitan komponen mekatronika dan integrasi sensor.'],
                    ['img' => asset('img/gallery/teamwork.webp'), 'label' => 'Kolaborasi Siswa', 'desc' => 'Penyelesaian tantangan studi kasus secara berkelompok.'],
                    ['img' => asset('img/gallery/presentation.webp'), 'label' => 'Evaluasi & Uji Coba', 'desc' => 'Demonstrasi program dan demonstrasi purwarupa cerdas.'],
                    ['img' => asset('img/gallery/competition.webp'), 'label' => 'Persiapan Lomba & Eksibisi', 'desc' => 'Pendampingan siswa menuju kompetisi robotik tingkat nasional.'],
                    ['img' => asset('img/gallery/microbit.webp'), 'label' => 'Eksperimen Micro:bit', 'desc' => 'Pengenalan konsep Internet of Things (IoT) pada jenjang menengah.'],
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

<!-- Photo Archive with categories -->
@php
    $activeCat = $category ? $categories[$category] : null;
    $galleryUrl = fn (array $q) => route('gallery', array_filter($q)).'#arsip';
@endphp
<section id="arsip" class="py-16 sm:py-24 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-[#219ebc]">Arsip Foto Kegiatan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#023047] mt-1">
                {{ $activeCat ? 'Dokumentasi '.$activeCat['label'] : 'Dokumentasi Kegiatan Erlass' }}
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                {{ $activeCat['desc'] ?? 'Pilih kategori untuk melihat dokumentasi kegiatan guru, siswa, anak, umum, dan Erlass Festival.' }}
            </p>
        </div>

        {{-- Main categories --}}
        <nav class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:justify-center sm:overflow-visible" aria-label="Kategori foto">
            <a href="{{ $galleryUrl([]) }}" class="shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border transition-colors {{ $category ? 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' : 'bg-[#023047] border-[#023047] text-white' }}">
                Semua <span class="opacity-60 text-xs">{{ $totalPhotos }}</span>
            </a>
            @foreach($categories as $key => $cat)
            <a href="{{ $galleryUrl(['kategori' => $key]) }}" @if($category === $key) aria-current="page" @endif class="shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border transition-colors {{ $category === $key ? 'bg-[#023047] border-[#023047] text-white' : 'bg-white border-slate-200 text-slate-700 hover:border-[#219ebc]' }}">
                {{ $cat['label'] }} <span class="opacity-60 text-xs">{{ $catCounts[$key] ?? 0 }}</span>
            </a>
            @endforeach
        </nav>

        {{-- Sub-categories of the selected category --}}
        @if($activeCat)
        <nav class="mt-4 flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:justify-center sm:overflow-visible" aria-label="Sub-kategori {{ $activeCat['label'] }}">
            <a href="{{ $galleryUrl(['kategori' => $category]) }}" class="shrink-0 px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $sub ? 'bg-slate-100 text-slate-600 hover:bg-[#8ecae6]/30' : 'bg-[#219ebc] text-white' }}">
                Semua {{ $activeCat['label'] }}
            </a>
            @foreach($activeCat['subs'] as $sk => $sl)
            <a href="{{ $galleryUrl(['kategori' => $category, 'sub' => $sk]) }}" class="shrink-0 px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $sub === $sk ? 'bg-[#219ebc] text-white' : 'bg-slate-100 text-slate-600 hover:bg-[#8ecae6]/30' }}">
                {{ $sl }} <span class="opacity-60">{{ $subCounts[$sk] ?? 0 }}</span>
            </a>
            @endforeach
        </nav>
        @endif

        <div class="mt-10">
            @if($photos->isEmpty())
            <div class="text-center py-16 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                <p class="text-slate-700 font-semibold">Belum ada foto di kategori ini.</p>
                <p class="text-sm text-slate-500 mt-1">Dokumentasi terbaru juga kami bagikan di <a href="{{ config('erlass.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="text-[#219ebc] font-semibold hover:underline">Instagram @komunitaserlass</a>.</p>
            </div>
            @else
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6">
                @foreach($photos as $photo)
                <figure class="break-inside-avoid mb-6 rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm hover:shadow-lg transition-all group">
                    <div class="relative overflow-hidden bg-slate-100">
                        <img src="{{ $photo->image_url }}" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $photo->title }}" loading="lazy">
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-white/95 text-[#023047] text-[11px] font-bold shadow-sm">{{ $photo->category_label }}</span>
                    </div>
                    <figcaption class="p-4 border-t border-slate-100">
                        @if($photo->subcategory_label)
                        <a href="{{ $galleryUrl(['kategori' => $photo->category, 'sub' => $photo->subcategory]) }}" class="text-[11px] font-bold uppercase tracking-wider text-[#fb8500] hover:text-[#023047]">{{ $photo->subcategory_label }}</a>
                        @endif
                        <p class="text-sm font-bold text-[#023047] mt-0.5">{{ $photo->title }}</p>
                        @if($photo->description)
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $photo->description }}</p>
                        @endif
                    </figcaption>
                </figure>
                @endforeach
            </div>
            <div class="mt-6">{{ $photos->fragment('arsip')->links() }}</div>
            @endif
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
            <a href="https://wa.me/{{ config('erlass.whatsapp') }}?text=Halo%20Tim%20Erlass,%20saya%20tertarik%20dengan%20dokumentasi%20program%20dan%20ingin%20berkonsultasi%20untuk%20sekolah%20kami" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2">
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
