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
    <div class="header-category-manufacturer">
      <div class="logo-manufacturer mb-12">
        <img src="{$urls.img_manu_url}/{$manufacturer.id}-brand_simple.jpg" alt="{$manufacturer.name}" class="mx-auto" loading="lazy">
      </div>
      <h1 class="text-center pb-4">{$manufacturer.name}</h1>

      {* NB DE PRODUITS *}
    <div class="total-products text-center">
      {if $listing.pagination.total_items > 1}
          <p class="count-product">{l s='%product_count% produits' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.pagination.total_items]}</p>
      {elseif $listing.pagination.total_items > 0}
          <p class="count-product">{l s='%product_count% produit' d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.pagination.total_items]}</p>
      {/if}
    </div>
      
      <div id="manufacturer-short_description" class="text-left">{$manufacturer.short_description nofilter}</div>
  
    </div>
    
    
{*     {assign var='bestselles' value=Product::getProducts($language.id, 0, 3, 'date_add', 'desc', null, true, Context::getContext(), false, $manufacturer.id)} *}
    
    
    {if $bestselles|count > 0}
        {include file='../_partials/productlist-best.tpl' products=$bestselles}
    {/if}

    
    
    {* Liste des produits *}
    <section id="products">
      {if $listing.products|count}
        <div class="products row">
          {foreach from=$listing.products item="product"}
            <div class="{if isset($productClass)}{$productClass}{else}col-xs-12 col-sm-6 col-md-6 col-xl-4 col-xxl-4{/if}">
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