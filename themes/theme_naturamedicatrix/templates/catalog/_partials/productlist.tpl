{**
CUSTOM PRODUCT LIST
 *}

{capture assign="productClasses"}{if !empty($productClass)}{$productClass}{/if}{/capture}

<div class="products grid grid-cols-2 xl:grid-cols-3 gap-6">
    {foreach from=$products item="product" key="position"}
        {include file="catalog/_partials/miniatures/product.tpl" product=$product position=$position productClasses=$productClasses}
    {/foreach}
</div>
