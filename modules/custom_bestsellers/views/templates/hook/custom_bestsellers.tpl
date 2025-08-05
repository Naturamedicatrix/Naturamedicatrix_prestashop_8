{**
 * Template pour le module custom_bestsellers
 * Affiche des produits spécifiques comme "meilleures ventes"
 *}
 <div class="bg-wrapper mb-20 py-20">
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
   
   <!-- Module custom_bestsellers: PHP, JS, CSS -->
   <div id="bestsellers-carousel" class="product-list-carousel">
     {* Slides pour desktop (dynamique - 3 produits par slide) *}
     <div class="carousel-slides-desktop">
       {* Calculer le nombre de pages nécessaires *}
       {assign var="totalProducts" value=$allProducts|@count}
       {assign var="productsPerPage" value=3}
       {assign var="totalPages" value=ceil($totalProducts/$productsPerPage)}
       
       {* Générer dynamiquement les slides *}
       {for $pageIndex=0 to $totalPages-1}
         {* Calculer les produits pour cette page *}
         {assign var="startIndex" value=$pageIndex*$productsPerPage}
         {assign var="endIndex" value=min(($pageIndex+1)*$productsPerPage-1, $totalProducts-1)}
         {assign var="pageProducts" value=[]}
         
         {* Extraire les produits pour cette page *}
         {for $i=$startIndex to $endIndex}
           {append var="pageProducts" value=$allProducts[$i]}
         {/for}
         
         <div class="carousel-slide {if $pageIndex == 0}active{/if}">
           {include file="catalog/_partials/productlist-bestseller.tpl" products=$pageProducts cssClass="row" productClass="col-xs-12 col-sm-6 col-lg-3 col-xl-3"}
         </div>
       {/for}
     </div>
     
     {* Slides pour mobile (1 produit par slide) *}
     <div class="carousel-slides-mobile">
       {* Génération dynamique des slides pour mobile (1 produit par slide) *}
       {foreach from=$allProducts item="product" key="index"}
         <div class="carousel-slide {if $index == 0}active{/if}">
           <div class="row">
             <div class="col-xs-12">
               {include file="catalog/_partials/miniatures/product-bestseller.tpl" product=$product productClasses=""}
             </div>
           </div>
         </div>
       {/foreach}
     </div>
   </div>
   
   {* Pagination pour desktop (dynamique en fonction du nombre de produits) *}
   <div class="product-list-pagination desktop-pagination">
     {* Calculer le nombre de pages nécessaires (arrondi au supérieur) *}
     {assign var="totalPages" value=ceil($allProducts|@count/3)}
     {for $pageIndex=0 to $totalPages-1}
       <span class="dot {if $pageIndex == 0}active{/if}" data-slide="{$pageIndex}"></span>
     {/for}
   </div>
   
   {* Pagination pour mobile (un point par produit) *}
   <div class="product-list-pagination mobile-pagination">
     {foreach from=$allProducts item="product" key="index"}
       <span class="dot {if $index == 0}active{/if}" data-slide="{$index}"></span>
     {/foreach}
   </div>
 </section>
 </div>
 
 