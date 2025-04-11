{*
 * 2007-2020 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}

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
