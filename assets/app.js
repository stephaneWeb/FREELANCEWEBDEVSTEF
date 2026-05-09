
import './styles/app.scss';
import 'bootstrap';


/* =========================================================
   SCROLL REVEAL
========================================================= */

/* =========================================================
   SCROLL REVEAL
========================================================= */

const revealElements = document.querySelectorAll('.fade-right, .fade-up');

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
}, {
    threshold: 0.2
});

revealElements.forEach((element) => {
    observer.observe(element);
});
/* =========================================================
   HERO NEON MOUSE EFFECT
========================================================= */

const heroSection = document.querySelector('.hero-section');
const heroNeon = document.querySelector('.hero-neon');

if (heroSection && heroNeon) {
    heroSection.addEventListener('mousemove', (event) => {
        const rect = heroSection.getBoundingClientRect();

        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        heroNeon.style.left = `${x}px`;
        heroNeon.style.top = `${y}px`;
    });

    heroSection.addEventListener('mouseleave', () => {
        heroNeon.style.opacity = '0.25';
    });

    heroSection.addEventListener('mouseenter', () => {
        heroNeon.style.opacity = '0.7';
    });
}
