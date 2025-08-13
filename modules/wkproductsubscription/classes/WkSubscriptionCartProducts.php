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

class WkSubscriptionCartProducts extends ObjectModel
{
    public $id_wk_subscription_temp_cart;
    public $id_cart;
    public $id_cart_rule;
    public $id_product;
    public $id_product_attribute;
    public $id_customization;
    public $frequency;
    public $cycle;
    public $first_delivery_date;
    public $as_subscription;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'wk_subscription_temp_cart',
        'primary' => 'id_wk_subscription_temp_cart',
        'fields' => [
            'id_cart' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
                'required' => true,
            ],
            'id_cart_rule' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
                'required' => false,
            ],
            'id_product' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
                'required' => true,
            ],
            'id_product_attribute' => [
                'type' => self::TYPE_INT,
                'shop' => true,
                'validate' => 'isUnsignedId',
            ],
            'id_customization' => [
                'type' => self::TYPE_INT,
                'shop' => true,
                'validate' => 'isUnsignedId',
            ],
            'frequency' => [
                'type' => self::TYPE_STRING,
                'shop' => true,
                'required' => true,
            ],
            'cycle' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
                'shop' => true,
                'required' => true,
            ],
            'first_delivery_date' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDateFormat',
                'shop' => true,
                'required' => true,
            ],
            'as_subscription' => [
                'type' => self::TYPE_INT,
                'shop' => true,
                'required' => true,
            ],
            'date_add' => [
                'type' => self::TYPE_DATE,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
            'date_upd' => [
                'type' => self::TYPE_DATE,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
        ],
    ];

    public function __construct($id = null, $idLang = null, $idShop = null)
    {
        Shop::addTableAssociation(
            'wk_subscription_temp_cart',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_temp_cart']
        );
        parent::__construct($id, $idLang, $idShop);
    }

    public static function getByIdProductByIdCart(
        $idCart,
        $idProduct,
        $idProductAttr,
        $asSubscription = false
    ) {
        Shop::addTableAssociation(
            'wk_subscription_temp_cart',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_temp_cart']
        );
        $sql = 'SELECT wk_subscription_temp_cart_shop.* FROM `' . _DB_PREFIX_ . 'wk_subscription_temp_cart` a '
                . Shop::addSqlAssociation('wk_subscription_temp_cart', 'a') .
                ' WHERE a.`id_cart` = ' . (int) $idCart . '
                AND a.`id_product` = ' . (int) $idProduct . '
                AND a.`id_product_attribute` = ' . (int) $idProductAttr;

        if ($asSubscription) {
            $sql .= ' AND a.`as_subscription` = 1';
        }

        return Db::getInstance()->getRow($sql);
    }

    public static function getByIdCart($idCart, $asSubscription = false)
    {
        Shop::addTableAssociation(
            'wk_subscription_temp_cart',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_temp_cart']
        );
        $sql = 'SELECT wk_subscription_temp_cart_shop.*  FROM `' . _DB_PREFIX_ . 'wk_subscription_temp_cart` a '
                . Shop::addSqlAssociation('wk_subscription_temp_cart', 'a') .
                ' WHERE a.`id_cart` = ' . (int) $idCart;

        if ($asSubscription) {
            $sql .= ' AND a.`as_subscription` = 1';
        }

        return Db::getInstance()->executeS($sql);
    }

    public static function checkIfCartRuleExists($idCartRule)
    {
        Shop::addTableAssociation(
            'wk_subscription_temp_cart',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_temp_cart']
        );
        $sql = 'SELECT wk_subscription_temp_cart_shop.*  FROM `' . _DB_PREFIX_ . 'wk_subscription_temp_cart` a '
                . Shop::addSqlAssociation('wk_subscription_temp_cart', 'a') .
                ' WHERE a.`id_cart_rule` = ' . (int) $idCartRule;

        return Db::getInstance()->getRow($sql);
    }

    public static function deleteTempCart($idCart)
    {
        if ($tempCartData = self::getByIdCart($idCart)) {
            foreach ($tempCartData as $cartData) {
                $objTempCart = new self((int) $cartData['id_wk_subscription_temp_cart']);
                $objTempCart->delete();
            }
        }

        return true;
    }

    public static function deleteTempCartProduct($idCart, $idProduct, $idProductAttr)
    {
        if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()) {
            WkSubscriptionStripe::deleteStripeTempCartProduct($idCart, $idProduct, $idProductAttr);
        }

        if ($tempCartData = self::getByIdProductByIdCart($idCart, $idProduct, $idProductAttr)) {
            $objTempCart = new self((int) $tempCartData['id_wk_subscription_temp_cart']);

            return $objTempCart->delete();
        }

        return false;
    }

    public function getSplittedProductList($objCart)
    {
        $productType = [];
        if ($cartProducts = $objCart->getProducts()) {
            foreach ($cartProducts as $productData) {
                $idProduct = $productData['id_product'];
                $idAttr = $productData['id_product_attribute'];
                $idCart = $objCart->id;
                if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)
                    && WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idAttr, true)
                ) {
                    $productType[$idProduct] = 1;
                } else {
                    $productType[$idProduct] = 0;
                }
            }
        }

        return $productType;
    }
}
