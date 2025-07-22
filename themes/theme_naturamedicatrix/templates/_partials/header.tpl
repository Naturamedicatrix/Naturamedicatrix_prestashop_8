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
  <div class="header-banner text-carousel-banner bg-brand text-white text-sm">

    <!-- PANNEAU D'ACTUALITÉS -->
    {include file='_partials/header-actu.tpl'}

    <div class="container mx-auto">
      <div class="banner-wrapper flex items-center justify-between py-2.5 gap-4">
        
        <!-- colonne de gauche vide -->
        <div class="flex items-center w-160 justify-start"></div>

        <!-- CAROUSEL TEXT CLIQUABLE -->
        <div class="text-carousel-container w-full flex items-center justify-center" id="carousel-trigger">

          <!-- Texte défilant centré -->
          <div id="text-carousel" class="max-w-2xl w-full overflow-hidden whitespace-nowrap text-center relative">
            
            <!-- Flèche gauche -->
            <button id="carousel-prev" class="absolute left-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
              <i class="bi bi-arrow-left text-lg"></i>
            </button>
            
            <div class="carousel-item active inline-block animate-fade-in">
              <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">{l s='Livraison offerte' d='Shop.Theme.Global'}</span> {l s='àpd 35€ en Point Relais & 50€ à domicile' d='Shop.Theme.Global'}
            </div>
            <div class="carousel-item inactive hidden inline-block animate-fade-in">
              {l s='Remise sur le total de la commande : <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">-10% àpd 150€</span> | -5% àpd 75€' d='Shop.Theme.Global'}
            </div>
            <div class="carousel-item inactive hidden inline-block animate-fade-in">
              {l s='Payez en <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">2x 3x avec alma</span>' d='Shop.Theme.Global'}
            </div>
            
            
             <!-- Flèche droite -->
            <button id="carousel-next" class="absolute right-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
              <i class="bi bi-arrow-right text-lg"></i>
            </button>
            
          </div>

          

        </div>

        <!-- Langues / autres hooks à droite -->
         <div class="flex items-center w-160 justify-end">
          {hook h='displayNavFullWidth'}
          {hook h='displayLanguageSelector'}
        </div>
      </div>

      {hook h='displayBanner'}
    </div>
  </div>
{/block}







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
<nav class="header-nav bg-brand">
  <div class="container mx-auto">
    
    <!-- Desktop -->
    <div class="hidden-sm-down grid grid-cols-3 items-end pt-1 pb-2">
      <!-- Colonne gauche -->
      <div class="flex items-center gap-3 justify-start">
        <a href="{$urls.pages.contact}" class="flex items-center gap-2 text-white hover:text-gray-200 transition-colors duration-200 ease-in-out">
          <i class="bi bi-telephone text-2xl leading-none"></i>
          <div class="leading-tight">
            <div class="text-sm leading-tight opacity-90">Contactez-nous</div>
            {assign var='country_id' value=Tools::getCountry()}
            <div class="text-base leading-none font-semibold">
              {if $country_id == 3}
                +32&nbsp;42&nbsp;90&nbsp;00&nbsp;79
              {else}
                +33&nbsp;(0)9&nbsp;77&nbsp;42&nbsp;37&nbsp;04
              {/if}
            </div>
          </div>
        </a>
      </div>
    
      <!-- Colonne centre : logo -->
      <div class="flex justify-center items-center mx-auto" id="_desktop_logo">
        {if $shop.logo_details}
          {if $page.page_name == 'index'}
            <h1 class="m-0 w-[220px]">{renderLogo}</h1>
          {else}
            <div class="w-[220px]">{renderLogo}</div>
          {/if}
        {/if}
      </div>
    
      <!-- Colonne droite -->
      <div class="flex items-center justify-end gap-6">
        {hook h='displayNav2'}
      </div>
    </div>

    
    
  </div>
</nav>
{/block}


{block name='header_top'}
  <div class="header-top p-0">
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




<style>
  
  .header-banner .w-160 {
    width: 160px;
  }
  
  .header-banner .bg-pink-600 {
    background-color: #e45b7f;
  }
  #header .header-nav {
    max-height: inherit;
    border-bottom: none;
  }
  
  .header-nav .desktop-align {
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .header-nav #_desktop_logo {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 300px;
  }
  .header-nav #_desktop_logo img,
  .header-nav #_desktop_logo svg {
    max-width: 100%;
    height: auto;
  }
  
  .header-nav .hover\:text-gray-200:hover {
    color: #e5e7eb !important;
  }
  
  .cart-count {
    min-width: 20px;
    min-height: 20px;
    background-color: #e45b7f;
  }
  
  #header .header-nav .user-info {
    text-align: left;
  }
  
  
  #header .header-nav .blockcart {
    height: inherit;
    text-align: inherit;
    white-space: inherit;
    background: inherit;
    padding: inherit;
    margin-left: inherit;
  }
  
  
</style>