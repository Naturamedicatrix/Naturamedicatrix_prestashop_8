{**
CUSTOM PRODUCT LIST FOR BESTSELLERS
*}

{capture assign="productClasses"}{if !empty($productClass)}{$productClass}{else}col-xs-12 col-md-12 col-lg-3 col-xl-4{/if}{/capture}

<div class="products{if !empty($cssClass)} {$cssClass}{/if}">
    {foreach from=$products item="product" key="position"}
        {include file="catalog/_partials/miniatures/product-bestseller.tpl" product=$product position=$position productClasses=$productClasses}
    {/foreach}
</div>
