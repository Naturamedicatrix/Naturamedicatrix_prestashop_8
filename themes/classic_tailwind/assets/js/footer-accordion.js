/**
 * Footer Accordion Mobile Script
 * For classic_tailwind theme by Jordan Morlet (itdev@naturamedicatrix.lu)
 */

document.addEventListener('DOMContentLoaded', function() {
  // Activation uniquement sur mobile
  if (window.innerWidth <= 768) {
    // Pour chaque titre dans le footer
    const titles = document.querySelectorAll('.footer-column h4');
    titles.forEach(title => {
      title.addEventListener('click', function() {
        // Récupérer l'ID du contenu associé
        const contentId = 'footer-content-' + this.id.split('-')[2];
        const content = document.getElementById(contentId);
        
        // Toggle de la classe expanded
        this.classList.toggle('expanded');
        content.classList.toggle('expanded');
      });
    });
  }
  
  // Listener pour le redimensionnement de la fenêtre
  window.addEventListener('resize', function() {
    const isMobile = window.innerWidth <= 768;
    const titles = document.querySelectorAll('.footer-column h4');
    
    if (isMobile) {
      // Réactiver l'accordéon si on passe au mobile
      titles.forEach(title => {
        if (!title.hasEventListener) {
          title.addEventListener('click', function() {
            const contentId = 'footer-content-' + this.id.split('-')[2];
            const content = document.getElementById(contentId);
            
            this.classList.toggle('expanded');
            content.classList.toggle('expanded');
          });
          title.hasEventListener = true;
        }
      });
    }
  });
});
