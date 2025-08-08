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
        <div class="registration-column left-column p-0">
          <div class=" max-w-lg mx-auto">
            <h2 class="text-left font-bold text-3xl mb-2">{l s='Create account' d='Shop.Theme.Customeraccount'}</h2>
            <section class="register-form">
              {$hook_create_account_top nofilter}
              {render file='customer/_partials/customer-form.tpl' ui=$register_form}
            </section>
          </div>
        </div>
        
        <div class="registration-column right-column p-0">
          <div class="login-info max-w-md mx-auto">
            <h3 class="text-left font-bold text-2xl mb-2">{l s='Your advantages to be client' d='Shop.Theme.Customeraccount'}</h2>
            <ul class="text-gray-600 list-none pl-0 mt-2 text-base">
              <li class="mb-2.5 list-none"><i class="bi bi-gift icon-special text-gray-900 mr-1.5"></i> Offres et conseils personnalisés</li>
              <li class="mb-2.5 list-none"><i class="bi bi-box-seam icon-special text-gray-900 mr-1.5"></i> Commande rapide et simplifiée</li>
              <li class="mb-2.5 list-none"><i class="bi bi-search icon-special text-gray-900 mr-1.5"></i> Suivi facile de vos commandes</li>
              <li class="mb-2.5 list-none"><i class="bi bi-card-checklist icon-special text-gray-900 mr-1.5"></i> Historique de vos achats en un clin d’œil</li>
            </ul>
            <hr />
            <div class="login-button text-left">
              <h3 class="text-left font-bold text-2xl mb-1">{l s='Already have an account?' d='Shop.Theme.Customeraccount'}</h2>
              <a href="{$urls.pages.authentication}" class="btn btn-outline" data-link-action="display-login-form">
                {l s='Sign in' d='Shop.Theme.Customeraccount'}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  {/block}
{/block}
