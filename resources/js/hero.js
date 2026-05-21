import { gsap } from 'gsap';

export function initHero() {
    const headline = document.querySelector('.hero-headline');
    if (!headline) return;

    // 1. Text Splitting
    const lines = headline.innerHTML.split(/<br\s*\/?>/i);
    const newLines = lines.map(line => {
        const words = line.trim().split(/\s+/);
        return words.map(w => {
            if(!w) return '';
            return `<span class="word overflow-hidden inline-block align-bottom"><span class="word-inner inline-block translate-y-[110%] pb-2">${w}</span></span>`;
        }).join(" ");
    });
    headline.innerHTML = newLines.join(" <br/> ");

    // 2. Main Timeline
    const tl = gsap.timeline({ defaults: { ease: "back.out(1.5)" } });

    // Initial setups
    gsap.set('.hero-badge', { y: -20, opacity: 0 });
    gsap.set('.hero-sub', { y: 20, opacity: 0 });
    gsap.set('.hero-cta-group', { scale: 0.9, opacity: 0 });
    gsap.set('.hero-illustration', { y: 50, opacity: 0 });
    gsap.set('.hero-books-left', { x: -50, opacity: 0 });
    gsap.set('.hero-books-right', { x: 50, opacity: 0 });

    const nav = document.querySelector('#main-nav') || document.querySelector('header');
    
    // Navbar
    if (nav) {
        tl.fromTo(nav, { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" }, 0);
    }

    // Badge
    tl.to('.hero-badge', { y: 0, opacity: 1, duration: 0.5 }, 0.2);

    // Headline Words
    tl.to('.hero-headline .word-inner', {
        y: "0%",
        duration: 0.8,
        stagger: 0.05,
    }, 0.4);

    // Subheadline
    tl.to('.hero-sub', {
        opacity: 1,
        y: 0,
        duration: 0.6,
        ease: "power2.out"
    }, "-=0.4");

    // CTA
    tl.to('.hero-cta-group', {
        scale: 1,
        opacity: 1,
        duration: 0.6
    }, "-=0.2");

    // Decorative Elements
    tl.to(['.hero-illustration', '.hero-books-left', '.hero-books-right'], {
        y: 0,
        x: 0,
        opacity: 1,
        duration: 0.8,
        stagger: 0.1,
        ease: "back.out(1.2)"
    }, "-=0.4");

    // 3. Floating animation loop for data-speed elements
    const floaters = document.querySelectorAll('.hero-float');
    floaters.forEach(float => {
        const speed = parseFloat(float.getAttribute('data-speed') || "1");
        gsap.to(float, {
            y: `-=${15 * speed}`,
            rotation: `+=${5 * speed}`,
            duration: 2 / speed,
            yoyo: true,
            repeat: -1,
            ease: "sine.inOut"
        });
    });
}

