{*
* CUSTOM MODAL POUR LES ABONNEMENTS
*}

<style>
#wkSubscriptionFrequency, #wkFirstDeliveryDate {
    box-shadow: none;
}
#wkSubscriptionFrequency:focus, #wkFirstDeliveryDate:focus {
    outline: none !important;
}
</style>

<!-- Modal -->
<div class="modal fade" id="wkSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="wkModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="wkModelLabel">
                    {l s='Product subscription details' mod='wkproductsubscription'}
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group row mb-0">
                        {if !Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')}
                            <div class="col-md-12 col-sm-12 col-xs-12">
                        {else}
                            <div class="col-md-6 col-sm-12 col-xs-12">
                        {/if}
                            <label>{l s='Update frequency' mod='wkproductsubscription'}</label>
                            <select class="form-control" id="wkSubscriptionFrequency">
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
                                    <label>{l s='Update first delivery date' mod='wkproductsubscription'}</label>
                                    <input type="text" class="form-control wkdatepicker" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" placeholder="{l s='First delivery date' mod='wkproductsubscription'}" readonly="readonly">
                                {else}
                                    <input type="hidden" class="form-control" id="wkFirstDeliveryDate" value="{$today_date|escape:'htmlall':'UTF-8'}" readonly="readonly">
                                {/if}
                            {else}
                                <input type="hidden" class="form-control" id="wkFirstDeliveryDate" value="{$firstDelDate|escape:'htmlall':'UTF-8'}" readonly="readonly">
                            {/if}
                            <input type="hidden" id="id_sub_temp" value="{if $id_sub_temp}{$id_sub_temp|escape:'htmlall':'UTF-8'}{else}0{/if}" >
                        </div>
                        <div class="col-md-12">
                            <div class="wk-subs-success-msg"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {l s='Cancel' mod='wkproductsubscription'}
                        </button>&nbsp;
                        <button class="btn btn-primary" onclick="wkTriggerUpdate()">
                            {l s='Update' mod='wkproductsubscription'}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
