<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Erlass Institute - Premium Koding & Robotik untuk Siswa')</title>
    <meta name="title" content="@yield('title', 'Erlass Institute - Koding, Robotik & AI untuk Siswa SD & SMP')">
    <meta name="description" content="Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (AI), dan robotika untuk tingkat SD dan SMP di Indonesia. Kurikulum berbasis proyek dan teknologi terkini.">
    <meta name="keywords" content="kursus koding anak, belajar robotik anak, ekstrakurikuler koding indonesia, kelas microbit, scratch programming, python turtle, arduino untuk siswa, pendampingan guru teknologi, AI for kids indonesia, koding untuk anak SD">
    <meta name="author" content="PT Erlass Prokreatif Indonesia">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Erlass Institute - Koding & Robotik untuk Siswa')">
    <meta property="og:description" content="Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (KA), dan robotika untuk tingkat SD dan SMP di Indonesia.">
    <!-- Image for sharing. Make sure the path is accessible. -->
    <meta property="og:image" content="{{ asset('img/cp/11.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Erlass Institute - Koding & Robotik untuk Siswa')">
    <meta property="twitter:description" content="Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (KA), dan robotika untuk SD dan SMP.">
    <meta property="twitter:image" content="{{ asset('img/cp/11.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-background font-sans text-foreground antialiased overflow-x-hidden selection:bg-primary selection:text-primary-foreground">

    <!-- 3D Background Canvas -->
    <canvas id="hero-canvas" class="fixed top-0 left-0 w-full h-full -z-10 opacity-30 pointer-events-none"></canvas>

    <!-- Navigation (Full Width, Substantial, Premium) -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-500 glass-pro" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <span class="font-manrope font-extrabold text-2xl tracking-tighter text-primary">
                        ERLASS
                    </span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-10 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-muted-foreground hover:text-primary transition-colors relative group py-2">
                        {{ __('content.nav.home') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('home') }}#about" class="text-sm font-bold text-muted-foreground hover:text-primary transition-colors relative group py-2">
                        {{ __('content.nav.about') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </a>
                    <!-- Updated Programs Link to be more useful if clicked, scanning expands perception -->
                    <a href="{{ route('home') }}#programs" class="text-sm font-bold text-muted-foreground hover:text-primary transition-colors relative group py-2">
                        {{ __('content.nav.programs') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </a>
                    <!-- New Gallery Link -->
                    <a href="{{ route('gallery') }}" class="text-sm font-bold text-muted-foreground hover:text-primary transition-colors relative group py-2">
                        {{ __('content.nav.gallery') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                    </a>

                    <a href="#contact" class="px-6 py-2.5 rounded-full glow-btn text-primary-foreground transform flex items-center gap-2">
                        <span>{{ __('content.nav.join_us') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Language Switcher & Mobile Toggle -->
                <div class="flex items-center gap-4">
                    <div class="h-8 flex items-center bg-secondary rounded-lg p-1 border border-border">
                        <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1 rounded text-xs font-bold transition-all {{ app()->getLocale() == 'id' ? 'bg-background shadow-sm text-primary' : 'text-muted-foreground hover:text-foreground' }}">ID</a>
                        <div class="w-px h-3 bg-border mx-1"></div>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded text-xs font-bold transition-all {{ app()->getLocale() == 'en' ? 'bg-background shadow-sm text-primary' : 'text-muted-foreground hover:text-foreground' }}">EN</a>
                    </div>
                    <!-- Hamburger Button (Mobile) -->
                    <button id="mobile-menu-btn" class="md:hidden flex flex-col justify-center items-center w-10 h-10 rounded-lg bg-secondary border border-border gap-1.5 transition-all" aria-label="Menu">
                        <span class="block w-5 h-0.5 bg-foreground transition-all duration-300" id="bar1"></span>
                        <span class="block w-5 h-0.5 bg-foreground transition-all duration-300" id="bar2"></span>
                        <span class="block w-5 h-0.5 bg-foreground transition-all duration-300" id="bar3"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" class="fixed inset-0 z-[60] pointer-events-none opacity-0 transition-opacity duration-300">
        <!-- Backdrop -->
        <div id="mobile-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <!-- Drawer Panel -->
        <div id="mobile-panel" class="absolute top-0 right-0 h-full w-72 bg-card border-l border-border shadow-2xl translate-x-full transition-transform duration-300 flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-border">
                <span class="font-manrope font-extrabold text-xl text-primary">ERLASS</span>
                <button id="mobile-close-btn" class="w-10 h-10 rounded-lg bg-secondary border border-border flex items-center justify-center" aria-label="Close menu">
                    <svg class="w-5 h-5 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <nav class="flex-1 p-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-foreground hover:bg-primary/10 hover:text-primary transition-colors">{{ __('content.nav.home') }}</a>
                <a href="{{ route('home') }}#about" class="block px-4 py-3 rounded-xl text-base font-bold text-foreground hover:bg-primary/10 hover:text-primary transition-colors">{{ __('content.nav.about') }}</a>
                <a href="{{ route('home') }}#programs" class="block px-4 py-3 rounded-xl text-base font-bold text-foreground hover:bg-primary/10 hover:text-primary transition-colors">{{ __('content.nav.programs') }}</a>
                <a href="{{ route('gallery') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-foreground hover:bg-primary/10 hover:text-primary transition-colors">{{ __('content.nav.gallery') }}</a>
            </nav>
            <div class="p-6 border-t border-border">
                <a href="#contact" id="mobile-cta" class="block w-full text-center px-6 py-3 rounded-full glow-btn text-primary-foreground font-bold">{{ __('content.nav.join_us') }}</a>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const panel = document.getElementById('mobile-panel');
            const closeBtn = document.getElementById('mobile-close-btn');
            const backdrop = document.getElementById('mobile-backdrop');
            const cta = document.getElementById('mobile-cta');
            function openMenu() {
                menu.classList.remove('pointer-events-none','opacity-0');
                menu.classList.add('pointer-events-auto','opacity-100');
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            }
            function closeMenu() {
                menu.classList.add('pointer-events-none','opacity-0');
                menu.classList.remove('pointer-events-auto','opacity-100');
                panel.classList.add('translate-x-full');
                panel.classList.remove('translate-x-0');
                document.body.style.overflow = '';
            }
            if(btn) btn.addEventListener('click', openMenu);
            if(closeBtn) closeBtn.addEventListener('click', closeMenu);
            if(backdrop) backdrop.addEventListener('click', closeMenu);
            if(cta) cta.addEventListener('click', closeMenu);
            // Close on nav link click
            menu.querySelectorAll('nav a').forEach(function(a) { a.addEventListener('click', closeMenu); });
        })();
    </script>

    <!-- Main Content -->
    <main class="relative z-10 w-full pt-20"> 
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-card text-card-foreground mt-32 relative z-20 overflow-hidden border-t border-border">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary blur-[80px] opacity-10 rounded-full"></div>
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h3 class="font-manrope font-bold text-2xl mb-6">ERLASS</h3>
                    <p class="text-muted-foreground text-sm leading-relaxed max-w-xs">
                        {{ __('content.about.address') }}
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-6 text-primary">Programs</h4>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li>Coding & AI</li>
                        <li>Robotics & IoT</li>
                        <li>Teacher Training</li>
                    </ul>
                </div>
                <div>
                     <h4 class="font-bold text-lg mb-6 text-primary">Contact</h4>
                     <p class="text-2xl font-bold tracking-tight mb-6">{{ __('content.contact.phone') }}</p>
                     
                     <h5 class="text-sm font-bold text-muted-foreground mb-4 uppercase tracking-wider">Follow Us</h5>
                     <div class="flex gap-4">
                        <!-- Instagram -->
                        <a href="https://instagram.com/komunitaserlass" target="_blank" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-erlass-dark flex items-center justify-center transition-all duration-300 group">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        
                        <!-- YouTube -->
                        <a href="https://youtube.com/@erlassinstitute" target="_blank" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-red-600 flex items-center justify-center transition-all duration-300 text-white group">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>

                        <!-- TikTok -->
                        <a href="https://tiktok.com/@komunitaserlass" target="_blank" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-black flex items-center justify-center transition-all duration-300 leading-none group">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.03 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>

                        <!-- Facebook -->
                        <a href="https://facebook.com/erlass" target="_blank" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white hover:text-blue-600 flex items-center justify-center transition-all duration-300 group">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                     </div>
                </div>
            </div>
            <div class="border-t border-border mt-12 pt-8 text-center text-muted-foreground text-sm font-light pb-6">
                &copy; {{ date('Y') }} PT Erlass Prokreatif Indonesia. Empowering Knowledge.
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282311341381?text=Halo%20CS%20Alya%2C%20saya%20tertarik%20dengan%20program%20Erlass" target="_blank" rel="noopener" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-300" style="animation: wa-pulse 2s infinite;" aria-label="Chat WhatsApp">
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

</body>
</html>
