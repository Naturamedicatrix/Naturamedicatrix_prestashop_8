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
<div class="card-block cart-summary-totals js-cart-summary-totals">

  {block name='cart_summary_total'}
    {if !$configuration.display_prices_tax_incl && $configuration.taxes_enabled}
      <div class="cart-summary-line">
        <span class="label text-gray-900 font-bold text-base">{$cart.totals.total.label}&nbsp;{$cart.labels.tax_short}</span>
        <span class="value text-gray-900 font-bold text-lg">{$cart.totals.total.value}</span>
      </div>
      <div class="cart-summary-line cart-total">
        <span class="label text-gray-900 font-bold text-base">{$cart.totals.total_including_tax.label}</span>
        <span class="value text-gray-900 font-bold text-lg">{$cart.totals.total_including_tax.value}</span>
      </div>
    {else}
      <div class="cart-summary-line cart-total">
        <span class="label text-gray-900 font-bold text-base">{$cart.totals.total.label}&nbsp;{if $configuration.display_taxes_label && $configuration.taxes_enabled}{$cart.labels.tax_short}{/if}</span>
        <span class="value text-gray-900 font-bold text-lg">{$cart.totals.total.value}</span>
      </div>
    {/if}
  {/block}

  {block name='cart_summary_tax'}
    {if $cart.subtotals.tax}
      <div class="cart-summary-line">
        <span class="label sub text-sm text-gray-600 font-normal">{l s='%label%:' sprintf=['%label%' => $cart.subtotals.tax.label] d='Shop.Theme.Global'}</span>
        <span class="value sub text-sm text-gray-600 font-semibold">{$cart.subtotals.tax.value}</span>
      </div>
    {/if}
  {/block}

</div>



 