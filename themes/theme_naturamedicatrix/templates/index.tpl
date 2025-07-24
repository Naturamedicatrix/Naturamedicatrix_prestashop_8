{**
 * Fichier : index.tpl
 * 
 * Description : Template principal pour la page d'accueil
 * Ce fichier étend le template original du thème parent et ajoute des fonctionnalités supplémentaires.
 *}
{extends file='page.tpl'}

{block name='page_content_container'}
  <section id="content" class="page-home">
    {block name='page_content_top'}{/block}
    
    {block name='page_content'}
      
      
      {hook h='displayTopColumn'}
      
      {* BLOCK DES GARANTIES *}
      {include file='_partials/guarantees-block.tpl'}
      {* END BLOCK DES GARANTIES *}
      
      {include file='_partials/home-banners.tpl'}
      
      
      
      {block name='hook_home'}
        {$HOOK_HOME nofilter}
      {/block}
      
      
     
     {* SLIDER DE BLOCK DES BRANDS *}
     {block name='brands-slider'}
      {include file='_partials/brands-slider.tpl'}
     {/block} 
     {* //END SLIDER DE BLOCK DES BRANDS *}

      {* SHOPIMIND INTERETS*}
      {* {block name='hook_shopimind_interets'}
        <div id="shopimind-interets"></div>
      {/block} *}
      
      {* BLOCK DES BRANDS *}
{*
      <div class="bg-wrapper mt-20 mb-20 brands-manufacturers-section">
        {block name='featured_brands_home'}
          <section class="container mx-auto">
            {block name='brand_header'}
              <header class="page-header mt-2">
                <h2 class="text-center text-lg md:text-2xl font-bold mb-0 mt-0">Nos marques et distributions</h2>
                <div class="title-separator">
                  <svg id="logoTitle" class="logo-h3" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
                    <path class="logo-title"
                    d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
                </svg>
              </div>
            </header>
          {/block}
          {include file='_partials/brands-main.tpl'}
          </section>
        {/block}
      </div>
*}
      {* END BLOCK DES BRANDS *}
      
      
      {* BLOCK INTRO NATURAMEDICATRIX *}
      {block name='intro_naturamedicatrix'}
        <div class="full-width-section">
          <section class="container mx-auto">
            {include file='_partials/intro_naturamedicatrix.tpl'}
          </section>
        </div>
      {/block}
      {* END BLOCK INTRO NATURAMEDICATRIX *}
      
    {/block}
  </section>
{/block}