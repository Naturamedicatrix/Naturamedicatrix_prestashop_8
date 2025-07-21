<div class="bg-wrapper mt-20 mb-20">
  
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
  
  <ul class="row pl-0 list-none">
      
    {foreach from=$categories item=cat}
      {if in_array($cat.id_category, $allowed_ids) && $count < $max_display}
        <li class="col-lg-3 col-md-6 col-xs-6">
          <a href="{$link->getCategoryLink($cat.id_category)}" class="btn-label">{$cat.name} <i class="bi bi-star-fill"></i>   <span><i class="bi bi-arrow-right"></i></span></a>
        </li>
        {assign var='count' value=$count+1}
      {/if}
    {/foreach}
    
  </ul>
  <p class="text-center pb-0">
    <a href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">Voir toutes les catégories <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </p>
  									
  <ul class="row collapse pl-0 mt-1 list-none" id="collapseCategories" aria-labelledby="headingCategories">
    {foreach from=$categories item=cat}
      {if !in_array($cat.id_category, $allowed_ids) && $cat.id_parent == 2}
         <li class="col-lg-3 col-md-6 col-xs-6">
          <a href="{$link->getCategoryLink($cat.id_category)}" class="btn-label">{$cat.name} <span><i class="bi bi-arrow-right"></i></span></a>
        </li>
      {/if}
    {/foreach}  
  </ul>
  
  </div>

</div>

<style>
  
  .bg-wrapper {
    width: 100vw;
    position: relative;
    margin-left: -50vw;
    left: 50%;
    background-color: #f9fafb;
    padding: 4rem 0;
  }
  
  #home-categories ul {
    margin-top: 0;
  }
  
  #home-categories .btn-link {
    margin-bottom: 10px;
  }
  
  #home-categories svg {
    display: inline-block;
  }
  
  #home-categories a {
    color: #4B5563;
  }
  
  .btn-label {
    padding: 1rem;
    border-radius: 10px;
    border: 1px solid white !important;
    background: white;
    color: #4B5563 !important;
    display: block;
    margin-bottom: 30px;
    font-size: 1.1rem;
    position: relative;
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

  #home-categories ul {
  margin-top: 0;
}

@media (max-width: 576px) {
  #home-categories ul {
    display: flex;
    flex-wrap: wrap;
  }
  
  #home-categories ul a {
    font-size: 0.8rem;
    text-align: center;
  }
  
  #home-categories #collapseCategories {
    display: none;
  }

  #home-categories #collapseCategories.in {
  display: block;
}

.btn-label i.bi-star-fill {
    font-size: .4rem;
  }

#home-categories .bi-arrow-right {
  display: none;
}

#home-categories a {
    font-size: .8rem;
  }
}
  
</style>
