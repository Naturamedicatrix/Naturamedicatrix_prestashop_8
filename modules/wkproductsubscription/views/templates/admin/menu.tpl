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

<div id="subscription-modulecontent" class="clearfix">
    <div id="subscription-menu">
        <div class="col-lg-2">
            <div class="list-group" v-on:click.prevent>
                <a href="#" class="list-group-item" v-bind:class="{ 'active': isActive('general') }" v-on:click="makeActive('general')"><i class="icon-cogs"></i> {l s='General' mod='wkproductsubscription'}</a>

                <a href="#" class="list-group-item" v-bind:class="{ 'active': isActive('display') }" v-on:click="makeActive('display')"><i class="icon-image"></i> {l s='Display' mod='wkproductsubscription'}</a>

                <a href="#" class="list-group-item" v-bind:class="{ 'active': isActive('payment') }" v-on:click="makeActive('payment')"><i class="icon-credit-card"></i> {l s='Payment' mod='wkproductsubscription'}</a>

                <a href="#" class="list-group-item" v-bind:class="{ 'active': isActive('email') }" v-on:click="makeActive('email')"><i class="icon-envelope"></i> {l s='Email' mod='wkproductsubscription'}</a>

                <a href="#" class="list-group-item" v-bind:class="{ 'active': isActive('cron') }" v-on:click="makeActive('cron')"><i class="icon-cog"></i> {l s='CRON' mod='wkproductsubscription'}</a>
            </div>
            <div class="list-group">
                <a class="list-group-item"><i class="icon-puzzle-piece"></i> {l s='Module V' mod='wkproductsubscription'} {$module_version|escape:'htmlall':'UTF-8'}</a>
                <a href="{$docPath|escape:'htmlall':'UTF-8'}" target="_blank" class="list-group-item" style="color: #00aff0;" title="{l s='Read module documentation' mod='wkproductsubscription'}"><i class="icon-download"></i> {l s='Documentation' mod='wkproductsubscription'}</a>
                <a href="https://addons.prestashop.com/en/204_webkul"  target="_blank" class="list-group-item" style="color: #00aff0;" title="{l s='Search our more developed modules' mod='wkproductsubscription'}"><i class='icon-external-link-sign'></i> {l s='More Addons' mod='wkproductsubscription'}</a>
            </div>
        </div>
    </div>

    <div id="general" class="subscription_menu wk-hide">
        {include file="./_partials/tabs/general.tpl"}
    </div>

    <div id="display" class="subscription_menu wk-hide">
        {include file="./_partials/tabs/display.tpl"}
    </div>

    <div id="payment" class="subscription_menu wk-hide">
        {include file="./_partials/tabs/payment.tpl"}
    </div>

    <div id="email" class="subscription_menu wk-hide">
        {include file="./_partials/tabs/email.tpl"}
    </div>

    <div id="cron" class="subscription_menu wk-hide">
        {include file="./_partials/tabs/cron.tpl"}
    </div>
</div>

{literal}
<script type="text/javascript">
    var base_url = "{/literal}{$ps_base_dir|escape:'htmlall':'UTF-8'}{literal}";
    var moduleName = "{/literal}{$module_name|escape:'htmlall':'UTF-8'}{literal}";
    var currentPage = "{/literal}{$currentPage|escape:'htmlall':'UTF-8'}{literal}";
    var moduleAdminLink = "{/literal}{$moduleAdminLink|escape:'htmlall':'UTF-8'}{literal}";
</script>
{/literal}
