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

class AdminSubscribersController extends ModuleAdminController
{
    public function __construct()
    {
        $this->className = 'WkSubscriberModal';
        $this->table = 'wk_subscription_subscribers';
        $this->identifier = 'id_wk_subscription_subscribers';
        $this->bootstrap = true;
        $this->list_no_link = true;
        $this->lang = false;
        parent::__construct();

        $this->_select = 'CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `customer`,
        c.email, c.id_customer,
        a.id_wk_subscription_subscribers as subscribed_product, a.id_wk_subscription_subscribers as subscribed_items,
        a.id_wk_subscription_subscribers as subscribed_amount, a.id_wk_subscription_subscribers as badge_success';
        $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'customer c
        ON c.id_customer = a.id_customer';
        $this->_where = Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'a');
        $this->_group = 'GROUP BY c.id_customer';
        $this->_orderBy = 'a.id_wk_subscription_subscribers';
        $this->_orderWay = 'DESC';

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->_select .= ', shp.`name` as wk_ps_shop_name';
            $this->_join .= ' JOIN `' . _DB_PREFIX_ . 'shop` shp
            ON (shp.`id_shop` = a.`id_shop`)';
        }

        $this->toolbar_title = $this->module->l('Subscribers', get_class());

        // Table Definition
        $this->fields_list = [
            'id_wk_subscription_subscribers' => [
                'title' => $this->module->l('ID', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'class' => 'fixed-width-xs',
            ],
            'customer' => [
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
            'subscribed_product' => [
                'title' => $this->module->l('Products', get_class()),
                'hint' => $this->module->l('No. of products subscribed by this subscriber', get_class()),
                'align' => 'center',
                'type' => 'int',
                'search' => false,
                'callback' => 'displaySubscriberProductCount',
            ],
            'subscribed_items' => [
                'title' => $this->module->l('Quantities', get_class()),
                'hint' => $this->module->l('No. of product quantities subscribed by this subscriber', get_class()),
                'align' => 'center',
                'type' => 'int',
                'search' => false,
                'callback' => 'displaySubscriberProductQtyCount',
            ],
            'subscribed_amount' => [
                'title' => $this->module->l('Total amount', get_class()),
                'hint' => $this->module->l('Total active subscription amount', get_class()),
                'align' => 'center',
                'havingFilter' => true,
                'type' => 'price',
                'search' => false,
                'badge_success' => true,
                'callback' => 'displaySubscriberProductAmt',
            ],
            'date_add' => [
                'title' => $this->module->l('Date', get_class()),
                'align' => 'center',
                'type' => 'date',
                'filter_key' => 'a!date_add',
            ],
            'active' => [
                'title' => $this->module->l('Status', get_class()),
                'align' => 'center',
                'type' => 'bool',
                'class' => 'fixed-width-xs',
                'filter_key' => 'a!active',
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
        $this->_conf[50] = $this->module->l('There is no subscription product of this user', get_class());
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
                'href' => Context::getContext()->link->getAdminLink('AdminSubscribers', true),
                'desc' => $this->module->l('Back to list', get_class()),
                'icon' => 'process-icon-back',
            ];
        }
        parent::initPageHeaderToolbar();
    }

    public function renderView()
    {
        $subObj = new WkProductSubscriptionGlobal();
        $id_subscriber = (int) Tools::getValue('id_wk_subscription_subscribers');
        $id_customer = (int) WkProductSubscriptionGlobal::getCustomerID($id_subscriber);
        $subscriptions = $subObj->getSubscriberSubscriptionData($id_subscriber, false);
        if (Shop::isFeatureActive() && (Shop::getContext() != Shop::CONTEXT_SHOP)) {
            return $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/_partials/shop_warning.tpl'
            );
        }
        $dailyString = $this->module->l('Every %d day', get_class());
        $everyDayString = $this->module->l('Everyday', get_class());
        $weeklyString = $this->module->l('Every %d week', get_class());
        $everyWeekString = $this->module->l('Every week', get_class());
        $monthlyString = $this->module->l('Every %d month', get_class());
        $everyMonthString = $this->module->l('Every month', get_class());
        $yearlyString = $this->module->l('Every %d year', get_class());
        $everyYearString = $this->module->l('Every year', get_class());

        $compatible_payment_gateway = ['wkstripepayment', 'wkpaypalsubscription', 'wkwepay', 'psadyenpayment'];
        if ($subscriptions) {
            foreach ($subscriptions as $k => $subs) {
                if ($subs['frequency'] == 'daily') {
                    if ($subs['cycle'] == 1) {
                        $subscriptions[$k]['frequency_label'] = $everyDayString;
                    } else {
                        $subscriptions[$k]['frequency_label'] = sprintf(
                            $dailyString,
                            $subs['cycle']
                        );
                    }
                } elseif ($subs['frequency'] == 'weekly') {
                    if ($subs['cycle'] == 1) {
                        $subscriptions[$k]['frequency_label'] = $everyWeekString;
                    } else {
                        $subscriptions[$k]['frequency_label'] = sprintf(
                            $weeklyString,
                            $subs['cycle']
                        );
                    }
                } elseif ($subs['frequency'] == 'monthly') {
                    if ($subs['cycle'] == 1) {
                        $subscriptions[$k]['frequency_label'] = $everyMonthString;
                    } else {
                        $subscriptions[$k]['frequency_label'] = sprintf(
                            $monthlyString,
                            $subs['cycle']
                        );
                    }
                } elseif ($subs['frequency'] == 'yearly') {
                    if ($subs['cycle'] == 1) {
                        $subscriptions[$k]['frequency_label'] = $everyYearString;
                    } else {
                        $subscriptions[$k]['frequency_label'] = sprintf(
                            $yearlyString,
                            $subs['cycle']
                        );
                    }
                }
                $subscriptions[$k]['subscription_link'] = $this->context->link->getAdminLink(
                    'AdminCustomerSubscription',
                    true,
                    [],
                    ['id_wk_subscription_subscriber_products' => $subs['id_subscription'], 'viewwk_subscription_subscriber_products' => 1]
                );
                $subscriptions[$k]['auto_renew_date'] = date('Y-m-d', strtotime($subs['pause_up_to'] . ' + 1 days'));
                $subscriptions[$k]['show_pause'] = false;
                $subscriptions[$k]['show_resume'] = false;
                if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subs['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_PAUSE) && Configuration::get('WK_SUBSCRIPTION_CAN_PAUSE')) {
                    $subscriptions[$k]['show_pause'] = true;
                }
                if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subs['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_RESUME) && Configuration::get('WK_SUBSCRIPTION_CAN_RESUME')) {
                    $subscriptions[$k]['show_resume'] = true;
                }
                $subscriptions[$k]['wkShowSubsciptionPaymentID'] = false;
                $subscriptions[$k]['paymentsubData'] = [];

                $is_exist = array_search($subs['payment_module'], $compatible_payment_gateway);

                if ($is_exist !== false) {
                    $subscriptions[$k]['wkShowSubsciptionPaymentID'] = true;
                    $paymentResponse = json_decode($subs['payment_response'], true);

                    if ($subs['payment_module'] == 'wkstripepayment') {
                        $subscriptions[$k]['paymentsubData']['id'] = isset($paymentResponse['stripe_subscription_id']) ? $paymentResponse['stripe_subscription_id'] : '';
                    }

                    if ($subs['payment_module'] == 'wkpaypalsubscription') {
                        $subscriptions[$k]['paymentsubData']['id'] = isset($paymentResponse['id_subscription']) ? $paymentResponse['id_subscription'] : '';
                    }

                    if ($subs['payment_module'] == 'wkwepay') {
                        $subscriptions[$k]['paymentsubData']['id'] = isset($paymentResponse['id']) ? $paymentResponse['id'] : '';
                    }

                    if ($subs['payment_module'] == 'psadyenpayment') {
                        $subscriptions[$k]['paymentsubData']['id'] = isset($paymentResponse['id_adyen_plan']) ? $paymentResponse['id_adyen_plan'] : '';
                    }
                }
            }

            $deliveries = $subObj->getUpcomingDeliveryDetails($id_subscriber);
            $delivered = $subObj->getSubscriberDeliveredOrders($id_subscriber);
            $customer = new Customer($id_customer);
            $customer->date_add = date('Y-m-d', strtotime($customer->date_add));
            $summaryData = [
                'next_delivery' => isset($deliveries[0]['upcoming_delivery']) ? $deliveries[0]['upcoming_delivery'] : '',
                'total_subscription_amount' => $this->displaySubscriberProductAmt($id_subscriber),
                'total_subscribed_products' => $this->displaySubscriberProductCount($id_subscriber),
                'deliveries' => count($delivered),
            ];
            $this->tpl_view_vars = [
                'subscriptions' => $subscriptions,
                'subscriptionCount' => count($subscriptions),
                'customerData' => $customer,
                'summaryData' => $summaryData,
                'delivered' => $delivered,
                'customerLink' => $this->context->link->getAdminLink(
                    'AdminCustomers',
                    true,
                    ['id_customer' => $id_customer, 'viewcustomer' => 1]
                ),
            ];
            $this->base_tpl_view = 'view.tpl';

            return parent::renderView();
        } else {
            Tools::redirectAdmin(self::$currentIndex . '&token=' . $this->token . '&conf=50');
        }

        return parent::renderView();
    }

    public function postProcess()
    {
        $urlString = '&viewwk_subscription_subscribers=&id_wk_subscription_subscribers=' .
        (int) Tools::getValue('id_wk_subscription_subscribers');

        if (Tools::getValue('updateSubscription')
            // && Tools::getValue('token') == Tools::getAdminTokenLite('AdminSubscribers')
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

        if (Tools::getValue('cancelSubscription')
            // && Tools::getValue('token') == Tools::getAdminTokenLite('AdminSubscribers')
        ) {
            $status = false;
            $id_subscription = (int) Tools::getValue('id_subscription');
            $subObj = new WkSubscriberProductModal($id_subscription);
            $globalObj = new WkProductSubscriptionGlobal();
            if ($subObj->payment_module == 'wkstripepayment'
                && WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $paymentData = json_decode($subsData['payment_response'], true);
                $stripeObj = new WkSubscriptionStripe();
                $status = $stripeObj->cancelStripeSubscription(
                    (int) $subsData['id_customer'],
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
            // && Tools::getValue('token') == Tools::getAdminTokenLite('AdminSubscribers')
        ) {
            $status = false;
            $pauseDate = Tools::getValue('pause_no_of_days');
            if (empty($pauseDate)) {
                $this->errors[] = $this->module->l('Pause up to date is required', 'subscriptiondetails', get_class());
            }
            $datediff = strtotime($pauseDate) - strtotime(date('Y-m-d'));
            $noOfDays = round($datediff / (60 * 60 * 24));
            // $noOfDays += 1; // add 1 because not consider today
            $id_subscription = (int) Tools::getValue('id_subscription');
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
            // && Tools::getValue('token') == Tools::getAdminTokenLite('AdminSubscribers')
        ) {
            $status = false;
            $id_subscription = (int) Tools::getValue('id_subscription');
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
            // && Tools::getValue('token') == Tools::getAdminTokenLite('AdminSubscribers')
            && Tools::getValue('id_wk_subscription_subscribers')
        ) {
            $id_subscription = (int) Tools::getValue('id_subscription');
            $subObj = new WkSubscriberProductModal($id_subscription);
            $subObj->deleted = 1;
            $subObj->active = 0;
            if ($subObj->save()) {
                Tools::redirectAdmin(self::$currentIndex . $urlString . '&conf=4&token=' . $this->token);
            }
        }
        parent::postProcess();
    }

    /**
     * Get the number of products subscribed the subscriber
     *
     * @param mixed $id_subscriber Subscriber ID
     *
     * @return int
     */
    public function displaySubscriberProductCount($id_subscriber)
    {
        $count = WkProductSubscriptionGlobal::getSubscriberProductCount((int) $id_subscriber);

        return $count;
    }

    /**
     * Get the number of product quantities subscribed the subscriber
     *
     * @param mixed $id_subscriber Subscriber ID
     *
     * @return int
     */
    public function displaySubscriberProductQtyCount($id_subscriber)
    {
        $count = WkProductSubscriptionGlobal::getSubscriberProductQtyCount((int) $id_subscriber);

        return $count;
    }

    /**
     * Get the total subscription amount of the subscriber
     *
     * @param mixed $id_subscriber Subscriber ID
     *
     * @return int
     */
    public function displaySubscriberProductAmt($id_subscriber)
    {
        $amt = WkProductSubscriptionGlobal::getSubscriberProductTotalAmount((int) $id_subscriber);
        $formatedAmt = WkProductSubscription::displayPrice(
            $amt,
            (int) Configuration::get('PS_CURRENCY_DEFAULT')
        );

        return $formatedAmt;
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        Media::addJsDef([
            'confirmMsg' => $this->module->l('Are you sure?', get_class()),
            'no_of_days_msg' => $this->module->l('Please enter no. of days', get_class()),
            'no_of_days_valid_msg' => $this->module->l('Please enter valid no. of days', get_class()),
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

    protected function processBulkStatusSelection($status)
    {
        $subscribers = Tools::getValue($this->table . 'Box');
        if (is_array($subscribers) && ($count = count($subscribers))) {
            foreach ($subscribers as $id_subscriber) {
                $objWkSubscriberModal = new WkSubscriberModal($id_subscriber);
                if (!Validate::isLoadedObject($objWkSubscriberModal)) {
                    $this->errors[] = Tools::displayError($this->module->l('Subscriber [#', get_class()) . (int) $id_subscriber . $this->module->l('] object not found.', get_class()));
                }
            }
        }

        return parent::processBulkStatusSelection($status);
    }
}
