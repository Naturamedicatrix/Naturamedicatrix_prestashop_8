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

<div class="wk-product-subscription">
    <div class="panel col-lg-12">
        <div class="panel-heading">
            <i class="icon-user"></i>
            {l s='Subscriber details' mod='wkproductsubscription'}
        </div>
        <div class="row">
            <div class="col-md-3 text-center">
                <strong>{l s='Name' mod='wkproductsubscription'}</strong>
                <div class="h4">
                    {$customerData->firstname|escape:'htmlall':'UTF-8'} {$customerData->lastname|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-4 text-center">
                <strong>{l s='Email' mod='wkproductsubscription'}</strong>
                <div class="h4">
                    {$customerData->email|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-3 text-center">
                <strong>{l s='Registration date' mod='wkproductsubscription'}</strong>
                <div class="h4">
                    {Tools::displayDate($customerData->date_add)|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-2 text-center">
                <a class="btn btn-primary btn-block" href="{$customerLink|escape:'htmlall':'UTF-8'}">
                    {l s='View full details' mod='wkproductsubscription'}
                </a>
            </div>
        </div>
    </div>

    <div class="panel col-lg-12">
        <div class="panel-heading">
            <i class="icon-credit-card"></i>
            {l s='Subscription details' mod='wkproductsubscription'}
        </div>
        {if $subscriptions}
            <form method="post" class="form-inline" id="updateSubscriptionDetails">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{$subscriptions.product_bo_link|escape:'htmlall':'UTF-8'}" title="{$subscriptions.product_name|escape:'htmlall':'UTF-8'}" target="_blank">
                            <img class="img-responsive img-thumbnail" src="{$subscriptions.image|escape:'htmlall':'UTF-8'}" alt="{$subscriptions.product_name|escape:'htmlall':'UTF-8'}" width="250">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{$subscriptions.product_bo_link|escape:'htmlall':'UTF-8'}" title="{$subscriptions.product_name|escape:'htmlall':'UTF-8'}" target="_blank">
                        <div class="product-name">{$subscriptions.product_name|escape:'htmlall':'UTF-8'}</div>
                        </a>
                        <strong class="product-price">{$subscriptions.unit_price|escape:'htmlall':'UTF-8'}</strong>
                        {if $subscriptions.has_attributes}
                            <div class="product-variants">
                                <ul class="text-small list-unstyled">
                                {foreach from=$subscriptions.attributes item=attr}
                                    <li>{$attr.group_name|escape:'htmlall':'UTF-8'}: {$attr.attribute_name|escape:'htmlall':'UTF-8'}</li>
                                {/foreach}
                                </ul>
                            </div>
                        {/if}
                        <div class="form-group quantity-block">
                            <label for="wk_subs_quantity">{l s='Quantity:' mod='wkproductsubscription'}</label>
                            {$subscriptions.quantity|escape:'htmlall':'UTF-8'}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="frequency-block">
                            <div class="shipping-icon">
                                <i class="icon-calendar"></i>
                                <span><strong>{l s='Frequency' mod='wkproductsubscription'}</strong>: {$subscriptions.frequency_label|escape:'htmlall':'UTF-8'}</span>
                            </div>
                        </div>

                        {if !$subscriptions.is_virtual}
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-map-marker"></i>
                                    <span><strong>{l s='Delivery address' mod='wkproductsubscription'}</strong>:</span>
                                    <p>
                                        {$subscriptions.address_details.address1|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details.address2|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details.city|escape:'htmlall':'UTF-8'},
                                        {if isset($subscriptions.address_details.state)}
                                            {$subscriptions.address_details.state|escape:'htmlall':'UTF-8'},
                                        {/if}
                                        {$subscriptions.address_details.postcode|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details.country|escape:'htmlall':'UTF-8'}
                                    </p>
                                </div>
                                <div class="shipping-icon">
                                    <i class="icon-map-marker"></i>
                                    <span><strong>{l s='Invoice address' mod='wkproductsubscription'}</strong>:</span>
                                    <p>
                                        {$subscriptions.address_details_invoice.address1|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.address2|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.city|escape:'htmlall':'UTF-8'},
                                        {if isset($subscriptions.address_details_invoice.state)}
                                            {$subscriptions.address_details_invoice.state|escape:'htmlall':'UTF-8'},
                                        {/if}
                                        {$subscriptions.address_details_invoice.postcode|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.country|escape:'htmlall':'UTF-8'}
                                    </p>
                                </div>
                            </div>
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-truck"></i>
                                    <span><strong>{l s='Shipping method' mod='wkproductsubscription'}</strong>: {$subscriptions.carrier_details.name|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                        {else}
                             <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-map-marker"></i>
                                    <span><strong>{l s='Invoice address' mod='wkproductsubscription'}</strong>:</span>
                                    <p>
                                        {$subscriptions.address_details_invoice.address1|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.address2|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.city|escape:'htmlall':'UTF-8'},
                                        {if isset($subscriptions.address_details_invoice.state)}
                                            {$subscriptions.address_details_invoice.state|escape:'htmlall':'UTF-8'},
                                        {/if}
                                        {$subscriptions.address_details_invoice.postcode|escape:'htmlall':'UTF-8'},
                                        {$subscriptions.address_details_invoice.country|escape:'htmlall':'UTF-8'}
                                    </p>
                                </div>
                            </div>
                        {/if}

                        <div class="frequency-block">
                            <div class="shipping-icon">
                                <i class="icon-credit-card"></i>
                                <span><strong>{l s='Payment method' mod='wkproductsubscription'}</strong>: {$subscriptions.payment_method|escape:'htmlall':'UTF-8'}</span>
                            </div>
                        </div>
                        <div class="frequency-block">
                            <div class="shipping-icon">
                                <i class="icon-time"></i>
                                <span><strong>{l s='Subscription start date' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.first_order_date)|escape:'htmlall':'UTF-8'}</span>
                            </div>
                        </div>
                        <div class="frequency-block">
                            <div class="shipping-icon">
                                <i class="icon-time"></i>
                                <span><strong>{l s='First delivery date' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.first_delivery_date)|escape:'htmlall':'UTF-8'}</span>
                            </div>
                        </div>
                        {if $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='Next order date' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.next_order_date)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='Next delivery date' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.next_order_delivery_date)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                        {elseif $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='Subscription cancelled date' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.date_upd)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                        {elseif $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='Auto resume subscription' mod='wkproductsubscription'}</strong>: {Tools::displayDate($subscriptions.auto_renew_date)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                        {/if}

                    </div>
                    <div class="col-md-3">
                        <div class="price-block">
                            <div class="price-icon">
                                {$subscriptions.total_amount|escape:'htmlall':'UTF-8'}
                            </div>
                            <div class="total-label">
                                <small>{l s='Total amount (tax inc.)' mod='wkproductsubscription'}</small>
                            </div>
                        </div>
                        <div class="text-center">
                            {if $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                <div style="margin-bottom:10px;">
                                    <span class="label label-success">
                                        <i class="icon-check"></i>
                                        {l s='Subscription Active' mod='wkproductsubscription'}
                                    </span>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger" id="cancelSubscription-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" data-id="{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}">
                                            <i class="icon-remove"></i>
                                            {l s='Cancel subscription' mod='wkproductsubscription'}
                                    </button>
                                </div>
                                {if $show_pause}
                                    <div>
                                        <button style="margin-top:10px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#pauseModal-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}">
                                                <i class="icon-pause"></i>
                                                {l s='Pause subscription' mod='wkproductsubscription'}
                                        </button>
                                        <div class="modal" tabindex="-1" id="pauseModal-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="text-left" style="font-size: 16px;font-weight: 600;">{l s='Pause subscription' mod='wkproductsubscription'}</div>
                                                        <button style="margin-top: -30px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row ">
                                                            <label class="col-sm-6 control-label required">
                                                                {l s='Pause up to date' mod='wkproductsubscription'}
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input autocomplete="off" readonly class="form-control" type="text" name="pause_no_of_days" id="pauseSubscriptionDate-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" name="pause_subscription" data-id="{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" id="pauseSubscription-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" class="btn btn-info">{l s='Pause' mod='wkproductsubscription'}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                            {elseif $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                <div style="margin-bottom:10px;">
                                    <span class="label label-inactive">
                                        <i class="icon-remove"></i>
                                        {l s='Subscription cancelled' mod='wkproductsubscription'}
                                    </span>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger" id="deleteSubscription-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" data-id="{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}">
                                            <i class="icon-trash"></i>
                                            {l s='Delete subscription' mod='wkproductsubscription'}
                                    </button>
                                </div>
                            {elseif $subscriptions.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                <div style="margin-bottom:10px;">
                                    <span class="label label-inactive">
                                        <i class="icon-pause"></i>
                                        {l s='Subscription paused' mod='wkproductsubscription'}
                                    </span>
                                </div>
                                {if $show_resume}
                                    <div>
                                        <button type="button" class="btn btn-success" id="resumeSubscription-{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}" data-id="{$subscriptions.id_subscription|escape:'htmlall':'UTF-8'}">
                                                <i class="icon-play"></i>
                                                {l s='Resume subscription' mod='wkproductsubscription'}
                                        </button>
                                    </div>
                                {/if}
                            {/if}
                        </div>
                    </div>
                </div>
            </form>
        {/if}
    </div>

    <div class="panel col-lg-12">
        <div class="panel-heading">
            <i class="icon-truck"></i>
            {l s='Delivery history' mod='wkproductsubscription'}
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab1">{l s='Upcoming delivery' mod='wkproductsubscription'}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab2">{l s='Total delivery' mod='wkproductsubscription'} ({$delivered|count|escape:'htmlall':'UTF-8'})</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-center">{l s='Delivery date' mod='wkproductsubscription'}</td>
                                        <td class="text-left">{l s='Product name' mod='wkproductsubscription'}</td>
                                        {* <td class="text-right">{l s='Product price' mod='wkproductsubscription'}</td> *}
                                        {* <td class="text-right">{l s='Quantity' mod='wkproductsubscription'}</td> *}
                                        <td class="text-right">{l s='Shipping cost' mod='wkproductsubscription'}</td>
                                        <td class="text-right">{l s='Discount' mod='wkproductsubscription'}</td>
                                        <td class="text-right">{l s='Total amount' mod='wkproductsubscription'}</td>
                                        <td class="text-center">{l s='Carrier' mod='wkproductsubscription'}</td>
                                        <td class="text-center">{l s='Payment' mod='wkproductsubscription'}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {if $deliveries}
                                        {foreach from=$deliveries item=item key=k}
                                            <tr>
                                                <td class="text-center">{$k+1|escape:'htmlall':'UTF-8'}</td>
                                                <td class="text-center">
                                                    {Tools::displayDate($item.upcoming_delivery)|escape:'htmlall':'UTF-8'}
                                                </td>
                                                <td class="text-left">
                                                    {$item.product_name|escape:'htmlall':'UTF-8'}
                                                </td>
                                                {* <td class="text-right">
                                                    {$item.unit_price}
                                                </td>
                                                <td class="text-right">
                                                    {$item.quantity}
                                                </td> *}
                                                <td class="text-right">
                                                    {$item.shipping_charge|escape:'htmlall':'UTF-8'}
                                                </td>
                                                <td class="text-right">
                                                    -{$item.discount|escape:'htmlall':'UTF-8'}
                                                </td>
                                                <td class="text-right">
                                                    {$item.total_amount|escape:'htmlall':'UTF-8'}
                                                </td>
                                                <td class="text-center">
                                                    {$item.shipping_method|escape:'htmlall':'UTF-8'}
                                                </td>
                                                <td class="text-center">
                                                    {$item.payment_method|escape:'htmlall':'UTF-8'}
                                                </td>
                                            </tr>
                                        {/foreach}
                                    {else}
                                        <tr>
                                            <td colspan="8">
                                                {l s='No upcoming delivery found.' mod='wkproductsubscription'}
                                            </td>
                                        </tr>
                                    {/if}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
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
                                    {if $delivered|count}
                                        {foreach from=$delivered item=item key=k}
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
                                                    <a class="btn btn-default" href="{$item.order_link_bo|escape:'htmlall':'UTF-8'}" target="_blank">
                                                        <i class="icon icon-search-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        {/foreach}
                                    {else}
                                        <tr>
                                            <td colspan="9">
                                                {l s='No delivery found.' mod='wkproductsubscription'}
                                            </td>
                                        </tr>
                                    {/if}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
