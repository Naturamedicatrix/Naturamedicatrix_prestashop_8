{**
* PRODUCT
 *}

{* VARIABLES *}
{assign var=productName value=$product.name|escape:'html':'UTF-8'}
{assign var=productName value=$productName|replace:'(':'<span class="small">('}
{assign var=productName value=$productName|replace:')':')</span>'}
{* END VARIABLES *}

{block name='product_miniature_item'}
  <div class="product-big js-product product{if !empty($productClasses)} {$productClasses}{/if}">
    <article class="product-miniature js-product-miniature bg-white rounded-lg p-3.5 {if $product.quantity <= 0 || ($product.quantity_all_versions !== null && $product.quantity_all_versions <= 0)}out_stock{/if}" data-id-product="{$product.id_product}"
      data-id-product-attribute="{$product.id_product_attribute}">
      {if $product.quantity <= 0 || ($product.quantity_all_versions !== null && $product.quantity_all_versions <= 0)}
        <span class="out-of-stock-label">{l s='Épuisé' d='Shop.Theme.Catalog'}</span>
      {/if}
      <div class="thumbnail-container w-full bg-gray-50">

        {* Caractéristiques du produit - Certificats uniquement *}
{*
        <div class="product-features-overlay">
          {if isset($product.features) && $product.features}
            <div class="product-features-list product-flags">
              {foreach from=$product.features item=feature}
                {if isset($feature.name) && $feature.name == 'Certificat' && isset($feature.value) && $feature.value|trim != ''}
                  <span class="product-feature-item product-flag">{$feature.value|escape:'html':'UTF-8'}</span>
                {/if}
              {/foreach}
            </div>
          {/if}
        </div>
*}
        {*END Caractéristiques du produit - Certificats *}

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
        </div>
        
        {block name='product_reviews'}
            {* {hook h='displayProductListReviews' product=$product} *}
            
            <div class="yotpo bottomLine review-score text-left text-xs text-center pt-0 mt-0" data-yotpo-product-id="{$product.id_product}"></div>

          {/block}


        <div class="product-description text-center">
          {block name='product_manufacturer'}
            {if isset($product.manufacturer_name) && $product.manufacturer_name}
              <div class="product-manufacturer text-center mt-0">
                <a href="{$link->getManufacturerLink($product.id_manufacturer)}" title="{$product.manufacturer_name|escape:'html':'UTF-8'}" class="text-sm text-gray-400 no-underline">
                  {$product.manufacturer_name}
                </a>
              </div>
            {/if}
          {/block}

          {block name='product_name'}
            {if $page.page_name == 'index'}
              <h3 class="mb-0 text-lg font-normal"><a href="{$product.url}" content="{$product.url}" title="{$product.name}" class="no-underline text-gray-900">{$productName nofilter}</a></h3>
            {else}
              <h2 class="mb-0 text-lg font-normal"><a href="{$product.url}" content="{$product.url}" title="{$product.name}" class="no-underline text-gray-900">{$productName nofilter}</a></h2>
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
              <div class="product-quantity-info text-center text-sm text-gray-600">
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
          
          <div class="product-description mt-1.5 mb-1.5">
            {if $product.description_short}
              {$product.description_short|truncate:150:"..." nofilter}
            {/if}
          </div>

          

        <div class="block-product-flags mt-0">
          {* Product flags *}
          <div class="product-flags-container">
            {include file='catalog/_partials/product-flags.tpl'}
          </div>


          {* Price and cart container *}
          <div class="price-and-cart-container text-center">
            {block name='product_price_and_shipping'}
              {if $product.show_price}
                <div class="product-price-and-shipping text-center font-normal mb-0">


                  {hook h='displayProductPriceBlock' product=$product type="before_price"}

                  <span class="price font-bold text-gray-900 text-xl" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">
                    {capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
                    {if '' !== $smarty.capture.custom_price}
                      {$smarty.capture.custom_price nofilter}
                    {else}
                      {$product.price}
                    {/if}
                  </span>

                  {if $product.has_discount}
                    {hook h='displayProductPriceBlock' product=$product type="old_price"}

                    <span class="regular-price font-normal text-normal text-gray-600 leading-none"
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
            <form action="{$product.add_to_cart_url}" method="post" class="add-to-cart-or-refresh mt-1.5">
              <input type="hidden" name="token" value="{$static_token}">
              <input type="hidden" name="id_product" value="{$product.id_product}">
              <input type="hidden" name="id_customization" value="0">
              <input type="hidden" name="qty" value="1">
              {if $product.add_to_cart_url && !$product.has_attributes}
                <button data-button-action="add-to-cart" type="submit" class="add-to-cart bg-gray-900 hover:bg-gray-700 text-white text-sm btn btn-primary rounded-full transition">
                  <i class="bi bi-handbag"></i> {l s='Add to cart' d='Shop.Theme.Actions'}
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