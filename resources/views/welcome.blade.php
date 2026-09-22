@extends('layouts.app')

@section('title', 'Erlass - Mitra Pelatihan, Ekskul & P5 di Sekolah')

@section('content')

<!-- Page Preloader -->
<div id="page-preloader" class="fixed inset-0 z-[100] bg-kids-yellow flex flex-col items-center justify-center">
    <div class="overflow-hidden mb-4">
        <h1 id="preloader-text" class="font-serif font-extrabold text-6xl md:text-8xl text-kids-navy translate-y-[110%]">ERLASS</h1>
    </div>
    <div class="w-48 h-1 bg-white/30 rounded-full overflow-hidden">
        <div id="preloader-bar" class="h-full bg-kids-navy w-0 rounded-full"></div>
    </div>
</div>

<!-- Noise Overlay -->
<div class="noise-overlay pointer-events-none fixed inset-0 z-[100] opacity-[0.03]"></div>

<!-- 3D Background Canvas -->
<canvas id="hero-canvas" class="fixed top-0 left-0 w-full h-full -z-10 opacity-30 pointer-events-none"></canvas>

<!-- Hero Section -->
<x-hero />

<!-- About Erlass Section -->
<section id="about" class="py-32 bg-white relative overflow-hidden section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto items-center text-center">

            <!-- Text Content -->
            <div class="space-y-8 about-content relative z-20 flex flex-col items-center">
                <div class="inline-block bg-kids-pink text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                    🏫 {{ __('content.about.badge') }}
                </div>
                
                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111] leading-tight">
                    {{ __('content.about.heading_1') }} <br/>{{ __('content.about.heading_2') }}
                </h2>
                
                <p class="font-sans text-lg text-gray-700 leading-relaxed max-w-xl">
                    {{ __('content.about.description') }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-4 text-left">
                    @foreach(__('content.stats') as $stat)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center text-4xl flex-shrink-0">{{ $stat['icon'] ?? '🎯' }}</div>
                        <span class="font-bold text-[#111111] font-sans">{{ $stat['value'] }} {{ $stat['label'] }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="pt-6">
                    <a href="#programs" class="group relative inline-flex items-center justify-center px-10 py-4 bg-kids-yellow text-kids-navy font-bold rounded-full transition-all duration-300 hover:scale-105 shadow-[0_8px_0_rgba(153,225,255,1)] hover:shadow-[0_10px_0_rgba(153,225,255,1)]">
                        <span class="font-sans text-lg tracking-wide">{{ __('content.about.cta') }}</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Handprints Decorative Right -->
    <div class="absolute top-0 right-0 w-24 h-full pointer-events-none hidden lg:flex flex-col justify-between items-end opacity-80 z-0 py-8" aria-hidden="true">
        <svg data-speed="1.1" class="hero-float w-16 h-16 text-[#1d758b] transform -translate-x-4 rotate-12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg data-speed="1.3" class="hero-float w-20 h-20 text-[#99e1ff] transform translate-x-2 -rotate-12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg data-speed="0.9" class="hero-float w-16 h-16 text-[#ffb3c6] transform -translate-x-6 rotate-45" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg data-speed="1.2" class="hero-float w-24 h-24 text-[#ff7f50] transform translate-x-4 -rotate-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg data-speed="0.8" class="hero-float w-16 h-16 text-[#99e1ff] transform -translate-x-2 rotate-12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
</section>

<!-- Why Choose Us Section -->
@include('sections.why-choose-us')

<!-- Programs Section (Horizontal Scroll) -->
<section id="programs" class="relative bg-kids-navy text-white overflow-hidden">
    <div id="horizontal-scroll-container" class="w-full flex h-screen">
        
        <!-- Panel 1: Intro -->
        <div tabindex="0" class="h-panel w-screen h-screen flex-shrink-0 flex items-center justify-center relative p-8 md:p-24 border-r border-white/10 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-inset focus-visible:ring-kids-yellow">
            <div class="absolute top-12 left-12 inline-block bg-kids-pink text-[#111111] px-5 py-2 font-bold text-sm tracking-wide rounded-full z-20">
                🎯 {{ __('content.programs.badge') }}
            </div>
            
            <div class="max-w-7xl w-full text-center z-10">
                <div class="space-y-8">
                    <h2 class="font-serif text-5xl md:text-7xl font-bold leading-tight">
                        {{ __('content.programs.heading') }}
                    </h2>
                    <p class="font-sans text-xl text-white/70 max-w-2xl mx-auto">
                        {{ __('content.programs.subheading') }}
                    </p>
                </div>
            </div>
        </div>

        @php
            $colors = ['kids-yellow', 'kids-blue', 'kids-mint', 'kids-pink'];
        @endphp

        @foreach($programs as $index => $program)
            @php
                $color = $colors[$index % count($colors)];
                $imagePlaceholderColor = match($color) {
                    'kids-yellow' => 'fce03a',
                    'kids-blue' => '99e1ff',
                    'kids-mint' => 'a2e8dd',
                    'kids-pink' => 'ffb3c6',
                    default => 'ffffff',
                };
            @endphp
            <!-- Panel: {{ $program->name }} -->
            <div tabindex="0" class="h-panel w-screen h-screen flex-shrink-0 flex items-center justify-center relative p-8 md:p-24 border-r border-white/10 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-inset focus-visible:ring-{{ $color }}">
                <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center z-10">
                    
                    @if($index % 2 != 0)
                    <!-- Image Placeholder Left -->
                    <div class="hidden lg:flex justify-center">
                        @if($program->thumbnail_image)
                        <img src="{{ asset('storage/' . $program->thumbnail_image) }}" alt="{{ $program->name }}" class="w-full max-w-md rounded-3xl shadow-2xl rotate-[-3deg] hover:rotate-0 transition-transform duration-500 border-8 border-white/10 object-cover aspect-square">
                        @else
                        <img src="https://placehold.co/600x600/{{ $imagePlaceholderColor }}/111111?text={{ urlencode($program->name) }}" alt="{{ $program->name }}" class="w-full max-w-md rounded-3xl shadow-2xl rotate-[-3deg] hover:rotate-0 transition-transform duration-500 border-8 border-white/10">
                        @endif
                    </div>
                    @endif

                    <div class="glass-pro rounded-3xl p-10 shadow-2xl relative overflow-hidden group border-{{ $color }}/30">
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-{{ $color }} blur-[60px] opacity-30 group-hover:opacity-60 transition-opacity"></div>
                        <h3 class="font-sans text-4xl font-black mb-4">{{ $program->name }}</h3>
                        <p class="text-white/80 text-lg leading-relaxed mb-8">{{ $program->short_description }}</p>
                        <a href="{{ route('programs.show', $program->slug) }}" class="inline-flex items-center gap-2 font-bold hover:text-{{ $color }} transition-colors">
                            {{ __('content.programs.see_curriculum') }} <span class="text-xl">→</span>
                        </a>
                    </div>

                    @if($index % 2 == 0)
                    <!-- Image Placeholder Right -->
                    <div class="hidden lg:flex justify-center order-first lg:order-last">
                        @if($program->thumbnail_image)
                        <img src="{{ asset('storage/' . $program->thumbnail_image) }}" alt="{{ $program->name }}" class="w-full max-w-md rounded-3xl shadow-2xl rotate-[3deg] hover:rotate-0 transition-transform duration-500 border-8 border-white/10 object-cover aspect-square">
                        @else
                        <img src="https://placehold.co/600x600/{{ $imagePlaceholderColor }}/111111?text={{ urlencode($program->name) }}" alt="{{ $program->name }}" class="w-full max-w-md rounded-3xl shadow-2xl rotate-[3deg] hover:rotate-0 transition-transform duration-500 border-8 border-white/10">
                        @endif
                    </div>
                    @endif
                </div>
                 <!-- Decorative Large Text Background -->
                <div class="absolute {{ $index % 2 == 0 ? 'right-0' : 'left-0' }} top-1/2 -translate-y-1/2 font-serif text-[15rem] font-black text-white/5 whitespace-nowrap pointer-events-none select-none uppercase">
                    {{ Str::words($program->name, 1, '') }}.
                </div>
            </div>
        @endforeach

    </div>
</section>

<!-- Clients Marquee -->
@include('sections.clients')

<!-- Video Section -->
@include('sections.videos')

<!-- How It Works Section -->
<section id="how-it-works" class="py-24 bg-[#fafafa] relative section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-6">
            <div class="inline-block bg-kids-mint text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                {{ __('content.how_it_works.badge') }}
            </div>
            <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111]">
                {{ __('content.how_it_works.heading') }}
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
            <!-- Connecting Line -->
            <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-1 bg-gray-200 -z-10 transform -translate-y-1/2"></div>
            
            @foreach(__('content.how_it_works.steps') as $index => $step)
            <div class="relative flex flex-col items-center text-center group">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-4xl shadow-xl border-4 border-white z-10 group-hover:scale-110 transition-transform duration-300">
                    {{ $step['icon'] }}
                </div>
                <div class="mt-8 space-y-4">
                    <div class="inline-block bg-kids-yellow text-kids-navy font-black text-sm px-3 py-1 rounded-full">LANGKAH {{ $index + 1 }}</div>
                    <h3 class="font-sans font-bold text-2xl text-[#111111]">{{ $step['title'] }}</h3>
                    <p class="font-sans text-[#111111]/70 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="testimoni" class="py-32 bg-white relative section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-6">
            <div class="inline-block bg-kids-pink text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                💬 {{ __('content.testimoni.badge') }}
            </div>
            <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111]">
                {{ __('content.testimoni.heading') }}
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto font-medium">
                {{ __('content.testimoni.subheading') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(__('content.testimoni.items') as $item)
            <div class="bg-[#fafafa] border border-gray-100 rounded-3xl p-8 relative hover:shadow-[0_8px_0_rgba(153,225,255,0.5)] hover:-translate-y-1 transition-all duration-300">
                <div class="text-kids-yellow text-3xl mb-4">★★★★★</div>
                <p class="font-sans text-[#111111]/80 leading-relaxed mb-6 italic">"{{ $item['quote'] }}"</p>
                <div class="flex items-center gap-4">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" loading="lazy" class="w-14 h-14 rounded-full object-cover border-2 border-kids-yellow">
                    <div>
                        <p class="font-bold text-[#111111]">{{ $item['name'] }}</p>
                        <p class="text-sm text-[#111111]/60">{{ $item['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 bg-white relative section-reveal">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 space-y-4">
            <div class="inline-block bg-kids-mint text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                ❓ {{ __('content.faq.badge') }}
            </div>
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#111111]">
                {{ __('content.faq.heading') }}
            </h2>
        </div>
        
        <div class="space-y-4">
            @foreach(__('content.faq.items') as $faq)
            <details class="group bg-[#fafafa] border border-gray-100 rounded-2xl p-6 open:bg-white open:shadow-lg open:border-kids-mint transition-all duration-300">
                <summary class="font-sans font-bold text-lg text-[#111111] cursor-pointer flex justify-between items-center list-none">
                    {{ $faq['q'] }}
                    <span class="text-kids-navy group-open:rotate-180 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </summary>
                <p class="font-sans text-[#111111]/80 mt-4 leading-relaxed pr-8">
                    {{ $faq['a'] }}
                </p>
            </details>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact / Lead Form Section -->
<section id="contact" class="py-32 bg-kids-yellow relative overflow-hidden section-reveal">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-12 space-y-4">
            <div class="inline-block bg-white text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                {{ __('content.lead_form.title') }}
            </div>
            <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111]">
                {{ __('content.contact.heading') }}
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto">
                {{ __('content.lead_form.subtitle') }}
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl relative">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-800 border border-green-200 flex items-start gap-3" role="alert">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold font-sans">Sukses!</h3>
                        <p class="font-sans text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('leads.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="type" value="b2b">
                
                <!-- Honeypot -->
                <div class="hidden" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.name') }} <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required aria-required="true" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror class="w-full px-4 py-3 rounded-xl border-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans">
                        @error('name')
                            <p id="name-error" class="mt-1 text-sm text-red-500 font-sans" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.phone') }} <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required aria-required="true" @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror class="w-full px-4 py-3 rounded-xl border-2 {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-200' }} focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans">
                        @error('phone')
                            <p id="phone-error" class="mt-1 text-sm text-red-500 font-sans" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror class="w-full px-4 py-3 rounded-xl border-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans">
                        @error('email')
                            <p id="email-error" class="mt-1 text-sm text-red-500 font-sans" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="school_name" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.school_name') }}</label>
                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name') }}" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans">
                    </div>
                </div>
                <div>
                    <label for="program" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.program') }}</label>
                    <select id="program" name="program" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans bg-white">
                        <option value="">-- {{ __('content.lead_form.fields.program') }} --</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->slug }}" {{ old('program') == $program->slug ? 'selected' : '' }}>{{ $program->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message" class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.message') }}</label>
                    <textarea id="message" name="message" rows="3" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none focus-visible:ring-2 focus-visible:ring-kids-navy focus-visible:ring-offset-2 transition-colors font-sans resize-none">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="w-full py-4 bg-kids-navy text-white font-bold rounded-full text-lg hover:bg-[#155a6e] transition-colors shadow-[0_8px_0_rgba(153,225,255,1)] hover:shadow-[0_10px_0_rgba(153,225,255,1)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    {{ __('content.lead_form.cta') }}
                </button>
                <div class="text-center mt-3">
                    <span class="font-sans text-xs font-bold text-[#111111]/50">{{ __('content.lead_form.risk_reducer') }}</span>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 font-sans text-[#111111]/70">
            {{ __('content.lead_form.or_call') }} <a href="https://wa.me/6282311341381" class="font-bold text-[#111111] underline hover:no-underline">{{ __('content.contact.phone') }}</a>
        </p>
    </div>
</section>

@endsection
