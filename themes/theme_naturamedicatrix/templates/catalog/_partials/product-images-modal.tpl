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
<div class="modal fade js-product-images-modal" id="product-modal" data-backdrop="true" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close mobile-modal-close" data-dismiss="modal" aria-label="Fermer">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body">
        {assign var=imagesCount value=$product.images|count}
        <figure>
          {if $product.default_image}
            <picture>
              {if !empty($product.default_image.bySize.large_default.sources.avif)}<source srcset="{$product.default_image.bySize.large_default.sources.avif}" type="image/avif">{/if}
              {if !empty($product.default_image.bySize.large_default.sources.webp)}<source srcset="{$product.default_image.bySize.large_default.sources.webp}" type="image/webp">{/if}
              <img
                class="js-modal-product-cover product-cover-modal"
                width="{$product.default_image.bySize.large_default.width}"
                src="{$product.default_image.bySize.large_default.url}"
                {if !empty($product.default_image.legend)}
                  alt="{$product.default_image.legend}"
                  title="{$product.default_image.legend}"
                {else}
                  alt="{$product.name}"
                {/if}
                height="{$product.default_image.bySize.large_default.height}"
              >
            </picture>
          {else}
            <picture>
              {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}" type="image/avif">{/if}
              {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}<source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}" type="image/webp">{/if}
              <img src="{$urls.no_picture_image.bySize.large_default.url}" loading="lazy" width="{$urls.no_picture_image.bySize.large_default.width}" height="{$urls.no_picture_image.bySize.large_default.height}" />
            </picture>
          {/if}
          
          <div id="modal-video-container" style="display: none;">
            {if isset($product.video_iframe) && $product.video_iframe}
              {$product.video_iframe nofilter}
            {/if}
          </div>
          
          <style>
          /* Cacher la croix par défaut (desktop) */
          .mobile-modal-close {
            display: none;
          }
            
          #modal-video-container {
            top: 36px !important;
          }
            #modal-video-container iframe {
              width: 635px;
              height: 635px;
            }
            
            @media (max-width: 767px) {
              /* Ajustement du modal lui-même */
              .modal-dialog {
                margin: 10px;
                width: auto;
                max-width: 95%;
              }
              
              .modal-content {
                border-radius: 8px;
              }
              
              .modal-body {
                padding: 15px 10px;
              }
              
              /* Ajustement de l'image principale */
              #modal-video-container {
                position: absolute;
                left: 0px;
                top: 30px;
                width: 100%;
              }
              
              #modal-video-container iframe {
                width: 100%;
                height: auto;
                aspect-ratio: 1/1;
                margin: 0 auto;
              }
              
              .js-modal-product-cover {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
              }
              
              /* Optimisation des miniatures */
              .thumbnails {
                margin-top: 15px;
              }
              
              .product-images.js-modal-product-images {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding: 5px 0 10px;
                margin: 0 -5px;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
                justify-content: center;
              }
              
              .js-modal-product-images .thumb-container {
                flex: 0 0 auto;
                width: 70px;
                margin: 0 5px;
                scroll-snap-align: start;
              }
              
              .js-modal-product-images .thumb {
                margin: 0;
                height: 70px;
                object-fit: cover;
                border: 2px solid transparent;
              }
              
              .js-modal-product-images .thumb.selected {
                border-color: #83b58b;
              }
              
              /* Masquer les flèches en mobile car on utilise le scroll */
              .arrows.js-modal-arrows {
                display: none;
              }

              #youtube-thumbnail {
                height: 60px !important;
              }
              
              /* Style du bouton fermer */
              .close {
                opacity: 1;
              }
              button.close {
                background: #ffffff;
              }
              .mobile-modal-close {
                position: absolute;
                top: -6px;
                right: 0px;
                z-index: 1050;
                background-color: rgba(255, 255, 255, 0.95);
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 30px;
                line-height: 1;
                padding: 0;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
                color: #333;
                font-weight: bold;
                border: 1px solid #ddd;
              }
            }
          </style>
          
          
{*
          <figcaption class="image-caption">
            {block name='product_description_short'}
              <div id="product-description-short">{$product.description_short nofilter}</div>
            {/block}
          </figcaption>
*}
        </figure>
        <aside id="thumbnails" class="thumbnails js-thumbnails text-sm-center">
          {block name='product_images'}
            <div class="js-modal-mask mask {if $imagesCount <= 5} nomargin {/if}">
              <ul class="product-images js-modal-product-images">
                {foreach from=$product.images item=image}
                  <li class="thumb-container js-thumb-container">
                    <picture>
                      {if !empty($image.medium.sources.avif)}<source srcset="{$image.medium.sources.avif}" type="image/avif">{/if}
                      {if !empty($image.medium.sources.webp)}<source srcset="{$image.medium.sources.webp}" type="image/webp">{/if}
                      <img
                        data-image-large-src="{$image.large.url}"
                        {if !empty($image.large.sources)}data-image-large-sources="{$image.large.sources|@json_encode}"{/if}
                        class="thumb js-modal-thumb"
                        src="{$image.medium.url}"
                        {if !empty($image.legend)}
                          alt="{$image.legend}"
                          title="{$image.legend}"
                        {else}
                          alt="{$product.name}"
                        {/if}
                        width="{$image.medium.width}"
                        height="148"
                      >
                    </picture>
                  </li>
                {/foreach}
                
                {if isset($product.video_iframe) && $product.video_iframe}
                <li id="modal-video-thumbnail" class="thumb-container js-thumb-container thumb-video">
                  <div id="youtube-thumbnail" class="thumb js-thumb" style="position: relative; background-position: center; height: 100px;">
                    <div id="video-play-icon" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                      <i class="text-xl bi bi-play-circle"></i>
                    </div>
                  </div>
                </li>
                {/if}
                
              </ul>
            </div>
          {/block}
          {if $imagesCount > 5}
            <div class="arrows js-modal-arrows">
              <i class="material-icons arrow-up js-modal-arrow-up">&#xE5C7;</i>
              <i class="material-icons arrow-down js-modal-arrow-down">&#xE5C5;</i>
            </div>
          {/if}
        </aside>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour initialiser la vidéo et les miniatures dans le modal
    function initializeModalVideo() {
      var videoContainer = document.getElementById('modal-video-container');
      if (!videoContainer) return;
      
      var videoIframe = {if isset($product.video_iframe)}true{else}false{/if};
      
      if (videoIframe) {
        // Extrait l'ID YouTube de l'iframe
        var iframeContent = videoContainer.innerHTML;
        var videoId = null;
        
        // Essaye de trouver l'ID YouTube dans l'URL de l'iframe
        var match = iframeContent.match(/youtube\.com\/embed\/([^\/?&"']+)/i);
        if (match && match[1]) {
          videoId = match[1];
        }
        
        if (videoId) {
          // Charge la miniature YouTube
          var thumbnailUrl = 'https://img.youtube.com/vi/' + videoId + '/mqdefault.jpg';
          var thumbnailElement = document.getElementById('youtube-thumbnail');
          if (thumbnailElement) {
            thumbnailElement.style.backgroundImage = 'url(' + thumbnailUrl + ')';
          }
          
          // Remplace l'icône par le logo YouTube
          var videoPlayIcon = document.getElementById('video-play-icon');
          if (videoPlayIcon) {
            videoPlayIcon.innerHTML = '\
              <svg viewBox="0 0 68 48" width="36" height="25" xmlns="http://www.w3.org/2000/svg" style="background: transparent !important; background-color: transparent !important;" fill="none">\
                <rect width="68" height="48" fill="transparent" />\
                <path d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path>\
                <path d="M 45,24 27,14 27,34" fill="#fff"></path>\
              </svg>';
          }
        }
      }
      
      // Réinitialiser les écouteurs d'événements
      // Affiche la vidéo quand on clique sur la miniature
      var modalVideoThumbnail = document.getElementById('modal-video-thumbnail');
      if (modalVideoThumbnail) {
        // Supprimer les écouteurs existants pour éviter les doublons
        modalVideoThumbnail.removeEventListener('click', showVideo);
        modalVideoThumbnail.addEventListener('click', showVideo);
      }
      
      // Cache la vidéo quand on clique sur une image
      var imageElements = document.querySelectorAll('.js-modal-thumb');
      imageElements.forEach(function(image) {
        // Supprimer les écouteurs existants pour éviter les doublons
        image.removeEventListener('click', hideVideo);
        image.addEventListener('click', hideVideo);
      });
    }
    
    // Fonction pour afficher la vidéo
    function showVideo() {
      var videoContainer = document.getElementById('modal-video-container');
      if (videoContainer) {
        videoContainer.style.display = 'block';
      }
    }
    
    // Fonction pour cacher la vidéo
    function hideVideo() {
      var videoContainer = document.getElementById('modal-video-container');
      if (videoContainer) {
        videoContainer.style.display = 'none';
      }
    }
    
    // Initialisation au chargement de la page
    initializeModalVideo();
    
    // Réinitialisation lors du changement de déclinaison (événement PrestaShop)
    prestashop.on('updatedProduct', function(event) {
      // On laisse un peu de temps au DOM pour se mettre à jour
      setTimeout(function() {
        initializeModalVideo();
      }, 100);
    });
    
    // Réinitialisation lorsque le modal est ouvert
    $('#product-modal').on('shown.bs.modal', function () {
      initializeModalVideo();
      
      // Marquer l'image principale comme sélectionnée par défaut
      highlightSelectedThumbnail(document.querySelector('.js-modal-thumb'));
    });
    
    // Fonction pour mettre en évidence la miniature sélectionnée
    function highlightSelectedThumbnail(selectedThumb) {
      // Enlever la classe 'selected' de toutes les miniatures
      document.querySelectorAll('.js-modal-thumb').forEach(function(thumb) {
        thumb.classList.remove('selected');
      });
      
      // Ajouter la classe 'selected' à la miniature sélectionnée
      if (selectedThumb) {
        selectedThumb.classList.add('selected');
      }
    }
    
    // Ajouter des écouteurs d'événements sur les miniatures pour les mettre en évidence au clic
    document.querySelectorAll('.js-modal-thumb').forEach(function(thumb) {
      thumb.removeEventListener('click', handleThumbnailClick);
      thumb.addEventListener('click', handleThumbnailClick);
    });
    
    function handleThumbnailClick(event) {
      highlightSelectedThumbnail(event.currentTarget);
    }
    
    // Gestionnaire spécifique pour fermer le modal sur mobile en cliquant à l'extérieur
    function setupModalCloseOnOutsideClick() {
      var modal = document.getElementById('product-modal');
      var modalDialog = modal.querySelector('.modal-dialog');
      
      // Détecter si c'est un appareil mobile
      var isMobileDevice = window.matchMedia('(max-width: 767px)').matches;
      
      if (isMobileDevice) {
        // Supprime l'ancien gestionnaire d'événement s'il existe
        modal.removeEventListener('click', handleModalOutsideClick);
        
        // Ajoute le gestionnaire d'événement
        modal.addEventListener('click', handleModalOutsideClick);
        
        // Ajouter une classe pour vérifier que le script est bien appliqué
        modal.classList.add('mobile-touch-enabled');
      }
      
      function handleModalOutsideClick(event) {
        // Si le clic est sur le fond du modal (pas sur son contenu)
        if (event.target === modal && !modalDialog.contains(event.target)) {
          // Fermer le modal via l'API Bootstrap
          $('#product-modal').modal('hide');
        }
      }
    }
    
    // Exécuter la configuration au chargement et lorsque le modal est ouvert
    setupModalCloseOnOutsideClick();
    $('#product-modal').on('shown.bs.modal', setupModalCloseOnOutsideClick);
  });
</script>