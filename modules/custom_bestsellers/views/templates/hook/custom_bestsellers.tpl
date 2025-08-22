{**
 * Template pour le module custom_bestsellers
 * Affiche des produits spécifiques comme "meilleures ventes"
 *}
 <div class="bg-wrapper mb-20 py-16">
 <section class="featured-products block-bestsellers clearfix container">
   <div class="all-product-link text-center">
     <a href="{$allProductsLink}">
       » {l s='Toutes nos meilleures offres' d='Modules.Custombest.Shop'}
     </a>
   </div>

   <h2 class="h2 products-section-title">
     {l s='Deal of the day' d='Modules.Custombest.Shop'}
   </h2>
   
   <div class="title-separator">
     <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
       <path class="logo-title"
         d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
     </svg>
   </div>
   
   <div class="relative">
     <div class="bestsellers-slider mb-1 mt-1">
       {foreach from=$allProducts item=product}
         {include file="catalog/_partials/miniatures/product-big.tpl" product=$product productClasses=""}
       {/foreach}
     </div>
   </div>
 </section>
</div>