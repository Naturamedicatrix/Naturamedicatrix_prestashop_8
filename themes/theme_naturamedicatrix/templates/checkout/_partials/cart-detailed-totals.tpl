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
        {* Liste des articles et sous-totaux *}
        {foreach from=$cart.subtotals item="subtotal"}
          {if $subtotal && $subtotal.value|count_characters > 0 && $subtotal.type == 'products'}
            <div class="cart-summary-line" id="cart-subtotal-{$subtotal.type}">
              <span class="label js-subtotal">
                {$cart.summary_string}
              </span>
              <span class="value">
                {$subtotal.value}
              </span>
            </div>
          {/if}
        {/foreach}
        
        {* Affichage individuel de chaque code promo *}
        {if isset($cart.vouchers.added) && $cart.vouchers.added|count > 0}
          {foreach from=$cart.vouchers.added item=voucher}
            <div class="cart-summary-line">
              <span class="label">
                <span class="promo-code">"{$voucher.code}"</span>
              </span>
              <span class="value">{$voucher.reduction_formatted}</span>
              <a href="{$voucher.delete_url}" class="remove-discount-text">(Supprimer)</a>
            </div>
          {/foreach}
        {/if}
        
        {* Autres sous-totaux (livraison, etc.) *}
        {foreach from=$cart.subtotals item="subtotal"}
          {if $subtotal && $subtotal.value|count_characters > 0 && $subtotal.type !== 'tax' && $subtotal.type !== 'discount' && $subtotal.type !== 'products'}
            <div class="cart-summary-line" id="cart-subtotal-{$subtotal.type}">
              <span class="label">
                {$subtotal.label}
              </span>
              <span class="value">
                {$subtotal.value}
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
  
    