{**
* PRODUCT BESTSELLER - Template spécifique pour les produits "Deal of the day"
*}

{* VARIABLES *}
{assign var=productName value=$product.name|escape:'html':'UTF-8'}
{assign var=productName value=$productName|replace:'(':'<span class="small">('}
{assign var=productName value=$productName|replace:')':')</span>'}
{* END VARIABLES *}

{block name='product_miniature_item'}
  <div class="js-product product col-xs-12 col-sm-12 col-lg-4 col-xl-4">
    <article class="product-miniature product-miniature-light js-product-miniature" data-id-product="{$product.id_product}"
      data-id-product-attribute="{$product.id_product_attribute}">
      
      <div class="container">
        {* Product flags - n'affiche que les réductions *}
        <div class="product-flags">
          <ul class="product-flags js-product-flags">
            {foreach from=$product.flags item=flag}
              {if $flag.type == 'discount' || $flag.type == 'on-sale' || $flag.type == 'price-drop'}
                <li class="product-flag {$flag.type}">{$flag.label}</li>
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
                  loading="lazy" data-full-size-image-url="{$product.cover.large.url}"
                  width="{$product.cover.bySize.small_default.width}" height="{$product.cover.bySize.small_default.height}" />
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
          
          {* Product subtitle - using feature id 3 (quantity) *}
          {if isset($product.features) && $product.features}
            <div class="product-subtitle">
              {foreach from=$product.features item=feature}
                {if isset($feature.value) && $feature.value|trim != '' && $feature.id_feature == 3}
                  {$feature.value|escape:'html':'UTF-8'}
                {/if}
              {/foreach}
            </div>
          {/if}
          
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
