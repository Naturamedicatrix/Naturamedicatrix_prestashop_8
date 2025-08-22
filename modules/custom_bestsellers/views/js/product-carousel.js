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
        },
        onInit: function(info) {
          console.log('Slider initialized:', {
            totalSlides: info.slideCount,
            currentIndex: info.index,
            displayIndex: info.displayIndex
          });
          updateProductFocus(info);
        }
      });
      
      // Écouter les changements de slide
      slider.events.on('indexChanged', function(info) {
        console.log('Slide changed:', {
          previousIndex: info.indexCached,
          currentIndex: info.index,
          displayIndex: info.displayIndex
        });
        updateProductFocus(info);
      });
      
      // Fonction pour mettre à jour le focus des produits
      function updateProductFocus(info) {
        // Retirer la classe active de tous les produits
        info.slideItems.forEach(function(slide) {
          slide.querySelector('.product-big').classList.remove('active-focus');
        });
        
        // Ajouter la classe active au produit central visible
        const centralIndex = info.index + Math.floor(info.items / 2);
        if (info.slideItems[centralIndex]) {
          info.slideItems[centralIndex].querySelector('.product-big').classList.add('active-focus');
        }
      }
    } catch (error) {
    }
  }, 300);
});