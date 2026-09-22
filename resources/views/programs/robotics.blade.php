@extends('layouts.app')

@section('title', __('programs.robotics.title') . ' - Erlass Institute')
@section('description', __('programs.robotics.subtitle'))

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-kids-navy text-white overflow-hidden section-reveal">
    <!-- Grid pattern background -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff1a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff1a_1px,transparent_1px)] bg-[size:32px_32px] opacity-20"></div>
    <!-- Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-kids-orange blur-[120px] opacity-30 rounded-full pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-kids-yellow font-bold text-sm tracking-widest mb-6">
            ⚙️ {{ __('programs.robotics.badge') }}
        </span>
        <h1 class="font-serif text-5xl md:text-7xl font-bold mb-6">
            {{ __('programs.robotics.title') }}
        </h1>
        <p class="font-sans text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
            {{ __('programs.robotics.subtitle') }}
        </p>
    </div>

    <!-- Decorative elements -->
    <div class="absolute bottom-10 left-10 hidden lg:block opacity-60">
        <svg data-speed="1.2" class="hero-float text-kids-yellow w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
    </div>
    <div class="absolute top-20 right-10 hidden lg:block opacity-60">
        <svg data-speed="1.1" class="hero-float text-kids-mint w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
    </div>
</section>

<!-- Curriculum Kits -->
<section class="py-24 bg-white section-reveal">
    <div class="max-w-7xl mx-auto px-4 text-center mb-16">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-6">{{ __('programs.robotics.kits_title') }}</h2>
        <p class="font-sans text-[#111111]/60 max-w-2xl mx-auto leading-relaxed text-lg">{{ __('programs.robotics.kits_subtitle') }}</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-10">
        @foreach(__('programs.robotics.kits') as $kit)
        <div class="group relative bg-[#fafafa] rounded-[2rem] p-8 border border-gray-100 hover:border-{{ $kit['color'] }} transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-{{ $kit['color'] }}/20">
            <div class="h-48 bg-white rounded-[1.5rem] mb-8 overflow-hidden border-2 border-gray-100">
                <img src="{{ $kit['image'] }}" 
                     alt="{{ $kit['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
            </div>
            <h3 class="font-sans text-2xl font-bold text-[#111111] mb-3">{{ $kit['title'] }}</h3>
            <p class="font-sans text-[#111111]/70 text-sm leading-relaxed mb-6">
                {{ $kit['desc'] }}
            </p>
             <ul class="text-left space-y-3 font-sans font-medium text-sm text-[#111111]/80">
                @foreach($kit['features'] as $feature)
                 <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-{{ $kit['color'] }} rounded-full flex-shrink-0"></span> {{ $feature }}
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</section>

<!-- Projects List -->
<section class="py-24 bg-kids-mint relative overflow-hidden section-reveal">
    <!-- Background blob -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white opacity-20 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <div class="lg:w-1/3">
                <span class="inline-block bg-white text-kids-navy px-4 py-1.5 font-sans font-bold text-sm tracking-wide rounded-full mb-6 shadow-sm">
                    {{ __('programs.robotics.projects_badge') }}
                </span>
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-6">{{ __('programs.robotics.projects_title') }}</h2>
                <p class="font-sans text-[#111111]/80 mb-8 text-lg leading-relaxed">{{ __('programs.robotics.projects_subtitle') }}</p>
                <a href="{{ route('home') }}#contact" class="inline-flex items-center font-bold text-[#111111] hover:text-white transition-colors text-lg group">
                    {{ __('programs.robotics.projects_link') }}
                    <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
            
            <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-6 w-full">
                @foreach(__('programs.robotics.project_list') as $project)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-start gap-5 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 rounded-2xl bg-{{ $project['color'] }} text-white text-2xl flex items-center justify-center flex-shrink-0 shadow-md">
                        {{ $project['icon'] }}
                    </div>
                    <div>
                        <h4 class="font-sans font-bold text-xl text-[#111111] mb-1">{{ $project['title'] }}</h4>
                        <p class="font-sans text-sm text-[#111111]/70 leading-relaxed">{{ $project['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-32 bg-white text-center section-reveal">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-6">Siap Membangun Teknologi Masa Depan?</h2>
        <p class="font-sans text-xl text-[#111111]/60 mb-10">Bawa pengalaman engineering ke sekolah Anda dengan kurikulum terstruktur dan instruktur ahli kami.</p>
        <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-white transition-all duration-300 bg-kids-orange rounded-full hover:scale-105 shadow-[0_8px_0_#c05621]">
            Jadwalkan Konsultasi Hardware
        </a>
    </div>
</section>

@endsection
