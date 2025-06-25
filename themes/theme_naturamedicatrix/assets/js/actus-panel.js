/**
 * Gestion du panneau d'actualités
 */
document.addEventListener('DOMContentLoaded', function() {
  const carouselTrigger = document.getElementById('carousel-trigger');
  const actusPanel = document.getElementById('actus-panel');
  const closeActusBtn = document.getElementById('close-actus');
  const prevButton = document.getElementById('carousel-prev');
  const nextButton = document.getElementById('carousel-next');
  
  // Fonction pour ouvrir le panneau d'actualités
  function openActusPanel(event) {
    // Vérifier que le clic n'est pas sur les boutons de navigation
    if (event.target.closest('.carousel-nav-button')) {
      return;
    }
    
    actusPanel.classList.add('active');
  }
  
  // Fonction pour fermer le panneau d'actualités
  function closeActusPanel() {
    actusPanel.classList.remove('active');
  }
  
  // Gestionnaires d'événements
  if (carouselTrigger) {
    carouselTrigger.addEventListener('click', openActusPanel);
  }
  
  if (closeActusBtn) {
    closeActusBtn.addEventListener('click', closeActusPanel);
  }
  
  // Fermer le panneau si on clique en dehors
  document.addEventListener('click', function(event) {
    if (actusPanel.classList.contains('active') && 
        !actusPanel.contains(event.target) && 
        !carouselTrigger.contains(event.target)) {
      closeActusPanel();
    }
  });
  
  // Empêcher la propagation des clics sur les boutons de navigation
  if (prevButton) {
    prevButton.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }
  
  if (nextButton) {
    nextButton.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }
});
