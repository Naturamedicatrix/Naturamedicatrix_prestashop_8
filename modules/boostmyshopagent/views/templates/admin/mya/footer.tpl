{**
 * 2007-2023 boostmyshop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @copyright 2007-2023 boostmyshop
 * International Registered Trademark & Property of PrestaShop SA
 *}
{if !$disabled}
    {if $gad_id}
        {if $include_google_tag}
            <script async src="https://www.googletagmanager.com/gtag/js?id={$gad_id}"></script>
        {literal}
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
            </script>
        {/literal}
        {/if}

        <script>
            gtag('config', {$gad_id});
        </script>
    {/if}

    {if $include_product_tag}
        <script>
            gtag('event','view_item', {
                'value': {$price},
                'items': [
                    {
                        'id': '{$ref}',
                        'google_business_vertical': 'retail'
                    }]
            });
        </script>
    {/if}

    {if $include_conversion_tag}
        <script>
            gtag('event', 'conversion', {
                'send_to': '{$tracking_id}/{$tracking_label}',
                'value': {$total_paid_excl_tax},
                'currency': '{$currency}',
                'transaction_id': '{$order_ref}'
            });
        </script>
    {/if}
{/if}
