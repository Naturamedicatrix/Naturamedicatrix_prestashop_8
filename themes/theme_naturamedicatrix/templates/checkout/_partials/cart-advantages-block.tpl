{* Bloc des avantages clients *}
<div class="cart-advantages mt-8">
{*
  <div class="cart-advantage-title text-center mb-2">
    <h4 class="text-center">Vos avantages</h4>
    <div class="title-separator">
      <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
        <path class="logo-title"
          d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
      </svg>
    </div>
  </div>

  <hr />
*}

<hr />

  {* Bloc dynamique de progression pour la livraison offerte *}
  {* Valeurs initiales pour l'affichage au chargement de la page *}
  {assign var="cartTotalValue" value=$cart.subtotals.products.value}
  {assign var="totalTextClean" value=$cartTotalValue|replace:' ':''}
  {assign var="totalTextDot" value=$totalTextClean|replace:',':'.'}
  {assign var="totalText" value=$totalTextDot|floatval}
  {assign var="relayThreshold" value=35}
  {assign var="homeThreshold" value=50}
  
  <div id="shipping-progress-container">
    {* CONTENU DYNAMIQUE EN JS *}
    <div id="shipping-progress-dynamic"></div>
  </div>
  
  <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    const relayThreshold = {$relayThreshold};
    const homeThreshold = {$homeThreshold};
    const minThreshold = 20; // Montant minimum pour afficher la barre de progression
    
    // Traductions
    const translations = {
      relayTitle: '{l s='Livraison en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeTitle: '{l s='Livraison \u00e0 domicile' d='Shop.Theme.Checkout' js=1}',
      relayRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte \u00e0 domicile' d='Shop.Theme.Checkout' js=1}',
      relaySuccess: '{l s='Bravo, livraison offerte en Point Relais !' d='Shop.Theme.Checkout' js=1}',
      bothSuccess: '{l s='Bravo, livraison offerte en Point Relais ou \u00e0 domicile' d='Shop.Theme.Checkout' js=1}',
      freeShipping: '{l s='Livraison offerte' d='Shop.Theme.Checkout' js=1}',
      relayPrice: '{l s='35\u20ac en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homePrice: '{l s='50\u20ac \u00e0 domicile' d='Shop.Theme.Checkout' js=1}'     
    };
    
    // Récupère le montant actuel des produits du panier
    function getCartProductsTotal() {
      try {
        // On essaie d'abord de prendre le total des produits dans la variable prestashop
        if (typeof prestashop !== 'undefined' && 
            prestashop.cart && 
            prestashop.cart.subtotals && 
            prestashop.cart.subtotals.products) {
          let value = prestashop.cart.subtotals.products.value;
          if (typeof value === 'string') {
            // Nettoie la valeur
            value = value.replace(/\s+/g, '').replace(',', '.');
            return parseFloat(value);
          } else if (typeof value === 'number') {
            return value;
          }
        }
        // Fallback au total initial chargé avec la page
        return {$totalText};
      } catch (e) {
        return {$totalText};
      }
    }
    
    // HTLM PROGRESS BAR
    function createProgressBar(currentValue, threshold, percent) {
{literal}
      return `
        <div class="shipping-progress-title flex justify-between mb-1">
          <span class="text-sm font-medium">${currentValue < threshold ? translations.relayTitle : translations.homeTitle}</span>
          <span class="text-sm font-medium">${currentValue.toFixed(2)}€ / ${threshold}€</span>
        </div>
        <div class="shipping-progress-bar w-full h-2.5 bg-gray-200 rounded-full">
          <div class="h-2.5 bg-green-500 rounded-full" style="width: ${percent}%"></div>
        </div>
      `;
{/literal}
    }
    
    // Crée le bloc de livraison offerte statique pour les paniers < 20€
    function createStaticShippingBlock() {
{literal}
      return `
        <div class="advantage-block mt-0 mb-0">
          <div class="advantage-icon text-center">
            <i class="bi bi-truck icon-special"></i>
          </div>
          <div class="advantage-content text-center">
            <h5 class="mb-0 pt-0 mt-0">${translations.freeShipping}</h5>
            <div class="advantage-texte pt-0">
              <p class="mb-0">${translations.relayPrice}</p>
              <p class="mb-0">${translations.homePrice}</p>
            </div>
          </div>
        </div>
        <hr />
      `;
{/literal}
    }
    
    // Met à jour l'affichage de la progression de livraison
    function updateShippingProgress() {
      const cartTotal = getCartProductsTotal();
      const container = document.getElementById('shipping-progress-dynamic');
      
      if (!container) return;
      
      let html = '';
      
      // Affichage différent selon le montant du panier
      if (cartTotal < minThreshold) {
        // Panier < 20€ : afficher le bloc statique
        html = createStaticShippingBlock();
      } else {
        // Panier >= 20€ : afficher la barre de progression
        html = '<div class="shipping-progress-block mt-2 mb-2">';
        
        if (cartTotal < relayThreshold) {
          // Progression vers le seuil Point Relais
          const remaining = relayThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / relayThreshold * 100));
          
          html += createProgressBar(cartTotal, relayThreshold, percent);
{literal}
          html += `<p class="text-sm mt-1 font-medium">${translations.relayRemaining.replace('%amount%', remaining.toFixed(2))}</p>`;
{/literal}
        } 
        else if (cartTotal < homeThreshold) {
          // Seuil Point Relais atteint, progression vers livraison à domicile
{literal}
          html += `<p class="text-normal font-bold mb-4">${translations.relaySuccess}</p>`;
{/literal}
          
          const remaining = homeThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / homeThreshold * 100));
          
          html += createProgressBar(cartTotal, homeThreshold, percent);
{literal}
          html += `<p class="text-sm mt-1 font-medium">${translations.homeRemaining.replace('%amount%', remaining.toFixed(2))}</p>`;
{/literal}
        } 
        else {
          // Les deux seuils sont atteints
{literal}
          html += `<p class="text-normal font-bold mb-0">${translations.bothSuccess}</p>`;
{/literal}
        }
        
        html += '</div><hr />';
      }
      
      container.innerHTML = html;
    }
    
    // Initialise l'affichage au chargement
    updateShippingProgress();
    
    // Écoute TOUS les événements possibles liés au panier
    const cartEvents = [
      'prestashop.cart.updated',
      'updateCart',
      'updateCartQty',
      'updatedCart',
      'updateProduct',
      'updatedProduct',
      'cartUpdated',
      'cart.updated'
    ];
    
    cartEvents.forEach(eventName => {
      document.addEventListener(eventName, function(event) {
        setTimeout(updateShippingProgress, 300);
      });
    });
    
    // Écoute l'événement jQuery spécifique de PrestaShop (s'il est disponible)
    if (typeof $ !== 'undefined') {
      $(document).on('updateCart', function() {
        setTimeout(updateShippingProgress, 300);
      });
    }
    
    // Observer les changements DOM dans le panier
    const cartObserverConfig = { childList: true, subtree: true, attributes: true };
    const cartObserver = new MutationObserver(function(mutations) {
      // Vérifier si les mutations concernent le panier
      let shouldUpdate = false;
      for (const mutation of mutations) {
        if (mutation.target.closest('.cart-items') || 
            mutation.target.closest('.cart-summary') ||
            mutation.target.closest('.cart-detailed-totals')) {
          shouldUpdate = true;
          break;
        }
      };
      
      if (shouldUpdate) {
        setTimeout(updateShippingProgress, 300);
      }
    });
    
    // Démarrer l'observation du DOM du panier
    const cartContainer = document.querySelector('.cart-container');
    if (cartContainer) {
      cartObserver.observe(cartContainer, cartObserverConfig);
    }
    
    // Écouter les changements de quantité sur tous les inputs possibles
    const quantitySelectors = [
      '.cart-items input.js-cart-line-product-quantity',
      '.cart-items input.quantity_wanted',
      '.cart-items .js-increase-product-quantity',
      '.cart-items .js-decrease-product-quantity',
      '.cart-summary input[type="number"]',
      '.product-quantity input'
    ];
    
    quantitySelectors.forEach(selector => {
      const inputs = document.querySelectorAll(selector);
      if (inputs.length > 0) {
        inputs.forEach(input => {
          ['change', 'input', 'click'].forEach(eventType => {
            input.addEventListener(eventType, function() {
              setTimeout(updateShippingProgress, 300);
            });
          });
        });
      }
    });
    
    // S'assurer que les boutons +/- sont aussi écoutés
    document.addEventListener('click', function(event) {
      if (event.target.closest('.js-increase-product-quantity') ||
          event.target.closest('.js-decrease-product-quantity') ||
          event.target.closest('.cart-items button')) {
        setTimeout(updateShippingProgress, 500);
      }
    });
  });
  </script>

  {* Remises *}
  <div class="advantage-block mt-0 mb-0">
    <div class="advantage-content text-center">
      <h5 class="mb-0 pt-0 mt-0">Remise sur le total de la commande</h5>
      <div class="discount-blocks">
        <div class="discount-row">
          <div class="discount-block pt-0">
            <div class="discount-amount">-10%</div>
            <div class="discount-condition">àpd 150€</div>
          </div>
          <div class="discount-block pt-0">
            <div class="discount-amount">-5%</div>
            <div class="discount-condition">àpd 75€</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <hr/>

  {* Help *}
  <div class="help-block mt-2 mb-2">
    {include file='../../_partials/block_besoin_aide.tpl'}
  </div>
  
</div>
