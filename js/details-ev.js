let currentIndex = 0;
const items = document.querySelectorAll('.carou-item');
const totalItems = items.length;
const carouselInner = document.querySelector('.carou-inner');
const indicators = document.querySelectorAll('.carou-indicator');

function goToSlide(index) {
    currentIndex = index;
    updateCarousel();
    updateIndicators();
}

function showNextSlide() {
    if (currentIndex === totalItems - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }
    updateCarousel();
    updateIndicators();
}

function showPrevSlide() {
    if (currentIndex === 0) {
        currentIndex = totalItems - 1;
    } else {
        currentIndex--;
    }
    updateCarousel();
    updateIndicators();
}

function updateCarousel() {
    const itemHeight = items[currentIndex].clientHeight;
    const offset = currentIndex * itemHeight;
    carouselInner.style.transform = `translateY(-${offset}px)`;
}

function updateIndicators() {
    indicators.forEach((indicator, index) => {
        if (index === currentIndex) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
}

setInterval(showNextSlide, 3000);
