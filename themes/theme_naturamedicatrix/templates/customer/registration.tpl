{**
 * CUSTOM PAGE REGISTRATION
 *}
{extends file='page.tpl'}

{block name='breadcrumb'}{/block}

{block name='page_header_container'}{/block}

{block name='page_title'}
  {l s='Create an account' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
  {block name='register_form_container'}
    <div id="registration-page">
      <div class="registration-columns">
        <div class="registration-column left-column">
          <h2 class="text-center font-light text-3xl">{l s='Créer votre compte' d='Shop.Theme.Customeraccount'}</h2>
          <section class="register-form">
            {$hook_create_account_top nofilter}
            {render file='customer/_partials/customer-form.tpl' ui=$register_form}
          </section>
        </div>
        
        <div class="registration-column right-column">
          <h2 class="text-center font-light text-3xl">{l s='Already have an account?' d='Shop.Theme.Customeraccount'}</h2>
          <div class="login-info">
            <p>Vous avez déjà un compte client chez nous ? Connectez-vous pour accéder à tous les services de notre boutique en ligne :</p>
            <ul class="text-gray-600">
              <li>Achat rapide et simplifié</li>
              <li>Suivi de ma commande</li>
              <li>Historique de mes achats</li>
            </ul>
            <div class="login-button">
              <a href="{$urls.pages.authentication}" class="btn primary-btn" data-link-action="display-login-form">
                {l s='Log in instead!' d='Shop.Theme.Customeraccount'}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  {/block}
{/block}
