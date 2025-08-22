/**
 * Slider Bestsellers avec Tiny Slider
 * Gestion responsive et adaptive selon le nombre de produits
 */
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function() {
    if (typeof tns === 'undefined' || !document.querySelector('.bestsellers-slider')) {
      return;
    }
    
    const container = document.querySelector('.bestsellers-slider');
    const productItems = container.querySelectorAll('.product-miniature');
    const totalProducts = productItems.length;
    
    if (totalProducts === 0) return;
    
    try {
      const slider = tns({
        container: '.bestsellers-slider',
        items: Math.min(3, totalProducts),
        slideBy: 1,
        autoplay: false,
        controls: totalProducts > 3,
        controlsText: ["", ""],
        nav: totalProducts > 3,
        navPosition: 'bottom',
        mouseDrag: totalProducts > 3,
        touch: totalProducts > 3,
        gutter: 16,
        edgePadding: 0,
        fixedWidth: false,
        loop: true,
        rewind: false,
        responsive: {
          0: { 
            items: Math.min(1, totalProducts),
            gutter: 8,
            controls: totalProducts > 1,
            nav: totalProducts > 1,
            mouseDrag: totalProducts > 1,
            touch: totalProducts > 1
          },
          640: { 
            items: Math.min(2, totalProducts),
            gutter: 12,
            controls: totalProducts > 2,
            nav: totalProducts > 2,
            mouseDrag: totalProducts > 2,
            touch: totalProducts > 2
          },
          992: { 
            items: Math.min(3, totalProducts),
            gutter: 16,
            controls: totalProducts > 3,
            nav: totalProducts > 3,
            mouseDrag: totalProducts > 3,
            touch: totalProducts > 3
          }
        }
      });

      // Fonction pour appliquer la classe active-focus au produit du milieu
      function updateActiveFocus() {
        // Supprimer toutes les classes active-focus existantes
        container.querySelectorAll('.product-miniature').forEach(item => {
          item.classList.remove('active-focus');
        });

        // Trouver les slides visibles (tns-slide-active)
        const activeSlides = container.querySelectorAll('.tns-slide-active');
        
        if (activeSlides.length > 0) {
          let middleIndex;
          
          if (activeSlides.length === 1) {
            // 1 slide visible (mobile) - prendre le premier
            middleIndex = 0;
          } else if (activeSlides.length === 2) {
            // 2 slides visibles (tablette) - prendre le second
            middleIndex = 1;
          } else {
            // 3+ slides visibles (desktop) - prendre le milieu
            middleIndex = Math.floor(activeSlides.length / 2);
          }
          
          const middleSlide = activeSlides[middleIndex];
          const productMiniature = middleSlide.querySelector('.product-miniature');
          
          if (productMiniature) {
            productMiniature.classList.add('active-focus');
          }
        }
      }

      // Appliquer au chargement initial
      setTimeout(updateActiveFocus, 100);

      // Écouter les événements de changement de slide
      slider.events.on('indexChanged', function() {
        updateActiveFocus();
      });

    } catch (error) {
    }
  }, 300);
});