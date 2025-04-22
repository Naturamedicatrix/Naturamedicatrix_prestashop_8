/**
 * Texte Carousel pour l'en-tête
 * Pour thème classic_tailwind de Naturamedicatrix
 */
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.getElementById('text-carousel');
  if (!carousel) return;
  
  const items = carousel.querySelectorAll('.carousel-item');
  const prevButton = document.getElementById('carousel-prev');
  const nextButton = document.getElementById('carousel-next');
  let currentIndex = 0;
  
  function showSlide(index) {
    // Masquer tous les slides
    items.forEach(item => {
      item.classList.remove('active');
      item.classList.add('inactive');
    });
    
    // Afficher le slide actif avec animation de défilement
    items[index].classList.remove('inactive');
    items[index].classList.add('active');
  }
  
  function nextSlide() {
    currentIndex = (currentIndex + 1) % items.length;
    showSlide(currentIndex);
  }
  
  function prevSlide() {
    currentIndex = (currentIndex - 1 + items.length) % items.length;
    showSlide(currentIndex);
  }
  
  // Initialiser la première slide
  showSlide(0);
  
  // Ajouter des interactions aux boutons de navigation
  if (prevButton) {
    prevButton.addEventListener('click', (e) => {
      e.preventDefault();
      prevSlide();
    });
  }
  
  if (nextButton) {
    nextButton.addEventListener('click', (e) => {
      e.preventDefault();
      nextSlide();
    });
  }
});
