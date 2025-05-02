{**
* CUSTOM PAGE ADDRESSES
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
  {if $customer.addresses}
    {foreach $customer.addresses as $address}
      <div class="col-lg-4 col-md-6 col-sm-6">
      {block name='customer_address'}
        {include file='customer/_partials/block-address.tpl' address=$address}
      {/block}
      </div>
    {/foreach}
  {else}
    <div class="alert alert-info" role="alert" data-alert="info">
      {l s='Aucune adresse disponible.' d='Shop.Notifications.Success'} <a href="{$urls.pages.address}" title="{l s='Ajouter une adresse' d='Shop.Theme.Actions'}">{l s='Ajouter une adresse' d='Shop.Theme.Actions'}</a>
    </div>
  {/if}
  <div class="clearfix"></div>
  <div class="addresses-footer">
    <a href="{$urls.pages.address}" data-link-action="add-address">
      <i class="bi bi-plus-circle"></i>
      <span>{l s='Créer une nouvelle adresse' d='Shop.Theme.Actions'}</span>
    </a>
  </div>
{/block}
