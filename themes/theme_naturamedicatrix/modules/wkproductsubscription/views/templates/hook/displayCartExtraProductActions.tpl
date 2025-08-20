{*
* CUSTOM ACTIONS ABONNEMENT DANS LE PANIER
*}

<style>
.subscription-actions-inline {
    line-height: 1;
}

.product-line-grid:has(.product-discount) .subscription-actions-inline {
    top: 20px;
}
.subscription-actions-inline span {
    line-height: 1;
}

</style>

<div class="subscription-actions-inline mt-6 md:mt-2.5">
    
    <a
        class="view-subscription subscription-action-btn"
        rel="nofollow"
        title="{l s='View subscription' mod='wkproductsubscription'}"
        href="javascript:void(0);"
        data-link-action="wk-subscribe-update-cart"
        data-id-product="{$product.id_product|escape:'javascript':'UTF-8'}"
        data-id-product-attribute="{$product.id_product_attribute|escape:'javascript':'UTF-8'}"
        data-id-customization="{$product.id_customization|default:0|escape:'javascript':'UTF-8'}"
    >
        <span class="text-xs text-gray-600 btn-outline py-0.5 px-2.5">{l s='Gérer l\'abonnement' mod='wkproductsubscription'}</span>
    </a>

    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')}
        <a
            class="remove-from-cart subscription-action-btn"
            rel="nofollow"
            title="{l s='Remove subscription' mod='wkproductsubscription'}"
            href="javascript:void(0);"
            data-link-action="wk-subscribe-remove-from-cart"
            data-id-product="{$product.id_product|escape:'javascript':'UTF-8'}"
            data-id-product-attribute="{$product.id_product_attribute|escape:'javascript':'UTF-8'}"
            data-id-customization="{$product.id_customization|default:0|escape:'javascript':'UTF-8'}"
        >
            <span class="text-xs text-gray-600 btn-outline py-0.5 px-2.5">{l s='Supprimer l\'abonnement' mod='wkproductsubscription'}</span>
        </a>
    {/if}
</div>



{if WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()}
    <style>
        .cart-line-product-actions > a[data-link-action="wk-subscribe-delete-from-cart"] {
            display: none !important;
        }
    </style>
{/if}

{if WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()}
    <style>
        .cart-line-product-actions > a[data-link-action="wk-subscribe-delete-from-cart"] {
            display: none !important;
        }
    </style>
{/if}
