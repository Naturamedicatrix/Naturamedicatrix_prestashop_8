{**
* PRODUCT NEW - Template spécifique pour les produits "Nouveautés"
*}

{* VARIABLES *}
{assign var=productName value=$product.name|escape:'html':'UTF-8'}
{assign var=productName value=$productName|replace:'(':'<span class="small">('}
{assign var=productName value=$productName|replace:')':')</span>'}
{* END VARIABLES *}

{block name='product_miniature_item'}
  <div class="js-product product col-xs-12 col-md-12 col-lg-4 col-xl-4">
    <article class="product-miniature product-miniature-light js-product-miniature" data-id-product="{$product.id_product}"
      data-id-product-attribute="{$product.id_product_attribute}">
      
      <div class="container">
        {* Product flags - affiche les badges "new" et "discount" *}
        <div class="product-flags pb-4">
          <ul class="product-flags js-product-flags">
            {* Affiche le badge "new" si le produit a le flag ou s'il est dans la catégorie "Nouveautés" *}
            {assign var="showNewBadge" value=false}
            
            {* Vérifie si le produit a déjà un flag "new" *}
            {foreach from=$product.flags item=flag}
              {if $flag.type == 'new'}
                {assign var="showNewBadge" value=true}
                <li class="product-flag {$flag.type}">{$flag.label}</li>
              {/if}
            {/foreach}
            
            {* Si le produit n'a pas déjà un badge "new", on vérifie s'il est dans la catégorie "Nouveautés" *}
            {if !$showNewBadge}
              {foreach from=$product.categories item=category}
                {if $category.name == 'Nouveautés'}
                  <li class="product-flag new">{l s='Nouveau' d='Shop.Theme.Catalog'}</li>
                  {break}
                {/if}
              {/foreach}
            {/if}
            
            {* Affiche le badge "discount" *}
            {foreach from=$product.flags item=flag}
              {if $flag.type == 'discount'}
              <li class="product-flag {$flag.type}">{$flag.label} {if isset($product.dlu_checkbox) && $product.dlu_checkbox == 1}<span class="dlc-text">DLC courte</span>{/if}</li>
              {/if}
            {/foreach}
            
          </ul>
        </div>
        
        {* Product thumbnail *}
        {block name='product_thumbnail'}
          <div class="product-image-container">
            <a href="{$product.url}" class="thumbnail product-thumbnail">
              <picture>
                {if !empty($product.cover.bySize.small_default.sources.avif)}
                <source srcset="{$product.cover.bySize.small_default.sources.avif}" type="image/avif">{/if}
                {if !empty($product.cover.bySize.small_default.sources.webp)}
                <source srcset="{$product.cover.bySize.small_default.sources.webp}" type="image/webp">{/if}
                <img src="{$product.cover.bySize.small_default.url}"
                  alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                  loading="lazy" data-full-size-image-url="{$product.cover.large.url}" />
              </picture>
            </a>
          </div>
        {/block}
        
        {* Product content *}
        <div class="content">
          {* Brand name *}
          {if $product.manufacturer_name}
            <div class="product-brand">
              {$product.manufacturer_name}
            </div>
          {/if}
          
          {* Product name *}
          {block name='product_name'}
            <h3 class="h3 product-title">
              <a href="{$product.url}" content="{$product.url}">{$productName nofilter}</a>
            </h3>
          {/block}
          
          {* Include du template des variantes *}
          {* <div class="product-subtitle">
            {include file='catalog/_partials/miniatures/product-variants.tpl' product=$product}
          </div> *}
          
          {* Product reviews *}
          {block name='product_reviews'}
            <div class="product-reviews">
              <div class="stars">
                {for $i=1 to 5}
                  {if $i <= 4}
                    <i class="bi bi-star-fill"></i>
                  {elseif $i == 5}
                    <i class="bi bi-star-half"></i>
                  {else}
                    <i class="bi bi-star"></i>
                  {/if}
                {/for}
              </div>
              <span class="review-count">585 avis</span>
            </div>
          {/block}
          
          {* Product price *}
          {block name='product_price_and_shipping'}
            {if $product.show_price}
              <div class="product-price">
                <span class="price">{$product.price}</span>
                
                {if $product.has_discount}
                  <span class="regular-price">{$product.regular_price}</span>
                {/if}
              </div>
            {/if}
          {/block}
        </div>
      </div>
    </article>
  </div>
{/block}
