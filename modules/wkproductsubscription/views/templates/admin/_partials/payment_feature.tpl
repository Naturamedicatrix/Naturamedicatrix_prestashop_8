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
{if $show_content}
    <div class="alert alert-info" role="alert">
        {l s='This payment method supports the below subscription feature:' mod='wkproductsubscription'}
        <ul>
            {if $create_subs}
                <li>{l s='Create subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $cancel_subs}
                <li>{l s='Cancel subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $update_subs}
                <li>{l s='Update subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $autorenew_subs}
                <li>{l s='Auto renewal subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $pause_subs}
                <li>{l s='Pause/Resume subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $freuency_update_subs}
                <li>{l s='Frequency update subscription' mod='wkproductsubscription'}</li>
            {/if}
            {if $split_order}
                <li>{l s='Multiple normal product with single subscription product in a single cart' mod='wkproductsubscription'}</li>
            {/if}
        </ul>
    </div>
{/if}
