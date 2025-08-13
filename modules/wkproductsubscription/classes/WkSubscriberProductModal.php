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

class WkSubscriberProductModal extends ObjectModel
{
    public $id_wk_subscription_subscriber_products;
    public $id_subscriber;
    public $id_shop_group;
    public $id_shop;
    public $id_address_delivery;
    public $id_address_invoice;
    // Carrier reference id
    public $id_carrier;
    public $id_lang;
    public $id_payment;
    public $payment_method;
    public $payment_module;
    public $payment_response;
    public $order_product_details;
    public $id_product;
    public $quantity;
    public $base_price;
    public $unit_price;
    public $total_price;
    public $discount;
    public $tax_amount;
    public $id_customization;
    public $id_product_attribute;
    public $is_virtual;
    public $frequency;
    public $cycle;
    public $first_delivery_date;
    public $first_order_date;
    public $first_order_id;
    public $shipping_charge;
    public $total_amount;
    public $id_currency;
    public $deleted;
    public $active;
    public $pause_up_to;
    public $no_of_pause_day;
    public $date_add;
    public $date_upd;

    public const WK_SUBS_STATUS_CANCELLED = 0;
    public const WK_SUBS_STATUS_ACTIVE = 1;
    public const WK_SUBS_STATUS_PAUSE = 2;

    public $id_shop_default;

    public static $definition = [
        'table' => 'wk_subscription_subscriber_products',
        'primary' => 'id_wk_subscription_subscriber_products',
        'multilang' => false,
        'fields' => [
            'id_subscriber' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_shop_group' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_shop' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_lang' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_address_delivery' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_address_invoice' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_carrier' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'id_payment' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'payment_method' => [
                'type' => self::TYPE_STRING,
            ],
            'payment_module' => [
                'type' => self::TYPE_STRING,
            ],
            'payment_response' => [
                'type' => self::TYPE_STRING,
            ],
            'order_product_details' => [
                'type' => self::TYPE_STRING,
            ],
            'id_product' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'quantity' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'base_price' => [
                'type' => self::TYPE_FLOAT,
            ],
            'unit_price' => [
                'type' => self::TYPE_FLOAT,
            ],
            'total_price' => [
                'type' => self::TYPE_FLOAT,
            ],
            'discount' => [
                'type' => self::TYPE_FLOAT,
            ],
            'tax_amount' => [
                'type' => self::TYPE_FLOAT,
            ],
            'id_customization' => [
                'type' => self::TYPE_INT,
            ],
            'id_product_attribute' => [
                'type' => self::TYPE_INT,
            ],
            'is_virtual' => [
                'type' => self::TYPE_BOOL,
            ],
            'frequency' => [
                'type' => self::TYPE_STRING,
            ],
            'cycle' => [
                'type' => self::TYPE_INT,
            ],
            'first_delivery_date' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDateFormat',
            ],
            'first_order_date' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDateFormat',
            ],
            'first_order_id' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId',
            ],
            'shipping_charge' => [
                'type' => self::TYPE_FLOAT,
            ],
            'total_amount' => [
                'type' => self::TYPE_FLOAT,
            ],
            'id_currency' => [
                'type' => self::TYPE_STRING,
            ],
            'deleted' => [
                'type' => self::TYPE_BOOL,
            ],
            'active' => [
                'type' => self::TYPE_BOOL,
            ],
            'pause_up_to' => [
                // 'shop' => true,
                'type' => self::TYPE_DATE,
                'required' => false,
                'validate' => 'isDateFormat',
            ],
            'no_of_pause_day' => [
                // 'shop' => true,
                'type' => self::TYPE_INT,
                'required' => false,
                'validate' => 'isUnsignedId',
            ],
            'date_add' => [
                'type' => self::TYPE_DATE,
                'required' => false,
                'validate' => 'isDateFormat',
            ],
            'date_upd' => [
                'type' => self::TYPE_DATE,
                'required' => false,
                'validate' => 'isDateFormat',
            ],
        ],
    ];

    public function __construct($id = null, $idLang = null, $idShop = null)
    {
        parent::__construct($id, $idLang, $idShop);
    }
}
