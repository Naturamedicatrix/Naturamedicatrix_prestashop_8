{**
 * CUSTOM BLOCK ADDRESS
 *}

{block name='address_block_item'}
<article id="address-{$address.id}" class="w-full h-full flex flex-col justify-between min-h-[280px]" data-id-address="{$address.id}">
  <div>
    <div class="address-header bg-gray-50 w-full mt-0 mb-2 py-5 px-6 relative">
      <h4 class="m-0 p-0">{$address.alias}</h4>
      <a href="{url entity=address id=$address.id params=['delete' => 1, 'token' => $token]}" data-link-action="delete-address" class="absolute right-5 top-5 color-gray-900" style="color: #111827">
        <i class="bi bi-trash3"></i>
      </a>
    </div>
    <div class="address-body px-6 mb-2">
      <address>{$address.formatted nofilter}</address>
      {hook h='displayAdditionalCustomerAddressFields' address=$address}
    </div>
  </div>

  {block name='address_block_item_actions'}
    <div class="address-footer px-6 mt-auto pb-4">
      <a href="{url entity=address id=$address.id}" data-link-action="edit-address" class="no-underline font-semibold inline-flex items-center space-x-1" style="color: #111827">
        <i class="bi bi-pen"></i>
        <span class="underline">{l s='Update' d='Shop.Theme.Actions'}</span>
      </a>
    </div>
  {/block}
</article>
{/block}
  