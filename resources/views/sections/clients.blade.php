<section class="py-24 bg-background overflow-hidden relative" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
    <div class="text-center mb-16 relative z-10">
        <h2 class="text-sm font-black tracking-widest uppercase text-muted-foreground mb-4">Our Amazing Clients</h2>
    </div>
    
    <!-- Row 1: Left -->
    <div class="flex whitespace-nowrap mb-6 [&:hover>div]:[animation-play-state:paused] relative z-0">
        <div class="flex gap-8 [animation:marquee-left_30s_linear_infinite] px-4 w-[200%]">
            @for($i=1; $i<=10; $i++)
                <div class="w-48 h-24 bg-card rounded-2xl flex items-center justify-center border border-border shadow-sm shrink-0 transition-colors hover:border-primary/50 p-6 overflow-hidden">
                    <img src="{{ asset('img/cp/' . $i . '.png') }}" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300" alt="Client {{ $i }}">
                </div>
            @endfor
            @for($i=1; $i<=10; $i++)
                <div class="w-48 h-24 bg-card rounded-2xl flex items-center justify-center border border-border shadow-sm shrink-0 transition-colors hover:border-primary/50 p-6 overflow-hidden" aria-hidden="true">
                    <img src="{{ asset('img/cp/' . $i . '.png') }}" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300" alt="Client {{ $i }}">
                </div>
            @endfor
        </div>
    </div>

    <!-- Row 2: Right -->
    <div class="flex whitespace-nowrap [&:hover>div]:[animation-play-state:paused] relative z-0">
        <div class="flex gap-8 [animation:marquee-right_30s_linear_infinite] px-4 w-[200%] -ml-[50%]">
            @for($i=11; $i<=20; $i++)
                <div class="w-48 h-24 bg-card rounded-2xl flex items-center justify-center border border-border shadow-sm shrink-0 transition-colors hover:border-primary/50 p-6 overflow-hidden">
                    <img src="{{ asset('img/cp/' . $i . '.png') }}" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300" alt="Partner {{ $i }}">
                </div>
            @endfor
            @for($i=11; $i<=20; $i++)
                <div class="w-48 h-24 bg-card rounded-2xl flex items-center justify-center border border-border shadow-sm shrink-0 transition-colors hover:border-primary/50 p-6 overflow-hidden" aria-hidden="true">
                    <img src="{{ asset('img/cp/' . $i . '.png') }}" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300" alt="Partner {{ $i }}">
                </div>
            @endfor
        </div>
    </div>
</section>
