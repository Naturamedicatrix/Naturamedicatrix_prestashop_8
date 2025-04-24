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

    {* {include file='catalog/_partials/miniatures/manufacturer_main.tpl' brand=$brand} *}

    {* Bloc pour les 3 marques phares *}
    {block name='featured_brands'}
      <div class="container featured-brands">
        <p class="h3">Nous distribuons ces produits en magasins et pharmacies.</p>
        <div class="row justify-content-center">
          {* Nous affichons les 3 premières marques comme marques phares *}
          {if isset($brands) && $brands}
            {foreach from=$brands item=brand}
              {* Vérifier si la propriété id_manufacturer existe *}
              {if isset($brand.id_manufacturer)}
                {if $brand.id_manufacturer == 3 || $brand.id_manufacturer == 4 || $brand.id_manufacturer == 5}
                  <div class="col-12 col-md-12 col-xl-4">
                    <div class="brand-card featured-brand-card">
                      <div class="brand-card-header">
                        <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/Test_banner.jpg" alt="Header image" class="brand-header-img">
                      </div>
                      <div class="brand-card-logo featured-logo">
                        <img src="{$brand.image}" alt="{$brand.name}">
                      </div>
                      <h3 class="brand-card-title featured-title">{$brand.name}</h3>
                      <div class="brand-card-description featured-description">
                        {if $brand.id_manufacturer == 4}
                          <p>NATURA<strong>Medicatrix</strong>, votre marque de confiance pour des compléments alimentaires de qualité supérieure, vous propose des formulations exclusives rigoureusement sélectionnées pour leur efficacité. Nous mettons un point d'honneur à choisir des composants à haute biodisponibilité, principalement d'origine naturelle, et à optimiser leur synergie.</p>
                          <p>Tous nos produits sont exempts de gluten et de lactose, et la plupart sont entièrement végétaliens, garantissant ainsi des options saines pour tous.</p>
                        {elseif $brand.id_manufacturer == 5}
                          <p>L'olivier, éternel symbole de sagesse, de pouvoir et de paix, produit des fruits naturellement riches en polyphénols, aux propriétés exceptionnelles. Olivie Pharma®, avec sa gamme sélectionnée de produits naturels — huiles, gélules, crèmes et perles — offre de puissants antioxydants. Que ce soit pour des cures de minéraux, des vitamines ou des soins cosmétiques, nos produits répondent efficacement à vos besoins essentiels.</p>
                          <p>Découvrez une protection 100% naturelle avec Olivie Pharma® !</p>
                        {elseif $brand.id_manufacturer == 3}
                          <p>Optez pour un mode de vie sain grâce à des produits et des concepts de santé holistiques.</p>
                          <p>Depuis sa création en 1997, Dr. Jacob's Medical s'engage à développer des produits innovants et des stratégies de santé naturellement efficaces. Grâce à une expertise solide en recherche médicale et à des produits de haute qualité à base de plantes, nous vous offrons des compléments alimentaires qui sont à la fois fiables, sûrs et performants.</p>
                        {/if}
                      </div>
                      <div class="brand-card-action">
                        <a href="{$brand.url}">En savoir plus</a>
                      </div>
                    </div>
                  </div>
                {/if}
              {/if}
            {/foreach}
          {/if}
        </div>
      </div>
    {/block}

    {* Liste complète des marques (excluant les marques stars) *}
    {block name='brand_miniature'}
      <div class="container brand-miniature">
        <p class="h3">Nous ne distribuons pas ces produits en magasins ou pharmacies.</p>
        <div class="row">
          {foreach from=$brands item=brand}
            {* Exclure les marques stars *}
            {if isset($brand.id_manufacturer) && $brand.id_manufacturer != 3 && $brand.id_manufacturer != 4 && $brand.id_manufacturer != 5}
              <div class="col-12 col-md-6 col-lg-4 col-xl-2 col-xl-full">
                <div class="brand-card">
                  <div class="brand-card-logo">
                    <img src="{$brand.image}" alt="{$brand.name}">
                  </div>
                  <h3 class="brand-card-title">{$brand.name}</h3>
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
