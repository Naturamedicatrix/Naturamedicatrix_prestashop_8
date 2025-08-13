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

class WkSubscriberScheduleModel extends ObjectModel
{
    public $id_wk_subscription_schedule;
    public $id_subscription;
    public $order_date;
    public $delivery_date;
    public $is_order_created;
    public $is_email_send;
    public $active;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'wk_subscription_schedule',
        'primary' => 'id_wk_subscription_schedule',
        'multilang' => false,
        'fields' => [
            'id_subscription' => [
                'type' => self::TYPE_INT,
                'shop' => true,
                'validate' => 'isUnsignedId',
            ],
            'order_date' => [
                'type' => self::TYPE_DATE,
                'required' => true,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
            'delivery_date' => [
                'type' => self::TYPE_DATE,
                'required' => true,
                'shop' => true,
                'validate' => 'isDateFormat',
            ],
            'is_order_created' => [
                'shop' => true,
                'type' => self::TYPE_BOOL,
            ],
            'is_email_send' => [
                'shop' => true,
                'type' => self::TYPE_BOOL,
            ],
            'active' => [
                'shop' => true,
                'type' => self::TYPE_BOOL,
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
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );
        parent::__construct($id, $idLang, $idShop);
    }

    public static function isScheduleBySubscriptionId($idSubscription)
    {
        return Db::getInstance()->getRow('SELECT *
                FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
                . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
                ' WHERE a.id_subscription = ' . (int) $idSubscription . '
                AND a.is_order_created = 0');
    }
}
