/**
 * Texte Carousel pour le nav
 */
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.getElementById('text-carousel');
  if (!carousel) return;
  
  const items = carousel.querySelectorAll('.carousel-item');
  const prevButton = document.getElementById('carousel-prev');
  const nextButton = document.getElementById('carousel-next');
  let currentIndex = 0;
  let slideInterval; // stock l'id de l'intervalle
  
  function showSlide(index) {
    // Masque tous les slides
    items.forEach(item => {
      item.classList.remove('active');
      item.classList.add('inactive');
    });
    
    // Affiche le slide actif avec animation de défilement
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
  
  // Fonction pour le défilement auto (3sec)
  function startAutoSlide() {
    stopAutoSlide();
    slideInterval = setInterval(function() {
      nextSlide();
    }, 3000);
  }
  
  // Fonction pour stop le défilement automatique
  function stopAutoSlide() {
    if (slideInterval) {
      clearInterval(slideInterval);
    }
  }
  
  // Initialise 1er slide
  showSlide(0);
  
  // Démarre le défilement automatique
  startAutoSlide();
  
  // Défilement avec les boutons
  if (prevButton) {
    prevButton.addEventListener('click', (e) => {
      e.preventDefault();
      prevSlide();
      // Redemarre le slide auto après avoir cliqué sur les btn de défilement
      startAutoSlide();
    });
  }
  
  if (nextButton) {
    nextButton.addEventListener('click', (e) => {
      e.preventDefault();
      nextSlide();
      startAutoSlide();
    });
  }
  
  // Stop le slide auto quand on passe la souris dessus
  carousel.addEventListener('mouseenter', stopAutoSlide);
  // Reprend le slide auto si la souris quitte le slide
  carousel.addEventListener('mouseleave', startAutoSlide);
});
