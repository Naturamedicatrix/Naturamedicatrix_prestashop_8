 {assign var="categories" value=Category::getCategories(
    (int) Context::getContext()->language->id,
    true,
    false
)}

<ul class="category-list row pt-4">
{foreach from=$categories item=cat}
    {if $cat.id_category != 2 && $cat.id_parent == 2} {* Catégorie principale uniquement *}
        <li class="category-item col-xs-12 col-sm-4 col-md-4 col-xl-2">
        <div class="category-content">
            <div class="category-block">
                {if file_exists("img/c/{$cat.id_category}.jpg")}
                    <div class="category-image">
                        <img src="{$urls.base_url}img/c/{$cat.id_category}-category_default.jpg" alt="{$cat.name}">
                    </div>
                {else}
                  <div class="category-image">
                      <img src="{$urls.child_img_url}category_default.jpg" alt="{$cat.name}">
                  </div>
                {/if}
                <div class="category-info">
                    <h2><a href="{$link->getCategoryLink($cat.id_category)}" title="Voir tous les produits {$cat.name}" class="no-underline">{$cat.name}</a></h2>

                    {* {if $cat.description}
                        <div class="custom-scrollbar">{$cat.description nofilter}</div>
                    {/if} *}
                    
                    <a href="{$link->getCategoryLink($cat.id_category)}" class="mt-0 view-all-products link-blue">Voir tous les produits</a>


                    {* Sous-catégories *}
                    {assign var='subcats' value=[]}
                    {foreach from=$categories item=subcat}
                        {if $subcat.id_parent == $cat.id_category}
                            {assign var='subcats' value=$subcats|@array_merge:[$subcat]}
                        {/if}
                    {/foreach}
                    
                    {if $subcats|count > 0}
                        <ul class="subcategory-list">
                            {foreach from=$subcats item=sub name=subloop}
                                <li class="subcategory-item mb-0 {if $smarty.foreach.subloop.iteration > 3}hidden toggle-subcat{/if}">
                                    <h3 class="mt-0 mb-0 text-base font-medium">
                                        <a href="{$link->getCategoryLink($sub.id_category)}" class="text-blue-600 hover:underline no-underline">
                                            {$sub.name}
                                        </a>
                                    </h3>
                                </li>
                            {/foreach}
                        </ul>
                    
                        {if $subcats|count > 3}
                        
                        <button type="button"
                                class="mt-2.5 text-left text-xs toggle-btn underline"
                                data-state="collapsed">
                            Voir plus
                        </button>
                        {/if}
                    {/if}
     
            
            
            
                    
                </div>
            </div>
        </div>
        </li>
    {/if}
{/foreach}
</ul>


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