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
    const minThreshold = 20;
    
    // Traductions
    const translations = {
      relayTitle: '{l s='Livraison en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeTitle: '{l s='Livraison à domicile' d='Shop.Theme.Checkout' js=1}',
      relayRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte à domicile' d='Shop.Theme.Checkout' js=1}',
      relaySuccess: '{l s='Bravo, livraison offerte en Point Relais !' d='Shop.Theme.Checkout' js=1}',
      bothSuccess: '{l s='Bravo, livraison offerte à domicile ou en Point Relais !' d='Shop.Theme.Checkout' js=1}',
      freeShipping: '{l s='Livraison offerte' d='Shop.Theme.Checkout' js=1}',
      relayPrice: '{l s='35\u20ac en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homePrice: '{l s='50\u20ac \u00e0 domicile' d='Shop.Theme.Checkout' js=1}'     
    };
    
    // Met à jour l'affichage du bloc livraison
    function updateShippingProgress() {
      const container = document.getElementById('shipping-progress-dynamic');
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

      // Génère le contenu approprié
      if (cartTotal < minThreshold) {
{literal}
        html = `
          <div class="advantage-block mt-0 mb-0">
            <div class="advantage-icon text-center"><i class="bi bi-truck icon-special"></i></div>
            <div class="advantage-content text-center">
              <h5 class="mb-0 pt-0 mt-0">${translations.freeShipping}</h5>
              <div class="advantage-texte pt-0">
                <p class="mb-0">${translations.relayPrice}</p>
                <p class="mb-0">${translations.homePrice}</p>
              </div>
            </div>
          </div>
          <hr />`;
{/literal}
      } else {
        html = '<div class="shipping-progress-block mt-2 mb-2">';
        
        if (cartTotal < relayThreshold) {
          // Progression vers Point Relais
          const remaining = relayThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / relayThreshold * 100));
          
{literal}
          html += `
            <div class="shipping-progress-title flex justify-between mb-1">
              <span class="text-sm font-medium">${translations.relayTitle}</span>
              <span class="text-sm font-medium">${cartTotal.toFixed(2)}€ / ${relayThreshold}€</span>
            </div>
            <div class="shipping-progress-bar w-full h-2.5 bg-gray-200 rounded-full">
              <div class="h-2.5 bg-green-500 rounded-full" style="width: ${percent}%"></div>
            </div>
            <p class="text-sm mt-1 font-medium">${translations.relayRemaining.replace('%amount%', remaining.toFixed(2))}</p>`;
{/literal}
        } 
        else if (cartTotal < homeThreshold) {
          // Point Relais atteint, progression vers livraison domicile
          const remaining = homeThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / homeThreshold * 100));
{literal}
          html += `
            <p class="text-normal font-bold mb-4">${translations.relaySuccess}</p>
            <div class="shipping-progress-title flex justify-between mb-1">
              <span class="text-sm font-medium">${translations.homeTitle}</span>
              <span class="text-sm font-medium">${cartTotal.toFixed(2)}€ / ${homeThreshold}€</span>
            </div>
            <div class="shipping-progress-bar w-full h-2.5 bg-gray-200 rounded-full">
              <div class="h-2.5 bg-green-500 rounded-full" style="width: ${percent}%"></div>
            </div>
            <p class="text-sm mt-1 font-medium">${translations.homeRemaining.replace('%amount%', remaining.toFixed(2))}</p>`;
{/literal}
        } else {
          // Les deux seuils atteints
{literal}
          html += `<p class="text-normal font-bold mb-0">${translations.bothSuccess}</p>`;
{/literal}
        }
        html += '</div><hr />';
      }
      container.innerHTML = html;
    }
    
    // Initialisation
    updateShippingProgress();
    
    // Détection des changements
    const updateHandler = () => setTimeout(updateShippingProgress, 300);
    
    // 1. Écouter les événements PrestaShop
    ['prestashop.cart.updated', 'updateCart', 'cart.updated'].forEach(evt => 
      document.addEventListener(evt, updateHandler));
    
    // 2. Support jQuery (versions plus anciennes)
    if (typeof $ !== 'undefined') $(document).on('updateCart', updateHandler);
    
    // 3. Écouter les clics sur les boutons de quantité
    document.addEventListener('click', function(e) {
      if (e.target.closest('.js-increase-product-quantity') ||
          e.target.closest('.js-decrease-product-quantity') ||
          e.target.closest('.cart-items button')) {
        setTimeout(updateShippingProgress, 500);
      }
    });
    
    // 4. Observer les modifications du DOM du panier
    const cartContainer = document.querySelector('.cart-container');
    if (cartContainer) {
      new MutationObserver(mutations => {
        for (const m of mutations) {
          if (m.target.closest('.cart-items, .cart-summary, .cart-detailed-totals')) {
            updateHandler();
            break;
          }
        }
      }).observe(cartContainer, { childList: true, subtree: true, attributes: true });
    }
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
