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
    <table class="table">
        <thead>
            <tr>
                <th colspan="2"><strong>{l s='Payment Addon' mod='wkproductsubscription'}</strong></th>
                <th style="text-align: center;"><strong>{l s='Link' mod='wkproductsubscription'}</strong></th>
            </tr>
        </thead>
        <tbody>
        {if $paymentMethods}
            {foreach from=$paymentMethods item=payment}
                {if !$payment['installed']}
                    <tr>
                        <td style="width:10%">
                            <img class="img-thumbnail" src="{$payment['logo']|escape:'htmlall':'UTF-8'}" width="75" >
                        </td>
                        <td style="width:70%">
                            <strong>{$payment['name']|escape:'htmlall':'UTF-8'}</strong>
                            <p>{$payment['description']|escape:'htmlall':'UTF-8'}</p>
                        </td>
                        <td style="width:20%; text-align:center">
                            {if $payment['installed']}
                                <span class="label color_field" style="background-color:#72c279;color:white">
                                    {l s='Installed' mod='wkproductsubscription'}
                                </span>
                            {else}
                                <a href="{$payment['addon_link']|escape:'htmlall':'UTF-8'}" class="btn btn-info" target="_blank">{l s='Buy' mod='wkproductsubscription'}</a>
                            {/if}
                        </td>
                    </tr>
                    <tr class="feature_tr">
                        <td colspan="3">
                            <div class="feature_content_{$payment['tech_name']|escape:'htmlall':'UTF-8'}">
                            </div>
                        </td>
                    </tr>
                {/if}
            {/foreach}
        {else}
            <tr>
                <td colspan="3">{l s='No payment method available.' mod='wkproductsubscription'}</td>
            </tr>
        {/if}
        </tbody>
    </table>
</div>
