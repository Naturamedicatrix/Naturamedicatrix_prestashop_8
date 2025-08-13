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

class AdminScheduledOrdersController extends ModuleAdminController
{
    public function __construct()
    {
        $this->className = 'WkSubscriberScheduleModel';
        $this->table = 'wk_subscription_schedule';
        $this->identifier = 'id_wk_subscription_schedule';
        $this->bootstrap = true;
        $this->list_no_link = true;
        $this->lang = false;
        parent::__construct();
        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );
        $this->_select = 'wk_subscription_schedule_shop.*, CONCAT(c.firstname, \' \', c.lastname) as name, c.email, c.id_customer,
        ssp.unit_price, ssp.quantity, ssp.total_amount, ssp.id_currency, pl.name as product_name';
        $this->_join = Shop::addSqlAssociation('wk_subscription_schedule', 'a', false);
        $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'wk_subscription_subscriber_products AS ssp
        ON ssp.id_wk_subscription_subscriber_products = a.id_subscription
        INNER JOIN ' . _DB_PREFIX_ . 'wk_subscription_subscribers AS s
        ON s.id_wk_subscription_subscribers = ssp.id_subscriber
        INNER JOIN ' . _DB_PREFIX_ . 'customer c ON (c.id_customer = s.id_customer)
        INNER JOIN ' . _DB_PREFIX_ . 'product_lang pl
        ON (pl.id_product = ssp.id_product AND pl.id_shop = ' . (int) Context::getContext()->shop->id . ')';
        $this->_where = 'AND pl.id_lang = ' . (int) Context::getContext()->language->id . ' AND a.is_order_created = 0 AND wk_subscription_schedule_shop.`id_shop` = ' . (int) Context::getContext()->shop->id;
        $this->_group = 'GROUP BY a.id_wk_subscription_schedule';

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->_select .= ', shp.`name` as wk_ps_shop_name';
            $this->_join .= ' JOIN `' . _DB_PREFIX_ . 'shop` shp
            ON (shp.`id_shop` = wk_subscription_schedule_shop.`id_shop`)';
        }

        $this->toolbar_title = $this->module->l('Scheduled orders', get_class());

        // Table Definition
        $this->fields_list = [
            'id_wk_subscription_schedule' => [
                'title' => $this->module->l('ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
            ],
            'id_subscription' => [
                'title' => $this->module->l('Subscription ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'filter_key' => 'a!id_subscription',
                'class' => 'fixed-width-xs',
            ],
            'name' => [
                'title' => $this->module->l('Name', get_class()),
                'align' => 'left',
                'havingFilter' => true,
            ],
            'email' => [
                'title' => $this->module->l('Email', get_class()),
                'align' => 'left',
                'havingFilter' => true,
                'callback' => 'getCustomerDetails',
            ],
            'product_name' => [
                'title' => $this->module->l('Product', get_class()),
                'align' => 'center',
                'havingFilter' => true,
            ],
            'unit_price' => [
                'title' => $this->module->l('Product price', get_class()),
                'hint' => $this->module->l('Tax Inc.', get_class()),
                'align' => 'center',
                'filter_key' => 'ssp!unit_price',
                'badge_success' => true,
                'callback' => 'displayFormattedPrice',
                'havingFilter' => true,
            ],
            'quantity' => [
                'title' => $this->module->l('Quantities', get_class()),
                'align' => 'center',
                'havingFilter' => true,
            ],
            'total_amount' => [
                'title' => $this->module->l('Total amount', get_class()),
                'align' => 'center',
                'filter_key' => 'ssp!total_amount',
                'hint' => $this->module->l('Tax Inc.', get_class()),
                'havingFilter' => true,
                'callback' => 'displayFormattedPrice',
            ],
            'order_date' => [
                'title' => $this->module->l('Order date', get_class()),
                'align' => 'center',
                'type' => 'date',
                'filter_key' => 'a!order_date',
            ],
            'delivery_date' => [
                'title' => $this->module->l('Delivery date', get_class()),
                'align' => 'center',
                'type' => 'date',
                'filter_key' => 'a!delivery_date',
            ],
            'active' => [
                'title' => $this->module->l('Status', get_class()),
                'align' => 'center',
                'type' => 'bool',
                'class' => 'fixed-width-xs',
                'filter_key' => 'a!active',
                'orderBy' => false,
                'active' => 'status',
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
        $this->addRowAction('subscriptionInfo');

        return parent::renderList();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function displaysubscriptionInfoLink($token, $id_schedule)
    {
        $subsData = WkProductSubscriptionGlobal::getSubscriptionByScheduleId((int) $id_schedule);
        $idSubscription = (int) $subsData['id_subscription'];
        $link = $this->context->link->getAdminLink(
            'AdminCustomerSubscription',
            $token,
            [],
            ['id_wk_subscription_subscriber_products' => $idSubscription, 'viewwk_subscription_subscriber_products' => 1]
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

    public function displayFormattedPrice($price, $rowData)
    {
        $id_currency = (int) $rowData['id_currency'];

        return WkProductSubscription::displayPrice(
            Tools::convertPriceFull(
                $price,
                new Currency((int) $id_currency),
                new Currency((int) Context::getContext()->currency->id)
            )
        );
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
