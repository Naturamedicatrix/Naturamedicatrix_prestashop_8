/**
 * Footer Accordion Mobile Script
 */

document.addEventListener('DOMContentLoaded', function() {
  const titles = document.querySelectorAll('.footer-column h4');
  const contents = document.querySelectorAll('.footer-column-content');
  
  // Fonction pour initialiser l'accordéon en fonction de la taille d'écran
  function initAccordion() {
    const isSmallScreen = window.innerWidth <= 1200;
    
    // Ajoute ou supprime les listeners en fonction de la size de l'écran
    titles.forEach((title, index) => {
      const contentId = 'footer-content-' + title.id.split('-')[2];
      const content = document.getElementById(contentId);
      
      if (isSmallScreen) {
        // Mode accordéon pour petit écran
        
        if (!title.classList.contains('active')) {
          content.classList.remove('expanded');
          content.style.display = 'none';
        }

        if (!title.hasEventListener) {
          title.addEventListener('click', toggleAccordion);
          title.hasEventListener = true;
        }
      } else {
        // Mode normal pour grand écran
        content.classList.remove('expanded');
        content.style.display = 'block';
        title.classList.remove('active');
      }
    });
  }
  
  // Fonction pour afficher l'accordéon
  function toggleAccordion() {
    const contentId = 'footer-content-' + this.id.split('-')[2];
    const content = document.getElementById(contentId);
    
    this.classList.toggle('active');
    
    // Affiche le content
    if (content.style.display === 'none' || content.style.display === '') {
      content.style.display = 'block';
      content.classList.add('expanded');
      
      // Ferme les autres contenus (accordéons)
      titles.forEach(otherTitle => {
        if (otherTitle !== this) {
          const otherContentId = 'footer-content-' + otherTitle.id.split('-')[2];
          const otherContent = document.getElementById(otherContentId);
          otherTitle.classList.remove('active');
          otherContent.classList.remove('expanded');
          otherContent.style.display = 'none';
        }
      });
    } else {
      content.classList.remove('expanded');
      content.style.display = 'none';
    }
  }
  
  // Initialise l'accordéon au chargement de la page
  initAccordion();
  
  // Réinitialise l'accordéon lors du redimensionnement de la fenêtre
  window.addEventListener('resize', initAccordion);
});
