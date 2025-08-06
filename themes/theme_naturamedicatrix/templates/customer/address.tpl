{**
* CUSTOM ADDRESS (Ajout d'une adresse)
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}

{block name='page_content'}
  {if $editing}
    <h1>{l s='Update your address' d='Shop.Theme.Customeraccount'}</h1>
  {else}
    <h1>{l s='New address' d='Shop.Theme.Customeraccount'}</h1>
  {/if}
  <div class="address-form max-w-xl mt-2">
    {render template="customer/_partials/address-form.tpl" ui=$address_form}
  </div>
{/block}
