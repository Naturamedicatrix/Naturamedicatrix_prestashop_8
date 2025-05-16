{*
** CUSTOM EMAIL SUBSCRIPTION
 *}

<div class="email_subscription block_newsletter" id="blockEmailSubscription_{$hookName}">

  <div class="newsletter-container">
    <div class="newsletter-title">
      <i class="bi bi-envelope-paper-heart newsletter-icon"></i>
      <h4>{l s='Abonnez-vous à la newsletter et profitez d\'offres exclusives' d='Modules.Emailsubscription.Shop'}</h4>
    </div>
    
    {if $msg}
      <p class="notification {if $nw_error}notification-error{else}notification-success{/if}">{$msg}</p>
    {/if}
    
    {* Vérification si l'utilisateur est connecté et déjà abonné *}
    {if $customer.is_logged && isset($customer.newsletter) && $customer.newsletter == 1}
      <p class="alert alert-success">{l s='Vous êtes déjà abonné à notre newsletter' d='Modules.Emailsubscription.Shop'}</p>
    {else}
      <form action="{$urls.current_url}#blockEmailSubscription_{$hookName}" method="post">
        <div class="newsletter-form-wrapper">
          <input 
            type="email" 
            name="email" 
            value="{if $customer.is_logged}{$customer.email}{else}{$value}{/if}" 
            placeholder="{l s='Email' d='Modules.Emailsubscription.Shop'}" 
            required 
            class="newsletter-input"
            {if $customer.is_logged}readonly{/if}
          />
          <button 
            type="submit" 
            name="submitNewsletter" 
            class="newsletter-submit-btn btn btn-primary"
          >
            {l s='Valider' d='Modules.Emailsubscription.Shop'}
          </button>
        </div>
        
        <p class="newsletter-privacy-text">
          {l s='Votre vie privée est respectée. Vos informations ne seront jamais partagées.' d='Modules.Emailsubscription.Shop'}
        </p>
        
        <input type="hidden" value="{$hookName}" name="blockHookName" />
        <input type="hidden" name="action" value="0" />
      </form>
    {/if}
  </div>
</div>
