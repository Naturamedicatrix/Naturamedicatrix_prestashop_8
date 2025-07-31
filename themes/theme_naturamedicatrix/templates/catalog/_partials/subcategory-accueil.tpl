{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
    
    <h3 class="text-lg font-light mb-1">{l s='List of your favorite categories' d='Shop.Theme.Catalog'}</h3>
    
    <div id="subcategories_custom" class="mx-auto mt-0">
      <ul class="justify-between ml-0 pl-0 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

        {foreach from=$subcategories item=subcategory}
        
          <li class="flex flex-col bg-white overflow-hidden transition">

            <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="block">
              {if !empty($subcategory.image.large.url)}
                <picture>
                  {if !empty($subcategory.image.large.sources.avif)}<source srcset="{$subcategory.image.large.sources.avif}" type="image/avif">{/if}
                  {if !empty($subcategory.image.large.sources.webp)}<source srcset="{$subcategory.image.large.sources.webp}" type="image/webp">{/if}
                  <img
                    class="img-responsive rounded-lg"
                    src="{$subcategory.image.large.url}"
                    alt="{$subcategory.name|escape:'html':'UTF-8'}"
                    loading="lazy"/>
                </picture>
              {else}
                <div class="flex items-center justify-center">
                  <img src="{$urls.child_img_url}category_default.jpg" alt="{$subcategory.name}" class="img-responsive rounded-lg">
                </div>
              {/if}
            </a>

            <div class="p-0 text-left">
              <div>
                <h2 class="text-base font-bold leading-tight text-gray-900 mt-1.5 mb-1.5">
                  <a class="hover:underline" href="{$subcategory.url}">
                    {$subcategory.name|escape:'html':'UTF-8'}
                  </a>                  
                </h2>
                
                                
              
                {if isset($subcategory.nb_products) && $subcategory.nb_products > 0}
                  <a href="{$subcategory.url}" class="text-xs link-blue mt-1.5 block">{if $subcategory.nb_products > 1}Voir {$subcategory.nb_products} produits{else}Voir le produit{/if}</a>
                {else}
                  <p class="text-xs text-gray-400 mt-1.5 block">Aucun produit</p>
                {/if}
                
              </div>
           
             
{*
             {assign var=subchildren value=Category::getChildren($subcategory.id_category, $language.id)}
             
             {if $subchildren|count > 0}
              <ul class="list-disc text-left text-sm text-gray-700 mt-1.5 ml-1 pl-0 space-y-0.5">
                {foreach from=$subchildren item=subchild name=subloop}
                  <li class="w-full m-0 p-0 text-left {if $smarty.foreach.subloop.iteration > 3}hidden toggle-subcat{/if}">
                    <a href="{$link->getCategoryLink($subchild.id_category, $subchild.link_rewrite)}" class="hover:underline">
                      {$subchild.name|escape:'html':'UTF-8'}
                    </a>
                  </li>
                {/foreach}
              </ul>
              
              {if $subchildren|count > 3}
                        
                <button type="button"
                        class="mt-2.5 text-left text-xs toggle-btn underline"
                        data-state="collapsed">
                    Voir plus
                </button>
              {/if}
              
            {/if}
*}
              
            </div>
            
          </li>
        {/foreach}
      </ul>
    </div>
  {/if}
{/if}

<hr />

<h3 class="text-lg font-light mb-1">{l s='All of our products' d='Shop.Theme.Catalog'}</h3>

{if isset($listing.products)}
  <div class="products grid grid-cols-2 xl:grid-cols-3 gap-6">
    {foreach from=$listing.products item=product}
      {include file='catalog/_partials/miniatures/product.tpl' product=$product}
    {/foreach}
  </div>
{/if}


{* Liste des produits *}
{*
<section id="products">
  {if $listing.products|count}
    <div class="products row">
      {foreach from=$all_products item="product"}
        <div class="{if isset($productClass)}{$productClass}{else}col-xs-12 col-sm-6 col-md-6 col-xl-4 col-xxl-4{/if}">
          {include file="catalog/_partials/miniatures/product.tpl" product=$product key="position"}
        </div>
      {/foreach}
    </div>
  {/if}
</section>
*}



{*
{capture assign="productClasses"}{if !empty($productClass)}{$productClass}{else}col-xs-12 col-sm-6 col-xl-3 col-xxl-4{/if}{/capture}

<div class="products{if !empty($cssClass)} {$cssClass}{/if}">
  {foreach from=$all_products item="product" key="position"}
      {include file="catalog/_partials/miniatures/product.tpl" product=$product position=$position productClasses=$productClasses}
  {/foreach}
</div>
*}



{*
{if isset($all_products) && $all_products|count > 0}
  <div class="mt-10 px-4 mx-auto max-w-screen-xl">
    <h2 class="text-2xl font-bold mb-6">{l s='Tous les produits' d='Shop.Theme.Catalog'}</h2>
    <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
      {foreach from=$all_products item=product}
        <li class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
          <a href="{$link->getProductLink($product.id_product)}">
            <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')}" alt="{$product.name|escape:'html':'UTF-8'}" class="w-full h-48 object-cover" />
            <div class="p-3">
              <h3 class="text-sm font-semibold truncate">{$product.name|escape:'html':'UTF-8'}</h3>
              <p class="text-green-700 font-bold mt-1">{$product.price|string_format:"%.2f"} €</p>
            </div>
          </a>
        </li>
      {/foreach}
    </ul>
  </div>
{/if}
*}



{*
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list'}
  {include file='catalog/_partials/products.tpl' listing=$listing productClass="col-xs-6 col-sm-6 col-xl-4"}
{/block}
*}





<style>

{*
  #subcategories li {
    max-width: 215px;
  }

  #subcategories img {
    border-radius: 15px;
  }
  #subcategories h2 a:hover {
    color: #111827;
    text-decoration: none;
  }  
  #subcategories .list-disc {
    clear: both;
    display: block;
    width: 100%;
    margin-bottom: 0;
    margin-top: 1rem;
  }

  #subcategories ul {
    justify-content: space-between;
  }

  #subcategories ul.list-disc li {
    text-align: left;
    margin-bottom: 4px !important;
    margin-top: 0 !important;
  }
*}
  
  #subcategories_custom ul li a:hover {
    color: #155585;
  }
</style>




{*
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.toggle-btn');
    const items = document.querySelectorAll('.toggle-subcat');

    if (!btn) return;

    btn.addEventListener('click', () => {
      const expanded = btn.getAttribute('data-state') === 'expanded';

      items.forEach(item => item.classList.toggle('hidden', expanded));

      btn.textContent = expanded ? 'Voir plus' : 'Voir moins';
      btn.setAttribute('data-state', expanded ? 'collapsed' : 'expanded');
    });
  });
</script>
*}