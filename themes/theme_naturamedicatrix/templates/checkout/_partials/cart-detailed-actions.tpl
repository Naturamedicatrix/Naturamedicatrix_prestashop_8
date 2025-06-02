{**
CUSTOM ACTIONS CART
*}
 {block name='cart_detailed_actions'}
    <div class="checkout cart-detailed-actions js-cart-detailed-actions card-block pb-8">
      {if $cart.minimalPurchaseRequired}
        <div class="alert alert-warning" role="alert">
          {$cart.minimalPurchaseRequired}
        </div>
        <div class="text-sm-center">
          <button type="button" class="btn btn-primary disabled" disabled>{l s='Proceed to checkout' d='Shop.Theme.Actions'}</button>
        </div>
      {elseif empty($cart.products) }
        <div class="text-sm-center">
          <button type="button" class="btn btn-primary disabled" disabled>{l s='Proceed to checkout' d='Shop.Theme.Actions'}</button>
        </div>
      {else}
        <div class="text-sm-center">
          <a href="{$urls.pages.order}" class="btn btn-primary">{l s='Proceed to checkout' d='Shop.Theme.Actions'}</a>
          {hook h='displayExpressCheckout'}
        </div>
      {/if}
    </div>

    <div class="continue-shopping">
      <hr />
      <p class="text-center py-4 font-bold">Ou</p>
      <a href="{$urls.pages.index}" class="btn btn-outline">{l s='Continue shopping' d='Shop.Theme.Actions'}</a>
    </div>
    
  {/block}
  