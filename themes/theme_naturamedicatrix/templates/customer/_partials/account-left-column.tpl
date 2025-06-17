{* PARTIAL: Left Column for Account Pages *}
<div id="left-column" class="left-column-content col-xs-12 col-md-4 col-lg-3">
  <div class="account-list">
    <div class="customer-info">
      <h3>{$customer.firstname} {$customer.lastname}</h3>
      <p class="customer-email">{$customer.email}</p>
      <!-- Bouton toggle pour mobile -->
      <button class="mobile-toggle-account" type="button">
        <i class="bi bi-chevron-down"></i>
        <span>{l s='Afficher les paramètres' d='Shop.Theme.Customeraccount'}</span>
      </button>
    </div>
    
    <!-- Wrapper pour la liste déroulante -->
    <div class="account-links-wrapper">
    <ul class="account-links-list">
      <li>
        <a class="account-link {if $page.page_name == 'identity'}active{/if}" id="identity-link-side" href="{$urls.pages.identity}">
          <i class="bi bi-person"></i>
          <span>{l s='Mes informations personnelles' d='Shop.Theme.Customeraccount'}</span>
        </a>
      </li>

      {if $customer.addresses|count}
        <li>
          <a class="account-link {if $page.page_name == 'addresses'}active{/if}" id="addresses-link-side" href="{$urls.pages.addresses}">
            <i class="bi bi-house-door"></i>
            <span>{l s='Mes adresses' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {else}
        <li>
          <a class="account-link {if $page.page_name == 'address'}active{/if}" id="address-link-side" href="{$urls.pages.address}">
          <i class="bi bi-house-door"></i>
            <span>{l s='Ajouter une première adresse' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {/if}

      {if !$configuration.is_catalog}
        <li>
          <a class="account-link {if $page.page_name == 'history'}active{/if}" id="history-link-side" href="{$urls.pages.history}">
            <i class="bi bi-card-list"></i>
            <span>{l s='Mon historique de commandes' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {/if}

      {if !$configuration.is_catalog}
        <li>
          <a class="account-link {if $page.page_name == 'order-slip'}active{/if}" id="order-slips-link-side" href="{$urls.pages.order_slip}">
            <i class="bi bi-credit-card-2-front"></i>
            <span>{l s='Mes bons de réduction' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {/if}

      {if $configuration.voucher_enabled && !$configuration.is_catalog}
        <li>
          <a class="account-link {if $page.page_name == 'discount'}active{/if}" id="discounts-link-side" href="{$urls.pages.discount}">
            <i class="bi bi-credit-card-2-front"></i>
            <span>{l s='Mes bons d\'achat' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {/if}

      {if $configuration.return_enabled && !$configuration.is_catalog}
        <li>
          <a class="account-link {if $page.page_name == 'order-follow'}active{/if}" id="returns-link-side" href="{$urls.pages.order_follow}">
            <i class="bi bi-credit-card-2-front"></i>
            <span>{l s='Mes retours produits' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
      {/if}
 
        <li>
          <a class="account-link {if $page.page_name == 'module-blockwishlist-lists'}active{/if}" id="wishlist-link-side" href="{$link->getModuleLink('blockwishlist', 'lists')}">
              <i class="bi bi-heart"></i>
            <span>{l s='Mes listes d\'envies' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>
        
        <li>
          <a class="account-link {if $page.page_name == 'module-psgdpr-gdpr'}active{/if}" id="gdpr-link-side" href="{$link->getModuleLink('psgdpr', 'gdpr')}">
            <i class="bi bi-lock"></i>
            <span>{l s='RGPD - Données personnelles' d='Shop.Theme.Customeraccount'}</span>
          </a>
        </li>

        <li>
          <a class="account-link {if $page.page_name == 'module-ps_emailalerts-account'}active{/if}" id="alerts-link-side" href="{$link->getModuleLink('ps_emailalerts', 'account')}">
            <i class="bi bi-bell"></i>
            <span>{l s='Mes alertes' d='Shop.Theme.Customeraccount'}</span>
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
    
    {* Bouton mobile visible uniquement sur les petits écrans *}
    <div class="mobile-action-button">
      <a href="{$urls.pages.index}" class="btn btn-primary">
        Continuer mes achats
      </a>
    </div>
      
      {* BLOCK BESOIN D'AIDE *}
      {include file='../../_partials/block_besoin_aide.tpl'}
    </div>
  </div>
</div>

{* JavaScript pour gérer le toggle mobile *}
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.querySelector('.mobile-toggle-account');
    var linksWrapper = document.querySelector('.account-links-wrapper');
    
    if (toggleButton && linksWrapper) {
      // État initial sur mobile - caché
      if (window.innerWidth <= 575) {
        linksWrapper.classList.add('collapsed');
      }
      
      // Fonction de toggle
      toggleButton.addEventListener('click', function() {
        linksWrapper.classList.toggle('collapsed');
        toggleButton.classList.toggle('active');
        
        // Changer l'icône et le texte
        var icon = toggleButton.querySelector('i');
        var text = toggleButton.querySelector('span');
        if (linksWrapper.classList.contains('collapsed')) {
          icon.classList.remove('bi-chevron-up');
          icon.classList.add('bi-chevron-down');
          text.textContent = '{l s="Afficher les paramètres" d="Shop.Theme.Customeraccount"}';
        } else {
          icon.classList.remove('bi-chevron-down');
          icon.classList.add('bi-chevron-up');
          text.textContent = '{l s="Masquer les paramètres" d="Shop.Theme.Customeraccount"}';
        }
      });
      
      // Réagir au changement de taille de l'écran
      window.addEventListener('resize', function() {
        if (window.innerWidth <= 575) {
          linksWrapper.classList.add('collapsed');
          var icon = toggleButton.querySelector('i');
          var text = toggleButton.querySelector('span');
          icon.classList.remove('bi-chevron-up');
          icon.classList.add('bi-chevron-down');
          text.textContent = '{l s="Afficher les paramètres" d="Shop.Theme.Customeraccount"}';
        } else {
          linksWrapper.classList.remove('collapsed');
        }
      });
    }
  });
</script>
