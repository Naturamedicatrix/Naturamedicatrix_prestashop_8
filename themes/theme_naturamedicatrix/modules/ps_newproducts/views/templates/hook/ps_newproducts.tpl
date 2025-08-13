{**
 * Template pour le module ps_newproducts
 * Affiche des produits "nouveautés" avec Tiny Slider
 *}

<section class="featured-products block-newproducts clearfix">
  <div class="all-product-link text-center">
    <a href="{$allNewProductsLink|default:$link->getPageLink('new-products')}">
      » {l s='Toutes nos nouveautés' d='Modules.Ps_newproducts.Shop'}
    </a>
  </div>
 
  <h2 class="h2 products-section-title">
    {l s='Nouveaux produits' d='Modules.Ps_newproducts.Shop'}
  </h2>
   
  <div class="title-separator">
    <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
      <path class="logo-title"
        d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
    </svg>
  </div>

  <!-- Slider Tiny Slider pour nouveaux produits -->
  <div class="relative">
    <div class="newproducts-slider mb-1 mt-1">
      {foreach from=$products item=product}
        {include file="catalog/_partials/miniatures/product-light.tpl" product=$product productClasses=""}
      {/foreach}
    </div>
  </div>
</section>
 
 
{include file='_partials/home-categories.tpl'}


<script>
/**
 * Slider Newproducts avec Tiny Slider
 * Gestion responsive et adaptive selon le nombre de produits
 */
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function() {
    if (typeof tns === 'undefined' || !document.querySelector('.newproducts-slider')) {
      return;
    }
    
    const container = document.querySelector('.newproducts-slider');
    const productItems = container.querySelectorAll('.product-miniature');
    const totalProducts = productItems.length;
    
    if (totalProducts === 0) return;
    
    try {
      const slider = tns({
        container: '.newproducts-slider',
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
    }
  }, 300);
});
</script>
  