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

class WkProductSubscriptionDb
{
    public function createTable()
    {
        if ($sql = $this->getModuleSql()) {
            foreach ($sql as $query) {
                if ($query) {
                    if (!Db::getInstance()->execute(trim($query))) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function getModuleSql()
    {
        return [
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_products` (
                `id_wk_subscription_products` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_product` int(10) UNSIGNED NOT NULL,
                `id_product_attribute` int(10) UNSIGNED NOT NULL,
                `id_shop_default` int(10) UNSIGNED NOT NULL DEFAULT '1',
                `subscription_only` tinyint(4) NOT NULL,
                `daily_frequency` tinyint(4) NOT NULL,
                `weekly_frequency` tinyint(4) NOT NULL,
                `monthly_frequency` tinyint(4) NOT NULL,
                `yearly_frequency` tinyint(4) NOT NULL,
                `daily_cycles` text DEFAULT NULL,
                `weekly_cycles` text DEFAULT NULL,
                `monthly_cycles` text DEFAULT NULL,
                `yearly_cycles` text DEFAULT NULL,
                `daily_cycles_discount` text DEFAULT NULL,
                `weekly_cycles_discount` text DEFAULT NULL,
                `monthly_cycles_discount` text DEFAULT NULL,
                `yearly_cycles_discount` text DEFAULT NULL,
                `active` tinyint(4) NOT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_products`),
                UNIQUE KEY `id_product` (`id_product`, `id_product_attribute`)
              ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_products_shop` (
                `id_wk_subscription_products` int(10) UNSIGNED NOT NULL,
                `id_shop` int(10) UNSIGNED NOT NULL,
                `id_product` int(10) UNSIGNED NOT NULL,
                `id_product_attribute` int(10) UNSIGNED NOT NULL,
                `subscription_only` tinyint(4) NOT NULL,
                `daily_frequency` tinyint(4) NOT NULL,
                `weekly_frequency` tinyint(4) NOT NULL,
                `monthly_frequency` tinyint(4) NOT NULL,
                `yearly_frequency` tinyint(4) NOT NULL,
                `daily_cycles` text DEFAULT NULL,
                `weekly_cycles` text DEFAULT NULL,
                `monthly_cycles` text DEFAULT NULL,
                `yearly_cycles` text DEFAULT NULL,
                `daily_cycles_discount` text DEFAULT NULL,
                `weekly_cycles_discount` text DEFAULT NULL,
                `monthly_cycles_discount` text DEFAULT NULL,
                `yearly_cycles_discount` text DEFAULT NULL,
                `active` tinyint(4) NOT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_products`,`id_shop`)
              ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_subscribers` (
                `id_wk_subscription_subscribers` int(11) NOT NULL AUTO_INCREMENT,
                `id_customer` int(10) UNSIGNED NOT NULL,
                `id_shop_group` int(10) UNSIGNED NOT NULL DEFAULT '1',
                `id_shop` int(10) UNSIGNED NOT NULL,
                `active` tinyint(1) NOT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_subscribers`)
            ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_subscriber_products` (
                `id_wk_subscription_subscriber_products` int(11) NOT NULL AUTO_INCREMENT,
                `id_subscriber` int(10) UNSIGNED NOT NULL,
                `id_shop_group` int(10) UNSIGNED NOT NULL DEFAULT '1',
                `id_shop` int(10) UNSIGNED NOT NULL,
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
                `pause_up_to` datetime DEFAULT NULL,
                `no_of_pause_day` INT NULL DEFAULT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_subscriber_products`)
            ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'wk_subscription_schedule` (
                `id_wk_subscription_schedule` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_subscription` int(10) UNSIGNED NOT NULL,
                `order_date` date NOT NULL,
                `delivery_date` date NOT NULL,
                `is_order_created` tinyint(1) NOT NULL,
                `is_email_send` tinyint(1) NOT NULL,
                `active` tinyint(1) NOT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_schedule`)
              ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
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
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_orders` (
                `id_wk_subscription_orders` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_order` int(10) UNSIGNED NOT NULL,
                `id_shop_group` int(10) UNSIGNED NOT NULL DEFAULT '1',
                `id_shop` int(10) UNSIGNED NOT NULL,
                `id_cart` int(10) UNSIGNED NOT NULL,
                `id_subscription` int(10) UNSIGNED NOT NULL,
                `id_schedule` int(10) UNSIGNED NOT NULL,
                `is_delivered` tinyint(1) NOT NULL DEFAULT '0',
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_orders`),
                UNIQUE KEY `id_order` (`id_order`,`id_cart`,`id_subscription`)
              ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_temp_cart` (
                `id_wk_subscription_temp_cart` int(11) NOT NULL AUTO_INCREMENT,
                `id_cart` int(10) UNSIGNED NOT NULL,
                `id_cart_rule` int(10) UNSIGNED NOT NULL DEFAULT '0',
                `id_product` int(10) UNSIGNED NOT NULL,
                `id_product_attribute` int(10) UNSIGNED NOT NULL,
                `id_customization` int(10) UNSIGNED NOT NULL,
                `frequency` varchar(10) NOT NULL,
                `cycle` int(11) NOT NULL,
                `first_delivery_date` date NOT NULL,
                `as_subscription` tinyint(1) unsigned DEFAULT '0',
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_temp_cart`)
              ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
            'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . "wk_subscription_temp_cart_shop` (
                `id_wk_subscription_temp_cart` int(11) NOT NULL,
                `id_shop` int(10) UNSIGNED NOT NULL,
                `id_cart` int(10) UNSIGNED NOT NULL,
                `id_cart_rule` int(10) UNSIGNED NOT NULL DEFAULT '0',
                `id_product` int(10) UNSIGNED NOT NULL,
                `id_product_attribute` int(10) UNSIGNED NOT NULL,
                `id_customization` int(10) UNSIGNED NOT NULL,
                `frequency` varchar(10) NOT NULL,
                `cycle` int(11) NOT NULL,
                `first_delivery_date` date NOT NULL,
                `as_subscription` tinyint(1) unsigned DEFAULT '0',
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY (`id_wk_subscription_temp_cart`, `id_shop`)
              ) ENGINE=" . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;',
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
        ];
    }

    public function deleteTables()
    {
        return Db::getInstance()->execute('
            DROP TABLE IF EXISTS
            `' . _DB_PREFIX_ . 'wk_subscription_products`,
            `' . _DB_PREFIX_ . 'wk_subscription_products_shop`,
            `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`,
            `' . _DB_PREFIX_ . 'wk_subscription_orders`,
            `' . _DB_PREFIX_ . 'wk_subscription_schedule`,
            `' . _DB_PREFIX_ . 'wk_subscription_schedule_shop`,
            `' . _DB_PREFIX_ . 'wk_subscription_temp_cart`,
            `' . _DB_PREFIX_ . 'wk_subscription_temp_cart_shop`,
            `' . _DB_PREFIX_ . 'wk_subscription_subscribers`,
            `' . _DB_PREFIX_ . 'wk_subscription_cache`
        ');
    }
}
