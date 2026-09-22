<section id="videos" class="py-32 bg-[#fafafa] relative overflow-hidden section-reveal">
    <!-- Decorative blobs -->
    <div class="absolute top-20 left-0 w-64 h-64 bg-kids-mint/20 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute bottom-20 right-0 w-64 h-64 bg-kids-pink/20 rounded-full blur-[80px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-16 space-y-6">
            <div class="inline-block bg-kids-pink text-white px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm rounded-full">
                {{ __('content.video.badge') }}
            </div>
            <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111]">
                {{ __('content.video.title') }}
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto font-medium">
                {{ __('content.video.subtitle') }}
            </p>
        </div>

        <!-- Video Container -->
        <div class="max-w-4xl mx-auto relative group">
            
            <!-- Playful 3D Frame Effect -->
            <div class="absolute inset-0 bg-kids-yellow rounded-[2rem] transform translate-x-4 translate-y-4 shadow-[0_15px_0_rgba(255,214,0,1)] -z-10 group-hover:translate-x-6 group-hover:translate-y-6 transition-transform duration-500"></div>
            
            <div class="absolute inset-0 bg-kids-blue rounded-[2rem] transform -translate-x-4 -translate-y-4 shadow-[-10px_-10px_0_rgba(153,225,255,1)] -z-20"></div>

            <!-- Actual Video Player -->
            <div class="relative bg-white rounded-[2rem] p-4 md:p-6 shadow-2xl border-4 border-[#111111] overflow-hidden z-10 transition-transform duration-500 hover:scale-[1.01]">
                
                <!-- Inner Aspect Ratio Container (16:9) -->
                <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-black">
                    <!-- Placeholder YouTube Embed. Ganti src dengan link YouTube Ads Erlass -->
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/4ChxzPxI9xQ?start=56&rel=0&modestbranding=1" 
                        title="Erlass Institute Program Showcase Video" 
                        loading="lazy"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Decorative corner dots -->
                <div class="absolute top-4 left-4 w-3 h-3 rounded-full bg-kids-pink"></div>
                <div class="absolute top-4 right-4 w-3 h-3 rounded-full bg-kids-mint"></div>
            </div>
        </div>

    </div>
</section>
