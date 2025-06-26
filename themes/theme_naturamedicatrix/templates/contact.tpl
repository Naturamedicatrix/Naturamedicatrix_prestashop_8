{**
* CUSTOM PAGE CONTACT
 *}
{extends file='page.tpl'}

{block name='page_header_container'}
  <header class="page-header">
    <h1 class="page-title">{$page.meta.title}</h1>
    <div class="title-separator">
      <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
        <path class="logo-title"
          d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
      </svg>
    </div>
  </header>
{/block}

{if $layout === 'layouts/layout-left-column.tpl'}
  {block name="left_column"}
    <div id="left-column" class="col-xs-12 col-md-4 col-lg-3">
      {hook h='displayContactLeftColumn'}
    </div>
  {/block}
{else if $layout === 'layouts/layout-right-column.tpl'}
  {block name="right_column"}
    <div id="right-column" class="side-column col-xs-12 col-md-5 col-lg-4">
      <div class="side-block support-client">
        <div class="icon-container">
          <i class="bi bi-chat-heart"></i>
        </div>
        <h3>{l s='Support clients' d='Shop.Theme.Global'}</h3>
        <p>{l s='Du lundi au vendredi de 9h à 16h' d='Shop.Theme.Global'}</p>
        <div class="contact-info">
          <div class="country-block">
          🇫🇷
            <p class="country-name">{l s='France & reste du monde' d='Shop.Theme.Global'}</p>
            <p class="phone-number">09 77 42 37 04</p>
          </div>
          
          <div class="country-block">
          🇧🇪
            <p class="country-name">{l s='Belgique' d='Shop.Theme.Global'}</p>
            <p class="phone-number">+32 42 90 00 79</p>
          </div>
          
          <div class="country-block">
            🇱🇺
            <p class="country-name">{l s='Luxembourg' d='Shop.Theme.Global'}</p>
            <p class="phone-number">+352 27 86 11 39</p>
          </div>
        </div>
        
        <div class="side-block address-section">
          <div class="icon-container">
            <i class="bi bi-house-heart"></i>
          </div>
          <h3>{l s='Adresses' d='Shop.Theme.Global'}</h3>
          
          <div class="address-block">
            <h4>{l s='Maison mère - Siège social' d='Shop.Theme.Global'}</h4>
            <p>22, route des Fagnes</p>
            <p>4190 Ferrières, Belgique</p>
          </div>
          
          <div class="address-block">
            <h4>{l s='Nos bureaux' d='Shop.Theme.Global'}</h4>
            <p>8, Hannert dem Duarref</p>
            <p>L-9772 Troine (Wincrange)</p>
            <p>{l s='Grand-Duché de Luxembourg' d='Shop.Theme.Global'}</p>
          </div>
        </div>
        
        <div class="side-block our-store">
          <div class="icon-container">
            <i class="bi bi-building"></i>
          </div>
          <h3>{l s='Notre magasin' d='Shop.Theme.Global'}</h3>
          
          <p>26 avenue Émile Digneffe,</p>
          <p>4000 Liège, Belgique</p>
        </div>
      </div>        
    </div>
  {/block}
{/if}

{block name='page_content'}
  {hook h='displayContactContent'}
  {include file='_partials/therap.tpl'}
{/block}
