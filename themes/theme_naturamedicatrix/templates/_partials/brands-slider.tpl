{if !isset($brands) || $brands|count == 0}
  {assign var="manufacturers" value=Manufacturer::getManufacturers()}
  
  {* Création du tableau des marques formatées *}
  {assign var="formatted_brands" value=[]}
  {foreach from=$manufacturers item=manufacturer}

      {* Récupération du nombre de produits *}
      {assign var="product_count" value=Manufacturer::getProducts($manufacturer.id_manufacturer, Context::getContext()->language->id, 0, 0, null, null, true)}

      {* Ajout de la marque dans le array formatted_brands *}
      {assign var="formatted_brands" value=$formatted_brands|array_merge:[[
        'id_manufacturer' => $manufacturer.id_manufacturer,
        'name' => $manufacturer.name,
        'image' => "{$urls.img_manu_url}{$manufacturer.id_manufacturer}-small_default.jpg",
        'url' => {url entity='manufacturer' id=$manufacturer.id_manufacturer},
        'short_description' => $manufacturer.short_description,
        'nb_products' => $product_count
      ]]}
   
  {/foreach}
{else}
  {assign var="formatted_brands" value=$brands}
{/if}


<div class="bg-gray-50 bg-wrapper py-16 mt-20 mb-20">
  <div class="container mx-auto px-0 lg:px-8 overflow-hidden">
    <header class="page-header mb-0 mt-0">
    <div class="all-product-link text-center">
      <a href="{$urls.pages.manufacturer}" class="font-normal text-gray-600 text-sm hover:text-gray-800">» {l s='See all brands' d='Shop.Theme.Actions'}</a>
    </div>
      <h2 class="text-center text-lg md:text-2xl font-bold mb-0 mt-1.5">{l s='Our partner brands' d='Shop.Theme.Actions'}</h2>
      <div class="title-separator">
        <svg id="logoTitle" class="logo-h3 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
          <path class="logo-title"
            d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
        </svg>
      </div>
    </header>
    <div class="relative">
      <div class="brands-slider mb-1 mt-1">
        {foreach from=$formatted_brands item=brand}
          <div class="px-2">
            <a href="{$brand.url}" class="block">
              <img src="{$brand.image}" alt="{$brand.name}" class="bw-logo h-24 object-contain mx-auto" loading="lazy" />
            </a>
          </div>
        {/foreach}
      </div>

    </div>

  </div>
</div>


<style>
  .bw-logo {
    filter: grayscale(100%);
    transition: filter 0.3s ease;
  }

  .bw-logo:hover {
    filter: grayscale(0%);
  }
</style>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    let slider = tns({
      container: '.brands-slider',
      items: 6,
      slideBy: 1,
      autoplay: false,
      speed: 2000,
      controls: false,
      nav: true,
      mouseDrag: true,
      gutter: 0,
      loop: true,
      rewind: false,
      responsive: {
        0: { items: 2 },
        640: { items: 3 },
        1024: { items: 5 },
        1280: { items: 6 }
      }
    });

    // Autoplay manuel avec intervalle constant
    let autoplayInterval;
    let isHovered = false;
    let isDragging = false;

    function startAutoplay() {
      if (autoplayInterval) clearInterval(autoplayInterval);
      autoplayInterval = setInterval(() => {
        if (!isHovered && !isDragging) {
          slider.goTo('next');
        }
      }, 2000);
    }

    function stopAutoplay() {
      if (autoplayInterval) clearInterval(autoplayInterval);
    }

    // Gestion hover
    document.querySelector('.brands-slider').addEventListener('mouseenter', () => {
      isHovered = true;
    });

    document.querySelector('.brands-slider').addEventListener('mouseleave', () => {
      isHovered = false;
    });

    // Gestion drag
    slider.events.on('dragStart', () => {
      isDragging = true;
    });

    slider.events.on('dragEnd', () => {
      isDragging = false;
    });

    // Démarre l'autoplay
    startAutoplay();
  });
</script>

