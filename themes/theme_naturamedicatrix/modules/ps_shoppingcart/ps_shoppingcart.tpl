{**
 * CUSTOM SHOPPING CART
 *}
<div id="blockcart-wrapper">
  <div class="blockcart cart-preview" data-refresh-url="{$refresh_url}">
    <div class="shopping-cart-container">
      <a rel="nofollow" href="{$cart_url}">
        <div class="cart-icon-container">
         <i class="bi bi-handbag cart-icon-transparent"></i>
          <span class="cart-products-count">{$cart.products_count}</span>
        </div>
      </a>
    </div>
  </div>
</div>
