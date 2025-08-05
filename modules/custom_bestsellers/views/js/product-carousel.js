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
        rewind: true,
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
    } catch (error) {
      // Erreur silencieuse
    }
  }, 500);
});