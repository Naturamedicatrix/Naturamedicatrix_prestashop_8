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
    
    <form action="{$urls.current_url}#blockEmailSubscription_{$hookName}" method="post">
      <div class="newsletter-form-wrapper">
        <input 
          type="email" 
          name="email" 
          value="{$value}" 
          placeholder="{l s='Email' d='Modules.Emailsubscription.Shop'}" 
          required 
          class="newsletter-input"
        />
        <button 
          type="submit" 
          name="submitNewsletter" 
          class="newsletter-submit-btn secondary-btn"
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
  </div>
</div>
