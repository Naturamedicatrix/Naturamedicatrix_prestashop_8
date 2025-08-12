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
  <h3 class="text-lg font-light mb-1">{l s='All of our categories' d='Shop.Theme.Catalog'}</h3>
  
  {assign var=subchildren value=Category::getChildren(2, $language.id)}
   
   {if !empty($subcategories)}
   {if (isset($display_subcategories) && $display_subcategories eq 1) || !isset($display_subcategories) }
   
    {$subcategories}
   
{*
     {foreach from=$subcategories item=subcategory}            
       {if $subchildren|count > 0}
        <ul class="list-disc text-left text-sm text-gray-700 mt-1.5 ml-1 pl-0 space-y-0.5">
          {foreach from=$subchildren item=subchild name=subloop}
            <li class="w-full m-0 p-0 text-left {if $smarty.foreach.subloop.iteration > 3}hidden toggle-subcat{/if}">
              <a href="{$link->getCategoryLink($subchild.id_category, $subchild.link_rewrite)}" class="hover:underline">
                {$subchild.name|escape:'html':'UTF-8'}
              </a>
            </li>
          {/foreach}
        </ul>
        
        {if $subchildren|count > 3}
                  
          <button type="button"
                  class="mt-2.5 text-left text-xs toggle-btn underline"
                  data-state="collapsed">
              Voir plus
          </button>
        {/if}
        
      {/if}
    {/foreach}
*}
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
