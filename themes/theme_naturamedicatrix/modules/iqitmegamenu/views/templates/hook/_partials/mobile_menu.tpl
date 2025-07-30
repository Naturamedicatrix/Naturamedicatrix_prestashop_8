{function name="mobile_links" nodes=[] first=false}
  {strip}	  
    
    <div id="mobile-menu-header" class="flex items-center justify-between pt-3.5">
      <div class="flex-1 text-gray-900 text-center text-2xl">NATURA<strong><em>Medicatrix</em></strong></div>
      <div id="cbp-spmenu-overlay"><div id="cbp-close-mobile" class="close-btn-ui float-right text-right"><i class="bi bi-x-lg"></i></div></div>
    </div>
    
    <div class="pt-1 pb-1">
      {hook h='displaySearch'}
    </div>
    
    
    
    {if $nodes|count}
      {if !$first}<ul>{/if}
        {foreach from=$nodes item=node}
          {if isset($node.title)}
            <li class="border-b border-gray-200 mb-0">
              <a href="{$node.href}" class="flex items-center justify-between px-2 py-2.5 text-sm font-semibold text-gray-900">
                {$node.title} <i class="bi bi-chevron-right text-xs text-gray-900 ml-auto"></i>
{*
                {if isset($node.children)}
                  <i class="bi bi-chevron-right text-base text-gray-400"></i>
                {/if}
*}
              </a>
              {if isset($node.children)}
                <ul class="pl-4">
                  {mobile_links nodes=$node.children first=false}
                </ul>
              {/if}
            </li>
          {/if}
        {/foreach}
        
        
      {* Sélecteur de langue *}  
      <div id="_mobile_language_selector" class="text-center mt-3">
        <div class="inline-block relative">
          <button data-toggle="dropdown"
            class="flex items-center gap-1 transition text-sm text-gray-900"
            aria-haspopup="true" aria-expanded="false">
            <span class="color-gray-500">{if isset($current_language)}{$current_language.iso_code|upper}{/if}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>
      
          <ul class="dropdown-menu absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-white border border-gray-300 rounded-xl shadow-md z-50 w-20 text-sm overflow-hidden">
      
              {foreach from=$languages item=language}
                <li class="mb-0">
                  <a href="{url entity='language' id=$language.id_lang}"
                     class="block px-1.5 py-1.5 text-center transition
                     {if $language.id_lang == $current_language.id_lang}
                       bg-brand text-white
                     {else}
                       color-gray-400 hover:bg-brand
                     {/if}">
                    {$language.iso_code|upper}
                  </a>
                </li>
              {/foreach}
            </ul>
        </div>
      </div>
      {* /end Sélecteur de langue *} 
        

        
      {if !$first}</ul>{/if}
    {/if}
  {/strip}
{/function}

{if isset($menu)}
  {mobile_links nodes=$menu first=true}
{/if}







<style>
  


#iqitmegamenu-accordion {
  list-style: none;
  padding: 0 1.25rem;
  box-shadow: none;
}

#iqitmegamenu-mobile-content .icon-special:after {
  top: 0;
}

#iqitmegamenu-accordion.cbp-spmenu menu {
  padding: inherit;
}

#iqitmegamenu-accordion.cbp-spmenu > li a {
  text-transform: inherit;
  font-weight: 600;
  color: #111827;
  border: none;
  display: flex;
  font-size: inherit;
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
  padding-left: 0 !important;
  padding-right: 0 !important;
}

#iqitmegamenu-accordion.cbp-spmenu li a:hover {
  box-shadow: none;
}

#_mobile_language_selector a {
  padding: .4rem .8rem;
  font-size: 0.875rem !important;
}

#_mobile_language_selector button {
  color: #111827 !important;
  min-width: 40px;
}

#_mobile_language_selector .dropdown-menu {
    min-width: auto !important;
    width: auto !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 0.875rem !important;
    background-color: #ffffff !important;
    border-radius: 4px !important;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
    overflow: hidden !important;
    border: none !important;
    right: 0;
    left: auto;
    top: auto !important;
    bottom: 100% !important;
    margin-bottom: 0.8rem !important;
}

#_mobile_language_selector .dropdown-menu a:hover {
  background: #589875;
  color: white !important;
}

#_mobile_language_selector .language-selector button[aria-expanded="true"] svg {
  transform: rotate(180deg);
  transition: transform 0.2s ease-in-out;
}

#iqitmegamenu-accordion #search_widget {
  position: unset;
  margin-bottom: 0;
}

.cbp-spmenu-vertical.cbp-spmenu-open {
  width: inherit;
}

.cbp-spmenu-overlay-show #cbp-close-mobile {
  position: unset;
  text-align: right;
  color: #111827;
}


#iqitmegamenu-mobile #iqitmegamenu-shower {
  line-height: 1;
      padding-top: .375rem;
    padding-bottom: .375rem;
        padding-left: .625rem;
    padding-right: .625rem;
}


/* Push mobile menu */
@media (max-width: 768px) {
  .cbp-spmenu-push-toright {
    left: 0 !important;
    position: static !important;
    width: auto !important;
  }
  
  body.cbp-spmenu-push-toright {
    transform: none !important;
    left: 0 !important;
  }
}

</style>