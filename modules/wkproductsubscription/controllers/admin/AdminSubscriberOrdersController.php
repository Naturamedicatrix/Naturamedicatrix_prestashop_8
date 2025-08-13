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

class AdminSubscriberOrdersController extends ModuleAdminController
{
    protected $statuses_array = [];

    public function __construct()
    {
        $this->className = 'WkSubscriberOrderModel';
        $this->table = 'wk_subscription_orders';
        $this->identifier = 'id_wk_subscription_orders';
        $this->bootstrap = true;
        $this->list_no_link = true;
        $this->lang = false;
        parent::__construct();

        $this->_select = '
        o.*,
		o.id_currency,
        CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `customer`,
        c.email,
        c.id_customer,
        osl.`name` AS `osname`,
        os.`id_order_state`,
		os.`color`,
        IF((SELECT so.id_order FROM `' . _DB_PREFIX_ . 'orders` so
        WHERE so.id_customer = o.id_customer AND so.id_order < o.id_order LIMIT 1) > 0, 0, 1) as new,
		country_lang.name as cname,
		IF(o.valid, 1, 0) badge_success';
        $this->_join .= '
        INNER JOIN `' . _DB_PREFIX_ . 'orders` o ON (o.id_order = a.id_order)
		INNER JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = o.`id_customer`)
        INNER JOIN `' . _DB_PREFIX_ . 'address` address
        ON address.id_address = o.id_address_delivery
        INNER JOIN `' . _DB_PREFIX_ . 'country` country
        ON address.id_country = country.id_country
        INNER JOIN `' . _DB_PREFIX_ . 'country_lang` country_lang
        ON (country.`id_country` = country_lang.`id_country`
        AND country_lang.`id_lang` = ' . (int) Context::getContext()->language->id . ')
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os
        ON (os.`id_order_state` = o.`current_state`)
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl
        ON (os.`id_order_state` = osl.`id_order_state`
        AND osl.`id_lang` = ' . (int) Context::getContext()->language->id . ')';

        $this->_where .= Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a');

        $this->_group = 'GROUP BY id_wk_subscription_orders';
        $this->_orderBy = 'o.id_order';
        $this->_orderWay = 'DESC';

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->_select .= ', shp.`name` as wk_ps_shop_name';
            $this->_join .= ' JOIN `' . _DB_PREFIX_ . 'shop` shp
            ON (shp.`id_shop` = a.`id_shop`)';
        }

        $this->_use_found_rows = true;
        $this->toolbar_title = $this->module->l('Subscriber orders', get_class());

        $statuses = OrderState::getOrderStates((int) $this->context->language->id);
        foreach ($statuses as $status) {
            $this->statuses_array[$status['id_order_state']] = $status['name'];
        }

        // Table Definition
        $this->fields_list = [
            'id_order' => [
                'title' => $this->module->l('Order ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'filter_key' => 'a!id_order',
                'class' => 'fixed-width-xs',
            ],
            'id_subscription' => [
                'title' => $this->module->l('Subscription ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
            ],
            'reference' => [
                'title' => $this->module->l('Reference', get_class()),
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
            ],
            'customer' => [
                'title' => $this->module->l('Subscriber', get_class()),
                'align' => 'left',
                'havingFilter' => true,
            ],
            'email' => [
                'title' => $this->module->l('Email', get_class()),
                'align' => 'left',
                'class' => 'fixed-width-xs',
                'havingFilter' => true,
                'callback' => 'getCustomerDetails',
            ],
            'total_paid_tax_incl' => [
                'title' => $this->module->l('Total', get_class()),
                'align' => 'text-right',
                'filter_key' => 'o!total_paid_tax_incl',
                'currency' => true,
                'havingFilter' => true,
                'callback' => 'setOrderCurrency',
                'badge_success' => true,
            ],
            'payment' => [
                'title' => $this->module->l('Payment', get_class()),
                'havingFilter' => true,
            ],
            'osname' => [
                'title' => $this->module->l('Status', get_class()),
                'type' => 'select',
                'color' => 'color',
                'list' => $this->statuses_array,
                'havingFilter' => true,
                'filter_key' => 'os!id_order_state',
                'filter_type' => 'int',
                'order_key' => 'osname',
            ],
            'date_add' => [
                'title' => $this->module->l('Date', get_class()),
                'align' => 'left',
                'type' => 'datetime',
                'filter_key' => 'o!date_add',
            ],
        ];

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->fields_list['wk_ps_shop_name'] = [
                'title' => $this->module->l('Shop', get_class()),
                'havingFilter' => true,
            ];
        }

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->module->l('Delete selected', get_class()),
                'icon' => 'icon-trash',
                'confirm' => $this->module->l('Delete selected items?', get_class()),
            ],
        ];
    }

    /**
     * renderList
     *
     * @return string|false
     */
    public function renderList()
    {
        $this->addRowAction('orderDetails');

        return parent::renderList();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function displayorderDetailsLink($token, $id_subscription_order)
    {
        $subsData = WkProductSubscriptionGlobal::getSubscriptionOrderDetails((int) $id_subscription_order);
        $id_order = (int) $subsData['id_order'];
        $link = $this->context->link->getAdminLink(
            'AdminOrders',
            $token,
            [],
            ['id_order' => $id_order, 'vieworder' => '']
        );

        $this->context->smarty->assign([
            'btnLabel' => $this->module->l('View', get_class()),
            'btnLink' => $link,
            'icon' => 'icon-search-plus',
        ]);

        return $this->context->smarty->fetch(
            _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/custom_btn.tpl'
        );
    }

    public static function setOrderCurrency($echo, $tr)
    {
        if (!empty($tr['id_currency'])) {
            $idCurrency = (int) $tr['id_currency'];
        } else {
            $order = new Order($tr['id_order']);
            $idCurrency = (int) $order->id_currency;
        }

        return WkProductSubscription::displayPrice($echo, $idCurrency);
    }

    public function getCustomerDetails($email, $rowData)
    {
        $context = Context::getContext();
        $customerId = (int) $rowData['id_customer'];
        $customer_link = $context->link->getAdminLink(
            'AdminCustomers',
            true,
            ['viewcustomer' => 1, 'id_customer' => (int) $customerId],
            ['viewcustomer' => 1, 'id_customer' => (int) $customerId]
        );

        $context->smarty->assign([
            'displayEmail' => $email,
            'customer_link' => $customer_link,
        ]);

        return $context->smarty->fetch(
            _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/customerEmailLink.tpl'
        );
    }
}
