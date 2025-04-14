/**
 * Footer Accordion Mobile Script
 * For classic_tailwind theme by Jordan Morlet (itdev@naturamedicatrix.lu)
 */

document.addEventListener('DOMContentLoaded', function() {
  const titles = document.querySelectorAll('.footer-column h4');
  const contents = document.querySelectorAll('.footer-column-content');
  
  // Fonction pour initialiser l'accordéon en fonction de la taille d'écran
  function initAccordion() {
    const isSmallScreen = window.innerWidth <= 1200;
    
    // Ajouter ou supprimer les écouteurs d'événements en fonction de la taille d'écran
    titles.forEach((title, index) => {
      // Récupérer le contenu associé
      const contentId = 'footer-content-' + title.id.split('-')[2];
      const content = document.getElementById(contentId);
      
      if (isSmallScreen) {
        // Mode accordéon pour petit écran
        
        // S'assurer que tous les contenus sont masqués initialement
        if (!title.classList.contains('active')) {
          content.classList.remove('expanded');
          content.style.display = 'none';
        }
        
        // Ajouter l'écouteur d'événement s'il n'existe pas déjà
        if (!title.hasEventListener) {
          title.addEventListener('click', toggleAccordion);
          title.hasEventListener = true;
        }
      } else {
        // Mode normal pour grand écran
        
        // S'assurer que tous les contenus sont visibles
        content.classList.remove('expanded');
        content.style.display = 'block';
        title.classList.remove('active');
      }
    });
  }
  
  // Fonction pour gérer le clic sur un titre
  function toggleAccordion() {
    // Récupérer l'ID du contenu associé
    const contentId = 'footer-content-' + this.id.split('-')[2];
    const content = document.getElementById(contentId);
    
    // Toggle des classes pour le titre et le contenu
    this.classList.toggle('active');
    
    // Toggle de l'affichage du contenu
    if (content.style.display === 'none' || content.style.display === '') {
      content.style.display = 'block';
      content.classList.add('expanded');
      
      // Fermer les autres accordéons
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
  
  // Initialiser l'accordéon au chargement de la page
  initAccordion();
  
  // Réinitialiser l'accordéon lors du redimensionnement de la fenêtre
  window.addEventListener('resize', initAccordion);
});
