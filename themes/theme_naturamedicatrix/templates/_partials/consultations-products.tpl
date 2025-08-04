{assign var=product1 value="24"}
{assign var=product2 value="23"}
{assign var=product3 value="22"}

{assign var="productData1" value=Product::getProductData($product1, 1)}
{assign var="productPrice1" value=Product::getPriceStatic($product1, true, null, 2)}
{assign var="productRewrite1" value=Product::getUrlRewriteInformations({$product1})}

{assign var="productData2" value=Product::getProductData($product2, 1)}
{assign var="productPrice2" value=Product::getPriceStatic($product2, true, null, 2)}
{assign var="productRewrite2" value=Product::getUrlRewriteInformations({$product2})}

{assign var="productData3" value=Product::getProductData($product3, 1)}
{assign var="productPrice3" value=Product::getPriceStatic($product3, true, null, 2)}
{assign var="productRewrite3" value=Product::getUrlRewriteInformations({$product3})}


<div class="md:max-w-7xl mx-auto mt-2" id="consultations-products">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    <!-- Produit 1 -->
    <div class="rounded-xl border border-gray-200 overflow-hidden">
      <img src="{$link->getImageLink($productRewrite1.0.link_rewrite, $productData1.id_image, 'small_default')}" alt="{$productData1.name}" class="mx-auto rounded-full object-cover mt-1">
      <div class="p-5 text-center space-y-3">
        <h3 class="text-base font-semibold text-gray-600 mt-0">{$productData1.name}</h3>
        <div class="text-lg font-bold text-gray-900">{$productPrice1|number_format:2:',':'.'} €</div>
        <form action="{$link->getPageLink('cart', true)}" method="post" class="add-to-cart-or-refresh">
          <input type="hidden" name="add" value="1">
          <input type="hidden" name="id_product" value="{$product1}">
          <input type="hidden" name="token" value="{$static_token}">
          <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors mx-auto add-to-cart" data-button-action="add-to-cart">
            <i class="bi bi-handbag text-lg"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Produit 2 -->
    <div class="rounded-xl border border-gray-200 overflow-hidden">
      <img src="{$link->getImageLink($productRewrite2.0.link_rewrite, $productData2.id_image, 'small_default')}" alt="{$productData2.name}" class="mx-auto rounded-full object-cover mt-1">
      <div class="p-5 text-center space-y-3">
        <h3 class="text-base font-semibold text-gray-600 mt-0">{$productData2.name}</h3>
        <div class="text-lg font-bold text-gray-900">{$productPrice2|number_format:2:',':'.'} €</div>
        <form action="{$link->getPageLink('cart', true)}" method="post">
          <input type="hidden" name="add" value="1">
          <input type="hidden" name="id_product" value="{$product2}">
          <input type="hidden" name="token" value="{$static_token}">
          <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors mx-auto add-to-cart" data-button-action="add-to-cart">
            <i class="bi bi-handbag text-lg"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Produit 3 -->
    <div class="rounded-xl border border-gray-200 overflow-hidden">
      <img src="{$link->getImageLink($productRewrite3.0.link_rewrite, $productData3.id_image, 'small_default')}" alt="{$productData3.name}" class="mx-auto rounded-full object-cover mt-1">
      <div class="p-5 text-center space-y-3">
        <h3 class="text-base font-semibold text-gray-600 mt-0">{$productData3.name}</h3>
        <div class="text-lg font-bold text-gray-900">{$productPrice3|number_format:2:',':'.'} €</div>
        <form action="{$link->getPageLink('cart', true)}" method="post">
          <input type="hidden" name="add" value="1">
          <input type="hidden" name="id_product" value="{$product3}">
          <input type="hidden" name="token" value="{$static_token}">
          <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white rounded-full w-10 h-10 flex items-center justify-center transition-colors mx-auto add-to-cart" data-button-action="add-to-cart">
            <i class="bi bi-handbag text-lg"></i>
          </button>
        </form>
      </div>
    </div>

  </div>
</div>

<style>
  #consultations-products button {
    background: rgba(17,24,39, 1);
  }  
</style>

