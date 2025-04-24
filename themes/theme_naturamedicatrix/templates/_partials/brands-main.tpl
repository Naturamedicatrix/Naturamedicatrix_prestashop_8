{**
 * Fichier : brands-main.tpl
 * 
 * Description : Template qui affiche les 3 marques phares
 *}

{* Récupération et formatage des données des marques *}
{if !isset($brands) || $brands|count == 0}
  {assign var="manufacturers" value=Manufacturer::getManufacturers()}
  {assign var="formatted_brands" value=[]}

  {foreach from=$manufacturers item=manufacturer}
    {if $manufacturer.id_manufacturer == 3 || $manufacturer.id_manufacturer == 4 || $manufacturer.id_manufacturer == 5}
      {assign var="brand" value=[
        'id_manufacturer' => $manufacturer.id_manufacturer,
        'name' => $manufacturer.name,
        'image' => "{$urls.img_manu_url}{$manufacturer.id_manufacturer}.jpg",
        'url' => {url entity='manufacturer' id=$manufacturer.id_manufacturer}
      ]}
      {append var='formatted_brands' value=$brand}
    {/if}
  {/foreach}
{else}
  {assign var="formatted_brands" value=$brands}
{/if}

{* Bloc pour les 3 marques phares *}
{block name='featured_brands'}
  <div class="container featured-brands">
    <p class="h3">Nous distribuons ces produits en magasins et pharmacies.</p>
    <div class="row justify-content-center">
      {* Affichage des marques phares *}
      {if $formatted_brands|count > 0}
        {foreach from=$formatted_brands item=brand}
          {* Vérifier si la propriété id_manufacturer existe *}
          {if isset($brand.id_manufacturer)}
            {if $brand.id_manufacturer == 3 || $brand.id_manufacturer == 4 || $brand.id_manufacturer == 5}
              <div class="col-12 col-md-12 col-xl-4">
                <div class="brand-card featured-brand-card">
                  <div class="brand-card-header">
                  {if $brand.id_manufacturer == 4}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-naturamedicatrix.jpg" alt="{$brand.name}" class="brand-header-img">
                  {elseif $brand.id_manufacturer == 5}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-olivie.jpg" alt="{$brand.name}" class="brand-header-img">
                  {elseif $brand.id_manufacturer == 3}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-jacob.jpg" alt="{$brand.name}" class="brand-header-img">
                  {/if}
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