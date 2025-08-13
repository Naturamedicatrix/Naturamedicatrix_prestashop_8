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

function upgrade_module_5_2_0($module)
{
    $shopQuery = [
        'ALTER TABLE `' . _DB_PREFIX_ . "wk_subscription_products`
        ADD `id_shop_default` INT NULL DEFAULT '1' AFTER `id_product`;",
        'ALTER TABLE `' . _DB_PREFIX_ . "wk_subscription_orders`
        ADD `id_shop_group` INT NULL DEFAULT '1' AFTER `id_order`,
        ADD `id_shop` INT NULL DEFAULT '1' AFTER `id_shop_group`;",
        'ALTER TABLE `' . _DB_PREFIX_ . "wk_subscription_subscriber_products`
        ADD `id_shop_group` INT NULL DEFAULT '1' AFTER `id_subscriber`,
        ADD `id_shop` INT NULL DEFAULT '1' AFTER `id_shop_group`;",
        'ALTER TABLE `' . _DB_PREFIX_ . "wk_subscription_subscribers`
        ADD `id_shop_group` INT NULL DEFAULT '1' AFTER `id_customer`,
        ADD `id_shop` INT NULL DEFAULT '1' AFTER `id_shop_group`;",
    ];

    $wkDbInstance = Db::getInstance();
    $querySuccess = true;
    foreach ($shopQuery as $wkQuery) {
        $querySuccess &= $wkDbInstance->execute(trim($wkQuery));
    }

    if ($querySuccess) {
        // Copy table data from shop to main table
        $wkSuccess = true;
        $subscriptionProducts = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_products`
        ORDER BY `id_wk_subscription_products` ASC');
        if ($subscriptionProducts) {
            $doneProducts = [];
            foreach ($subscriptionProducts as $product) {
                if (!in_array($product['id_product'], $doneProducts)) {
                    $subscriptionData = WkProductSubscriptionModel::getProductSubscriptionData($product['id_product']);
                    $objSubsProd = new WkProductSubscriptionModel($product['id_wk_subscription_products'], null, $subscriptionData['id_shop']);
                    $objSubsProd->id_shop_default = (int) $subscriptionData['id_shop'];
                    $objSubsProd->save();
                    unset($objSubsProd);
                    $doneProducts[] = (int) $product['id_product'];
                }
            }
        }

        $subscriptionOrders = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_orders_shop`');
        if ($subscriptionOrders) {
            foreach ($subscriptionOrders as $order) {
                $objSubsOrd = new WkSubscriberOrderModel($order['id_wk_subscription_orders'], null, $order['id_shop']);
                $objSubsOrd->id_shop_group = (int) (new Shop((int) $order['id_shop']))->id_shop_group;
                $objSubsOrd->id_shop = (int) $order['id_shop'];
                $objSubsOrd->save();
                unset($objSubsOrd);
            }
        }

        $subscribers = $wkDbInstance->executeS('SELECT *
        FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers_shop`');
        if ($subscribers) {
            foreach ($subscribers as $subscriber) {
                $objSubsr = new WkSubscriberModal(
                    $subscriber['id_wk_subscription_subscribers'],
                    null,
                    $subscriber['id_shop']
                );
                $objSubsr->id_shop_group = (int) (new Shop((int) $subscriber['id_shop']))->id_shop_group;
                $objSubsr->id_shop = (int) $subscriber['id_shop'];
                $objSubsr->save();
                unset($objSubsr);
            }
        }

        $subscriptionProds = $wkDbInstance->executeS('SELECT *
        FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products_shop`');
        if ($subscriptionProds) {
            foreach ($subscriptionProds as $product) {
                $objSubsrProd = new WkSubscriberProductModal(
                    $product['id_wk_subscription_subscriber_products'],
                    null,
                    $product['id_shop']
                );
                $objSubsrProd->id_shop_group = (int) (new Shop((int) $product['id_shop']))->id_shop_group;
                $objSubsrProd->id_shop = (int) $product['id_shop'];
                $objSubsrProd->save();
                unset($objSubsrProd);
            }
        }

        // Drop shop tables
        $dropQuery = [
            'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wk_subscription_orders_shop`;',
            'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products_shop`;',
            'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'wk_subscription_subscribers_shop`;',
        ];

        foreach ($dropQuery as $wkQuery) {
            $wkDbInstance->execute(trim($wkQuery));
        }

        // Update AMOUNT placeholder for offer
        $langOfferArr = [];
        foreach (Language::getLanguages(false) as $lang) {
            $langOfferArr[$lang['id_lang']] =
            $module->l('You will save maximum {AMOUNT} amount on this product if you subscribe to this.');
        }
        Configuration::updateValue(
            'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE',
            $langOfferArr,
            true
        );
    }

    return true;
}
