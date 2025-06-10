{**
 * Fichier : brands-main.tpl
 * 
 * Description : Template qui affiche les 3 marques phares
 *}

{* Récupération et formatage des données des marques *}
{if !isset($brands) || $brands|count == 0}
  {assign var="manufacturers" value=Manufacturer::getManufacturers()}
  
  {* Création du tableau des marques formatées *}
  {assign var="formatted_brands" value=[]}
  {foreach from=$manufacturers item=manufacturer}
    {if $manufacturer.id_manufacturer == 3 || $manufacturer.id_manufacturer == 4 || $manufacturer.id_manufacturer == 5}
      {* Ajout de la marque dans le array formatted_brands *}
      {assign var="formatted_brands" value=$formatted_brands|array_merge:[[
        'id_manufacturer' => $manufacturer.id_manufacturer,
        'name' => $manufacturer.name,
        'image' => "{$urls.img_manu_url}{$manufacturer.id_manufacturer}-small_default.jpg",
        'url' => {url entity='manufacturer' id=$manufacturer.id_manufacturer},
        'short_description' => $manufacturer.short_description
      ]]}
    {/if}
  {/foreach}
{else}
  {assign var="formatted_brands" value=$brands}
{/if}

{* Bloc pour les 3 marques phares *}
{block name='featured_brands'}
  <div class="container featured-brands">
    <p class="alert alert-success text-center">Nous distribuons ces produits en magasins et pharmacies.</p>
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
                    {$brand.short_description nofilter}
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