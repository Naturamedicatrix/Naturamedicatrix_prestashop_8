{**
** CUSTOM HEADER 
 *}
{block name='header_banner'}
  <div class="header-banner text-carousel-banner">
    <div class="container">
      <!-- CAROUSEL TEXT -->
      <div class="text-carousel-container">
        <!-- Flèche gauche -->
        <button id="carousel-prev" class="carousel-nav-button">
          &lt;
        </button>
        
        <!-- CONTENU DU TEXT CAROUSEL -->
        <div id="text-carousel">
          <div class="carousel-item active"><span class="highlight-text">Livraison offerte</span> apd 35€ en Point Relais & 50€ à domicile</div>
          <div class="carousel-item inactive">Paiement 100% sécurisé</div>
          <div class="carousel-item inactive">Service client disponible du lundi au vendredi</div>
        </div>
        
        <!-- Flèche droite -->
        <button id="carousel-next" class="carousel-nav-button">
          &gt;
        </button>
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
          <div class="col-md-5 col-xs-12">
            {hook h='displayNav1'}
          </div>
          <div class="col-md-7 right-nav">
            {hook h='displayNav2'}
          </div>
        </div>
        <div class="hidden-md-up text-sm-center mobile">
          <div class="float-xs-left" id="menu-icon">
            <i class="material-icons d-inline">&#xE5D2;</i>
          </div>
          <div class="float-xs-right" id="_mobile_cart"></div>
          <div class="float-xs-right" id="_mobile_user_info"></div>
          <div class="top-logo" id="_mobile_logo"></div>
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
        <div class="col-md-2 hidden-sm-down" id="_desktop_logo">
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
        <div class="header-top-right col-md-10 col-sm-12 position-static">
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