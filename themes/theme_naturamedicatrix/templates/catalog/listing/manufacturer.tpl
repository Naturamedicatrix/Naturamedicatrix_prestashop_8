{**
 * Fichier : manufacturer.tpl
 * 
 * Description : Template pour l'affichage de la page d'une marque spécifique
 * Ce fichier est utilisé lorsqu'un utilisateur clique sur une marque pour voir ses produits.
 * Il étend le template product-list.tpl pour hériter de la mise en page standard des listes de produits.
 *
 * Il affiche :
 * - Le titre de la page avec le nom de la marque
 * - La description courte de la marque
 * - La description complète de la marque
 * - La liste des produits de la marque (via le template products.tpl)
 *}
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list_header'}
  <h1>{l s='List of products by brand %brand_name%' sprintf=['%brand_name%' => $manufacturer.name] d='Shop.Theme.Catalog'}</h1>
  <div id="manufacturer-short_description">{$manufacturer.short_description nofilter}</div>
  <div id="manufacturer-description">{$manufacturer.description nofilter}</div>
{/block}

{block name='product_list'}
  {include file='catalog/_partials/products.tpl' listing=$listing productClass="col-xs-12 col-sm-6 col-xl-3"}
{/block}
