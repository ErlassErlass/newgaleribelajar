@extends('layouts.app')

@section('title', 'Gallery & Community - Erlass Institute')

@section('content')

<!-- Gallery Hero -->
<section class="pt-40 pb-20 bg-background text-center">
    <div class="max-w-4xl mx-auto px-4 space-y-6">
        <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-black text-xs uppercase tracking-widest">
            #KomunitasErlass
        </span>
        <h1 class="font-sans text-5xl md:text-7xl font-black text-foreground tracking-tight leading-[1.1]">
            Momen Belajar &<br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary/50">Berkarya</span>
        </h1>
        <p class="font-sans text-xl md:text-2xl text-muted-foreground font-medium max-w-2xl mx-auto">
            Melihat keseruan siswa-siswi Erlass dalam mengeksplorasi dunia teknologi secara interaktif.
        </p>
    </div>
</section>

<!-- Video Feature (Premium Glass) -->
<section class="pb-32 px-4 bg-background">
    <div class="max-w-6xl mx-auto">
        <div class="relative rounded-[3rem] overflow-hidden aspect-video shadow-2xl bg-card group cursor-pointer border border-border/50 hover:shadow-primary/20 transition-all duration-500 hover:-translate-y-2">
            <!-- Thumbnail Placeholder -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10 transition-opacity duration-500"></div>
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1200&q=80" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700 filter grayscale group-hover:grayscale-0" alt="Video Thumbnail">
            
            <!-- Play Button -->
            <div class="absolute inset-0 z-20 flex items-center justify-center">
                <div class="w-24 h-24 bg-background/30 backdrop-blur-md rounded-full flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-[0_0_40px_rgba(255,255,255,0.1)] group-hover:shadow-primary/40 border border-white/10 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                    <div class="w-16 h-16 bg-white text-primary rounded-full flex items-center justify-center shadow-xl group-hover:bg-primary group-hover:text-primary-foreground transition-colors relative z-10">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>
            
            <div class="absolute bottom-10 left-10 z-20 text-white transform transition-transform duration-500 group-hover:-translate-y-2">
                <h3 class="font-sans text-4xl font-black mb-2 tracking-tight">Erlass Experience</h3>
                <p class="font-sans text-lg text-white/80 font-medium">Lihat semangat dan antusiasme siswa dalam belajar teknologi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Instagram Feed (Infinite Marquee) -->
<section class="py-32 bg-muted/20 overflow-hidden relative border-y border-border/50">
    <div class="max-w-7xl mx-auto px-4 mb-16 text-center">
        <h2 class="font-sans text-4xl md:text-5xl font-black text-foreground mb-4 tracking-tight">Latest from Instagram</h2>
        <a href="https://instagram.com/komunitaserlass" target="_blank" class="text-primary font-bold text-lg hover:underline decoration-2 underline-offset-4">@komunitaserlass</a>
    </div>

    <!-- Infinite Marquee Container -->
    <div class="relative w-full overflow-hidden shrink-0 flex items-center justify-center">
        <!-- First Track -->
        <div class="flex animate-marquee whitespace-nowrap gap-6 pl-6 hover:pause shrink-0">
            @php
                $instaImages = [
                    'https://images.unsplash.com/photo-1563968743333-044cef800494?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1544531586-fde5298cdd40?auto=format&fit=crop&w=400&q=80',
                ];
                $captions = [
                    'Keseruan kelas Robotics hari ini! 🤖',
                    'Fokus coding Python untuk project akhir. 💻',
                    'Diskusi kelompok membahas solusi. 🏠',
                    'Presentasi project di depan orang tua. 🌟',
                    'Selamat untuk para juara kompetisi! 🏆',
                    'Belajar coding sejak dini. 🚀'
                ];
            @endphp

            <!-- Insta Item 0 (Profile Card) -->
            <div class="shrink-0 w-80 bg-card/80 backdrop-blur-sm rounded-[2rem] p-8 border border-border shadow-sm flex flex-col items-center justify-center text-center mx-3 transition-transform hover:-translate-y-2 duration-300">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 p-1 mb-6 relative shadow-lg">
                    <div class="absolute inset-0 bg-background rounded-full m-1 pointer-events-none"></div>
                    <img src="https://ui-avatars.com/api/?name=Komunitas+Erlass&background=random" alt="Profile" class="rounded-full relative z-10 w-full h-full object-cover border-4 border-background">
                </div>
                <h3 class="font-sans font-black text-xl text-card-foreground mb-2">Komunitas Erlass</h3>
                <p class="font-sans text-muted-foreground text-sm mb-6 font-medium whitespace-normal">Sharing moments of joy & learning.</p>
                <a href="https://instagram.com/komunitaserlass" class="px-8 py-3 bg-primary text-primary-foreground text-sm font-bold rounded-full hover:bg-primary/90 transition-all shadow-md shadow-primary/20 hover:scale-105">Follow Us</a>
            </div>

            @foreach($instaImages as $index => $img)
            <div class="shrink-0 w-72 group relative rounded-[2rem] overflow-hidden aspect-[4/5] bg-muted shadow-sm hover:shadow-xl transition-all duration-500 mx-3 cursor-pointer border border-border/50">
                <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 filter grayscale group-hover:grayscale-0" alt="Instagram Post">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                    <p class="font-sans text-white text-sm font-medium line-clamp-3 whitespace-normal mb-3 leading-relaxed">{{ $captions[$index] }}</p>
                    <div class="flex gap-4 text-white/90 text-xs font-bold">
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> {{ rand(50, 200) }}</span>
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg> {{ rand(5, 20) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- DUPLICATE TRACK FOR INFINITE EFFECT -->
            <div class="shrink-0 w-80 bg-card/80 backdrop-blur-sm rounded-[2rem] p-8 border border-border shadow-sm flex flex-col items-center justify-center text-center mx-3 transition-transform hover:-translate-y-2 duration-300">
                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 p-1 mb-6 relative shadow-lg">
                    <div class="absolute inset-0 bg-background rounded-full m-1 pointer-events-none"></div>
                    <img src="https://ui-avatars.com/api/?name=Komunitas+Erlass&background=random" alt="Profile" class="rounded-full relative z-10 w-full h-full object-cover border-4 border-background">
                </div>
                <h3 class="font-sans font-black text-xl text-card-foreground mb-2">Komunitas Erlass</h3>
                <p class="font-sans text-muted-foreground text-sm mb-6 font-medium whitespace-normal">Sharing moments of joy & learning.</p>
                <a href="https://instagram.com/komunitaserlass" class="px-8 py-3 bg-primary text-primary-foreground text-sm font-bold rounded-full hover:bg-primary/90 transition-all shadow-md shadow-primary/20 hover:scale-105">Follow Us</a>
            </div>

            @foreach($instaImages as $index => $img)
            <div class="shrink-0 w-72 group relative rounded-[2rem] overflow-hidden aspect-[4/5] bg-muted shadow-sm hover:shadow-xl transition-all duration-500 mx-3 cursor-pointer border border-border/50">
                <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 filter grayscale group-hover:grayscale-0" alt="Instagram Post">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                    <p class="font-sans text-white text-sm font-medium line-clamp-3 whitespace-normal mb-3 leading-relaxed">{{ $captions[$index] }}</p>
                    <div class="flex gap-4 text-white/90 text-xs font-bold">
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg> {{ rand(50, 200) }}</span>
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg> {{ rand(5, 20) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Photo Grid (CSS Masonry Premium) -->
<section class="py-32 bg-background">
    <div class="max-w-7xl mx-auto px-4">
         <div class="flex flex-col items-center mb-16 space-y-4">
             <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary/80 text-secondary-foreground text-xs font-bold tracking-widest uppercase border border-border">
                Moments
             </span>
             <h2 class="font-sans text-4xl md:text-5xl font-black text-foreground tracking-tight text-center">Documentation Gallery</h2>
         </div>
         
         <!-- Pure CSS Masonry -->
         <div class="columns-2 lg:columns-3 gap-4 md:gap-6">
            @php
                 $galleryImages = [
                    'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1504164996022-09080787b6b3?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1510511459019-5dda7724fd87?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80',
                    'https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?auto=format&fit=crop&w=600&q=80',
                ];
            @endphp
             @foreach($galleryImages as $img)
             <div class="break-inside-avoid mb-4 md:mb-6 rounded-2xl md:rounded-[2rem] overflow-hidden shadow-md hover:shadow-2xl hover:shadow-primary/20 transition-all hover:-translate-y-2 duration-500 border border-border/50 group relative cursor-pointer">
                <img src="{{ $img }}" class="w-full h-auto object-cover filter grayscale-[30%] group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105" alt="Gallery Image" loading="lazy">
                <div class="absolute inset-0 bg-background/20 group-hover:bg-transparent transition-colors duration-500"></div>
             </div>
             @endforeach
         </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    /* Marquee Animation Keyframes */
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    .animate-marquee {
        animation: marquee 40s linear infinite;
    }
    .pause {
        animation-play-state: paused;
    }
</style>
@endsection
