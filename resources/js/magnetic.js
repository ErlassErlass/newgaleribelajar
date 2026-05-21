import { gsap } from 'gsap';

export class MagneticButton {
    constructor() {
        this.init();
    }

    init() {
        const magneticBtns = document.querySelectorAll('.x-magnetic-btn');
        const radius = 80;

        magneticBtns.forEach(btn => {
            const inner = btn.querySelector('.magnetic-inner');
            let isHovered = false;

            window.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const distanceX = e.clientX - centerX;
                const distanceY = e.clientY - centerY;
                const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);

                if (distance < (rect.width / 2) + radius) {
                    isHovered = true;
                    // Formula: offset = (mousePos - buttonCenter) * 0.35
                    gsap.to(btn, { x: distanceX * 0.35, y: distanceY * 0.35, duration: 0.3, ease: 'power2.out' });
                    if (inner) gsap.to(inner, { x: distanceX * 0.15, y: distanceY * 0.15, duration: 0.3, ease: 'power2.out' });
                } else if (isHovered) {
                    isHovered = false;
                    gsap.to(btn, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
                    if (inner) gsap.to(inner, { x: 0, y: 0, duration: 0.7, ease: 'elastic.out(1, 0.3)' });
                }
            });
        });
    }
}
