<section class="products-section py-32 bg-background relative" id="programs">
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-20 space-y-4">
             <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase">
                {{ __('content.age_groups.subtitle') ?? 'Programs' }}
             </span>
             <h2 class="font-sans text-4xl md:text-5xl lg:text-6xl font-black text-foreground tracking-tight">
                {{ __('content.age_groups.title') ?? 'Explore Our Core Modules' }}
             </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['coding', 'ai', 'robotics'] as $key)
                @php 
                    // Fallback data if translation doesn't exist
                    $group = __('content.age_groups.' . $key); 
                    if (!is_array($group)) {
                        $fallbacks = [
                            'coding' => ['title' => 'Coding Erlass', 'desc' => 'Logic & programming foundations.', 'image' => 'img/cp/11.png', 'range' => '7-15 Years'],
                            'ai' => ['title' => 'Modul Scratch', 'desc' => 'Interactive games and animations.', 'image' => 'img/cp/13.png', 'range' => 'All Ages'],
                            'robotics' => ['title' => 'Robotik Explorer', 'desc' => 'Build and program robots.', 'image' => 'img/cp/10.png', 'range' => '10+ Years'],
                        ];
                        $group = $fallbacks[$key];
                    }
                @endphp
                <div class="product-card relative group" data-cursor="explore">
                    <div class="relative bg-card border border-border shadow-md rounded-[2rem] hover:shadow-2xl hover:shadow-primary/10 hover:border-border/80 transition-all duration-500 flex flex-col h-full hover:-translate-y-2 overflow-hidden">
                        
                        <div class="h-56 bg-muted overflow-hidden relative border-b border-border/50">
                             <img src="{{ asset($group['image'] ?? '') }}" class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700 fallback-gradient" alt="{{ $group['title'] }}">
                             <div class="absolute inset-0 bg-gradient-to-t from-background/90 to-transparent z-10"></div>
                             
                             <div class="absolute bottom-4 left-6 z-20">
                                <span class="bg-background/90 backdrop-blur-md text-foreground border border-border text-sm font-bold px-4 py-1.5 rounded-full shadow-sm">
                                    {{ $group['range'] }}
                                </span>
                             </div>
                        </div>

                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="font-sans text-2xl font-black text-card-foreground mb-4 group-hover:text-primary transition-colors">{{ $group['title'] }}</h3>
                            <p class="font-sans text-muted-foreground mb-8 leading-relaxed flex-grow">
                                {{ $group['desc'] }}
                            </p>

                            <a href="#" class="w-full py-4 rounded-xl font-bold text-foreground bg-secondary/50 hover:bg-primary hover:text-primary-foreground transition-colors text-center flex items-center justify-center gap-2 group/btn">
                                Explore
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
