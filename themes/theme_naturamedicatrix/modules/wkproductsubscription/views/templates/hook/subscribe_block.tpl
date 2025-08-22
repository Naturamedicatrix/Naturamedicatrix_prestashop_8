{*
CUSTOM SYSTEME ABONNEMENT - ORDRE INVERSÉ
*}

<style>
#wkSubscriptionFrequency {
    height: auto;
    padding-right: 0;
    box-shadow: inherit;
}
.wksubscription-options .form-control:focus {
    outline: none !important;
}

.wksubscribe label span,
.wksubscribe label {
    line-height: 1;
}
.wkUpdateTempCart {
    padding-left: 5px;
    padding-right: 5px;
}
</style>

<div class="wk-subscription-block mt-0 mb-4">
    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')}
        <div class="mb-3">
            <div class="alert alert-info wk_subscription_alert" role="alert">
                {$subscriptionMsg nofilter}
            </div>
        </div>
    {/if}
    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG') && $offerMsgText}
        <div class="mb-3">
            <div class="alert alert-info wk_subscription_alert" role="alert">
                {$offerMsgText nofilter}
            </div>
        </div>
    {/if}
    
    <div class="wksubscribe">
        <div class="form-horizontal">
            <div class="subscription-radio-group">
                
                {* OPTION 1: ACHAT UNIQUE *}
                {if $wkDisplayOtpBtn}
                <div class="subscription-radio-item pb-4" id="onetime-option">
                    <span class="custom-radio hidden">
                        <input
                            {if isset($selectctedCheckbox) && $selectctedCheckbox == 0}checked="checked"{else}checked="checked"{/if}
                            name="subscription_plan"
                            type="radio"
                            value="0"
                            id="wk_subscription_one_time"
                            class="wkUpdateTempCart"
                        >
                        <span></span>
                    </span>
                    <div class="unique-buy flex-1 border border-green-700 p-2.5 rounded-lg cursor-pointer">
                        <div class="flex justify-between items-start mb-1.5">
                            <label for="wk_subscription_one_time" class="cursor-pointer">
                                <span class="text-lg text-gray-900 font-semibold">{$otpBtnText|escape:'htmlall':'UTF-8'}</span>
                            </label>
                            <div class="text-right">
                                {if $product.has_discount}
                                    <span class="text-sm text-gray-500 line-through mr-1.5">{$product.regular_price}</span>
                                {/if}
                                <span class="text-lg font-bold text-gray-900" id="unique-buy-price">{$product.price}</span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mb-0 pb-0">
                            <div>{l s='Idéal pour tester le produit' mod='wkproductsubscription'}</div>
                            <div>{l s='Recevez votre produit une seule fois' mod='wkproductsubscription'}</div>
                        </div>
                    </div>
                </div>
                {/if}

                {* OPTION 2: ABONNEMENT *}
                <div class="subscription-radio-item" id="subscription-option">
                    <span class="custom-radio hidden">
                        <input
                            {if !isset($selectctedCheckbox) || $selectctedCheckbox != 0}checked="checked"{/if}
                            name="subscription_plan"
                            value="1"
                            id="wk_subscription_subscribe"
                            type="radio"
                            class="wkUpdateTempCart"
                        >
                        <span></span>
                    </span>
                    <div class="subscription-buy flex-1  border border-gray-200 p-2.5 rounded-lg cursor-pointer">
                        <div class="flex justify-between items-start mb-1.5">
                            <label for="wk_subscription_subscribe" class="cursor-pointer">
                                <span class="text-lg text-gray-900 font-semibold">{$subscribeBtnText|escape:'htmlall':'UTF-8'}</span>
                            </label>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 line-through mr-1.5" id="subscription-original-price">{$product.price}</span>
                                <span class="text-lg font-bold text-green-600" id="subscription-section-price">
                                    <!-- Prix mis à jour par le JS -->
                                </span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mb-0 pb-0">
                            <div>{l s='Sans engagement' mod='wkproductsubscription'}</div>
                            <div>{l s='Livraison à la fréquence de votre choix' mod='wkproductsubscription'}</div>
                        </div>
                        
                        {* Lien vers les conditions d'abonnement *}
                        <div class="mt-2.5 mb-1.5 text-right">
                            <a href="{$link->getCMSLink(12)|escape:'htmlall':'UTF-8'}" 
                               class="text-xs text-gray-500 underline hover:text-gray-700 hover:underline"
                               target="_blank">
                                {l s='Voir les conditions d\'abonnement' mod='wkproductsubscription'}
                            </a>
                        </div>
                        
                        <div class="wksubscription-options mt-2.5 mb-0 pb-0" style="display:none;">
                            <div class="form-group mb-0">
                                <select class="form-control wkUpdateTempCart text-gray-800 px-4 py-2.5 w-full" id="wkSubscriptionFrequency">
                                    {foreach from=$availableCycles item=cycles}
                                        {assign var="currentFreq" value="`$cycles.frequency`_`$cycles.cycle`"}
                                        {if isset($frequency) && isset($cycle)}
                                            {assign var="selectedFreq" value="`$frequency`_`$cycle`"}
                                        {/if}
                                        
                                        {if isset($selectedFreq) && ($currentFreq == $selectedFreq)}
                                            <option class="text-gray-800"
                                                    selected="selected" 
                                                    value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}"
                                                    data-discount="{$cycles.discount|default:0}"
                                                    data-discounted-price="{$cycles.discounted_price|string_format:"%.2f"}"
                                                    >{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                        {else}
                                            <option class="text-gray-800" 
                                                    value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}"
                                                    data-discount="{$cycles.discount|default:0}"
                                                    data-discounted-price="{$cycles.discounted_price|string_format:"%.2f"}"
                                                    >{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>

                            {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')}
                                {if !$is_virtual}
                                    <div class="form-group">
                                        <label class="text-gray-700 font-medium mb-2">{l s='Première date de livraison' mod='wkproductsubscription'}</label>
                                        <input type="text" class="form-control wkdatepicker wkUpdateTempCart text-gray-800 px-3 py-2 w-full" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" placeholder="{l s='First delivery date' mod='wkproductsubscription'}" readonly="readonly">
                                    </div>
                                {else}
                                    <input type="hidden" class="form-control wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$today_date|escape:'htmlall':'UTF-8'}" readonly="readonly">
                                {/if}
                            {/if}
                            <input type="hidden" id="id_sub_temp" value="{if $id_sub_temp}{$id_sub_temp|escape:'htmlall':'UTF-8'}{else}0{/if}" >
                            <div class="wk-subs-error-msg"></div>
                            <div class="wk-subs-success-msg"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
