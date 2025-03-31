document.addEventListener('DOMContentLoaded', function() {
    const carouselTrack = document.querySelector('.carousel-track');
    if (!carouselTrack) return; // Exit if carousel doesn't exist

    const slides = carouselTrack.querySelectorAll('.carousel-slide');
    if (slides.length === 0) return; // Exit if no slides

    const prevButton = document.querySelector('.carousel-button.prev');
    const nextButton = document.querySelector('.carousel-button.next');
    const indicatorsContainer = document.querySelector('.carousel-indicators');

    let currentSlide = 0;

    // Create indicators
    slides.forEach((_, index) => {
        const indicator = document.createElement('button');
        indicator.className = 'carousel-indicator';
        indicator.setAttribute('data-index', index);
        if (index === 0) indicator.classList.add('active');
        indicatorsContainer.appendChild(indicator);

        indicator.addEventListener('click', () => {
            goToSlide(index);
        });
    });

    // Update slides position
    function updateSlides() {
        carouselTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
        document.querySelectorAll('.carousel-indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlides();
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlides();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateSlides();
    }

    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);

    // Auto advance slides every 5 seconds
    setInterval(nextSlide, 5000);
}); 