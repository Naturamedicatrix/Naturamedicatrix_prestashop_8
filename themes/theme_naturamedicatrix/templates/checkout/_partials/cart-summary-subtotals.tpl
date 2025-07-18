{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<div class="card-block cart-summary-subtotals-container js-cart-summary-subtotals-container">

  {* Liste des articles et sous-totaux *}
  {foreach from=$cart.subtotals item="subtotal"}
    {if $subtotal && $subtotal.value|count_characters > 0 && $subtotal.type == 'products'}
      <div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-{$subtotal.type}">
        <span class="label text-gray-600 font-normal text-base">
          {$subtotal.label}
        </span>
        <span class="text-gray-600 font-semibold text-base value{if 'gratuit' == $subtotal.value} free{/if}">
          {$subtotal.value}
        </span>
      </div>
    {/if}
  {/foreach}
  
  {* Affichage individuel de chaque code promo *}
  {if isset($cart.vouchers.added) && $cart.vouchers.added|count > 0}
    {foreach from=$cart.vouchers.added item=voucher}
      <div class="cart-summary-line cart-summary-subtotals">
        <span class="label text-gray-600 font-normal text-base">
          <span class="promo-code">"{$voucher.code}"</span>
        </span>
        <span class="value text-gray-600 font-semibold text-base">
          {$voucher.reduction_formatted}
        </span>
        <a href="#" data-voucher-url="{$voucher.delete_url}" class="remove-discount-text js-remove-voucher-checkout">(Supprimer)</a>
      </div>
    {/foreach}
  {/if}
  
  {* Autres sous-totaux (livraison, etc.) *}
  {foreach from=$cart.subtotals item="subtotal"}
    {if $subtotal && $subtotal.value|count_characters > 0 && $subtotal.type !== 'tax' && $subtotal.type !== 'discount' && $subtotal.type !== 'products'}
      <div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-{$subtotal.type}">
        <span class="label text-gray-600 font-normal text-base">
          {$subtotal.label}
        </span>
        <span class="text-gray-600 font-semibold text-base value{if 'gratuit' == $subtotal.value} free{/if}">
          {$subtotal.value}
        </span>
      </div>
    {/if}
  {/foreach}

</div>

{block name='javascript_bottom'}
  {literal}
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      document.addEventListener('click', function(event) {
        // Vérifie si l'élément cliqué ou un de ses parents a la classe js-remove-voucher-checkout
        var target = event.target;
        
        while (target != null && !target.classList.contains('js-remove-voucher-checkout')) {
          target = target.parentElement;
        }
        
        if (target && target.classList.contains('js-remove-voucher-checkout')) {
          event.preventDefault();
          
          var voucherUrl = target.getAttribute('data-voucher-url');
          
          // Requete AJAX
          var xhr = new XMLHttpRequest();
          xhr.open('GET', voucherUrl, true);
          
          // Réponse
          xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
              window.location.reload();
            } else {
              console.error('Erreur lors de la suppression du code promo');
            }
          };
          
          xhr.onerror = function () {
            console.error('Erreur de connexion lors de la suppression du code promo');
          };
          
          // Envoie la requete
          xhr.send();
        }
      });
    });
  </script>
  {/literal}
{/block}
