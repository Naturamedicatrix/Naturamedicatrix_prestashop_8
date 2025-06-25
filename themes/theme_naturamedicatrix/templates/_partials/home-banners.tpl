{assign var="productchocId" value=10}
{assign var="productchocName" value=Product::getProductName({$productchocId})}
{assign var='productchocCover' value=Product::getCover({$productchocId})}
{assign var='productchocRewrite' value=Product::getUrlRewriteInformations({$productchocId})}



<div id="home-banners" class="row">
  
  <div class="col-lg-4 col-md-4 col-xs-12" id="banner-choc">
    <div class="banner">
      <i class="bi bi-bookmark-star"></i>
      <p class="pb-0">Chaque semaine - Un prix <strong>CHOC</strong></p>
      <p><span class="label">Jusqu'à 20% de remise totale</span></p>
      <p class="pb-0">Aujourd'hui&nbsp;: <a href="{$link->getProductLink({$productchocId})}?utm_source=naturamedicatrix&utm_medium=choc&utm_campaign=product-{$productchocId}" title="Je profite de {$productchocName}"><strong class="product-name">{$productchocName}</strong></a></p>
      
      <img src="{$link->getImageLink($productchocRewrite[0].link_rewrite, $productchocCover.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{$productchocName}" loading="lazy" class="img-responsive" height="200">
      <a href="{$link->getProductLink({$productchocId})}?utm_source=naturamedicatrix&utm_medium=choc&utm_campaign=product-{$productchocId}" title="Je profite de {$productchocName}" class="btn btn-primary">J'en profite</a>
    </div>
  </div>
  
  <div class="col-lg-4 col-md-4 col-xs-12" id="banner-consult">
    <div class="banner">
      <i class="bi bi-calendar-heart"></i>
      <p class="pb-0">Réservez une <strong>consultation</strong> de nutrition fonctionnelle avec nos professionnels de la santé</p>
      <p><small>Fabien Piasco | Anthony-Damien Désirée</small></p>
      
      <img src="{$urls.child_img_url}home-banners/banner_consultation.png" alt="Anthony-Damien Désirée - Fabien Piasco" class="therapeute-img img-responsive" width="200">
      <a href="{$link->getPageLink('contact', true)}" title="Je prends un rendez-vous" class="btn btn-primary">Prendre rendez-vous</a>
    </div>
  </div>
  
  <div class="col-lg-4 col-md-4 col-xs-12" id="banner-dlu">
    <div class="banner">
      <i class="bi bi-clock"></i>
      <p class="pb-0"><strong>Vente rapide</strong></p>
      <p>Date limite d’utilisation conseillée et fin de stock</p>
      <p class="pb-0"><span class="label">Jusqu'à -50%</span></p>
      <img src="{$urls.child_img_url}home-banners/banner_dlu.png" alt="Profitez de nos ventes rapides à prix économiques" loading="lazy" height="200" class="img-responsive">
      <a href="{$link->getCategoryLink(24)}" title="Profitez de nos ventes rapides à prix économiques" class="btn btn-primary">J'en profite</a>
    </div>
    
    
  </div> 
</div>



<style>
  #home-banners .banner {
    text-align: center;
    padding: 20px;
    color: #111827;
    position: relative;
    overflow: hidden;
    z-index: 1;
    margin-bottom: 30px;
    border-radius: 10px;
    min-height: 398px;
  }
  
  #home-banners .banner:after {
    position: absolute;
    display: block;
    content: '';
    z-index: -1;
    border-radius: 50%;
  }
  
  #home-banners a {
    border-bottom: none;
    color: #111827;
  }
  
  #home-banners i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    display: block;
  }
  
  #home-banners .btn {
    width: 100%;
    min-width: inherit;
    max-width: 225px;
  }
  
  #home-banners img {
    margin: 0 auto;
    max-height: 200px;
    width: auto;
  }
  
  #home-banners p {
    max-width: 350px;
    margin: 0 auto;
    line-height: 1.3;
  } 
  
  #home-banners .label {
    background-color: #e45b7f !important;
    color: #f9fafb !important;
    border-color: #e45b7f !important;
    font-weight: 900 !important;
    font-size: 0.8rem;
    display: inline-block;
    padding: 4px 10px 2px;
    border-radius: 15px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 2px;
  }
  
  #home-banners #banner-choc .banner {
    background: #ECF7ED;
  }
  
  #home-banners #banner-choc .banner:after {
    width: 150px;
    height: 150px;
    right: -50px;
    bottom: 50px;
    background: #C8E0CA;
  }
  
  #home-banners #banner-consult .banner {
    background: #ECF0F7;
  }
  
  #home-banners #banner-consult .banner:after {
    width: 150px;
    height: 150px;
    right: 20px;
    bottom: -80px;
    background: #D2DAE8;
  }
  
  #home-banners #banner-dlu .banner {
    background: #F7ECEC;
  }
  
  #home-banners #banner-dlu .banner:after {
    width: 150px;
    height: 150px;
    left: -50px;
    top: 50px;
    background: #E6D3D3;
  }
</style>