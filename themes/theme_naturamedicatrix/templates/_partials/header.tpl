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
{*     {include file='_partials/header-actu.tpl'} *}

    <div class="container mx-auto px-1.5 md:px-4">
      <div class="banner-wrapper flex items-center justify-center md:justify-between py-2.5 md:py-2.5 gap-1 md:gap-4">
        
        <!-- colonne de gauche vide -->
        <div class="hidden md:flex items-center w-8 md:w-160 justify-start"></div>

        <!-- Slider Header -->
        {include file='_partials/header-slider.tpl'}

        <!-- Langues / autres hooks à droite -->
         <div class="hidden md:flex items-center w-160 justify-end">
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
<nav class="header-nav bg-brand hidden md:block">
  <div class="container mx-auto">
    
    <!-- Desktop -->
    <div class="grid grid-cols-3 items-end pt-1 pb-2">
      <!-- Colonne gauche -->
      <div class="flex items-end gap-3 justify-start">
        <a href="{$urls.pages.contact}" class="flex items-end gap-2 text-white hover:text-gray-200 transition-colors duration-200 ease-in-out">
          <i class="bi bi-telephone text-2xl leading-0"></i>
          <div class="leading-tight">
            <div class="text-xs leading-tight opacity-90">Contactez-nous</div>
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
      <div class="flex justify-end items-center mx-auto" id="_desktop_logo">
        {if $shop.logo_details}
          {if $page.page_name == 'index'}
            <h1 class="m-0 w-[220px]">{renderLogo}</h1>
          {else}
            <div class="w-[220px]">{renderLogo}</div>
          {/if}
        {/if}
      </div>
    
      <!-- Colonne droite -->
      <div class="flex items-end justify-end gap-6">
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
        <div class="header-top-right flex container">          

           {hook h='displayTop'} 

        </div>
      </div>
{*
      <div id="mobile_top_menu_wrapper" class="row hidden-md-up" style="display:none;">
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
        <div class="js-top-menu-bottom">
          <div id="_mobile_currency_selector"></div>
          <div id="_mobile_language_selector"></div>
          <div id="_mobile_contact_link"></div>
        </div>
      </div>
*}
    </div>
  </div>
{/block}



{block name='header_top'}
<div class="header-mobile sticky top-0 z-50 bg-white border-b border-gray-200 md:hidden">
  <div class="flex items-center justify-between h-14 px-4">

    <div class="flex items-center gap-0">
      {hook h='displayIqitMenu'}
      <div id="search_query_top" class="search-block px-2.5 py-1.5">
        <i class="bi bi-search text-2xl leading-none"></i>
      </div>    
    </div>

    <div class="flex items-center">
      <a href="{$urls.base_url}">
        <div class="flex-1 text-gray-900 text-center text-2xl">NATURA<strong><em>Medicatrix</em></strong></div>
{*          <img src="{$urls.child_img_url}logo-naturamedicatrix.svg" alt="NATURAMedicatrix" class="h-8" /> *}
      </a>
    </div>

    <div class="flex items-center gap-0">
      {hook h='displayNav2'}
    </div>

  </div>
</div>
{/block}


<!-- Mobile Bottom Bar -->
<div id="mobile-bottom-bar" class="fixed bottom-0 left-0 right-0 z-50 bg-brand flex justify-around items-center py-2.5 text-gray-600 md:hidden">
  <a href="{$urls.pages.contact}" class="flex flex-col items-center justify-center">
    <i class="bi bi-telephone icon-special text-2xl"></i>
    <span class="font-semibold text-xs leading-tight">Service client</span>
  </a>
  <a href="{$urls.pages.my_account}" class="flex flex-col items-center justify-center">
    {if $customer.is_logged}
      <i class="bi bi-person-check icon-special text-2xl"></i>
      <span class="font-semibold text-xs leading-tight">{$customer.firstname} {$customer.lastname|truncate:2:"."}</span>
    {else}
      <i class="bi bi-person icon-special text-2xl"></i>
      <span class="font-semibold text-xs leading-tight">{l s='Log in' d='Shop.Theme.Actions'}</span>
    {/if}
  </a>
  <a href="{$link->getPageLink('cart', true, null, 'action=show')}" class="relative flex flex-col items-center justify-center">
      <i class="bi bi-handbag text-2xl"></i>
      {if $cart.products_count > 0}
        <span class="cart-badge absolute top-0 right-1.5 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
          {$cart.products_count}
        </span>
      {/if}
    <span class="font-semibold text-xs leading-tight">
      Mon panier
    </span>
  </a>
</div>




<style>
  
  .leading-0 {
    line-height: 0 !important;
  }
  
  .header-mobile i {
    color: #111827 !important;
    font-size: 1.5rem;
  }
  
  .header-mobile .bi-search {
    font-size: 1.15rem;
  }
  

  .header-mobile .user-info a,
  .header-mobile .blockcart-wrapper a,
  .header-mobile #search-block,
  .header-mobile #iqitmegamenu-mobile #iqitmegamenu-shower {
    padding: .275rem;
  }

  
  .header-mobile .user-info .infos {
    display: none;
  }
  
  
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
  

    /* BREAKPOINT POUR TABLETTE */
    @media (max-width: 768px) {
    .header-nav {
      display: none !important;
    }
    .header-mobile {
      display: block;
    }
    .header-top-right {
      display: none;
    }
  }
  /* END BREAKPOINT POUR TABLETTE */


  /* Mobile Bottom Bar */
  #mobile-bottom-bar {
    background: #cbdae5;
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
  }
  
  #mobile-bottom-bar.show {
    transform: translateY(0);
  }
  
  #mobile-bottom-bar .cart-badge {
    background-color: #e45b7f;
    z-index: -1;
  }
  
  #mobile-bottom-bar a {
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: none;
    text-decoration: none;
  }
  
  #mobile-bottom-bar .icon-special {
    margin-bottom: 2px;
  }
  /* END Mobile Bottom Bar */
</style>



<script>
// Intersection Observer pour afficher/masquer le mobile-bottom-bar
document.addEventListener('DOMContentLoaded', function() {
  const headerMobile = document.querySelector('.header-mobile');
  const mobileBottomBar = document.querySelector('#mobile-bottom-bar');
  
  if (headerMobile && mobileBottomBar) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Header mobile visible -> masquer la bottom bar
          mobileBottomBar.classList.remove('show');
        } else {
          // Header mobile non visible -> afficher la bottom bar
          mobileBottomBar.classList.add('show');
        }
      });
    }, {
      threshold: 0,
      rootMargin: '0px'
    });
    
    observer.observe(headerMobile);
  }
});
</script>