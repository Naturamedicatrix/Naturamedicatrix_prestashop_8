{*
 * Custom newsletter footer with rating and social icons
 *}
<div class="custom-footer-wrapper">
  <div class="footer-rating-block">
    <div class="rating-value">4,8<span class="rating-max">/5</span></div>
    <div class="rating-stars">
      <i class="material-icons star-full">star</i>
      <i class="material-icons star-full">star</i>
      <i class="material-icons star-full">star</i>
      <i class="material-icons star-full">star</i>
      <i class="material-icons star-half">star_half</i>
    </div>
  </div>
  
  <div class="newsletter-main-block">
    <div class="email_subscription block_newsletter" id="blockEmailSubscription_{$hookName}">
      <div class="newsletter-container">
        <div class="newsletter-title">
          <svg class="newsletter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="2" />
            <path d="M22 7l-10 7L2 7" />
          </svg>
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
              class="newsletter-submit-btn"
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
  </div>
  
  <div class="social-icons-block">
    <div class="social-title">{l s='Nos réseaux sociaux' d='Shop.Theme.Global'}</div>
    <div class="social-icons">
      <a href="https://www.facebook.com/your-facebook-page" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="https://www.instagram.com/your-instagram-page" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
      <a href="https://www.youtube.com/your-youtube-channel" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
        <i class="fa fa-youtube-play" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</div>
