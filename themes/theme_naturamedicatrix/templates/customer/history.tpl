{**
* CUSTOM PAGE ORDER HISTORY
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{* {block name='page_title'}
  <div class="title-with-sep">
    <span>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}</span>
    <div class="sep-leaf"></div>
  </div>
{/block} *}

{block name='page_content'}
  <h1>{l s='Historique des commandes' d='Shop.Theme.Customeraccount'}</h1>
  
  

  {if $orders}
  <div class="space-y-6 mt-6">
    {foreach from=$orders item=order}
      <div class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col md:flex-row justify-between items-start md:items-center">

        <!-- Blocs info à gauche -->
        <div class="flex flex-wrap gap-6 text-sm text-gray-900 md:items-center">
          <div class="w-24">
            <p class="text-xs text-gray-500 mb-0">{l s='Date placed' d='Shop.Theme.Customeraccount'}</p>
            <p class="mb-0">{$order.details.order_date}</p>
          </div>

          <div class="w-28">
            <p class="text-xs text-gray-500 mb-0">{l s='Order number' d='Shop.Theme.Customeraccount'}</p>
            <p class="font-medium text-brand mb-0">{$order.details.reference}</p>
          </div>

          <div class="w-20">
            <p class="text-xs text-gray-500 mb-0">{l s='Total' d='Shop.Theme.Customeraccount'}</p>
            <p class="font-bold mb-0">{$order.totals.total.value}</p>
          </div>

          <div class="flex flex-wrap items-center leading-tight">
            <span style="background: {$order.history.current.color}" class="px-2.5 py-0.5 rounded-sm font-semibold text-white">{$order.history.current.ostate_name}</span>
          </div>
        </div>

        <!-- Actions à droite -->
        <div class="flex flex-wrap gap-4 mt-4 md:mt-0 text-indigo-600 font-medium items-center">
          {if $order.details.invoice_url}
            <a href="{$order.details.invoice_url}" class="hover:underline">{l s='Invoice' d='Shop.Theme.Customeraccount'}</a>
          {/if}
          {if $order.details.reorder_url}
            <a href="{$order.details.reorder_url}" class="hover:underline">{l s='Buy again' d='Shop.Theme.Actions'}</a>
          {/if}
          <a href="{$order.details.details_url}" class="px-4 py-2.5 text-sm font-medium border border-gray-300 no-underline rounded-md hover:bg-gray-50" style="color:#374151;">
            {l s='Details' d='Shop.Theme.Customeraccount'}
          </a>
        </div>

      </div>
    {/foreach}
  </div>
{else}
  <div class="alert alert-info" role="alert" data-alert="info">
    {l s='You haven\'t placed any orders yet.' d='Shop.Notifications.Warning'}
  </div>
{/if}
  
  
{/block}
