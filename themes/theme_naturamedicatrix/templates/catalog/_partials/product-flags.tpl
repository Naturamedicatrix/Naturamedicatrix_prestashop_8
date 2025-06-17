{**
CUSTOM PRODUCT FLAGS
*}
 {block name='product_flags'}
    <ul class="product-flags js-product-flags">
        {* Affiche d'abord le flag "new" s'il existe *}
        {foreach from=$product.flags item=flag}
            {if $flag.type == 'new'}
                <li class="product-flag {$flag.type}">{$flag.label}</li>
                {break}
            {/if}
        {/foreach}
        
        {* Ensuite affiche tous les autres flags sauf "out_of_stock" et "new" *}
        {foreach from=$product.flags item=flag}
            {if $flag.type != 'out_of_stock' && $flag.type != 'new'}
                {if $flag.type == 'discount'}
                    <li class="product-flag {$flag.type}">{$flag.label} {if isset($product.dlu_checkbox) && $product.dlu_checkbox == 1}<span class="dlc-text">DLC courte</span>{/if}</li>
                {else}
                    <li class="product-flag {$flag.type}">{$flag.label}</li>
                {/if}
            {/if}
        {/foreach}
    </ul>
{/block}
