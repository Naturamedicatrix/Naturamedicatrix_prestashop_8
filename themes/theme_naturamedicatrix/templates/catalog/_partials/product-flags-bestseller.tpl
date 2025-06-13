{**
 * Template personnalisé pour les badges produits dans les bestsellers
 * N'affiche que les réductions, pas les badges "nouveau"
 *}
{block name='product_flags'}
    <ul class="product-flags js-product-flags">
        {foreach from=$product.flags item=flag}
            {if $flag.type == 'discount' || $flag.type == 'on-sale' || $flag.type == 'price-drop'}
                <li class="product-flag {$flag.type}">{$flag.label}</li>
            {/if}
        {/foreach}
    </ul>
{/block}
