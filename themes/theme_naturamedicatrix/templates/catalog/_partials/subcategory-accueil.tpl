{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
    
    <h3 class="text-2xl font-light text-gray-800 mb-6">{l s='List of your favorite categories' d='Shop.Theme.Catalog'}</h3>    

    <div id="subcategories_custom" class="mx-auto mt-0 relative">
{*       <ul class="subcategories_custom justify-between ml-0 pl-0 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6"> *}
      <ul class="subcategories_custom justify-between m-0 pl-0">
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
                  <a class="text-gray-900 hover:text-gray-600 transition-colors duration-200" href="{$subcategory.url}">
                    {$subcategory.name|escape:'html':'UTF-8'}
                  </a>                  
                </h2>
                
                {if isset($subcategory.nb_products) && $subcategory.nb_products > 0}
                  <a href="{$subcategory.url}" class="text-xs text-gray-600 hover:text-gray-500 transition-colors duration-200 mt-1.5 block">{if $subcategory.nb_products > 1}Voir {$subcategory.nb_products} produits{else}Voir le produit{/if}</a>
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

<h3 class="text-2xl font-light text-gray-800 mb-6">{l s='All of our products' d='Shop.Theme.Catalog'}</h3>

{* {if isset($listing.products) && $listing.products}
  <div class="products grid grid-cols-2 xl:grid-cols-3 gap-6">
    {foreach from=$listing.products item=product}
      {include file='catalog/_partials/miniatures/product.tpl' product=$product}
    {/foreach}
  </div>
  
  {if isset($listing.pagination) && $listing.pagination.should_be_displayed}
    {include file='catalog/_partials/pagination.tpl' pagination=$listing.pagination}
  {/if}
{/if} *}

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slider = tns({
      container: '.subcategories_custom',
      items: 5,
      slideBy: 1,
      autoplay: false,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      autoplayButtonOutput: false,
      controls: true,
      controlsText: ["", ""],
      nav: false,
      mouseDrag: true,
      gutter: 24,
      responsive: {
        0: { items: 2 },
        640: { items: 3 },
        1024: { items: 5 }
      }
    });
  });
</script>



<style>
  
  .tns-controls {
    position: absolute;
    top: -45px;
    right: 0;
    z-index: 10;
    margin-top: 0;
    display: flex;
    gap: 0.5rem;
    pointer-events: all;
  }

  .tns-controls button {
    background-color: white;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s ease;
  }

  .tns-controls button:hover {
    background-color: #f8fafc;
  }

  .tns-controls button:before {
    content: '';
    display: block;
    width: 18px;
    height: 18px;
    background-size: contain;
    background-repeat: no-repeat;
  }

  .tns-controls [data-controls="prev"]:before {
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z'/></svg>");
  }

  .tns-controls [data-controls="next"]:before {
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z'/></svg>");
  }

  /* Dots pagination */
  .tns-nav {
    margin-top: 1rem;
    text-align: center;
  }

  .tns-nav button {
    width: 12px;
    height: 12px;
    border-radius: 9999px;
    background-color: #d1d5db;
    border: none;
    margin: 0 5px;
    transition: background-color 0.3s ease;
  }

  .tns-nav button.tns-nav-active {
    background-color: #1f2937;
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