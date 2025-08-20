{**
 * Custom displayLeftColumn hook template
 * Shows account links only on my-account page
 *}

{if $page.page_name == 'my-account'}
  <div class="account-links">
    <div class="card">
      <div class="card-block">
        <h3 class="account-links-title">{l s='My Account' d='Shop.Theme.Customeraccount'}</h3>
        <ul class="account-links-list">
          <li><a href="{$urls.pages.identity}">{l s='Information' d='Shop.Theme.Customeraccount'}</a></li>
          
          {if $customer.addresses|count}
            <li><a href="{$urls.pages.addresses}">{l s='Addresses' d='Shop.Theme.Customeraccount'}</a></li>
          {else}
            <li><a href="{$urls.pages.address}">{l s='Add first address' d='Shop.Theme.Customeraccount'}</a></li>
          {/if}

          <li><a href="{$urls.pages.subscription}">{l s='Subscriptions' d='Shop.Theme.Customeraccount'}</a></li>
          
          {if !$configuration.is_catalog}
            <li><a href="{$urls.pages.history}">{l s='Order history and details' d='Shop.Theme.Customeraccount'}</a></li>
          {/if}
          
          {if !$configuration.is_catalog}
            <li><a href="{$urls.pages.order_slip}">{l s='Credit slips' d='Shop.Theme.Customeraccount'}</a></li>
          {/if}
          
          {if $configuration.voucher_enabled && !$configuration.is_catalog}
            <li><a href="{$urls.pages.discount}">{l s='Vouchers' d='Shop.Theme.Customeraccount'}</a></li>
          {/if}
          
          {if $configuration.return_enabled && !$configuration.is_catalog}
            <li><a href="{$urls.pages.order_follow}">{l s='Merchandise returns' d='Shop.Theme.Customeraccount'}</a></li>
          {/if}
        </ul>
      </div>
    </div>
  </div>
{/if}
