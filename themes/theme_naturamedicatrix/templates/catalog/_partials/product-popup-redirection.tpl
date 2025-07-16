{assign var="productPopupName" value=Product::getProductName({$product->product_popup_redirection})}
{assign var="productPopupImage" value=Product::getCover({$product->product_popup_redirection})}
{assign var="productPopupPrice" value=Product::getPriceStatic($product->product_popup_redirection, true, null, 2)}
{assign var="productPopupPriceWithout" value=Product::getPriceStatic($product->product_popup_redirection, true, null, 2, null, false, false)}




<div x-data="{ open: true }" x-show="open" @click.away="open = false" x-transition.opacity x-transition.scale.origin.center class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl" @click.away="open = false">
    <div class="relative p-6 text-center">
      <button @click="open = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <h2 class="text-lg font-bold underline mb-4 mt-0">{l s='Substitute product' d='Shop.Theme.Catalog'}</h2>
      <div class="grid grid-cols-2 gap-6">
        <div class="text-center">
          <img src="{$product.cover.bySize.small_default.url}" alt="{$product.name}" class="mx-auto h-30 object-contain mb-2.5">
          <h3 class="font-semibold text-lg text-gray-900 leading-tight mb-1.5 mt-0">{$productName nofilter}</h3>
          <p class="text-gray-600 text-xs mb-1.5">500 ml</p>
          <p class="text-red-600 text-xs mb-1.5">● {$product.availability_message}</p>
          <p class="text-sm mb-0"><span class="text-gray-900 font-semibold text-sm">{$productPriceWithoutReduction|string_format:"%.2f"|replace:'.':','}€</span></p>
        </div>
        <div class="text-center">
          <img src="{$link->getImageLink($product.link_rewrite, $productPopupImage.id_image, 'small_default')}" alt="{$productPopupName}" class="mx-auto h-30 object-contain mb-2.5">
          <h3 class="font-semibold text-lg text-gray-900 leading-tight mb-1.5 mt-0">{$productPopupName}</h3>
          <p class="text-gray-600 text-xs mb-1.5">60 gélules</p>
          <p class="text-green-600 text-xs mb-1.5">● {l s='In stock' d='Shop.Theme.Catalog'}</p>          
          <p class="text-sm mb-0">{if $productPopupPriceWithout > $productPopupPrice}<span class="text-gray-400 line-through text-xs leading-snug mr-1.5">{$productPopupPriceWithout|string_format:"%.2f"|replace:'.':','}€</span> {/if}<span class="text-gray-900 font-semibold text-sm leading-snug">{$productPopupPrice|string_format:"%.2f"|replace:'.':','}€</span></p>
        </div>
      </div>
    </div>
    <div class="bg-gray-100 px-6 py-3.5 flex justify-end space-x-3 rounded-b-xl">
      <button @click="open = false" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">{l s='Ignore' d='Shop.Theme.Catalog'}</button>
      <a href="{$link->getProductLink($product->product_popup_redirection)}" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2.5 px-12 rounded-lg transition-colors duration-200 leading-normal">{l s='See this product' d='Shop.Theme.Catalog'}</a>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
