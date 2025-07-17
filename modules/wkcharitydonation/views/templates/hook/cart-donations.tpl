{**
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License version 3.0
* that is bundled with this package in the file LICENSE.txt
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/AFL-3.0
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to a newer
* versions in the future. If you wish to customize this module for your needs
* please refer to CustomizationPolicy.txt file inside our module for more information.
*
* @author Webkul IN
* @copyright Since 2010 Webkul
* @license https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
*}

<div class="card mt-3">
  <div class="card-block">
    <h2 class="h2">{l s='Faire un don' mod='wkcharitydonation'}</h2>
  </div>
  <hr class="separator">
  <div class="charity-block card-block">
    {foreach $checkoutDonations as $checkoutDonation}
      <div class="donation-item mb-3">
        <form class="donation-block row tw-items-center" method="POST" action="{$cart_url|escape:'html':'UTF-8'}">
          <div class="col-xs-12 col-md-6 mb-2">
            <div class="donation-title mb-1">
              <strong>{if $checkoutDonation['product_visibility'] == 1}<a href="{$checkoutDonation['link']|escape:'html':'UTF-8'}" class="label">{/if}{$checkoutDonation['name'][$id_current_lang]|escape:'html':'UTF-8'}{if $checkoutDonation['product_visibility'] == 1}</a>{/if}</strong>
            </div>
            <div class="donation-description">
              {$checkoutDonation['description'][$id_current_lang] nofilter}
            </div>
            {if ($checkoutDonation['price_type']) == 2}
              <div class="donation-note mt-1">
                <small class="text-muted">{l s='Note' mod='wkcharitydonation'}: {l s='Minimum amount for this donation is' mod='wkcharitydonation'} {$checkoutDonation['displayPrice']|escape:'html':'UTF-8'}</small>
              </div>
            {/if}
          </div>
          <div class="col-xs-8 col-md-4 donation-price-div">
            {if ($checkoutDonation['price_type']) == 1}
              <div class="form-group mb-0">
                <div class="input-group">
                  <span class="input-group-addon">{$currency_sign|escape:'html':'UTF-8'}</span>
                  <input type="text" class="form-control" value="{$checkoutDonation['price']|escape:'html':'UTF-8'}" disabled>
                </div>
                <input type="hidden" value={$checkoutDonation['id_donation_info']|escape:'html':'UTF-8'} name="id_donation_info" class="id-donation-info">
              </div>
            {else}
              <div class="form-group mb-0">
                <div class="input-group">
                  <span class="input-group-addon">{$currency_sign|escape:'html':'UTF-8'}</span>
                  <input type="text" class="form-control donation-price" name="donation_price" value="{$checkoutDonation['price']|escape:'html':'UTF-8'}">
                </div>
                <input type="hidden" value={$checkoutDonation['id_donation_info']|escape:'html':'UTF-8'} name="id_donation_info" class="id-donation-info">
              </div>
            {/if}
            <div class="price-error-container">
              <p class="text-danger price-error hide mt-1 mb-0"></p>
            </div>
          </div>
          <div class="col-xs-4 col-md-2 donation-btn tw-text-right tw-flex tw-items-center tw-justify-end">
            <input type="hidden" name="add-donation-to-cart">
            <button type="submit" class="btn btn-primary donation-btn-text submitDonationForm">{l s='Donner' mod='wkcharitydonation'}</button>
          </div>
        </form>
      </div>
    {/foreach}
  </div>
</div>
