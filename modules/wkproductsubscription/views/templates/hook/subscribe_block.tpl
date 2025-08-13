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

<div class="wk-subscription-block mt-4">
    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')}
        <div class="row">
            <div class="col-md-12">
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
    <div class="row wksubscribe">
        <div class="col-md-12">
            {if $wkDisplayOtpBtn}
                <div class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-1">
                            <span class="custom-radio float-xs-left">
                                <input
                                    {if (isset($selectctedCheckbox) && $selectctedCheckbox == 1)} checked="checked"{/if}
                                    name="subscription_plan"
                                    value="1"
                                    id="wk_subscription_subscribe"
                                    type="radio"
                                    >
                                <span></span>
                            </span>
                        </div>
                        <div class="col-sm-11">
                            <label for="wk_subscription_subscribe">
                                <span class="h6">{$subscribeBtnText|escape:'htmlall':'UTF-8'}</span>
                            </label>
                        </div>
                        <div class="wksubscription-options col-md-12" style="display:{if (isset($selectctedCheckbox) && $selectctedCheckbox == 1)}block{else}none{/if};">
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label>{l s='Select frequency' mod='wkproductsubscription'}</label>
                                    <select class="form-control wkUpdateTempCart" id="wkSubscriptionFrequency">
                                        {foreach from=$availableCycles item=cycles}
                                            {assign var="currentFreq" value="`$cycles.frequency`_`$cycles.cycle`"}
                                            {if isset($frequency) && isset($cycle)}
                                                {assign var="selectedFreq" value="`$frequency`_`$cycle`"}
                                            {/if}
                                            {if isset($selectedFreq) && ($currentFreq == $selectedFreq)}
                                                <option selected="selected" value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                            {else}
                                                <option value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 wk-sm-mt-1">
                                    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')}
                                        {if !$is_virtual}
                                            <label>{l s='First delivery date' mod='wkproductsubscription'}</label>
                                            <input type="text" class="form-control wkdatepicker wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" placeholder="{l s='First delivery date' mod='wkproductsubscription'}" readonly="readonly">
                                        {else}
                                            <input type="hidden" class="form-control wkUpdateTempCart" id="wkFirstDeliveryDate" value="{$today_date|escape:'htmlall':'UTF-8'}" readonly="readonly">
                                        {/if}
                                    {/if}
                                    <input type="hidden" id="id_sub_temp" value="{if $id_sub_temp}{$id_sub_temp|escape:'htmlall':'UTF-8'}{else}0{/if}" >
                                </div>
                                <div class="col-md-12">
                                    <div class="wk-subs-success-msg"></div>
                                </div>
                            </div>
                            {if $commonlyUsedText}
                                <div class="form-group row">
                                    <div class="col-md-12 wk-most-used-freq-msg">
                                        <div class="alert alert-info wk_subscription_alert">
                                            {$commonlyUsedText|escape:'htmlall':'UTF-8'}
                                        </div>
                                    </div>
                                </div>
                            {/if}
                            {if $noSubscriberMsg}
                                <div class="form-group row">
                                    <div class="col-md-12 wk-most-used-freq-msg">
                                        <div class="alert alert-info wk_subscription_alert">
                                            {l s='No subscribers yet for this product.' mod='wkproductsubscription'}
                                        </div>
                                    </div>
                                </div>
                            {/if}
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <span class="custom-radio float-xs-left">
                                <input
                                    name="subscription_plan"
                                    type="radio"
                                    value="0"
                                    id="wk_subscription_one_time"
                                {if (isset($selectctedCheckbox) && $selectctedCheckbox == 0)}checked="checked"{/if}>
                                <span></span>
                            </span>
                        </div>
                        <div class="col-sm-11">
                            <label for="wk_subscription_one_time">
                                <span class="h6">{$otpBtnText|escape:'htmlall':'UTF-8'}</span>
                            </label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            {else}
                <div class="form-horizontal">
                    <div class="row">
                            <div style="display:none;">
                                <span class="custom-radio float-xs-left">
                                    <input
                                {if (isset($selectctedCheckbox) && $selectctedCheckbox == 1)} checked="checked"{/if}
                                        name="subscription_plan"
                                        value="1"
                                        id="wk_subscription_subscribe"
                                        type="radio"
                                        >
                                    <span></span>
                                </span>
                            </div>
                            <div class="col-sm-11">
                                <label for="wk_subscription_subscribe">
                                    <span class="h6">{$subscribeBtnText|escape:'htmlall':'UTF-8'}</span>
                                </label>
                            </div>
                        <div class="wksubscription-options col-md-12">
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label>{l s='Select frequency' mod='wkproductsubscription'}</label>
                                    <select class="form-control wkUpdateTempCart" id="wkSubscriptionFrequency">
                                        {foreach from=$availableCycles item=cycles}
                                            {assign var="currentFreq" value="`$cycles.frequency`_`$cycles.cycle`"}
                                            {if isset($frequency) && isset($cycle)}
                                                {assign var="selectedFreq" value="`$frequency`_`$cycle`"}
                                            {/if}
                                            {if isset($selectedFreq) && ($currentFreq == $selectedFreq)}
                                                <option selected="selected" value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                            {else}
                                                <option value="{$cycles.frequency|escape:'htmlall':'UTF-8'}_{$cycles.cycle|escape:'htmlall':'UTF-8'}">{$cycles.frequencyText|escape:'htmlall':'UTF-8'}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    {if Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')}
                                        {if !$is_virtual}
                                            <label>{l s='First delivery date' mod='wkproductsubscription'}</label>
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
            {/if}
        </div>
    </div>
    <div class="clearfix"></div>
</div>
