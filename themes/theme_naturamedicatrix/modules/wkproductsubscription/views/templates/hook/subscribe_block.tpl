{*
CUSTOM SYSTEME ABONNEMENT
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
</style>

<div class="wk-subscription-block mt-0 mb-4 border border-gray-300 p-2.5 rounded-md">
    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')}
        <div class="">
            <div class="">
                <div class="alert alert-info wk_subscription_alert" role="alert">
                    {$subscriptionMsg nofilter}
                </div>
            </div>
        </div>
    {/if}
    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG') && $offerMsgText}
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info wk_subscription_alert" role="alert" style="margin:10px 0 0;">
                    {$offerMsgText nofilter}
                </div>
            </div>
        </div>
    {/if}
    <div class="wksubscribe mt-0">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="row">
                    <div style="display:none;">
                        <span class="custom-radio float-xs-left">
                            <input
                                checked="checked"
                                name="subscription_plan"
                                value="1"
                                id="wk_subscription_subscribe"
                                type="radio"
                                >
                            <span></span>
                        </span>
                    </div>
                    <div class="col-sm-11 p-0">
                        <label for="wk_subscription_subscribe" class="mb-0">
                            <span class="text-lg text-gray-900 font-semibold">{$subscribeBtnText|escape:'htmlall':'UTF-8'}</span>
                        </label>
                    </div>
                    <div class="wksubscription-options col-md-12 my-0">
                        <div class="form-group row">
                                <label class="text-gray-600 mb-0">{l s='Sans engagement' mod='wkproductsubscription'}</label><br/>
                                <label class="text-gray-600 mb-4">{l s='Livraison à la fréquence de votre choix' mod='wkproductsubscription'}</label>
                                <select class="form-control wkUpdateTempCart text-gray-800 px-1.5 py-4" id="wkSubscriptionFrequency">
                                    {foreach from=$availableCycles item=cycles}
                                        {assign var="currentFreq" value="`$cycles.frequency`_`$cycles.cycle`"}
                                        {if isset($frequency) && isset($cycle)}
                                            {assign var="selectedFreq" value="`$frequency`_`$cycle`"}
                                        {/if}
                                        {if isset($selectedFreq) && ($currentFreq == $selectedFreq)}
                                            <option class="text-gray-800" selected="selected" value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                        {else}
                                            <option class="text-gray-800" value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')}
                                    {if !$is_virtual}
                                        <label class="text-gray-600">{l s='First delivery date' mod='wkproductsubscription'}</label>
                                        <input type="text" class="form-control wkdatepicker wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" placeholder="{l s='First delivery date' mod='wkproductsubscription'}" readonly="readonly">
                                    {else}
                                        <input type="hidden" class="form-control wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$today_date|escape:'htmlall':'UTF-8'}" readonly="readonly">
                                    {/if}
                                {else}
                                    <input type="hidden" class="form-control wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" readonly="readonly">
                                {/if}
                                <input type="hidden" id="id_sub_temp" value="{if $id_sub_temp}{$id_sub_temp|escape:'htmlall':'UTF-8'}{else}0{/if}" >
                            </div>
                            {if $commonlyUsedText}
                                <div class="col-md-12 wk-most-used-freq-msg">
                                    <div class="alert alert-info wk_subscription_alert">
                                        {$commonlyUsedText|escape:'htmlall':'UTF-8'}
                                    </div>
                                </div>
                            {/if}
                            {if $noSubscriberMsg}
                                <div class="col-md-12 wk-most-used-freq-msg">
                                    <div class="alert alert-info wk_subscription_alert">
                                        {l s='No subscribers yet for this product.' mod='wkproductsubscription'}
                                    </div>
                                </div>
                            {/if}
                            <div class="col-md-12">
                                <div class="wk-subs-success-msg"></div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>