/**
 * Product carousel script pour les meilleurs offres
 */
document.addEventListener('DOMContentLoaded', function() {
  // Détection du type d'appareil (mobile et tablette vs desktop)
  const isMobileOrTablet = window.innerWidth < 992;
  
  // Affichage/masquage des éléments selon le type d'appareil
  const desktopCarousel = document.querySelector('.carousel-slides-desktop');
  const mobileCarousel = document.querySelector('.carousel-slides-mobile');
  const desktopPagination = document.querySelector('.desktop-pagination');
  const mobilePagination = document.querySelector('.mobile-pagination');
  
  if (isMobileOrTablet) {
    // Affichage mobile et tablette
    if (desktopCarousel) desktopCarousel.style.display = 'none';
    if (mobileCarousel) mobileCarousel.style.display = 'block';
    if (desktopPagination) desktopPagination.style.display = 'none';
    if (mobilePagination) mobilePagination.style.display = 'flex';
    
    // Initialisation du carousel mobile/tablette
    initCarousel('.carousel-slides-mobile .carousel-slide', '.mobile-pagination .dot');
  } else {
    // Affichage desktop uniquement
    if (desktopCarousel) desktopCarousel.style.display = 'block';
    if (mobileCarousel) mobileCarousel.style.display = 'none';
    if (desktopPagination) desktopPagination.style.display = 'flex';
    if (mobilePagination) mobilePagination.style.display = 'none';
    
    // Initialisation du carousel desktop
    initCarousel('.carousel-slides-desktop .carousel-slide', '.desktop-pagination .dot');
  }
  
  // Gère le redimensionnement de la fenêtre
  window.addEventListener('resize', function() {
    const newIsMobileOrTablet = window.innerWidth < 992;
    
    // Ne rien faire si le type d'appareil n'a pas changé
    if (newIsMobileOrTablet === isMobileOrTablet) return;
    
    // Recharge la page pour réinitialiser le carousel
    window.location.reload();
  });
  
  /**
   * Initialise un carousel avec les slides et points de pagination spécifiés
   * @param {string} slidesSelector - Sélecteur CSS pour les slides
   * @param {string} dotsSelector - Sélecteur CSS pour les points de pagination
   */
  function initCarousel(slidesSelector, dotsSelector) {
    // Variables
    let currentSlide = 0;
    const dots = document.querySelectorAll(dotsSelector);
    const slides = document.querySelectorAll(slidesSelector);
    const totalSlides = slides.length;
    
    // Variables pour le swipe
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    const minSwipeDistance = 50; // Distance minimale pour détecter un swipe
    
    if (!slides.length || !dots.length) return;
    
    // Récupérer le conteneur parent pour les événements tactiles
    const carouselContainer = slides[0].parentElement;
    
    // Masque toutes les slides sauf la première
    slides.forEach((slide, index) => {
      if (index === 0) {
        slide.classList.add('active');
      } else {
        slide.classList.add('next'); // Toutes les autres slides sont à droite
      }
    });
    
    // Fonction pour afficher une slide spécifique avec animation
    function showSlide(newIndex) {
      if (newIndex === currentSlide) return;
      
      // Déterminer la direction
      const direction = newIndex > currentSlide ? 'next' : 'prev';
      
      // Mettre à jour les indicateurs
      dots.forEach(dot => dot.classList.remove('active'));
      dots[newIndex].classList.add('active');
      
      // Récupère les slides concernées
      const currentElement = slides[currentSlide];
      const nextElement = slides[newIndex];
      
      // Nettoie les classes précédentes
      slides.forEach(slide => {
        slide.classList.remove('active', 'prev', 'next');
        if (slide !== currentElement && slide !== nextElement) {
          slide.classList.add(direction === 'next' ? 'next' : 'prev');
        }
      });
      
      // Positionne la nouvelle slide
      if (direction === 'next') {
        // Animation vers la gauche
        currentElement.classList.add('prev');
        nextElement.classList.add('active');
      } else {
        // Animation vers la droite
        currentElement.classList.add('next');
        nextElement.classList.add('active');
      }
      
      currentSlide = newIndex;
    }
    
    // Ajoute les écouteurs d'événements sur les points de pagination
    dots.forEach((dot, index) => {
      dot.addEventListener('click', function() {
        showSlide(index);
      });
    });
    
    // Fonction pour passer à la slide suivante
    function nextSlide() {
      let nextIndex = currentSlide + 1;
      if (nextIndex >= totalSlides) {
        nextIndex = 0;
      }
      showSlide(nextIndex);
    }
    
    // Fonction pour passer à la slide précédente
    function prevSlide() {
      let prevIndex = currentSlide - 1;
      if (prevIndex < 0) {
        prevIndex = totalSlides - 1;
      }
      showSlide(prevIndex);
    }
    
    // Fonctions pour la gestion des événements tactiles (swipe)
    function handleTouchStart(event) {
      touchStartX = event.touches[0].clientX;
      touchStartY = event.touches[0].clientY;
    }
    
    function handleTouchMove(event) {
      // Empêcher le défilement vertical pendant le swipe horizontal
      touchEndX = event.touches[0].clientX;
      touchEndY = event.touches[0].clientY;
      
      // Calculer la distance horizontale et verticale
      const diffX = touchStartX - touchEndX;
      const diffY = touchStartY - touchEndY;
      
      // Si le mouvement horizontal est plus important que le vertical, empêcher le défilement de la page
      if (Math.abs(diffX) > Math.abs(diffY)) {
        event.preventDefault();
      }
    }
    
    function handleTouchEnd() {
      const diffX = touchStartX - touchEndX;
      const diffY = touchStartY - touchEndY;
      
      // Vérifier si c'est un swipe horizontal (et non vertical)
      if (Math.abs(diffX) > Math.abs(diffY)) {
        // Vérifier si la distance est suffisante pour être considérée comme un swipe
        if (Math.abs(diffX) > minSwipeDistance) {
          if (diffX > 0) {
            // Swipe vers la gauche -> slide suivante
            nextSlide();
          } else {
            // Swipe vers la droite -> slide précédente
            prevSlide();
          }
        }
      }
    }
    
    // Ajouter les écouteurs d'événements tactiles
    carouselContainer.addEventListener('touchstart', handleTouchStart, { passive: false });
    carouselContainer.addEventListener('touchmove', handleTouchMove, { passive: false });
    carouselContainer.addEventListener('touchend', handleTouchEnd, { passive: false });
  }
});