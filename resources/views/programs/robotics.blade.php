@extends('layouts.app')

@section('title', 'Robotics & IoT Curriculum - Erlass Institute')

@section('content')

<!-- Hero -->
<section class="relative pt-32 pb-20 bg-slate-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-erlass-orange blur-[150px] opacity-20 rounded-full"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-erlass-orange/20 border border-erlass-orange/40 text-erlass-orange font-bold text-xs uppercase tracking-widest mb-6">Engineering & Innovation</span>
        <h1 class="font-manrope text-5xl md:text-7xl font-black mb-6">Robotics & IoT</h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto leading-relaxed">
            Menghubungkan kode dengan dunia nyata. Dari mekanik dasar hingga Internet of Things (IoT) yang cerdas.
        </p>
    </div>
</section>

<!-- Curriculum Kits -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center mb-16">
        <h2 class="font-manrope text-4xl font-bold text-slate-900 mb-4">Learning Kits & Modules</h2>
        <p class="text-slate-500 max-w-2xl mx-auto">Kami menggunakan perangkat standar industri pendidikan untuk memastikan siswa memahami konsep elektronika dan pemrograman hardware.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Kit 1 -->
        <div class="group relative bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-erlass-blue/50 transition-all duration-300 hover:shadow-2xl hover:shadow-erlass-blue/10">
            <div class="h-48 bg-white rounded-2xl mb-8 overflow-hidden border border-slate-100 group-hover:scale-105 transition-transform">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=400&q=80" 
                     alt="Robotic Explorer Kit" 
                     class="w-full h-full object-cover" loading="lazy">
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Robotic Explorer</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                Fokus pada konsep elektronika dasar, mekanik, dan sensor. Siswa merakit robot yang dapat bergerak dan merespons lingkungan fisik.
            </p>
            <ul class="text-left space-y-2">
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-erlass-blue rounded-full"></span> Konsep Rangkaian Listrik
                </li>
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-erlass-blue rounded-full"></span> Sensor Cahaya & Sentuh
                </li>
            </ul>
        </div>

        <!-- Kit 2 -->
        <div class="group relative bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-erlass-orange/50 transition-all duration-300 hover:shadow-2xl hover:shadow-erlass-orange/10">
            <div class="h-48 bg-white rounded-2xl mb-8 overflow-hidden border border-slate-100 group-hover:scale-105 transition-transform">
                <img src="https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=400&q=80" 
                     alt="Micro:bit Learning Kit" 
                     class="w-full h-full object-cover" loading="lazy">
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Micro:bit Learning</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                Pocket-sized computer yang mengenalkan hubungan software dan hardware. Sangat visual dengan LED matrix 5x5.
            </p>
             <ul class="text-left space-y-2">
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-erlass-orange rounded-full"></span> Accelerometer & Compass
                </li>
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-erlass-orange rounded-full"></span> Radio Communication
                </li>
            </ul>
        </div>

        <!-- Kit 3 -->
        <div class="group relative bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-purple-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/10">
            <div class="h-48 bg-white rounded-2xl mb-8 overflow-hidden border border-slate-100 group-hover:scale-105 transition-transform">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80" 
                     alt="Arduino & IoT Kit" 
                     class="w-full h-full object-cover" loading="lazy">
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Arduino & IoT</h3>
            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                Level lanjut menggunakan bahasa C++. Membuat sistem otomasi rumah pintar (Smart Home) dan proyek Internet of Things.
            </p>
             <ul class="text-left space-y-2">
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span> Bahasa Pemrograman C++
                </li>
                 <li class="flex items-center gap-2 text-sm text-slate-700">
                    <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span> Wi-Fi Modules (ESP8266)
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Projects List -->
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-12">
            <div class="md:w-1/3">
                <span class="text-erlass-blue font-bold text-sm uppercase tracking-wider mb-2 block">Project Based Learning</span>
                <h2 class="font-manrope text-4xl font-bold text-slate-900 mb-6">100+ Proyek STEM</h2>
                <p class="text-slate-600 mb-6">Kami percaya cara terbaik belajar engineering adalah dengan membangun. Kurikulum kami mencakup ratusan proyek praktis.</p>
                <a href="#contact" class="text-erlass-blue font-bold hover:underline">Lihat Katalog Modul &rarr;</a>
            </div>
            <div class="md:w-2/3 grid grid-cols-2 md:grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">🌱</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Smart Garden</h4>
                        <p class="text-xs text-slate-500 mt-1">Sensor kelembaban tanah otomatis menyiram tanaman.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">🗑️</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Smart Trash Bin</h4>
                        <p class="text-xs text-slate-500 mt-1">Tempat sampah otomatis terbuka saat mendeteksi tangan.</p>
                    </div>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">🏠</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Home Automation</h4>
                        <p class="text-xs text-slate-500 mt-1">Kontrol lampu dan kipas via Smartphone (IoT).</p>
                    </div>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">🚗</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Line Follower</h4>
                        <p class="text-xs text-slate-500 mt-1">Robot mobil otonom mengikuti garis lintasan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
