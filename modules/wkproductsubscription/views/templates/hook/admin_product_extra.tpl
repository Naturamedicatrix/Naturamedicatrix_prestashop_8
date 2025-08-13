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

<div id="wksubscription-block">
    <div class="row">
        <div class="col-lg-12">
            {if $displayPackWarning}
                <div class="alert alert-warning">
                    <p class="alert-text">
                        {l s='Enable "Apply virtual/pack product for subscription" setting to activate this product.' mod='wkproductsubscription'}
                    </p>
                </div>
            {/if}
            {if !$displayPackWarning}
                <div class="alert alert-info">
                    <p class="alert-text">
                        {l s='Please select the frequency and respective cycles.' mod='wkproductsubscription'}
                    </p>
                </div>
            {/if}
            <div class="alert wk-form-errors alert-danger">
                <div id="form_hooks_wk_product_subscription_daily"></div>
                <div id="form_hooks_wk_product_subscription_weekly"></div>
                <div id="form_hooks_wk_product_subscription_monthly"></div>
                <div id="form_hooks_wk_product_subscription_yearly"></div>
                <div id="form_hooks_wk_product_subscription_cycle"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    {if !$displayPackWarning}
        <div class="form-wrapper" style="width:100%">
            <div class="row mt-25">
                <div class="col-lg-12">
                    <h3>{l s='Subscription options' mod='wkproductsubscription'}</h3>
                </div>
                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Activate for subscription' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="{l s='Allow this product as subscription.' mod='wkproductsubscription'}" data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_allow">
                        <input data-toggle="switch" class="" id="wk_product_subscription_allow" data-inverse="true" type="checkbox" value="1" name="allow_subscription" {if isset($subscription_data['active']) && $subscription_data['active'] == 1}
                            checked="checked"
                        {/if}>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mt-25" id="subscription_frequency_block" style="display:{if isset($subscription_data['active']) && $subscription_data['active'] != 1}none{/if};">
                <div class="col-lg-12">
                    <h3>{l s='Subscription frequency' mod='wkproductsubscription'}</h3>
                </div>
                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Daily' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="{l s='Allow subscribers for daily subscription of this product.' mod='wkproductsubscription'}" data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_daily">
                        <input data-toggle="switch" class="" id="wk_product_subscription_daily" data-inverse="true" type="checkbox" value="1" name="daily_frequency"
                        {if isset($subscription_data['daily_frequency']) && $subscription_data['daily_frequency'] == 1}
                            checked="checked"
                        {/if}
                        >
                    </div>
                    <div id="daily-cycle-block" class="cycle-list
                        {if isset($subscription_data['daily_frequency']) && $subscription_data['daily_frequency'] == 0}
                            hide
                        {/if}
                    ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{l s='Select cycle' mod='wkproductsubscription'}</th>
                                    <th>{l s='Discount' mod='wkproductsubscription'}</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach from=$daily_cycles item=dcycle key=i}
                                <tr>
                                    <td>
                                        <div class="cycle">
                                            <input class="js-cycle-checkbox" id="dcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}" name="daily_cycles[]" type="checkbox"
                                            {if isset($subscription_data['daily_cycles']) && in_array($i, $subscription_data['daily_cycles'])}
                                                checked="checked"
                                            {/if}
                                            >
                                            <label class="cycle-label" for="dcycle-{$i|escape:'htmlall':'UTF-8'}">
                                            <span class="pretty-checkbox  not-color ">
                                            </span>
                                            {$dcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="dcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="{if isset($subscription_data['daily_cycles_discount']) && is_array($subscription_data['daily_cycles_discount'])}{$subscription_data['daily_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}" name="daily_cycles_discount[]" type="text" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Weekly' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="{l s='Allow subscribers for weekly subscription of this product.' mod='wkproductsubscription'}" data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_weekly">
                        <input data-toggle="switch" class="" id="wk_product_subscription_weekly" data-inverse="true" type="checkbox" value="1" name="weekly_frequency"
                        {if isset($subscription_data['weekly_frequency']) && $subscription_data['weekly_frequency'] == 1}
                            checked="checked"
                        {/if}
                        >
                    </div>
                    <div id="weekly-cycle-block" class="cycle-list
                        {if isset($subscription_data['weekly_frequency']) && $subscription_data['weekly_frequency'] == 0}
                            hide
                        {/if}
                    ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{l s='Select cycle' mod='wkproductsubscription'}</th>
                                    <th>{l s='Discount' mod='wkproductsubscription'}</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach from=$weekly_cycles item=wcycle key=i}
                                <tr>
                                    <td>
                                        <div class="cycle">
                                            <input class="js-cycle-checkbox" id="wcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}" name="weekly_cycles[]" type="checkbox"
                                            {if isset($subscription_data['weekly_cycles']) && in_array($i, $subscription_data['weekly_cycles'])}
                                                checked="checked"
                                            {/if}
                                            >
                                            <label class="cycle-label" for="wcycle-{$i|escape:'htmlall':'UTF-8'}">
                                            <span class="pretty-checkbox  not-color ">
                                            </span>
                                            {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="wcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="{if isset($subscription_data['weekly_cycles_discount']) && is_array($subscription_data['weekly_cycles_discount'])}{$subscription_data['weekly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}" name="weekly_cycles_discount[]" type="text" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Monthly' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="{l s='Allow subscribers for monthly subscription of this product.' mod='wkproductsubscription'}" data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_monthly">
                        <input data-toggle="switch" class="" id="wk_product_subscription_monthly" data-inverse="true" type="checkbox" value="1" name="monthly_frequency"
                        {if isset($subscription_data['monthly_frequency']) && $subscription_data['monthly_frequency'] == 1}
                            checked="checked"
                        {/if}
                        >
                    </div>
                    <div id="monthly-cycle-block" class="cycle-list
                        {if isset($subscription_data['monthly_frequency']) && $subscription_data['monthly_frequency'] == 0}
                            hide
                        {/if}
                    ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{l s='Select cycle' mod='wkproductsubscription'}</th>
                                    <th>{l s='Discount' mod='wkproductsubscription'}</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach from=$monthly_cycles item=wcycle key=i}
                                <tr>
                                    <td>
                                        <div class="cycle">
                                            <input class="js-cycle-checkbox" id="mcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}" name="monthly_cycles[]" type="checkbox"
                                            {if isset($subscription_data['monthly_cycles']) && in_array($i, $subscription_data['monthly_cycles'])}
                                                checked="checked"
                                            {/if}
                                            >
                                            <label class="cycle-label" for="mcycle-{$i|escape:'htmlall':'UTF-8'}">
                                            <span class="pretty-checkbox  not-color ">
                                            </span>
                                            {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="mcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="{if isset($subscription_data['monthly_cycles_discount']) && is_array($subscription_data['monthly_cycles_discount'])}{$subscription_data['monthly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}" name="monthly_cycles_discount[]" type="text" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Yearly' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="{l s='Allow subscribers for yearly subscription of this product.' mod='wkproductsubscription'}" data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_yearly">
                        <input data-toggle="switch" class="" id="wk_product_subscription_yearly" data-inverse="true" type="checkbox" value="1" name="yearly_frequency"
                        {if isset($subscription_data['yearly_frequency']) && $subscription_data['yearly_frequency'] == 1}
                            checked="checked"
                        {/if}
                        >
                    </div>
                    <div id="yearly-cycle-block" class="cycle-list
                    {if isset($subscription_data['yearly_frequency']) && $subscription_data['yearly_frequency'] == 0}
                        hide
                    {/if}
                    ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{l s='Select cycle' mod='wkproductsubscription'}</th>
                                    <th>{l s='Discount' mod='wkproductsubscription'}</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach from=$yearly_cycles item=wcycle key=i}
                                <tr>
                                    <td>
                                        <div class="cycle">
                                            <input class="js-cycle-checkbox" id="ycycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}" name="yearly_cycles[]" type="checkbox"
                                            {if isset($subscription_data['yearly_cycles']) && in_array($i, $subscription_data['yearly_cycles'])}
                                                checked="checked"
                                            {/if}
                                            >
                                            <label class="cycle-label" for="ycycle-{$i|escape:'htmlall':'UTF-8'}">
                                            <span class="pretty-checkbox  not-color ">
                                            </span>
                                            {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="ycycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="{if isset($subscription_data['yearly_cycles_discount']) && is_array($subscription_data['yearly_cycles_discount'])}{$subscription_data['yearly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}" name="yearly_cycles_discount[]" type="text" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="wk_add_subscription" value="1" >
            </div>
        </div>
    {/if}
</div>
