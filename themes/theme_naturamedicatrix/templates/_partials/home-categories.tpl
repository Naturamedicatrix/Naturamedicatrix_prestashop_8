<style>
  
  #home-categories {
    padding: 4rem 0; 
  }
  
  .btn-label {
    padding: 1rem;
    border-radius: 10px;
    border: 1px solid #F9FAFB !important;
    background: #F9FAFB;
    color: #4B5563 !important;
    display: block;
    margin-bottom: 30px;
    font-size: 1.2rem;
    position: relative;
  }
  
  .btn-label i {
    position: absolute;
    right: 20px;
  }  
  
  .btn-label:hover,
  .btn-label:hover i {
    color: #1F80C7 !important;
  }
  
</style>


<div id="home-categories">

  <header class="page-header">
      <h2 class="text-center text-lg md:text-2xl font-bold mb-0">Vos recherches</h2>
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

<ul class="row">
    
  {foreach from=$categories item=cat}
    {if in_array($cat.id_category, $allowed_ids) && $count < $max_display}
      <li class="col-lg-3 col-md-6 col-xs-6">
        <a href="{$link->getCategoryLink($cat.id_category)}" class="btn-label">{$cat.name} <span><i class="bi bi-arrow-right"></i></span></a>
      </li>
      {assign var='count' value=$count+1}
    {/if}
  {/foreach}
</ul>




</div>