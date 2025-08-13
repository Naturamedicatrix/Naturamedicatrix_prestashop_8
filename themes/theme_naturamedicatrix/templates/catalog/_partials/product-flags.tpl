{**
CUSTOM PRODUCT FLAGS
*}
 {block name='product_flags'}
 
 {if $product.flags}
 
  <ul class="product-flagss js-product-flags inline-flex flex-row gap-3 pl-0 mt-0 mb-0 relative list-none">
      {* Affiche d'abord le flag "new" s'il existe *}
      {foreach from=$product.flags item=flag}
          {if $flag.type == 'new'}
              <li class="mb-0 mt-0 product-flagr text-sm normal-case border border-gray-400 px-2.5 py-0 leading-normal font-normal text-center rounded-tl-2xl rounded-br-2xl rounded-tr-sm rounded-bl-sm {$flag.type}">{$flag.label}</li>
              {break}
          {/if}
      {/foreach}
      
      {* Ensuite affiche tous les autres flags sauf "out_of_stock" et "new" *}
      {foreach from=$product.flags item=flag}
        {if $flag.type != 'out_of_stock' && $flag.type != 'new'}
          {if $flag.type == 'discount'}
              <li class="mb-0 mt-0 product-flagr bg-highlight text-white text-sm normal-case border-0 px-2.5 py-0 leading-normal font-bold text-center rounded-tl-2xl rounded-br-2xl rounded-tr-sm rounded-bl-sm {$flag.type}">{$flag.label} {if isset($product.dlu_checkbox) && $product.dlu_checkbox == 1}<span class="dlc-text font-normal">DLC courte</span>{/if}</li>
{*
          {else}
              <li class="mb-0 mt-0 product-flagr text-sm normal-case border border-gray-400 px-2.5 py-0 leading-normal font-normal text-center rounded-tl-2xl rounded-br-2xl rounded-tr-sm rounded-bl-sm {$flag.type}">{$flag.label}</li>
*}
          {/if}
        {/if}
      {/foreach}
  </ul>
  
  {/if}
  
{/block}


