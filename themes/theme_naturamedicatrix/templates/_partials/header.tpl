<style>
  .container-iqit-menu {
    padding: 0;
  }
  #header {
    z-index: 20;
  }  
</style>

{**
** CUSTOM HEADER 
 *}
{hook h='displayHeader'}
<!-- Styles et scripts pour l'effet de flou des sous-menus -->
<link rel="stylesheet" href="{$urls.base_url}modules/pm_advancedtopmenu/views/css/submenu-blur-effect.css">
<script type="text/javascript" src="{$urls.base_url}modules/pm_advancedtopmenu/views/js/submenu-blur-effect.js" defer></script>

<!-- Script pour le panneau d'actualités -->
<script type="text/javascript" src="{$urls.base_url}themes/theme_naturamedicatrix/assets/js/actus-panel.js" defer></script>
{block name='header_banner'}
  <div class="header-banner text-carousel-banner">
    <!-- PANNEAU D'ACTUALITÉS -->
    {include file='_partials/header-actu.tpl'}
    
    <div class="container">
      <div class="banner-wrapper">
        <!-- CAROUSEL TEXT CLIQUABLE-->
        <div class="text-carousel-container" id="carousel-trigger">
          <!-- Flèche gauche -->
          <button id="carousel-prev" class="carousel-nav-button">
          <i class="bi bi-arrow-left"></i>
          </button>

          <!-- CONTENU DU TEXT CAROUSEL -->
          <div id="text-carousel">
            <div class="carousel-item active">
              <span class="highlight-text">{l s='Livraison offerte' d='Shop.Theme.Global'}</span>
              {l s='àpd 35€ en Point Relais & 50€ à domicile' d='Shop.Theme.Global'}
            </div>
            <div class="carousel-item inactive">
              {l s='Remise sur le total de la commande : <span class="highlight-text">-10% àpd 150€</span> | -5% àpd 75€' d='Shop.Theme.Global'}
            </div>
            <div class="carousel-item inactive">
              {l s='Payez en <span class="highlight-text">2x 3x avec alma</span>' d='Shop.Theme.Global'}
            </div>
          </div>

          <!-- Flèche droite -->
          <button id="carousel-next" class="carousel-nav-button">
          <i class="bi bi-arrow-right"></i>
          </button>
        </div>
        
        {hook h='displayNavFullWidth'}

        <!-- Language selector -->
        {hook h='displayLanguageSelector'}
      </div>
      {hook h='displayBanner'}
    </div>
  </div>
{/block}


  </div> <!-- end header-banner text-carousel-banner -->



{*
{block name='header_nav'}
<div class="header-nav">
  <div class="container">
    <div class="row">
      <div class="flex items-center justify-between bg-green-400 px-4 py-2">
        <!-- Contact -->
        <div class="flex items-center space-x-2">
          <i class="bi bi-telephone text-lg text-white"></i>
          <div class="flex flex-col leading-tight">
            <span class="text-white text-sm font-semibold">Contactez-nous</span>
            {assign var='country_id' value=Tools::getCountry()}
            {if $country_id == 3}
              <span class="text-white text-xs opacity-80">+32&nbsp;42&nbsp;90&nbsp;00&nbsp;79</span>
            {else}
              <span class="text-white text-xs opacity-80">+33&nbsp;(0)9&nbsp;77&nbsp;42&nbsp;37&nbsp;04</span>
            {/if}
          </div>
        </div>
      
        <!-- Logo centré -->
        <div id="_desktop_logo">
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
        
      
        <!-- Mon compte + Panier -->
        <div class="flex items-center space-x-4">
          <div class="flex items-center space-x-2">
            <i class="bi bi-person text-lg text-white"></i>
            <div class="flex flex-col leading-tight">
              <span class="text-white text-sm font-semibold">Mon compte</span>
              <span class="text-white text-xs opacity-80">Se connecter</span>
            </div>
          </div>
      
          <div class="relative">
            <i class="bi bi-bag text-lg text-white"></i>
            <span class="absolute -top-1 -right-2 bg-pink-500 text-xs text-white rounded-full px-1">0</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}
*}





{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
      <div class="row">

        <div class="hidden-sm-down">
          <!-- Contact à gauche -->
          <div class="col-md-3 col-xs-12 nav-contact">
            {* {hook h='displayNav1'} *}
            <a href="{$urls.pages.contact}" class="contact-link">
              <i class="bi bi-telephone"></i>
              <div>
                <div class="font-bold">Contactez-nous</div>
                
                {assign var='country_id' value=Tools::getCountry()}
                
                {if $country_id == 3}                
                  <div>+32&nbsp;42&nbsp;90&nbsp;00&nbsp;79</div>
                {else}
                  <div>+33&nbsp;(0)9&nbsp;77&nbsp;42&nbsp;37&nbsp;04</div>
                {/if}
              </div>
            </a>
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

          <!-- Mon compte -->
          <div class="col-md-3 right-nav">
            {hook h='displayNav2'}
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="mobile-header-container">
            <div class="mobile-logo" id="_mobile_logo"></div>
            <div class="mobile-nav-icons">
              <div class="mobile-user-icon">
                <a href="{$urls.pages.my_account}">
                  <i class="material-icons account-icon">person_outline</i>
                </a>
              </div>
              <div class="mobile-cart-icon">
                <a href="{$link->getPageLink('cart', true, null, ['action' => 'show'])}">
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
        <div class="header-top-right col-md-12 col-sm-12 flex">
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
  
{/block}