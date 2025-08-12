{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<hr />

{if $category.id == 2}
  <div class="py-8">
    <h3 class="text-2xl font-light text-gray-800 mb-6">{l s='All of our categories' d='Shop.Theme.Catalog'}</h3>
    
    {if !empty($subcategories)}
      {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 items-start">
          {foreach from=$subcategories item=subcategory}
            <div class="bg-white rounded-lg p-4 border border-gray-100 self-start">
              <h4 class="text-lg font-semibold mb-4 mt-0 text-gray-900">
                <a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)}" 
                   class="hover:text-gray-600 transition-colors duration-200">
                  {$subcategory.name|escape:'html':'UTF-8'}
                </a>
              </h4>
              
              {assign var=subchildren value=Category::getChildren($subcategory.id_category, $language.id)}
              
              {if $subchildren|count > 0}
                <ul class="mb-0">
                  {foreach from=$subchildren item=subchild name=subloop}
                    {if $smarty.foreach.subloop.iteration <= 5}
                      <li class="text-sm">
                        <a href="{$link->getCategoryLink($subchild.id_category, $subchild.link_rewrite)}" 
                           class="text-gray-600 hover:text-gray-500 flex items-center group">
                          {$subchild.name|escape:'html':'UTF-8'}
                        </a>
                      </li>
                    {/if}
                  {/foreach}
                </ul>
                
                {if $subchildren|count > 5}
                  <div class="overflow-hidden transition-all duration-300 ease-in-out max-h-0 toggle-container-{$subcategory.id_category}">
                    <ul class="mb-0">
                      {foreach from=$subchildren item=subchild name=subloop}
                        {if $smarty.foreach.subloop.iteration > 5}
                          <li class="text-sm">
                            <a href="{$link->getCategoryLink($subchild.id_category, $subchild.link_rewrite)}" 
                               class="text-gray-600 hover:text-gray-500 flex items-center group">
                              {$subchild.name|escape:'html':'UTF-8'}
                            </a>
                          </li>
                        {/if}
                      {/foreach}
                    </ul>
                  </div>
                {/if}
                
                {if $subchildren|count > 5}
                  <button type="button"
                          class="mt-4 text-sm text-gray-500 hover:text-gray-600 font-medium flex items-center gap-1"
                          data-category-id="{$subcategory.id_category}"
                          data-state="collapsed"
                          data-text-more="{l s='Show more' d='Shop.Theme.Actions'}"
                          data-text-less="{l s='Show less' d='Shop.Theme.Actions'}"
                          onclick="toggleSubcategories({$subcategory.id_category})">
                      <span class="button-text">{l s='Show more' d='Shop.Theme.Actions'}</span>
                      <svg class="w-4 h-4 arrow-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                {/if}
              {else}
                <p class="text-sm text-gray-500 italic">{l s='No subcategories' d='Shop.Theme.Catalog'}</p>
              {/if}
            </div>
          {/foreach}
        </div>
      
    {/if}
  {/if}

{/if}

 
<div id="js-product-list-footer">
    {if isset($category) && $category.additional_description && $listing.pagination.items_shown_from == 1}
        <div class="card">
            <div class="card-block category-additional-description">
                {$category.additional_description nofilter}
            </div>
        </div>
    {/if}
</div>



<script>
function toggleSubcategories(categoryId) {
  var container = document.querySelector('.toggle-container-' + categoryId);
  var button = document.querySelector('[data-category-id="' + categoryId + '"]');
  var buttonText = button.querySelector('.button-text');
  var arrowIcon = button.querySelector('.arrow-icon');
  var textMore = button.getAttribute('data-text-more');
  var textLess = button.getAttribute('data-text-less');
  
  if (button.getAttribute('data-state') === 'collapsed') {
    // Expand
    container.style.maxHeight = container.scrollHeight + 'px';
    buttonText.textContent = textLess;
    button.setAttribute('data-state', 'expanded');
    arrowIcon.style.transform = 'rotate(180deg)';
  } else {
    // Collapse
    container.style.maxHeight = '0';
    buttonText.textContent = textMore;
    button.setAttribute('data-state', 'collapsed');
    arrowIcon.style.transform = 'rotate(0deg)';
  }
}
</script>