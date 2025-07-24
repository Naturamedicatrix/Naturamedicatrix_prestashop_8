<div id="actus-overlay" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40 hidden opacity-0 transition-opacity duration-300"></div>

<div id="actus-panel" class="actus-panel bg-wrapper">
      <div class="container">
        
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-16 max-w-6xl mx-auto py-12 px-4 md:px-8 items-stretch">
          <button id="close-actus" class="absolute top-6 right-6 text-3xl text-gray-600 hover:text-gray-800">&times;</button>
          
          
          <div class="flex flex-col h-full">
            <div>
              <h3 class="text-lg font-bold tracking-wide">Livraison offerte</h3>
            </div>
            <div class="flex-grow">
              <p class="text-sm text-gray-600 font-medium">À partir de 35€ en point relais ou 50€ en livraison à domicile (France métropolitaine, Belgique ou Luxembourg).</p>
            </div>
            <div class="mt-1.5 color-text">
              » <a href="#" class="text-sm color-text underline font-semibold hover:underline underline-offset-2">Profiter de la livraison offerte</a>
            </div>
          </div>
          
          <div class="flex flex-col h-full">
            <div>
              <h3 class="text-lg font-bold tracking-wide">Remise sur le total de la commande</h3>
            </div>
            <div class="flex-grow">
              <p class="text-sm text-gray-600 font-medium">-10% dès 150€ et -5% dès 75€ d’achat, automatiquement appliqués sur votre panier, sans code.</p>
            </div>
            <div class="mt-1.5 color-text">
             » <a href="#" class="text-sm color-text underline font-semibold hover:underline underline-offset-2">Bénéficier des remises</a>
            </div>
          </div>
          
          
          <div class="flex flex-col h-full">
            <div>
              <h3 class="text-lg font-bold tracking-wide">Payez en 2x 3x</h3>
            </div>
            <div class="flex-grow">
              <p class="text-sm text-gray-600 font-medium">Payez en 2 ou 3 fois sans frais avec Alma pour étaler vos paiements en toute simplicité.</p>
            </div>
            <div class="mt-1.5 color-text">
             » <a href="#" class="text-sm color-text underline font-semibold hover:underline underline-offset-2">En savoir plus</a>
            </div>
          </div>
        
        
        </div>
    </div>
</div>


<style>
#header #_desktop_logo h1 {
  margin: 0;
}
</style>

<!-- CAROUSEL TEXT CLIQUABLE -->
<div class="text-carousel-container w-full flex items-center justify-center" id="carousel-trigger">

    <!-- Texte défilant centré -->
    <div id="text-carousel" class="max-w-2xl w-full overflow-hidden md:whitespace-nowrap text-center relative text-xs md:text-sm">
            
        <!-- Flèche gauche -->
        <button id="carousel-prev" class="absolute hidden md:block left-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
            <i class="bi bi-arrow-left text-lg"></i>
        </button>
            
        <div class="carousel-item active block md:inline-block animate-fade-in text-center text-sm md:text-base">
            <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5 text-sm md:text-base">{l s='Livraison offerte' d='Shop.Theme.Global'}</span> {l s='àpd 35€ en Point Relais & 50€ à domicile' d='Shop.Theme.Global'}
        </div>
        <div class="carousel-item inactive hidden block md:inline-block animate-fade-in text-center text-sm md:text-base">
            {l s='Remise sur le total de la commande : <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5 text-sm md:text-base">-10% àpd 150€</span> | -5% àpd 75€' d='Shop.Theme.Global'}
        </div>
        <div class="carousel-item inactive hidden block md:inline-block animate-fade-in text-center text-sm md:text-base">
            {l s='Payez en <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5 text-sm md:text-base">2x 3x avec alma</span>' d='Shop.Theme.Global'}
        </div>
            
            
        <!-- Flèche droite -->
        <button id="carousel-next" class="absolute hidden md:block right-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
            <i class="bi bi-arrow-right text-lg"></i>
        </button>
            
    </div>
</div>
