<style>
  #home-banners .banner {
    text-align: center;
    padding: 20px;
    color: #111827;
    position: relative;
    overflow: hidden;
    z-index: 1;
  }
  
  #home-banners .banner:after {
    position: absolute;
    display: block;
    content: '';
    z-index: 0;
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
    max-width: 310px;
    margin: 0 auto;
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
    line-height: 1.2;
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

<div id="home-banners" class="row">
  
  <div class="col-lg-4" id="banner-choc">
    <div class="banner">
      <i class="bi bi-bookmark-star"></i>
      <p>Chaque semaine - Un prix <strong>CHOC</strong></p>
      <span class="label">Jusqu'à 20% de remise totale</span>
      <p>Aujourd'hui&nbsp;: <strong class="product-name">Omega-11</strong></p>
      <p><img src="https://new.naturamedicatrix.fr/34-home_default/affiche-encadree-today-is-a-good-day.jpg" alt="Nuit Sereine" loading="lazy" data-full-size-image-url="https://new.naturamedicatrix.fr/34-large_default/affiche-encadree-today-is-a-good-day.jpg" width="125" height="125"></p>
      <a href="#" class="btn btn-primary">J'en profite</a>
    </div>
  </div>
  
  <div class="col-lg-4" id="banner-consult">
    <div class="banner">
      <i class="bi bi-calendar-heart"></i>
      <p>Réservez une <strong>consultation</strong> de nutrition fonctionnelle avec nos professionnels de la santé</p>
      
      <p><img src="https://new.naturamedicatrix.fr/themes/theme_naturamedicatrix/assets/img/therapeutes/Antho.jpg" alt="Anthony-Damien Désirée - Naturamedicatrix" class="therapeute-img" width="80"></p>
      <a href="#" class="btn btn-primary">Prendre rendez-vous</a>
    </div>
  </div>
  
  <div class="col-lg-4" id="banner-dlu">
    <div class="banner">
      <i class="bi bi-clock"></i>
      <p><strong>Vente rapide</strong></p>
      <p>Date limite d’utilisation conseillée et fin de stock</p>
      <span class="label">Jusqu'à -50%</span>
      <br />
      <img src="https://new.naturamedicatrix.fr/36-home_default/mug-today-is-a-good-day.jpg" alt="Jus Aloe vera bio (avec pulpe)" loading="lazy" data-full-size-image-url="https://new.naturamedicatrix.fr/36-large_default/mug-today-is-a-good-day.jpg" width="125" height="125">
      <a href="#" class="btn btn-primary">J'en profite</a>
    </div>
    
    
  </div>
  
</div>