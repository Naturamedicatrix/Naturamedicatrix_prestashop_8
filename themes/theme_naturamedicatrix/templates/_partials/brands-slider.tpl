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
        'image' => "{$urls.img_manu_url}{$manufacturer.id_manufacturer}-brand_default.jpg",
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
      <h2 class="text-center text-lg md:text-2xl font-bold mb-0 mt-0">{l s='Our partner brands' d='Shop.Theme.Actions'}</h2>
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
              <img src="{$brand.image}" alt="{$brand.name}" class="bw-logo h-24 object-contain mx-auto max-w-[160px]" loading="lazy" />
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

  .tns-controls {
    position: absolute;
    top: -35px;
    right: 0;
    z-index: 10;
    margin-top: 0;
    display: flex;
    gap: 0.5rem;
    pointer-events: all;
  }

  .tns-controls button {
    background-color: white;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s ease;
  }

  .tns-controls button:hover {
    background-color: #f8fafc;
  }

  .tns-controls button:before {
    content: '';
    display: block;
    width: 18px;
    height: 18px;
    background-size: contain;
    background-repeat: no-repeat;
  }

  .tns-controls [data-controls="prev"]:before {
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z'/></svg>");
  }

  .tns-controls [data-controls="next"]:before {
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z'/></svg>");
  }

  /* Dots pagination */
  .tns-nav {
    margin-top: 1rem;
    text-align: center;
  }

  .tns-nav button {
    width: 12px;
    height: 12px;
    border-radius: 9999px;
    background-color: #d1d5db;
    border: none;
    margin: 0 5px;
    transition: background-color 0.3s ease;
  }

  .tns-nav button.tns-nav-active {
    background-color: #1f2937;
  }
</style>




<script>
  document.addEventListener('DOMContentLoaded', function () {
    tns({
      container: '.brands-slider',
      items: 5,
      slideBy: 1,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      autoplayButtonOutput: false,
      controls: true,
      controlsText: ["", ""],
      nav: true,
      navPosition: 'bottom',
      mouseDrag: true,
      gutter: 0,
      responsive: {
        0: { items: 2 },
        640: { items: 3 },
        1024: { items: 5 },
        1280: { items: 6 }
      }
    });
  });
</script>

