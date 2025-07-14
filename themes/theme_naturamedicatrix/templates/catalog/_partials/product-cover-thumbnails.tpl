{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div class="images-container js-images-container">
  {block name='product_cover'}
    <div class="product-cover">
      {if $product.default_image}
        <picture>
          {if !empty($product.default_image.bySize.medium_default.sources.avif)}<source srcset="{$product.default_image.bySize.medium_default.sources.avif}" type="image/avif">{/if}
          {if !empty($product.default_image.bySize.medium_default.sources.webp)}<source srcset="{$product.default_image.bySize.medium_default.sources.webp}" type="image/webp">{/if}
          <img
            class="js-qv-product-cover img-fluid"
            src="{$product.default_image.bySize.medium_default.url}"
            {if !empty($product.default_image.legend)}
              alt="{$product.default_image.legend}"
              title="{$product.default_image.legend}"
            {else}
              alt="{$product.name}"
            {/if}
            loading="lazy"
            width="{$product.default_image.bySize.medium_default.width}"
            height="{$product.default_image.bySize.medium_default.height}"
          >
        </picture>
        <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
          <i class="material-icons zoom-in">search</i>
        </div>
      {else}
        <picture>
          {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}" type="image/avif">{/if}
          {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}" type="image/webp">{/if}
          <img
            class="img-fluid"
            src="{$urls.no_picture_image.bySize.large_default.url}"
            loading="lazy"
            width="{$urls.no_picture_image.bySize.large_default.width}"
            height="{$urls.no_picture_image.bySize.large_default.height}"
          >
        </picture>
      {/if}
      
      <div class="flex justify-center font-semibold text-gray-600">
         <p class="flex cursor-pointer items-center mb-0">
            <svg class="w-4 h-4 mr-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
            </svg>
            <span class="mx-auto underline">Voir en plein écran</span>
         </p>
      </div>

            
    </div>
  {/block}


  {if count($product.images) > 1 || isset($product.video_iframe) && $product.video_iframe}
  {block name='product_images'}
    <div class="js-qv-mask mask">
      <ul class="product-images js-qv-product-images">
        {foreach from=$product.images item=image}
          <li class="thumb-container js-thumb-container">
            <picture>
              {if !empty($image.bySize.small_default.sources.avif)}<source srcset="{$image.bySize.small_default.sources.avif}" type="image/avif">{/if}
              {if !empty($image.bySize.small_default.sources.webp)}<source srcset="{$image.bySize.small_default.sources.webp}" type="image/webp">{/if}
              <img
                class="thumb js-thumb {if $image.id_image == $product.default_image.id_image} selected js-thumb-selected {/if}"
                data-image-medium-src="{$image.bySize.medium_default.url}"
                {if !empty($image.bySize.medium_default.sources)}data-image-medium-sources="{$image.bySize.medium_default.sources|@json_encode}"{/if}
                data-image-large-src="{$image.bySize.large_default.url}"
                {if !empty($image.bySize.large_default.sources)}data-image-large-sources="{$image.bySize.large_default.sources|@json_encode}"{/if}
                src="{$image.bySize.small_default.url}"
                {if !empty($image.legend)}
                  alt="{$image.legend}"
                  title="{$image.legend}"
                {else}
                  alt="{$product.name}"
                {/if}
                loading="lazy"
                width="{$product.default_image.bySize.small_default.width}"
                height="{$product.default_image.bySize.small_default.height}"
              >
            </picture>
          </li>
        {/foreach}
        
                
        {if isset($product.video_iframe) && $product.video_iframe}
        <li id="video-thumbnail" class="thumb-container js-thumb-container thumb-video" data-toggle="modal" data-target="#product-modal">
          <div id="product-youtube-thumbnail" class="thumb js-thumb" style="position: relative; background-size: cover; background-position: center;">
            <div id="product-video-play-icon" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
              <i class="text-xl bi bi-play-circle"></i>
            </div>
          </div>
        </li>
        {/if}
        
        
      </ul>
    </div>
  {/block}
  {/if}
{hook h='displayAfterProductThumbs' product=$product}
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour initialiser la miniature YouTube
    function initializeYouTubeThumbnail() {
      {if isset($product.video_iframe) && $product.video_iframe}
      // Extrait l'ID YouTube de l'iframe
      var iframeContent = `{$product.video_iframe|escape:'javascript'}`;
      var videoId = null;
      
      // Essaye de trouver l'ID YouTube dans l'URL de l'iframe
      var match = iframeContent.match(/youtube\.com\/embed\/([^\/?&"']+)/i);
      if (match && match[1]) {
        videoId = match[1];
        
        // Charge la miniature YouTube
        var thumbnailUrl = 'https://img.youtube.com/vi/' + videoId + '/mqdefault.jpg';
        var thumbnailElement = document.getElementById('product-youtube-thumbnail');
        if (thumbnailElement) {
          thumbnailElement.style.backgroundImage = 'url(' + thumbnailUrl + ')';
        }
        
        // Remplace l'icône par le logo YouTube
        var playIcon = document.getElementById('product-video-play-icon');
        if (playIcon) {
          playIcon.innerHTML = '\
            <svg viewBox="0 0 68 48" width="36" height="25" xmlns="http://www.w3.org/2000/svg" style="background: transparent !important; background-color: transparent !important;" fill="none">\
              <rect width="68" height="48" fill="transparent" />\
              <path d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path>\
              <path d="M 45,24 27,14 27,34" fill="#fff"></path>\
            </svg>';
        }
      }
      {/if}
    }
    
    // Initialisation au chargement de la page
    initializeYouTubeThumbnail();
    
    // Réinitialisation lors du changement de déclinaison (événement PrestaShop)
    prestashop.on('updatedProduct', function(event) {
      setTimeout(function() {
        initializeYouTubeThumbnail();
        var videoThumbnail = document.getElementById('video-thumbnail');
        if (videoThumbnail) {
          videoThumbnail.setAttribute('data-toggle', 'modal');
          videoThumbnail.setAttribute('data-target', '#product-modal');
        }
      }, 100);
    });
  });
</script>
