{**
* CUSTOM PAGE CONTACT
 *}
{extends file='page.tpl'}

{block name='page_header_container'}
  <header class="page-header">
    
    <h1 class="page-title mb-1">{$page.meta.title}</h1>
    <p class="text-center">Une équipe à votre écoute pour vous accompagner et répondre à vos questions</p>
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
      <div class="text-center support-client space-y-10 py-12">
        <!-- Support client -->
        <div class="">
          
          <div class="icon-container">
            <i class="bi bi-chat-heart"></i>
          </div>
          
          <h3 class="text-center text-lg font-semibold mt-0">Support clients</h3>
          <p class="text-center text-sm text-gray-600 mt-0 mb-4">Du lundi au vendredi de 9h à 16h</p>
      
          <div class="space-y-4">
            <div>
              <p class="text-lg pb-0">🇫🇷</p>
              <p class="text-sm text-gray-600 pb-0">France & reste du monde</p>
              <p class="text-base font-semibold text-gray-900">09 77 42 37 04</p>
            </div>
            <div>
              <p class="text-lg pb-0">🇧🇪</p>
              <p class="text-sm text-gray-600 pb-0">Belgique</p>
              <p class="text-base font-semibold text-gray-900">+32 42 90 00 79</p>
            </div>
            <div>
              <p class="text-lg pb-0">🇱🇺</p>
              <p class="text-sm text-gray-600 pb-0">Luxembourg</p>
              <p class="text-base font-semibold text-gray-900">+352 27 86 11 39</p>
            </div>
          </div>
        </div>
      
        <!-- Adresses -->
        <div class="border-t pt-6">
          
          <div class="icon-container">
           <i class="bi bi-house-heart"></i>
          </div>
                
          <div class="text-sm text-gray-700 space-y-1">
            <h3 class="text-center text-lg font-semibold mt-0">Maison mère - Siège social</h4>
            <p class="text-sm text-gray-700 text-center mt-0">22, route des Fagnes<br/>4190 Ferrières, Belgique</p>
          </div>
      
          <div class="text-sm text-gray-700 space-y-1 mt-2">
            <h3 class="text-center text-lg font-semibold mt-0">Nos bureaux</h4>
            <p class="text-sm text-gray-700 text-center mt-0">8, Hannert dem Duarref<br/>L-9772 Troine (Wincrange)<br/>Grand-Duché de Luxembourg</p>
          </div>
        </div>
      
        <!-- Magasin -->
        <div class="space-y-4 border-t pt-6">
          
          <div class="icon-container">
            <i class="bi bi-building"></i>
          </div>
          <h3 class="text-center text-lg font-semibold mt-0">Notre magasin</h3>
          <p class="text-sm text-gray-700 text-center mt-0">
            26 avenue Émile Digneffe,<br/>
            4000 Liège, Belgique
          </p>
        </div>
      </div>

        
    </div>
  {/block}
{/if}

{block name='page_content'}
  {hook h='displayContactContent'}
  {include file='_partials/therap.tpl'}
{/block}
