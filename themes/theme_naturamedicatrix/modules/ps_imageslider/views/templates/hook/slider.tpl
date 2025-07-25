{**
 CUSTOM SLIDER HEADER
*}

{if $homeslider.slides}
  <div id="carousel" data-ride="carousel" class="carousel slide mb-0 p-0" data-interval="{$homeslider.speed}" data-wrap="{(string)$homeslider.wrap}" data-pause="{$homeslider.pause}" data-touch="true">
    <ol class="carousel-indicators">
      {foreach from=$homeslider.slides item=slide key=idxSlide name='homeslider'}
      <li data-target="#carousel" data-slide-to="{$idxSlide}"{if $idxSlide == 0} class="active"{/if}></li>
      {/foreach}
    </ol>
    <ul class="carousel-inner pl-0 mb-0" role="listbox" aria-label="{l s='Carousel container' d='Shop.Theme.Global'}">
      {foreach from=$homeslider.slides item=slide name='homeslider'}
        <li class="carousel-item mb-0 {if $smarty.foreach.homeslider.first}active{/if}" role="option" aria-hidden="{if $smarty.foreach.homeslider.first}false{else}true{/if}">
          {if !empty($slide.url)}<a href="{$slide.url}">{/if}
            <figure class="relative w-full h-full">
              {* Image principale - Desktop *}
              <img src="{$slide.image_url}" alt="{$slide.legend|escape}" loading="lazy" class="h-full object-cover hidden md:block">
              
              {* Image mobile *}
              {if isset($slide.image_mobile_url) && $slide.image_mobile_url}
                <img src="{$slide.image_mobile_url}" alt="{$slide.legend|escape}" loading="lazy" class="h-full object-cover block md:hidden">
              {else}
                {* Fallback: afficher l'image principale si pas d'image mobile *}
                <img src="{$slide.image_url}" alt="{$slide.legend|escape}" loading="lazy" class="h-full object-cover block md:hidden">
              {/if}
              {if $slide.title || $slide.description}
                <figcaption class="absolute inset-0 flex items-center justify-start px-14">
                  <div class="text-center max-w-md">
                    {if $slide.title}
                      <h2 class="display-1 text-uppercase">{$slide.title}</h2>
                    {/if}
                    <div class="caption-description mt-0 space-y-3">{$slide.description nofilter}</div>
                  </div>
                </figcaption>
              {/if}
            </figure>
          {if !empty($slide.url)}</a>{/if}
        </li>
      {/foreach}
    </ul>
    {if $homeslider.slides|count > 1}
    <div class="direction" aria-label="{l s='Carousel buttons' d='Shop.Theme.Global'}">
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev" aria-label="{l s='Previous' d='Shop.Theme.Global'}">
        <span class="icon-prev hidden-xs" aria-hidden="true">
        <i class="bi bi-caret-left-fill"></i>
        </span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next" aria-label="{l s='Next' d='Shop.Theme.Global'}">
        <span class="icon-next" aria-hidden="true">
        <i class="bi bi-caret-right-fill"></i>
        </span>
      </a>
    </div>
    {/if}
  </div>
  
{/if}



{*

<figcaption class="caption absolute inset-0 flex flex-col items-center justify-center text-center px-6">
  {if $slide.title}
    <h6 class="bg-pink-600 text-white text-xs font-semibold uppercase tracking-wide px-2 py-1 rounded mb-2">
      {$slide.title}
    </h6>
  {/if}
  {if $slide.description}
    <h2 class="text-white text-3xl md:text-5xl font-bold mb-4 leading-tight">
      {$slide.description nofilter}
    </h2>
  {/if}
  <a href="{$slide.url}" class="mt-2 inline-block bg-white text-green-700 font-semibold px-4 py-2 rounded shadow hover:bg-gray-100 transition">
    {l s='Découvrir' d='Shop.Theme.Global'}
  </a>
</figcaption>
*}



<style>
  
  #carousel figcaption {
    font-size: inherit;
    color: inherit;
    margin-top: inherit;
    text-align: inherit;
  }
  
  .carousel .carousel-inner {
    height: auto;
    width: 100%;
  }

  @media (max-width: 991px) {
    .carousel .carousel-inner {
      width: max-content;
      height: 100%;
    }
  }
  
  #carousel h6 {
    margin: 0;
    display: inline-block;
    color: #e45b7f;
    background: rgba(249, 250, 251, 80%);
    padding-left: .625rem;
    padding-right: .625rem;
    padding-top: .125rem;
    padding-bottom: .125rem;
    border-radius: 15px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 2px;
    font-weight: 600;
  }
  
  #carousel h2 {
    margin-top: 0.5rem;
    font-size: 2.25rem;
    line-height: 2.5rem;
    color: #111827;
  }
  
  #carousel .caption-description p {
    font-size: 1.25rem;
    line-height: 1.75rem;
  }
  
  #carousel a {
    text-decoration: none;
  }
  
  #carousel .btn {
    background-color: #111827 !important;
    color: #f9fafb !important;
    border-color: #111827 !important;
    border: 1px solid transparent !important;
    text-decoration: none !important;
    line-height: 1;
    transition: all 0.2s ease-in-out !important;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    display: inline-block;
    font-weight: bold;
    font-size: 15px;
    text-transform: none;
    padding: 13px 25px;
  }
  
  #carousel .btn:hover {
    background-color: #374151 !important;
  }

  
    
</style>