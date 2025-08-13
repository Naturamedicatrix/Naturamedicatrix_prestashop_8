<div class="bg-wrapper mt-20 mb-20 py-16">
  
  <div id="home-categories" class="container">
  
    <header class="page-header mt-0">
        <h2 class="text-center text-xl md:text-2xl font-bold mb-0 mt-0">Vos besoins</h2>
        <div class="title-separator">
          <svg id="logoTitle" class="logo-h3" data-name="Logo Title" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 504.59 360.15">
            <path class="logo-title" d="m10.98,360.15S-67.72,47.82,196.27,21.22c76.88-7.74,212.55,15.2,308.32-21.22,0,0-44.43,238.67-232.96,262.91-157.14,20.21-208.67-28.88-208.67-28.88,0,0,81.7-121.23,304.77-145.6,0,0-368.26-32.3-356.77,271.72Z"></path>
        </svg>
      </div>
    </header>
  
    
  {assign var='allowed_ids' value=[3, 19, 20, 18, 11, 9, 6, 17]}
  {assign var='categories' value=Category::getCategories(Context::getContext()->language->id, true, false)}
  {assign var='count' value=0}
  {assign var='max_display' value=8}
  
  <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 list-none p-0">
      
    {foreach from=$categories item=cat}
      {if in_array($cat.id_category, $allowed_ids) && $count < $max_display}
        <li class="mb-0">
          <a href="{$link->getCategoryLink($cat.id_category)}" class="btn-label mb-0 relative block bg-white rounded-xl p-4 font-medium text-gray-600 hover:text-primary transition border border-white text-base no-underline">{$cat.name} <i class="bi bi-star-fill"></i>   <span><i class="bi bi-arrow-right"></i></span></a>
        </li>
        {assign var='count' value=$count+1}
      {/if}
    {/foreach}
    
  </ul>
  <p class="text-center pb-0">
    <a href="#" id="toggleCategories" aria-expanded="false" aria-controls="collapseCategories">Voir toutes les catégories<svg class="ml-0.5" width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </p>
  									
  <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 list-none p-0 mt-1 hidden" id="collapseCategories" aria-labelledby="headingCategories">
    {foreach from=$categories item=cat}
      {if !in_array($cat.id_category, $allowed_ids) && $cat.id_parent == 2}
         <li class="mb-0">
          <a href="{$link->getCategoryLink($cat.id_category)}" class="btn-label mb-0 relative block bg-white rounded-xl p-4 font-medium text-gray-600 hover:text-primary transition border border-white text-base no-underline">{$cat.name} <span><i class="bi bi-arrow-right"></i></span></a>
        </li>
      {/if}
    {/foreach}  
  </ul>
  
  </div>

</div>

<style>
  #home-categories svg {
    display: inline-block;
  }
  
  .btn-label {
    color: #4B5563 !important;
    text-decoration: none !important;
  }
  
  .btn-label i.bi-arrow-right {
    position: absolute;
    right: 20px;
  }
  
  .btn-label i.bi-star-fill {
    color: #f97316;
    font-size: 0.6rem;
    position: absolute;
    top: 5px;
    right: 5px;
  }
  
  .btn-label:hover,
  .btn-label:hover i {
    color: #1F80C7 !important;
  }
  
  #toggleCategories svg {
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
  }
  
  #toggleCategories[aria-expanded="true"] svg {
    transform: rotate(90deg);
  }
  
  #collapseCategories {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transform: translateY(-10px);
  }
  
  #collapseCategories.show {
    display: grid !important;
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
  }
  
  #collapseCategories.hidden {
    display: none;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const toggleButton = document.getElementById('toggleCategories');
  const collapseElement = document.getElementById('collapseCategories');
  
  if (toggleButton && collapseElement) {
    toggleButton.addEventListener('click', function(e) {
      e.preventDefault();
      
      const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
      
      if (isExpanded) {
        // Ferme avec animation
        collapseElement.classList.remove('show');
        toggleButton.setAttribute('aria-expanded', 'false');
        
        // Masque complètement après l'animation
        setTimeout(function() {
          if (toggleButton.getAttribute('aria-expanded') === 'false') {
            collapseElement.classList.add('hidden');
          }
        }, 400);
        
      } else {
        // Ouvrir avec animation
        collapseElement.classList.remove('hidden');
        
        collapseElement.offsetHeight;
        
        collapseElement.classList.add('show');
        toggleButton.setAttribute('aria-expanded', 'true');
      }
    });
  }
});
</script>
