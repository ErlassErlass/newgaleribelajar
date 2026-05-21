<!-- resources/views/sections/why-us.blade.php -->
<section class="why-section relative h-[90vh] flex items-center justify-center overflow-hidden bg-black text-white rounded-[3rem] mx-4 md:mx-8 my-24 lg:my-32 shadow-2xl">
    <!-- Parallax Background -->
    <div class="parallax-bg absolute inset-0 -top-[30%] h-[130%] w-full z-0 bg-cover bg-center" style="background-image: url('{{ asset('img/cp/31.png') }}');">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Foreground -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
        <span class="inline-flex items-center gap-2 px-3 py-1 mb-8 rounded-full bg-primary/20 text-white border border-primary/30 text-xs font-bold tracking-widest uppercase">
            Why Choose Us
        </span>
        <h2 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 tracking-tighter drop-shadow-lg leading-tight">
            Kenapa Pilih <span class="text-primary">Galeri Belajar?</span>
        </h2>
        <p class="reveal-text text-xl md:text-3xl font-medium leading-relaxed text-white/90">
            Memberikan inovasi berkelanjutan untuk generasi masa depan dengan kurikulum yang relevan, instruktur yang tersertifikasi, dan dukungan penuh berbasis proyek.
        </p>
    </div>
</section>
