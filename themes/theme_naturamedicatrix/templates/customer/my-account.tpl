{**
* CUSTOM PAGE MY ACCOUNT
 *}
{extends file='customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
  <div id="left-column" class="left-column-content col-xs-12 col-md-4 col-lg-3">
    <div class="account-list">
      <div class="customer-info">
        <h3>{$customer.firstname} {$customer.lastname}</h3>
        <p class="customer-email">{$customer.email}</p>
      </div>
      <ul class="account-links-list">
        <li>
          <a class="account-link" id="identity-link-side" href="{$urls.pages.identity}">
            <i class="bi bi-person"></i>
            <span>{l s='Mes informations personnelles' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>

        {if $customer.addresses|count}
          <li>
            <a class="account-link" id="addresses-link-side" href="{$urls.pages.addresses}">
              <i class="bi bi-house-door"></i>
              <span>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {else}
          <li>
            <a class="account-link" id="address-link-side" href="{$urls.pages.address}">
            <i class="bi bi-house-door"></i>
              <span>{l s='Ajouter une première adresse' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {/if}

        {if !$configuration.is_catalog}
          <li>
            <a class="account-link" id="history-link-side" href="{$urls.pages.history}">
              <i class="bi bi-card-list"></i>
              <span>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {/if}

        {if !$configuration.is_catalog}
          <li>
            <a class="account-link" id="order-slips-link-side" href="{$urls.pages.order_slip}">
              <i class="bi bi-credit-card-2-front"></i>
              <span>{l s='Mes bons de réduction' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {/if}

        {if $configuration.voucher_enabled && !$configuration.is_catalog}
          <li>
            <a class="account-link" id="discounts-link-side" href="{$urls.pages.discount}">
              <i class="material-icons">&#xE54E;</i>
              <span>{l s='Mes bons d\'achat' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {/if}

        {if $configuration.return_enabled && !$configuration.is_catalog}
          <li>
            <a class="account-link" id="returns-link-side" href="{$urls.pages.order_follow}">
              <i class="material-icons">&#xE860;</i>
              <span>{l s='Mes retours produits' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        {/if}

   
          <li>
            <a class="account-link" id="wishlist-link-side" href="{$link->getModuleLink('blockwishlist', 'lists')}">
                <i class="bi bi-heart"></i>
              <span>{l s='Mes listes d\'envies' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
          
          <li>
            <a class="account-link" id="gdpr-link-side" href="{$link->getModuleLink('psgdpr', 'gdpr')}">
              <i class="bi bi-lock"></i>
              <span>{l s='RGPD - Données personnelles' d='Shop.Theme.Customeraccount'}</span>
            </a>
          </li>
        
    </div>
  </div>
{/block}
{* END LEFT COLUMN *}

{* CONTENT *}
{block name='page_title'}
  {l s='Your account' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
  <div class="row">
    <div class="links">

      <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="identity-link" href="{$urls.pages.identity}">
        <span class="link-item">
          <i class="material-icons">&#xE853;</i>
          {l s='Information' d='Shop.Theme.Customeraccount'}
        </span>
      </a>

      {if $customer.addresses|count}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addresses-link" href="{$urls.pages.addresses}">
          <span class="link-item">
            <i class="material-icons">&#xE56A;</i>
            {l s='Addresses' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {else}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="address-link" href="{$urls.pages.address}">
          <span class="link-item">
            <i class="material-icons">&#xE567;</i>
            {l s='Add first address' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {/if}

      {if !$configuration.is_catalog}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="history-link" href="{$urls.pages.history}">
          <span class="link-item">
            <i class="material-icons">&#xE916;</i>
            {l s='Order history and details' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {/if}

      {if !$configuration.is_catalog}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="order-slips-link" href="{$urls.pages.order_slip}">
          <span class="link-item">
            <i class="material-icons">&#xE8B0;</i>
            {l s='Credit slips' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {/if}

      {if $configuration.voucher_enabled && !$configuration.is_catalog}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="discounts-link" href="{$urls.pages.discount}">
          <span class="link-item">
            <i class="material-icons">&#xE54E;</i>
            {l s='Vouchers' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {/if}

      {if $configuration.return_enabled && !$configuration.is_catalog}
        <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="returns-link" href="{$urls.pages.order_follow}">
          <span class="link-item">
            <i class="material-icons">&#xE860;</i>
            {l s='Merchandise returns' d='Shop.Theme.Customeraccount'}
          </span>
        </a>
      {/if}

      {block name='display_customer_account'}
        {hook h='displayCustomerAccount'}
      {/block}

    </div>
  </div>
{/block}


{block name='page_footer'}
  {block name='my_account_links'}
    <div class="text-sm-center">
      <a href="{$urls.actions.logout}" >
        {l s='Sign out' d='Shop.Theme.Actions'}
      </a>
    </div>
  {/block}
{/block}
