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

<form class="form-horizontal" method="post" id="wksubscription_product_form">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-image"></i>
            {l s='Subscription product' mod='wkproductsubscription'}
        </div>
        <div class="form-wrapper">
            {if isset($id) && ($id > 0)}
                <input type="hidden" name="id" value="{$id|escape:'htmlall':'UTF-8'}">
            {/if}
            <div class="form-group row">
                <label class="col-sm-3 control-label required">{l s='Search product'
                    mod='wkproductsubscription'}</label>
                <div class="col-sm-5">
                    <input type="text" id="wk_id_product" class="form-control" autocomplete="off"
                        value="{$product_name|escape:'htmlall':'UTF-8'}" {if isset($id) && ($id> 0)}disabled{/if} />
                    <div class="product-results"></div>
                    <input type="hidden" name="id_product" id="id_product"
                        value="{$id_product|escape:'htmlall':'UTF-8'}">
                    <div class="help-block">
                        <p>{l s='Search for an existing product by typing minimum 3 letters.'
                            mod='wkproductsubscription'}
                        </p>
                    </div>
                </div>
            </div>
            <div id="wksubscription-block" style="display:{if isset($id) && ($id > 0)}block{else}none{/if}">
                <div class="form-group row" id="wksubscription-attr-block"
                    style="display:{if isset($hasAttr) && ($hasAttr)}block{else}none{/if}">
                    {if $combinations && $hasAttr}
                        <label class="col-sm-3 control-label required">{l s='Select combination'
                                        mod='wkproductsubscription'}</label>
                        <div class="col-sm-5">
                            {if isset($id) && ($id > 0)}
                                {* {foreach from=$combinations item=item}
                                                <div>
                                                    <input type='checkbox' id='{$item.id_product_attribute}' name='product_attribute[]'
                                                        value='{$item.id_product_attribute|escape:'htmlall':'UTF-8'}'

                                    {if isset($subscriptionProductAttr) && in_array($item.id_product_attribute, $subscriptionProductAttr)}
                                                            checked
                                    {/if} />
                                                    <label
                                                        for='{$item.id_product_attribute}'>{$item.attributes|escape:'htmlall':'UTF-8'}</label>
                                                </div>

                                {/foreach} *}

                                <select class="form-control" disabled>
                                    {foreach from=$combinations item=item}
                                        <option
                                            {if isset($subscriptionData['id_product_attribute']) &&
                                            ($subscriptionData['id_product_attribute']==$item.id_product_attribute)}selected{/if}
                                        value="{$item.id_product_attribute|escape:'htmlall':'UTF-8'}">
                                        {$item.attributes|escape:'htmlall':'UTF-8'}</option>
                                {/foreach}
                            </select>


                            <input type="hidden" name="id_product_attribute"
                                value="{$subscriptionData['id_product_attribute']|escape:'htmlall':'UTF-8'}" />
                        {else}

                            {foreach from=$combinations item=item}
                                <div id='id_product_attribute_checkbox'>
                                    {* <input type='checkbox' id='{$item.id_product_attribute|escape:'htmlall':'UTF-8'}'
                                            name='product_attribute[]' value='{$item.id_product_attribute|escape:'htmlall':'UTF-8'}'/>
                                        <label
                                            for='{$item.id_product_attribute}'>{$item.attributes|escape:'htmlall':'UTF-8'}</label> *}
                                </div>
                            {/foreach}

                        {/if}
                    </div>
                    {else}
                    <input type="hidden" name="id_product_attribute" value="0" />
                    {/if}
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">{l s='Enable daily frequency'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input id="daily_frequency_on" type="radio" value="1" name="daily_frequency" {if
                                isset($subscriptionData['daily_frequency']) &&
                                ($subscriptionData['daily_frequency']==1)}checked{/if} />
                            <label for="daily_frequency_on">{l s='Yes' mod='wkproductsubscription'}</label>
                            <input id="daily_frequency_off" type="radio" value="0" name="daily_frequency" {if
                                isset($subscriptionData['daily_frequency']) &&
                                ($subscriptionData['daily_frequency']==0)}checked{elseif
                                !isset($subscriptionData['daily_frequency'])}checked{/if} />
                            <label for="daily_frequency_off">{l s='No' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                        <p class="help-block">
                            {l s='Allow subscribers to have a daily subscription to this product.'
                            mod='wkproductsubscription'}
                        </p>
                    </div>
                </div>
                <div class="form-group row" id="daily-block"
                    style="display:{if isset($subscriptionData['daily_frequency']) && ($subscriptionData['daily_frequency'] == 1)}block{else}none{/if};">
                    <label class="col-sm-3 control-label required">{l s='Select daily cycle'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="60%"><strong>{l s='Select cycle' mod='wkproductsubscription'}</strong>
                                    </th>
                                    <th width="40%"><strong>{l s='Discount' mod='wkproductsubscription'}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$daily_cycles item=dcycle key=i}
                                    <tr>
                                        <td>
                                            <div class="cycle">
                                                <input class="js-cycle-checkbox" id="dcycle-{$i|escape:'htmlall':'UTF-8'}"
                                                    value="{$i|escape:'htmlall':'UTF-8'}" name="daily_cycles[]"
                                                    type="checkbox" {if
                                                                isset($subscriptionData['daily_cycles']) && in_array($i,
                                                $subscriptionData['daily_cycles'])} checked="checked" {/if}>
                                            <label class="cycle-label" for="dcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$dcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-sm"
                                                id="dcycle-discount_{$i|escape:'htmlall':'UTF-8'}"
                                                value="{if isset($subscriptionData['daily_cycles_discount']) && is_array($subscriptionData['daily_cycles_discount'])}{$subscriptionData['daily_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}"
                                                name="daily_cycles_discount[]" type="text">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{l s='Enable weekly frequency'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input id="weekly_frequency_on" type="radio" value="1" name="weekly_frequency" {if
                                isset($subscriptionData['weekly_frequency']) &&
                                ($subscriptionData['weekly_frequency']==1)}checked{/if} />
                            <label for="weekly_frequency_on">{l s='Yes' mod='wkproductsubscription'}</label>
                            <input id="weekly_frequency_off" type="radio" value="0" name="weekly_frequency" {if
                                isset($subscriptionData['weekly_frequency']) &&
                                ($subscriptionData['weekly_frequency']==0)}checked{elseif
                                !isset($subscriptionData['weekly_frequency'])}checked{/if} />
                            <label for="weekly_frequency_off">{l s='No' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                        <p class="help-block">
                            {l s='Allow subscribers to have a weekly subscription to this product.'
                            mod='wkproductsubscription'}
                        </p>
                    </div>
                </div>
                <div class="form-group row" id="weekly-block"
                    style="display:{if isset($subscriptionData['weekly_frequency']) && ($subscriptionData['weekly_frequency'] == 1)}block{else}none{/if};">
                    <label class="col-sm-3 control-label required">{l s='Select weekly cycle'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="60%"><strong>{l s='Select cycle' mod='wkproductsubscription'}</strong>
                                    </th>
                                    <th width="40%"><strong>{l s='Discount' mod='wkproductsubscription'}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$weekly_cycles item=wcycle key=i}
                                    <tr>
                                        <td>
                                            <div class="cycle">
                                                <input class="js-cycle-checkbox" id="wcycle-{$i|escape:'htmlall':'UTF-8'}"
                                                    value="{$i|escape:'htmlall':'UTF-8'}" name="weekly_cycles[]"
                                                    type="checkbox" {if
                                                                isset($subscriptionData['weekly_cycles']) && in_array($i,
                                                $subscriptionData['weekly_cycles'])} checked="checked" {/if}>
                                            <label class="cycle-label" for="wcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$wcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-sm"
                                                id="wcycle-discount_{$i|escape:'htmlall':'UTF-8'}"
                                                value="{if isset($subscriptionData['weekly_cycles_discount']) && is_array($subscriptionData['weekly_cycles_discount'])}{$subscriptionData['weekly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}"
                                                name="weekly_cycles_discount[]" type="text">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{l s='Enable monthly frequency'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input id="monthly_frequency_on" type="radio" value="1" name="monthly_frequency" {if
                                isset($subscriptionData['monthly_frequency']) &&
                                ($subscriptionData['monthly_frequency']==1)}checked{/if} />
                            <label for="monthly_frequency_on">{l s='Yes' mod='wkproductsubscription'}</label>
                            <input id="monthly_frequency_off" type="radio" value="0" name="monthly_frequency" {if
                                isset($subscriptionData['monthly_frequency']) &&
                                ($subscriptionData['monthly_frequency']==0)}checked{elseif
                                !isset($subscriptionData['monthly_frequency'])}checked{/if} />
                            <label for="monthly_frequency_off">{l s='No' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                        <p class="help-block">
                            {l s='Allow subscribers to have a monthly subscription to this product.'
                            mod='wkproductsubscription'}
                        </p>
                    </div>
                </div>
                <div class="form-group row" id="monthly-block"
                    style="display:{if isset($subscriptionData['monthly_frequency']) && ($subscriptionData['monthly_frequency'] == 1)}block{else}none{/if};">
                    <label class="col-sm-3 control-label required">{l s='Select monthly cycle'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="60%"><strong>{l s='Select cycle' mod='wkproductsubscription'}</strong>
                                    </th>
                                    <th width="40%"><strong>{l s='Discount' mod='wkproductsubscription'}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$monthly_cycles item=mcycle key=i}
                                    <tr>
                                        <td>
                                            <div class="cycle">
                                                <input class="js-cycle-checkbox" id="mcycle-{$i|escape:'htmlall':'UTF-8'}"
                                                    value="{$i|escape:'htmlall':'UTF-8'}" name="monthly_cycles[]"
                                                    type="checkbox" {if
                                                                isset($subscriptionData['monthly_cycles']) && in_array($i,
                                                $subscriptionData['monthly_cycles'])} checked="checked" {/if}>
                                            <label class="cycle-label" for="mcycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$mcycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-sm"
                                                id="mcycle-discount_{$i|escape:'htmlall':'UTF-8'}"
                                                value="{if isset($subscriptionData['monthly_cycles_discount']) && is_array($subscriptionData['monthly_cycles_discount'])}{$subscriptionData['monthly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}"
                                                name="monthly_cycles_discount[]" type="text">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{l s='Enable yearly frequency'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input id="yearly_frequency_on" type="radio" value="1" name="yearly_frequency" {if
                                isset($subscriptionData['yearly_frequency']) &&
                                ($subscriptionData['yearly_frequency']==1)}checked{/if} />
                            <label for="yearly_frequency_on">{l s='Yes' mod='wkproductsubscription'}</label>
                            <input id="yearly_frequency_off" type="radio" value="0" name="yearly_frequency" {if
                                isset($subscriptionData['yearly_frequency']) &&
                                ($subscriptionData['yearly_frequency']==0)}checked{elseif
                                !isset($subscriptionData['yearly_frequency'])}checked{/if} />
                            <label for="yearly_frequency_off">{l s='No' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                        <p class="help-block">
                            {l s='Allow subscribers to have a yearly subscription to this product.'
                            mod='wkproductsubscription'}
                        </p>
                    </div>
                </div>
                <div class="form-group row" id="yearly-block"
                    style="display:{if isset($subscriptionData['yearly_frequency']) && ($subscriptionData['yearly_frequency'] == 1)}block{else}none{/if};">
                    <label class="col-sm-3 control-label required">{l s='Select yearly cycle'
                        mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="60%"><strong>{l s='Select cycle' mod='wkproductsubscription'}</strong>
                                    </th>
                                    <th width="40%"><strong>{l s='Discount' mod='wkproductsubscription'}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$yearly_cycles item=ycycle key=i}
                                    <tr>
                                        <td>
                                            <div class="cycle">
                                                <input class="js-cycle-checkbox" id="ycycle-{$i|escape:'htmlall':'UTF-8'}"
                                                    value="{$i|escape:'htmlall':'UTF-8'}" name="yearly_cycles[]"
                                                    type="checkbox" {if
                                                                isset($subscriptionData['yearly_cycles']) && in_array($i,
                                                $subscriptionData['yearly_cycles'])} checked="checked" {/if}>
                                            <label class="cycle-label" for="ycycle-{$i|escape:'htmlall':'UTF-8'}">
                                                <span class="pretty-checkbox  not-color ">
                                                </span>
                                                {$ycycle|escape:'htmlall':'UTF-8'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group money-type">
                                            <input class="form-control input-sm"
                                                id="ycycle-discount_{$i|escape:'htmlall':'UTF-8'}"
                                                value="{if isset($subscriptionData['yearly_cycles_discount']) && is_array($subscriptionData['yearly_cycles_discount'])}{$subscriptionData['yearly_cycles_discount'][$i-1]|escape:'htmlall':'UTF-8'}{else}0{/if}"
                                                name="yearly_cycles_discount[]" type="text">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">{l s='Status' mod='wkproductsubscription'}</label>
                    <div class="col-lg-5">
                        <span class="switch prestashop-switch fixed-width-lg">
                            <input id="active_on" type="radio" value="1" name="active" {if
                                isset($subscriptionData['active']) && ($subscriptionData['active']==1)}checked{/if} />
                            <label for="active_on">{l s='Enabled' mod='wkproductsubscription'}</label>
                            <input id="active_off" type="radio" value="0" name="active" {if
                                isset($subscriptionData['active']) && ($subscriptionData['active']==0)}checked{elseif
                                !isset($subscriptionData['active'])}checked{/if} />
                            <label for="active_off">{l s='Disabled' mod='wkproductsubscription'}</label>
                            <a class="slide-button btn"></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" name="submitAddwk_subscription_products" class="btn btn-default pull-right"
                id="submitAddwk_subscription_products">
                <i class="process-icon-save"></i> {l s='Save' mod='wkproductsubscription'}
            </button>
            <button type="submit" name="submitAddwk_subscription_productsAndStay" class="btn btn-default pull-right"
                id="submitAddwk_subscription_productsAndStay">
                <i class="process-icon-save"></i> {l s='Save & stay' mod='wkproductsubscription'}
            </button>
            <a href="{$link->getAdminLink('AdminSubscriptions')|escape:'htmlall':'UTF-8'}" class="btn btn-default">
                <i class="process-icon-cancel"></i>{l s='Cancel' mod='wkproductsubscription'}
            </a>
        </div>
    </div>
</form>