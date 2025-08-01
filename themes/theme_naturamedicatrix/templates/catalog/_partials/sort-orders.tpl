{**
 * CUSTOM SORT ORDERS (FILTRE)
 *}

<div class="products-sort-order">
      <h6 class="sort-title">{l s='Sort by:' d='Shop.Theme.Global'}</h6>
      <div class="sort-options hidden md:block border border-gray-200 md:border-none py-1.5 px-2.5 md:p-0">
        {foreach from=$listing.sort_orders item=sort_order}
          <div class="form-check">
            <input 
              type="radio" 
              id="sort-{$sort_order@index}" 
              name="sort-option" 
              {if $sort_order.current}checked="checked"{/if}
              class="form-check-input js-search-link-radio"
              data-href="{$sort_order.url}"
            >
            <label for="sort-{$sort_order@index}" class="form-check-label {if $sort_order.current}font-weight-bold{/if}">
              {$sort_order.label}
            </label>
          </div>
        {/foreach}
      </div>
</div>
  
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      // Event listeners for radio buttons
      const radioButtons = document.querySelectorAll('.js-search-link-radio');
      radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
          if (this.checked) {
            window.location.href = this.getAttribute('data-href');
          }
        });
      });
      
      // Affiche les options de tri
      const sortTitles = document.querySelectorAll('.top-products-filter .products-sort-order h6');
      const sortOptions = document.querySelectorAll('.top-products-filter .sort-options');
      
      if (sortTitles.length > 0 && sortOptions.length > 0) {
        sortTitles.forEach(function(title, index) {
          title.addEventListener('click', function(e) {
            const parentContainer = document.querySelectorAll('.top-products-filter');
            const optionsDiv = parentContainer[index].querySelector('.sort-options');
            
            if (optionsDiv) {
              if (optionsDiv.classList.contains('hidden')) {
                // Fermer les filtres avant d'ouvrir le tri
                const filterElements = document.querySelectorAll('.PM_ASMobileVisible');
                filterElements.forEach(function(filter) {
                  filter.classList.remove('PM_ASMobileVisible');
                });
                
                optionsDiv.classList.remove('hidden');
              } else {
                optionsDiv.classList.add('hidden');
              }
            }
            
            e.preventDefault();
          });
        });
      }
      
      // Script pour fermer le tri quand on ouvre les filtres
      // Détecter les clics sur les éléments qui ouvrent les filtres
      document.addEventListener('click', function(e) {
        // Chercher si l'élément cliqué ou ses parents peuvent ouvrir des filtres
        const clickedElement = e.target;
        const isFilterTrigger = clickedElement.closest('.filter-product') || 
                               clickedElement.closest('[data-target*="filter"]') ||
                               clickedElement.matches('.filter-trigger, .filter-button, .filter-icon');
        
        if (isFilterTrigger) {
          // Fermer le menu de tri
          const sortOptions = document.querySelectorAll('.top-products-filter .sort-options');
          sortOptions.forEach(function(option) {
            if (!option.classList.contains('hidden')) {
              option.classList.add('hidden');
            }
          });
        }
      });
    });
</script>