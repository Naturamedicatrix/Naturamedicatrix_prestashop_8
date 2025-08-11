{* Bloc des avantages clients *}
<div class="cart-advantages mt-8">

<hr />

  {* Bloc dynamique de progression pour la livraison offerte *}
  {* Valeurs initiales pour l'affichage au chargement de la page *}
  {assign var="cartTotalValue" value=$cart.subtotals.products.value}
  {assign var="totalTextClean" value=$cartTotalValue|replace:' ':''}
  {assign var="totalTextDot" value=$totalTextClean|replace:',':'.'}
  {assign var="totalText" value=$totalTextDot|floatval}
  
  {assign var="relayThreshold" value=35}
  {assign var="homeThreshold" value=50}
  
  {* Récupération du code pays du client *}
  {assign var="customerCountry" value=""}
  {if $cart.address_delivery}
    {assign var="customerCountry" value=$cart.address_delivery.country_iso}
  {elseif $customer.addresses}
    {* Si pas d'adresse de livraison mais client connecté avec adresse *}
    {assign var="defaultAddress" value=$customer.addresses|reset}
    {if $defaultAddress.country_iso}
      {assign var="customerCountry" value=$defaultAddress.country_iso}
    {/if}
  {/if}
  
  {* URL vers la page des conditions de livraison *}
  {assign var="deliveryTermsUrl" value=$link->getCMSLink(3)|cat:"#livraison"}
  
  <div id="shipping-progress-container">
    {* CONTENU DYNAMIQUE EN JS *}
    <div id="shipping-progress-dynamic"></div>
  </div>
  
  <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    const relayThreshold = {$relayThreshold};
    const homeThreshold = {$homeThreshold};
    const minThreshold = 15;
    const customerCountry = "{$customerCountry|escape:'javascript'}";
    const relayEligibleCountries = ['FR', 'BE'];
    const homeEligibleCountries = ['FR', 'BE', 'LU'];
    const deliveryTermsUrl = "{$deliveryTermsUrl|escape:'javascript'}";
    
    // Traductions
    const translations = {
      relayTitle: '{l s='Livraison en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeTitle: '{l s='Livraison à domicile' d='Shop.Theme.Checkout' js=1}',
      relayRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homeRemaining: '{l s='Il vous reste %amount%\u20ac pour avoir la livraison offerte à domicile' d='Shop.Theme.Checkout' js=1}',
      relaySuccess: '{l s='Bravo, livraison offerte en Point Relais !' d='Shop.Theme.Checkout' js=1}',
      homeSuccess: '{l s='Bravo, livraison offerte à domicile !' d='Shop.Theme.Checkout' js=1}',
      bothSuccess: '{l s='Bravo, livraison offerte à domicile ou en Point Relais !' d='Shop.Theme.Checkout' js=1}',
      freeShipping: '{l s='Livraison offerte' d='Shop.Theme.Checkout' js=1}',
      relayPrice: '{l s='35\u20ac en Point Relais' d='Shop.Theme.Checkout' js=1}',
      homePrice: '{l s='50\u20ac à domicile' d='Shop.Theme.Checkout' js=1}',
      seeTerms: '{l s='Consultez nos conditions de livraison' d='Shop.Theme.Checkout' js=1}'
    };
    
    // Crée le bloc de livraison offerte statique
    function createStaticShippingBlock() {
{literal}
      return `
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
    }

    // Met à jour l'affichage du bloc livraison
    function updateShippingProgress() {
      const container = document.getElementById('shipping-progress-dynamic');
      if (!container) return;
      
      // Détection du panier vide
      const isEmptyCart = document.querySelector('.empty-cart') !== null;
      
      // Récupère le total produits
      let cartTotal = {$totalText};
      try {
        if (typeof prestashop !== 'undefined' && prestashop.cart?.subtotals?.products) {
          const rawValue = prestashop.cart.subtotals.products.value;
          cartTotal = parseFloat(rawValue.replace(/[^\d,.]/g, '').replace(',', '.'));
        }
      } catch (e) {}
      
      let html = '';
      const hasNoCountry = !customerCountry || customerCountry === '';
      const isRelayEligible = hasNoCountry || relayEligibleCountries.includes(customerCountry);
      const isHomeEligible = hasNoCountry || homeEligibleCountries.includes(customerCountry);
      
      // Si le panier est vide, petit ou le pays non éligible à aucun des deux
      if (isEmptyCart || cartTotal < minThreshold || (!isRelayEligible && !isHomeEligible)) {
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
        html = '<div class="shipping-progress-block mt-2 mb-2 max-w-md mx-auto">';
        
        // Gestion des seuils selon le pays et le montant
        if (isRelayEligible && cartTotal < relayThreshold) {
          // Pour FR, BE: Progression vers Point Relais
          const remaining = relayThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / relayThreshold * 100));
          
{literal}
          html += `
            <div class="shipping-progress-title flex justify-between mb-1">
              <span class="text-sm font-medium">${translations.relayTitle}</span>
              <span class="text-sm font-medium">${cartTotal.toFixed(2).replace('.', ',')}€ / ${relayThreshold}€</span>
            </div>
            <div class="shipping-progress-bar w-full h-2.5 bg-gray-300 rounded-full">
              <div class="h-2.5 bg-green-500 rounded-full" style="width: ${percent}%"></div>
            </div>
            <p class="text-sm mt-1 mb-0 font-medium">${translations.relayRemaining.replace('%amount%', `<strong>${remaining.toFixed(2).replace('.', ',')}</strong>`)}*</p>
            <p class="text-xs mt-2.5 text-gray-500 text-right"><a href="${deliveryTermsUrl}">* <u>${translations.seeTerms}</u></a></p>`;
{/literal}
        } 
        else if (isHomeEligible && cartTotal < homeThreshold) {
          // Pour FR, BE, LU: Progression vers livraison à domicile
          
          // Affiche message de succès Point Relais uniquement pour FR et BE
          if (isRelayEligible && cartTotal >= relayThreshold) {
{literal}
            html += `<p class="text-normal font-bold mb-4">${translations.relaySuccess}</p>`;
{/literal}
          }
          
          const remaining = homeThreshold - cartTotal;
          const percent = Math.min(100, Math.floor(cartTotal / homeThreshold * 100));
          
{literal}
          html += `
            <div class="shipping-progress-title flex justify-between mb-1">
              <span class="text-sm font-medium">${translations.homeTitle}</span>
              <span class="text-sm font-medium">${cartTotal.toFixed(2).replace('.', ',')}€ / ${homeThreshold}€</span>
            </div>
            <div class="shipping-progress-bar w-full h-2.5 bg-gray-300 rounded-full">
              <div class="h-2.5 bg-green-500 rounded-full" style="width: ${percent}%"></div>
            </div>
            <p class="text-sm mt-1 mb-0 font-medium">${translations.homeRemaining.replace('%amount%', `<strong>${remaining.toFixed(2).replace('.', ',')}</strong>`)}*</p>
            <p class="text-xs mt-2.5 text-gray-500 text-right"><a href="${deliveryTermsUrl}">* <u>${translations.seeTerms}</u></a></p>`;
{/literal}
        } else if (isHomeEligible && cartTotal >= homeThreshold) {
          // Les deux seuils atteints pour FR et BE, ou seuil domicile atteint pour LU
          // Message adapté selon que le client est éligible ou non au Point Relais
{literal}
          html += `
            <p class="text-normal font-bold mb-0">${isRelayEligible ? translations.bothSuccess : translations.homeSuccess}</p>
            <p class="text-xs mt-2.5 text-gray-500 text-right"><a href="${deliveryTermsUrl}">* <u>${translations.seeTerms}</u></a></p>`;
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
    
    // 1. Écouter les événements
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
          // Détecter les changements dans le panier (ajout/suppression de produits)
          if (m.target.closest('.cart-items, .cart-summary, .cart-detailed-totals')) {
            updateHandler();
            break;
          }
          // Détecter spécifiquement l'apparition/disparition de la classe empty-cart
          if (m.type === 'childList') {
            const hasEmptyCart = m.target.querySelector && m.target.querySelector('.empty-cart');
            const addedEmptyCart = Array.from(m.addedNodes).some(node => 
              node.nodeType === 1 && (node.classList?.contains('empty-cart') || node.querySelector?.('.empty-cart'))
            );
            if (hasEmptyCart || addedEmptyCart) {
              setTimeout(updateHandler, 100); // Short delay pour laisser le DOM se mettre à jour
              break;
            }
          }
        }
      }).observe(cartContainer, { childList: true, subtree: true, attributes: true });
    }
    
    // 5. Observer spécifiquement la zone du panier détaillé pour détecter empty-cart
    const cartOverview = document.querySelector('.cart-overview');
    if (cartOverview) {
      new MutationObserver(mutations => {
        mutations.forEach(m => {
          if (m.type === 'childList') {
            const emptyCartAdded = Array.from(m.addedNodes).some(node => 
              node.nodeType === 1 && (node.classList?.contains('empty-cart') || node.querySelector?.('.empty-cart'))
            );
            if (emptyCartAdded) {
              setTimeout(updateHandler, 150); // Délai plus long pour le panier vide
            }
          }
        });
      }).observe(cartOverview, { childList: true, subtree: true });
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
