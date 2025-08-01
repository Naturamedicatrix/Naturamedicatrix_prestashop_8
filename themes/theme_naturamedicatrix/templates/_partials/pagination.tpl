{**
 * Pagination template pour les listes de produits
 *}

{if $pagination.should_be_displayed}
<nav class="paging flex items-center justify-center gap-x-2 pt-8 pb-0" aria-label="Pagination">
  
  {* Bouton Précédent *}
  {assign var="previous_page" value=null}
  {foreach from=$pagination.pages item=page}
    {if $page.type === 'previous'}
      {assign var="previous_page" value=$page}
      {break}
    {/if}
  {/foreach}
  
  {if $previous_page}
    <a href="{$previous_page.url}" 
       class="h-10 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 transition-colors"
       aria-label="{l s='Previous page' d='Shop.Theme.Actions'}">
      <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
      <span>{l s='Previous' d='Shop.Theme.Actions'}</span>
    </a>
  {else}
    <button type="button" 
            class="h-10 pl-0 pr-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-400 opacity-50 cursor-not-allowed"
            aria-label="{l s='Previous page' d='Shop.Theme.Actions'}"
            disabled="">
      <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
      <span>{l s='Previous' d='Shop.Theme.Actions'}</span>
    </button>
  {/if}

  {* Conteneur des pages *}
  <div class="flex items-center gap-x-2">
    {foreach from=$pagination.pages item=page}
      {if $page.type === 'page'}
        {if $page.current}
          <button type="button" 
                  class="w-10 h-10 flex justify-center items-center !bg-gray-400 text-white text-sm rounded-lg focus:outline-hidden focus:!bg-gray-500 font-semibold"
                  aria-current="page">
            {$page.page}
          </button>
        {else}
          <a href="{$page.url}" 
             class="w-10 h-10 flex justify-center items-center text-gray-800 hover:bg-gray-100 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 transition-colors"
             aria-label="{l s='Page' d='Shop.Theme.Actions'} {$page.page}">
            {$page.page}
          </a>
        {/if}
      {elseif $page.type === 'spacer'}
        <span class="w-10 h-10 flex justify-center items-center text-gray-400 text-sm">
          ⋯
        </span>
      {/if}
    {/foreach}
  </div>

  {* Bouton Suivant *}
  {assign var="next_page" value=null}
  {foreach from=$pagination.pages item=page}
    {if $page.type === 'next'}
      {assign var="next_page" value=$page}
      {break}
    {/if}
  {/foreach}
  
  {if $next_page}
    <a href="{$next_page.url}" 
       class="h-10 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 transition-colors"
       aria-label="{l s='Next page' d='Shop.Theme.Actions'}">
      <span>{l s='Next' d='Shop.Theme.Actions'}</span>
      <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </a>
  {else}
    <button type="button" 
            class="h-10 px-3 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-400 opacity-50 cursor-not-allowed"
            aria-label="{l s='Next page' d='Shop.Theme.Actions'}"
            disabled="">
      <span>{l s='Next' d='Shop.Theme.Actions'}</span>
      <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </button>
  {/if}

</nav>

{* Informations de pagination *}
{if isset($pagination.total_items)}
  <div class="flex justify-center text-sm text-gray-700 pb-4 pt-2.5">
    <span>({$pagination.total_items} {if $pagination.total_items > 1}{l s='results' d='Shop.Theme.Actions'}{else}{l s='result' d='Shop.Theme.Actions'}{/if})</span>
  </div>
{/if}
{/if}