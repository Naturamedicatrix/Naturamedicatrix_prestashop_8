{**
 * Fichier : manufacturer.tpl
 *}
 
{* Extension du layout avec colonne gauche pour afficher les filtres *}
{extends file='layouts/layout-left-column.tpl'}

{* Bloc pour la colonne de gauche avec les filtres *}
{* {block name='left_column'}
  <div id="left-column" class="col-xs-12 col-md-4 col-lg-3">
    {hook h="displayLeftColumn"}
  </div>
{/block} *}






{* Bloc pour le contenu principal *}
{block name='content'}
  <section id="main">
    {* En-tête avec logo et descriptions *}
    <div class="header-category-manufacturer mt-8">
      <div class="logo-manufacturer mb-8">
        <img src="{$urls.img_manu_url}/{$manufacturer.id}-brand_simple.jpg" alt="{$manufacturer.name}" class="mx-auto" loading="lazy">
      </div>
      <h1 class="text-center pb-4 mb-0">{$manufacturer.name}</h1>

      {* NB DE PRODUITS *}
      <div class="total-products text-center mb-1">
        {if $listing.pagination.total_items > 1}
            <span class="inline-flex items-center rounded-lg bg-gray-50 px-2.5 py-0.5 text-sm font-medium text-gray-500 border border-gray-200">{l s='%product_count% produits' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.pagination.total_items]}</span>
        {elseif $listing.pagination.total_items > 0}
            <span class="inline-flex items-center rounded-lg bg-gray-50 px-2.5 py-0.5 text-sm font-medium text-gray-500 border border-gray-200">{l s='%product_count% produit' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.pagination.total_items]}</span>
        {/if}
      </div>
      
      <div id="manufacturer-short_description" class="max-w-4xl mx-auto text-center px-4 text-lg">{$manufacturer.short_description nofilter}</div>
  
    </div>
    
    
{*     {assign var='bestselles' value=Product::getProducts($language.id, 0, 3, 'date_add', 'desc', null, true, Context::getContext(), false, $manufacturer.id)} *}
    
    
    {if $bestselles|count > 0}
        {include file='../_partials/productlist-best.tpl' products=$bestselles}
    {/if}

    
    
    {block name='product_list_active_filters'}
      <div class="hidden-sm-down">
        {$listing.rendered_active_filters nofilter}
      </div>
    {/block}

    {* Liste des produits *}
    <section id="products">

         {* FILTRE ET TRI *}
         <div class="top-products-filter md:hidden flex justify-between pt-1.5 pb-4">
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

      {if $listing.products|count}
        <div class="products row">
          {foreach from=$listing.products item="product"}
            <div class="{if isset($productClass)}{$productClass}{else}col-xs-6 col-sm-6 col-md-6 col-xl-4 col-xxl-4{/if}">
              {include file="catalog/_partials/miniatures/product.tpl" product=$product}
            </div>
          {/foreach}
        </div>

        {* Pagination *}
        {block name='pagination'}
          {include file='_partials/pagination.tpl' pagination=$listing.pagination}
        {/block}
      {else}
        <div class="alert alert-warning text-center">
          {l s='No products available yet' d='Shop.Theme.Catalog'}
        </div>
      {/if}
    </section>
    <div id="manufacturer-description" class="text-left">{$manufacturer.description nofilter}</div>
  </section>

{/block}




<style>

  .count-product {
    border: 1px solid #6a72821a;
    color: #4a5565;
    background: #fbf9fa;
    display: inline-block;
  }
  
</style>
