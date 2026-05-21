import '../css/app.css';
import { initHero3D } from './hero-3d';
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

    // 1. PRIORITAS UTAMA: Smooth Scroll (Lenis) — harus jalan duluan
    try {
        if (lenis) {
            lenis.start();
            console.log('[Lenis] ✅ Smooth scroll aktif');
        }
    } catch (e) {
        console.error("[Lenis] ❌ Gagal start:", e);
    }

    // 2. Hero 3D Background (Three.js)
    try {
        initHero3D();
    } catch (e) {
        console.error("[Hero3D] ❌ Gagal init:", e);
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

});
