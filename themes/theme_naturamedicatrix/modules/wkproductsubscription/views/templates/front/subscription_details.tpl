{*
CUSTOM ABONNEMENT DETAILS
*}

<style>
#cancelSubscription {
    width:
}
</style>


{* {extends file=$layout} *}
{extends 'customer/page.tpl'}

{* LEFT COLUMN *}
{block name="left_column"}
    {include file='customer/_partials/account-left-column.tpl'}
{/block}
{* END LEFT COLUMN *}



{block name="page_content"}
    <h1>{l s='Subscription details' mod='wkproductsubscription'}</h1>
    {if isset($smarty.get.success)}
        <p class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            {l s='Cancelled successfully' mod='wkproductsubscription'}
        </p>
    {/if}
    {if isset($smarty.get.err)}
        <p class="alert alert-danger">
            <button data-dismiss="alert" class="close" type="button">×</button>
            {l s='Something went wrong!' mod='wkproductsubscription'}
        </p>
    {/if}
    {if isset($smarty.get.invalid)}
        <p class="alert alert-danger">
            <button data-dismiss="alert" class="close" type="button">×</button>
            {$invalid|escape:'htmlall':'UTF-8'}
        </p>
    {/if}
    <section class="wk-product-subscription my-6">
        <section class="page-content">
            {if $subsDetails}
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1 min-w-0">
                        <form method="post" class="form-inline" id="updateSubscriptionDetails">
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex flex-col lg:flex-row gap-2 lg:gap-16">
                                    <div class="flex flex-col items-center">
                                        <a href="{$subsDetails.product_link|escape:'htmlall':'UTF-8'}"
                                            title="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}" class="flex justify-center">
                                            <img class="img-responsive"
                                                src="{$subsDetails.image|escape:'htmlall':'UTF-8'}"
                                                alt="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}" width="120">
                                        </a>
                                        <div class="text-center mt-0">
                                        <h4 class="mt-0">
                                            <a class="text-gray-700 text-sm" href="{$subsDetails.product_link|escape:'htmlall':'UTF-8'}"
                                                title="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}">
                                                {$subsDetails.product_name|escape:'htmlall':'UTF-8'}
                                            </a>
                                        </h4>
                                    </div>
                                    
                                        {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE && $update_frequency}
                                            <button style="margin-top:10px;" type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#frequencyModal">
                                                <i class="material-icons">sync</i>
                                                {l s='UPDATE FREQUENCY' mod='wkproductsubscription'}
                                            </button>
                                            <div class="modal" tabindex="-1" id="frequencyModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-left">
                                                                {l s='Update frequency' mod='wkproductsubscription'}</h5>
                                                            <button style="margin-top: -30px;" type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {* <div class="alert alert-warning">
                                                            {l s='Frequency will be change after next order not right now' mod='wkproductsubscription'}
                                                        </div> *}
                                                            <div class="form-group row" style="display: block;margin-bottom: 1rem;">
                                                                <label
                                                                    class="col-md-5 form-control-label required">{l s='Select frequency'
                                                                                                                                                                        mod='wkproductsubscription'}</label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control form-control-select"
                                                                        id="subs_frequency" style="width:inherit;">
                                                                        {if $frequencyData['daily']}
                                                                            <option value="1">{l s='Daily' mod='wkproductsubscription'}
                                                                            </option>
                                                                        {/if}
                                                                        {if $frequencyData['weekly']}
                                                                            <option value="2">{l s='Weekly' mod='wkproductsubscription'}
                                                                            </option>
                                                                        {/if}
                                                                        {if $frequencyData['monthly']}
                                                                            <option value="3">
                                                                                {l s='Monthly' mod='wkproductsubscription'}</option>
                                                                        {/if}
                                                                        {if $frequencyData['yearly']}
                                                                            <option value="4">{l s='Yearly' mod='wkproductsubscription'}
                                                                            </option>
                                                                        {/if}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" style="display: block;margin-bottom: 1rem;">
                                                                <label
                                                                    class="col-md-5 form-control-label required">{l s='Select cycle'
                                                                                                                                                                        mod='wkproductsubscription'}</label>
                                                                <div class="col-md-6">
                                                                    <select class="form-control form-control-select" id="subs_cycle"
                                                                        style="width:inherit;">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update_frequency" id="updateFrequency"
                                                                class="btn btn-primary">{l s='Update' mod='wkproductsubscription'}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    </div>
                                    <div class="">
                                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <div class="flex flex-wrap gap-x-6 gap-y-4 text-sm text-gray-900 items-start">
                                                <div class="flex-shrink-0">
                                                    <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">{l s='Frequency' mod='wkproductsubscription'}</p>
                                                    <p class="mb-0 text-sm font-bold">{$subsDetails.frequency_label|escape:'htmlall':'UTF-8'}</p>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">
                                                        {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                                            {if !$subsDetails.is_virtual}
                                                                {l s='Next delivery date' mod='wkproductsubscription'}
                                                            {else}
                                                                {l s='Next order date' mod='wkproductsubscription'}
                                                            {/if}
                                                        {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                                            {l s='Cancelled date' mod='wkproductsubscription'}
                                                        {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                                            {l s='Auto renew date' mod='wkproductsubscription'}
                                                        {/if}
                                                    </p>
                                                    <p class="mb-0 text-sm font-bold">
                                                        {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                                            {if !$subsDetails.is_virtual}
                                                                {Tools::displayDate($subsDetails.next_delivery_date)|escape:'htmlall':'UTF-8'}
                                                            {else}
                                                                {Tools::displayDate($subsDetails.next_order_date)|escape:'htmlall':'UTF-8'}
                                                            {/if}
                                                        {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                                            <span class="text-danger">{Tools::displayDate($subsDetails.date_upd)|escape:'htmlall':'UTF-8'}</span>
                                                        {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                                            <span class="text-success">{Tools::displayDate($subsDetails.auto_renew_date)|escape:'htmlall':'UTF-8'}</span>
                                                        {/if}
                                                    </p>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">{l s='Unit price' mod='wkproductsubscription'}</p>
                                                    <p class="font-bold mb-0 text-sm">{$subsDetails.unit_price|escape:'htmlall':'UTF-8'}</p>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">{l s='Quantity' mod='wkproductsubscription'}</p>
                                                    <p class="mb-0 text-sm font-bold">{$subsDetails.quantity|escape:'htmlall':'UTF-8'}</p>
                                                </div>

                                                {if $subsDetails.raw_discount > 0}
                                                    <div class="flex-shrink-0">
                                                        <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">{l s='Discount' mod='wkproductsubscription'}</p>
                                                        <p class="mb-0 text-sm font-bold ">-{$subsDetails.discount|escape:'htmlall':'UTF-8'}</p>
                                                    </div>
                                                {/if}

                                                <div class="flex-shrink-0">
                                                    <p class="text-xs text-gray-500 mb-1.5 whitespace-nowrap">{l s='Total amount' mod='wkproductsubscription'}</p>
                                                    <p class="mb-0 text-sm font-bold">{$subsDetails.total_amount|escape:'htmlall':'UTF-8'}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right mt-4">
                                            {if $subsDetails.allow_actions}
                                                {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                                    {if $can_cancel}
                                                        <button type="button" class="btn btn-danger-outline wk_custom_font capitalize" id="cancelSubscription">
                                                            {l s='CANCEL SUBSCRIPTION' mod='wkproductsubscription'}
                                                        </button>
                                                        {if $show_pause}
                                                            <button style="margin-top:10px;" type="button" class="btn btn-info wk_custom_font capitalize font-bold"
                                                                data-toggle="modal" data-target="#pauseModal">
                                                                <i class="material-icons">pause</i>
                                                                {l s='PAUSE SUBSCRIPTION' mod='wkproductsubscription'}
                                                            </button>
                                                            <div class="modal" tabindex="-1" id="pauseModal" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-left">
                                                                                {l s='Pause subscription' mod='wkproductsubscription'}</h5>
                                                                            <button style="margin-top: -30px;" type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group row ">
                                                                                <label class="col-md-5 form-control-label text-left required">
                                                                                    <span style="color: red;">*</span>
                                                                                    {l s='Pause up to date' mod='wkproductsubscription'}
                                                                                </label>
                                                                                <div class="col-md-7">
                                                                                    <input autocomplete="off" readonly class="form-control"
                                                                                        type="text" name="pause_no_of_days"
                                                                                        id="pause_no_of_days">
                                                                                    <p id="pause_error" style="color: red;"></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <button type="submit" name="pause_subscription"
                                                                                id="pauseSubscription"
                                                                                class="btn btn-default">{l s='Pause' mod='wkproductsubscription'}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {/if}
                                                    {/if}
                                                {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                                    <div>
                                                        <p>{l s='Subscription cancelled' mod='wkproductsubscription'}</p>
                                                    </div>
                                                    <div class="product-variants">
                                                        <button type="button" class="btn btn-danger  btn-block wk_custom_font" id="deleteSubscription">
                                                            <i class="material-icons">delete</i>
                                                            {l s='Delete subscription' mod='wkproductsubscription'}
                                                        </button>
                                                    </div>
                                                {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                                    <div>
                                                        <button type="button" class="btn btn-warning btn-block wk_custom_font disabled">
                                                            <i class="material-icons">pause</i>
                                                            {l s='Subscription paused' mod='wkproductsubscription'}
                                                        </button>
                                                    </div>
                                                    {if $show_resume}
                                                        <div class="product-variants">
                                                            <button type="button" class="btn btn-success  btn-block wk_custom_font"
                                                                id="resumeSubscription">
                                                                <i class="material-icons">arrow_right</i>
                                                                {l s='Resume subscription' mod='wkproductsubscription'}
                                                            </button>
                                                        </div>
                                                    {/if}
                                                {/if}
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <input type="hidden" name="wkProdSubToken" value="{$wkProdSubToken|escape:'htmlall':'UTF-8'}">
                            <input type="hidden" name="id_subscription"
                                value="{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                        </form>
                    </div>
                </div>
                {if !$subsDetails.is_virtual}
                    <div class="flex flex-col md:flex-row gap-4 mt-8 mb-6">
                        <div class="flex-1 min-w-0">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">person_pin_circle</i>
                                    {l s='Delivery address' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="address-item">
                                    <header class="h5">
                                        <div class="radio-block">
                                            {if $subsDetails.address_details.alias}
                                                <span
                                                    class="address-alias h4">{$subsDetails.address_details.alias|escape:'htmlall':'UTF-8'}</span>
                                            {/if}
                                            <div class="address">
                                                {$subsDetails.address_details.firstname|escape:'htmlall':'UTF-8'}
                                                {$subsDetails.address_details.lastname|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.address1|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.city|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.postcode|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.state|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.country|escape:'htmlall':'UTF-8'}
                                            </div>
                                        </div>
                                    </header>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">local_shipping</i>
                                    {l s='Shipping method' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="shipping-block">
                                    <div class="shipping-icon">
                                        <i class="material-icons">local_shipping</i>
                                    </div>
                                    <div class="h5">
                                        {$subsDetails.carrier_details.name|escape:'htmlall':'UTF-8'}
                                    </div>
                                    <div class="text-small">
                                        {$subsDetails.carrier_details.delay|escape:'htmlall':'UTF-8'}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">payment</i>
                                    {l s='Payment method' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="shipping-block">
                                    <div class="shipping-icon">
                                        <i class="material-icons">payment</i>
                                    </div>
                                    <div class="h5">
                                        {$subsDetails.payment_method|escape:'htmlall':'UTF-8'}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    {if isset($wkShowSubsciptionPaymentID) && $wkShowSubsciptionPaymentID}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-block">
                                    <h4 class='heading_margin_b_inherit'>
                                        <i class="material-icons">card_membership</i>
                                        {l s='Subscription details' mod='wkproductsubscription'}
                                    </h4>
                                    <hr>
                                    <div class="shipping-block">
                                        <div class="shipping-icon">
                                            <i class="material-icons">card_membership</i>
                                        </div>
                                        <div class="h5">
                                            {if isset($paymentsubData.id)}
                                                {l s='ID' mod='wkproductsubscription'}: {$paymentsubData.id|escape:'htmlall':'UTF-8'}
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    {/if}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">local_shipping</i>
                                    {l s='Delivery history' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="deliveries">
                                    {if $subsDetails.deliveries}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">#</td>
                                                        <td class="text-left">{l s='Order ID' mod='wkproductsubscription'}</td>
                                                        <td class="text-left">{l s='Order reference' mod='wkproductsubscription'}</td>
                                                        <td class="text-right">{l s='Order amount' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Carrier' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Payment' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Delivery date' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Order date' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='View details' mod='wkproductsubscription'}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach from=$subsDetails.deliveries item=item key=k}
                                                        <tr>
                                                            <td class="text-center">{$k+1|escape:'htmlall':'UTF-8'}</td>
                                                            <td class="text-left">
                                                                {$item.id_order|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-left">
                                                                {$item.reference|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-right">
                                                                {$item.total_paid|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {$item.carrier_name|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {$item.payment|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {Tools::displayDate($item.delivery_date)|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {Tools::displayDate($item.order_date)|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn btn-default"
                                                                    href="{$item.order_link|escape:'htmlall':'UTF-8'}" target="_blank">
                                                                    <i class="material-icons">visibility</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                </tbody>
                                            </table>
                                        </div>
                                    {else}
                                        <div class="alert alert-warning">
                                            {l s='No delivery found.' mod='wkproductsubscription'}
                                        </div>
                                    {/if}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                {else}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">person_pin_circle</i>
                                    {l s='Invoice address' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="address-item">
                                    <header class="h5">
                                        <div class="radio-block">
                                            {if $subsDetails.address_details.alias}
                                                <span
                                                    class="address-alias h4">{$subsDetails.address_details.alias|escape:'htmlall':'UTF-8'}</span>
                                            {/if}
                                            <div class="address">
                                                {$subsDetails.address_details.firstname|escape:'htmlall':'UTF-8'}
                                                {$subsDetails.address_details.lastname|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.address1|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.city|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.postcode|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.state|escape:'htmlall':'UTF-8'}<br>
                                                {$subsDetails.address_details.country|escape:'htmlall':'UTF-8'}
                                            </div>
                                        </div>
                                    </header>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">payment</i>
                                    {l s='Payment method' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="shipping-block">
                                    <div class="shipping-icon">
                                        <i class="material-icons">payment</i>
                                    </div>
                                    <div class="h5">
                                        {$subsDetails.payment_method|escape:'htmlall':'UTF-8'}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-block">
                                <h4 class='heading_margin_b_inherit'>
                                    <i class="material-icons">payment</i>
                                    {l s='Order history' mod='wkproductsubscription'}
                                </h4>
                                <hr>
                                <div class="deliveries">
                                    {if $subsDetails.deliveries}
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">#</td>
                                                        <td class="text-left">{l s='Order ID' mod='wkproductsubscription'}</td>
                                                        <td class="text-left">{l s='Order reference' mod='wkproductsubscription'}</td>
                                                        <td class="text-right">{l s='Order amount' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Carrier' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Payment' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='Order date' mod='wkproductsubscription'}</td>
                                                        <td class="text-center">{l s='View details' mod='wkproductsubscription'}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach from=$subsDetails.deliveries item=item key=k}
                                                        <tr>
                                                            <td class="text-center">{$k+1|escape:'htmlall':'UTF-8'}</td>
                                                            <td class="text-left">
                                                                {$item.id_order|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-left">
                                                                {$item.reference|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-right">
                                                                {$item.total_paid|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {$item.carrier_name|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {$item.payment|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                {$item.order_date|escape:'htmlall':'UTF-8'}
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn btn-default"
                                                                    href="{$item.order_link|escape:'htmlall':'UTF-8'}" target="_blank">
                                                                    <i class="material-icons">visibility</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                </tbody>
                                            </table>
                                        </div>
                                    {else}
                                        <div class="alert alert-warning">
                                            {l s='No delivery found.' mod='wkproductsubscription'}
                                        </div>
                                    {/if}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                {/if}
            {else}
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            {l s='Invalid subscription.' mod='wkproductsubscription'}
                        </div>
                    </div>
                </div>
            {/if}
        </section>
    </section>
{/block}