{**
 * CUSTOM SUBCATEGORIES
 *}
{if $category.id == 2}

  {include file='../_partials/subcategory-accueil.tpl'}

{elseif $category.id == 25}

  {include file='../_partials/subcategory-principesactifs.tpl'}

{else} {* default category *}
 
 
   {if !empty($subcategories)}
      {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
        <div id="subcategories" class="my-1">
          
          <ul class="list-none subcategories-list">
            {foreach from=$subcategories item=subcategory}
              <li>
                {* <div class="subcategory-image">
                  <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}" class="img">
                    {if !empty($subcategory.image.large.url)}
                      <picture>
                        {if !empty($subcategory.image.large.sources.avif)}<source srcset="{$subcategory.image.large.sources.avif}" type="image/avif">{/if}
                        {if !empty($subcategory.image.large.sources.webp)}<source srcset="{$subcategory.image.large.sources.webp}" type="image/webp">{/if}
                        <img
                          class="img-fluid"
                          src="{$subcategory.image.large.url}"
                          alt="{$subcategory.name|escape:'html':'UTF-8'}"
                          loading="lazy"
                          width="{$subcategory.image.large.width}"
                          height="{$subcategory.image.large.height}"/>
                      </picture>
                    {/if}
                  </a>
                </div> *}
    
                <h5 class="m-0 p-0">
                  <a class="subcategory-name badge-rounded" href="{$subcategory.url}">
                    {$subcategory.name|truncate:25:'...'|escape:'html':'UTF-8'}
                  </a>
                </h5>
                {* {if $subcategory.description}
                  <div class="cat_desc">{$subcategory.description|unescape:'html' nofilter}</div>
                {/if} *}
              </li>
            {/foreach}
          </ul>
        </div>
      {/if}
    {/if}

    

    {if isset($bestselles) && $bestselles|@count > 0}
      {include file="../_partials/productlist-best.tpl"}
    {/if}

    
  
{/if} {* end if $category principes actifs *}