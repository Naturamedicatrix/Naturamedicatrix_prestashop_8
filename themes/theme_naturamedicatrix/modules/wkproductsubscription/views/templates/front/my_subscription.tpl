{*
CUSTOM ABONNEMENTS MY ACCOUNT
*}

<style>
.alert ul, .alert-success ul {
  padding-left: 0;
  list-style: none;
}
</style>

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
  <div class="space-y-6 mt-6">
    {foreach from=$subscriptions item=subs key=key}
      <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col md:flex-row justify-between items-start md:items-center">

        <!-- Informations de l'abonnement à gauche -->
        <div class="flex flex-wrap gap-10 text-sm text-gray-900 md:items-center">
          <div class="w-40">
            <p class="text-xs text-gray-500 mb-0">{l s='Product' mod='wkproductsubscription'}</p>
            <div class="mb-0 text-sm">
              <a href="{$subs.product_link|escape:'htmlall':'UTF-8'}" title="{$subs.product_name|escape:'htmlall':'UTF-8'}" class="font-medium text-brand no-underline">
                {$subs.product_name|escape:'htmlall':'UTF-8'}
              </a>
              {if $subs.attributes}
                <div class="mt-1 text-sm">
                  {foreach from=$subs.attributes item=attr}
                    <small class="text-gray-600">{$attr.group_name|escape:'htmlall':'UTF-8'}: {$attr.attribute_name|escape:'htmlall':'UTF-8'}</small><br>
                  {/foreach}
                </div>
              {/if}
            </div>
          </div>

          <div class="w-24">
            <p class="text-xs text-gray-500 mb-0">{l s='Total amount' mod='wkproductsubscription'}</p>
            <p class="font-bold mb-0 text-sm">{$subs.total_amount|escape:'htmlall':'UTF-8'}</p>
          </div>

          <div class="w-28">
            <p class="text-xs text-gray-500 mb-0">{l s='Frequency' mod='wkproductsubscription'}</p>
            <p class="mb-0 text-sm font-bold">{$subs.frequncy_label|escape:'htmlall':'UTF-8'}</p>
          </div>

          <div class="w-42">
            <p class="text-xs text-gray-500 mb-0">{l s='Next order date' mod='wkproductsubscription'}</p>
            <p class="mb-0 text-sm font-bold">
              {if $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                {Tools::displayDate($subs.next_order_date)|escape:'htmlall':'UTF-8'}
              {else}
                --
              {/if}
            </p>
          </div>

          <div class="w-20">
          <p class="text-xs text-gray-500 mb-0">{l s='Status' mod='wkproductsubscription'}</p>
            <div class="flex flex-wrap items-center leading-tight">
              {if $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                <span class="rounded-sm font-semibold text-green-600 text-sm">{l s='Active' mod='wkproductsubscription'}</span>
              {elseif $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                <span class="rounded-sm font-semibold text-red-600 text-sm">{l s='Cancelled' mod='wkproductsubscription'}</span>
              {elseif $subs.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                <span class="rounded-sm font-semibold text-gray-600 text-sm">{l s='Paused' mod='wkproductsubscription'}</span>
              {/if}
            </div>
          </div>
        </div>

        <!-- Actions à droite -->
        <div class="flex flex-wrap gap-4 mt-4 md:mt-0 text-indigo-600 font-medium items-center">
          <a href="{$subs.detail_link|escape:'htmlall':'UTF-8'}" class="px-4 py-1.5 text-sm font-medium border border-gray-300 no-underline rounded-md hover:bg-gray-50" style="color:#374151;" title="{l s='View Subscription' mod='wkproductsubscription'}">
            {l s='Details' d='Shop.Theme.Customeraccount'}
          </a>
        </div>

      </div>
    {/foreach}
  </div>
{else}
  <div class="alert alert-info" role="alert" data-alert="info">
    {l s='You have no subscriptions.' mod='wkproductsubscription'}
  </div>
{/if}

<div class="mt-1.5 mb-0 text-right">
    <a href="{$link->getCMSLink(12)|escape:'htmlall':'UTF-8'}" 
       class="text-sm text-gray-500 underline hover:text-gray-700 hover:underline"
       target="_blank">
        {l s='Voir les conditions d\'abonnement' mod='wkproductsubscription'}
    </a>
</div>

{/block}
