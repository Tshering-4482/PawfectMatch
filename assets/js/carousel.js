// JavaScript for carousel functionality
let currentSlide = 0;
const totalSlides = document.querySelectorAll('.carousel-images img').length;
const carouselImages = document.getElementById('carouselImages');

function updateCarousel() {
    const width = document.querySelector('.carousel-container').offsetWidth;
    carouselImages.style.transform = 'translateX(' + (-width * currentSlide) + 'px)';
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateCarousel();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

window.addEventListener('resize', updateCarousel);
