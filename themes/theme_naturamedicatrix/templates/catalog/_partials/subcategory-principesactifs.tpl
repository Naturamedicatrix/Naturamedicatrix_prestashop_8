<style>
    .category-principes-actifs .total-products,
    .category-principes-actifs #products  {
      display: none;
    }
    
    #alphabet {
      background: white;
      z-index: 1;
      border-top: 1px solid #e5e8ea;
      border-bottom: 1px solid #e5e8ea;
    } 
     
    .letter {
      min-width: 8%;
    } 
    
    #category-principesactifs .grid {
      border-left: 1px solid #e5e8ea;
    }
    
    .subcategory-image a {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 1rem;
    }
  

    @media (max-width: 460px) {
      #category-principesactifs ul, #search-results {
        padding-left: 0;
      }
    }
    
  </style>
  
  
  {* Alphabet pour garantir le tri alphabétique (méthode @sort) *}
  {assign var='alphabet_complet' value=['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']}
  {assign var='lettres_presentes' value=[]}
  
  {* Parcours tous les principes actifs pour extraire la première lettre *}
  {foreach from=$subcategories item=subcategory}
    {assign var='letter' value=$subcategory.name|substr:0:1|upper}
    {* Ne conserve que les caractères alphabétiques, pas les chiffres *}
    {if (string)$letter != (string)((int)$letter)}
      {* Ajoute la lettre à notre tableau si elle n'y est pas déjà *}
      {if !in_array($letter, $lettres_presentes)}
        {append var='lettres_presentes' value=$letter index=$letter}
      {/if}
    {/if}
  {/foreach}

    {* Barre de recherche des principes actifs *}
    <div class="mb-4 mt-4 flex justify-center">
      <div class="relative w-full max-w-md">
        <input type="text" id="search-principes-actifs" class="block w-full py-4 px-3 text-sm text-gray-900 border border-gray-200 rounded-lg bg-white focus:border-gray-500 focus:ring-1 focus:ring-gray-500" placeholder="Aloé-vera, curcuma, magnésium, ...">
        <div id="search-principes-actifs-icon" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <button type="button" id="search-principes-actifs-clear" class="absolute inset-y-0 right-0 flex items-center pr-3 hidden">
          <svg class="w-4 h-4 text-gray-500 hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
      </div>
  </div>
  
  {* Affiche le menu avec les lettres de l'alphabet qui sont présentes *}
  <ul id="alphabet" class="list-none -mx-4 gap-4 sm:-mx-11 xl:mx-0 z-5 flex overflow-x-scroll sticky top-0 justify-start items-baseline bg-white shadow-md sm:py-0 sm:pt-2 sm:pb-2 sm:pl-7 sm:shadow-none xl:px-14 xl:justify-center xl:overflow-x-hidden scrollbar-hidden">        
    {foreach from=$alphabet_complet item=letter}
      {if isset($lettres_presentes[$letter])}
        <li class="flex flex-shrink-0 justify-center items-center w-10 h-10 text-xl cursor-pointer rounded-full"><a href="#{$letter}"><span>{$letter}</span></a></li>
      {/if}
    {/foreach}
  </ul>
    
{assign var='last_letter' value=''}

{* Conteneur des résultats de recherche *}
<div id="search-results-container" class="hidden mb-3" style="display: none;">
  <div class="relative flex flex-grow flex-col md:flex-row justify-start">
    <div class="letter mb-2 md:mb-0 bg-white text-gray-800 text-lg md:text-3xl md:flex md:justify-center pt-5">
      <h2 class="xs:self-center md:self-start md:sticky md:top-16 text-xl flex items-center">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
      </h2>
    </div>
    <ul id="search-results" class="list-none grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 md:gap-4 gap-y-5 justify-items-center w-full py-2 md:pl-12 md:pr-0 md:py-12">
      {* Résultats de la recherche sont affichés ici *}
    </ul>
  </div>
</div>

{if !empty($subcategories)}
  {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories)}
    <div id="category-principesactifs" class="mb-3">
      
      {* Parcours l'alphabet ordonné pour afficher les principes actifs *}
      {foreach from=$alphabet_complet item=current_letter}
        {if isset($lettres_presentes[$current_letter])}
          {* Section pour la lettre actuelle *}
          <div class="relative flex flex-grow flex-col md:flex-row justify-start">
            <div class="letter mb-2 md:mb-0 bg-white text-gray-800 text-lg md:text-3xl md:flex md:justify-center pt-5 text-center">
              <h2 class="xs:self-center md:self-start md:sticky md:top-16 text-xl text-center">{$current_letter}</h2>
            </div>
            <ul id="{$current_letter}" class="list-none grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-2 md:gap-4 gap-y-5 justify-items-center w-full py-2 md:pl-12 md:pr-0 md:py-12">
              
              {* Filtre les principes actifs commençant par la lettre actuelle *}
              {foreach from=$subcategories item=subcategory}
                {assign var='first_letter' value=$subcategory.name|truncate:1:""|upper}
                {if $first_letter == $current_letter}

                  <li class="w-full">
                    <div class="subcategory-image">
                      <a href="{$subcategory.url}" title="{$subcategory.name|escape:'html':'UTF-8'}"
                         class="border-r border-l border-gray-100 md:p-4 rounded-xl md:rounded-2xl flex flex-col justify-start items-start shadow-lg h-full relative">

                        {if !empty($subcategory.image.small.url)}
                          <picture class="flex overflow-hidden flex-col justify-center h-16 w-16">
                            {if !empty($subcategory.image.small.sources.avif)}<source srcset="{$subcategory.image.small.sources.avif}" type="image/avif"/>{/if}
                            {if !empty($subcategory.image.small.sources.webp)}<source srcset="{$subcategory.image.small.sources.webp}" type="image/webp"/>{/if}
                            <img class="img-fluid"
                                 src="{$subcategory.image.small.url}"
                                 alt="{$subcategory.name|escape:'html':'UTF-8'}"
                                 loading="lazy"
                                 width="{$subcategory.image.small.width}"
                                 height="{$subcategory.image.small.height}"/>
                          </picture>
                        {else}
                          <picture class="flex overflow-hidden flex-col justify-center h-16 w-16 text-center">
                            <span class="text-3xl text-gray-300">{$first_letter}</span>
                          </picture>
                        {/if}

                        <p class="pb-0 color-title"><strong>{$subcategory.name|truncate:50:'...'|escape:'html':'UTF-8'}</strong><small class="color-text block">{$subcategory.nb_products} produit{if $subcategory.nb_products > 1}s{/if}</small></p>
                      </a>
                    </div>
                  </li>
                {/if}
              {/foreach}
              
            </ul>
          </div>
        {/if}
      {/foreach}
      
    </div>
  {/if}
{/if}



<script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('search-principes-actifs');
      const clearButton = document.getElementById('search-principes-actifs-clear');
      const searchIcon = document.getElementById('search-principes-actifs-icon');
      const letterSections = document.querySelectorAll('#category-principesactifs .relative');
      const resultsContainer = document.getElementById('search-results-container');
      const searchResults = document.getElementById('search-results');
      
      // Gestion de l'état actif pour les lettres de l'alphabet
      const alphabetLinks = document.querySelectorAll('#alphabet li a');
      
      // Référence au conteneur de l'alphabet
      const alphabetContainer = document.getElementById('alphabet');
      
      // Ajout des gestionnaires d'événements pour les lettres de l'alphabet
      alphabetLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Retirer la classe active de tous les liens
          alphabetLinks.forEach(l => l.classList.remove('active'));
          
          // Ajouter la classe active au lien cliqué
          this.classList.add('active');
          
          // Ajouter la classe has-active au conteneur
          alphabetContainer.classList.add('has-active');
          
          // Déclencher le défilement vers la section
          const targetLetter = this.getAttribute('href').substring(1);
          const targetSection = document.getElementById(targetLetter);
        });
      });
      
      // Configuration de l'Intersection Observer pour détecter quelle section est visible
      // et mettre à jour le menu alphabétique en conséquence
      const letterSectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          // Vérifions si la section est visible
          if (entry.isIntersecting && entry.intersectionRatio > 0) {
            const sectionId = entry.target.getAttribute('id');
            if (sectionId) {
              // Mettre à jour le menu alphabétique
              alphabetLinks.forEach(link => {
                const linkLetter = link.getAttribute('href').substring(1);
                if (linkLetter === sectionId) {
                  // Ajoute la classe active au lien correspondant
                  alphabetLinks.forEach(l => l.classList.remove('active'));
                  link.classList.add('active');
                  
                  // Ajouter la classe has-active au conteneur d'alphabet
                  alphabetContainer.classList.add('has-active');
                }
              });
            }
          }
        });
      }, { threshold: 0.1, rootMargin: '-20px 0px -90% 0px' });
      
      // Observer toutes les sections alphabétiques
      document.querySelectorAll('#category-principesactifs [id]').forEach(section => {
        letterSectionObserver.observe(section);
      });
      
      // Fonction de recherche
      function filterPrincipesActifs() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        searchResults.innerHTML = '';
        
        if (searchTerm === '') {
          // Affichage normal
          letterSections.forEach(section => section.style.display = '');
          resultsContainer.classList.add('hidden');
          resultsContainer.style.display = 'none';
          clearButton.classList.add('hidden');
          searchIcon.classList.remove('hidden');
          return;
        }
        
        // Mode recherche
        letterSections.forEach(section => section.style.display = 'none');
        clearButton.classList.remove('hidden');
        searchIcon.classList.add('hidden');
        
        // Réinitialiser la lettre active lorsqu'on fait une recherche
        alphabetLinks.forEach(link => link.classList.remove('active'));
        alphabetContainer.classList.remove('has-active');
        
        // Recherche les correspondances
        const items = document.querySelectorAll('#category-principesactifs .subcategory-image');
        let resultsCount = 0;
        
        items.forEach(item => {
          const nameElement = item.querySelector('p strong');
          if (!nameElement) return;
          
          const name = nameElement.textContent.trim();
          if (name.toLowerCase().includes(searchTerm)) {
            resultsCount++;
            
            // Clone et ajoute aux résultats
            const parentLi = item.closest('li.w-full');
            if (parentLi) {
              const clone = parentLi.cloneNode(true);
              
              // Affichage tous les éléments
              clone.querySelectorAll('*').forEach(el => {
                if(el.style && el.style.display === 'none') el.style.display = '';
              });
              
              clone.querySelectorAll('a[style*="display: none"]').forEach(link => {
                link.style.display = 'flex';
              });
              
              searchResults.appendChild(clone);
            }
          }
        });
        
        // Affiche les résultats
        resultsContainer.classList.remove('hidden');
        resultsContainer.style.display = 'block';
        
        if (resultsCount === 0) {
          searchResults.innerHTML = '<p class="col-span-full text-center py-8">Aucun principe actif ne correspond à votre recherche.</p>';
        } else {
          window.scrollTo({
            top: resultsContainer.offsetTop - 100,
            behavior: 'smooth'
          });
        }
      }
      
      // Événements
      searchInput.addEventListener('input', filterPrincipesActifs);
      clearButton.addEventListener('click', function() {
        searchInput.value = '';
        filterPrincipesActifs();
        searchInput.focus();
      });
    });
  </script>