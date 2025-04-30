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

          <hr />
          
          <li>
            <a class="account-link" id="logout-link-side" href="{$urls.actions.logout}">
              <i class="bi bi-power"></i>
              <span>{l s='Déconnexion' d='Shop.Theme.Actions'}</span>
            </a>
          </li>
      </ul>
      
      {* Bouton mobile *}
      <div class="mobile-action-button">
        <a href="{$urls.pages.index}" class="btn-primary">
          Continuer mes achats
        </a>
      </div>
    </div>
  </div>
{/block}
{* END LEFT COLUMN *}

{* CONTENT *}
{block name='page_title'}
  Aperçu de mon compte
{/block}

{block name='page_content'}
  <div class="content-account">
    <p>Dans votre espace client NATURAMedicatrix, vous pouvez gérer vos commandes et vos retours, ainsi que vos informations personnelles.</p>
    <div class="content-account-logo text-center">
      <i class="bi bi-bag"></i>
      <h2>Tout est à jour :)</h2>
    </div>
  </div>
  
  <div class="text-center mt-12">
    <a href="{$urls.pages.index}" class="btn-primary">
      Continuer mes achats
    </a>
  </div>
{/block}


{block name='page_footer'}
{/block}
