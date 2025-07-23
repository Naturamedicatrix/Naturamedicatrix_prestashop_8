{assign var=product1 value="4"}
{assign var=product2 value="10"} 


{assign var="productData1" value=Product::getProductData($product1, 1)}
{assign var="productPrice1" value=Product::getPriceStatic($product1, true, null, 2)}
{assign var="productPriceWithout1" value=Product::getPriceStatic($product1, true, null, 2, null, false, false)}
{assign var="productReduction1" value=(($productPrice1 - $productPriceWithout1)/$productPriceWithout1)*100}
{assign var='productRewrite1' value=Product::getUrlRewriteInformations({$product1})}
{assign var='productQty1' value=Product::getQuantity({$product1})}



{assign var="productData2" value=Product::getProductData($product2, 1)}
{assign var="productPrice2" value=Product::getPriceStatic($product2, true, null, 2)}
{assign var="productPriceWithout2" value=Product::getPriceStatic($product2, true, null, 2, null, false, false)}
{assign var="productReduction2" value=(($productPrice2 - $productPriceWithout2)/$productPriceWithout2)*100}
{assign var='productRewrite2' value=Product::getUrlRewriteInformations({$product2})}
{assign var='productQty2' value=Product::getQuantity({$product2})}


<section class="py-10 product-suggestions">
  <div class="md:max-w-7xl mx-auto">
    <h4 class="text-xl font-bold text-gray-900 text-left mb-1 mt-0">
      Nos bons plans du moment
    </h4>
    
    <div class="grid grid-cols-2 gap-4 md:gap-6">
      
      <!-- Produit 1 -->
      <div class="rounded-xl border border-gray-200 overflow-hidden{if $productQty1 == 0} opacity-50{/if}">
        <div class="bg-gray-100 p-0">
          <img src="{$link->getImageLink($productRewrite1[0].link_rewrite, $productData1.id_image, 'home_default')}" alt="{$productData1.name}" class="mx-auto">
        </div>
        <div class="p-2.5 md:p-4">
          <h3 class="text-base font-semibold text-gray-900 m-0">{$productData1.name}</h3>
          <p class="text-sm text-gray-600 my-0.5 h-16 overflow-hidden">{if isset($productData1.meta_description) && $productData1.meta_description}{$productData1.meta_description}{else}{$productData1.description_short|strip_tags|truncate:150:"..." nofilter}{/if}</p>
          
          {if isset($productData1.dlu) && $productData1.dlu}
            <p class="text-sm text-gray-500 mt-1 font-semibold" style="color:#e45b7f;"><span class="font-semibold hidden md:inline">Date limite d'utilisation conseillée</span><span class="inline md:hidden">DLUC</span>&nbsp;: <span class="font-semibold">{$productData1.dlu|date_format:"%d-%m-%Y"}</span></p>
          {/if}
          
          <div class="mt-4 flex justify-between items-start md:items-end h-16 md:h-12">
            <div class="flex flex-col">
              {if isset($productReduction1) && $productReduction1}
              <div class="product-discount">
                <span class="discount discount-percentage">{$productReduction1}%</span>
              </div>
              {/if}
              <div class="prices">
                {if isset($productReduction1) && ($productReduction1)}<span class="text-gray-500 line-through text-sm mr-0.5">{$productPriceWithout1|number_format:2:',':'.'}€</span>{/if}
                <span class="text-lg font-bold text-gray-900">{$productPrice1|number_format:2:',':'.'}€</span>
              </div>
            </div>
            
            
            {if $productQty1 != 0}
            <form action="{$link->getPageLink('cart', true)}" method="post" class="inline">
              <input type="hidden" name="add" value="1">
              <input type="hidden" name="id_product" value="{$product1}">
              <input type="hidden" name="token" value="{$static_token}">
              <button type="submit" class="bg-gray-900 hover:bg-gray-700 transition-colors text-white rounded-full w-7 h-7 md:w-10 md:h-10 flex items-center justify-center" style="background: #151827;">
                <i class="bi bi-handbag text-xs md:text-lg"></i>
              </button>
            </form>
            {else}
              <span class="out-of-stock-label text-base text-red-600 font-bold">Épuisé</span>
            {/if}
            
          </div>
          
        </div>
      </div>

      <!-- Produit 2 -->
      <div class="rounded-xl border border-gray-200 overflow-hidden{if $productQty2 == 0} opacity-50{/if}">
        <div class="bg-gray-100 p-0">
           <img src="{$link->getImageLink($productRewrite2[0].link_rewrite, $productData2.id_image, 'home_default')}" alt="{$productData2.name}" class="mx-auto">
        </div>
        <div class="p-2.5 md:p-4">
          <h3 class="text-base font-semibold text-gray-900 m-0">{$productData2.name}</h3>
          <p class="text-sm text-gray-600 my-0.5 h-16 overflow-hidden">{if isset($productData2.meta_description) && $productData2.meta_description}{$productData2.meta_description}{else}{$productData2.description_short|strip_tags|truncate:150:"..." nofilter}{/if}</p>
          
          {if isset($productData2.dlu) && $productData2.dlu}<p class="text-sm text-gray-500 mt-1 font-semibold" style="color:#e45b7f;"><span class="font-semibold hidden md:inline">Date limite d'utilisation conseillée</span><span class="inline md:hidden">DLUC</span>&nbsp;: <span class="font-semibold">{$productData2.dlu|date_format:"%d-%m-%Y"}</span></p>{/if}
          
          <div class="mt-4 flex justify-between items-start md:items-end h-16 md:h-12">
           <div class="flex flex-col">
             {if isset($productReduction2) && $productReduction2}
              <div class="product-discount">
                <span class="discount discount-percentage">{$productReduction2}%</span>
              </div>
              {/if}
              <div class="prices">
                {if isset($productReduction2) && ($productReduction2)}<span class="text-gray-500 line-through text-sm mr-0.5">{$productPriceWithout2|number_format:2:',':'.'}€</span>{/if}
                <span class="text-lg font-bold text-gray-900">{$productPrice2|number_format:2:',':'.'}€</span>
                
              </div>
            </div>
            
            {if $productQty2 != 0}
            <form action="{$link->getPageLink('cart', true)}" method="post" class="inline">
              <input type="hidden" name="add" value="1">
              <input type="hidden" name="id_product" value="{$product2}">
              <input type="hidden" name="token" value="{$static_token}">
              <button type="submit" class="bg-gray-900 hover:bg-gray-700 transition-colors text-white rounded-full w-10 h-10 flex items-center justify-center" style="background: #151827;">
                <i class="bi bi-handbag text-xs md:text-lg"></i>
              </button>
            </form>
            {else}
              <span class="out-of-stock-label text-base text-red-600 font-bold">Épuisé</span>
            {/if}
            
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
