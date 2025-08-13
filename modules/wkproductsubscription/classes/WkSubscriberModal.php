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

class WkSubscriberModal extends ObjectModel
{
    public $id_wk_subscription_subscribers;
    public $id_customer;
    public $id_shop_group;
    public $id_shop;
    public $active;
    public $date_add;
    public $date_upd;

    public static $definition = [
        'table' => 'wk_subscription_subscribers',
        'primary' => 'id_wk_subscription_subscribers',
        'multilang' => false,
        'fields' => [
            'id_customer' => [
                'type' => self::TYPE_INT,
                'required' => true,
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
            'active' => [
                'type' => self::TYPE_BOOL,
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

    /**
     * Get customer [subscriber] subscription data
     *
     * @param mixed $idSubscriber Subscription ID
     *
     * @return array
     */
    public static function getCustomerSubscriptionData($idSubscriber)
    {
        if (!$idSubscriber) {
            return [];
        }

        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers`
            WHERE `id_wk_subscription_subscribers` = ' . (int) $idSubscriber . '
        ';

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }
}
