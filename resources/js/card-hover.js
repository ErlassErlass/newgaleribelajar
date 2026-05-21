import { gsap } from 'gsap';

export class CardHover {
    constructor() {
        this.init();
    }

    init() {
        const cards = document.querySelectorAll('.product-card');
        
        cards.forEach(card => {
            // Apply perspective to the card itself (or its parent)
            gsap.set(card, { transformPerspective: 1000, transformStyle: "preserve-3d" });

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Update CSS custom variables for the gradient mask tracking
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);

                // 3D Rotation Calculation offsets
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -8; // Max 8 deg rotation
                const rotateY = ((x - centerX) / centerX) * 8;

                gsap.to(card, {
                    rotateX: rotateX,
                    rotateY: rotateY,
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', () => {
                // Snap back to flat when mouse leaves
                gsap.to(card, {
                    rotateX: 0,
                    rotateY: 0,
                    duration: 0.7,
                    ease: 'power2.out'
                });
            });
        });
    }
}
