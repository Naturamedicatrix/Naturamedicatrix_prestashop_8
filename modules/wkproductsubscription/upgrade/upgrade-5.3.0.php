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

function upgrade_module_5_3_0($module)
{
    // Set shop in all context
    if (Shop::isFeatureActive()) {
        Shop::setContext(Shop::CONTEXT_ALL);
    }

    $shopQuery = [
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        ADD  `id_product_attribute` int(10) UNSIGNED NOT NULL AFTER `id_product`;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products_shop`
        ADD  `id_product_attribute` int(10) UNSIGNED NOT NULL AFTER `id_product`;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        CHANGE `daily_cycles` `daily_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products_shop`
        CHANGE `daily_cycles` `daily_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        CHANGE `weekly_cycles` `weekly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products_shop`
        CHANGE `weekly_cycles` `weekly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        CHANGE `monthly_cycles` `monthly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products_shop`
        CHANGE `monthly_cycles` `monthly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        CHANGE `yearly_cycles` `yearly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',
        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products_shop`
        CHANGE `yearly_cycles` `yearly_cycles` TEXT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products`
        DROP INDEX `id_product`;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_products` ADD UNIQUE (id_product, id_product_attribute);',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`
        ADD  `pause_up_to` datetime DEFAULT NULL AFTER `active`;',

        'ALTER TABLE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`
        ADD  `no_of_pause_day` INT NULL DEFAULT NULL AFTER `pause_up_to`;',
    ];

    $wkDbInstance = Db::getInstance();
    $querySuccess = true;
    foreach ($shopQuery as $wkQuery) {
        $querySuccess &= $wkDbInstance->execute(trim($wkQuery));
    }

    if ($querySuccess) {
        // Copy table data from shop to main table
        $querySuccess = true;
        $subscriptionProducts = $wkDbInstance->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_products`
        ORDER BY `id_wk_subscription_products` ASC');
        if ($subscriptionProducts) {
            foreach ($subscriptionProducts as $product) {
                $obj = new Product($product['id_product']);
                $isCombinationProduct = $obj->hasCombinations();
                if ($isCombinationProduct) {
                    $combinations = $obj->getAttributesResume(Context::getContext()->language->id);
                    if ($combinations) {
                        $wkObj = new WkProductSubscriptionModel($product['id_wk_subscription_products']);
                        $wkObj->delete();
                        unset($wkObj);
                        unset($product['id_wk_subscription_products']);
                        foreach ($combinations as $combination) {
                            $wkObj = new WkProductSubscriptionModel();
                            $product['id_product_attribute'] = $combination['id_product_attribute'];
                            foreach ($product as $key => $value) {
                                $wkObj->{$key} = $value;
                            }
                            $wkObj->save();
                            unset($wkObj);
                        }
                    }
                }
            }
        }

        Configuration::updateValue('WK_SUBSCRIPTION_SEND_PAUSE_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_RESUME_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_PAUSE', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_RESUME', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CRON_ORDER_STATUS', 2);
        Configuration::updateValue('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION', 1);
    }

    return true;
}
