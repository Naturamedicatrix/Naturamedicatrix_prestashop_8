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

<div id="wksubscription-block">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <p class="alert-text">
                    {l s='If selected product(s) or combination(s) has already subscription frequencies then it will be
                    overridden with new selected frequencies.' mod='wkproductsubscription'}

                </p>
            </div>
            {if $displayShopWarning}
            <div class="alert alert-warning">
                <p class="alert-text">
                    {l s='You are in a multistore context: any modification will impact all your shops, or each shop of
                    the active group.' mod='wkproductsubscription'}
                </p>
            </div>
            {elseif $displayShopGroupWarning}
            <div class="alert alert-warning">
                <p class="alert-text">
                    {l s='You are in a multistore shop group context: any modification will impact all your shops under
                    this shop group.' mod='wkproductsubscription'}
                </p>
            </div>
            {/if}

            {if $displayPackWarning}
            <div class="alert alert-info">
                <p class="alert-text">
                    {l s='Subscription frequencies will not apply on the pack/virtual products.'
                    mod='wkproductsubscription'}
                </p>
            </div>
            {/if}
            <div class="alert wk-form-errors alert-danger">
                <div id="form_subscription_errors"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form id="formBulkSubscription">
        <input type="hidden" name="allow_subscription" value="1" />
        <div class="form-wrapper">
            <div class="clearfix"></div>
            <div class="row" id="subscription_frequency_block">
                <div class="col-lg-12">
                    <h3>{l s='Subscription frequency' mod='wkproductsubscription'}</h3>
                </div>
                <div class="form-group col-lg-3">
                    <label class="form-control-label">
                        {l s='Daily' mod='wkproductsubscription'}</span>
                        <span class="help-box" data-toggle="popover"
                            data-content="{l s='Allow subscribers for daily subscription of the selected product(s).' mod='wkproductsubscription'}"
                            data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_daily">
                        <span class="ps-switch ps-switch-sm">
                            <input type="radio" name="daily_frequency" id="daily_frequency_off_1" value="0" checked />
                            <label for="daily_frequency_off_1">{l s='No' mod='wkproductsubscription'}</label>
                            <input type="radio" name="daily_frequency" id="daily_frequency_on_1" value="1" />
                            <label for="daily_frequency_on_1">{l s='Yes' mod='wkproductsubscription'}</label>
                            <span class="slide-button"></span>
                        </span>
                    </div>
                    <div id="daily-cycle-block" class="cycle-list hide">
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
                                            <input class="js-cycle-checkbox" id="dcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}"
                                                name="daily_cycles[]" type="checkbox">
                                            <label class="cycle-label" for="dcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$dcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="dcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="0"
                                                name="daily_cycles_discount[]" type="text">
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
                        <span class="help-box" data-toggle="popover"
                            data-content="{l s='Allow subscribers for weekly subscription of the selected product(s).' mod='wkproductsubscription'}"
                            data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_weekly">
                        <span class="ps-switch ps-switch-sm">
                            <input type="radio" name="weekly_frequency" id="weekly_frequency_off_1" value="0" checked />
                            <label for="weekly_frequency_off_1">{l s='No' mod='wkproductsubscription'}</label>
                            <input type="radio" name="weekly_frequency" id="weekly_frequency_on_1" value="1" />
                            <label for="weekly_frequency_on_1">{l s='Yes' mod='wkproductsubscription'}</label>
                            <span class="slide-button"></span>
                        </span>
                    </div>
                    <div id="weekly-cycle-block" class="cycle-list hide">
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
                                            <input class="js-cycle-checkbox" id="wcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}"
                                                name="weekly_cycles[]" type="checkbox">
                                            <label class="cycle-label" for="wcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="wcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="0"
                                                name="weekly_cycles_discount[]" type="text">
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
                        <span class="help-box" data-toggle="popover"
                            data-content="{l s='Allow subscribers for monthly subscription of the selected product(s).' mod='wkproductsubscription'}"
                            data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_monthly">
                        <span class="ps-switch ps-switch-sm">
                            <input type="radio" name="monthly_frequency" id="monthly_frequency_off_1" value="0"
                                checked />
                            <label for="monthly_frequency_off_1">{l s='No' mod='wkproductsubscription'}</label>
                            <input type="radio" name="monthly_frequency" id="monthly_frequency_on_1" value="1" />
                            <label for="monthly_frequency_on_1">{l s='Yes' mod='wkproductsubscription'}</label>
                            <span class="slide-button"></span>
                        </span>
                    </div>
                    <div id="monthly-cycle-block" class="cycle-list hide">
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
                                            <input class="js-cycle-checkbox" id="mcycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}"
                                                name="monthly_cycles[]" type="checkbox">
                                            <label class="cycle-label" for="mcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="mcycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="0"
                                                name="monthly_cycles_discount[]" type="text">
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
                        <span class="help-box" data-toggle="popover"
                            data-content="{l s='Allow subscribers for yearly subscription of the selected product(s).' mod='wkproductsubscription'}"
                            data-original-title="" title=""></span>
                    </label>
                    <div for="wk_product_subscription_yearly">
                        <span class="ps-switch ps-switch-sm">
                            <input type="radio" name="yearly_frequency" id="yearly_frequency_off_1" value="0" checked />
                            <label for="yearly_frequency_off_1">{l s='No' mod='wkproductsubscription'}</label>
                            <input type="radio" name="yearly_frequency" id="yearly_frequency_on_1" value="1" />
                            <label for="yearly_frequency_on_1">{l s='Yes' mod='wkproductsubscription'}</label>
                            <span class="slide-button"></span>
                        </span>
                    </div>
                    <div id="yearly-cycle-block" class="cycle-list hide">
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
                                            <input class="js-cycle-checkbox" id="ycycle-{$i|escape:'htmlall':'UTF-8'}" value="{$i|escape:'htmlall':'UTF-8'}"
                                                name="yearly_cycles[]" type="checkbox">
                                            <label class="cycle-label" for="ycycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-small" id="ycycle-discount_{$i|escape:'htmlall':'UTF-8'}" value="0"
                                                name="yearly_cycles_discount[]" type="text">
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
            </div>
        </div>
    </form>
</div>