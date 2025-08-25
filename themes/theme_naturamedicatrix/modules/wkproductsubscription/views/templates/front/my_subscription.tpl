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

{* {extends file=$layout} *}
{extends 'customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
    {include file='customer/_partials/account-left-column.tpl'}
  {/block}
  {* END LEFT COLUMN *}


{block name="page_content"}
<h1>{l s='Mes abonnements' d='Shop.Theme.Customeraccount'}</h1>
        {if $subscriptions}
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{l s='ID' mod='wkproductsubscription'}</th>
                                <th class="text-left">{l s='Product' mod='wkproductsubscription'}</th>
                                {* <th class="text-right">{l s='Unit Price' mod='wkproductsubscription'}</th>
                                <th class="text-right">{l s='Quantity' mod='wkproductsubscription'}</th> *}
                                <th class="text-right">
                                    {l s='Total amount' mod='wkproductsubscription'}
                                    <small>{l s='(tax inc.)' mod='wkproductsubscription'}</small>
                                </th>
                                <th class="text-center">{l s='Frequency' mod='wkproductsubscription'}</th>
                                <th class="text-center">{l s='Next order date' mod='wkproductsubscription'}</th>
                                {* <th class="text-center">{l s='Next delivery date' mod='wkproductsubscription'}</th> *}
                                <th class="text-center">{l s='Status' mod='wkproductsubscription'}</th>
                                <th class="text-center">{l s='Action' mod='wkproductsubscription'}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$subscriptions item=subs key=key}
                                <tr>
                                    <td>{$subs.id_subscription|escape:'htmlall':'UTF-8'}</td>
                                    <td class="text-left">
                                        <a href="{$subs.product_link|escape:'htmlall':'UTF-8'}" title="{$subs.product_name|escape:'htmlall':'UTF-8'}">
                                            {$subs.product_name|escape:'htmlall':'UTF-8'}
                                        </a>
                                        {if $subs.attributes}
                                            <div>
                                                {foreach from=$subs.attributes item=attr}
                                                    <small>{$attr.group_name|escape:'htmlall':'UTF-8'}: {$attr.attribute_name|escape:'htmlall':'UTF-8'}</small><br>
                                                {/foreach}
                                            </div>
                                        {/if}
                                    </td>
                                    {* <td class="text-right">{$subs.unit_price}</td>
                                    <td class="text-right">{$subs.quantity}</td> *}
                                    <td class="text-right">{$subs.total_amount|escape:'htmlall':'UTF-8'}</td>
                                    <td class="text-center">{$subs.frequncy_label|escape:'htmlall':'UTF-8'}</td>
                                    <td class="text-center">
                                        {if $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                            {Tools::displayDate($subs.next_order_date)|escape:'htmlall':'UTF-8'}
                                        {else}
                                            --
                                        {/if}
                                    </td>
                                    {* <td class="text-center">
                                        {if $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                            {if !$subs.is_virtual}
                                                {Tools::displayDate($subs.next_delivery_date)|escape:'htmlall':'UTF-8'}
                                            {else}
                                                --
                                            {/if}
                                        {else}
                                            --
                                        {/if}
                                    </td> *}
                                    <td class="text-center">
                                        {if $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                            <span class="badge badge-success">{l s='Active' mod='wkproductsubscription'}</span>
                                        {elseif $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                            <span class="badge badge-danger">{l s='Cancelled' mod='wkproductsubscription'}</span>
                                        {elseif $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                            <span class="badge badge-secondary">{l s='Paused' mod='wkproductsubscription'}</span>
                                        {/if}
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{$subs.detail_link|escape:'htmlall':'UTF-8'}" title="{l s='View Subscription' mod='wkproductsubscription'}">
                                            <i class="material-icons">visibility</i>
                                            {* {l s='View' mod='wkproductsubscription'} *}
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        {else}
            <div class="alert alert-warning">
                <span>{l s='You have no subscriptions.' mod='wkproductsubscription'}</span>
            </div>
        {/if}
        <div class="clearfix"></div>
{/block}
