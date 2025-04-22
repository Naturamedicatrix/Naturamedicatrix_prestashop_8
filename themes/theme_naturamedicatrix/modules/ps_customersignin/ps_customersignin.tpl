{**
** CUSTOM MODULE SIGN IN
 *}
<div class="user-info">
  {if $customer.is_logged}
    <a class="account" href="{$urls.pages.my_account}" title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}" rel="nofollow">
      <div class="account-icon">
        <i class="material-icons user-icon-transparent">person_outline</i>
      </div>
      <div class="account-content">
        <div class="account-title">{l s='My account' d='Shop.Theme.Customeraccount'}</div>
        <div class="account-subtitle">{l s='Welcome' d='Shop.Theme.Customeraccount'} {$customerName}</div>
      </div>
    </a>
    <a class="logout" href="{$urls.actions.logout}" rel="nofollow" title="{l s='Log me out' d='Shop.Theme.Customeraccount'}">{l s='Sign out' d='Shop.Theme.Actions'}</a>
  {else}
    <a class="login" href="{$urls.pages.authentication}?back={$urls.current_url}" rel="nofollow" title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}">
      <div class="account-icon">
        <i class="material-icons user-icon-transparent">person_outline</i>
      </div>
      <div class="account-content">
        <div class="account-title">{l s='My account' d='Shop.Theme.Customeraccount'}</div>
        <div class="account-subtitle">{l s='Log in' d='Shop.Theme.Actions'}</div>
      </div>
    </a>
  {/if}
</div>
