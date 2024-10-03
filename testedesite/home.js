let currentIndex = 0;

const slides = document.querySelectorAll('.carousel-image');
const totalSlides = slides.length;

document.querySelector('.next-btn').addEventListener('click', () => {
    changeSlide(1);
});

document.querySelector('.prev-btn').addEventListener('click', () => {
    changeSlide(-1);
});

function changeSlide(direction) {
    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = totalSlides - 1;
    } else if (currentIndex >= totalSlides) {
        currentIndex = 0;
    }

    const offset = -currentIndex * 100;
    slides.forEach(slide => {
        slide.style.transform = `translateX(${offset}%)`;
    });
}
