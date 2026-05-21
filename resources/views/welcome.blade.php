@extends('layouts.app')

@section('title', 'Erlass - Mitra Pelatihan, Ekskul & P5 di Sekolah')

@section('content')

<!-- Hero Section -->
<x-hero />

<!-- About Erlass Section -->
<section id="about" class="py-32 bg-white relative overflow-hidden section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto items-center text-center">

            <!-- Text Content -->
            <div class="space-y-8 about-content relative z-20 flex flex-col items-center">
                <div class="inline-block bg-kids-pink text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                    Erlass Mitra Pendidikan
                </div>
                
                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111] leading-tight">
                    Bukan Sekadar<br/>Penyedia Program
                </h2>
                
                <p class="font-sans text-lg text-gray-700 leading-relaxed max-w-xl">
                    KAMI adalah mitra pendidikan yang menghadirkan program inovatif untuk siswa dan guru yang dirancang sesuai kebutuhan sekolah di Indonesia. Kami memahami bahwa sekolah membutuhkan program yang tidak membebani guru, efektif untuk siswa, dan berjalan konsisten sepanjang tahun.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-4 text-left">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 text-kids-yellow flex-shrink-0"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                        <span class="font-bold text-[#111111] font-sans">150+ Sekolah Mitra</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 text-kids-pink flex-shrink-0"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg></div>
                        <span class="font-bold text-[#111111] font-sans">2.000+ Siswa Terlatih</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 text-[#ff7f50] flex-shrink-0"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg></div>
                        <span class="font-bold text-[#111111] font-sans">140.000+ Guru Terhubung</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 text-kids-mint flex-shrink-0"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                        <span class="font-bold text-[#111111] font-sans">70+ Instruktur Profesional</span>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="#programs" class="group relative inline-flex items-center justify-center px-10 py-4 bg-kids-yellow text-kids-navy font-bold rounded-full transition-all duration-300 hover:scale-105 shadow-[0_8px_0_rgba(153,225,255,1)] hover:shadow-[0_10px_0_rgba(153,225,255,1)]">
                        <span class="font-sans text-lg tracking-wide">Lihat Program Kami</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Handprints Decorative Right -->
    <div class="absolute top-0 right-0 w-24 h-full pointer-events-none hidden lg:flex flex-col justify-between items-end opacity-80 z-0 py-8">
        <svg class="w-16 h-16 text-[#1d758b] transform -translate-x-4 rotate-12" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg class="w-20 h-20 text-[#99e1ff] transform translate-x-2 -rotate-12" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg class="w-16 h-16 text-[#ffb3c6] transform -translate-x-6 rotate-45" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg class="w-24 h-24 text-[#ff7f50] transform translate-x-4 -rotate-6" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
        <svg class="w-16 h-16 text-[#99e1ff] transform -translate-x-2 rotate-12" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.8L19,10.2l1.6-4.5c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6L17,9.5l-0.7-3.6C16.2,5.3,15.7,5,15.2,5.1 c-0.5,0.1-0.9,0.6-0.8,1.2L15,10l-2.4-2.8c-0.4-0.4-1-0.5-1.4-0.1s-0.5,1-0.1,1.4l3.1,3.7c-0.7,0.7-1.4,1.6-1.6,2.7 c-0.2,1.3,0.2,2.7,1.1,3.7c0.8,1,1.9,1.5,3.2,1.5c0.4,0,0.8-0.1,1.2-0.2c2.1-0.7,3.3-2.9,2.8-5C20.6,13.6,19.9,12.5,19,11.8L21.5,10.8z"/></svg>
    </div>
</section>

<!-- Why Choose Us Section -->
@include('sections.why-choose-us')

<!-- Programs Section -->
<section id="programs" class="py-32 bg-[#fafafa] relative section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-6">
            <div class="inline-block bg-kids-pink text-white px-4 py-1 font-bold text-sm">
                Program Unggulan
            </div>
            <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111]">
                Koding & Robotika untuk Sekolah
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto font-medium">
                Pilih paket program ekstrakurikuler/intrakurikuler yang paling sesuai dengan target kompetensi digital siswa Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card: Coding -->
            <a href="{{ route('programs.coding') }}" class="group bg-white border-2 border-kids-blue rounded-3xl p-8 hover:shadow-[0_12px_0_rgba(153,225,255,1)] hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-[#f0f9ff] rounded-full flex items-center justify-center mb-6 text-4xl group-hover:scale-110 transition-transform">💻</div>
                <h3 class="font-serif text-xl font-bold text-kids-navy mb-3">Koding Scratch & Python</h3>
                <p class="font-sans text-[#111111]/70 leading-relaxed text-sm mb-4">Dari visual blok (Scratch) hingga text-based coding (Python Turtle) dan Kecerdasan Artifisial.</p>
                <span class="font-sans text-kids-navy font-bold text-sm group-hover:underline">Lihat Kurikulum →</span>
            </a>

            <!-- Card: Robotika -->
            <a href="{{ route('programs.robotics') }}" class="group bg-white border-2 border-kids-yellow rounded-3xl p-8 hover:shadow-[0_12px_0_rgba(255,214,0,1)] hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-[#fffdf0] rounded-full flex items-center justify-center mb-6 text-4xl group-hover:scale-110 transition-transform">🤖</div>
                <h3 class="font-serif text-xl font-bold text-kids-navy mb-3">Robotika & IoT</h3>
                <p class="font-sans text-[#111111]/70 leading-relaxed text-sm mb-4">Micro:bit, Robotic Explorer, Erboblox, dan Arduino. Proyek DIY berbasis STEAM.</p>
                <span class="font-sans text-kids-navy font-bold text-sm group-hover:underline">Lihat Kurikulum →</span>
            </a>

            <!-- Card: P5 & Training -->
            <div class="group bg-white border-2 border-[#ff7f50] rounded-3xl p-8 hover:shadow-[0_12px_0_rgba(255,127,80,1)] hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-[#fff5f0] rounded-full flex items-center justify-center mb-6 text-4xl group-hover:scale-110 transition-transform">🎓</div>
                <h3 class="font-serif text-xl font-bold text-kids-navy mb-3">P5 & Pelatihan Guru</h3>
                <p class="font-sans text-[#111111]/70 leading-relaxed text-sm mb-4">Program Penguatan Profil Pelajar Pancasila serta pelatihan soft skill untuk guru dan siswa.</p>
                <span class="font-sans text-kids-navy font-bold text-sm">Coming Soon</span>
            </div>
        </div>

    </div>
</section>

<!-- Clients Marquee -->
@include('sections.clients')

<!-- Testimoni Section -->
<section id="testimoni" class="py-32 bg-white relative section-reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-6">
            <div class="inline-block bg-kids-pink text-kids-navy px-5 py-1.5 font-sans font-bold text-sm tracking-wide shadow-sm">
                Kisah Sukses
            </div>
            <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-[#111111]">
                Apa Kata Mereka?
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto font-medium">
                Bukti nyata dari sekolah, guru, dan orang tua yang telah merasakan manfaat dari program Koding dan Robotika Erlass.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimoni 1 -->
            <div class="bg-[#fafafa] border border-gray-100 rounded-3xl p-8 relative">
                <div class="text-kids-yellow text-3xl mb-4">★★★★★</div>
                <p class="font-sans text-[#111111]/80 leading-relaxed mb-6 italic">"Program ekskul koding dari Erlass sangat terstruktur. Guru kami tidak perlu repot menyiapkan materi karena instruktur Erlass sangat profesional."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kids-blue rounded-full flex items-center justify-center font-bold text-white text-lg">S</div>
                    <div>
                        <p class="font-bold text-[#111111]">Ibu Sri Wahyuni</p>
                        <p class="text-sm text-[#111111]/60">Wakasek Kurikulum, SD Al-Azhar</p>
                    </div>
                </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-[#fafafa] border border-gray-100 rounded-3xl p-8 relative">
                <div class="text-kids-yellow text-3xl mb-4">★★★★★</div>
                <p class="font-sans text-[#111111]/80 leading-relaxed mb-6 italic">"Anak saya jadi lebih percaya diri setelah ikut kelas Robotika. Dia bahkan menang kompetisi tingkat nasional berkat bimbingan dari tim Erlass."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kids-pink rounded-full flex items-center justify-center font-bold text-white text-lg">R</div>
                    <div>
                        <p class="font-bold text-[#111111]">Bapak Rudi Hartono</p>
                        <p class="text-sm text-[#111111]/60">Orang Tua Siswa, SMP Labschool</p>
                    </div>
                </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-[#fafafa] border border-gray-100 rounded-3xl p-8 relative">
                <div class="text-kids-yellow text-3xl mb-4">★★★★★</div>
                <p class="font-sans text-[#111111]/80 leading-relaxed mb-6 italic">"Pelatihan guru dari Erlass membuka wawasan kami tentang teknologi di kelas. Sekarang kami lebih percaya diri mengajarkan literasi digital."</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kids-mint rounded-full flex items-center justify-center font-bold text-white text-lg">A</div>
                    <div>
                        <p class="font-bold text-[#111111]">Ibu Anisa Dewi</p>
                        <p class="text-sm text-[#111111]/60">Guru TIK, SMP Global Islamic School</p>
                    </div>
                </div>
            </div>
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
                Jadwalkan Konsultasi Gratis
            </h2>
            <p class="font-sans text-lg text-[#111111]/80 max-w-2xl mx-auto">
                {{ __('content.lead_form.subtitle') }}
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl">
            <form action="{{ route('leads.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.name') }}</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans">
                    </div>
                    <div>
                        <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.phone') }}</label>
                        <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.email') }}</label>
                        <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans">
                    </div>
                    <div>
                        <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.school_name') }}</label>
                        <input type="text" name="school_name" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans">
                    </div>
                </div>
                <div>
                    <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.program') }}</label>
                    <select name="program" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans bg-white">
                        <option value="">-- Pilih Program --</option>
                        <option value="coding">Koding Scratch & Python</option>
                        <option value="robotics">Robotika & IoT</option>
                        <option value="ai">Koding AI</option>
                        <option value="p5">P5 & Pelatihan Guru</option>
                    </select>
                </div>
                <div>
                    <label class="block font-sans font-bold text-sm text-[#111111] mb-2">{{ __('content.lead_form.fields.message') }}</label>
                    <textarea name="message" rows="3" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-kids-navy focus:outline-none transition-colors font-sans resize-none"></textarea>
                </div>
                <button type="submit" class="w-full py-4 bg-kids-navy text-white font-bold rounded-full text-lg hover:bg-[#155a6e] transition-colors shadow-[0_8px_0_rgba(153,225,255,1)] hover:shadow-[0_10px_0_rgba(153,225,255,1)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    {{ __('content.lead_form.cta') }}
                </button>
            </form>
        </div>

        <p class="text-center mt-8 font-sans text-[#111111]/70">
            Atau hubungi langsung: <a href="https://wa.me/6282311341381" class="font-bold text-[#111111] underline hover:no-underline">{{ __('content.contact.phone') }}</a>
        </p>
    </div>
</section>

@endsection
