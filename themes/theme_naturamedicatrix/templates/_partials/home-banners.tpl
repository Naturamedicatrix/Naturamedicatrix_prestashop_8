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
  
  #home-banners i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    display: block;
  }
  
  #home-banners img {
    margin: 0 auto;
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

{assign var="productchocid" value=10}
{assign var="productchocname" value=Product::getProductName({$productchocid})}

<div id="home-banners" class="row">
  
  <div class="col-lg-4" id="banner-choc">
    <div class="banner">
      <i class="bi bi-bookmark-star"></i>
      <p class="pb-0">Chaque semaine - Un prix <strong>CHOC</strong></p>
      <p><span class="label">Jusqu'à 20% de remise totale</span></p>
      <p class="pb-0">Aujourd'hui&nbsp;: <strong class="product-name">{$productchocname}</strong></p>
      
      <img src="https://new.naturamedicatrix.fr/41-home_default/coussin-ours-brun.jpg" alt="Nuit Sereine" loading="lazy" class="img-responsive" height="200">
      <a href="{$link->getProductLink({$productchocid})}?utm_source=naturamedicatrix&utm_medium=choc&utm_campaign=product-{$productchocid}" class="btn btn-primary">J'en profite</a>
    </div>
  </div>
  
  <div class="col-lg-4" id="banner-consult">
    <div class="banner">
      <i class="bi bi-calendar-heart"></i>
      <p class="pb-0">Réservez une <strong>consultation</strong> de nutrition fonctionnelle avec nos professionnels de la santé</p>
      <p><small>Fabien Piasco | Anthony-Damien Désirée</small></p>
      
      <img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/home-banners/banner_consultation.png" alt="Anthony-Damien Désirée - Fabien Piasco" class="therapeute-img img-responsive" width="200">
      <a href="#" class="btn btn-primary">Prendre rendez-vous</a>
    </div>
  </div>
  
  <div class="col-lg-4" id="banner-dlu">
    <div class="banner">
      <i class="bi bi-clock"></i>
      <p class="pb-0"><strong>Vente rapide</strong></p>
      <p>Date limite d’utilisation conseillée et fin de stock</p>
      <p class="pb-0"><span class="label">Jusqu'à -50%</span></p>
      <img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/home-banners/banner_dlu.png" alt="Jus Aloe vera bio (avec pulpe)" loading="lazy" height="200" class="img-responsive">
      <a href="#" class="btn btn-primary">J'en profite</a>
    </div>
    
    
  </div>
  
</div>