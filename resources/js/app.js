import '../css/app.css';
import { initHero } from './hero';
import lenis from './lenis';
import { initScrollAnimations } from './scroll-animations';
import { CustomCursor } from './cursor';
import { MagneticButton } from './magnetic';
import { CardHover } from './card-hover';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {

    // 0. PRELOADER ANIMATION
    const preloader = document.getElementById('page-preloader');
    const preloaderText = document.getElementById('preloader-text');
    const preloaderBar = document.getElementById('preloader-bar');

    if (preloader) {
        // Disable scroll during preload
        document.body.style.overflow = 'hidden';

        const tlPreload = gsap.timeline({
            onComplete: () => {
                document.body.style.overflow = '';
                initAll();
            }
        });

        tlPreload.to(preloaderBar, {
            width: "100%",
            duration: 1.5,
            ease: "power2.inOut"
        })
        .to(preloaderText, {
            y: "0%",
            duration: 0.8,
            ease: "back.out(1.5)"
        }, "-=1.0")
        .to(preloader, {
            y: "-100%",
            duration: 0.8,
            ease: "power3.inOut",
            delay: 0.3
        });
    } else {
        initAll();
    }

    function initAll() {
        // 1. PRIORITAS UTAMA: Smooth Scroll (Lenis) — harus jalan duluan
        try {
            if (lenis) {
                lenis.start();
                console.log('[Lenis] ✅ Smooth scroll aktif');
            }
        } catch (e) {
            console.error("[Lenis] ❌ Gagal start:", e);
        }

    // 2. Hero 3D Background (Three.js) - DYNAMIC IMPORT
    if (document.getElementById('hero-canvas')) {
        import('./hero-3d').then(({ initHero3D }) => {
            try {
                initHero3D();
            } catch (e) {
                console.error("[Hero3D] ❌ Gagal init:", e);
            }
        }).catch(err => console.error("[Hero3D] Failed to load module:", err));
    }

    // 3. Hero Animations (GSAP)
    try {
        initHero();
    } catch (e) {
        console.error("[Hero] ❌ Gagal init:", e);
    }

    // 4. Scroll-triggered Animations (GSAP ScrollTrigger)
    try {
        initScrollAnimations();
    } catch (e) {
        console.error("[ScrollAnimations] ❌ Gagal init:", e);
    }

    // 5. Custom Cursor (hanya untuk device dengan mouse)
    try {
        if (window.matchMedia("(pointer: fine)").matches) {
            new CustomCursor();
        }
    } catch (e) {
        console.error("[CustomCursor] ❌ Gagal init:", e);
    }

    // 6. Magnetic Buttons
    try {
        new MagneticButton();
    } catch (e) {
        console.error("[MagneticButton] ❌ Gagal init:", e);
    }

    // 7. Card Hover Effects
    try {
        new CardHover();
    } catch (e) {
        console.error("[CardHover] ❌ Gagal init:", e);
    }
    } // End of initAll()

});
