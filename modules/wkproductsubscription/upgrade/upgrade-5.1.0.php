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

function upgrade_module_5_1_0($module)
{
    $idShop = (int) Configuration::get('PS_SHOP_DEFAULT');
    $shopQuery = [
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_products_shop` (
            `id_wk_subscription_products` int(10) UNSIGNED NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_product` int(10) UNSIGNED NOT NULL,
            `subscription_only` tinyint(4) NOT NULL,
            `daily_frequency` tinyint(4) NOT NULL,
            `weekly_frequency` tinyint(4) NOT NULL,
            `monthly_frequency` tinyint(4) NOT NULL,
            `yearly_frequency` tinyint(4) NOT NULL,
            `daily_cycles` varchar(50) DEFAULT NULL,
            `weekly_cycles` varchar(50) DEFAULT NULL,
            `monthly_cycles` varchar(50) DEFAULT NULL,
            `yearly_cycles` varchar(50) DEFAULT NULL,
            `daily_cycles_discount` text DEFAULT NULL,
            `weekly_cycles_discount` text DEFAULT NULL,
            `monthly_cycles_discount` text DEFAULT NULL,
            `yearly_cycles_discount` text DEFAULT NULL,
            `active` tinyint(4) NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_products`,`id_shop`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_subscribers_shop` (
            `id_wk_subscription_subscribers` int(11) NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_customer` int(10) UNSIGNED NOT NULL,
            `active` tinyint(1) NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_subscribers`, `id_shop`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_subscriber_products_shop` (
            `id_wk_subscription_subscriber_products` int(11) NOT NULL AUTO_INCREMENT,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_subscriber` int(10) UNSIGNED NOT NULL,
            `id_lang` int(10) UNSIGNED NOT NULL,
            `id_address_delivery` int(10) UNSIGNED NOT NULL,
            `id_address_invoice` int(10) UNSIGNED NOT NULL,
            `id_carrier` int(10) UNSIGNED NOT NULL,
            `id_payment` int(10) UNSIGNED NOT NULL,
            `payment_method` varchar(100) NOT NULL,
            `payment_module` varchar(50) NOT NULL,
            `payment_response` text,
            `order_product_details` text,
            `id_product` int(10) UNSIGNED NOT NULL,
            `quantity` int(10) UNSIGNED NOT NULL,
            `base_price` decimal(10,2) NOT NULL,
            `unit_price` decimal(10,2) NOT NULL,
            `total_price` decimal(10,2) NOT NULL,
            `discount` decimal(10,2) NOT NULL,
            `tax_amount` decimal(10,2) NOT NULL,
            `id_customization` int(10) UNSIGNED NOT NULL,
            `id_product_attribute` int(10) UNSIGNED NOT NULL,
            `is_virtual` tinyint(1) NOT NULL DEFAULT '0',
            `frequency` varchar(10) NOT NULL,
            `cycle` int(10) UNSIGNED NOT NULL,
            `first_delivery_date` date NOT NULL,
            `first_order_date` date NOT NULL,
            `first_order_id` int(10) UNSIGNED NOT NULL,
            `shipping_charge` decimal(10,2) NOT NULL,
            `total_amount` decimal(10,2) NOT NULL,
            `id_currency` int(10) UNSIGNED NOT NULL,
            `deleted` tinyint(1) NOT NULL DEFAULT '0',
            `active` tinyint(4) NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_subscriber_products`, `id_shop`)
        ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_schedule_shop` (
            `id_wk_subscription_schedule` int(10) UNSIGNED NOT NULL,
            `id_subscription` int(10) UNSIGNED NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `order_date` date NOT NULL,
            `delivery_date` date NOT NULL,
            `is_order_created` tinyint(1) NOT NULL,
            `is_email_send` tinyint(1) NOT NULL,
            `active` tinyint(1) NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_schedule`, `id_shop`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_orders_shop` (
            `id_wk_subscription_orders` int(10) UNSIGNED NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_order` int(10) UNSIGNED NOT NULL,
            `id_cart` int(10) UNSIGNED NOT NULL,
            `id_subscription` int(10) UNSIGNED NOT NULL,
            `id_schedule` int(10) UNSIGNED NOT NULL,
            `is_delivered` tinyint(1) NOT NULL DEFAULT '0',
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_orders`, `id_shop`)
        ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_temp_cart_shop` (
            `id_wk_subscription_temp_cart` int(11) NOT NULL,
            `id_shop` int(10) UNSIGNED NOT NULL,
            `id_cart` int(10) UNSIGNED NOT NULL,
            `id_cart_rule` int(10) UNSIGNED NOT NULL DEFAULT 0,
            `id_product` int(10) UNSIGNED NOT NULL,
            `id_product_attribute` int(10) UNSIGNED NOT NULL,
            `id_customization` int(10) UNSIGNED NOT NULL,
            `frequency` varchar(10) NOT NULL,
            `cycle` int(11) NOT NULL,
            `first_delivery_date` date NOT NULL,
            `as_subscription` tinyint(1) unsigned DEFAULT 0,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_temp_cart`, `id_shop`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_cache` (
            `id_wk_subscription_cache` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_cart` int(10) UNSIGNED NOT NULL,
            `id_order` int(10) UNSIGNED NOT NULL,
            `id_plan` varchar(255) NOT NULL,
            `hash` varchar(32) NOT NULL,
            `id_currency` int(10) UNSIGNED NOT NULL,
            `order_total` decimal(20,6) NOT NULL,
            `payment_method` varchar(100) NOT NULL,
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`id_wk_subscription_cache`)
          ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        CHANGE `id` `id_wk_subscription_products` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_subscribers`
        CHANGE `id_subscriber` `id_wk_subscription_subscribers` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`
        CHANGE `id_subscription` `id_wk_subscription_subscriber_products` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_schedule`
        CHANGE `id_schedule` `id_wk_subscription_schedule` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_orders`
        CHANGE `id_subscription_order` `id_wk_subscription_orders` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_temp_cart`
        CHANGE `id` `id_wk_subscription_temp_cart` INT(11) NOT NULL AUTO_INCREMENT;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
            ADD `daily_cycles_discount` TEXT NOT NULL AFTER `yearly_cycles`,
            ADD `weekly_cycles_discount` TEXT NOT NULL AFTER `daily_cycles_discount`,
            ADD `monthly_cycles_discount` TEXT NOT NULL AFTER `weekly_cycles_discount`,
            ADD `yearly_cycles_discount` TEXT NOT NULL AFTER `monthly_cycles_discount`;',
        'ALTER TABLE `' . _DB_PREFIX_ . "wk_subscription_temp_cart` ADD `id_cart_rule` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `id_cart`;",
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products` DROP `id_shop`;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` DROP `id_shop`;',
    ];

    $wkDbInstance = Db::getInstance();
    $querySuccess = true;
    foreach ($shopQuery as $wkQuery) {
        $querySuccess &= $wkDbInstance->execute(trim($wkQuery));
    }

    if ($querySuccess) {
        // Copy table data in shop
        $wkSuccess = true;

        $subscriptionProducts = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_products`');
        if ($subscriptionProducts) {
            foreach ($subscriptionProducts as $product) {
                $product['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_products_shop', $product);
            }
        }
        $subscribers = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers`');
        if ($subscribers) {
            foreach ($subscribers as $subscriber) {
                $subscriber['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_subscribers_shop', $subscriber);
            }
        }
        $subsProds = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`');
        if ($subsProds) {
            foreach ($subsProds as $subsProd) {
                $subsProd['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_subscriber_products_shop', $subsProd);
            }
        }
        $schedules = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule`');
        if ($schedules) {
            foreach ($schedules as $schedule) {
                $schedule['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_schedule_shop', $schedule);
            }
        }
        $orders = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_orders`');
        if ($orders) {
            foreach ($orders as $order) {
                $order['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_orders_shop', $order);
            }
        }
        $tempCarts = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_temp_cart`');
        if ($tempCarts) {
            foreach ($tempCarts as $carts) {
                $carts['id_shop'] = (int) $idShop;
                $wkSuccess &= Db::getInstance()->insert('wk_subscription_temp_cart_shop', $carts);
            }
        }

        if ($wkSuccess) {
            // Register newly added hooks
            $module->registerHook('actionObjectCombinationDeleteAfter');
            $module->registerHook('actionWkSubscriptionCancel');

            // New configuration values
            $langOtpArr = [];
            $langOfferArr = [];
            $langMsgArr = [];
            Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_NO_SUBS', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_SEND_CREATE_EMAIL', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_SEND_CANCEL_EMAIL', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_SEND_UPDATE_EMAIL', 1);
            Configuration::updateValue('WK_SUBSCRIPTION_SEND_RENEW_EMAIL', 1);
            foreach (Language::getLanguages(false) as $lang) {
                $langOtpArr[$lang['id_lang']] = $module->l('One-time purchase');
                $langOfferArr[$lang['id_lang']] =
                $module->l('You will save maximum {amount} amount on this product if you subscribe to this.');
                $langMsgArr[$lang['id_lang']] = $module->l('This product is available for subscription.') . ' ' .
                $module->l('To subscribe this product, please select the subscribe button and select subscription options.');
            }
            Configuration::updateValue(
                'WK_SUBSCRIPTION_OTP_BTN_TXT',
                $langOtpArr
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE',
                $langMsgArr,
                true
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE',
                $langOfferArr,
                true
            );

            return true;
        }
    }

    return true;
}
