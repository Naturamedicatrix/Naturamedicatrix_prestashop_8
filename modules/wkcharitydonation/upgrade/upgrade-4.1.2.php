<?php
/**
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
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_4_1_2()
{
    $wkQueries = [
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_donation_info_shop` ADD  `show_donate_button`  tinyint(1) unsigned',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_donation_info_shop` ADD `adv_title_color` varchar(32)',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_donation_info_shop` ADD `adv_desc_color` varchar(32)',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_donation_info_shop` ADD `button_text_color` varchar(32)',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_donation_info_shop` ADD `button_border_color` varchar(32)',
    ];

    $dbInstance = Db::getInstance();
    $success = true;
    foreach ($wkQueries as $query) {
        $success &= $dbInstance->execute(trim($query));
    }

    if ($success) {
        $shopIds = Shop::getContextListShopID();
        $wk_donations_info = Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . 'wk_donation_info');
        if ($wk_donations_info) {
            foreach ($wk_donations_info as $wk_donation_info) {
                foreach ($shopIds as $idShop) {
                    $wkSql = 'UPDATE `' . _DB_PREFIX_ . 'wk_donation_info_shop` SET
                    `show_donate_button` = ' . (int) $wk_donation_info['show_donate_button'] . ',
                    `adv_title_color` = \'' . pSQL($wk_donation_info['adv_title_color']) . '\',
                    `adv_desc_color` = \'' . pSQL($wk_donation_info['adv_desc_color']) . '\',
                    `button_text_color` = \'' . pSQL($wk_donation_info['button_text_color']) . '\',
                    `button_border_color` = \'' . pSQL($wk_donation_info['button_border_color']) . '\'
                    WHERE `id_donation_info` = ' . (int) $wk_donation_info['id_donation_info'] . '
                    AND `id_shop` = ' . (int) $idShop;

                    $dbInstance->execute($wkSql);
                }
            }
        }
    }

    return true;
}
