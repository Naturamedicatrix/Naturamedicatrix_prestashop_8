/**
 * Gestion du panneau d'actualités avec overlay et fade-in/fade-out
 */
document.addEventListener('DOMContentLoaded', function() {
  const carouselTrigger = document.getElementById('carousel-trigger');
  const actusPanel = document.getElementById('actus-panel');
  const closeActusBtn = document.getElementById('close-actus');
  const prevButton = document.getElementById('carousel-prev');
  const nextButton = document.getElementById('carousel-next');
  const actusOverlay = document.getElementById('actus-overlay');

  // Fonction pour ouvrir le panneau d'actualités
  function openActusPanel(event) {
    // Empêche l'ouverture si clic sur les boutons de navigation
    if (event.target.closest('.carousel-nav-button')) {
      return;
    }

    actusPanel.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
    actusPanel.classList.add('active');

    if (actusOverlay) {
      actusOverlay.classList.remove('hidden');
      // Animation fade-in overlay
      setTimeout(() => actusOverlay.classList.add('opacity-100'), 10);
    }
  }

  // Fonction pour fermer le panneau d'actualités
  function closeActusPanel() {
    actusPanel.classList.remove('active');
    actusPanel.classList.add('opacity-0', 'pointer-events-none');

    if (actusOverlay) {
      // Animation fade-out overlay
      actusOverlay.classList.remove('opacity-100');
      setTimeout(() => actusOverlay.classList.add('hidden'), 300);
    }
  }

  // Gestionnaires d'événements
  if (carouselTrigger) {
    carouselTrigger.addEventListener('click', openActusPanel);
  }

  if (closeActusBtn) {
    closeActusBtn.addEventListener('click', closeActusPanel);
  }

  // Fermer le panneau si clic en dehors
  document.addEventListener('click', function(event) {
    if (
      actusPanel.classList.contains('active') &&
      !actusPanel.contains(event.target) &&
      !carouselTrigger.contains(event.target)
    ) {
      closeActusPanel();
    }
  });

  // Fermer le panneau si clic sur l'overlay
  if (actusOverlay) {
    actusOverlay.addEventListener('click', closeActusPanel);
  }

  // Empêche la propagation des clics sur les boutons de navigation
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