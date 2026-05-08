
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
