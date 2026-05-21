@extends('layouts.app')

@section('title', 'Coding & AI Curriculum - Erlass Institute')

@section('content')

<!-- Hero -->
<section class="relative pt-32 pb-20 bg-erlass-dark text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 opacity-20 mix-blend-soft-light"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-erlass-blue blur-[120px] rounded-full opacity-40"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-erlass-orange font-bold text-xs uppercase tracking-widest mb-6">Future Skills</span>
        <h1 class="font-manrope text-5xl md:text-7xl font-black mb-6">Coding & Artificial Intelligence</h1>
        <p class="text-xl text-white/70 max-w-3xl mx-auto leading-relaxed">
            Membangun logika berpikir komputasional (Computational Thinking) dari level dasar hingga Machine Learning untuk masa depan anak.
        </p>
    </div>
</section>

<!-- Learning Levels -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="font-manrope text-4xl font-bold text-slate-900 mb-4">Learning Path</h2>
            <p class="text-slate-500 max-w-2xl mx-auto leading-relaxed">Kurikulum kami dirancang bertahap sesuai usia dan perkembangan kognitif anak.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <!-- Connecting Line (Desktop) -->
            <div class="hidden md:block absolute top-12 left-0 w-full h-1 border-t-2 border-dashed border-slate-200 -z-10"></div>

            <!-- Level 1 -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 relative group hover:-translate-y-2 transition-transform duration-300">
                <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-erlass-blue flex items-center justify-center text-4xl shadow-lg mb-6 group-hover:scale-110 transition-transform">
                    🐱
                </div>
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full mb-3">SD (7-12 Tahun)</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Beginner: Visual Coding</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Pengenalan logika pemrograman menggunakan <strong>Scratch</strong>. Fokus pada pembuatan game, animasi, dan storytelling interaktif tanpa perlu mengetik kode.
                    </p>
                    <ul class="text-left space-y-2 text-sm text-slate-600 bg-white p-4 rounded-xl border border-slate-100">
                        <li class="flex items-center gap-2">✅ Sequence & Loops</li>
                        <li class="flex items-center gap-2">✅ Conditional Logic</li>
                        <li class="flex items-center gap-2">✅ Variables Basics</li>
                    </ul>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 relative group hover:-translate-y-2 transition-transform duration-300">
                <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-erlass-orange flex items-center justify-center text-4xl shadow-lg mb-6 group-hover:scale-110 transition-transform">
                    🐍
                </div>
                 <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full mb-3">SMP (13-15 Tahun)</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Intermediate: Python</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Transisi ke <strong>Text-Based Coding</strong>. Belajar sintaks Python, struktur data sderhana, dan logika algoritma yang lebih kompleks.
                    </p>
                    <ul class="text-left space-y-2 text-sm text-slate-600 bg-white p-4 rounded-xl border border-slate-100">
                        <li class="flex items-center gap-2">✅ Python Syntax</li>
                        <li class="flex items-center gap-2">✅ Functions & Modules</li>
                        <li class="flex items-center gap-2">✅ Simple Algorithms</li>
                    </ul>
                </div>
            </div>

            <!-- Level 3 -->
            <div class="bg-slate-900 p-8 rounded-3xl border border-slate-700 relative group hover:-translate-y-2 transition-transform duration-300">
                <div class="w-24 h-24 mx-auto bg-slate-800 rounded-full border-4 border-purple-500 flex items-center justify-center text-4xl shadow-lg mb-6 group-hover:scale-110 transition-transform">
                    🧠
                </div>
                 <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-purple-500/20 text-purple-300 text-xs font-bold rounded-full mb-3">SMA (16+ Tahun)</span>
                    <h3 class="text-xl font-bold text-white mb-3">Advanced: AI & Web</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Penerapan coding untuk teknologi masa depan: <strong>Artificial Intelligence</strong> dan <strong>Web Development</strong> (HTML, CSS, JS).
                    </p>
                    <ul class="text-left space-y-2 text-sm text-slate-300 bg-white/5 p-4 rounded-xl border border-slate-700">
                        <li class="flex items-center gap-2">✅ Machine Learning Intro</li>
                        <li class="flex items-center gap-2">✅ Neural Networks</li>
                        <li class="flex items-center gap-2">✅ API & Databases</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Learning Outcomes -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
             <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[500px]">
                <img src="https://images.unsplash.com/photo-1603354350317-6f7aaa5911c5?auto=format&fit=crop&w=800&q=80" alt="Students Coding" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <blockquote class="text-xl font-medium italic mb-4">"Everyone should learn how to program a computer, because it teaches you how to think."</blockquote>
                    <cite class="not-italic font-bold text-erlass-orange">– Steve Jobs</cite>
                </div>
            </div>
            
            <div>
                 <span class="text-erlass-blue font-bold text-sm uppercase tracking-wider mb-2 block">Skill Development</span>
                <h2 class="font-manrope text-4xl font-bold text-slate-900 mb-8">What They Will Master</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4">
                         <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">🧩</div>
                         <div>
                             <h4 class="font-bold text-slate-900 mb-1">Logical Thinking</h4>
                             <p class="text-sm text-slate-500">Memecahkan masalah besar menjadi langkah-langkah logis.</p>
                         </div>
                    </div>
                    <div class="flex items-start gap-4">
                         <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">🎨</div>
                         <div>
                             <h4 class="font-bold text-slate-900 mb-1">Creative Confidence</h4>
                             <p class="text-sm text-slate-500">Berani mengekspresikan ide menjadi karya digital nyata.</p>
                         </div>
                    </div>
                     <div class="flex items-start gap-4">
                         <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">🔍</div>
                         <div>
                             <h4 class="font-bold text-slate-900 mb-1">Attention to Detail</h4>
                             <p class="text-sm text-slate-500">Ketelitian dalam penulisan kode (syntax) dan debugging error.</p>
                         </div>
                    </div>
                     <div class="flex items-start gap-4">
                         <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center flex-shrink-0">🤝</div>
                         <div>
                             <h4 class="font-bold text-slate-900 mb-1">Persistence</h4>
                             <p class="text-sm text-slate-500">Tidak mudah menyerah saat menghadapi 'bugs' atau tantangan.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tools -->
<section class="py-20 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-slate-500 font-medium mb-8">Tools & Technologies We Teach</p>
        <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
            <!-- Logos (Text Representation for placeholder) -->
            <span class="text-2xl font-black text-slate-800">Scratch</span>
            <span class="text-2xl font-black text-blue-600">Python</span>
            <span class="text-2xl font-black text-orange-500">HTML5</span>
            <span class="text-2xl font-black text-blue-500">CSS3</span>
            <span class="text-2xl font-black text-yellow-500">JavaScript</span>
            <span class="text-2xl font-black text-slate-800">VS Code</span>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="font-manrope text-4xl font-bold text-slate-900 mb-6">Siap Mencetak Programmer Masa Depan?</h2>
        <p class="text-slate-600 mb-8 text-lg">Bergabung dengan 2.000+ siswa lainnya yang telah memulai perjalanan digital mereka bersama Erlass.</p>
        <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-erlass-orange rounded-full hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-xl shadow-orange-500/30">
            Daftar Ekskul Koding
        </a>
    </div>
</section>

@endsection
