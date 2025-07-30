{**
 * CUSTOM SHOPPING CART
 *}

<div id="blockcart-wrapper">
  <div class="blockcart cart-preview" data-refresh-url="{$refresh_url}">
    <div class="shopping-cart-container">
      <a href="{$cart_url}" class="relative flex items-center text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out">
        <i class="bi bi-handbag text-2xl leading-0"></i>
        {if $cart.products_count > 0}
          <span class="cart-count absolute -top-1 -right-1 text-xs bg-pink-600 text-white rounded-full flex items-center justify-center leading-none font-semibold">
            {$cart.products_count}
          </span>
        {/if}
      </a>
    </div>
  </div>
</div>

