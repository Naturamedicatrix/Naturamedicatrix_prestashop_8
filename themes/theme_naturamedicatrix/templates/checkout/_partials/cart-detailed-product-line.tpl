{**
CUSTOM PRODUCTS DETAILS CART
*}
 
<div class="product-line-grid flex items-center justify-between w-full gap-4 md:gap-6 py-4 border-b">
  <!--  product line left content: image-->
  <div class="product-line-grid-left w-20 h-20 flex-shrink-0">
    <span class="product-image media-middle">
      {if $product.default_image}
        <picture>
          {if !empty($product.default_image.bySize.cart_default.sources.avif)}<source srcset="{$product.default_image.bySize.cart_default.sources.avif}" type="image/avif">{/if}
          {if !empty($product.default_image.bySize.cart_default.sources.webp)}<source srcset="{$product.default_image.bySize.cart_default.sources.webp}" type="image/webp">{/if}
          <img src="{$product.default_image.bySize.cart_default.url}" alt="{$product.name|escape:'quotes'}" loading="lazy">
        </picture>
      {else}
        <picture>
          {if !empty($urls.no_picture_image.bySize.cart_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.cart_default.sources.avif}" type="image/avif">{/if}
          {if !empty($urls.no_picture_image.bySize.cart_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.cart_default.sources.webp}" type="image/webp">{/if}
          <img src="{$urls.no_picture_image.bySize.cart_default.url}" loading="lazy" />
        </picture>
      {/if}
    </span>
  </div>

  <!--  product line body: label, discounts, price, attributes, customizations -->
  <div class="product-line-grid-body flex flex-col justify-center flex-1 min-w-[200px]">
    <div class="product-line-info pb-0.5 color-title">
      <a href="{$product.url}" data-id_customization="{$product.id_customization|intval}">{$product.name}</a>
    </div>

    {foreach from=$product.attributes key="attribute" item="value"}
      <div class="product-line-info text-gray-500 text-xs {$attribute|lower}">
        <span class="labelle">{$attribute}:</span>
        <span class="value">{$value}</span>
      </div>
    {/foreach}

    {if is_array($product.customizations) && $product.customizations|count}
      <br>
      {block name='cart_detailed_product_line_customization'}
        {foreach from=$product.customizations item="customization"}
          <a href="#" data-toggle="modal" data-target="#product-customizations-modal-{$customization.id_customization}">{l s='Product customization' d='Shop.Theme.Catalog'}</a>
          <div class="modal fade customization-modal js-customization-modal" id="product-customizations-modal-{$customization.id_customization}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="{l s='Close' d='Shop.Theme.Global'}">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">{l s='Product customization' d='Shop.Theme.Catalog'}</h4>
                </div>
                <div class="modal-body">
                  {foreach from=$customization.fields item="field"}
                    <div class="product-customization-line row">
                      <div class="col-sm-3 col-xs-4 label">
                        {$field.label}
                      </div>
                      <div class="col-sm-9 col-xs-8 value">
                        {if $field.type == 'text'}
                          {if (int)$field.id_module}
                            {$field.text nofilter}
                          {else}
                            {$field.text}
                          {/if}
                        {elseif $field.type == 'image'}
                          <img src="{$field.image.small.url}" loading="lazy">
                        {/if}
                      </div>
                    </div>
                  {/foreach}
                </div>
              </div>
            </div>
          </div>
        {/foreach}
      {/block}
    {/if}
  </div>
  
  <div class="mobile-cart-actions">
  <div class="qty w-20 flex items-center justify-center">
      {if !empty($product.is_gift)}
        <span class="gift-quantity">{$product.quantity}</span>
      {else}
        <input
          class="js-cart-line-product-quantity w-full border text-center rounded"
          data-down-url="{$product.down_quantity_url}"
          data-up-url="{$product.up_quantity_url}"
          data-update-url="{$product.update_quantity_url}"
          data-product-id="{$product.id_product}"
          type="number"
          inputmode="numeric"
          pattern="[0-9]*"
          value="{$product.quantity}"
          name="product-quantity-spin"
          aria-label="{l s='%productName% product quantity field' sprintf=['%productName%' => $product.name] d='Shop.Theme.Checkout'}"
        />
      {/if}
    </div>
  
 

  <!--  product line right content: actions (quantity, delete), price -->
  <div class="product-line-grid-right product-line-actions price flex flex-col items-start md:items-end text-right leading-tight w-36">
      
      {if $product.has_discount}
        <div class="product-discount">
          {if $product.discount_type === 'percentage'}
            <span class="discount discount-percentage">
              -{$product.discount_percentage_absolute}
            </span>
          {else}
            <span class="discount discount-amount">
              -{$product.discount_to_display}
            </span>
          {/if}
        </div>
      {/if}
      
      <span class="product-price font-semibold text-base color-title">
        <span class="text-2xl md:text-base">
          {if !empty($product.is_gift)}
            <span class="gift">{l s='Gift' d='Shop.Theme.Checkout'}</span>
          {else}
            {$product.total}
          {/if}
        </span>
      </span>
            
      <div class="product-line-info product-price text-center {if $product.has_discount}has-discount{/if}">
        
        <div class="current-price text-xs text-gray-500">
          <span class="text-sm md:text-xs">A l'unité&nbsp;:</span>
          {if $product.has_discount}
            <span class="regular-price line-through">{$product.regular_price}</span>
          {/if}
          <span class="price font-bold text-right">{$product.price}</span>
          {if $product.unit_price_full}
            <div class="unit-price-cart">{$product.unit_price_full}</div>
          {/if}
        </div>
        {hook h='displayProductPriceBlock' product=$product type="unit_price"}
      </div> <!-- end .product-line-info -->

  
  </div> <!-- end .product-line-grid-right -->
  
  
    <div class="cart-line-product-actions pl-0 md:pl-0 text-gray-500 w-11 text-right">
      <a
          class                       = "remove-from-cart"
          rel                         = "nofollow"
          href                        = "{$product.remove_from_cart_url}"
          data-link-action            = "delete-from-cart"
          data-id-product             = "{$product.id_product|escape:'javascript'}"
          data-id-product-attribute   = "{$product.id_product_attribute|escape:'javascript'}"
          data-id-customization       = "{$product.id_customization|default|escape:'javascript'}"
      >
        {if empty($product.is_gift)}
  
          <i class="bi bi-trash3 icon-special text-lg md:text-base"></i>
          
          
        {/if}
      </a>
  
      {block name='hook_cart_extra_product_actions'}
        {hook h='displayCartExtraProductActions' product=$product}
      {/block}
  
    </div> <!-- end .cart-line-product-actions -->
  </div>

</div> <!-- end .product-line-grid -->
