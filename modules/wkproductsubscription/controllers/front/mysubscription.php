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

class WkProductSubscriptionMySubscriptionModuleFrontController extends ModuleFrontController
{
    /**
     * Force user to login
     */
    public $auth = true;
    public $guestAllowed = false;

    /**
     * initContent
     */
    public function initContent()
    {
        parent::initContent();

        $id_customer = (int) $this->context->customer->id;
        $id_subscriber = (int) WkProductSubscriptionGlobal::isSubscriber($id_customer);
        $subObj = new WkProductSubscriptionGlobal();
        $subscriptions = $subObj->getSubscriberSubscriptionData($id_subscriber, false);

        $dailyString = $this->module->l('Every %d day', 'mysubscription');
        $everyDayString = $this->module->l('Everyday', 'mysubscription');
        $weeklyString = $this->module->l('Every %d week', 'mysubscription');
        $everyWeekString = $this->module->l('Every week', 'mysubscription');
        $monthlyString = $this->module->l('Every %d month', 'mysubscription');
        $everyMonthString = $this->module->l('Every month', 'mysubscription');
        $yearlyString = $this->module->l('Every %d year', 'mysubscription');
        $everyYearString = $this->module->l('Every year', 'mysubscription');

        if ($subscriptions) {
            foreach ($subscriptions as $k => $sub) {
                if ($sub['frequency'] == 'daily') {
                    if ($sub['cycle'] == 1) {
                        $subscriptions[$k]['frequncy_label'] = $everyDayString;
                    } else {
                        $subscriptions[$k]['frequncy_label'] = sprintf($dailyString, $sub['cycle']);
                    }
                } elseif ($sub['frequency'] == 'weekly') {
                    if ($sub['cycle'] == 1) {
                        $subscriptions[$k]['frequncy_label'] = $everyWeekString;
                    } else {
                        $subscriptions[$k]['frequncy_label'] = sprintf($weeklyString, $sub['cycle']);
                    }
                } elseif ($sub['frequency'] == 'monthly') {
                    if ($sub['cycle'] == 1) {
                        $subscriptions[$k]['frequncy_label'] = $everyMonthString;
                    } else {
                        $subscriptions[$k]['frequncy_label'] = sprintf($monthlyString, $sub['cycle']);
                    }
                } elseif ($sub['frequency'] == 'yearly') {
                    if ($sub['cycle'] == 1) {
                        $subscriptions[$k]['frequncy_label'] = $everyYearString;
                    } else {
                        $subscriptions[$k]['frequncy_label'] = sprintf($yearlyString, $sub['cycle']);
                    }
                } else {
                }

                $subscriptions[$k]['detail_link'] = $this->context->link->getModuleLink(
                    'wkproductsubscription',
                    'subscriptiondetails',
                    [
                        'id_subscription' => $sub['id_subscription'],
                    ]
                );
            }
        }

        $this->context->smarty->assign([
            'subscriptions' => $subscriptions,
        ]);

        $this->setTemplate(
            'module:' . $this->module->name . '/views/templates/front/my_subscription.tpl'
        );
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
            'title' => $this->module->l('My subscriptions', 'mysubscription'),
            'url' => $this->context->link->getModuleLink('wkproductsubscription', 'mysubscription'),
        ];

        return $breadcrumb;
    }

    /**
     * Add CSS for this controller
     *
     * @return void
     */
    public function setMedia()
    {
        parent::setMedia();
        $this->registerStylesheet(
            'wkproductsubscription-my-subscription-css',
            'modules/' . $this->module->name . '/views/css/wkproductsubscription.css'
        );
    }
}
