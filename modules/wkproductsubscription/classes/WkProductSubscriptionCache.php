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

class WkProductSubscriptionCache extends ObjectModel
{
    public $id_wk_subscription_cache;
    public $id_cart;
    public $id_order;
    public $id_plan;
    public $hash;
    public $id_currency;
    public $order_total;
    public $payment_method;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'wk_subscription_cache',
        'primary' => 'id_wk_subscription_cache',
        'fields' => [
            'id_cart' => ['type' => self::TYPE_INT, 'required' => true],
            'id_order' => ['type' => self::TYPE_INT],
            'id_currency' => ['type' => self::TYPE_INT, 'required' => true],
            'order_total' => ['type' => self::TYPE_FLOAT, 'required' => true],
            'id_plan' => ['type' => self::TYPE_STRING, 'required' => false],
            'payment_method' => ['type' => self::TYPE_STRING, 'required' => false],
            'hash' => ['type' => self::TYPE_STRING, 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat', 'required' => false],
            'date_upd' => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat', 'required' => false],
        ],
    ];

    /**
     * Calculate subscription hash
     *
     * @param array $params
     *
     * @return string
     */
    public static function calculateSubscriptionHash($params)
    {
        $paramHash = '';
        $productHash = '';

        foreach ($params['products'] as $product) {
            if (!empty($productHash)) {
                $productHash .= '|';
            }
            $productHash .= $product['id_product'] . ':' . $product['id_product_attribute'] . ':' . $product['cart_quantity'];
        }

        foreach ($params as $k => $v) {
            if ($k != 'products') {
                $paramHash .= '/' . $v;
            }
        }

        return md5($productHash . $paramHash . 'wkproductsubscription');
    }

    public static function deleteExistingCacheByCart($idCart)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
            'wk_subscription_cache',
            '`id_cart` = ' . (int) $idCart
        );
    }

    /**
     * Delete unused cache entry through cron
     *
     * @return bool
     */
    public static function clearSubscriptionCache()
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
            'wk_subscription_cache',
            '`id_cart` NOT IN (
                SELECT o.`id_cart` FROM `' . _DB_PREFIX_ . 'orders` o
                JOIN `' . _DB_PREFIX_ . 'cart` c
                ON (o.`id_cart` = c.`id_cart`)
            )'
        );
    }

    /**
     * Get cache details
     *
     * @param array $params
     * @param string|null $paymentMethod
     *
     * @return array|false
     */
    public static function getSubscriptionCacheData($params, string $paymentMethod = null)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_cache`
        WHERE `id_cart` = ' . (int) $params['id_cart'] . '
        AND `hash` = \'' . pSQL($params['hash']) . '\'';

        if ($paymentMethod !== null) {
            $sql .= ' AND `payment_method` = \'' . pSQL($paymentMethod) . '\'';
        }

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
}
