{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 *}
 <a href="#"
 title="{l s='Delete email alert' d='Modules.Emailalerts.Shop'}"
 class="js-remove-email-alert"
 rel="js-id-emailalerts-{$mailAlert.id_product|intval}-{$mailAlert.id_product_attribute|intval}"
 data-url="{url entity='module' name='ps_emailalerts' controller='actions' params=['process' => 'remove']}">
<i class="material-icons">delete</i>
</a>

<a href="{$mailAlert.link}" style="text-align:center;">
  <img src="{$mailAlert.cover_url|replace:'small_default':'large_default'}" width="250" height="250" alt="" style=""/>
</a>
<a href="{$mailAlert.link}">
  <div>{$mailAlert.name}
    <span>{$mailAlert.attributes_small}</span>
  </div>
</a>
