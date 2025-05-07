 {assign var="categories" value=Category::getCategories(
    (int) Context::getContext()->language->id,
    true,
    false
)}

<ul class="category-list row">
{foreach from=$categories item=cat}
    {if $cat.id_category != 2 && $cat.id_parent == 2} {* Catégorie principale uniquement *}
        <li class="category-item col-xs-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3">
        <div class="category-content">
            <div class="category-block">
                {if file_exists("img/c/{$cat.id_category}.jpg")}
                    <div class="category-image">
                        <img src="{$urls.base_url}img/c/{$cat.id_category}-category_default.jpg" alt="{$cat.name}">
                    </div>
                {/if}
                <div class="category-info">
                    <h2><a href="{$link->getCategoryLink($cat.id_category)}">{$cat.name}</a></h2>

                    {if $cat.description}
                        {$cat.description nofilter}
                    {/if}

                    {* Sous-catégories *}
                    {assign var='subcats' value=[]}
                    {foreach from=$categories item=subcat}
                        {if $subcat.id_parent == $cat.id_category}
                            {assign var='subcats' value=$subcats|@array_merge:[$subcat]}
                        {/if}
                    {/foreach}

            
            {if $subcats|count > 0}
                <ul class="subcategory-list">
                    {foreach from=$subcats item=sub}
                        <li class="subcategory-item">
                            <h3 class="mt-0"><a href="{$link->getCategoryLink($sub.id_category)}">{$sub.name}</a></h3>
                        </li>
                    {/foreach}
                </ul>
            {/if}
                </div>
            </div>


            
        </div>
        </li>
    {/if}
{/foreach}
</ul>