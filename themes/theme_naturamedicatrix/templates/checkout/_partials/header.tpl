{**
* HEADER DE LA PAGE CHECKOUT
*}
{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center hidden-sm-down mt-4" id="_desktop_logo">
            {renderLogo}
        </div>
        <div class="col-md-12 text-center hidden-sm-down md:mt-4 xl:mt-0">
            <div class="secure-checkout-text">
              <i class="bi bi-lock"></i> 100% sécurisé
            </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
        <div class="col-md-12 text-center mt-4" id="_desktop_logo">
            {renderLogo}
        </div>
        <div class="col-md-12 text-center mt-4">
            <div class="secure-checkout-text">
              <i class="bi bi-lock"></i> 100% sécurisé
            </div>
        </div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top hidden-md-up">
    <div class="container">
        <div class="row">
        <div class="col-sm-12">
          <div class="row">
            {hook h='displayTop'}
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
        <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
        <div class="js-top-menu-bottom">
          <div id="_mobile_currency_selector"></div>
          <div id="_mobile_language_selector"></div>
          <div id="_mobile_contact_link"></div>
        </div>
      </div>
    </div>
  </div>
  {hook h='displayNavFullWidth'}
{/block}
