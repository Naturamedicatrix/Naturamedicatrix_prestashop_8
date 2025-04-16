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
        <div class="login-column left-column">
          <h2>{l s='Already have an account?' d='Shop.Theme.Customeraccount'}</h2>
          <section class="login-form">
            {render file='customer/_partials/login-form.tpl' ui=$login_form}
          </section>
          {block name='display_after_login_form'}
            {hook h='displayCustomerLoginFormAfter'}
          {/block}
        </div>
        
        <div class="login-column right-column">
          <h2>{l s='New customer?' d='Shop.Theme.Customeraccount'}</h2>
          <div class="register-info">
            <p>{l s='Creating an account offers many benefits:' d='Shop.Theme.Customeraccount'}</p>
            <ul>
              <li>{l s='Faster checkout process' d='Shop.Theme.Customeraccount'}</li>
              <li>{l s='Save multiple shipping addresses' d='Shop.Theme.Customeraccount'}</li>
              <li>{l s='Access your order history' d='Shop.Theme.Customeraccount'}</li>
              <li>{l s='Track new orders' d='Shop.Theme.Customeraccount'}</li>
            </ul>
            <div class="create-account-button">
              <a href="{$urls.pages.register}" class="primary-btn" data-link-action="display-register-form">
                {l s='Create an account' d='Shop.Theme.Customeraccount'}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  {/block}
{/block}