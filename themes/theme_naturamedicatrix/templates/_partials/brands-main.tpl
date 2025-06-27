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
      {* Récupération du nombre de produits *}
      {assign var="product_count" value=Manufacturer::getProducts($manufacturer.id_manufacturer, Context::getContext()->language->id, 0, 0, null, null, true)}

      {* Ajout de la marque dans le array formatted_brands *}
      {assign var="formatted_brands" value=$formatted_brands|array_merge:[[
        'id_manufacturer' => $manufacturer.id_manufacturer,
        'name' => $manufacturer.name,
        'image' => "{$urls.img_manu_url}{$manufacturer.id_manufacturer}-brand_default.jpg",
        'url' => {url entity='manufacturer' id=$manufacturer.id_manufacturer},
        'short_description' => $manufacturer.short_description,
        'nb_products' => $product_count
      ]]}
    {/if}
  {/foreach}
{else}
  {assign var="formatted_brands" value=$brands}
{/if}

{* Bloc pour les 3 marques phares *}
{block name='featured_brands'}
  <div class="featured-brands">
    <p class="mx-auto alert alert-success text-center">Nous distribuons ces produits en magasins et pharmacies.</p>
    <div class="row justify-content-center">
      {* Affichage des marques phares *}
      {if $formatted_brands|count > 0}
        {foreach from=$formatted_brands item=branding}
          {* Vérifier si la propriété id_manufacturer existe *}
          {if isset($branding.id_manufacturer)}
            {if $branding.id_manufacturer == 4 || $branding.id_manufacturer == 3 || $branding.id_manufacturer == 5}
              <div class="col-12 col-md-12 col-xl-4">
                <div class="brand-card featured-brand-card">
                  <div class="brand-card-header">
                  {if $branding.id_manufacturer == 4}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-naturamedicatrix.jpg" alt="{$branding.name}" class="brand-header-img">
                  {elseif $branding.id_manufacturer == 3}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-jacob.jpg" alt="{$branding.name}" class="brand-header-img">
                  {elseif $branding.id_manufacturer == 5}
                    <img src="{$urls.base_url}themes/theme_naturamedicatrix/assets/img/brands/brand-olivie.jpg" alt="{$branding.name}" class="brand-header-img">
                  {/if}
                  </div>
                  
                  <div class="brand-card-logo featured-logo">
                      <img src="{$urls.img_manu_url}{$branding.id_manufacturer}-brand_default.jpg" alt="{$branding.name}">
                  </div>
                  <h3 class="brand-card-title featured-title">{$branding.name}</h3>
                  {if isset($branding.nb_products)}
                    <div class="total-products text-center">
                      <p class="count-product text-sm">
                        {$branding.nb_products}
                        {if isset($page) && $page.page_name == 'index'} produits{/if}
                      </p>
                    </div>
                  {/if}
                  <div class="brand-card-description featured-description">
                    {$branding.short_description nofilter}
                  </div>
                  <div class="brand-card-action">
                    <a href="{$branding.url}">Voir tous les produits</a>
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