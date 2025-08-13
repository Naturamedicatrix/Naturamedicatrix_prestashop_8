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

{if isset($subscriptionData)}
    {if $isLowerPsVersion}
        <div class="panel">
            <div class="panel-heading">
                {l s='Subscription product details' mod='wkproductsubscription'}
            </div>
            <div class="panel-body">
                <div class="wk_right_col">
                    <div class="wk_product_list">
                        <form action="" method="post" id="wkproductlist_form">
                            <table class="table table-striped" id="mp_product_list">
                                <thead>
                                    <tr>
                                        <th style="text-align:left;">{l s='ID' mod='wkproductsubscription'}</th>
                                        <th style="text-align:left;">{l s='Product' mod='wkproductsubscription'}</th>
                                        <th style="text-align:center;">{l s='Quantity' mod='wkproductsubscription'}</th>
                                        <th style="text-align:center;">{l s='Frequency' mod='wkproductsubscription'}</th>
                                        <th style="text-align:center;">{l s='Start date' mod='wkproductsubscription'}</th>
                                        <th style="text-align:center;">
                                            <p class="mb-0">{l s='Total amount' mod='wkproductsubscription'}</p>
                                            <small class="text-muted">{l s='Tax included' mod='wkproductsubscription'}</small>
                                        </th>
                                        <th style="text-align:center;">{l s='Action' mod='wkproductsubscription'}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach $subscriptionData as $subscription}
                                        <tr>
                                            <td style="text-align:left;">{$subscription.id_subscription|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:left;">{$subscription.product_name|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:center;">{$subscription.quantity|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:center;">{$subscription.frequncy_label|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:center;">{Tools::displayDate($subscription.first_order_date)|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:center;">{$subscription.total_amount|escape:'htmlall':'UTF-8'}</td>
                                            <td style="text-align:center;">
                                                <a class="btn btn-primary" href="{$subscription.detail_link_admin|escape:'htmlall':'UTF-8'}" target="_blank">
                                                    {l s='View details' mod='wkproductsubscription'}
                                                </a>
                                            </td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {else}
        <div id="subscriptionProductDetails" class="card">
            <div class="card-block">
                <div class="card-header">
                    <h3 class="card-header-title">
                        {l s='Subscription product details' mod='wkproductsubscription'}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:left;">{l s='ID' mod='wkproductsubscription'}</th>
                                    <th style="text-align:left;">{l s='Product' mod='wkproductsubscription'}</th>
                                    <th style="text-align:center;">{l s='Quantity' mod='wkproductsubscription'}</th>
                                    <th style="text-align:center;">{l s='Frequency' mod='wkproductsubscription'}</th>
                                    <th style="text-align:center;">{l s='Start date' mod='wkproductsubscription'}</th>
                                    <th style="text-align:center;">
                                        <p class="mb-0">{l s='Total amount' mod='wkproductsubscription'}</p>
                                        <small class="text-muted">{l s='Tax included' mod='wkproductsubscription'}</small>
                                    </th>
                                    <th style="text-align:center;">{l s='Action' mod='wkproductsubscription'}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $subscriptionData as $subscription}
                                    <tr>
                                        <td style="text-align:left;">{$subscription.id_subscription|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:left;">{$subscription.product_name|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:center;">{$subscription.quantity|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:center;">{$subscription.frequncy_label|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:center;">{Tools::displayDate($subscription.first_order_date)|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:center;">{$subscription.total_amount|escape:'htmlall':'UTF-8'}</td>
                                        <td style="text-align:center;">
                                            <a class="btn btn-primary btn-sm" href="{$subscription.detail_link_admin|escape:'htmlall':'UTF-8'}" target="_blank">
                                                {l s='View' mod='wkproductsubscription'}
                                            </a>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {/if}
{/if}
