{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
    <div id="subcategories" class="mx-auto px-4">
      <ul class="ml-0 pl-0 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        
        
        
        {foreach from=$subcategories item=subcategory}
        
        

        
          <li class="flex flex-col bg-white rounded-lg overflow-hidden transition">

            <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="block">
              {if !empty($subcategory.image.large.url)}
                <picture>
                  {if !empty($subcategory.image.large.sources.avif)}<source srcset="{$subcategory.image.large.sources.avif}" type="image/avif">{/if}
                  {if !empty($subcategory.image.large.sources.webp)}<source srcset="{$subcategory.image.large.sources.webp}" type="image/webp">{/if}
                  <img
                    class="img-responsive"
                    src="{$subcategory.image.large.url}"
                    alt="{$subcategory.name|escape:'html':'UTF-8'}"
                    loading="lazy"/>
                </picture>
              {else}
                <div class="flex items-center justify-center">
                  <img src="{$urls.child_img_url}category_default.jpg" alt="{$subcategory.name}">
                </div>
              {/if}
            </a>

            <div class="p-1 text-left">
              <div>
                <h2 class="text-xl font-bold text-gray-900 mt-0 mb-1.5">
                  <a class="hover:underline" href="{$subcategory.url}">
                    {$subcategory.name|escape:'html':'UTF-8'}
                  </a>                  
                </h2>

                {if $subcategory.nb_products > 0}<a href="{$subcategory.url}" class="text-sm link-blue mt-1.5 block">{if $subcategory.nb_products > 1}Voir {$subcategory.nb_products} produits{else}Voir le produit{/if}</a>
                {else}
                  <p class="text-sm text-gray-400 mt-1.5 block">Aucun produit</p>
                {/if}
                
              </div>
           
             
             {assign var=subchildren value=Category::getChildren($subcategory.id_category, $language.id)}
             
             {if $subchildren|count > 0}
              <ul class="list-disc text-left text-sm text-gray-700 mt-1.5 ml-1 pl-0 space-y-0.5">
                {foreach from=$subchildren item=subchild name=subloop}
                  <li class="w-full m-0 p-0 text-left {if $smarty.foreach.subloop.iteration > 3}hidden toggle-subcat{/if}">
                    <a href="{$link->getCategoryLink($subchild.id_category, $subchild.link_rewrite)}">
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
              
            </div>
            
          </li>
        {/foreach}
      </ul>
    </div>
  {/if}
{/if}






<style>
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
  #subcategories ul.list-disc li {
    text-align: left;
    margin-bottom: 4px !important;
    margin-top: 0 !important;
  }
  
  #subcategories ul.list-disc li a:hover {
    color: #155585;
  }
</style>




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