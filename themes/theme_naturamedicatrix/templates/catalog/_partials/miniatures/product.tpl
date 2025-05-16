{**
* PRODUCT
 *}

{* VARIABLES *}
{assign var=productName value=$product.name|escape:'html':'UTF-8'}
{assign var=productName value=$productName|replace:'(':'<span class="small">('}
{assign var=productName value=$productName|replace:')':')</span>'}
{* END VARIABLES *}


{block name='product_miniature_item'}
  <div class="js-product product{if !empty($productClasses)} {$productClasses}{/if}">
    <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}"
      data-id-product-attribute="{$product.id_product_attribute}">
      <div class="thumbnail-container">

        {* Caractéristiques du produit *}
        <div class="product-features-overlay mb-4">
          {if isset($product.features) && $product.features}
            <div class="product-features-list product-flags">
              {foreach from=$product.features item=feature}
                {* N'affiche pas la caractéristique "quantité" id=3 *}
                {if isset($feature.value) && $feature.value|trim != '' && $feature.id_feature != 3}
                  <span class="product-feature-item product-flag">{$feature.value|escape:'html':'UTF-8'}</span>
                {/if}
              {/foreach}
            </div>
          {/if}
        </div>
        {*END Caractéristiques du produit *}

        <div class="thumbnail-top">
          {block name='product_thumbnail'}
            {if $product.cover}
              <a href="{$product.url}" class="thumbnail product-thumbnail">
                <picture>
                  {if !empty($product.cover.bySize.home_default.sources.avif)}
                  <source srcset="{$product.cover.bySize.home_default.sources.avif}" type="image/avif">{/if}
                  {if !empty($product.cover.bySize.home_default.sources.webp)}
                  <source srcset="{$product.cover.bySize.home_default.sources.webp}" type="image/webp">{/if}
                  <img src="{$product.cover.bySize.home_default.url}"
                    alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                    loading="lazy" data-full-size-image-url="{$product.cover.large.url}"
                    width="{$product.cover.bySize.home_default.width}" height="{$product.cover.bySize.home_default.height}" />
                </picture>
              </a>
            {else}
              <a href="{$product.url}" class="thumbnail product-thumbnail">
                <picture>
                  {if !empty($urls.no_picture_image.bySize.home_default.sources.avif)}
                  <source srcset="{$urls.no_picture_image.bySize.home_default.sources.avif}" type="image/avif">{/if}
                  {if !empty($urls.no_picture_image.bySize.home_default.sources.webp)}
                  <source srcset="{$urls.no_picture_image.bySize.home_default.sources.webp}" type="image/webp">{/if}
                  <img src="{$urls.no_picture_image.bySize.home_default.url}" loading="lazy"
                    width="{$urls.no_picture_image.bySize.home_default.width}"
                    height="{$urls.no_picture_image.bySize.home_default.height}" />
                </picture>
              </a>
            {/if}
          {/block}

          {* <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
           {block name='quick_view'}
             <a class="quick-view js-quick-view" href="#" data-link-action="quickview">
               <i class="material-icons search">&#xE8B6;</i> {l s='Quick view' d='Shop.Theme.Actions'}
             </a>
           {/block}

           {block name='product_variants'}
             {if $product.main_variants}
               {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
             {/if}
           {/block}
         </div> *}
        </div>

        <div class="product-description">
          {block name='product_name'}
            {if $page.page_name == 'index'}
              <h3 class="h3 product-title"><a href="{$product.url}" content="{$product.url}">{$productName nofilter}</a></h3>
            {else}
              <h2 class="h3 product-title"><a href="{$product.url}" content="{$product.url}"> {$productName nofilter}</a></h2>
            {/if}
          {/block}


          {* Vérifie si le produit a des variants *}
          {assign var='has_variants' value=false}
          {assign var='combinations' value=Product::getProductAttributesIds($product.id_product)}
          {if $combinations && count($combinations) > 0}
            {assign var='has_variants' value=true}
          {/if}

          {* AFFICHE SOIT LES VARIANTS, SOIT LA CARACTÉRISTIQUE QUANTITÉ *}
          {if $has_variants}
            {* BLOC DES VARIANTS *}
            {block name='product_variants_complete'}
              {include file='catalog/_partials/miniatures/product-variants.tpl' product=$product}
            {/block}
            {* END BLOC DES VARIANTS *}
          {else}
            {* BLOC CARACTÉRISTIQUE QUANTITÉ (ID 3) *}
            {if isset($product.features) && $product.features}
              <div class="product-quantity-info text-center">
                {foreach from=$product.features item=feature}
                  {* N'affiche QUE la caractéristique "quantité" id=3 *}
                  {if isset($feature.value) && $feature.value|trim != '' && $feature.id_feature == 3}
                    {$feature.value|escape:'html':'UTF-8'}
                  {/if}
                {/foreach}
              </div>
            {/if}
            {* END BLOC CARACTÉRISTIQUE QUANTITÉ *}
          {/if}


          {block name='product_reviews'}
            {* {hook h='displayProductListReviews' product=$product} *}
            <div class="review-product">
              <div class="review-score text-center text-xs">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
                <span class="review-stats">238 avis</span>
              </div>
            </div>
          {/block}


        <div class="block-product-flags">
          {* Product flags *}
          <div class="product-flags-container">
            {include file='catalog/_partials/product-flags.tpl'}
          </div>

          {* Price and cart container *}
          <div class="price-and-cart-container">
            {block name='product_price_and_shipping'}
              {if $product.show_price}
                <div class="product-price-and-shipping">


                  {hook h='displayProductPriceBlock' product=$product type="before_price"}

                  <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">
                    {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
                    {if '' !== $smarty.capture.custom_price}
                      {$smarty.capture.custom_price nofilter}
                    {else}
                      {$product.price}
                    {/if}
                  </span>

                  {if $product.has_discount}
                    {hook h='displayProductPriceBlock' product=$product type="old_price"}

                    <span class="regular-price"
                      aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}">{$product.regular_price}</span>
                    {if $product.discount_type === 'percentage'}
                      <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
                    {elseif $product.discount_type === 'amount'}
                      <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
                    {/if}
                  {/if}

                  {hook h='displayProductPriceBlock' product=$product type='unit_price'}
                  {hook h='displayProductPriceBlock' product=$product type='weight'}
                </div>
              {/if}
            {/block}

          
            {* ADD TO CART BUTTON *}
            <form action="{$product.add_to_cart_url}" method="post" class="add-to-cart-or-refresh">
              <input type="hidden" name="token" value="{$static_token}">
              <input type="hidden" name="id_product" value="{$product.id_product}">
              <input type="hidden" name="id_customization" value="0">
              <input type="hidden" name="qty" value="1">
              {if $product.add_to_cart_url && !$product.has_attributes}
                <button class="add-to-cart" data-button-action="add-to-cart" type="submit">
                  <i class="bi bi-handbag"></i>
                </button>
              {else}
                <a href="{$product.url}" class="add-to-cart">
                  <i class="bi bi-search"></i>
                </a>
              {/if}
            </form>
            {* END ADD TO CART BUTTON *}

          </div>
        </div>

        </div>
      </div>
    </article>
  </div>
{/block}