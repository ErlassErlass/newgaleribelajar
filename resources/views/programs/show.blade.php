@extends('layouts.app')

@section('title', $program->name . ' - Galeribelajar.com')
@section('meta_description', $program->short_description ?? 'Program unggulan Galeribelajar.com')

@section('content')
<!-- Floating Navigation (for returning home easily) -->
<div class="fixed top-24 left-4 sm:left-8 z-50">
    <a href="{{ route('home') }}#programs" class="group flex items-center justify-center w-12 h-12 bg-white rounded-full shadow-lg border-2 border-kids-navy text-kids-navy hover:bg-kids-yellow hover:scale-110 transition-all duration-300">
        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
</div>

<main class="pt-20 bg-[#fafafa] min-h-screen">
    <!-- Hero Header -->
    <div class="relative bg-kids-navy pt-32 pb-40 overflow-hidden section-reveal">
        <!-- Playful Background Shapes -->
        <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-kids-yellow rounded-full mix-blend-multiply filter blur-[80px]"></div>
            <div class="absolute top-1/2 -right-24 w-96 h-96 bg-kids-pink rounded-full mix-blend-multiply filter blur-[80px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div class="text-left space-y-8">
                    <div class="inline-block bg-kids-mint text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm rounded-full border-2 border-kids-navy/10">
                        ✨ Program Unggulan
                    </div>
                    
                    <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight drop-shadow-md">
                        {{ $program->name }}
                    </h1>
                    
                    <p class="font-sans text-xl md:text-2xl text-white/90 leading-relaxed font-medium max-w-xl">
                        {{ $program->short_description }}
                    </p>
                </div>

                <!-- Featured Image -->
                <div class="relative group hidden md:block">
                    <!-- Blob Background -->
                    <svg class="absolute inset-0 w-full h-full text-kids-yellow transform scale-110 -z-10 opacity-50 group-hover:rotate-12 transition-transform duration-700" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                      <path fill="currentColor" d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-45.8C87.4,-32.6,90,-16.3,89.1,-0.5C88.1,15.2,83.5,30.5,75.2,43.6C66.9,56.7,54.8,67.6,41.2,74.6C27.6,81.5,12.5,84.4,-2.2,88.2C-16.9,92,-31.8,96.6,-44.6,91.4C-57.5,86.2,-68.3,71.1,-76.3,55.5C-84.3,39.8,-89.5,23.5,-88.7,8.2C-87.8,-7.2,-81,-21.6,-71.4,-33.1C-61.9,-44.6,-49.6,-53.2,-36.8,-61.2C-24.1,-69.2,-12,-76.6,2.2,-80.4C16.4,-84.3,30.5,-83.5,44.7,-76.4Z" transform="translate(100 100)" />
                    </svg>

                    @if($program->thumbnail_image)
                        <img src="{{ asset('storage/' . $program->thumbnail_image) }}" alt="{{ $program->name }}" class="w-full h-auto aspect-square object-cover rounded-[3rem] shadow-2xl border-8 border-white transform group-hover:-translate-y-4 transition-transform duration-500">
                    @else
                        <div class="w-full aspect-square bg-kids-blue rounded-[3rem] shadow-2xl border-8 border-white flex items-center justify-center transform group-hover:-translate-y-4 transition-transform duration-500">
                            <span class="font-serif text-6xl text-white font-bold">{{ substr($program->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0 transform translate-y-1 z-20 pointer-events-none">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 60C1200 60 1320 45 1380 37.5L1440 30V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#fafafa"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-16 bg-[#fafafa] relative z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-30">
            <!-- Article Card -->
            <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-16 border-2 border-gray-100">
                <div class="rich-content text-lg text-gray-700 leading-relaxed font-sans space-y-6">
                    @if($program->content)
                        {!! $program->content !!}
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-400 italic">Konten detail untuk program ini belum ditambahkan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Call To Action -->
            <div class="mt-20 text-center bg-kids-yellow rounded-[2rem] p-12 relative overflow-hidden shadow-lg border-2 border-kids-navy/5 group">
                <!-- Decorative pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#1d758b 2px, transparent 2px); background-size: 30px 30px;"></div>
                
                <div class="relative z-10">
                    <h3 class="font-serif text-3xl md:text-4xl font-bold text-[#111111] mb-6">Tertarik dengan Program {{ $program->name }}?</h3>
                    <p class="font-sans text-[#111111]/80 mb-8 max-w-xl mx-auto">Kami siap hadir di sekolah Anda! Diskusikan kebutuhan pelatihan atau ekstrakurikuler bersama tim ahli kami.</p>
                    
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center px-10 py-5 text-xl font-bold rounded-full shadow-[0_8px_0_rgba(29,117,139,1)] text-white bg-kids-navy hover:bg-[#155a6e] hover:shadow-[0_10px_0_rgba(29,117,139,1)] hover:-translate-y-1 active:shadow-[0_0px_0_rgba(29,117,139,1)] active:translate-y-2 transition-all duration-200">
                        <span>Hubungi Kami Sekarang</span>
                        <svg class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Custom Styles for Rich Content (Since we don't have Tailwind Typography plugin) -->
<style>
    .rich-content h1, 
    .rich-content h2, 
    .rich-content h3, 
    .rich-content h4 {
        color: #111111;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-top: 2em;
        margin-bottom: 0.75em;
        line-height: 1.3;
    }
    .rich-content h2 { font-size: 2.25rem; }
    .rich-content h3 { font-size: 1.75rem; }
    
    .rich-content p {
        margin-bottom: 1.5em;
    }
    
    .rich-content ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 1.5em;
    }
    
    .rich-content ul li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 0.75em;
    }
    
    .rich-content ul li::before {
        content: '🌟';
        position: absolute;
        left: 0;
        top: 0.1em;
        font-size: 1.2rem;
    }
    
    .rich-content strong {
        color: #1d758b;
        font-weight: 800;
    }
    
    .rich-content a {
        color: #1d758b;
        text-decoration: underline;
        text-decoration-thickness: 2px;
        text-underline-offset: 4px;
    }
    
    .rich-content a:hover {
        color: #ffd600;
        background-color: #1d758b;
        text-decoration: none;
        padding: 0 4px;
        border-radius: 4px;
        transition: all 0.2s;
    }
    
    .rich-content img {
        border-radius: 1.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        margin: 2em 0;
        max-width: 100%;
        height: auto;
    }
    
    .rich-content blockquote {
        border-left: 5px solid #ffd600;
        background-color: #fffdf5;
        padding: 1.5em;
        border-radius: 0 1rem 1rem 0;
        font-style: italic;
        margin: 2em 0;
        color: #555;
    }
</style>
@endsection
