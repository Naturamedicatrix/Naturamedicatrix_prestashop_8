{*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License version 3.0
* that is bundled with this package in the file LICENSE.txt
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/AFL-3.0
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to a newer
* versions in the future. If you wish to customize this module for your needs
* please refer to CustomizationPolicy.txt file inside our module for more information.
*
* @author Webkul IN
* @copyright Since 2010 Webkul
* @license https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
*}


{if Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')}
    <a
        class                       = "remove-from-cart"
        rel                         = "nofollow"
        title                       = "{l s='Remove subscription' mod='wkproductsubscription'}"
        href                        = "javascript:void(0);"
        data-link-action            = "wk-subscribe-remove-from-cart"
        data-id-product             = "{$product.id_product|escape:'javascript':'UTF-8'}"
        data-id-product-attribute   = "{$product.id_product_attribute|escape:'javascript':'UTF-8'}"
        data-id-customization   	  = "{$product.id_customization|escape:'javascript':'UTF-8'}"
    ><i class="material-icons float-xs-left">highlight_off</i>
    </a>
{/if}
<a
    class                       = "remove-from-cart"
    rel                         = "nofollow"
    title                       = "{l s='View subscription' mod='wkproductsubscription'}"
    href                        = "javascript:void(0);"
    data-link-action            = "wk-subscribe-update-cart"
    data-id-product             = "{$product.id_product|escape:'javascript':'UTF-8'}"
    data-id-product-attribute   = "{$product.id_product_attribute|escape:'javascript':'UTF-8'}"
    data-id-customization   	  = "{$product.id_customization|escape:'javascript':'UTF-8'}"
><i class="material-icons float-xs-left">visibility</i>
</a>

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
