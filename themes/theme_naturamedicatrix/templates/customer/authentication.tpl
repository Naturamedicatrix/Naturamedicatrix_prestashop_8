{**
 * CUSTOM PAGE AUTHENTICATION
 *}
{extends file='page.tpl'}

{block name='breadcrumb'}{/block}

{block name='page_header_container'}{/block}

{block name='page_title'}
  {l s='Log in to your account' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
  {block name='login_form_container'}
    <div id="login-page">
      <div class="login-columns">
        <div class="login-column left-column p-0">
          <div class="max-w-md mx-auto">
            <h2 class="text-center font-light text-3xl mb-2">{l s='Already have an account?' d='Shop.Theme.Customeraccount'}</h2>
            <section class="login-form mt-0">
              {render file='customer/_partials/login-form.tpl' ui=$login_form}
            </section>
            {block name='display_after_login_form'}
              {hook h='displayCustomerLoginFormAfter'}
            {/block}
          </div>
        </div>
        
        <div class="login-column right-column p-0">
          <div class="login-info max-w-md mx-auto">
            <h2 class="text-center font-light text-3xl mb-2">{l s='Create an account' d='Shop.Theme.Customeraccount'}</h2>
            <p class="text-base">Vous n’avez pas encore de compte client chez nous&nbsp;? Inscrivez-vous pour profiter de tous les services de notre boutique en ligne&nbsp;:</p>
            <ul class="text-gray-600 list-none pl-0 mt-2 text-base">
              <li class="mb-2.5"><i class="bi bi-box-seam icon-special text-gray-900 mr-1.5"></i> Achat rapide et simplifié</li>
              <li class="mb-2.5"><i class="bi bi-search icon-special text-gray-900 mr-1.5"></i> Suivi de ma commande</li>
              <li class="mb-2.5"><i class="bi bi-card-checklist icon-special text-gray-900 mr-1.5"></i> Historique de mes achats</li>
            </ul>
            <div class="create-account-button">
              <a href="{$urls.pages.register}" class="btn primary-btn" data-link-action="display-register-form">
                {l s='Create an account' d='Shop.Theme.Customeraccount'}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  {/block}
{/block}