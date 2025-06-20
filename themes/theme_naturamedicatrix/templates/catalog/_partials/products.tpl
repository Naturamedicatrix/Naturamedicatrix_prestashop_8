{**
 * CUSTOM products.tpl (catégorie)
 *}

{* Ne pas afficher la liste des produits pour la catégorie 25 (principe actifs) *}
{if !isset($category) || $category.id != 25}
  <div id="js-product-list">
    {include file="catalog/_partials/productlist.tpl" products=$listing.products cssClass="row"}

    {block name='pagination'}
      {include file='_partials/pagination.tpl' pagination=$listing.pagination}
    {/block}

    <div class="hidden-md-up text-xs-right up">
      <a href="#header" class="btn btn-secondary">
        {l s='Back to top' d='Shop.Theme.Actions'}
        <i class="material-icons">&#xE316;</i>
      </a>
    </div>
  </div>
{/if}
