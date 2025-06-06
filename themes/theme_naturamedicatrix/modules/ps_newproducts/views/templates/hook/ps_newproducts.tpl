{**
 * Template pour le module ps_newproducts
 * Affiche des produits "nouveautés" avec un carousel
 *}

<section class="featured-products block-newproducts clearfix">
   <div class="all-product-link text-center">
   <a href="{$allNewProductsLink|default:$link->getPageLink('new-products')}">
     » {l s='Toutes nos nouveautés' d='Modules.Ps_newproducts.Shop'}
   </a>
   </div>
 
   <h2 class="h2 products-section-title">
     {l s='Nouveaux produits' d='Modules.Ps_newproducts.Shop'}
   </h2>
   
   <div class="title-separator">
     <svg id="logoTitle" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
       <path class="logo-title"
         d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z" />
     </svg>
   </div>

   <!-- Module ps_newproducts: Carousel -->
   <div id="newproducts-carousel" class="product-list-carousel newproducts-carousel" data-carousel-type="newproducts">
     {* Division des produits en 3 groupes pour le carousel desktop *}
     {assign var="productsCount" value=$products|count}
     {assign var="productsPerPage" value=3}
     {assign var="pagesCount" value=($productsCount / $productsPerPage)|ceil}
     
     {* Slides pour desktop (3 produits par slide) *}
     <div class="carousel-slides-desktop newproducts-slides-desktop">
       {for $page=0 to $pagesCount-1}
         {assign var="startIndex" value=$page*$productsPerPage}
         {assign var="endIndex" value=min(($startIndex+$productsPerPage), $productsCount)}
         {assign var="pageProducts" value=array_slice($products, $startIndex, $endIndex-$startIndex)}
         
         <div class="carousel-slide newproducts-slide {if $page == 0}active-new{/if}">
           {include file="catalog/_partials/productlist-newproducts.tpl" products=$pageProducts cssClass="row" productClass="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
         </div>
       {/for}
     </div>
     
     {* Slides pour mobile (1 produit par slide) *}
     <div class="carousel-slides-mobile newproducts-slides-mobile">
       {foreach from=$products item="product" key="index"}
         <div class="carousel-slide newproducts-slide {if $index == 0}active-new{/if}">
           <div class="row">
             <div class="col-xs-12">
               {include file="catalog/_partials/miniatures/product-newproduct.tpl" product=$product productClasses=""}
             </div>
           </div>
         </div>
       {/foreach}
     </div>
   </div>
   
   {* Pagination pour desktop (points selon le nombre de pages) *}
   <div class="newproducts-desktop-pagination" data-carousel-type="newproducts">
     {for $page=0 to $pagesCount-1}
       <span class="dot newproducts-dot {if $page == 0}active-new{/if}" data-slide="{$page}"></span>
     {/for}
   </div>
   
   {* Pagination pour mobile (un point par produit) *}
   <div class="newproducts-mobile-pagination" data-carousel-type="newproducts">
     {foreach from=$products item="product" key="index"}
       <span class="dot newproducts-dot {if $index == 0}active-new{/if}" data-slide="{$index}"></span>
     {/foreach}
   </div>
 </section>

<style>
/* Styles spécifiques pour le carousel des nouveaux produits */
#newproducts-carousel {
    position: relative;
    overflow: hidden;
    width: 100%;
}

@media (max-width: 992px) {
  #newproducts-carousel .js-product {
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
}

.newproducts-slides-desktop,
.newproducts-slides-mobile {
    position: relative;
    width: 100%;
    overflow: hidden;
}


.newproducts-slides-desktop {
    display: none;
}

.newproducts-slides-mobile {
    display: block;
}

.newproducts-desktop-pagination {
    display: none;
}

.newproducts-mobile-pagination {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    gap: 10px;
}

@media (min-width: 992px) {
    .newproducts-slides-desktop {
        display: block;
    }
    
    .newproducts-slides-mobile {
        display: none;
    }
    
    .newproducts-desktop-pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 10px;
    }
    
    .newproducts-mobile-pagination {
        display: none;
    }
}

.newproducts-slide {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
    opacity: 0.5;
    transform: translateX(100%);
    z-index: 1;
}

.newproducts-slide.active-new {
    opacity: 1;
    transform: translateX(0);
    position: relative;
    z-index: 2;
}

.newproducts-slide.prev-new {
    transform: translateX(-100%);
    opacity: 0.5;
    z-index: 1;
}

.newproducts-slide.next-new {
    transform: translateX(100%);
    opacity: 0.5;
    z-index: 1;
}

.newproducts-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #e5e8ea;
    display: inline-block;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.newproducts-dot.active-new {
    background-color: #68768a;
}

.newproducts-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.newproducts-nav:hover {
    background-color: rgba(255, 255, 255, 1);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
}

</style>

<script>
/**
 * Script pour le carousel des nouveaux produits
 */
document.addEventListener('DOMContentLoaded', function() {
  // Détection du type d'ecran (mobile et tablette vs desktop)
  const isMobileOrTablet = window.innerWidth < 992;
  
  // Affichage/masquage des éléments selon le type d'ecran
  const desktopCarousel = document.querySelector('.newproducts-slides-desktop');
  const mobileCarousel = document.querySelector('.newproducts-slides-mobile');
  const desktopPagination = document.querySelector('.newproducts-desktop-pagination');
  const mobilePagination = document.querySelector('.newproducts-mobile-pagination');
  
  if (isMobileOrTablet) {
    // Affichage mobile et tablette
    if (desktopCarousel) desktopCarousel.style.display = 'none';
    if (mobileCarousel) mobileCarousel.style.display = 'block';
    if (desktopPagination) desktopPagination.style.display = 'none';
    if (mobilePagination) mobilePagination.style.display = 'flex';
    
    // Initialisation du carousel mobile/tablette
    initCarousel('.newproducts-slides-mobile .newproducts-slide', '.newproducts-mobile-pagination .newproducts-dot');
  } else {
    // Affichage desktop uniquement
    if (desktopCarousel) desktopCarousel.style.display = 'block';
    if (mobileCarousel) mobileCarousel.style.display = 'none';
    if (desktopPagination) desktopPagination.style.display = 'flex';
    if (mobilePagination) mobilePagination.style.display = 'none';
    
    // Initialisation du carousel desktop
    initCarousel('.newproducts-slides-desktop .newproducts-slide', '.newproducts-desktop-pagination .newproducts-dot');
  }
  
  // Gère le redimensionnement de la fenêtre
  window.addEventListener('resize', function() {
    const newIsMobileOrTablet = window.innerWidth < 992;
    
    if (newIsMobileOrTablet === isMobileOrTablet) return;
    
    window.location.reload();
  });
  
  /* Initialise un carousel avec les slides et points de pagination spécifiés */
  function initCarousel(slidesSelector, dotsSelector) {
    // Variables
    let currentSlide = 0;
    const dots = document.querySelectorAll(dotsSelector);
    const slides = document.querySelectorAll(slidesSelector);
    const totalSlides = slides.length;
    
    // Variables pour le swipe
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    const minSwipeDistance = 50; // Distance minimale pour détecter un swipe
    
    if (!slides.length || !dots.length) return;
    
    // Récupere le conteneur parent pour les événements tactiles (mobile)
    const carouselContainer = slides[0].parentElement;
    
    // Masque toutes les slides sauf la première
    slides.forEach((slide, index) => {
      if (index === 0) {
        slide.classList.add('active-new');
      } else {
        slide.classList.add('next-new'); // Toutes les autres slides sont à droite
      }
    });
    
    /* Fonction pour afficher une slide spécifique avec animation */
    function showSlide(newIndex) {
      if (newIndex === currentSlide) return;
      
      // Détermine la direction
      const direction = newIndex > currentSlide ? 'next-new' : 'prev-new';
      
      // Met à jour les indicateurs
      dots.forEach(dot => dot.classList.remove('active-new'));
      dots[newIndex].classList.add('active-new');
      
      // Récupere les slides concernées
      const currentElement = slides[currentSlide];
      const nextElement = slides[newIndex];
      
      // Nettoie les classes précédentes
      slides.forEach(slide => {
        slide.classList.remove('active-new', 'prev-new', 'next-new');
        if (slide !== currentElement && slide !== nextElement) {
          slide.classList.add(direction === 'next-new' ? 'next-new' : 'prev-new');
        }
      });
      
      // Positionne la nouvelle slide
      if (direction === 'next-new') {
        // Animation vers la gauche
        currentElement.classList.add('prev-new');
        nextElement.classList.add('active-new');
      } else {
        // Animation vers la droite
        currentElement.classList.add('next-new');
        nextElement.classList.add('active-new');
      }
      
      currentSlide = newIndex;
    }
    
    // Ajoute les écouteurs d'événements sur les points de pagination
    dots.forEach((dot, index) => {
      dot.addEventListener('click', function(event) {
        event.stopPropagation(); // Éviter la propagation vers d'autres carousels
        event.preventDefault();
        showSlide(index);
      });
    });
    
    /* Fonction pour passer à la slide suivante */
    function nextSlide() {
      let nextIndex = currentSlide + 1;
      if (nextIndex >= totalSlides) {
        nextIndex = 0;
      }
      showSlide(nextIndex);
    }
    
    /* Fonction pour passer à la slide précédente */
    function prevSlide() {
      let prevIndex = currentSlide - 1;
      if (prevIndex < 0) {
        prevIndex = totalSlides - 1;
      }
      showSlide(prevIndex);
    }
    
    /* Fonctions pour la gestion des événements tactiles (swipe) */
    function handleTouchStart(event) {
      touchStartX = event.touches[0].clientX;
      touchStartY = event.touches[0].clientY;
    }
    
    function handleTouchMove(event) {
      // Empêche le défilement vertical pendant le swipe horizontal
      touchEndX = event.touches[0].clientX;
      touchEndY = event.touches[0].clientY;
      
      // Calcule la distance horizontale et verticale
      const diffX = touchStartX - touchEndX;
      const diffY = touchStartY - touchEndY;
      
      if (Math.abs(diffX) > Math.abs(diffY)) {
        event.preventDefault();
      }
    }
    
    function handleTouchEnd() {
      const diffX = touchStartX - touchEndX;
      const diffY = touchStartY - touchEndY;
      
      // Vérifie si c'est un swipe horizontal (et non vertical)
      if (Math.abs(diffX) > Math.abs(diffY)) {
        // Vérifie si la distance est suffisante pour être considérée comme un swipe
        if (Math.abs(diffX) > minSwipeDistance) {
          if (diffX > 0) {
            // Swipe vers la gauche -> slide suivante
            nextSlide();
          } else {
            // Swipe vers la droite -> slide précédente
            prevSlide();
          }
        }
      }
    }
    
    // Ajout les écouteurs d'événements tactiles
    carouselContainer.addEventListener('touchstart', handleTouchStart, { passive: false });
    carouselContainer.addEventListener('touchmove', handleTouchMove, { passive: false });
    carouselContainer.addEventListener('touchend', handleTouchEnd, { passive: false });
    
  }
});
</script>