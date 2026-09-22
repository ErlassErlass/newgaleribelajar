import { gsap } from 'gsap';

export class CustomCursor {
    constructor() {
        if (!window.matchMedia("(pointer: fine)").matches) return;

        this.dot = document.createElement('div');
        this.dot.className = 'custom-cursor-dot';
        
        this.circle = document.createElement('div');
        this.circle.className = 'custom-cursor-circle';
        
        this.text = document.createElement('span');
        this.text.className = 'custom-cursor-text';
        this.circle.appendChild(this.text);

        document.body.appendChild(this.dot);
        document.body.appendChild(this.circle);

        this.mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
        this.pos = { 
            dot: { x: window.innerWidth / 2, y: window.innerHeight / 2 },
            circle: { x: window.innerWidth / 2, y: window.innerHeight / 2 }
        };

        this.initEvents();
        this.initHoverEvents();
        
        // GSAP Ticker for lerp
        gsap.ticker.add(() => this.render());

        // Kursor native baru disembunyikan SETELAH custom cursor berhasil dibuat
        document.body.classList.add('custom-cursor-active');
    }

    initEvents() {
        window.addEventListener('mousemove', (e) => {
            this.mouse.x = e.clientX;
            this.mouse.y = e.clientY;
        });
    }

    initHoverEvents() {
        // Find all interactive elements and explicitly set data-cursor to default if it doesn't have one
        const hoverables = document.querySelectorAll('a, button, .product-card, input, textarea');
        hoverables.forEach(el => {
            if(!el.hasAttribute('data-cursor')) {
                el.setAttribute('data-cursor', 'default');
            }
        });

        const elements = document.querySelectorAll('[data-cursor]');
        
        elements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                const type = el.getAttribute('data-cursor');
                this.setState(type);
            });
            
            el.addEventListener('mouseleave', () => {
                this.setState('');
            });
        });
    }

    setState(state) {
        gsap.killTweensOf(this.circle);
        gsap.killTweensOf(this.text);
        gsap.killTweensOf(this.dot);
        
        const fgColor = 'rgba(255, 214, 0, 0.9)'; // kids-yellow opaque
        const fgColorLight = 'rgba(255, 214, 0, 0.5)'; // kids-yellow transparent
        const navyColor = '#1d758b';
        const bgColor = '#111111';

        if (state === 'explore') {
            gsap.to(this.circle, { width: 90, height: 90, backgroundColor: fgColor, border: 'none', duration: 0.4, ease: "back.out(1.5)" });
            this.text.textContent = 'KLIK SINI';
            gsap.to(this.text, { opacity: 1, color: navyColor, duration: 0.3 });
            gsap.to(this.dot, { opacity: 0, duration: 0.2 });
        } else if (state === 'play') {
            gsap.to(this.circle, { width: 70, height: 70, borderRadius: '20%', rotation: 45, backgroundColor: '#ffb3c6', border: 'none', duration: 0.4, ease: "power3.out" }); // kids-pink
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
            gsap.to(this.dot, { scale: 0, duration: 0.2 });
        } else if (state === 'drag') {
            gsap.to(this.circle, { width: 90, height: 90, backgroundColor: '#99e1ff', border: 'none', duration: 0.4, ease: "back.out(1.5)" }); // kids-blue
            this.text.textContent = 'GESER';
            gsap.to(this.text, { opacity: 1, color: navyColor, duration: 0.3 });
            gsap.to(this.dot, { scale: 0.5, duration: 0.2 });
        } else if (state === 'default') {
            gsap.to(this.circle, { width: 60, height: 60, borderRadius: '50%', rotation: 0, backgroundColor: fgColor, border: 'none', duration: 0.3, ease: "power2.out" });
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
            gsap.to(this.dot, { scale: 1.5, backgroundColor: '#fff', border: '2px solid #1d758b', duration: 0.3 });
        } else {
            // Base state
            gsap.to(this.circle, { width: 45, height: 45, borderRadius: '50%', rotation: 0, backgroundColor: fgColorLight, border: 'none', duration: 0.3, ease: "power2.out" });
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
            gsap.to(this.dot, { scale: 1, opacity: 1, backgroundColor: navyColor, border: '2px solid #ffffff', duration: 0.3 });
        }
    }

    render() {
        this.pos.dot.x += (this.mouse.x - this.pos.dot.x) * 1.0;
        this.pos.dot.y += (this.mouse.y - this.pos.dot.y) * 1.0;
        
        this.pos.circle.x += (this.mouse.x - this.pos.circle.x) * 0.12;
        this.pos.circle.y += (this.mouse.y - this.pos.circle.y) * 0.12;

        gsap.set(this.dot, { x: this.pos.dot.x, y: this.pos.dot.y });
        gsap.set(this.circle, { x: this.pos.circle.x, y: this.pos.circle.y });
    }
}
