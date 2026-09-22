@extends('layouts.app')

@section('title', __('programs.coding.title') . ' - Erlass Institute')
@section('description', __('programs.coding.subtitle'))

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 bg-[#fafafa] overflow-hidden section-reveal">
    <!-- Decorative blobs -->
    <div class="absolute top-20 left-0 w-64 h-64 bg-kids-blue/20 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-kids-yellow/30 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1.5 px-4 rounded-full bg-white shadow-sm border border-gray-100 text-kids-navy font-bold text-sm tracking-widest mb-6">
            💻 {{ __('programs.coding.badge') }}
        </span>
        <h1 class="font-serif text-5xl md:text-7xl font-bold mb-6 text-[#111111]">
            {{ __('programs.coding.title') }}
        </h1>
        <p class="font-sans text-xl text-[#111111]/70 max-w-3xl mx-auto leading-relaxed">
            {{ __('programs.coding.subtitle') }}
        </p>
    </div>

    <!-- Handprints Decorative Right -->
    <div class="absolute top-0 right-0 w-24 h-full pointer-events-none hidden lg:flex flex-col justify-between items-end opacity-60 z-0 py-8" aria-hidden="true">
        <svg data-speed="1.1" class="hero-float w-16 h-16 text-kids-blue transform -translate-x-4 rotate-12" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg data-speed="1.3" class="hero-float w-20 h-20 text-kids-yellow transform translate-x-2 -rotate-12" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
    </div>
</section>

<!-- Learning Levels -->
<section class="py-24 bg-white section-reveal">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="font-serif text-4xl font-bold text-[#111111] mb-4">{{ __('programs.coding.path_title') }}</h2>
            <p class="font-sans text-[#111111]/60 max-w-2xl mx-auto leading-relaxed">{{ __('programs.coding.path_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <!-- Connecting Line (Desktop) -->
            <div class="hidden md:block absolute top-12 left-0 w-full h-1 border-t-4 border-dashed border-gray-100 -z-10"></div>

            @foreach(__('programs.coding.levels') as $level)
            <!-- Level Card -->
            <div class="bg-white p-8 rounded-3xl border-4 border-gray-100 relative group hover:-translate-y-2 transition-transform duration-300 hover:border-{{ $level['color'] }} shadow-sm hover:shadow-xl hover:shadow-{{ $level['color'] }}/20">
                <div class="w-24 h-24 mx-auto bg-{{ $level['color'] }} text-white rounded-full flex items-center justify-center text-4xl shadow-lg mb-6 group-hover:scale-110 transition-transform shadow-[0_8px_0_rgba(17,17,17,0.1)]">
                    {{ $level['icon'] }}
                </div>
                <div class="text-center">
                    <span class="inline-block px-4 py-1.5 bg-gray-100 text-[#111111] text-xs font-bold rounded-full mb-4">{{ $level['badge'] }}</span>
                    <h3 class="font-sans text-2xl font-bold text-[#111111] mb-3">{{ $level['title'] }}</h3>
                    <p class="font-sans text-[#111111]/70 text-sm leading-relaxed mb-6">
                        {{ $level['desc'] }}
                    </p>
                    <ul class="text-left space-y-3 text-sm font-sans font-medium text-[#111111]/80 bg-[#fafafa] p-5 rounded-2xl border border-gray-100">
                        @foreach($level['features'] as $feature)
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-{{ $level['color'] }}"></span> 
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Learning Outcomes -->
<section class="py-24 bg-kids-yellow relative overflow-hidden section-reveal">
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
             <div class="relative rounded-[2rem] overflow-hidden shadow-2xl h-[500px] border-4 border-[#111111] transform -rotate-2 hover:rotate-0 transition-transform duration-500 group">
                <img src="https://images.unsplash.com/photo-1603354350317-6f7aaa5911c5?auto=format&fit=crop&w=800&q=80" alt="Students Coding" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <blockquote class="font-serif text-2xl font-medium italic mb-4">"Everyone should learn how to program a computer, because it teaches you how to think."</blockquote>
                    <cite class="not-italic font-sans font-bold text-kids-yellow">– Steve Jobs</cite>
                </div>
            </div>
            
            <div>
                 <span class="inline-block bg-white text-kids-navy px-4 py-1.5 font-sans font-bold text-sm tracking-wide rounded-full mb-4 shadow-sm">
                    {{ __('programs.coding.mastery_badge') }}
                 </span>
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#111111] mb-10">{{ __('programs.coding.mastery_title') }}</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @foreach(__('programs.coding.mastery_skills') as $skill)
                    <div class="flex items-start gap-4">
                         <div class="w-12 h-12 rounded-2xl bg-white text-3xl flex items-center justify-center flex-shrink-0 shadow-sm border border-gray-100">{{ $skill['icon'] }}</div>
                         <div>
                             <h4 class="font-sans font-bold text-xl text-[#111111] mb-1">{{ $skill['title'] }}</h4>
                             <p class="font-sans text-sm text-[#111111]/80">{{ $skill['desc'] }}</p>
                         </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tools -->
<section class="py-20 bg-white section-reveal">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="font-sans font-bold text-[#111111]/50 mb-10 tracking-widest uppercase">{{ __('programs.coding.tools_title') }}</p>
        <div class="flex flex-wrap justify-center gap-6 md:gap-12">
            <div class="px-6 py-3 bg-[#fafafa] rounded-2xl border border-gray-100 font-bold text-xl text-[#111111] hover:bg-kids-pink hover:text-white transition-colors duration-300">Scratch</div>
            <div class="px-6 py-3 bg-[#fafafa] rounded-2xl border border-gray-100 font-bold text-xl text-[#111111] hover:bg-kids-blue hover:text-white transition-colors duration-300">Python</div>
            <div class="px-6 py-3 bg-[#fafafa] rounded-2xl border border-gray-100 font-bold text-xl text-[#111111] hover:bg-kids-yellow hover:text-[#111111] transition-colors duration-300">HTML5 / CSS3</div>
            <div class="px-6 py-3 bg-[#fafafa] rounded-2xl border border-gray-100 font-bold text-xl text-[#111111] hover:bg-kids-mint hover:text-white transition-colors duration-300">JavaScript</div>
            <div class="px-6 py-3 bg-[#fafafa] rounded-2xl border border-gray-100 font-bold text-xl text-[#111111] hover:bg-gray-800 hover:text-white transition-colors duration-300">VS Code</div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-32 bg-kids-navy text-white text-center relative overflow-hidden section-reveal">
    <div class="absolute top-0 right-0 w-64 h-64 bg-kids-pink blur-[100px] opacity-30 rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-kids-blue blur-[100px] opacity-30 rounded-full"></div>
    
    <div class="max-w-3xl mx-auto px-4 relative z-10">
        <h2 class="font-serif text-4xl md:text-5xl font-bold mb-6">{{ __('programs.coding.cta_title') }}</h2>
        <p class="font-sans text-xl text-white/80 mb-10">{{ __('programs.coding.cta_subtitle') }}</p>
        <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-kids-navy transition-all duration-300 bg-kids-yellow rounded-full hover:scale-105 shadow-[0_8px_0_rgba(255,214,0,0.5)]">
            {{ __('programs.coding.cta_button') }}
        </a>
    </div>
</section>

@endsection
