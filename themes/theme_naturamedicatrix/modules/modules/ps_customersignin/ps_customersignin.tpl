{**
** CUSTOM MODULE SIGN IN
 *}


<div class="user-info m-0 text-left">
{if $customer.is_logged}
  <a href="{$urls.pages.my_account}" class="flex items-end gap-2 text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out no-underline" rel="nofollow">
    <i class="bi bi-person-check text-2xl leading-0"></i>
    <div class="infos text-sm leading-tight">
      <div class="text-xs leading-tight opacity-90">
        {l s='My account' d='Shop.Theme.Customeraccount'}
      </div>
      <div class="text-base leading-none font-semibold">
        {$customer.firstname} {$customer.lastname|truncate:2:"."}
      </div>
    </div>
  </a>
{*   <a class="logout" href="{$urls.actions.logout}" rel="nofollow" title="{l s='Log me out' d='Shop.Theme.Customeraccount'}">{l s='Sign out' d='Shop.Theme.Actions'}</a> *}
{else}
  <a href="{$urls.pages.authentication}?back={$urls.current_url}" class="flex items-end gap-2 text-white px-2.5 py-0 hover:text-gray-200 transition-colors duration-200 ease-in-out no-underline" rel="nofollow">
    <i class="bi bi-person text-2xl leading-0"></i>
    <div class="infos text-sm leading-tight">
      <div class="text-xs leading-tight opacity-90">
        {l s='My account' d='Shop.Theme.Customeraccount'}
      </div>
      <div class="text-base leading-none font-semibold">
        {l s='Log in' d='Shop.Theme.Actions'}
      </div>
    </div>
  </a>
{/if}
</div>
