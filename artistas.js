let currentIndex = {
    populares: 0,
    masEscuchados: 0,
    masTiempoSinEscuchar: 0
};

function moveCarousel(sectionId, direction) {
    const carousel = document.getElementById(sectionId);
    const items = carousel.children;
    const totalItems = items.length;
    const visibleItems = 5; 

    currentIndex[sectionId] += direction;

    if (currentIndex[sectionId] < 0) {
        currentIndex[sectionId] = totalItems - visibleItems;
    } else if (currentIndex[sectionId] > totalItems - visibleItems) {
        currentIndex[sectionId] = 0;
    }

    const newTransform = -currentIndex[sectionId] * (100 / visibleItems);
    carousel.style.transform = `translateX(${newTransform}%)`;
}
