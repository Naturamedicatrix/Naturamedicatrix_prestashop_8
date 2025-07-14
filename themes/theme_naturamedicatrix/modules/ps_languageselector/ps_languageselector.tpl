{**
* CUSTOM LANGUAGE SELECTOR WITH PLANET ICON
*}
<div id="_desktop_language_selector">
  <div class="language-selector-wrapper">
    <span id="language-selector-label" class="hidden-md-up">{l s='Language:' d='Shop.Theme.Global'}</span>
    
    <div class="language-selector dropdown js-dropdown relative inline-block">
      <button data-toggle="dropdown"
        class="flex items-center gap-1 pb-1.5 transition leading-none text-sm text-white justify-between"
        aria-haspopup="true" aria-expanded="false"
        aria-label="{l s='Language dropdown' d='Shop.Theme.Global'}">
        <span>{$current_language.iso_code|upper}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </button>
    
      <ul class="dropdown-menu absolute right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-md z-50 w-20 text-sm overflow-hidden">
        {foreach from=$languages item=language}
          <li class="mb-0">
            <a href="{url entity='language' id=$language.id_lang}"
               class="block px-2.5 py-2.5 text-center transition color-text
               {if $language.id_lang == $current_language.id_lang}
                 bg-primary text-white
               {else}
                 text-[#4b5563] hover:bg-primary
               {/if}">
              {$language.iso_code|upper}
            </a>
          </li>
        {/foreach}
      </ul>
    </div>




  </div>
</div>


<style>
#_desktop_language_selector .dropdown-menu {
    min-width: auto !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 0.875rem !important;
    background-color: #ffffff !important;
    border-radius: 4px !important;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
    width: 4rem !important;
    overflow: hidden !important;
    border: none !important;
    right: 0;
    left: auto;
}

#_desktop_language_selector .dropdown-menu .bg-primary {
  background: #83b58b !important;
}

#_desktop_language_selector .dropdown-menu a:hover {
  background: #83b58b;
}


#_desktop_language_selector .dropdown-item {
    padding: 0 !important;
}

#_desktop_language_selector .dropdown-menu li {
  border: none
}

  
  
</style>