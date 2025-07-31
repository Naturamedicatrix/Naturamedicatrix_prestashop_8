{**
CUSTOM CATEGORY
 *}
 {block name='category_miniature_item'}
    <section class="category-miniature">
      <a href="{$category.url}">
        <picture>
          {if !empty($category.image.medium.sources.avif)}<source srcset="{$category.image.medium.sources.avif}" type="image/avif">{/if}
          {if !empty($category.image.medium.sources.webp)}<source srcset="{$category.image.medium.sources.webp}" type="image/webp">{/if}
          <img
            src="{$category.image.medium.url}"
            alt="{if !empty($category.image.legend)}{$category.image.legend}{else}{$category.name}{/if}"
            loading="lazy"
            width="250"
            height="250"
          >
        </picture>
      </a>
  
      <h1 class="h2">
        <a href="{$category.url}">{$category.name}</a>
      </h1>
  
      <div class="category-description">{$category.description nofilter}</div>
    </section>
  {/block}