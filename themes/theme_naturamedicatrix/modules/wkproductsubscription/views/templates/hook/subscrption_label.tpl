{*
* CUSTOM TEMPLATE
*}

<span class="bg-primary wkSubsProductBadge text-white">{l s='Produit d\'abonnement' mod='wkproductsubscription'}</span>

<style>
.wkSubsProductBadge {
    display: inline;
    padding: 0.2em 0.6em 0.3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em;
}
</style>

{if WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()}
    <style>
        span.subsBadge {
            display: none !important;
        }
    </style>
{/if}
