{**
 * CUSTOM SUBCATEGORIES
 *}
 
{if $category.id == 25}

  <style>
    .category-principes-actifs .total-products,
    .category-principes-actifs #products  {
      display: none;
    }
    
    #alphabet {
      background: white;
      z-index: 1;
      border-top: 1px solid #e5e8ea;
      border-bottom: 1px solid #e5e8ea;
    } 
     
    .letter {
      min-width: 8%;
    } 
    
    .grid {
      border-left: 1px solid #e5e8ea;
    }
    
    .subcategory-image a {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 1rem;
    }
    
  </style>
  
  
  {assign var='last_letter' value=''}
  
  <ul id="alphabet" class="-mx-4 gap-4 sm:-mx-11 xl:mx-0 z-5 flex overflow-x-scroll sticky top-0 justify-start items-baseline bg-white shadow-md sm:py-0 sm:pt-2 sm:pb-2 sm:pl-7 sm:shadow-none xl:px-14 xl:justify-center xl:overflow-x-hidden scrollbar-hidden">        
    {foreach from=$subcategories item=subcategory name=actifnaturel}
      {if !isset($currentLetter)}
        {$currentLetter = $subcategory.name|substr:0:1}
        <li class="flex flex-shrink-0 justify-center items-center w-10 h-10 text-xl cursor-pointer rounded-full"><a href="#{$subcategory.name|substr:0:1}"><span>{$subcategory.name|substr:0:1}</span></a></li>
      {else if isset($currentLetter) && $currentLetter != $subcategory.name|substr:0:1 && (string)($subcategory.name|substr:0:1) != (string)((int)($subcategory.name|substr:0:1))}	
        {$currentLetter = $subcategory.name|substr:0:1}  
        <li class="flex flex-shrink-0 justify-center items-center w-10 h-10 text-xl cursor-pointer rounded-full"><a href="#{$subcategory.name|substr:0:1}"><span>{$subcategory.name|substr:0:1}</span></a></li>
      {/if}
    {/foreach}
  </ul>
    
{assign var='last_letter' value=''}

{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories)}
    <div id="category-principesactifs" class="mb-3">
    
      {foreach from=$subcategories item=subcategory name=subcat_loop}
        {assign var='first_letter' value=$subcategory.name|truncate:1:""|upper}

        {if $first_letter ne $last_letter}
          {if $last_letter != ''}
              </ul>
            </div>
          {/if}

          <div class="relative flex flex-grow flex-col md:flex-row justify-start">
            <div class="letter mb-2 md:mb-0 bg-white text-gray-800 text-lg md:text-3xl md:flex md:justify-center pt-5">
              <h2 class="self-start md:sticky md:top-16 text-xl">{$first_letter}</h2>
            </div>
            <ul id="{$first_letter}" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 md:gap-4 gap-y-5 justify-items-center w-full py-2 md:pl-12 md:pr-0 md:py-12">
        {/if}

        <li class="w-full">
          <div class="subcategory-image">
            <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}"
               class="border-r border-l border-gray-100 md:p-4 rounded-xl md:rounded-2xl flex flex-col justify-start items-start shadow-lg h-full relative">

              {if !empty($subcategory.image.small.url)}
                <picture class="flex overflow-hidden flex-col justify-center h-16 w-16">
                  {if !empty($subcategory.image.small.sources.avif)}<source srcset="{$subcategory.image.small.sources.avif}" type="image/avif"/>{/if}
                  {if !empty($subcategory.image.small.sources.webp)}<source srcset="{$subcategory.image.small.sources.webp}" type="image/webp"/>{/if}
                  <img class="img-fluid"
                       src="{$subcategory.image.small.url}"
                       alt="{$subcategory.name|escape:'html':'UTF-8'}"
                       loading="lazy"
                       width="{$subcategory.image.small.width}"
                       height="{$subcategory.image.small.height}"/>
                </picture>
              {else}
                <picture class="flex overflow-hidden flex-col justify-center h-16 w-16 text-center">
                  <span class="text-3xl text-gray-300">{$first_letter}</span>
                </picture>
              {/if}

              <p class="pb-0 color-title"><strong>{$subcategory.name|truncate:50:'...'|escape:'html':'UTF-8'}</strong><small class="color-text block">{$subcategory.nb_products} produit{if $subcategory.nb_products > 1}s{/if}</small></p>
            </a>
          </div>
        </li>

        {assign var='last_letter' value=$first_letter}
      {/foreach}

      {* fermeture finale du dernier bloc *}
      </ul>
    </div>
  {/if}
{/if}



  

{else} {* default category *}
 
 
   {if !empty($subcategories)}
      {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
        <div id="subcategories">
          
          <ul class="subcategories-list">
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
    
                <h5>
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
  
{/if} {* end if $category principes actifs *}