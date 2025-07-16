<style>

.yotpo-sr-bottom-line-text {
  font-size: .75rem !important;
  font-weight: 500 !important;
  line-height: 1.3 !important;
}

.yotpo-sr-bottom-line-button span {
  height: 16px !important;
}

.yotpo-reviews-star-ratings-widget .star-container {
  width: 12px;
  height: 12px;
} 

#yotpo-reviews-star-ratings-widget {
  margin-bottom: 0 !important;
}  
  
</style>

<div id="productlist-best" class="my-8 p-4 md:p-6" style="background-color: #F9FAFB;">
  <div class="grid gap-4
    {if $bestselles|@count == 1}grid-cols-1
    {elseif $bestselles|@count == 2}grid-cols-1 md:grid-cols-2
    {else}grid-cols-1 md:grid-cols-3{/if}">

    {foreach from=$bestselles item=product name=bsl}
      {assign var=position value=$smarty.foreach.bsl.index+1}

      {if $position == 1}
        {assign var=medalIcon value='bi-award-fill'}
        {assign var=medalColor value='text-yellow-400'}
      {elseif $position == 2}
        {assign var=medalIcon value='bi-award-fill'}
        {assign var=medalColor value='text-gray-400'}
      {elseif $position == 3}
        {assign var=medalIcon value='bi-award-fill'}
        {assign var=medalColor value='text-yellow-800'} {* bronze visible *}
      {/if}
      
      
      {assign var='cover' value=Product::getCover($product.id_product)}
      
      <div class="relative flex items-center p-4 bg-white border border-gray-200 rounded-2xl">
        
        <div class="absolute left-2 top-2 -translate-y-1/2 text-2xl {$medalColor}">
          <i class="bi {$medalIcon}"></i>
        </div>

        <div class="w-24 flex-shrink-0 ml-0">
          <a href="{$link->getProductLink($product.id_product)}">
            {if isset($product.id_image) && ($product.id_image)}
            <img 
              src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'small_default')}" 
              alt="{$product.name}" 
              class="object-contain w-full h-auto"
            >
            {else}
            <img 
              src="{$link->getImageLink($product.link_rewrite, $cover.id_image, 'small_default')}" 
              alt="{$product.name}" 
              class="object-contain w-full h-auto"
            >
            {/if}
          </a>
        </div>

        
        <div class="ml-4 flex flex-col justify-between flex-grow">
          <div class="text-xs" style="color: #93A7C3;">
            {$product.manufacturer_name|escape:'html':'UTF-8'}
          </div>
          <a href="{$link->getProductLink($product.id_product)}" class="font-semibold text-base text-gray-800 hover:text-primary transition leading-tight mb-0.5">
            {$product.name|escape:'html':'UTF-8'}
          </a>

          <div class="yotpo bottomLine review-score text-left text-xs pt-0" data-yotpo-product-id="{$product.id_product}"></div>


          <div class="text-lg font-bold text-gray-900 mt-0">
            {Tools::displayPrice($product.price)}
          </div>

        </div>
      </div>
      
      
    {/foreach}
  </div>
</div>