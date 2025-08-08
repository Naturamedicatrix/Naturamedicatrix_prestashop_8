{**
* CUSTOM PAGE MES ADRESSES (Mon compte)
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{* {block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block} *}


{block name='page_content'}
  <h1>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}</h1>
  
  {if $customer.addresses}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
    {foreach $customer.addresses as $address}
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden text-left flex flex-col items-center justify-between space-y-4">
      {block name='customer_address'}
          {include file='customer/_partials/block-address.tpl' address=$address}
      {/block}
      </div>
    {/foreach}
    </div>
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">
      {l s='Aucune adresse disponible.' d='Shop.Notifications.Success'} <a href="{$urls.pages.address}" title="{l s='Ajouter une adresse' d='Shop.Theme.Actions'}">{l s='Ajouter une adresse' d='Shop.Theme.Actions'}</a>
    </div>
  {/if}
  <div class="clearfix"></div>
  
  <div class="mt-6">
    <a href="{$urls.pages.address}" data-link-action="add-address" class="bg-gray-900 hover:bg-gray-700 text-white font-bold text-base px-16 py-3.5 rounded-md transition no-underline btn">
      <i class="bi bi-plus"></i>
      <span>{l s='Add a new address' d='Shop.Theme.Actions'}</span>
    </a>
  </div>
  
{/block}
