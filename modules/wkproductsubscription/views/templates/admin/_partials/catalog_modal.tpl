{**
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

<div class="modal fade" id="wk_bulk_subscription_modal" tabindex="-1">
    <div class="modal-dialog modal-xl" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{l s='Select subscription frequencies' mod='wkproductsubscription'}</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="wk_subscription_frequency_container">
                    <img src="{$wk_cat_loader|escape:'htmlall':'UTF-8'}">
                    {l s='Loading form...' mod='wkproductsubscription'}
                </div>
            </div>
            <div class="modal-footer">
                <div class="wk-subs-loader float-left hide">
                    <img src="{$wk_cat_loader|escape:'htmlall':'UTF-8'}">
                    {l s='Please wait until process complete...' mod='wkproductsubscription'}
                </div>
                <button type="button" class="btn btn-danger btn-lg wk_bulk_subscription_modal_cancel">
                    {l s='Close' mod='wkproductsubscription'}
                </button>
                <button type="button" id ="wk_bulk_subscription_frequency_assign" class="btn btn-primary btn-lg">
                    {l s='Assign' mod='wkproductsubscription'}
                </button>
            </div>
        </div>
    </div>
</div>
