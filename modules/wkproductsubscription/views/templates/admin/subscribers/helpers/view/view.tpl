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
    <div class="panel kpi-container">
        <div class="row">
            <div class="col-xs-6 col-sm-3 box-stats color3">
                <div class="kpi-content">
                    <i class="icon-calendar-empty"></i>
                    <span class="title">{l s='Next delivery date' mod='wkproductsubscription'}</span>
                    <span class="value">{Tools::displayDate($summaryData.next_delivery)|escape:'htmlall':'UTF-8'}</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 box-stats color4">
                <div class="kpi-content">
                    <i class="icon-money"></i>
                    <span class="title">{l s='Subscription total' mod='wkproductsubscription'}</span>
                    <span class="value">{$summaryData.total_subscription_amount|escape:'htmlall':'UTF-8'}</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 box-stats color2">
                <div class="kpi-content">
                    <i class="icon-book"></i>
                    <span class="title">{l s='Products' mod='wkproductsubscription'}</span>
                    <span class="value">{$summaryData.total_subscribed_products|escape:'htmlall':'UTF-8'}</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 box-stats color1">
                <div class="kpi-content">
                    <i class="icon-truck"></i>
                    <span class="title">{l s='Delivery' mod='wkproductsubscription'}</span>
                    <span class="value">{$summaryData.deliveries|escape:'htmlall':'UTF-8'}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel col-lg-12">
        <div class="panel-heading">
            <i class="icon-user"></i>
            {l s='Subscriber details' mod='wkproductsubscription'}
        </div>
        <div class="row">
            <div class="col-md-3 text-center">
                {l s='Name' mod='wkproductsubscription'}
                <div class="h3">
                    {$customerData->firstname|escape:'htmlall':'UTF-8'}
                    {$customerData->lastname|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-4 text-center">
                {l s='Email' mod='wkproductsubscription'}
                <div class="h3">
                    {$customerData->email|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-3 text-center">
                {l s='Registration date' mod='wkproductsubscription'}
                <div class="h3">
                    {Tools::displayDate($customerData->date_add)|escape:'htmlall':'UTF-8'}
                </div>
            </div>
            <div class="col-md-2 text-center">
                <a class="btn btn-primary btn-block wk_style_btn" href="{$customerLink|escape:'htmlall':'UTF-8'}"
                    style=" text-transform: initial !important;">
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
                {foreach from=$subscriptions item=subsDetails}
                    <div class="row">
                        <h2>
                            <a href="{$subsDetails.subscription_link|escape:'htmlall':'UTF-8'}"
                                title="{l s='View Subscription Details' mod='wkproductsubscription'}" target="_blank">
                                {l s='Subscription ID' mod='wkproductsubscription'}:
                                #{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}
                            </a>
                        </h2>
                        {if isset($subsDetails.wkShowSubsciptionPaymentID) && $subsDetails.wkShowSubsciptionPaymentID}
                            <div>
                                <span class='mb-1'><strong>{l s='Payment Gateway' mod='wkproductsubscription'}: </strong>
                                    {$subsDetails.payment_method|escape:'htmlall':'UTF-8'}</span> <br />
                                <span><strong>{l s='Subscrition ID ' mod='wkproductsubscription'}: </strong>
                                    {$subsDetails.paymentsubData.id|escape:'htmlall':'UTF-8'}</span> <br />
                            </div>
                        {/if}

                        <hr />
                        <div class="col-md-3">
                            <a href="{$subsDetails.product_link|escape:'htmlall':'UTF-8'}"
                                title="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}" target="_blank">
                                <img class="img-responsive img-thumbnail" src="{$subsDetails.image|escape:'htmlall':'UTF-8'}"
                                    alt="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}" width="250">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{$subsDetails.product_link|escape:'htmlall':'UTF-8'}"
                                title="{$subsDetails.product_name|escape:'htmlall':'UTF-8'}" target="_blank">
                                <div class="product-name">{$subsDetails.product_name|escape:'htmlall':'UTF-8'}</div>
                            </a>
                            <strong class="product-price">{$subsDetails.unit_price|escape:'htmlall':'UTF-8'}</strong>
                            {if $subsDetails.has_attributes}
                                <div class="product-variants">
                                    <ul class="text-small list-unstyled">
                                        {foreach from=$subsDetails.attributes item=attr}
                                            <li>{$attr.group_name|escape:'htmlall':'UTF-8'}:
                                                {$attr.attribute_name|escape:'htmlall':'UTF-8'}</li>
                                        {/foreach}
                                    </ul>
                                </div>
                            {/if}
                            <div class="form-group quantity-block">
                                <label for="wk_subs_quantity">{l s='Quantity:' mod='wkproductsubscription'}</label>
                                {$subsDetails.quantity|escape:'htmlall':'UTF-8'}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-calendar"></i>
                                    <span><strong>{l s='Frequency' mod='wkproductsubscription'}</strong>:
                                        {$subsDetails.frequency_label|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>

                            {if !$subsDetails.is_virtual}
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-map-marker"></i>
                                        <span><strong>{l s='Delivery address' mod='wkproductsubscription'}</strong>:</span>
                                        <p>
                                            {$subsDetails.address_details.address1|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details.address2|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details.city|escape:'htmlall':'UTF-8'},
                                            {if isset($subsDetails.address_details.state)}
                                                {$subsDetails.address_details.state|escape:'htmlall':'UTF-8'},
                                            {/if}
                                            {$subsDetails.address_details.postcode|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details.country|escape:'htmlall':'UTF-8'}
                                        </p>
                                    </div>
                                    <div class="shipping-icon">
                                        <i class="icon-map-marker"></i>
                                        <span><strong>{l s='Invoice address' mod='wkproductsubscription'}</strong>:</span>
                                        <p>
                                            {$subsDetails.address_details_invoice.address1|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.address2|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.city|escape:'htmlall':'UTF-8'},
                                            {if isset($subsDetails.address_details_invoice.state)}
                                                {$subsDetails.address_details_invoice.state|escape:'htmlall':'UTF-8'},
                                            {/if}
                                            {$subsDetails.address_details_invoice.postcode|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.country|escape:'htmlall':'UTF-8'}
                                        </p>
                                    </div>
                                </div>
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-truck"></i>
                                        <span><strong>{l s='Shipping method' mod='wkproductsubscription'}</strong>:
                                            {$subsDetails.carrier_details.name|escape:'htmlall':'UTF-8'}</span>
                                    </div>
                                </div>
                            {else}
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-map-marker"></i>
                                        <span><strong>{l s='Invoice address' mod='wkproductsubscription'}</strong>:</span>
                                        <p>
                                            {$subsDetails.address_details_invoice.address1|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.address2|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.city|escape:'htmlall':'UTF-8'},
                                            {if isset($subsDetails.address_details_invoice.state)}
                                                {$subsDetails.address_details_invoice.state|escape:'htmlall':'UTF-8'},
                                            {/if}
                                            {$subsDetails.address_details_invoice.postcode|escape:'htmlall':'UTF-8'},
                                            {$subsDetails.address_details_invoice.country|escape:'htmlall':'UTF-8'}
                                        </p>
                                    </div>
                                </div>
                            {/if}

                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-credit-card"></i>
                                    <span><strong>{l s='Payment method' mod='wkproductsubscription'}</strong>:
                                        {$subsDetails.payment_method|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='Subscription start date' mod='wkproductsubscription'}</strong>:
                                        {Tools::displayDate($subsDetails.first_order_date)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                            <div class="frequency-block">
                                <div class="shipping-icon">
                                    <i class="icon-time"></i>
                                    <span><strong>{l s='First delivery date' mod='wkproductsubscription'}</strong>:
                                        {Tools::displayDate($subsDetails.first_delivery_date)|escape:'htmlall':'UTF-8'}</span>
                                </div>
                            </div>
                            {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-time"></i>
                                        <span><strong>{l s='Next delivery date' mod='wkproductsubscription'}</strong>:
                                            {Tools::displayDate($subsDetails.next_order_delivery_date)|escape:'htmlall':'UTF-8'}</span>
                                    </div>
                                </div>
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-time"></i>
                                        <span><strong>{l s='Next order date' mod='wkproductsubscription'}</strong>:
                                            {Tools::displayDate($subsDetails.next_order_date)|escape:'htmlall':'UTF-8'}</span>
                                    </div>
                                </div>
                            {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-time"></i>
                                        <span><strong>{l s='Subscription cancelled date' mod='wkproductsubscription'}</strong>:
                                            {Tools::displayDate($subsDetails.date_upd)|escape:'htmlall':'UTF-8'}</span>
                                    </div>
                                </div>
                            {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                <div class="frequency-block">
                                    <div class="shipping-icon">
                                        <i class="icon-time"></i>
                                        <span><strong>{l s='Auto resume subscription' mod='wkproductsubscription'}</strong>:
                                            {Tools::displayDate($subsDetails.auto_renew_date)|escape:'htmlall':'UTF-8'}</span>
                                    </div>
                                </div>
                            {/if}
                        </div>
                        <div class="col-md-3">
                            <div class="price-block">
                                <div class="price-icon">
                                    {$subsDetails.total_amount|escape:'htmlall':'UTF-8'}
                                </div>
                                <div class="total-label">
                                    <small>{l s='Total amount (tax inc.)' mod='wkproductsubscription'}</small>
                                </div>
                                <div class="total-label">
                                    <small>{l s='Shipping Cost' mod='wkproductsubscription'}:
                                        {$subsDetails.shipping_charge|escape:'htmlall':'UTF-8'}</small>
                                </div>
                            </div>
                            <div class="text-center">
                                {if $subsDetails.allow_actions}
                                    {if $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE}
                                        <div style="margin-bottom:10px;">
                                            <span class="label label-success">
                                                <i class="icon-check"></i>
                                                {l s='Subscription active' mod='wkproductsubscription'}
                                            </span>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger"
                                                id="cancelSubscription-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}"
                                                data-id="{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                                                <i class="icon-remove"></i>
                                                {l s='Cancel subscription' mod='wkproductsubscription'}
                                            </button>
                                        </div>
                                        {if $subsDetails.show_pause}
                                            <div>
                                                <button style="margin-top:10px;" type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#pauseModal-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                                                    <i class="icon-pause"></i>
                                                    {l s='Pause subscription' mod='wkproductsubscription'}
                                                </button>
                                                <div class="modal" tabindex="-1"
                                                    id="pauseModal-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="text-left" style="font-size: 16px;font-weight: 600;">
                                                                    {l s='Pause subscription' mod='wkproductsubscription'}</div>
                                                                <button style="margin-top: -30px;" type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row ">
                                                                    <label class="col-sm-6 control-label required">
                                                                        {l s='Pause up to date' mod='wkproductsubscription'}
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <input autocomplete="off" readonly class="form-control" type="text"
                                                                            name="pause_no_of_days"
                                                                            id="pauseSubscriptionDate-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="pause_subscription"
                                                                    data-id="{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}"
                                                                    id="pauseSubscription-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}"
                                                                    class="btn btn-info">{l s='Pause' mod='wkproductsubscription'}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED}
                                        <div style="margin-bottom:10px;">
                                            <span class="label label-inactive">
                                                <i class="icon-remove"></i>
                                                {l s='Subscription cancelled' mod='wkproductsubscription'}
                                            </span>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger"
                                                id="deleteSubscription-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}"
                                                data-id="{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                                                <i class="icon-trash"></i>
                                                {l s='Delete subscription' mod='wkproductsubscription'}
                                            </button>
                                        </div>
                                    {elseif $subsDetails.active == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE}
                                        <div style="margin-bottom:10px;">
                                            <span class="label label-inactive">
                                                <i class="icon-pause"></i>
                                                {l s='Subscription paused' mod='wkproductsubscription'}
                                            </span>
                                        </div>
                                        {if $subsDetails.show_resume}
                                            <div>
                                                <button type="button" class="btn btn-success"
                                                    id="resumeSubscription-{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}"
                                                    data-id="{$subsDetails.id_subscription|escape:'htmlall':'UTF-8'}">
                                                    <i class="icon-play"></i>
                                                    {l s='Resume subscription' mod='wkproductsubscription'}
                                                </button>
                                            </div>
                                        {/if}
                                    {/if}
                                {/if}
                            </div>
                        </div>
                    </div>
                    <hr>
                {/foreach}
            </form>
        {/if}
    </div>
</div>