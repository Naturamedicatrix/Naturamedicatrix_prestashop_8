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

class WkProductSubscriptionModel extends ObjectModel
{
    public $id_wk_subscription_products;
    public $id_product;
    public $id_shop_default;
    public $subscription_only;
    public $daily_frequency;
    public $weekly_frequency;
    public $monthly_frequency;
    public $yearly_frequency;
    public $daily_cycles;
    public $weekly_cycles;
    public $monthly_cycles;
    public $yearly_cycles;
    public $id_product_attribute;
    public $daily_cycles_discount;
    public $weekly_cycles_discount;
    public $monthly_cycles_discount;
    public $yearly_cycles_discount;
    public $active;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'wk_subscription_products',
        'primary' => 'id_wk_subscription_products',
        'multilang' => false,
        'fields' => [
            'id_product' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
            ],
            'id_product_attribute' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
            ],

            'id_shop_default' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'subscription_only' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'daily_frequency' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'weekly_frequency' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'monthly_frequency' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'yearly_frequency' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'daily_cycles' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'weekly_cycles' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'monthly_cycles' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'yearly_cycles' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'active' => [
                'type' => self::TYPE_BOOL,
                'shop' => true,
            ],
            'daily_cycles_discount' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'weekly_cycles_discount' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'monthly_cycles_discount' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'yearly_cycles_discount' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
            ],
            'date_add' => [
                'type' => self::TYPE_DATE,
                'required' => false,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
            'date_upd' => [
                'type' => self::TYPE_DATE,
                'required' => false,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
        ],
    ];

    public function __construct($id = null, $idLang = null, $idShop = null)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );
        parent::__construct($id, $idLang, $idShop);
    }

    public static function getDatadBySubsId($idSubscriptionProduct)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT *
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_wk_subscription_products` = ' . (int) $idSubscriptionProduct;

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }

    public static function checkIfSubscriptionProduct($id_product, $id_product_attribute = 0)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT a.`id_wk_subscription_products`
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_product` = ' . (int) $id_product;

        if ($id_product_attribute) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
        }

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public static function checkIfSubscriptionProductNoShop($id_product, $id_product_attribute = 0)
    {
        $sql = 'SELECT a.`id_wk_subscription_products`
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a
        WHERE a.`id_product` = ' . (int) $id_product;

        if ($id_product_attribute) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
        }

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public function deleteProductSubscription($id_product)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'DELETE
            FROM `' . _DB_PREFIX_ . 'wk_subscription_products`
            WHERE id_product = ' . (int) $id_product
        );
    }

    public static function getSubscriptionProductId($id_product, $id_product_attribute = 0)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT a.`id_wk_subscription_products`
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_product` = ' . (int) $id_product;

        if ($id_product_attribute) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
        }

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public static function getProductSubscriptionData($id_product, $id_product_attribute = 0)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT wk_subscription_products_shop.*
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_product` = ' . (int) $id_product;

        if ($id_product_attribute) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
        }

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }

    public static function getProductCombinations($idProduct, $idLang)
    {
        $combinations = [];
        $productObj = new Product((int) $idProduct, false, (int) $idLang);
        $attributes = $productObj->getAttributesGroups((int) $idLang);
        if ($attributes) {
            foreach ($attributes as $attribute) {
                if (!isset($combinations[$attribute['id_product_attribute']]['attributes'])) {
                    $combinations[$attribute['id_product_attribute']]['attributes'] = '';
                }
                $combinations[$attribute['id_product_attribute']]['attributes'] .= $attribute['attribute_name'] . '-';
                $combinations[$attribute['id_product_attribute']]['id_product_attribute'] =
                $attribute['id_product_attribute'];
                $combinations[$attribute['id_product_attribute']]['default_on'] = $attribute['default_on'];
                $combinations[$attribute['id_product_attribute']]['reference'] = $attribute['reference'];
            }

            foreach ($combinations as $key => $value) {
                $combinations[$key]['attributes'] = rtrim($value['attributes'], '-');
            }

            usort($combinations, function ($a, $b) {
                return strcmp($a['attributes'], $b['attributes']);
            });
        }

        return $combinations;
    }

    public static function hasAttributes($idProduct)
    {
        if (!Combination::isFeatureActive()) {
            return 0;
        }

        return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT COUNT(*)
            FROM `' . _DB_PREFIX_ . 'product_attribute` pa
            ' . Shop::addSqlAssociation('product_attribute', 'pa') . '
            WHERE pa.`id_product` = ' . (int) $idProduct
        );
    }

    public static function getDiscountByFrequencyAndCycle($frequency, $cycle, $idProduct, $id_product_attribute = 0)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );
        $sqlField = '';
        if ($frequency == 'daily') {
            $sqlField = 'daily_cycles_discount';
        } elseif ($frequency == 'weekly') {
            $sqlField = 'weekly_cycles_discount';
        } elseif ($frequency == 'monthly') {
            $sqlField = 'monthly_cycles_discount';
        } elseif ($frequency == 'yearly') {
            $sqlField = 'yearly_cycles_discount';
        }
        if ($sqlField) {
            $sql = 'SELECT wk_subscription_products_shop.`' . $sqlField . '`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
            . Shop::addSqlAssociation('wk_subscription_products', 'a') .
            'WHERE a.`id_product` = ' . (int) $idProduct;

            if ($id_product_attribute) {
                $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
            }

            $discountString = Db::getInstance()->getValue($sql);

            if ($discountString) {
                $discountArray = json_decode($discountString, true);
                if (isset($discountArray[$cycle - 1])) {
                    return $discountArray[$cycle - 1] / 100;
                }
            }
        }

        return false;
    }

    public static function getDiscountPercentageByFrequencyAndCycle($frequency, $cycle, $idProduct, $id_product_attribute = 0)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );
        $sqlField = '';
        if ($frequency == 'daily') {
            $sqlField = 'daily_cycles_discount';
        } elseif ($frequency == 'weekly') {
            $sqlField = 'weekly_cycles_discount';
        } elseif ($frequency == 'monthly') {
            $sqlField = 'monthly_cycles_discount';
        } elseif ($frequency == 'yearly') {
            $sqlField = 'yearly_cycles_discount';
        }
        if ($sqlField) {
            $sql = 'SELECT wk_subscription_products_shop.`' . $sqlField . '`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
            . Shop::addSqlAssociation('wk_subscription_products', 'a') .
            'WHERE a.`id_product` = ' . (int) $idProduct;

            if ($id_product_attribute) {
                $sql .= ' AND a.`id_product_attribute` = ' . (int) $id_product_attribute;
            }

            $discountString = Db::getInstance()->getValue($sql);

            if ($discountString) {
                $discountArray = json_decode($discountString, true);
                if (isset($discountArray[$cycle - 1])) {
                    return $discountArray[$cycle - 1];
                }
            }
        }

        return false;
    }

    public static function getSubscriptionProductAttributes($idProduct)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT a.`id_product_attribute` FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_product` = ' . (int) $idProduct;

        return Db::getInstance()->executeS($sql);
    }

    public static function getGroupByRecord($id_product)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT *
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_product` = ' . (int) $id_product;

        return Db::getInstance()->executeS($sql);
    }

    public static function getProductIdByShopAndID($id, $shop_id)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        $sql = 'SELECT a.id_product
        FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
        . Shop::addSqlAssociation('wk_subscription_products', 'a') .
        'WHERE a.`id_wk_subscription_products` = ' . (int) $id . ' AND wk_subscription_products_shop.`id_shop` = ' . (int) $shop_id;

        return Db::getInstance()->getValue($sql);
    }
}
