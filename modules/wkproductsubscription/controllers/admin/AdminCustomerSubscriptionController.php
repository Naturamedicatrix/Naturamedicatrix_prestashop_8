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

class AdminCustomerSubscriptionController extends ModuleAdminController
{
    public function __construct()
    {
        $this->className = 'WkSubscriberProductModal';
        $this->table = 'wk_subscription_subscriber_products';
        $this->identifier = 'id_wk_subscription_subscriber_products';
        $this->bootstrap = true;
        $this->list_no_link = true;
        $this->lang = false;
        parent::__construct();

        $this->_select = 'a.*,
        CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `customer`,
        c.email, c.company, c.id_customer';
        $this->_join .= 'INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscribers` sb
        ON sb.`id_wk_subscription_subscribers` = a.`id_subscriber`
        INNER JOIN `' . _DB_PREFIX_ . 'customer` c
        ON c.`id_customer` = sb.`id_customer`';
        $this->_where .= ' AND a.deleted = 0 ' . Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a');
        $this->_group = 'GROUP BY a.id_wk_subscription_subscriber_products';
        $this->_orderBy = 'a.id_wk_subscription_subscriber_products';
        $this->_orderWay = 'DESC';

        if (Shop::isFeatureActive()) {
            // In case of All Shops
            $this->_select .= ', shp.`name` as wk_ps_shop_name';
            $this->_join .= ' JOIN `' . _DB_PREFIX_ . 'shop` shp
            ON (shp.`id_shop` = a.`id_shop`)';
        }

        $this->toolbar_title = $this->module->l('Subscription by customers', get_class());

        // Table Definition
        $this->fields_list = [
            'id_wk_subscription_subscriber_products' => [
                'title' => $this->module->l('Subscription ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
            ],
            'customer' => [
                'title' => $this->module->l('Customer name', get_class()),
                'align' => 'left',
                'havingFilter' => true,
            ],
            'email' => [
                'title' => $this->module->l('Email', get_class()),
                'align' => 'left',
                'havingFilter' => true,
                'callback' => 'getCustomerDetails',
            ],
            'first_delivery_date' => [
                'title' => $this->module->l('First delivery', get_class()),
                'align' => 'center',
                'type' => 'date',
                'callback' => 'getDateFormat',
                'filter_key' => 'a!first_delivery_date',
            ],
            'frequency' => [
                'title' => $this->module->l('Frequency', get_class()),
                'align' => 'left',
                'search' => false,
                'callback' => 'getSubscriptionFrequency',
                'filter_key' => 'a!frequency',
            ],
            'date_add' => [
                'title' => $this->module->l('Subscription date', get_class()),
                'align' => 'center',
                'type' => 'date',
                'filter_key' => 'a!date_add',
                'callback' => 'getDateFormat',
            ],
            'active' => [
                'title' => $this->module->l('Active', get_class()),
                'align' => 'center',
                'type' => 'bool',
                'class' => 'fixed-width-xs',
                'orderBy' => false,
                'filter_key' => 'a!active',
                'callback' => 'getActiveStatus',
                // 'active' => 'status'
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
        if (Shop::isFeatureActive() && (Shop::getContext() != Shop::CONTEXT_ALL)) {
            $this->addRowAction('view');
        } elseif (!Shop::isFeatureActive()) {
            $this->addRowAction('view');
        }

        return parent::renderList();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function initPageHeaderToolbar()
    {
        if ($this->display == 'edit' || $this->display == 'add' || $this->display == 'view') {
            $this->page_header_toolbar_btn['back_to_list'] = [
                'href' => Context::getContext()->link->getAdminLink('AdminCustomerSubscription', true),
                'desc' => $this->module->l('Back to list', get_class()),
                'icon' => 'process-icon-back',
            ];
        }
        parent::initPageHeaderToolbar();
    }

    public function renderView()
    {
        $subObj = new WkProductSubscriptionGlobal();
        $id_subscription = (int) Tools::getValue('id_wk_subscription_subscriber_products');
        $subscriptions = $subObj->getSubscriptionDetails($id_subscription);
        $dailyString = $this->module->l('Every %d day', get_class());
        $everyDayString = $this->module->l('Everyday', get_class());
        $weeklyString = $this->module->l('Every %d week', get_class());
        $everyWeekString = $this->module->l('Every week', get_class());
        $monthlyString = $this->module->l('Every %d month', get_class());
        $everyMonthString = $this->module->l('Every month', get_class());
        $yearlyString = $this->module->l('Every %d year', get_class());
        $everyYearString = $this->module->l('Every year', get_class());

        if ($subscriptions) {
            $group = Shop::getGroupFromShop(Shop::getContextShopID(), false);
            if (Shop::isFeatureActive() && (Shop::getContext() != Shop::CONTEXT_SHOP)) {
                return $this->context->smarty->fetch(
                    _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/_partials/shop_warning.tpl'
                );
            } elseif (Shop::isFeatureActive()
                && ($subscriptions['id_shop'] != (int) $this->context->shop->id)
                && !$group['share_order']
            ) {
                $this->context->smarty->assign('shop_entity_error', true);

                return $this->context->smarty->fetch(
                    _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/_partials/shop_warning.tpl'
                );
            }

            if ($subscriptions['frequency'] == 'daily') {
                if ($subscriptions['cycle'] == 1) {
                    $subscriptions['frequency_label'] = $everyDayString;
                } else {
                    $subscriptions['frequency_label'] = sprintf(
                        $dailyString,
                        $subscriptions['cycle']
                    );
                }
            } elseif ($subscriptions['frequency'] == 'weekly') {
                if ($subscriptions['cycle'] == 1) {
                    $subscriptions['frequency_label'] = $everyWeekString;
                } else {
                    $subscriptions['frequency_label'] = sprintf(
                        $weeklyString,
                        $subscriptions['cycle']
                    );
                }
            } elseif ($subscriptions['frequency'] == 'monthly') {
                if ($subscriptions['cycle'] == 1) {
                    $subscriptions['frequency_label'] = $everyMonthString;
                } else {
                    $subscriptions['frequency_label'] = sprintf(
                        $monthlyString,
                        $subscriptions['cycle']
                    );
                }
            } elseif ($subscriptions['frequency'] == 'yearly') {
                if ($subscriptions['cycle'] == 1) {
                    $subscriptions['frequency_label'] = $everyYearString;
                } else {
                    $subscriptions['frequency_label'] = sprintf(
                        $yearlyString,
                        $subscriptions['cycle']
                    );
                }
            }

            $deliveries = $subObj->getUpcomingSubscriptionDeliveryDetails($id_subscription);
            $delivered = $subObj->getSubscriptionDeliveredOrders($id_subscription);
            $id_customer = (int) WkProductSubscriptionGlobal::getCustomerID($subscriptions['id_subscriber']);
            $customer = new Customer((int) $id_customer);
            $customer->date_add = date('Y-m-d', strtotime($customer->date_add));
            $subscriptions['auto_renew_date'] = date('Y-m-d', strtotime($subscriptions['pause_up_to'] . ' + 1 days'));
            $showPause = false;
            $showResume = false;
            // check is_virtual condition because virtual product can not pause
            if (!$subscriptions['is_virtual'] && WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subscriptions['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_PAUSE) && Configuration::get('WK_SUBSCRIPTION_CAN_PAUSE')) {
                $showPause = true;
            }
            if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subscriptions['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_RESUME) && Configuration::get('WK_SUBSCRIPTION_CAN_RESUME')) {
                $showResume = true;
            }
            $this->tpl_view_vars = [
                'subscriptions' => $subscriptions,
                'customerData' => $customer,
                'deliveries' => $deliveries,
                'delivered' => $delivered,
                'customerLink' => $this->context->link->getAdminLink(
                    'AdminCustomers',
                    true,
                    ['id_customer' => $id_customer, 'viewcustomer' => 1]
                ),
                'show_pause' => $showPause,
                'show_resume' => $showResume,
            ];
            $this->base_tpl_view = 'view.tpl';

            return parent::renderView();
        } else {
            Tools::redirectAdmin(self::$currentIndex . '&token=' . $this->token);
        }

        return parent::renderView();
    }

    public function postProcess()
    {
        $idSubscription = Tools::getValue('id_wk_subscription_subscriber_products');
        $urlString = '&viewwk_subscription_subscriber_products=&id_wk_subscription_subscriber_products=' .
        (int) $idSubscription;

        if (Tools::getValue('updateSubscription')
            && Tools::getValue('token') == Tools::getAdminTokenLite('AdminCustomerSubscription')
        ) {
            if (Tools::getValue('form')) {
                $formData = Tools::getValue('form');
                foreach ($formData as $key => $value) {
                    $id_subscription = (int) $key;
                    $wk_subs_quantity = (int) $value['wk_subs_quantity'];
                    $subObj = new WkSubscriberProductModal($id_subscription);
                    $subObj->quantity = $wk_subs_quantity;
                    $total_amt = Tools::ps_round(
                        $wk_subs_quantity * $subObj->unit_price,
                        2
                    );
                    $subObj->total_amount = $total_amt;
                    if ($subObj->save()) {
                        Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
                    }
                }
            }
        }

        if (Tools::isSubmit('cancelSubscription')
        && Tools::getValue('token') == Tools::getAdminTokenLite('AdminCustomerSubscription')
        ) {
            $status = false;
            $id_subscription = (int) Tools::getValue('id_wk_subscription_subscriber_products');
            $subObj = new WkSubscriberProductModal($id_subscription);
            $globalObj = new WkProductSubscriptionGlobal();
            if ($subObj->payment_module == 'wkstripepayment'
                && WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $paymentData = json_decode($subsData['payment_response'], true);
                $stripeObj = new WkSubscriptionStripe();
                $status = $stripeObj->cancelStripeSubscription(
                    $subsData['id_customer'],
                    $paymentData['stripe_subscription_id']
                );
            } elseif ($subObj->payment_module == 'psadyenpayment'
                && WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $adyenObj = new WkSubscriptionAdyen();
                $status = $adyenObj->cancelAdyenSubscription(
                    $subsData['id_customer'],
                    $subsData
                );
            } elseif ($subObj->payment_module == 'wkwepay'
                && WkProductSubscriptionGlobal::isWkWepayRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $paymentData = json_decode($subsData['payment_response'], true);
                $wepayObj = new WkSubscriptionWepay();
                $status = $wepayObj->cancelWepaySubscription(
                    (int) $subsData['id_customer'],
                    $paymentData['id']
                );
            } elseif ($subObj->payment_module == 'wkpaypalsubscription'
                && WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $payPalSubsId = $subsData['payment_response'];
                $objPayPal = new WkSubscriptionPayPal();
                $status = $objPayPal->cancelSubscription(
                    $payPalSubsId,
                    $subsData['first_order_id']
                );
            } else {
                $status = true;
            }

            if ($status) {
                $subObj->active = 0;
            }

            if ($subObj->save() && $status) {
                $globalObj->sendSubscriptionCancelByAdminMail($id_subscription);
                Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
            }
        }

        if (Tools::isSubmit('pauseSubscription')
        && Tools::getValue('token') == Tools::getAdminTokenLite('AdminCustomerSubscription')
        ) {
            $status = false;
            $pauseDate = Tools::getValue('pause_no_of_days');
            if (empty($pauseDate)) {
                $this->errors[] = $this->module->l('Pause up to date is required', get_class());
            }
            $datediff = strtotime($pauseDate) - strtotime(date('Y-m-d'));
            $noOfDays = round($datediff / (60 * 60 * 24));
            // $noOfDays += 1; // add 1 because not consider today
            $id_subscription = (int) Tools::getValue('id_wk_subscription_subscriber_products');
            if (empty($this->errors)) {
                $globalObj = new WkProductSubscriptionGlobal();
                $data = $globalObj->pauseSupscription($id_subscription, $noOfDays);
                if (!$data['status']) {
                    $this->errors[] = $data['msg'];
                } else {
                    $status = true;
                    Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
                }
            }
        }

        if (Tools::isSubmit('resumeSubscription')
        && Tools::getValue('token') == Tools::getAdminTokenLite('AdminCustomerSubscription')
        ) {
            $status = false;
            $id_subscription = (int) Tools::getValue('id_wk_subscription_subscriber_products');
            $globalObj = new WkProductSubscriptionGlobal();
            $data = $globalObj->resumeSupscription($id_subscription);
            if (!$data['status']) {
                $this->errors[] = $data['msg'];
            } else {
                $status = true;
            }
            if ($status) {
                Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
            }
        }

        if (Tools::isSubmit('deleteSubscription')
            && Tools::getValue('token') == Tools::getAdminTokenLite('AdminCustomerSubscription')
            && Tools::getValue('id_wk_subscription_subscriber_products')
        ) {
            $id_subscription = (int) Tools::getValue('id_wk_subscription_subscriber_products');
            $subObj = new WkSubscriberProductModal($id_subscription);
            $subObj->deleted = 1;
            $subObj->active = 0;
            if ($subObj->save()) {
                Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
            }
        }

        parent::postProcess();
    }

    public function getActiveStatus($active)
    {
        if ($active == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
            return $this->module->l('Yes', get_class());
        }

        return $this->module->l('No', get_class());
    }

    public function getDateFormat($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    public function getSubscriptionFrequency($frequency, $listData)
    {
        $dailyString = $this->module->l('Every %d day', get_class());
        $everyDayString = $this->module->l('Everyday', get_class());
        $weeklyString = $this->module->l('Every %d week', get_class());
        $everyWeekString = $this->module->l('Every week', get_class());
        $monthlyString = $this->module->l('Every %d month', get_class());
        $everyMonthString = $this->module->l('Every month', get_class());
        $yearlyString = $this->module->l('Every %d year', get_class());
        $everyYearString = $this->module->l('Every year', get_class());

        $cycle = $listData['cycle'];

        if ($frequency == 'daily') {
            if ($listData['cycle'] == 1) {
                return $everyDayString;
            } else {
                return sprintf($dailyString, $cycle);
            }
        } elseif ($frequency == 'weekly') {
            if ($listData['cycle'] == 1) {
                return $everyWeekString;
            } else {
                return sprintf($weeklyString, $cycle);
            }
        } elseif ($frequency == 'monthly') {
            if ($listData['cycle'] == 1) {
                return $everyMonthString;
            } else {
                return sprintf($monthlyString, $cycle);
            }
        } elseif ($frequency == 'yearly') {
            if ($listData['cycle'] == 1) {
                return $everyYearString;
            } else {
                return sprintf($yearlyString, $cycle);
            }
        }
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        Media::addJsDef([
            'confirmMsg' => $this->module->l('Are you sure?', get_class()),
            'no_of_days_msg' => $this->module->l('Please select date', get_class()),
        ]);

        $this->addCSS(
            _PS_MODULE_DIR_ . 'wkproductsubscription/views/css/wkproductsubscription_back.css'
        );
        $this->addJS(
            _PS_MODULE_DIR_ . 'wkproductsubscription/views/js/wkproductsubscription_back.js'
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
