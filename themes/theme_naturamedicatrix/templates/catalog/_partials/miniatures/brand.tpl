{**
 * Fichier : brand.tpl
 * 
 * Description : Template pour l'affichage d'une miniature de marque
 * Ce fichier définit comment chaque marque est affichée dans la liste des marques.
 * Il contient :
 * - L'image de la marque
 * - Le nom de la marque
 * - La description de la marque
 * - Le nombre de produits de la marque
 * - Un lien pour voir les produits de la marque
 *
 * Ce template est inclus dans une boucle dans le fichier brands.tpl
 *}
{block name='brand_miniature_item'}
  <li class="brand">
    <div class="brand-img"><a href="{$brand.url}"><img src="{$brand.image}" alt="{$brand.name}" loading="lazy"></a></div>
    <div class="brand-infos">
      <p><a href="{$brand.url}">{$brand.name}</a></p>
      {$brand.text nofilter}
    </div>
    <div class="brand-products">
      <a href="{$brand.url}">{$brand.nb_products}</a>
      <a href="{$brand.url}">{l s='View products' d='Shop.Theme.Actions'}</a>
    </div>
  </li>
{/block}
