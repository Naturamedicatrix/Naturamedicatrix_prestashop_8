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
    {* Affichage des caractéristiques du produit (SQL) *}
    {assign var="id_product" value=$product.id_product}
    {assign var="id_lang" value=Context::getContext()->language->id}
    
    {* Requête SQL directe pour récupérer les caractéristiques du produit *}
    {assign var="features_query" value="SELECT 
      f.id_feature, 
      fl.name as feature_name, 
      fv.id_feature_value, 
      fvl.value
      FROM {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}feature_product fp
      LEFT JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}feature f ON (f.id_feature = fp.id_feature)
      LEFT JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}feature_lang fl ON (fl.id_feature = f.id_feature AND fl.id_lang = {$id_lang})
      LEFT JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}feature_value fv ON (fv.id_feature_value = fp.id_feature_value)
      LEFT JOIN {if isset($smarty.const._DB_PREFIX_)}{$smarty.const._DB_PREFIX_}{else}ps_{/if}feature_value_lang fvl ON (fvl.id_feature_value = fv.id_feature_value AND fvl.id_lang = {$id_lang})
      WHERE fp.id_product = {$id_product}
      ORDER BY f.position ASC"}
    
    {* Exécute la requête avec getInstance *}
    {assign var="features_result" value=Db::getInstance()->executeS($features_query)}
    
    {* Affichage des caractéristiques si présentes *}
    {if $features_result && count($features_result) > 0}
      <div class="product-features">
        <div class="product-line-info flex text-gray-500 text-xs label-features">
          {foreach from=$features_result item=feature name=features_loop}
            {if isset($feature.value) && $feature.value|trim != ''}
              <span class="product-feature-item product-flag">{$feature.value|escape:'html':'UTF-8'}</span>
              {if !$smarty.foreach.features_loop.last}{/if}
            {/if}
          {/foreach}
        </div>
      </div>
    {/if}
    
    <div class="product-line-info pb-0.5 color-title">
      <a href="{$product.url}" data-id_customization="{$product.id_customization|intval}">{$product.name}</a>
    </div>

    <div class="products-lines-infos">
      {* Affichage du statut de stock *}
      <div class="product-line-info text-xs">
      {* Vérifier si la variable quantity_available existe, sinon utiliser stock_quantity ou available_now comme fallback *}
      {if isset($product.quantity_available)}
        {assign var="stockQuantity" value=$product.quantity_available}
      {elseif isset($product.stock_quantity)}
        {assign var="stockQuantity" value=$product.stock_quantity}
      {elseif isset($product.available_now) && $product.available_now == ''}
        {assign var="stockQuantity" value=0}
      {else}
        {assign var="stockQuantity" value=1}
      {/if}

      {if $stockQuantity > 0}
        <span class="value font-semibold text-green-600">En stock</span>
      {else}
        <span class="value font-semibold text-red-600">Rupture de stock</span>
      {/if}
      </div>
      {* DLU - avec format de date personnalisé *}
      {if isset($product.dlu) && $product.dlu}
        <div class="product-line-info text-gray-500 text-xs">
          <span class="labelle">Date limite conseillée:</span>
          <span class="value font-semibold">
              {* Formate la date en DD-MM-YYYY *}
              {assign var="dluDate" value=$product.dlu|strtotime}
              {$dluDate|date_format:"%d-%m-%Y"}
          </span>
        </div>
      {/if} 
    </div>

    {foreach from=$product.attributes key="attribute" item="value"}
      <div class="product-line-info text-gray-500 text-sm label-attributes {$attribute|lower}">
        <span class="labelle">{$attribute}:</span>
        <span class="value">{$value}</span>
      </div>
    {/foreach}
    
    {* Les caractéristiques sont maintenant affichées au-dessus du titre du produit *}

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
