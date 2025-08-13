{*
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

<div class="table-responsive">
    {if $paymentMethods}
        <div class="alert alert-info">
            {l s='Please enable only those payment methods which support recurring payment.' mod='wkproductsubscription'}
        </div>
    {/if}
    <table class="table">
        <thead>
            <tr>
                <th colspan="2"><strong>{l s='Payment method' mod='wkproductsubscription'}</strong></th>
                <th><strong>{l s='Status' mod='wkproductsubscription'}</strong></th>
            </tr>
        </thead>
        <tbody>
        {if $paymentMethods}
            {foreach from=$paymentMethods item=payment}
                <tr>
                    <td style="width:10%">
                        <img class="img-thumbnail" src="{$payment['logo']|escape:'htmlall':'UTF-8'}" width="75" >
                    </td>
                    <td style="width:80%">
                        <strong>{$payment['name']|escape:'htmlall':'UTF-8'}</strong>
                        <span class="text-muted">v{$payment['version']|escape:'htmlall':'UTF-8'} - {l s='by' mod='wkproductsubscription'} {$payment['author']|escape:'htmlall':'UTF-8'}</span>
                        <p>{$payment['description']|escape:'htmlall':'UTF-8'}</p>
                    </td>
                    <td style="width:10%">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input onchange=hideShowPaymentFeatureInfo(this) module-id="{$payment['id']|escape:'htmlall':'UTF-8'}" id="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}_on" type="radio" value="1" name="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}" {if isset($payment['enabled']) && $payment['enabled'] == 1} checked="checked" {/if} />
                            <label for="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}_on">{l s='Yes' mod='wkproductsubscription'}</label>
                            <input onchange=hideShowPaymentFeatureInfo(this) module-id="{$payment['id']|escape:'htmlall':'UTF-8'}" id="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}_off" type="radio" value="0" name="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}" {if isset($payment['enabled']) && $payment['enabled'] == 0} checked="checked" {/if} />
                            <label for="paymentMethods_{$payment['id']|escape:'htmlall':'UTF-8'}_off">{l s='No' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                    </td>
                </tr>
                <tr class="feature_tr" id="info_{$payment['id']|escape:'htmlall':'UTF-8'}" {if isset($payment['enabled']) && $payment['enabled'] == 1}{else}style="display:none;"{/if}>
                    <td colspan="3">
                        <div class="feature_content_{$payment['tech_name']|escape:'htmlall':'UTF-8'}">
                        </div>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td colspan="3">{l s='No payment method available.' mod='wkproductsubscription'}</td>
            </tr>
        {/if}
        </tbody>
    </table>
</div>
