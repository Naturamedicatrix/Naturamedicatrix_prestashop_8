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

class WkProductSubscriptionSubscriptionDetailsModuleFrontController extends ModuleFrontController
{
    /**
     * Force user to login
     */
    public $auth = true;
    public $guestAllowed = false;

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        if (!Tools::getValue('id_subscription')) {
            Tools::redirect(
                $this->context->link->getModuleLink(
                    'wkproductsubscription',
                    'mysubscription'
                )
            );
        }
    }

    /**
     * initContent
     *
     * @return void
     */
    public function initContent()
    {
        parent::initContent();
        if (Tools::getValue('id_subscription')
            && Validate::isInt(Tools::getValue('id_subscription'))
        ) {
            $idSubscription = (int) Tools::getValue('id_subscription');
            $subObj = new WkProductSubscriptionGlobal();
            $subsDetails = $subObj->getSubscriptionDetails($idSubscription, $this->context->customer->id);
            if ($subsDetails) {
                $dailyString = $this->module->l('Every %d day', 'subscriptiondetails');
                $everyDayString = $this->module->l('Everyday', 'subscriptiondetails');
                $weeklyString = $this->module->l('Every %d week', 'subscriptiondetails');
                $everyWeekString = $this->module->l('Every week', 'subscriptiondetails');
                $monthlyString = $this->module->l('Every %d month', 'subscriptiondetails');
                $everyMonthString = $this->module->l('Every month', 'subscriptiondetails');
                $yearlyString = $this->module->l('Every %d year', 'subscriptiondetails');
                $everyYearString = $this->module->l('Every year', 'subscriptiondetails');
                $subsDetails['auto_renew_date'] = date('Y-m-d', strtotime($subsDetails['pause_up_to'] . ' + 1 days'));
                if ($subsDetails['frequency'] == 'daily') {
                    if ($subsDetails['cycle'] == 1) {
                        $subsDetails['frequency_label'] = $everyDayString;
                    } else {
                        $subsDetails['frequency_label'] = sprintf(
                            $dailyString,
                            $subsDetails['cycle']
                        );
                    }
                } elseif ($subsDetails['frequency'] == 'weekly') {
                    if ($subsDetails['cycle'] == 1) {
                        $subsDetails['frequency_label'] = $everyWeekString;
                    } else {
                        $subsDetails['frequency_label'] = sprintf(
                            $weeklyString,
                            $subsDetails['cycle']
                        );
                    }
                } elseif ($subsDetails['frequency'] == 'monthly') {
                    if ($subsDetails['cycle'] == 1) {
                        $subsDetails['frequency_label'] = $everyMonthString;
                    } else {
                        $subsDetails['frequency_label'] = sprintf(
                            $monthlyString,
                            $subsDetails['cycle']
                        );
                    }
                } elseif ($subsDetails['frequency'] == 'yearly') {
                    if ($subsDetails['cycle'] == 1) {
                        $subsDetails['frequency_label'] = $everyYearString;
                    } else {
                        $subsDetails['frequency_label'] = sprintf(
                            $yearlyString,
                            $subsDetails['cycle']
                        );
                    }
                }

                $subsDetails['deliveries'] = $subObj->getSubscriptionDeliveredOrders($idSubscription);
            } else {
                Tools::redirect(
                    $this->context->link->getModuleLink(
                        'wkproductsubscription',
                        'mysubscription'
                    )
                );
            }
            $showPause = false;
            $showResume = false;
            $updateFrequency = false;
            $canUpdate = false;
            // check is_virtual condition because virtual product can not pause
            if (!$subsDetails['is_virtual'] && WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subsDetails['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_PAUSE) && Configuration::get('WK_SUBSCRIPTION_CAN_PAUSE')) {
                $showPause = true;
            }
            if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subsDetails['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_RESUME) && Configuration::get('WK_SUBSCRIPTION_CAN_RESUME')) {
                $showResume = true;
            }
            if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subsDetails['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE_FREQUENCY) && $subsDetails['active'] == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE && Configuration::get('WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE')) {
                $idProduct = $subsDetails['id_product'];
                $idProductAttribute = $subsDetails['id_product_attribute'];
                $idSubsProduct = WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct, $idProductAttribute);
                if ($idSubsProduct) {
                    $updateFrequency = true;
                    $productSubsObj = new WkProductSubscriptionModel((int) $idSubsProduct);
                    $frequencyData['daily'] = 0;
                    $frequencyData['weekly'] = 0;
                    $frequencyData['monthly'] = 0;
                    $frequencyData['yearly'] = 0;
                    if ($productSubsObj->daily_frequency) {
                        $frequencyData['daily'] = 1;
                        Media::addJsDef([
                            'daily_cycles' => $productSubsObj->daily_cycles,
                        ]);
                    }
                    if ($productSubsObj->weekly_frequency) {
                        $frequencyData['weekly'] = 1;
                        Media::addJsDef([
                            'weekly_cycles' => $productSubsObj->weekly_cycles,
                        ]);
                    }
                    if ($productSubsObj->monthly_frequency) {
                        $frequencyData['monthly'] = 1;
                        Media::addJsDef([
                            'monthly_cycles' => $productSubsObj->monthly_cycles,
                        ]);
                    }
                    if ($productSubsObj->yearly_frequency) {
                        $frequencyData['yearly'] = 1;
                        Media::addJsDef([
                            'yearly_cycles' => $productSubsObj->yearly_cycles,
                        ]);
                    }
                    $this->context->smarty->assign([
                        'frequencyData' => $frequencyData,
                    ]);
                }
            }
            if (WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($subsDetails['payment_module'], WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE) && $subsDetails['active'] == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE && Configuration::get('WK_SUBSCRIPTION_CAN_UPDATE') && $subsDetails['allow_actions']) {
                $canUpdate = true;
            }

            $compatible_payment_gateway = ['wkstripepayment', 'wkpaypalsubscription', 'wkwepay', 'psadyenpayment'];
            $is_exist = array_search($subsDetails['payment_module'], $compatible_payment_gateway);
            $wkShowSubsciptionPaymentID = false;
            $paymentsubData = [];
            if ($is_exist !== false) {
                $wkShowSubsciptionPaymentID = true;
                $paymentResponse = json_decode($subsDetails['payment_response'], true);

                if ($subsDetails['payment_module'] == 'wkstripepayment') {
                    $paymentsubData['id'] = $paymentResponse['stripe_subscription_id'];
                }

                if ($subsDetails['payment_module'] == 'wkpaypalsubscription') {
                    $paymentsubData['id'] = $paymentResponse['id_subscription'];
                }

                if ($subsDetails['payment_module'] == 'wkwepay') {
                    $paymentsubData['id'] = $paymentResponse['id'];
                }

                if ($subsDetails['payment_module'] == 'psadyenpayment') {
                    $paymentsubData['id'] = $paymentResponse['id_adyen_plan'];
                }
            }

            $this->context->smarty->assign([
                'subsDetails' => $subsDetails,
                'can_cancel' => Configuration::get('WK_SUBSCRIPTION_CAN_CANCEL'),
                'can_update' => $canUpdate,
                'backLink' => $this->context->link->getModuleLink(
                    'wkproductsubscription',
                    'mysubscription'
                ),
                'wkProdSubToken' => $this->module->secure_key,
                'show_pause' => $showPause,
                'show_resume' => $showResume,
                'update_frequency' => $updateFrequency,
                'wkShowSubsciptionPaymentID' => $wkShowSubsciptionPaymentID,
                'paymentsubData' => $paymentsubData,
            ]);

            $this->setTemplate(
                'module:' . $this->module->name . '/views/templates/front/subscription_details.tpl'
            );

            return;
        } else {
            Tools::redirect(
                $this->context->link->getModuleLink(
                    'wkproductsubscription',
                    'mysubscription'
                )
            );
        }
    }

    /**
     * postProcess
     *
     * @return void
     */
    public function postProcess()
    {
        if (Tools::isSubmit('updateSubscription')
            && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
            && Configuration::get('WK_SUBSCRIPTION_CAN_UPDATE')
        ) {
            $id_subscription = (int) Tools::getValue('id_subscription');
            $globalObj = new WkProductSubscriptionGlobal();
            $wk_subs_quantity = (int) Tools::getValue('wk_subs_quantity');
            $subObj = new WkSubscriberProductModal($id_subscription);

            if ($subObj->payment_module == 'wkstripepayment'
                && WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
            ) {
                // Payment module has not no update functionality
            }

            if ($subObj->payment_module == 'psadyenpayment'
                && WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
            ) {
                // Payment module has not no update functionality
            }

            $subObj->quantity = (int) $wk_subs_quantity;
            $total_amt = Tools::ps_round(
                $wk_subs_quantity * $subObj->unit_price,
                2
            );
            $subObj->total_price = (float) $total_amt;
            $sub_total_amt = ($total_amt + $subObj->shipping_charge) - $subObj->discount;
            $subObj->total_amount = (float) $sub_total_amt;
            if ($subObj->save()) {
                $globalObj->sendSubscriptionUpdateMail((int) $id_subscription);
            }
        }

        if (Tools::isSubmit('cancelSubscription')
            && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
            && Configuration::get('WK_SUBSCRIPTION_CAN_CANCEL')
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
                    (int) $this->context->customer->id,
                    $paymentData['stripe_subscription_id'],
                    true
                );
            } elseif ($subObj->payment_module == 'psadyenpayment'
                && WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $adyenObj = new WkSubscriptionAdyen();
                $status = $adyenObj->cancelAdyenSubscription(
                    (int) $this->context->customer->id,
                    $subsData
                );
            } elseif ($subObj->payment_module == 'wkwepay'
                && WkProductSubscriptionGlobal::isWkWepayRecurringEnabled()
            ) {
                $subsData = $globalObj->getSubscriptionDetails((int) $id_subscription);
                $paymentData = json_decode($subsData['payment_response'], true);
                $wepayObj = new WkSubscriptionWepay();
                $status = $wepayObj->cancelWepaySubscription(
                    (int) $this->context->customer->id,
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
                $globalObj->sendSubscriptionCancelMail($id_subscription);
                $this->success[] = $this->module->l('Subscription cancelled successfully.', 'subscriptiondetails');
                $this->redirectWithNotifications(
                    $this->context->link->getModuleLink(
                        'wkproductsubscription',
                        'subscriptiondetails'
                    )
                );
            }
        }

        if (Tools::isSubmit('deleteSubscription')
            && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
        ) {
            $id_subscription = (int) Tools::getValue('id_subscription');
            $subObj = new WkSubscriberProductModal($id_subscription);
            $subObj->deleted = 1;
            $subObj->active = 0;
            if ($subObj->save()) {
                $this->success[] = $this->module->l('Subscription deleted successfully.', 'subscriptiondetails');
                $this->redirectWithNotifications(
                    $this->context->link->getModuleLink(
                        'wkproductsubscription',
                        'mysubscription'
                    )
                );
            }
        }

        if (Tools::isSubmit('pauseSubscription')
            && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
            && Configuration::get('WK_SUBSCRIPTION_CAN_PAUSE')
        ) {
            $status = false;
            $pauseDate = Tools::getValue('pause_no_of_days');
            if (empty($pauseDate)) {
                $this->errors[] = $this->module->l('Pause date is required', 'subscriptiondetails');
            }
            $datediff = strtotime($pauseDate) - strtotime(date('Y-m-d'));
            $noOfDays = round($datediff / (60 * 60 * 24));
            // $noOfDays += 1; // add 1 because not consider today
            $id_subscription = (int) Tools::getValue('id_subscription');
            $subObj = new WkSubscriberProductModal($id_subscription);
            if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
                $this->errors[] = $this->module->l('Subscription is not active', 'subscriptiondetails');
            }
            if (empty($this->errors)) {
                $globalObj = new WkProductSubscriptionGlobal();
                $data = $globalObj->pauseSupscription($id_subscription, $noOfDays);
                if (!$data['status']) {
                    $this->errors[] = $data['msg'];
                } else {
                    $status = true;
                    $this->success[] = $this->module->l('Subscription paused successfully.', 'subscriptiondetails');
                }
                if ($status) {
                    $this->redirectWithNotifications(
                        $this->context->link->getModuleLink(
                            'wkproductsubscription',
                            'subscriptiondetails'
                        )
                    );
                }
            }
        }

        if (Tools::isSubmit('resumeSubscription')
            && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
            && Configuration::get('WK_SUBSCRIPTION_CAN_RESUME')
        ) {
            $status = false;
            $id_subscription = (int) Tools::getValue('id_subscription');
            $globalObj = new WkProductSubscriptionGlobal();
            $data = $globalObj->resumeSupscription($id_subscription);
            if (!$data['status']) {
                $this->errors[] = $data['msg'];
            } else {
                $status = true;
                $this->success[] = $this->module->l('Subscription resumed successfully.', 'subscriptiondetails');
            }
            if ($status) {
                $this->redirectWithNotifications(
                    $this->context->link->getModuleLink(
                        'wkproductsubscription',
                        'subscriptiondetails'
                    )
                );
            }
        }

        if (Tools::isSubmit('frequencyUpdateSubscription')
        && (Tools::getValue('wkProdSubToken') == $this->module->secure_key)
        && Configuration::get('WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE')
        ) {
            $status = false;
            $frequency = Tools::getValue('frequency_select');
            $cycle = Tools::getValue('cycle_select');
            if (empty($frequency)) {
                $this->errors[] = $this->module->l('Frequency is required', 'subscriptiondetails');
            }
            if (empty($cycle)) {
                $this->errors[] = $this->module->l('Cycle is required', 'subscriptiondetails');
            }
            if (empty($this->errors)) {
                $id_subscription = (int) Tools::getValue('id_subscription');
                $scheduleData = WkSubscriberScheduleModel::isScheduleBySubscriptionId($id_subscription);
                if (!$scheduleData) {
                    $subObj = new WkSubscriberProductModal($id_subscription);
                    if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
                        $this->errors[] = $this->module->l('Subscription is not active', 'subscriptiondetails');
                    } else {
                        if ($frequency == 1) {
                            $subObj->frequency = 'daily';
                        } elseif ($frequency == 2) {
                            $subObj->frequency = 'weekly';
                        } elseif ($frequency == 3) {
                            $subObj->frequency = 'monthly';
                        } elseif ($frequency == 4) {
                            $subObj->frequency = 'yearly';
                        }
                        $subObj->cycle = $cycle;
                        if ($subObj->save()) {
                            $globalObj = new WkProductSubscriptionGlobal();
                            $globalObj->sendSubscriptionUpdateMail($id_subscription);
                            $this->success[] = $this->module->l('Frequency updated successfully.', 'subscriptiondetails');
                        } else {
                            $this->errors[] = $this->module->l('Frequency not updated successfully.');
                        }
                    }
                } else {
                    $this->errors[] = $this->module->l('Please update frequency later because subscription order is schedule on date ', 'subscriptiondetails') . Tools::displayDate($scheduleData['order_date']);
                }
            }
        }
    }

    /**
     * Display beadcrumbs on your controller
     *
     * @return array
     */
    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = [
            'title' => $this->module->l('Your account', 'mysubscription'),
            'url' => $this->context->link->getPageLink('my-account'),
        ];
        $breadcrumb['links'][] = [
            'title' => $this->module->l('My subscriptions', 'subscriptiondetails'),
            'url' => $this->context->link->getModuleLink('wkproductsubscription', 'mysubscription'),
        ];
        $breadcrumb['links'][] = [
            'title' => $this->module->l('Subscription details', 'subscriptiondetails'),
            'url' => $this->context->link->getModuleLink(
                'wkproductsubscription',
                'subscriptiondetails',
                ['id_subscription' => (int) Tools::getValue('id_subscription')]
            ),
        ];

        return $breadcrumb;
    }

    /**
     * Add CSS for this controller
     *
     * @return bool
     */
    public function setMedia()
    {
        parent::setMedia();
        $this->registerStylesheet(
            'wkproductsubscription-my-subscription-css',
            'modules/' . $this->module->name . '/views/css/wkproductsubscription.css'
        );

        $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');

        Media::addJsDef([
            'wkProdSubsAjaxLink' => $this->context->link->getModuleLink(
                'wkproductsubscription',
                'ajax'
            ),
            'confirmMsg' => $this->module->l('Are you sure?', 'subscriptiondetails'),
            'no_of_days_msg' => $this->module->l('Please select date', 'subscriptiondetails'),
            'wkOrderDays' => $wkOrderDays,
            'isAllVirtualProduct' => false,
            'wkProdSubToken' => $this->module->secure_key,
            'everyday_str' => $this->module->l('Everyday', 'subscriptiondetails'),
            'every_2_str' => $this->module->l('Every 2 day', 'subscriptiondetails'),
            'every_3_str' => $this->module->l('Every 3 day', 'subscriptiondetails'),
            'every_4_str' => $this->module->l('Every 4 day', 'subscriptiondetails'),
            'every_5_str' => $this->module->l('Every 5 day', 'subscriptiondetails'),
            'every_6_str' => $this->module->l('Every 6 day', 'subscriptiondetails'),
            'every_week_str' => $this->module->l('Every week', 'subscriptiondetails'),
            'every_2_week_str' => $this->module->l('Every 2 week', 'subscriptiondetails'),
            'every_3_week_str' => $this->module->l('Every 3 week', 'subscriptiondetails'),
            'every_4_week_str' => $this->module->l('Every 4 week', 'subscriptiondetails'),
            'every_month_str' => $this->module->l('Every month', 'subscriptiondetails'),
            'every_2_month_str' => $this->module->l('Every 2 month', 'subscriptiondetails'),
            'every_3_month_str' => $this->module->l('Every 3 month', 'subscriptiondetails'),
            'every_4_month_str' => $this->module->l('Every 4 month', 'subscriptiondetails'),
            'every_5_month_str' => $this->module->l('Every 5 month', 'subscriptiondetails'),
            'every_6_month_str' => $this->module->l('Every 6 month', 'subscriptiondetails'),
            'every_year_str' => $this->module->l('Every year', 'subscriptiondetails'),
            'every_2_year_str' => $this->module->l('Every 2 year', 'subscriptiondetails'),
        ]);
        $this->context->controller->addJqueryUI('ui.datepicker');
        $this->registerJavascript(
            'wkproductsubscription-manage-subscription-js',
            'modules/' . $this->module->name . '/views/js/wkproductsubscription.js'
        );

        return true;
    }
}
