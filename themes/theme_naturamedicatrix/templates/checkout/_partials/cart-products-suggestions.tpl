{*
{assign var="productPopupName" value=Product::getProductName({$product->product_popup_redirection})}
{assign var="productPopupImage" value=Product::getCover({$product->product_popup_redirection})}
{assign var="productPopupPrice" value=Product::getPriceStatic($product->product_popup_redirection, true, null, 2)}
{assign var="productPopupPriceWithout" value=Product::getPriceStatic($product->product_popup_redirection, true, null, 2, null, false, false)}
*}




<section class="py-10">
  <div class="max-w-7xl mx-auto">
    <h4 class="text-xl font-bold text-gray-900 text-left mb-1">
      Nos bons plans du moment
    </h4>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
      
      <!-- Produit 1 -->
      <div class="rounded-xl border border-gray-200 overflow-hidden">
        <div class="bg-gray-100 p-4">
          <img src="https://new.naturamedicatrix.fr/32-home_default/affiche-encadree-the-adventure-begins.jpg" alt="Psyllium blond bio" class="mx-auto">
        </div>
        <div class="p-4">
          <h3 class="text-base font-semibold text-gray-900 m-0">Psyllium blond bio</h3>
          <p class="text-sm text-gray-600 my-0.5">Riche en fibres naturelles, certifié bio, sans gluten ni additifs, pour soutenir en douceur un transit intestinal régulier et confortable.</p>
          <p class="text-sm text-gray-500 mt-2 italic">Date limite : 10-04-2027</p>
          
          <div class="mt-4 flex justify-between items-end">
            <div class="flex flex-col">
              <span class="text-gray-500 line-through text-sm">16,90€</span>
              <span class="text-lg font-bold text-gray-900">15€</span>
            </div>
            
            <button class="bg-gray-900 hover:bg-gray-700 transition-colors text-white rounded-full w-10 h-10 flex items-center justify-center">
              <i class="bi bi-handbag text-lg"></i>
            </button>
          </div>
          
        </div>
      </div>

      <!-- Produit 2 -->
      <div class="rounded-xl border border-gray-200 overflow-hidden">
        <div class="bg-gray-100 p-4">
          <img src="https://new.naturamedicatrix.fr/41-home_default/coussin-ours-brun.jpg" alt="Xaventin comprimés" class="mx-auto">
        </div>
        <div class="p-4">
          <h3 class="text-base font-semibold text-gray-900 m-0">Xaventin comprimés</h3>
          <p class="text-sm text-gray-600 my-0.5">Extrait de germes de blé de qualité, pour le maintien de la masse musculaire et source de protéines végétales.</p>
          <p class="text-sm text-gray-500 mt-2 italic">Date limite : 30-08-2025</p>
          
          <div class="mt-4 flex justify-between items-end">
            <div class="flex flex-col">
              <span class="text-gray-500 line-through text-sm">16,90€</span>
              <span class="text-lg font-bold text-gray-900">15€</span>
            </div>
            
            <button class="bg-gray-900 hover:bg-gray-700 transition-colors text-white rounded-full w-10 h-10 flex items-center justify-center">
              <i class="bi bi-handbag text-lg"></i>
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
