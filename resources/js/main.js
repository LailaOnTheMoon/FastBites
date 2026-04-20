let currentIndex = 0;
const slider = document.getElementById('slider');

if (slider) {
    const totalSlides = slider.children.length;

    function updateSlide() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlide();
    }

    setInterval(nextSlide, 3000);
}

/* ===== FADE IN ANIMATION ===== */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
});

document.querySelectorAll('.fade-in').forEach(el => {
    observer.observe(el);
});