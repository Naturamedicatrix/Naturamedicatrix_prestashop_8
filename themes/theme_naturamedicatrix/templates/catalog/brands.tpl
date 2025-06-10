{**
 * Fichier : brands.tpl
 * 
 * Description : Template principal pour la page des marques
 * Ce fichier est responsable de l'affichage de la liste complète des marques sur la page dédiée.
 * Il étend le layout principal du site et définit la structure de base de la page.
 *}
{extends file=$layout}

{block name='content'}
  <section id="main">

    {block name='brand_header'}
      <header class="page-header">
        <h1 class="page-title">{l s='Brands' d='Shop.Theme.Catalog'}</h1>
        <div class="title-separator">
          <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
            <path class="logo-title"
              d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
          </svg>
        </div>
      </header>
    {/block}

    {* Bloc des 3 marques phares *}
    {block name='featured_brands'}
      {include file='_partials/brands-main.tpl'} 
    {/block}

    {* Liste complète des marques (excluant les marques stars) *}
    {block name='brand_miniature'}
      <div class="container brand-miniature">
        <div class="alert alert-info text-center">Nous ne distribuons pas ces produits en magasins ou pharmacies.</div>
        <div class="row">
          {foreach from=$brands item=brand}
            {* Exclure les marques stars *}
            {if isset($brand.id_manufacturer) && $brand.id_manufacturer != 3 && $brand.id_manufacturer != 4 && $brand.id_manufacturer != 5}
              <div class="col-12 col-md-6 col-lg-4 col-xl-2 col-xl-full">
                <div class="brand-card">
                  <div class="brand-card-logo">
                  <img src="{$urls.img_manu_url}{$brand.id_manufacturer}-brand_default.jpg" alt="{$brand.name}">
                  </div>
                  <h3 class="brand-card-title">{$brand.name}</h3>
                  <div class="total-products">
                    <p class="count-product">{$brand.nb_products}</p>
                  </div>
                  <div class="brand-card-description">
                  {$brand.text nofilter}
                  </div>
                  <div class="brand-card-action">
                    <a href="{$brand.url}">Voir tous les produits</a>
                  </div>
                </div>
              </div>
            {/if}
          {/foreach}
        </div>
      </div>
    {/block}

  </section>

{/block}
