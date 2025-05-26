{**
CUSTOM DETAILS PANIER
*}
 {block name='cart_detailed_totals'}
    <div class="cart-detailed-totals js-cart-detailed-totals">
    <h3>Récapitulatif</h3>
    {block name='cart_voucher'}
      {include file='checkout/_partials/cart-voucher.tpl'}
    {/block}
      <div class="card-block cart-detailed-subtotals js-cart-detailed-subtotals">
        {foreach from=$cart.subtotals item="subtotal"}
          {if $subtotal && $subtotal.value|count_characters > 0 && $subtotal.type !== 'tax'}
            <div class="cart-summary-line" id="cart-subtotal-{$subtotal.type}">
              <span class="label{if 'products' === $subtotal.type} js-subtotal{/if}">
                {if 'products' == $subtotal.type}
                  {$cart.summary_string}
                {else}
                  {$subtotal.label}
                {/if}
              </span>
            
              <span class="value">
                {if 'discount' == $subtotal.type}
                  -&nbsp;{$subtotal.value}
                  {if isset($cart.vouchers.added) && $cart.vouchers.added|count > 0}
                    {foreach from=$cart.vouchers.added item=voucher name=voucherLoop}
                      {if $smarty.foreach.voucherLoop.first}
                        <a href="{$voucher.delete_url}" class="remove-discount-button relative" title="{l s='Remove Promo Code' d='Shop.Theme.Checkout'}">X</a>
                      {/if}
                    {/foreach}
                  {/if}
                {else}
                  {$subtotal.value}
                {/if}
              </span>
              {if $subtotal.type === 'shipping'}
                  <div><small class="value">{hook h='displayCheckoutSubtotalDetails' subtotal=$subtotal}</small></div>
              {/if}
            </div>
          {/if}
        {/foreach}
      </div>
    
      {block name='cart_summary_totals'}
        {include file='checkout/_partials/cart-summary-totals.tpl' cart=$cart}
      {/block}
    </div>
    {/block}
    