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
<table border="1" width="400">
    <tr>
        <th>Reference</th>
        <th>Count</th>
        <th>Products</th>
    </tr>
    {foreach $results as $result}
        <tr>
            <td valign="top">{$result['reference']}</td>
            <td valign="top" align="center">{$result['total']}</td>
            <td valign="top">{$result['products']}</td>
        </tr>
    {/foreach}
</table>