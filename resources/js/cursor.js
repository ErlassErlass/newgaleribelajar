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
        
        const fgColor = '#222';
        const bgColor = '#fff';

        if (state === 'explore') {
            gsap.to(this.circle, { width: 80, height: 80, backgroundColor: fgColor, border: 'none', duration: 0.3 });
            this.text.textContent = 'EXPLORE';
            gsap.to(this.text, { opacity: 1, color: bgColor, duration: 0.3 });
        } else if (state === 'play') {
            // Triangle Play Icon using shape modification
            gsap.to(this.circle, { width: 60, height: 60, borderRadius: '10%', rotation: 45, backgroundColor: fgColor, border: 'none', duration: 0.3 });
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
        } else if (state === 'drag') {
            gsap.to(this.circle, { width: 80, height: 80, backgroundColor: fgColor, border: 'none', duration: 0.3 });
            this.text.textContent = 'DRAG';
            gsap.to(this.text, { opacity: 1, color: bgColor, duration: 0.3 });
        } else if (state === 'default') {
            // Expanding small bit on hover for normal interactive elements
            gsap.to(this.circle, { width: 50, height: 50, borderRadius: '50%', rotation: 0, backgroundColor: 'transparent', border: `1.5px solid ${fgColor}`, duration: 0.3 });
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
        } else {
            // Base state
            gsap.to(this.circle, { width: 40, height: 40, borderRadius: '50%', rotation: 0, backgroundColor: 'transparent', border: `1.5px solid ${fgColor}`, duration: 0.3 });
            this.text.textContent = '';
            gsap.to(this.text, { opacity: 0, duration: 0.3 });
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
