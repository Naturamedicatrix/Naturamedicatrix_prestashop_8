{**
 * CUSTOM SHOPPING CART WITH HOVER MODAL
 *}

<div id="blockcart-wrapper">
  <div class="blockcart cart-preview" data-refresh-url="{$refresh_url}">
    <!-- Container pour le hover -->
    <div class="user-hover-group">
      <a href="{$cart_url}" class="relative flex items-center text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out">
        <i class="bi bi-handbag text-2xl leading-0"></i>
        {if $cart.products_count > 0}
          <span class="cart-count absolute -top-1 -right-1 text-xs bg-pink-600 text-white rounded-full flex items-center justify-center leading-none font-semibold">
            {$cart.products_count}
          </span>
        {/if}
      </a>
      
      <!-- Modal hover du panier -->
      <div class="user-hover-modal cart-modal">

          {if $cart.products_count > 0}
            <!-- Liste des produits -->
            <div class="cart-products p-4">
              {foreach from=$cart.products item=product}
                <div class="cart-product-item">
                  <div class="product-image">
                    {if $product.cover}
                      <img src="{$product.cover.bySize.small_default.url}" alt="{$product.name}" class="product-thumbnail">
                    {else}
                      <div class="no-image">
                        <i class="bi bi-image"></i>
                      </div>
                    {/if}
                  </div>
                  <div class="product-details">
                    <div class="flex justify-between items-start">
                      <a href="{$product.url}" class="product-name-link">
                        <div class="product-name">{$product.name}</div>
                      </a>
                      <a class="remove-product remove-from-cart" 
                         rel="nofollow" 
                         href="{$product.remove_from_cart_url}"
                         data-link-action="delete-from-cart"
                         data-id-product="{$product.id_product|escape:'javascript'}"
                         data-id-product-attribute="{$product.id_product_attribute|escape:'javascript'}"
                         data-id-customization="{$product.id_customization|default|escape:'javascript'}"
                         title="{l s='Remove' d='Shop.Theme.Actions'}">
                        <i class="bi bi-trash3"></i>
                      </a>
                    </div>    
                    <div class="product-meta">
                      <span class="quantity">x{$product.quantity}</span>
                      <div class="price-actions">
                        <span class="price">{$product.price}</span>
                      </div>
                    </div>
                  </div>
                </div>
              {/foreach}
            </div>
            
            <!-- Résumé du panier -->
            <div class="cart-summary bg-gray-50 w-full mt-0 mb-0 py-5 px-6">              
              <!-- Sous-total des articles -->
              <div class="cart-subtotal">
                {if $cart.products_count > 1}
                <span class="subtotal-label">{l s='Total de vos %count% articles' sprintf=['%count%' => $cart.products_count] d='Shop.Theme.Checkout'}</span>
                <span class="subtotal-price">{$cart.subtotals.products.value}</span>
                {else}
                <span class="subtotal-label">{l s='Total de votre article' d='Shop.Theme.Checkout'}</span>
                <span class="subtotal-price">{$cart.subtotals.products.value}</span>
                {/if}
              </div>
              
              <!-- Réductions (code promo) -->
              {if isset($cart.subtotals.discounts) && $cart.subtotals.discounts}
              <div class="cart-discount">
                <span class="discount-label">{$cart.subtotals.discounts.label}</span>
                <span class="discount-price">-{$cart.subtotals.discounts.value}</span>
              </div>
              {/if}
              
              <!-- Livraison -->
              {if $cart.subtotals.shipping}
              <div class="cart-shipping">
                <span class="shipping-label">{$cart.subtotals.shipping.label}</span>
                <span class="shipping-price">{$cart.subtotals.shipping.value}</span>
              </div>
              {/if}
              
              <!-- Total TTC -->
              <div class="cart-total">
                <strong class="total-label">{l s='Total TTC' d='Shop.Theme.Checkout'}</strong>
                <strong class="total-price">{$cart.totals.total.value}</strong>
              </div>
              
              <!-- Progression livraison offerte -->
              {include file='_partials/shipping-progress-modal.tpl'}
              
              <!-- Actions -->
              <div class="cart-actions">
                <a href="{$cart_url}" class="btn btn-primary w-full">
                  <i class="bi bi-eye menu-icon leading-0 mr-1.5"></i> {l s='View Cart' d='Shop.Theme.Actions'}
                </a>
                {* <a href="{$urls.pages.order}" class="btn btn-secondary">
                  <i class="bi bi-credit-card menu-icon"></i>{l s='Checkout' d='Shop.Theme.Actions'}
                </a> *}
              </div>
            </div>
          {else}
            <!-- Panier vide -->
            <div class="empty-cart text-center px-8 py-12">
              <div class="empty-cart-icon">
                <i class="bi bi-handbag icon-special text-6xl text-gray-900"></i>
              </div>
              <div class="empty-cart-text">
                {l s='Your shopping cart is empty' d='Shop.Theme.Checkout'}
              </div>
              <a href="{$urls.pages.index}" class="btn btn-primary">
                <i class="bi bi-shop menu-icon leading-0 mr-1.5"></i> {l s='Continue shopping' d='Shop.Theme.Actions'}
              </a>
            </div>
          {/if}
        </div>
    </div>
  </div>
</div>

<script>
// Maintenir le modal panier ouvert après suppression AJAX
document.addEventListener('DOMContentLoaded', function() {
  let modalShouldStayOpen = false;
  
  // Observer les changements dans le conteneur panier
  const observer = new MutationObserver(function(mutations) {
    if (modalShouldStayOpen) {
      const cartHoverGroup = document.querySelector('#blockcart-wrapper .user-hover-group');
      if (cartHoverGroup) {
        cartHoverGroup.classList.add('keep-modal-open');
        setTimeout(function() {
          cartHoverGroup.classList.remove('keep-modal-open');
          modalShouldStayOpen = false;
        }, 2000);
      }
    }
  });
  
  // Observer le conteneur panier pour les changements
  const cartWrapper = document.querySelector('#blockcart-wrapper');
  if (cartWrapper) {
    observer.observe(cartWrapper, { childList: true, subtree: true });
  }
  
  // Détecter les clics sur les boutons de suppression
  document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-from-cart') && e.target.closest('#blockcart-wrapper')) {
      modalShouldStayOpen = true;
    }
  });
});
</script>


