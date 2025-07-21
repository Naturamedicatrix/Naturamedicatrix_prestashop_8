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
  <div class="shipping-progress-block mt-2 mb-2">
    {* Extraction du montant total (sans la devise) *}
    {assign var="cartTotalValue" value=$cart.totals.total.value}
    {assign var="totalTextClean" value=$cartTotalValue|replace:' ':''}
    {assign var="totalTextDot" value=$totalTextClean|replace:',':'.'}
    {assign var="totalText" value=$totalTextDot|floatval}
    
    {* Points de seuil pour la livraison gratuite *}
    {assign var="relayThreshold" value=35}
    {assign var="homeThreshold" value=50}
    
    {* Premier seuil: Point Relais *}
    {if $totalText < $relayThreshold}
      {* Calcul du montant restant et du pourcentage *}
      {assign var="remainingRelay" value=$relayThreshold - $totalText}
      {assign var="relayPercent" value=($totalText / $relayThreshold * 100)|intval}
      
      <div class="shipping-progress-title flex justify-between mb-1">
        <span class="text-sm font-medium">Livraison en Point Relais</span>
        <span class="text-sm font-medium">{$totalText|string_format:"%.2f"}€ / {$relayThreshold}€</span>
      </div>
      <div class="shipping-progress-bar w-full h-2.5 bg-gray-200 rounded-full">
        <div class="h-2.5 bg-green-500 rounded-full" style="width: {$relayPercent}%"></div>
      </div>
      <p class="text-sm mt-1 font-medium text-gray-700">Il vous reste {$remainingRelay|string_format:"%.2f"}€ pour avoir la livraison offerte en Point Relais</p>
    
    {* Atteint le seuil de Point Relais mais pas encore celui de livraison à domicile *}
    {elseif $totalText < $homeThreshold}
      {* Affichage du seuil Point Relais atteint *}
      <div class="shipping-progress-relay-success mb-2 p-4 bg-green-100 border-l-4 border-green-500 rounded">
        <div class="flex items-start">
          <div class="flex-shrink-0 mr-2 mt-0.5">
            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
          </div>
          <p class="text-sm font-medium text-green-700 mb-0">Livraison offerte en Point Relais !</p>
        </div>
      </div>
      
      {* Calcul du montant restant et du pourcentage pour la livraison à domicile *}
      {assign var="remainingHome" value=$homeThreshold - $totalText}
      {assign var="homePercent" value=($totalText / $homeThreshold * 100)|intval}
      
      <div class="shipping-progress-title flex justify-between mb-1">
        <span class="text-sm font-medium">Livraison à domicile</span>
        <span class="text-sm font-medium">{$totalText|string_format:"%.2f"}€ / {$homeThreshold}€</span>
      </div>
      <div class="shipping-progress-bar w-full h-2.5 bg-gray-200 rounded-full">
        <div class="h-2.5 bg-blue-500 rounded-full" style="width: {$homePercent}%"></div>
      </div>
      <p class="text-sm mt-1 font-medium text-gray-700">Il vous reste {$remainingHome|string_format:"%.2f"}€ pour avoir la livraison offerte à domicile</p>
    
    {* Les deux seuils sont atteints *}
    {else}
      <div class="shipping-progress-success p-4 bg-green-100 border-l-4 border-green-500 rounded">
        <div class="flex items-start">
          <div class="flex-shrink-0 mr-2 mt-0.5">
            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
          </div>
          <div>
            <p class="text-base font-medium text-green-700 leading-tight">Félicitations !</p>
            <p class="text-sm font-medium text-green-700 leading-tight mb-0">Livraison offerte en Point Relais et à domicile</p>
          </div>
        </div>
      </div>
    {/if}
  </div>
  
  <hr />
  
  {* Livraison offerte *}
  <div class="advantage-block mt-0 mb-0">
    <div class="advantage-icon text-center">
      <i class="bi bi-truck icon-special"></i>
    </div>
    <div class="advantage-content text-center">
      <h5 class="mb-0 pt-0 mt-0">Livraison offerte</h5>
      <div class="advantage-texte pt-0">
        <p class="mb-0">35€ en Point Relais</p>
        <p class="mb-0">50€ à domicile</p>
      </div>
    </div>
  </div>

  <hr/>

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
  
  {* Script pour surveiller le total du panier en temps réel *}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Variable pour stocker la dernière valeur du total détectée
      let lastDetectedTotal = null;
      
      // Seuils de livraison gratuite
      const RELAY_THRESHOLD = 35;
      const HOME_THRESHOLD = 50;
      
      // Fonction pour extraire la valeur numérique du total du panier et mettre à jour l'interface
      function extractCartTotal() {
        const totalElements = document.querySelectorAll('.cart-total .value');
        
        if (totalElements && totalElements.length > 0) {
          const totalText = totalElements[0].textContent.trim();
          const numericTotal = parseFloat(totalText.replace(/[^0-9,\.]/g, '').replace(',', '.'));
          
          // Ne mettre à jour que si la valeur a changé
          if (numericTotal !== lastDetectedTotal) {
            console.log('Total du panier mis à jour:', numericTotal + '€');
            lastDetectedTotal = numericTotal;
            
            // Mise à jour des barres de progression et messages
            updateShippingProgress(numericTotal);
          }
          
          return numericTotal;
        }
        return null;
      }
      
      // Fonction pour mettre à jour les barres de progression et messages
      function updateShippingProgress(total) {
        // Cas 1: Moins de 35€ - Progression vers la livraison gratuite en Point Relais
        // Cas 2: Entre 35€ et 50€ - Livraison Point Relais gratuite, progression vers livraison à domicile
        // Cas 3: 50€ et plus - Les deux livraisons sont gratuites
        
        // Seuil de livraison en point relais et à domicile
        const RELAY_THRESHOLD = 35;
        const HOME_THRESHOLD = 50;
        
        // Récupération des éléments du DOM
        const shippingBlock = document.querySelector('.shipping-progress-block');
        const relaySuccessBlock = document.querySelector('.shipping-progress-relay-success');
        const bothSuccessBlock = document.querySelector('.shipping-progress-success');

        if (!shippingBlock) {
          console.error('Bloc de progression de livraison non trouvé');
          return;
        }
        
        // Gestion des différents cas en fonction du montant du panier
        if (total >= HOME_THRESHOLD) {
          // Cas 3: Les deux seuils sont atteints
          if (bothSuccessBlock) {
            bothSuccessBlock.style.display = 'block';
          }
          
          // Masquer les éléments non pertinents
          if (relaySuccessBlock) relaySuccessBlock.style.display = 'none';
          
          // Masquer tous les éléments de progression
          const progressElements = shippingBlock.querySelectorAll('.shipping-progress-title, .shipping-progress-bar, p.text-sm.mt-1');
          progressElements.forEach(el => {
            if (el) el.style.display = 'none';
          });
          
        } else if (total >= RELAY_THRESHOLD && total < HOME_THRESHOLD) {
          // Cas 2: Seuil Point Relais atteint, progression vers livraison à domicile
          
          // Afficher le message de succès pour Point Relais
          if (relaySuccessBlock) {
            relaySuccessBlock.style.display = 'block';
          }
          
          // Masquer le message pour les deux seuils atteints
          if (bothSuccessBlock) bothSuccessBlock.style.display = 'none';
          
          // Mise à jour des barres de progression pour la livraison à domicile
          const remainingHome = HOME_THRESHOLD - total;
          const homePercent = Math.min(Math.round((total / HOME_THRESHOLD) * 100), 100);
          
          // Mise à jour des éléments de l'interface pour la livraison à domicile
          const progressTitle = shippingBlock.querySelector('.shipping-progress-title span:last-child');
          const progressBar = shippingBlock.querySelector('.shipping-progress-bar div');
          const progressText = shippingBlock.querySelector('p.text-sm.mt-1');
          
          if (progressTitle) progressTitle.textContent = total.toFixed(2) + '€ / ' + HOME_THRESHOLD + '€';
          if (progressBar) progressBar.style.width = homePercent + '%';
          if (progressText) progressText.textContent = 'Il vous reste ' + remainingHome.toFixed(2) + '€ pour avoir la livraison offerte à domicile';
          
        } else {
          // Cas 1: Progression vers le premier seuil (Point Relais)
          
          // Masquer les messages de succès
          if (relaySuccessBlock) relaySuccessBlock.style.display = 'none';
          if (bothSuccessBlock) bothSuccessBlock.style.display = 'none';
          
          // Mise à jour des éléments pour Point Relais
          const remainingRelay = RELAY_THRESHOLD - total;
          const relayPercent = Math.min(Math.round((total / RELAY_THRESHOLD) * 100), 100);
          
          // Mise à jour des éléments de l'interface pour Point Relais
          const progressTitle = shippingBlock.querySelector('.shipping-progress-title span:last-child');
          const progressBar = shippingBlock.querySelector('.shipping-progress-bar div');
          const progressText = shippingBlock.querySelector('p.text-sm.mt-1');
          
          if (progressTitle) progressTitle.textContent = total.toFixed(2) + '€ / ' + RELAY_THRESHOLD + '€';
          if (progressBar) progressBar.style.width = relayPercent + '%';
          if (progressText) progressText.textContent = 'Il vous reste ' + remainingRelay.toFixed(2) + '€ pour avoir la livraison offerte en Point Relais';
        }
      }

      // Configuration du MutationObserver pour détecter les changements
      const observer = new MutationObserver(extractCartTotal);
      
      // Observer les éléments clés du panier
      const elements = [
        document.querySelector('.cart-container'),
        document.querySelector('.cart-summary')
      ];
      
      elements.forEach(function(el) {
        if (el) observer.observe(el, { childList: true, subtree: true, characterData: true });
      });
      
      // Première extraction au chargement de la page
      extractCartTotal();
      
      // Écouter les événements PrestaShop
      if (window.prestashop) {
        ['updateCart', 'updatedCart', 'updateProduct', 'updatedProduct'].forEach(function(eventName) {
          document.addEventListener(eventName, function() {
            // Utiliser un délai pour laisser le DOM se mettre à jour
            setTimeout(extractCartTotal, 100);
          });
        });
      }
    });
  </script>
</div>
