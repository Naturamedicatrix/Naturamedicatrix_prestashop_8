{**
** CUSTOM HEADER 
 *}
{block name='header_banner'}
  <div class="header-banner text-carousel-banner">
    <div class="container">
      <div class="banner-wrapper">
        <!-- CAROUSEL TEXT avec sélecteur de langue à l'intérieur -->
        <div class="text-carousel-container">
          <!-- Flèche gauche -->
          <button id="carousel-prev" class="carousel-nav-button">
            &lt;
          </button>

          <!-- CONTENU DU TEXT CAROUSEL -->
          <div id="text-carousel">
            <div class="carousel-item active"><span class="highlight-text">Livraison offerte</span> apd 35€ en Point
              Relais & 50€ à domicile</div>
            <div class="carousel-item inactive">Paiement 100% sécurisé</div>
            <div class="carousel-item inactive">Service client disponible du lundi au vendredi</div>
          </div>

          <!-- Flèche droite -->
          <button id="carousel-next" class="carousel-nav-button">
            &gt;
          </button>
        </div>

        <!-- Language selector directement dans la bannière -->
        {hook h='displayLanguageSelector'}
      </div>
      {hook h='displayBanner'}
    </div>
  </div>
{/block}

{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
      <div class="row">
        <div class="hidden-sm-down">
          <!-- Contact à gauche -->
          <div class="col-md-3 col-xs-12">
            {hook h='displayNav1'}
          </div>

          <!-- Logo -->
          <div class="col-md-6" id="_desktop_logo">
            {if $shop.logo_details}
              {if $page.page_name == 'index'}
                <h1>
                  {renderLogo}
                </h1>
              {else}
                {renderLogo}
              {/if}
            {/if}
          </div>

          <!-- Mon compte à droite -->
          <div class="col-md-3 right-nav">
            {hook h='displayNav2'}
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="mobile-header-container">
            <div class="mobile-logo" id="_mobile_logo"></div>
            <div class="mobile-nav-icons">
              <!-- Remplacer les conteneurs par des liens directs -->
              <div class="mobile-user-icon">
                <a href="{$urls.pages.my_account}">
                  <i class="material-icons account-icon">person_outline</i>
                </a>
              </div>
              <div class="mobile-cart-icon">
                <a href="{$urls.pages.cart}">
                  <i class="material-icons shopping-cart-icon">shopping_cart</i>
                  {if $cart.products_count > 0}
                    <span class="cart-products-count">{$cart.products_count}</span>
                  {/if}
                </a>
              </div>
              <div id="menu-icon">
                <i class="material-icons d-inline">menu</i>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </nav>
{/block}

{block name='header_top'}
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="header-top-right col-md-12 col-sm-12 position-static">
          {hook h='displayTop'}
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