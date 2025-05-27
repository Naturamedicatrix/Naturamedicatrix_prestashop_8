{**
 * Fichier partiel pour afficher le bouton Commander et la checkbox des CGV dans la colonne de droite
 *}

<div class="js-cart-summary-checkout-button">
  <div id="checkout-steps-status" class="checkout-steps-status alert alert-warning">
    <i class="material-icons">info</i>
    <span>{l s='Veuillez remplir toutes les étapes avant de continuer' d='Shop.Theme.Checkout'}</span>
  </div>
  
  <div class="conditions-to-approve-container">
    <form id="conditions-to-approve-cart" class="js-conditions-to-approve alert alert-info" method="GET">
      <ul>
        <li>
          <div class="float-xs-left">
            <span class="custom-checkbox">
              <input id="conditions_to_approve_cart[terms-and-conditions]"
                     name="conditions_to_approve[terms-and-conditions]"
                     required
                     type="checkbox"
                     value="1"
                     class="ps-shown-by-js cart-summary-checkbox"
              >
              <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
            </span>
          </div>
          <div class="condition-label">
            <label class="js-terms" for="conditions_to_approve_cart[terms-and-conditions]">
              {l s="J'ai lu les" d="Shop.Theme.Checkout"} <a href="{$urls.pages.cms[3]}" target="_blank">{l s="conditions générales de vente" d="Shop.Theme.Checkout"}</a> {l s="et j'y adhère sans réserve." d="Shop.Theme.Checkout"}
            </label>
          </div>
        </li>
      </ul>
    </form>
  </div>
  
  <div id="cart-summary-checkout-confirmation" class="js-cart-summary-checkout-confirmation">
    <button type="submit" 
            class="btn btn-primary center-block js-cart-checkout-btn disabled"
            disabled>
      {l s='Commander' d='Shop.Theme.Checkout'}
    </button>
  </div>
</div>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    const originalCheckboxes = document.querySelectorAll('#conditions-to-approve input.original-checkbox');
    const cartSummaryCheckboxes = document.querySelectorAll('#conditions-to-approve-cart input.cart-summary-checkbox');
    const originalButton = document.querySelector('.original-checkout-button');
    const cartSummaryButton = document.querySelector('.js-cart-checkout-btn');
    const checkoutStepsStatus = document.getElementById('checkout-steps-status');
    
    // Vérifie si les CGV sont acceptées (soit dans la colonne de droite, soit dans l'étape de paiement)
    function areTermsAccepted() {
      // Vérifie d'abord les checkboxes originales
      let originalChecked = true;
      originalCheckboxes.forEach(function(checkbox) {
        if (!checkbox.checked) {
          originalChecked = false;
        }
      });
      
      // Vérifie ensuite la checkbox de la colonne de droite
      const summaryChecked = cartSummaryCheckboxes.length > 0 ? cartSummaryCheckboxes[0].checked : false;
      
      // Retourne true si l'une des deux est cochée
      return originalChecked || summaryChecked;
    }
    
    // Vérifie si une méthode de paiement est sélectionnée et si c'est Carte bancaire (option 3)
    function getPaymentMethodStatus() {
      const paymentMethod = document.querySelector('input[name="payment-option"]:checked');
      const isLyraCardPayment = paymentMethod && paymentMethod.id === 'payment-option-3';
      
      return {
        selected: paymentMethod !== null,
        isLyraCard: isLyraCardPayment
      };
    }
    
    // Met à jour l'indicateur d'état (alerte verte ou orange)
    function updateStatusIndicator() {
      if (!checkoutStepsStatus) return;
      
      const paymentStatus = getPaymentMethodStatus();
      
      if (paymentStatus.selected && !paymentStatus.isLyraCard) {
        // Pour les autres méthodes de paiement, on affiche l'alerte en vert
        checkoutStepsStatus.classList.remove('alert-warning');
        checkoutStepsStatus.classList.add('alert-success');
        checkoutStepsStatus.querySelector('i').textContent = 'check_circle';
        checkoutStepsStatus.querySelector('span').textContent = '{l s="Vous pouvez finaliser votre commande" d="Shop.Theme.Checkout" js=1}';
      } else {
        // Pour Carte bancaire ou aucune méthode sélectionnée, on garde l'alerte en orange
        checkoutStepsStatus.classList.remove('alert-success');
        checkoutStepsStatus.classList.add('alert-warning');
        checkoutStepsStatus.querySelector('i').textContent = 'info';
        checkoutStepsStatus.querySelector('span').textContent = '{l s="Veuillez remplir toutes les étapes avant de continuer" d="Shop.Theme.Checkout" js=1}';
      }
    }
    
    // Met à jour l'état du bouton Commander
    function updateButtonState() {
      if (!cartSummaryButton) return;
      
      const termsAccepted = areTermsAccepted();
      const paymentStatus = getPaymentMethodStatus();
      
      if (termsAccepted && paymentStatus.selected) {
        cartSummaryButton.classList.remove('disabled');
        cartSummaryButton.removeAttribute('disabled');
      } else {
        cartSummaryButton.classList.add('disabled');
        cartSummaryButton.setAttribute('disabled', 'disabled');
      }
      
      updateStatusIndicator();
    }

    updateButtonState();
    
    // Synchronisation des checkboxes (colonne droite -> originales)
    cartSummaryCheckboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        originalCheckboxes.forEach(function(originalCheckbox) {
          originalCheckbox.checked = checkbox.checked;
          originalCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
        });
        updateButtonState();
      });
    });
    
    // Synchronisation des checkboxes (originales -> colonne droite)
    originalCheckboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        cartSummaryCheckboxes.forEach(function(cartSummaryCheckbox) {
          cartSummaryCheckbox.checked = checkbox.checked;
        });
        updateButtonState();
      });
    });
    
    // Vérifie l'état du changement des btn
    document.querySelectorAll('input[name="payment-option"]').forEach(function(option) {
      option.addEventListener('change', updateButtonState);
    });
    
    // Action du bouton Commander dans la colonne de droite
    if (cartSummaryButton) {
      cartSummaryButton.addEventListener('click', function(event) {
        event.preventDefault();
        
        const termsAccepted = areTermsAccepted();
        const paymentStatus = getPaymentMethodStatus();
        
        if (termsAccepted && paymentStatus.selected) {
          if (originalButton) {
            originalButton.click();
          }
        } else {
          if (!termsAccepted) {
            alert('{l s="Veuillez accepter les conditions générales de vente" d="Shop.Theme.Checkout" js=1}');
          } else if (!paymentStatus.selected) {
            alert('{l s="Veuillez sélectionner une méthode de paiement" d="Shop.Theme.Checkout" js=1}');
          }
        }
      });
    }
  });
</script>
