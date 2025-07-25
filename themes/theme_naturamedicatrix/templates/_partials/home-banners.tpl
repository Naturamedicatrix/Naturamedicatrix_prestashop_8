{assign var="productchocId" value=10}
{assign var="productchocName" value=Product::getProductName({$productchocId})}
{assign var='productchocCover' value=Product::getCover({$productchocId})}
{assign var='productchocRewrite' value=Product::getUrlRewriteInformations({$productchocId})}



<div id="home-banners" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-2">

  <!-- Bloc CHOC -->
  <div id="banner-choc" class="w-full">
    <div class="banner relative bg-[#ECF7ED] rounded-xl p-6 min-h-[398px] text-center overflow-hidden text-gray-900 mb-0">
      <i class="bi bi-bookmark-star text-2xl mb-1.5 block"></i>
      <p class="text-base mb-0">Chaque semaine – Un prix <strong>CHOC</strong></p>
      <p class="text-sm mb-0"><span class="label">Jusqu'à 20% de remise totale</span></p>
      <p class="text-base mb-0">Aujourd'hui :
        <a href="{$link->getProductLink({$productchocId})}?utm_source=naturamedicatrix&utm_medium=choc&utm_campaign=product-{$productchocId}"
           class="font-semibold underline product-name">{$productchocName}</a>
      </p>
      <img src="{$link->getImageLink($productchocRewrite[0].link_rewrite, $productchocCover.id_image, 'home_default')|escape:'html':'UTF-8'}"
           alt="{$productchocName}" loading="lazy" class="mx-auto max-h-[200px]">
      <a href="{$link->getProductLink({$productchocId})}?utm_source=naturamedicatrix&utm_medium=choc&utm_campaign=product-{$productchocId}"
         class="btn btn-primary max-w-xs mx-auto">J'en profite</a>
      <div class="absolute w-[150px] h-[150px] rounded-full bg-[#C8E0CA] right-[-50px] bottom-[50px] -z-10"></div>
    </div>
  </div>

  <!-- Bloc Consultation -->
  <div id="banner-consult" class="w-full">
    <div class="banner relative bg-[#ECF0F7] rounded-xl p-6 min-h-[398px] text-center overflow-hidden text-gray-900 mb-0">
      <i class="bi bi-calendar-heart text-2xl mb-1.5 block"></i>
      <p class="text-base mb-1.5">Réservez une <strong>consultation</strong> de nutrition fonctionnelle avec nos professionnels de la santé</p>
      <p class="text-sm mb-0">Fabien Piasco | Anthony-Damien Désirée</p>
      <img src="{$urls.child_img_url}home-banners/banner_consultation.png"
           alt="Anthony-Damien Désirée - Fabien Piasco" class="mx-auto max-h-[200px]">
      <a href="{$link->getPageLink('contact', true)}" class="btn btn-primary max-w-xs mx-auto">Prendre rendez-vous</a>
      <div class="absolute w-[150px] h-[150px] rounded-full bg-[#D2DAE8] right-[20px] bottom-[-80px] -z-10"></div>
    </div>
  </div>

  <!-- Bloc DLU -->
  <div id="banner-dlu" class="w-full">
    <div class="banner relative bg-[#F7ECEC] rounded-xl p-6 min-h-[398px] text-center overflow-hidden text-gray-900 mb-0">
      <i class="bi bi-clock text-2xl mb-1.5 block"></i>
      <p class="text-base mb-0"><strong>Vente rapide</strong></p>
      <p class="text-base mb-0">Date limite d’utilisation conseillée et fin de stock</p>
      <p class="text-sm mb-0"><span class="label">Jusqu'à -50%</span></p>
      <img src="{$urls.child_img_url}home-banners/banner_dlu.png"
           alt="Profitez de nos ventes rapides à prix économiques" loading="lazy" class="mx-auto max-h-[200px]">
      <a href="{$link->getCategoryLink(24)}" class="btn btn-primary max-w-xs mx-auto">J'en profite</a>
      <div class="absolute w-[150px] h-[150px] rounded-full bg-[#E6D3D3] left-[-50px] top-[50px] -z-10"></div>
    </div>
  </div>

</div>




<style>
  .banner {
    position: relative;
    z-index: 1;
    min-height: 404px;
  }
  
  .banner:after {
    position: absolute;
    display: block;
    content: '';
    z-index: -1;
    border-radius: 50%;
  }
  
  #home-banners  .banner a {
    border-bottom: none;
    color: #111827;
  }
  
  
  .banner .label {
    background-color: #e45b7f !important;
    color: #f9fafb !important;
    border-color: #e45b7f !important;
    font-weight: 900 !important;
    display: inline-block;
    padding: 2px 10px;
    border-radius: 15px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 2px;
  }
  
  #banner-choc .banner {
    background: #ECF7ED;
  }
  
  #banner-choc .banner:after {
    width: 150px;
    height: 150px;
    right: -50px;
    bottom: 50px;
    background: #C8E0CA;
  }
  
  #banner-consult .banner {
    background: #ECF0F7;
  }
  
  #banner-consult .banner:after {
    width: 150px;
    height: 150px;
    right: 20px;
    bottom: -80px;
    background: #D2DAE8;
  }
  
  #banner-dlu .banner {
    background: #F7ECEC;
  }
  
  #banner-dlu .banner:after {
    width: 150px;
    height: 150px;
    left: -50px;
    top: 50px;
    background: #E6D3D3;
  }
</style>