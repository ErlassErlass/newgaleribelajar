<!-- resources/views/sections/product-detail.blade.php -->
<section class="relative bg-background overflow-hidden h-scroll-wrapper" data-cursor="drag">
    <!-- Pin wrapper ensures no layout jumps when pinned -->
    <div class="h-scroll-container flex h-screen w-[400vw]">
        
        <!-- Panel 1 -->
        <div class="h-panel w-screen h-full flex flex-col md:flex-row items-center justify-center p-8 md:p-24 border-r border-border/20">
            <div class="w-full md:w-1/2 md:pr-16 mb-12 md:mb-0">
                <span class="text-primary font-black tracking-widest text-sm uppercase mb-4 block">01 / Process</span>
                <h3 class="text-4xl md:text-6xl font-black mb-6 text-foreground tracking-tighter">Interaktif & Menyenangkan</h3>
                <p class="text-lg md:text-2xl text-muted-foreground leading-relaxed">Pembelajaran berbasis aktivitas fisik dan digital untuk anak. Membuat koding terasa seperti bermain.</p>
            </div>
            <div class="w-full md:w-1/2 h-64 md:h-[60vh] bg-muted/50 rounded-[3rem] border border-border shadow-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-secondary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <!-- Visual Image -->
                <img src="{{ asset('img/cp/12.png') }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500 scale-105 group-hover:scale-100 transition-transform" alt="Interaktif">
            </div>
        </div>

        <!-- Panel 2 -->
        <div class="h-panel w-screen h-full flex flex-col md:flex-row items-center justify-center p-8 md:p-24 border-r border-border/20">
            <div class="w-full md:w-1/2 md:pr-16 mb-12 md:mb-0">
                <span class="text-secondary font-black tracking-widest text-sm uppercase mb-4 block">02 / Creativity</span>
                <h3 class="text-4xl md:text-6xl font-black mb-6 text-foreground tracking-tighter">Kreatif Tanpa Batas</h3>
                <p class="text-lg md:text-2xl text-muted-foreground leading-relaxed">Memacu imajinasi melalui pembuatan game dan seni digital mandiri tanpa batasan template.</p>
            </div>
            <div class="w-full md:w-1/2 h-64 md:h-[60vh] bg-muted/50 rounded-[3rem] border border-border shadow-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-secondary/20 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <img src="{{ asset('img/cp/14.png') }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500 scale-105 group-hover:scale-100 transition-transform" alt="Kreativitas">
            </div>
        </div>

        <!-- Panel 3 -->
        <div class="h-panel w-screen h-full flex flex-col md:flex-row items-center justify-center p-8 md:p-24 border-r border-border/20">
            <div class="w-full md:w-1/2 md:pr-16 mb-12 md:mb-0">
                 <span class="text-primary font-black tracking-widest text-sm uppercase mb-4 block">03 / Standard</span>
                <h3 class="text-4xl md:text-6xl font-black mb-6 text-foreground tracking-tighter">Tersertifikasi Global</h3>
                <p class="text-lg md:text-2xl text-muted-foreground leading-relaxed">Kurikulum komprehensif yang mengikuti standar edukasi TIK tingkat internasional.</p>
            </div>
            <div class="w-full md:w-1/2 h-64 md:h-[60vh] bg-muted/50 rounded-[3rem] border border-border shadow-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-secondary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <img src="{{ asset('img/cp/17.png') }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500 scale-105 group-hover:scale-100 transition-transform" alt="Sertifikasi">
            </div>
        </div>

        <!-- Panel 4 -->
        <div class="h-panel w-screen h-full flex flex-col md:flex-row items-center justify-center p-8 md:p-24">
            <div class="w-full md:w-1/2 md:pr-16 mb-12 md:mb-0">
                 <span class="text-foreground font-black tracking-widest text-sm uppercase mb-4 block">04 / Mentorship</span>
                <h3 class="text-4xl md:text-6xl font-black mb-6 text-foreground tracking-tighter">Pendidik Berkualitas</h3>
                <p class="text-lg md:text-2xl text-muted-foreground leading-relaxed">Para pengajar profesional siap mendampingi kesuksesan setiap siswa dengan sabar dan metode teruji.</p>
            </div>
            <div class="w-full md:w-1/2 h-64 md:h-[60vh] bg-muted/50 rounded-[3rem] border border-border shadow-xl relative overflow-hidden group">
               <div class="absolute inset-0 bg-gradient-to-tr from-secondary/20 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <img src="{{ asset('img/cp/22.png') }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500 scale-105 group-hover:scale-100 transition-transform" alt="Mentorship">
            </div>
        </div>
        
    </div>
</section>
