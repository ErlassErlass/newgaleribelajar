import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initScrollAnimations() {
    // Check for prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        gsap.set(".about-image, .about-content > *, .book-card, .blog-card, .section-reveal", {
            opacity: 1,
            x: 0,
            y: 0,
            scale: 1,
            rotation: 0
        });
        return;
    }

    // 1. HORIZONTAL SCROLL (PROGRAMS SECTION)
    const horizontalSection = document.querySelector("#programs");
    if (horizontalSection) {
        const scrollContainer = document.querySelector("#horizontal-scroll-container");
        const panels = gsap.utils.toArray(".h-panel");

        // Only enable horizontal scroll on desktop (>= 768px)
        const isDesktop = window.matchMedia("(min-width: 768px)").matches;

        if (isDesktop && scrollContainer && panels.length) {
            // Set the width of the container dynamically based on number of panels
            gsap.set(scrollContainer, { width: (panels.length * 100) + "vw" });

            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1),
                ease: "none",
                scrollTrigger: {
                    trigger: horizontalSection,
                    pin: true,
                    scrub: 1,
                    // snap: 1 / (panels.length - 1), // Optional: snap to sections
                    end: () => "+=" + scrollContainer.offsetWidth
                }
            });
        }
    }

    // About Section
    if (document.querySelector('#about')) {
        gsap.from(".about-image", {
            scale: 0.8,
            opacity: 0,
            rotation: -5,
            duration: 1,
            ease: "back.out(1.5)",
            scrollTrigger: {
                trigger: "#about",
                start: "top 70%",
                toggleActions: "play none none none"
            }
        });

        gsap.from(".about-content > *", {
            x: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#about",
                start: "top 60%",
                toggleActions: "play none none none"
            }
        });
    }

    // Book Cards (Products Section)
    if (document.querySelector('.book-card')) {
        gsap.from(".book-card", {
            y: 80, 
            opacity: 0, 
            duration: 0.8,
            stagger: 0.15, 
            ease: "back.out(1.2)",
            scrollTrigger: { 
                trigger: "#products",
                start: "top 75%", 
                toggleActions: "play none none none" 
            }
        });
    }

    // Blog Cards (Blogs Section)
    if (document.querySelector('.blog-card')) {
        gsap.from(".blog-card", {
            y: 60,
            scale: 0.95,
            opacity: 0, 
            duration: 0.8,
            stagger: 0.2, 
            ease: "power3.out",
            scrollTrigger: { 
                trigger: "#blogs",
                start: "top 75%", 
                toggleActions: "play none none none" 
            }
        });
    }

    // Generic Section Reveal (Fade Up)
    gsap.utils.toArray('.section-reveal').forEach((section) => {
        // Only apply if it's not the hero
        if (section.id === 'hero-display') return;

        gsap.fromTo(section, 
            { opacity: 0, y: 30 },
            {
                scrollTrigger: {
                    trigger: section,
                    start: "top 85%", // When top of section hits 85% viewport
                    toggleActions: "play none none none"
                },
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "power2.out"
            }
        );
    });
}
