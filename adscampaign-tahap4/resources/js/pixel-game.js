// Pixel Game JavaScript Animations and Effects

class PixelGameEffects {
    constructor() {
        this.init();
    }

    init() {
        this.addParticleBackground();
        this.addScrollAnimations();
        this.addButtonEffects();
        this.addTypingEffect();
        this.addFloatingElements();
        this.addPixelCursor();
        this.addSoundEffects();
    }

    // Particle Background Effect
    addParticleBackground() {
        const canvas = document.createElement('canvas');
        canvas.id = 'pixel-particles';
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.zIndex = '-1';
        canvas.style.pointerEvents = 'none';
        document.body.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        const particleCount = 50;

        // Create particles
        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                size: Math.random() * 3 + 1,
                speedX: Math.random() * 2 - 1,
                speedY: Math.random() * 2 - 1,
                color: this.getRandomPixelColor()
            });
        }

        // Animate particles
        const animateParticles = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(particle => {
                particle.x += particle.speedX;
                particle.y += particle.speedY;

                // Wrap around screen
                if (particle.x > canvas.width) particle.x = 0;
                if (particle.x < 0) particle.x = canvas.width;
                if (particle.y > canvas.height) particle.y = 0;
                if (particle.y < 0) particle.y = canvas.height;

                // Draw pixel particle
                ctx.fillStyle = particle.color;
                ctx.fillRect(particle.x, particle.y, particle.size, particle.size);
            });

            requestAnimationFrame(animateParticles);
        };

        animateParticles();

        // Resize handler
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    }

    // Scroll Animations
    addScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('pixel-fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards and important elements
        document.querySelectorAll('.pixel-card, .pixel-btn, .pixel-table').forEach(el => {
            observer.observe(el);
        });
    }

    // Enhanced Button Effects
    addButtonEffects() {
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('pixel-btn')) {
                this.createClickEffect(e.target, e.clientX, e.clientY);
                this.playSound('click');
            }
        });

        // Hover effects
        document.querySelectorAll('.pixel-btn').forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                this.playSound('hover');
                btn.classList.add('pixel-glow');
            });

            btn.addEventListener('mouseleave', () => {
                btn.classList.remove('pixel-glow');
            });
        });
    }

    // Create click ripple effect
    createClickEffect(element, x, y) {
        const rect = element.getBoundingClientRect();
        const ripple = document.createElement('div');
        
        ripple.style.position = 'absolute';
        ripple.style.width = '4px';
        ripple.style.height = '4px';
        ripple.style.background = '#4ecdc4';
        ripple.style.left = (x - rect.left) + 'px';
        ripple.style.top = (y - rect.top) + 'px';
        ripple.style.pointerEvents = 'none';
        ripple.style.zIndex = '1000';
        ripple.style.animation = 'pixelRipple 0.6s ease-out';
        
        element.style.position = 'relative';
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // Typing Effect for Headers
    addTypingEffect() {
        const typeElements = document.querySelectorAll('[data-type]');
        
        typeElements.forEach(element => {
            const text = element.textContent;
            element.textContent = '';
            
            let i = 0;
            const typeInterval = setInterval(() => {
                element.textContent += text.charAt(i);
                i++;
                
                if (i >= text.length) {
                    clearInterval(typeInterval);
                    element.classList.add('pixel-pulse');
                }
            }, 100);
        });
    }

    // Floating Elements
    addFloatingElements() {
        const floatingElements = document.querySelectorAll('.pixel-float');
        
        floatingElements.forEach((element, index) => {
            element.style.animation = `pixelFloat ${3 + index * 0.5}s ease-in-out infinite`;
            element.style.animationDelay = `${index * 0.2}s`;
        });
    }

    // Custom Pixel Cursor
    addPixelCursor() {
        const cursor = document.createElement('div');
        cursor.id = 'pixel-cursor';
        cursor.style.cssText = `
            position: fixed;
            width: 16px;
            height: 16px;
            background: #4ecdc4;
            border: 2px solid #fff;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s ease;
        `;
        document.body.appendChild(cursor);

        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX - 8 + 'px';
            cursor.style.top = e.clientY - 8 + 'px';
        });

        // Cursor effects on hover
        document.addEventListener('mouseover', (e) => {
            if (e.target.classList.contains('pixel-btn') || e.target.tagName === 'A') {
                cursor.style.transform = 'scale(1.5)';
                cursor.style.background = '#ff6b6b';
            } else {
                cursor.style.transform = 'scale(1)';
                cursor.style.background = '#4ecdc4';
            }
        });
    }

    // Sound Effects (Web Audio API)
    addSoundEffects() {
        this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
        this.sounds = {};
        
        // Create sound effects
        this.createSound('click', [800, 600], 0.1);
        this.createSound('hover', [400, 500], 0.05);
        this.createSound('success', [523, 659, 784], 0.2);
        this.createSound('error', [200, 150], 0.15);
    }

    createSound(name, frequencies, duration) {
        this.sounds[name] = () => {
            frequencies.forEach((freq, index) => {
                const oscillator = this.audioContext.createOscillator();
                const gainNode = this.audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(this.audioContext.destination);
                
                oscillator.frequency.setValueAtTime(freq, this.audioContext.currentTime);
                oscillator.type = 'square';
                
                gainNode.gain.setValueAtTime(0, this.audioContext.currentTime);
                gainNode.gain.linearRampToValueAtTime(0.1, this.audioContext.currentTime + 0.01);
                gainNode.gain.exponentialRampToValueAtTime(0.001, this.audioContext.currentTime + duration);
                
                oscillator.start(this.audioContext.currentTime + index * 0.1);
                oscillator.stop(this.audioContext.currentTime + duration + index * 0.1);
            });
        };
    }

    playSound(soundName) {
        if (this.sounds[soundName] && this.audioContext.state === 'running') {
            this.sounds[soundName]();
        }
    }

    // Progress Bar Animation
    animateProgressBar(element, targetPercent) {
        const progressBar = element.querySelector('.pixel-progress-bar');
        let currentPercent = 0;
        
        const interval = setInterval(() => {
            currentPercent += 2;
            progressBar.style.width = currentPercent + '%';
            
            if (currentPercent >= targetPercent) {
                clearInterval(interval);
                this.playSound('success');
            }
        }, 50);
    }

    // Matrix Rain Effect
    addMatrixRain() {
        const canvas = document.createElement('canvas');
        canvas.id = 'matrix-rain';
        canvas.style.position = 'fixed';
        canvas.style.top = '0';
        canvas.style.left = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.zIndex = '-2';
        canvas.style.opacity = '0.1';
        canvas.style.pointerEvents = 'none';
        document.body.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const chars = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
        const fontSize = 14;
        const columns = canvas.width / fontSize;
        const drops = [];

        for (let i = 0; i < columns; i++) {
            drops[i] = 1;
        }

        const draw = () => {
            ctx.fillStyle = 'rgba(15, 52, 96, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = '#4ecdc4';
            ctx.font = fontSize + 'px monospace';

            for (let i = 0; i < drops.length; i++) {
                const text = chars[Math.floor(Math.random() * chars.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);

                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        };

        setInterval(draw, 100);
    }

    // Get random pixel colors
    getRandomPixelColor() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7'];
        return colors[Math.floor(Math.random() * colors.length)];
    }

    // Loading Screen
    showLoadingScreen() {
        const loadingScreen = document.createElement('div');
        loadingScreen.id = 'pixel-loading';
        loadingScreen.innerHTML = `
            <div class="pixel-spinner"></div>
            <div style="margin-top: 20px; font-size: 14px;">Loading Game...</div>
        `;
        loadingScreen.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #0f3460, #16213e);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            color: #ddd;
            font-family: 'Press Start 2P', cursive;
        `;
        
        document.body.appendChild(loadingScreen);
        
        setTimeout(() => {
            loadingScreen.style.opacity = '0';
            loadingScreen.style.transition = 'opacity 1s ease';
            setTimeout(() => {
                loadingScreen.remove();
            }, 1000);
        }, 2000);
    }
}

// Additional CSS animations to be injected
const additionalCSS = `
@keyframes pixelRipple {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(20);
        opacity: 0;
    }
}

@keyframes pixelFloat {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.pixel-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.pixel-table tr:hover {
    transform: scale(1.02);
    transition: transform 0.2s ease;
}
`;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Inject additional CSS
    const style = document.createElement('style');
    style.textContent = additionalCSS;
    document.head.appendChild(style);
    
    // Initialize pixel game effects
    const pixelGame = new PixelGameEffects();
    
    // Show loading screen
    pixelGame.showLoadingScreen();
    
    // Add matrix rain effect after loading
    setTimeout(() => {
        pixelGame.addMatrixRain();
    }, 3000);
});

// Export for use in other files
window.PixelGameEffects = PixelGameEffects;
