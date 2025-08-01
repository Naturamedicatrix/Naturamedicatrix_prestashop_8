{* Partial pour la progression de livraison dans le modal panier *}
{* Récupération du code pays du client *}
{assign var="customerCountry" value=""}
{if $cart.address_delivery}
  {assign var="customerCountry" value=$cart.address_delivery.country_iso}
{elseif $customer.addresses}
  {assign var="defaultAddress" value=$customer.addresses|reset}
  {if $defaultAddress.country_iso}
    {assign var="customerCountry" value=$defaultAddress.country_iso}
  {/if}
{/if}

{* Calcul du total produits *}
{assign var="cartTotalValue" value=$cart.subtotals.products.value}
{assign var="totalTextClean" value=$cartTotalValue|replace:' ':''}
{assign var="totalTextDot" value=$totalTextClean|replace:',':'.'}
{assign var="totalText" value=$totalTextDot|floatval}

{assign var="relayThreshold" value=35}
{assign var="homeThreshold" value=50}
{assign var="minThreshold" value=15}

{* URL vers la page des conditions de livraison *}
{assign var="deliveryTermsUrl" value=$link->getCMSLink(3)|cat:"#livraison"}

<div id="shipping-progress-modal" class="shipping-progress-modal mt-4">
  <div id="shipping-progress-modal-content"></div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  const relayThreshold = {$relayThreshold};
  const homeThreshold = {$homeThreshold};
  const minThreshold = {$minThreshold};
  const customerCountry = "{$customerCountry|escape:'javascript'}";
  const relayEligibleCountries = ['FR', 'BE'];
  const homeEligibleCountries = ['FR', 'BE', 'LU'];
  const deliveryTermsUrl = "{$deliveryTermsUrl|escape:'javascript'}";
  
  // Traductions
  const translations = {
    relayTitle: '{l s='Point Relais' d='Shop.Theme.Checkout' js=1}',
    homeTitle: '{l s='Domicile' d='Shop.Theme.Checkout' js=1}',
    relayRemaining: '{l s='%amount% pour livraison Point Relais offerte' d='Shop.Theme.Checkout' js=1}',
    homeRemaining: '{l s='%amount% pour livraison domicile offerte' d='Shop.Theme.Checkout' js=1}',
    relaySuccess: '{l s='Livraison Point Relais offerte !' d='Shop.Theme.Checkout' js=1}',
    homeSuccess: '{l s='Livraison domicile offerte !' d='Shop.Theme.Checkout' js=1}',
    bothSuccess: '{l s='Livraison offerte !' d='Shop.Theme.Checkout' js=1}',
    freeShipping: '{l s='Livraison offerte' d='Shop.Theme.Checkout' js=1}',
    relayPrice: '{l s='35€ Point Relais' d='Shop.Theme.Checkout' js=1}',
    homePrice: '{l s='50€ Domicile' d='Shop.Theme.Checkout' js=1}'
  };
  
  function updateShippingProgressModal() {
    const container = document.getElementById('shipping-progress-modal-content');
    if (!container) return;
    
    // Récupère le total produits
    let cartTotal = {$totalText};
    try {
      if (typeof prestashop !== 'undefined' && prestashop.cart?.subtotals?.products) {
        let value = prestashop.cart.subtotals.products.value;
        if (typeof value === 'string') {
          cartTotal = parseFloat(value.replace(/\s+/g, '').replace(',', '.'));
        } else if (typeof value === 'number') {
          cartTotal = value;
        }
      }
    } catch (e) {}
    
    let html = '';
    
    const hasNoCountry = !customerCountry || customerCountry === "";
    const isRelayEligible = hasNoCountry || relayEligibleCountries.includes(customerCountry);
    const isHomeEligible = hasNoCountry || homeEligibleCountries.includes(customerCountry);
    
    // Ne rien afficher si panier trop petit ou pays non éligible
    if (cartTotal < minThreshold || (!isRelayEligible && !isHomeEligible)) {
      html = ''; // Pas d'affichage
    } else {
      // Progression active
      html = '<div class="shipping-progress-modal-active">';
      
      if (isRelayEligible && cartTotal < relayThreshold) {
        // Progression vers Point Relais
        const remaining = relayThreshold - cartTotal;
        const percent = Math.min(100, Math.floor(cartTotal / relayThreshold * 100));
        
{literal}
        html += `
          <div class="progress-section mb-2">
            <div class="progress-header d-flex justify-content-between align-items-center mb-1.5">
              <span style="font-size: 13px; font-weight: 600;">${translations.relayTitle}</span>
              <span style="font-size: 13px;">${cartTotal.toFixed(2).replace('.', ',')}€ / ${relayThreshold}€</span>
            </div>
            <div class="progress-bar-container" style="width: 100%; height: 4px; background-color: #e9ecef; border-radius: 2px;">
              <div class="progress-bar" style="width: ${percent}%; height: 4px; background-color: #10B981; border-radius: 2px; transition: width 0.3s;"></div>
            </div>
            <p style="font-size: 13px; margin: 4px 0 0 0; color: #6c757d;">
              ${translations.relayRemaining.replace('%amount%', `<strong style="color: #10B981;">${remaining.toFixed(2).replace('.', ',')}€</strong>`)}
            </p>
          </div>`;
{/literal}
      } else if (isRelayEligible && cartTotal >= relayThreshold && cartTotal < homeThreshold) {
        // Point Relais atteint, progression vers domicile
        const remaining = homeThreshold - cartTotal;
        const percent = Math.min(100, Math.floor(cartTotal / homeThreshold * 100));
        
{literal}
        html += `
          <p style="text-align: center; font-size: 13px; color: #10B981; font-weight: 600;">
            <i class="bi bi-check-circle"></i> ${translations.relaySuccess}
          </p>
          <div class="progress-section">
            <div class="progress-header d-flex justify-content-between align-items-center mb-1.5">
              <span style="font-size: 13px; font-weight: 600;">${translations.homeTitle}</span>
              <span style="font-size: 13px;">${cartTotal.toFixed(2).replace('.', ',')}€ / ${homeThreshold}€</span>
            </div>
            <div class="progress-bar-container" style="width: 100%; height: 4px; background-color: #e9ecef; border-radius: 2px;">
              <div class="progress-bar" style="width: ${percent}%; height: 4px; background-color: #10B981; border-radius: 2px; transition: width 0.3s;"></div>
            </div>
            <p style="font-size: 13px; margin: 4px 0 0 0; color: #6c757d;">
              ${translations.homeRemaining.replace('%amount%', `<strong style="color: #10B981;">${remaining.toFixed(2).replace('.', ',')}€</strong>`)}
            </p>
          </div>`;
{/literal}
      } else if (isHomeEligible && cartTotal >= homeThreshold) {
        // Tous les seuils atteints
{literal}
        html += `
          <div class="shipping-success text-center">
            <p style="font-size: 12px; margin: 0; color: #10B981; font-weight: 600;">
              <i class="bi bi-check-circle"></i> ${isRelayEligible ? translations.bothSuccess : translations.homeSuccess}
            </p>
          </div>`;
{/literal}
      }
      
      html += '</div>';
    }
    
    container.innerHTML = html;
    
    // Masquer complètement le conteneur si pas de contenu
    const modalContainer = document.getElementById('shipping-progress-modal');
    if (modalContainer) {
      if (html === '') {
        modalContainer.style.display = 'none';
      } else {
        modalContainer.style.display = 'block';
      }
    }
  }
  
  // Initialisation
  updateShippingProgressModal();
  
  // Détection des changements
  const updateHandler = () => setTimeout(updateShippingProgressModal, 300);
  
  // Événements PrestaShop natifs
  ['prestashop.cart.updated', 'updateCart', 'cart.updated', 'cart.refresh', 'blockcart.refresh'].forEach(evt => 
    document.addEventListener(evt, updateHandler));
 
  if (typeof $ !== 'undefined') {
    $(document).on('updateCart cart.updated', updateHandler);
  }
  
  document.addEventListener('click', function(e) {
    // Boutons d'ajout au panier
    if (e.target.closest('.add-to-cart, .btn-add-to-cart, [data-button-action="add-to-cart"]')) {
      setTimeout(updateShippingProgressModal, 800); // Délai plus long pour l'ajout
    }
    // Boutons de quantité dans le modal
    if (e.target.closest('.js-increase-product-quantity, .js-decrease-product-quantity')) {
      setTimeout(updateShippingProgressModal, 500);
    }
  });
  
  const observeModalChanges = () => {
    const modalContainer = document.querySelector('.cart-modal, .user-hover-modal');
    if (modalContainer) {
      const observer = new MutationObserver(mutations => {
        let shouldUpdate = false;
        for (const mutation of mutations) {
          // Vérifie si des éléments du panier ont changé
          if (mutation.target.closest('.cart-products, .cart-summary, .cart-subtotal, .cart-total')) {
            shouldUpdate = true;
            break;
          }
          // Vérifie les changements de texte (prix, quantité)
          if (mutation.type === 'childList' || mutation.type === 'characterData') {
            const target = mutation.target;
            if (target.classList && (target.classList.contains('subtotal-price') || 
                target.classList.contains('total-price') || 
                target.closest('.cart-product-item'))) {
              shouldUpdate = true;
              break;
            }
          }
        }
        if (shouldUpdate) {
          updateHandler();
        }
      });
      
      observer.observe(modalContainer, { 
        childList: true, 
        subtree: true, 
        attributes: true,
        characterData: true,
        attributeFilter: ['data-id-product', 'data-id-product-attribute']
      });
      
      return observer;
    }
  };
  
  // Initialise l'observer après un court délai
  setTimeout(observeModalChanges, 1000);
  
  // Surveille l'objet prestashop global pour les changements de panier
  if (typeof prestashop !== 'undefined') {
    let lastCartTotal = 0;
    let lastProductsCount = 0;
    
    setInterval(() => {
      try {
        if (prestashop.cart) {
          const currentTotal = prestashop.cart.totals?.total?.amount || 0;
          const currentCount = prestashop.cart.products_count || 0;
          
          if (currentTotal !== lastCartTotal || currentCount !== lastProductsCount) {
            lastCartTotal = currentTotal;
            lastProductsCount = currentCount;
            updateHandler();
          }
        }
      } catch (e) {
        // Ignore les erreurs
      }
    }, 1000); // Vérification toutes les secondes
  }
});
</script>
