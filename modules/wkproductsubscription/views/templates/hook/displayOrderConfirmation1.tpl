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

{if isset($subscriptionData)}
    <section id="content-hook_payment_return" class="card definition-list">
        <div class="card-block">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {l s='You have successfully subscribed product with below details.' mod='wkproductsubscription'}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            {foreach $subscriptionData as $subscription}
                                <tr>
                                    <th>{l s='Product' mod='wkproductsubscription'}</th><td>{$subscription.product_name|escape:'htmlall':'UTF-8'}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Quantity' mod='wkproductsubscription'}</th><td>{$subscription.quantity|escape:'htmlall':'UTF-8'}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Frequency' mod='wkproductsubscription'}</th><td>{$subscription.frequncy_label|escape:'htmlall':'UTF-8'}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Start date' mod='wkproductsubscription'}</th><td>{Tools::displayDate($subscription.first_order_date)|escape:'htmlall':'UTF-8'}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Total amount (tax incl.)' mod='wkproductsubscription'}</th><td>{$subscription.total_amount|escape:'htmlall':'UTF-8'}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;">
                                        <a class="btn btn-primary" href="{$subscription.detail_link|escape:'htmlall':'UTF-8'}" target="_blank">
                                            {l s='View details' mod='wkproductsubscription'}
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/if}
