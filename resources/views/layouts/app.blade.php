<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Erlass Institute - Premium Koding & Robotik untuk Siswa')</title>
    <meta name="title" content="@yield('title', 'Erlass Institute - Koding, Robotik & AI untuk Siswa SD & SMP')">
    <meta name="description" content="@yield('description', 'Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (AI), dan robotika untuk tingkat SD dan SMP di Indonesia. Kurikulum berbasis proyek dan teknologi terkini.')">
    <meta name="keywords" content="kursus koding anak, belajar robotik anak, ekstrakurikuler koding indonesia, kelas microbit, scratch programming, python turtle, arduino untuk siswa, pendampingan guru teknologi, AI for kids indonesia, koding untuk anak SD">
    <meta name="author" content="PT Erlass Prokreatif Indonesia">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#1d758b">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Hreflang for international SEO -->
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Erlass Institute - Koding & Robotik untuk Siswa')">
    <meta property="og:description" content="@yield('description', 'Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (KA), dan robotika untuk tingkat SD dan SMP di Indonesia.')">
    <!-- Image for sharing. Make sure the path is accessible. -->
    <meta property="og:image" content="{{ asset('img/og-preview.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Erlass Institute - Koding & Robotik untuk Siswa')">
    <meta property="twitter:description" content="Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (KA), dan robotika untuk SD dan SMP.">
    <meta property="twitter:image" content="{{ asset('img/og-preview.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Schema.org / JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "EducationalOrganization",
      "name": "Erlass Institute",
      "url": "https://galeribelajar.com",
      "logo": "{{ asset('img/cp/11.png') }}",
      "description": "Mitra pendidikan terkemuka untuk program ekstrakurikuler koding, Kecerdasan Artifisial (AI), dan robotika untuk tingkat SD dan SMP di Indonesia.",
      "address": {
        "@@type": "PostalAddress",
        "addressCountry": "ID"
      },
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+6282311341381",
        "contactType": "customer service"
      },
      "sameAs": [
        "https://instagram.com/komunitaserlass",
        "https://youtube.com/@@erlassinstitute",
        "https://facebook.com/erlass"
      ]
    }
    </script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-[#fffdf5] font-sans text-[#111111] antialiased overflow-x-hidden selection:bg-kids-navy selection:text-white">
    <a href="#main-content" class="sr-only focus:not-sr-only bg-kids-navy text-white px-4 py-2 absolute top-0 left-0 z-[110]">Skip to content</a>

    <!-- ============================================
         NAVIGATION — Kids Aesthetic
         ============================================ -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-500 bg-white/95 backdrop-blur-md shadow-sm border-b border-kids-navy/5 flex flex-col" id="main-nav">
        <!-- ============================================
             RUNNING TEXT / ANNOUNCEMENT BAR
             ============================================ -->
        @php
            $announcements = [];
            try { $announcements = \App\Models\Announcement::where('is_active', true)->get(); } catch (\Exception $e) {}
        @endphp

        @if(count($announcements) > 0)
        <div class="bg-kids-yellow text-kids-navy font-bold text-sm py-2 overflow-hidden relative w-full border-b border-kids-navy/10 flex items-center shrink-0">
            <div class="whitespace-nowrap animate-client-marquee flex w-full">
                @for ($i = 0; $i < 3; $i++)
                    <div class="flex items-center shrink-0 min-w-full justify-around">
                        @foreach($announcements as $announcement)
                            <span class="mx-6">
                                @if($announcement->url_link)
                                    <a href="{{ $announcement->url_link }}" class="hover:underline">{{ $announcement->content }}</a>
                                @else
                                    {{ $announcement->content }}
                                @endif
                            </span>
                            <span class="mx-6 text-kids-navy/30">✦</span>
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="font-serif font-bold text-2xl tracking-tight text-kids-navy hover:text-kids-navy/80 transition-colors">
                        ERLASS
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-kids-navy/60 hover:text-kids-navy transition-colors relative group py-2">
                        {{ __('content.nav.home') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-kids-yellow transition-all group-hover:w-full rounded-full"></span>
                    </a>
                    <a href="{{ route('home') }}#about" class="text-sm font-bold text-kids-navy/60 hover:text-kids-navy transition-colors relative group py-2">
                        {{ __('content.nav.about') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-kids-yellow transition-all group-hover:w-full rounded-full"></span>
                    </a>
                    <a href="{{ route('home') }}#programs" class="text-sm font-bold text-kids-navy/60 hover:text-kids-navy transition-colors relative group py-2">
                        {{ __('content.nav.programs') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-kids-yellow transition-all group-hover:w-full rounded-full"></span>
                    </a>
                    <a href="{{ route('gallery') }}" class="text-sm font-bold text-kids-navy/60 hover:text-kids-navy transition-colors relative group py-2">
                        {{ __('content.nav.gallery') }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-kids-yellow transition-all group-hover:w-full rounded-full"></span>
                    </a>

                    <a href="#contact" class="px-6 py-2.5 rounded-full bg-kids-navy text-white font-bold flex items-center gap-2 transition-all duration-300 hover:scale-105 shadow-[0_4px_0_rgba(153,225,255,1)] hover:shadow-[0_6px_0_rgba(153,225,255,1)]">
                        <span>{{ __('content.nav.join_us') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Language Switcher & Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <div class="h-8 flex items-center bg-kids-yellow/15 rounded-full p-1 border border-kids-navy/10">
                        <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'id' ? 'bg-white shadow-sm text-kids-navy' : 'text-kids-navy/50 hover:text-kids-navy' }}">ID</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() == 'en' ? 'bg-white shadow-sm text-kids-navy' : 'text-kids-navy/50 hover:text-kids-navy' }}">EN</a>
                    </div>
                    <!-- Hamburger Button (Mobile) -->
                    <button id="mobile-menu-btn" class="md:hidden flex flex-col justify-center items-center w-10 h-10 rounded-xl bg-kids-yellow/15 border border-kids-navy/10 gap-1.5 transition-all hover:bg-kids-yellow/30" aria-label="Menu">
                        <span class="block w-5 h-0.5 bg-kids-navy transition-all duration-300" id="bar1"></span>
                        <span class="block w-5 h-0.5 bg-kids-navy transition-all duration-300" id="bar2"></span>
                        <span class="block w-5 h-0.5 bg-kids-navy transition-all duration-300" id="bar3"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ============================================
         MOBILE MENU DRAWER — Kids Aesthetic
         ============================================ -->
    <div id="mobile-menu" class="fixed inset-0 z-[60] pointer-events-none opacity-0 transition-opacity duration-300">
        <!-- Backdrop -->
        <div id="mobile-backdrop" class="absolute inset-0 bg-kids-navy/40 backdrop-blur-sm"></div>
        <!-- Drawer Panel -->
        <div id="mobile-panel" class="absolute top-0 right-0 h-full w-72 bg-white border-l border-kids-navy/10 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-kids-navy/10">
                <span class="font-serif font-bold text-xl text-kids-navy">ERLASS</span>
                <button id="mobile-close-btn" class="w-10 h-10 rounded-xl bg-kids-yellow/15 border border-kids-navy/10 flex items-center justify-center hover:bg-kids-yellow/30 transition-colors" aria-label="Close menu">
                    <svg class="w-5 h-5 text-kids-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <nav class="flex-1 p-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-kids-navy hover:bg-kids-yellow/15 transition-colors">{{ __('content.nav.home') }}</a>
                <a href="{{ route('home') }}#about" class="block px-4 py-3 rounded-xl text-base font-bold text-kids-navy hover:bg-kids-yellow/15 transition-colors">{{ __('content.nav.about') }}</a>
                <a href="{{ route('home') }}#programs" class="block px-4 py-3 rounded-xl text-base font-bold text-kids-navy hover:bg-kids-yellow/15 transition-colors">{{ __('content.nav.programs') }}</a>
                <a href="{{ route('gallery') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-kids-navy hover:bg-kids-yellow/15 transition-colors">{{ __('content.nav.gallery') }}</a>
            </nav>
            <div class="p-6 border-t border-kids-navy/10">
                <a href="#contact" id="mobile-cta" class="block w-full text-center px-6 py-3 rounded-full bg-kids-navy text-white font-bold shadow-[0_4px_0_rgba(153,225,255,1)] hover:scale-105 transition-all duration-300">{{ __('content.nav.join_us') }}</a>
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
    <main id="main-content" class="relative z-10 w-full pt-20"> 
        @yield('content')
    </main>

    <!-- ============================================
         FOOTER — Kids Navy Aesthetic
         ============================================ -->
    <footer class="bg-kids-navy text-white relative z-20 overflow-hidden">
        <!-- Cloud Wave Transition -->
        <div class="relative -mt-1">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-20 md:h-28 block" aria-hidden="true">
                <path d="M0,120 L1440,120 L1440,60 C1380,40 1340,90 1280,60 C1220,30 1180,80 1100,50 C1020,20 980,70 900,40 C820,10 780,60 700,50 C620,40 580,90 500,60 C420,30 380,80 300,50 C220,20 180,70 100,60 C40,50 20,80 0,60 Z" fill="#1d758b"/>
            </svg>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-32 right-10 w-48 h-48 bg-kids-yellow/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 bg-kids-blue/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Column 1: Brand -->
                <div>
                    <h3 class="font-serif font-bold text-2xl mb-6 text-white">ERLASS</h3>
                    <p class="text-white/60 text-sm leading-relaxed max-w-xs">
                        {{ __('content.about.address') }}
                    </p>
                </div>
                <!-- Column 2: Programs -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-kids-yellow">{{ __('content.footer.programs_title') }}</h4>
                    <ul class="space-y-3 text-sm text-white/60">
                        <li class="hover:text-white/80 transition-colors">{{ __('content.footer.coding') }}</li>
                        <li class="hover:text-white/80 transition-colors">{{ __('content.footer.robotics') }}</li>
                        <li class="hover:text-white/80 transition-colors">{{ __('content.footer.training') }}</li>
                    </ul>
                </div>
                <!-- Column 3: Contact & Social -->
                <div>
                     <h4 class="font-bold text-lg mb-6 text-kids-yellow">{{ __('content.footer.contact_title') }}</h4>
                     <p class="text-2xl font-bold tracking-tight mb-6 text-white">{{ __('content.contact.phone') }}</p>
                     
                     <h5 class="text-sm font-bold text-white/40 mb-4 uppercase tracking-wider">{{ __('content.footer.follow_us') }}</h5>
                     <div class="flex gap-3">
                        <!-- Instagram -->
                        <a href="https://instagram.com/komunitaserlass" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-kids-yellow hover:text-kids-navy text-white flex items-center justify-center transition-all duration-300" aria-label="Instagram">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        
                        <!-- YouTube -->
                        <a href="https://youtube.com/@erlassinstitute" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-kids-yellow hover:text-kids-navy text-white flex items-center justify-center transition-all duration-300" aria-label="YouTube">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>

                        <!-- TikTok -->
                        <a href="https://tiktok.com/@komunitaserlass" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-kids-yellow hover:text-kids-navy text-white flex items-center justify-center transition-all duration-300" aria-label="TikTok">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.03 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>

                        <!-- Facebook -->
                        <a href="https://facebook.com/erlass" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/10 hover:bg-kids-yellow hover:text-kids-navy text-white flex items-center justify-center transition-all duration-300" aria-label="Facebook">
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                     </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="border-t border-white/15 mt-12 pt-8 text-center text-white/40 text-sm font-light pb-6">
                &copy; {{ date('Y') }} PT Erlass Prokreatif Indonesia. {{ __('content.footer.copyright') }}
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282311341381?text=Halo%20CS%20Alya%2C%20saya%20tertarik%20dengan%20program%20Erlass" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-300" style="animation: wa-pulse 2s infinite;" aria-label="Chat WhatsApp">
        <svg class="w-7 h-7 text-white fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

</body>
</html>
