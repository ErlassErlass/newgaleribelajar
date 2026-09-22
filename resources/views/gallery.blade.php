@extends('layouts.app')

@section('title', __('gallery.documentation.title') . ' - Erlass Institute')
@section('description', __('gallery.hero.subtitle'))

@section('content')

<!-- Gallery Hero -->
<section class="relative pt-32 pb-20 bg-kids-pink overflow-hidden section-reveal">
    <!-- Decorative blobs -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-kids-yellow/40 rounded-full blur-[100px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-kids-blue/30 rounded-full blur-[80px] pointer-events-none" aria-hidden="true"></div>
    
    <!-- Floating SVG decorations -->
    <div class="absolute top-20 right-10 hidden lg:block opacity-50" aria-hidden="true">
        <svg data-speed="1.2" class="hero-float w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
    </div>
    <div class="absolute bottom-20 left-10 hidden lg:block opacity-50" aria-hidden="true">
        <svg data-speed="1.3" class="hero-float w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
    </div>

    <div class="max-w-4xl mx-auto px-4 space-y-6 text-center relative z-10">
        <span class="inline-block py-1.5 px-5 rounded-full bg-white/80 text-kids-navy font-bold text-sm tracking-widest shadow-sm">
            📸 {{ __('gallery.hero.badge') }}
        </span>
        <h1 class="font-serif text-5xl md:text-7xl font-bold text-[#111111] leading-[1.1]">
            {{ __('gallery.hero.heading_1') }}<br/>
            <span class="text-white">{{ __('gallery.hero.heading_2') }}</span>
        </h1>
        <p class="font-sans text-xl md:text-2xl text-[#111111]/80 font-medium max-w-2xl mx-auto">
            {{ __('gallery.hero.subtitle') }}
        </p>
    </div>
</section>

<!-- Video Feature -->
<section class="py-24 px-4 bg-white section-reveal">
    <div class="max-w-6xl mx-auto">
        <div class="relative rounded-[2rem] overflow-hidden aspect-video shadow-2xl group cursor-pointer border-4 border-[#111111] hover:-translate-y-2 transition-all duration-500">
            <!-- Thumbnail -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10"></div>
            <img src="{{ asset('img/gallery/presentation.png') }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ __('gallery.video.title') }}" loading="lazy">
            
            <!-- Play Button -->
            <div class="absolute inset-0 z-20 flex items-center justify-center">
                <div class="w-24 h-24 bg-kids-yellow rounded-full flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-[0_8px_0_rgba(17,17,17,0.15)]">
                    <svg class="w-10 h-10 ml-1 text-kids-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-8 z-20 text-white">
                <h3 class="font-serif text-4xl font-bold mb-2">{{ __('gallery.video.title') }}</h3>
                <p class="font-sans text-lg text-white/80">{{ __('gallery.video.subtitle') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Instagram Feed (Infinite Marquee) -->
<section class="py-24 bg-[#fafafa] overflow-hidden relative section-reveal">
    <div class="max-w-7xl mx-auto px-4 mb-16 text-center">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-4">{{ __('gallery.instagram.title') }}</h2>
        <a href="https://instagram.com/komunitaserlass" target="_blank" rel="noopener noreferrer" class="text-kids-pink font-bold text-lg hover:underline decoration-2 underline-offset-4">{{ __('gallery.instagram.handle') }}</a>
    </div>

    <!-- Infinite Marquee Container -->
    <div class="relative w-full overflow-hidden">
        <div class="flex animate-marquee whitespace-nowrap gap-6 pl-6 hover:[animation-play-state:paused]">
            @php
                $instaImages = [
                    asset('img/gallery/coding-class.png'),
                    asset('img/gallery/robotics-class.png'),
                    asset('img/gallery/teamwork.png'),
                    asset('img/gallery/presentation.png'),
                    asset('img/gallery/competition.png'),
                    asset('img/gallery/microbit.png'),
                ];
                $captions = __('gallery.instagram.captions');
            @endphp

            <!-- Profile Card -->
            <div class="shrink-0 w-80 bg-white rounded-[2rem] p-8 border-2 border-gray-100 shadow-sm flex flex-col items-center justify-center text-center mx-3 transition-transform hover:-translate-y-2 duration-300">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-kids-yellow via-kids-pink to-kids-blue p-1 mb-6 relative shadow-lg">
                    <div class="absolute inset-0 bg-white rounded-full m-1 pointer-events-none"></div>
                    <img src="{{ asset('img/og-preview.png') }}" alt="Komunitas Erlass" class="rounded-full relative z-10 w-full h-full object-cover border-4 border-white">
                </div>
                <h3 class="font-sans font-bold text-xl text-[#111111] mb-2">Komunitas Erlass</h3>
                <p class="font-sans text-[#111111]/60 text-sm mb-6 whitespace-normal">{{ __('gallery.instagram.profile_desc') }}</p>
                <a href="https://instagram.com/komunitaserlass" target="_blank" rel="noopener noreferrer" class="px-8 py-3 bg-kids-pink text-white text-sm font-bold rounded-full hover:bg-kids-pink/90 transition-all shadow-sm hover:scale-105">{{ __('gallery.instagram.follow') }}</a>
            </div>

            @foreach($instaImages as $index => $img)
            <div class="shrink-0 w-72 group relative rounded-[2rem] overflow-hidden aspect-[4/5] bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 mx-3 cursor-pointer border-2 border-gray-100">
                <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Instagram Post {{ $index + 1 }}" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                    <p class="font-sans text-white text-sm font-medium whitespace-normal mb-3 leading-relaxed">{{ $captions[$index] ?? '' }}</p>
                    <div class="flex gap-4 text-white/90 text-xs font-bold">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-kids-pink fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> {{ rand(50, 200) }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg> {{ rand(5, 20) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- DUPLICATE TRACK FOR INFINITE EFFECT -->
            <div class="shrink-0 w-80 bg-white rounded-[2rem] p-8 border-2 border-gray-100 shadow-sm flex flex-col items-center justify-center text-center mx-3 transition-transform hover:-translate-y-2 duration-300" aria-hidden="true">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-kids-yellow via-kids-pink to-kids-blue p-1 mb-6 relative shadow-lg">
                    <div class="absolute inset-0 bg-white rounded-full m-1 pointer-events-none"></div>
                    <img src="{{ asset('img/og-preview.png') }}" alt="" class="rounded-full relative z-10 w-full h-full object-cover border-4 border-white">
                </div>
                <h3 class="font-sans font-bold text-xl text-[#111111] mb-2">Komunitas Erlass</h3>
                <p class="font-sans text-[#111111]/60 text-sm mb-6 whitespace-normal">{{ __('gallery.instagram.profile_desc') }}</p>
                <a href="https://instagram.com/komunitaserlass" target="_blank" rel="noopener noreferrer" class="px-8 py-3 bg-kids-pink text-white text-sm font-bold rounded-full hover:bg-kids-pink/90 transition-all shadow-sm hover:scale-105" tabindex="-1">{{ __('gallery.instagram.follow') }}</a>
            </div>

            @foreach($instaImages as $index => $img)
            <div class="shrink-0 w-72 group relative rounded-[2rem] overflow-hidden aspect-[4/5] bg-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 mx-3 cursor-pointer border-2 border-gray-100" aria-hidden="true">
                <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                    <p class="font-sans text-white text-sm font-medium whitespace-normal mb-3 leading-relaxed">{{ $captions[$index] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Photo Grid (CSS Masonry) -->
<section class="py-24 bg-white section-reveal">
    <div class="max-w-7xl mx-auto px-4">
         <div class="flex flex-col items-center mb-16 space-y-4">
             <span class="inline-block bg-kids-mint text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                {{ __('gallery.documentation.badge') }}
             </span>
             <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] text-center">{{ __('gallery.documentation.title') }}</h2>
         </div>
         
         <!-- Masonry Grid -->
         <div class="columns-2 lg:columns-3 gap-5">
            @php
                $galleryItems = [
                    ['src' => 'img/gallery/coding-class.png', 'alt' => 'Kelas Koding Erlass'],
                    ['src' => 'img/gallery/robotics-class.png', 'alt' => 'Kelas Robotika Erlass'],
                    ['src' => 'img/gallery/teamwork.png', 'alt' => 'Kerja Tim Siswa'],
                    ['src' => 'img/gallery/presentation.png', 'alt' => 'Presentasi Proyek Siswa'],
                    ['src' => 'img/gallery/competition.png', 'alt' => 'Kompetisi STEM'],
                    ['src' => 'img/gallery/microbit.png', 'alt' => 'Micro:bit Hands-On'],
                ];
            @endphp
             @foreach($galleryItems as $item)
             <div class="break-inside-avoid mb-5 rounded-[1.5rem] overflow-hidden shadow-md hover:shadow-2xl hover:shadow-kids-pink/20 transition-all hover:-translate-y-2 duration-500 border-2 border-gray-100 group relative cursor-pointer">
                <img src="{{ asset($item['src']) }}" class="w-full h-auto object-cover transition-all duration-700 group-hover:scale-105" alt="{{ $item['alt'] }}" loading="lazy">
                <div class="absolute inset-0 bg-kids-navy/0 group-hover:bg-kids-navy/20 transition-colors duration-500"></div>
                <!-- Caption overlay on hover -->
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="font-sans text-white text-sm font-bold">{{ $item['alt'] }}</p>
                </div>
             </div>
             @endforeach
         </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-kids-yellow text-center relative overflow-hidden section-reveal">
    <div class="absolute top-0 right-0 w-64 h-64 bg-kids-pink/30 rounded-full blur-[100px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-kids-blue/20 rounded-full blur-[80px] pointer-events-none" aria-hidden="true"></div>
    
    <div class="max-w-3xl mx-auto px-4 relative z-10">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-6">Ingin Momen Serupa di Sekolah Anda?</h2>
        <p class="font-sans text-xl text-[#111111]/70 mb-10">Jadikan siswa Anda bagian dari komunitas inovator muda Erlass. Mulai perjalanan kerjasama hari ini!</p>
        <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-white transition-all duration-300 bg-kids-navy rounded-full hover:scale-105 shadow-[0_8px_0_rgba(15,44,65,0.3)]">
            Jadwalkan Demo Gratis
        </a>
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
        animation: marquee 45s linear infinite;
    }
</style>
@endsection
