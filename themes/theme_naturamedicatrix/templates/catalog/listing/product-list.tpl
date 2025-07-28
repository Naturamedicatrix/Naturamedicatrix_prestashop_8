{**
 * CUSTOM product-list.tpl - Override complet avec filtres au-dessus des produits
 *}
 {extends file=$layout}

 {block name='head_microdata_special'}
   {include file='_partials/microdata/product-list-jsonld.tpl' listing=$listing}
 {/block}
 
 {block name='content'}
   <section id="main">
 
     {block name='product_list_header'}
       <h1 id="js-product-list-header" class="h2">{$listing.label}</h1>
     {/block}
 
     {block name='subcategory_list'}
       {if isset($subcategories) && $subcategories|@count > 0}
         {include file='catalog/_partials/subcategories.tpl' subcategories=$subcategories}
       {/if}
     {/block}
     
     {hook h="displayHeaderCategory"}
 
     <section id="products">
       {if $listing.products|count}
 
         {* {block name='product_list_top'}
           {include file='catalog/_partials/products-top.tpl' listing=$listing}
         {/block} *}
 
         {block name='product_list_active_filters'}
           <div class="hidden-sm-down">
             {$listing.rendered_active_filters nofilter}
           </div>
         {/block}
 
         {* FILTRE ET TRI *}
         <div class="top-products-filter md:hidden flex justify-between py-4 border-t border-gray-200">
           {block name="filter_products"}
             {** FILTRE **}
             <div class="filter-product flex gap-1">
              <svg id="Icon_Outline_adjustments" fill="none" data-name="Icon/Outline/adjustments" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="color: #111827;">
                  <path id="fond" style="fill:none" d="M0 0h24v24H0z"></path>
                  <path id="Icon" class=" stroke-current" style="fill:none;stroke-linecap:round;stroke-linejoin:round" d="M4 12a2 2 0 1 1-2-2 2 2 0 0 1 2 2z" transform="translate(4 4)"></path>
                  <path id="Icon-2" data-name="Icon" class=" stroke-current" d="M10 4a2 2 0 1 1-2-2 2 2 0 0 1 2 2z" transform="translate(4 4)"></path>
                  <path id="Icon-3" data-name="Icon" class=" stroke-current" d="M16 12a2 2 0 1 1-2-2 2 2 0 0 1 2 2z" transform="translate(4 4)"></path>
                  <path id="Icon-4" data-name="Icon" class=" stroke-current" d="M8 2V0M2 14v2m0-6V0m6 6v10m6-2v2m0-6V0" transform="translate(4 4)"></path></svg>
                  {hook h="displayLeftColumn"}
             </div>
             
             {** TRI **}
             <div class="sort-product flex gap-1" style="color: #111827;">
               <i class="bi bi-sort-down text-lg"></i>
               {include file="catalog/_partials/sort-orders.tpl"}
             </div>
           {/block}
         </div>
         {* END FILTRE ET TRI *}
 
         {block name='product_list'}
           {include file='catalog/_partials/products.tpl' listing=$listing productClass="col-xs-12 col-sm-6 col-xl-4"}
         {/block}
 
         {block name='product_list_bottom'}
           {include file='catalog/_partials/products-bottom.tpl' listing=$listing}
         {/block}
 
       {else}
         <div id="js-product-list-top"></div>
 
         <div id="js-product-list">
           {capture assign="errorContent"}
             <h4>{l s='No products available yet' d='Shop.Theme.Catalog'}</h4>
             <p>{l s='Stay tuned! More products will be shown here as they are added.' d='Shop.Theme.Catalog'}</p>
           {/capture}
 
           {include file='errors/not-found.tpl' errorContent=$errorContent}
         </div>
 
         <div id="js-product-list-bottom"></div>
       {/if}
     </section>
 
     {block name='product_list_footer'}{/block}
 
     {hook h="displayFooterCategory"}
 
   </section>
 {/block}