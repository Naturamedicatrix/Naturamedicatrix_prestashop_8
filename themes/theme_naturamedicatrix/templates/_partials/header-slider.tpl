<!-- CAROUSEL TEXT CLIQUABLE -->
<div class="text-carousel-container w-full flex items-center justify-center" id="carousel-trigger">

    <!-- Texte défilant centré -->
    <div id="text-carousel" class="max-w-2xl w-full overflow-hidden md:whitespace-nowrap text-center relative text-xs md:text-sm">
            
        <!-- Flèche gauche -->
        <button id="carousel-prev" class="absolute hidden md:block left-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
            <i class="bi bi-arrow-left text-lg"></i>
        </button>
            
        <div class="carousel-item active block md:inline-block animate-fade-in text-center">
            <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">{l s='Livraison offerte' d='Shop.Theme.Global'}</span> {l s='àpd 35€ en Point Relais & 50€ à domicile' d='Shop.Theme.Global'}
        </div>
        <div class="carousel-item inactive hidden block md:inline-block animate-fade-in text-center">
            {l s='Remise sur le total de la commande : <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">-10% àpd 150€</span> | -5% àpd 75€' d='Shop.Theme.Global'}
        </div>
        <div class="carousel-item inactive hidden block md:inline-block animate-fade-in text-center">
            {l s='Payez en <span class="highlight-text bg-pink-600 text-white font-semibold px-1.5 py-0.5 rounded-md mr-0.5">2x 3x avec alma</span>' d='Shop.Theme.Global'}
        </div>
            
            
        <!-- Flèche droite -->
        <button id="carousel-next" class="absolute hidden md:block right-0 -top-0.5 -translate-y-0.5 z-10 px-4 text-white hover:text-gray-200 transition">
            <i class="bi bi-arrow-right text-lg"></i>
        </button>
            
    </div>
</div>
