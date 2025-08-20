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

include_once 'classes/WkSubscriptionRequired.php';

class WkProductSubscription extends Module
{
    private $output = '';
    private $postErrors = [];
    public $secure_key = '';

    public function __construct()
    {
        $this->name = 'wkproductsubscription';
        $this->tab = 'front_office_features';
        $this->version = '5.4.1';
        $this->module_key = '25244e60fe4f10cdd42096e03b98adbb';
        $this->author = 'Webkul';
        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
        $this->need_instance = 0;
        $this->secure_key = Tools::hash($this->name);
        $this->bootstrap = true;
        $this->controllers = [
            'mysubscription',
            'ajax',
            'cron',
            'subscriptiondetails',
        ];
        parent::__construct();
        $this->displayName = $this->l('Subscription products');
        $this->description = $this->l('This module allows to create subscription based products.');
        $this->confirmUninstall = $this->l('Are you sure?');
    }

    /**
     * Install module
     */
    public function install()
    {
        $wkDbObj = new WkProductSubscriptionDb();
        if (!$this->installOverrideFiles()
            || !parent::install()
            || !$this->callInstallTab()
            || !$wkDbObj->createTable()
            || !$this->setDefaultValues()
            || !$this->registerPsHooks()
        ) {
            return false;
        }

        return true;
    }

    /**
     * In case of multishop, when we enable this module on other shop
     * It's through an issue like this class/controller method already
     * overridden by this module
     * To handle this issue, we need to uninstall this module override first
     * and then call parent enable method
     *
     * @param bool $force_all
     *
     * @return bool
     */
    public function enable($force_all = false)
    {
        if (Shop::isFeatureActive()) {
            $this->uninstallOverrides();
        }

        return parent::enable($force_all);
    }

    /**
     * In case of multishop, when we disabled the module for a purticular shop
     * PrestaShop removes the module overrided file code even if module is enabled
     * on the other shop.
     * To handle this issue, we need to call the parent disable method first and
     * check if this module is enabled for other shop then install override
     *
     * @param bool $force_all
     *
     * @return bool
     */
    public function disable($force_all = false)
    {
        if (parent::disable($force_all) && Shop::isFeatureActive()) {
            $ifExists = WkProductSubscriptionGlobal::checkIfModuleEnabledOtherShop($this->id);
            if ($ifExists) {
                $this->installOverrides();
            }
        }

        return true;
    }

    public function registerPsHooks()
    {
        if (!$this->registerHook('actionFrontControllerSetMedia')
            || !$this->registerHook('actionAdminControllerSetMedia')
            || !$this->registerHook('displayCustomerAccount')
            || !$this->registerHook('displayProductPriceBlock')
            || !$this->registerHook('displayCartExtraProductActions')
            || !$this->registerHook('actionValidateOrder')
            || !$this->registerHook('displayOrderConfirmation1')
            || !$this->registerHook('actionObjectProductInCartDeleteAfter')
            || !$this->registerHook('actionProductDelete')
            || !$this->registerHook('actionOrderStatusUpdate')
            || !$this->registerHook('displayAdminOrderLeft')
            || !$this->registerHook('displayAdminOrderMain')
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('actionObjectProductUpdateAfter')
            || !$this->registerHook('displayBackOfficeHeader')
            || !$this->registerHook('displayAdminAfterHeader')
            || !$this->registerHook('actionObjectCombinationDeleteAfter')
            || !$this->registerHook('actionWkSubscriptionCancel')
        ) {
            return false;
        }

        return true;
    }

    public function hookActionWkSubscriptionCancel($params)
    {
        if ($params
            && ($params['module'] == 'wkpaypalsubscription')
            && WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()
        ) {
            $idPayPalSubscription = $params['subscription_id'];
            if ($idPayPalSubscription) {
                $idSubscription = WkSubscriptionPayPal::getSubscriptionIdByPayPalId($idPayPalSubscription);
                if ($idSubscription) {
                    $subObj = new WkSubscriberProductModal($idSubscription);
                    $subObj->active = 0;
                    if ($subObj->save()) {
                        $objGlobal = new WkProductSubscriptionGlobal();
                        $objGlobal->sendSubscriptionCancelMail($idSubscription);
                    }
                }
            }
        }
    }

    public function hookDisplayBackOfficeHeader()
    {
        $controller = Tools::getValue('controller');
        if (in_array($controller, ['AdminProducts'])) {
            $catelogBtn = $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/catalog_bulk_btn.tpl'
            );
            $this->context->smarty->assign('wk_cat_loader', _MODULE_DIR_ . $this->name . '/views/img/loading.gif');
            $catelogModal = $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/catalog_modal.tpl'
            );
            Media::addJsDef(
                [
                    'wk_catalog_cat_btn' => $catelogBtn,
                    'wk_bulk_prod_modal' => $catelogModal,
                    'wk_assign_subscription_ajax' => $this->context->link->getAdminLink('AdminSubscriptions', true),
                ]
            );
        }
    }

    public function hookDisplayAdminAfterHeader($params)
    {
        $controller = Tools::getValue('controller');
        if (in_array($controller, ['AdminProducts'])) {
            if ($status = Tools::getValue('subsAssign')) {
                $this->context->smarty->assign('subsAssign', $status);

                return $this->display(__FILE__, 'display-success-message.tpl');
            }
        }
    }

    public function hookDisplayHeader()
    {
        $controller = Tools::getValue('controller');
        if ('order' === $controller
            || 'orderopc' === $controller
            || 'cart' === $controller
        ) {
            $idCart = (int) $this->context->cart->id;
            // Check if cart has discount but frequency discount is removed
            if ($idCart && (strtolower($_SERVER['REQUEST_METHOD']) != 'post')) {
                $tempCartData = WkSubscriptionCartProducts::getByIdCart($idCart, true);
                if ($tempCartData) {
                    foreach ($tempCartData as $tmpCart) {
                        if ($tmpCart['id_cart_rule']) {
                            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                $tmpCart['frequency'],
                                (int) $tmpCart['cycle'],
                                (int) $tmpCart['id_product'],
                                (int) $tmpCart['id_product_attribute']
                            );
                            if (!$discount) {
                                $this->context->cart->removeCartRule($tmpCart['id_cart_rule']);
                                $this->context->cart->update();
                                $objCartRule = new CartRule((int) $tmpCart['id_cart_rule']);
                                $objCartRule->delete();
                            }
                        }
                    }
                }
                $cart = new Cart((int) $idCart);
                $getProducts = $cart->getProducts();
                if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
                    && !empty($getProducts)
                ) {
                    foreach ($getProducts as $product) {
                        $idAttrib = $product['id_product_attribute'];
                        $idProduct = $product['id_product'];
                        WkSubscriptionStripe::deactivateStripeProduct(
                            $cart->id,
                            $idProduct,
                            $idAttrib
                        );
                    }
                }

                if (('order' === $controller)
                    && WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()
                    && !empty($getProducts)
                    && WkPaypalHelper::checkPaypalConfigured()
                ) {
                    foreach ($getProducts as $product) {
                        $idAttrib = $product['id_product_attribute'];
                        $idProduct = $product['id_product'];
                        $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                            $idCart,
                            $idProduct,
                            $idAttrib,
                            true
                        );
                        if ($isCartExist && $cart->id_address_invoice) {
                            $cacheParams = [
                                'id_cart' => $idCart,
                                'id_address_invoice' => $cart->id_address_invoice,
                                'id_currency' => $cart->id_currency,
                                'products' => $getProducts,
                                'total' => $cart->getOrderTotal(true),
                            ];
                            $hash = WkProductSubscriptionCache::calculateSubscriptionHash($cacheParams);
                            $cacheParams['hash'] = $hash;
                            $cacheData = WkProductSubscriptionCache::getSubscriptionCacheData($cacheParams);
                            if (!$cacheData) {
                                if ($idCache = $this->saveSubscriptionCache($cacheParams)) {
                                    $idPlan = WkSubscriptionPayPal::createPlanAndAssignProduct($cacheParams, $isCartExist);
                                    if ($idPlan) {
                                        $objCache = new WkProductSubscriptionCache($idCache);
                                        $objCache->id_plan = $idPlan;
                                        $objCache->save();
                                    }
                                }
                            } elseif ($cacheData['id_plan'] == '') {
                                $idCache = (int) $cacheData['id_wk_subscription_cache'];
                                $idPlan = WkSubscriptionPayPal::createPlanAndAssignProduct($cacheParams, $isCartExist);
                                if ($idPlan) {
                                    $objCache = new WkProductSubscriptionCache($idCache);
                                    $objCache->id_plan = $idPlan;
                                    $objCache->save();
                                }
                            } elseif ($cacheData['id_plan']) {
                                $objPayPalPlan = new WkSubscriptionPlan();
                                $planDetails = $objPayPalPlan->getPlanDetailByPaypalId($cacheData['id_plan']);
                                if (!$planDetails) {
                                    $idCache = (int) $cacheData['id_wk_subscription_cache'];
                                    $idPlan = WkSubscriptionPayPal::createPlanAndAssignProduct($cacheParams, $isCartExist);
                                    if ($idPlan) {
                                        $objCache = new WkProductSubscriptionCache($idCache);
                                        $objCache->id_plan = $idPlan;
                                        $objCache->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function saveSubscriptionCache($params)
    {
        WkProductSubscriptionCache::deleteExistingCacheByCart($params['id_cart']);
        $objCache = new WkProductSubscriptionCache();
        $objCache->id_cart = $params['id_cart'];
        $objCache->id_order = 0;
        $objCache->hash = $params['hash'];
        $objCache->id_currency = $params['id_currency'];
        $objCache->order_total = $params['total'] ? $params['total'] : 0;
        $objCache->save();

        return $objCache->id;
    }

    public function hookDisplayAdminOrderLeft()
    {
        $idOrder = (int) Tools::getValue('id_order');

        return $this->displaySubscriptionDetailsInAdmin($idOrder);
    }

    public function hookDisplayAdminOrderMain()
    {
        $idOrder = (int) Tools::getValue('id_order');

        return $this->displaySubscriptionDetailsInAdmin($idOrder);
    }

    private function displaySubscriptionDetailsInAdmin($idOrder)
    {
        if ($idOrder && WkProductSubscriptionGlobal::isSubscriptionOrder((int) $idOrder)) {
            if ($subscriptions = $this->getSubscriptionOrderDetails($idOrder)) {
                if (Tools::version_compare(_PS_VERSION_, '1.7.7.0', '<')) {
                    $isLowerPsVersion = true;
                } else {
                    $isLowerPsVersion = false;
                }
                $this->context->smarty->assign([
                    'subscriptionData' => $subscriptions,
                    'isLowerPsVersion' => $isLowerPsVersion,
                ]);

                return $this->display(__FILE__, 'displayAdminOrderMain.tpl');
            }
        }
    }

    public function hookActionObjectProductInCartDeleteAfter($params)
    {
        $idCart = (int) $params['id_cart'];
        $idProduct = (int) $params['id_product'];
        $idProductAttribute = (int) $params['id_product_attribute'];
        $tempCart = WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idProductAttribute, true);
        if ($tempCart) {
            WkSubscriptionCartProducts::deleteTempCartProduct($idCart, $idProduct, $idProductAttribute);
            // Check for discount
            if ($tempCart['id_cart_rule']) {
                $this->context->cart->removeCartRule($tempCart['id_cart_rule']);
                $this->context->cart->update();
                $objCartRule = new CartRule((int) $tempCart['id_cart_rule']);
                $objCartRule->delete();
            }
            if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                WkSubscriptionPayPal::deleteTempCartProduct(
                    $idCart,
                    $idProduct,
                    $idProductAttribute
                );
                WkProductSubscriptionCache::deleteExistingCacheByCart($idCart);
            }
        }
    }

    /**
     * Set default values while installing the module
     */
    public function setDefaultValues()
    {
        $langSubsArr = [];
        $langOtpArr = [];
        $langMsgArr = [];
        $langOfferArr = [];
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_CREATE_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_UPDATE_EMAIL', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_CANCEL_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_RENEW_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_PAUSE_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SEND_RESUME_EMAIL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_CANCEL', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_UPDATE', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_PAUSE', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_RESUME', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_CRON_TOKEN', uniqid('wk'));
        Configuration::updateValue('WK_SUBSCRIPTION_CRON_ORDER_STATUS', 2);
        Configuration::updateValue('WK_SUBSCRIPTION_CRON_PRIOR_DAYS', 3);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_NO_SUBS', 0);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_VOUCHER_APPLY', 1);
        Configuration::updateValue('WK_SUBSCRIPTION_SHIPPING_FREE', 0);

        foreach (Language::getLanguages(false) as $lang) {
            $langSubsArr[$lang['id_lang']] = $this->l('Subscribe');
            $langOtpArr[$lang['id_lang']] = $this->l('One-time purchase');
            $langMsgArr[$lang['id_lang']] = $this->l('This product is available for subscription.') . ' ' .
            $this->l('To subscribe this product, please select the subscribe button and select subscription options.');
            $langOfferArr[$lang['id_lang']] =
            $this->l('You will save maximum {AMOUNT} amount on this product if you subscribe to this.');
        }
        Configuration::updateValue(
            'WK_SUBSCRIPTION_SUBS_BTN_TXT',
            $langSubsArr
        );
        Configuration::updateValue(
            'WK_SUBSCRIPTION_OTP_BTN_TXT',
            $langOtpArr
        );
        Configuration::updateValue(
            'WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE',
            $langMsgArr,
            true
        );
        Configuration::updateValue(
            'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE',
            $langOfferArr,
            true
        );

        return true;
    }

    /**
     * Update subscription order status when order status is changed
     *
     * @param mixed $params
     *
     * @return void
     */
    public function hookActionOrderStatusUpdate($params)
    {
        $id_order = (int) $params['id_order'];
        $id_subs_order = (int) WkProductSubscriptionGlobal::isSubscriptionOrder($id_order);
        if ($id_subs_order) {
            $osObj = $params['newOrderStatus'];
            $delivered_order_status = [
                (int) Configuration::get('PS_OS_DELIVERED'),
                (int) Configuration::get('PS_OS_SHIPPING'),
            ];
            if (in_array($osObj->id, $delivered_order_status)) {
                $subOrderObj = new WkSubscriberOrderModel($id_subs_order);
                $subOrderObj->is_delivered = 1;
                $subOrderObj->save();
            }
        }
    }

    public function hookDisplayProductPriceBlock($params)
    {
        if ($params['type'] == 'after_price') {
            $dailyString = $this->l('Every %d day');
            $everyDayString = $this->l('Everyday');
            $weeklyString = $this->l('Every %d week');
            $everyWeekString = $this->l('Every week');
            $monthlyString = $this->l('Every %d month');
            $everyMonthString = $this->l('Every month');
            $yearlyString = $this->l('Every %d year');
            $everyYearString = $this->l('Every year');

            $id_product = $params['product']['id_product'];
            $idLang = (int) $this->context->language->id;
            $idShop = (int) $this->context->shop->id;
            $product = new Product($id_product, false, $idLang, $idShop);

            $id_product_attribute = 0;
            if ($product->hasAttributes()) {
                if (Tools::getValue('group')) {
                    $id_product_attribute = (int) Product::getIdProductAttributeByIdAttributes(
                        (int) $id_product,
                        Tools::getValue('group')
                    );
                } elseif (Tools::getValue('id_product_attribute')) {
                    $id_product_attribute = (int) Tools::getValue('id_product_attribute');
                } else {
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                }
            }

            if (WkProductSubscriptionModel::checkIfSubscriptionProduct($id_product, $id_product_attribute)
                && Validate::isLoadedObject($product)
            ) {
                // Check for product is virtual or pack of product
                if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')
                    && ($product->getType() != Product::PTYPE_SIMPLE)
                ) {
                    return false;
                }

                $subscriptionData = WkProductSubscriptionModel::getProductSubscriptionData(
                    $id_product,
                    $id_product_attribute
                );
                $availableCycles = [];
                
                // Get product price
                $productPrice = Product::getPriceStatic($id_product, true, $id_product_attribute);
                
                // Check if product subscription is active
                if ($subscriptionData['active']) {
                    $id_product_attribute = 0;
                    $hasDiscountFreqency = false;
                    $discountFreqency = [];
                    if ($product->hasAttributes()) {
                        if (Tools::getValue('group')) {
                            $id_product_attribute = (int) Product::getIdProductAttributeByIdAttributes(
                                (int) $id_product,
                                Tools::getValue('group')
                            );
                        } elseif (Tools::getValue('id_product_attribute')) {
                            $id_product_attribute = (int) Tools::getValue('id_product_attribute');
                        } else {
                            $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                        }
                    }

                    $discountTxt = $this->l('(%s%% off)');
                    // Check for daily
                    if ($subscriptionData['daily_frequency']) {
                        $dailyCycles = json_decode($subscriptionData['daily_cycles']);
                        foreach ($dailyCycles as $value) {
                            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                'daily',
                                (int) $value,
                                (int) $id_product,
                                (int) $id_product_attribute
                            );
                            $appendDiscount = '';
                            $discountedPrice = $productPrice;
                            if ($discount > 0) {
                                $appendDiscount = sprintf(
                                    $discountTxt,
                                    $discount
                                );
                                $hasDiscountFreqency = true;
                                $discountFreqency[] = $discount;
                                $discountedPrice = $productPrice * (100 - $discount) / 100;
                            }
                            if ($value == 1) {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'daily',
                                    'frequencyTxt' => $everyDayString,
                                    'frequencyText' => $everyDayString . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            } else {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'daily',
                                    'frequencyTxt' => sprintf($dailyString, $value),
                                    'frequencyText' => sprintf($dailyString, $value) . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            }
                        }
                    }

                    // Check for weekly frequency
                    if ($subscriptionData['weekly_frequency']) {
                        $weeklyCycles = json_decode($subscriptionData['weekly_cycles']);
                        foreach ($weeklyCycles as $value) {
                            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                'weekly',
                                (int) $value,
                                (int) $id_product,
                                (int) $id_product_attribute
                            );
                            $appendDiscount = '';
                            $discountedPrice = $productPrice;
                            if ($discount > 0) {
                                $appendDiscount = sprintf(
                                    $discountTxt,
                                    $discount
                                );
                                $hasDiscountFreqency = true;
                                $discountFreqency[] = $discount;
                                $discountedPrice = $productPrice * (100 - $discount) / 100;
                            }
                            if ($value == 1) {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'weekly',
                                    'frequencyTxt' => $everyWeekString,
                                    'frequencyText' => $everyWeekString . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            } else {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'weekly',
                                    'frequencyTxt' => sprintf($weeklyString, $value),
                                    'frequencyText' => sprintf($weeklyString, $value) . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            }
                        }
                    }
                    // Check for monthly frequency
                    if ($subscriptionData['monthly_frequency']) {
                        $monthlyCycles = json_decode($subscriptionData['monthly_cycles']);
                        foreach ($monthlyCycles as $value) {
                            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                'monthly',
                                (int) $value,
                                (int) $id_product,
                                (int) $id_product_attribute
                            );
                            $appendDiscount = '';
                            $discountedPrice = $productPrice;
                            if ($discount > 0) {
                                $appendDiscount = sprintf(
                                    $discountTxt,
                                    $discount
                                );
                                $hasDiscountFreqency = true;
                                $discountFreqency[] = $discount;
                                $discountedPrice = $productPrice * (100 - $discount) / 100;
                            }
                            if ($value == 1) {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'monthly',
                                    'frequencyTxt' => $everyMonthString,
                                    'frequencyText' => $everyMonthString . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            } else {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'monthly',
                                    'frequencyTxt' => sprintf($monthlyString, $value),
                                    'frequencyText' => sprintf($monthlyString, $value) . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            }
                        }
                    }
                    // Check for yearly frequency
                    if ($subscriptionData['yearly_frequency']) {
                        $yearlyCycles = json_decode($subscriptionData['yearly_cycles']);
                        foreach ($yearlyCycles as $value) {
                            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                'yearly',
                                (int) $value,
                                (int) $id_product,
                                (int) $id_product_attribute
                            );
                            $appendDiscount = '';
                            $discountedPrice = $productPrice;
                            if ($discount > 0) {
                                $appendDiscount = sprintf(
                                    $discountTxt,
                                    $discount
                                );
                                $hasDiscountFreqency = true;
                                $discountFreqency[] = $discount;
                                $discountedPrice = $productPrice * (100 - $discount) / 100;
                            }
                            if ($value == 1) {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'yearly',
                                    'frequencyTxt' => $everyYearString,
                                    'frequencyText' => $everyYearString . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            } else {
                                $availableCycles[] = [
                                    'id_product' => $id_product,
                                    'cycle' => $value,
                                    'frequency' => 'yearly',
                                    'frequencyTxt' => sprintf($yearlyString, $value),
                                    'frequencyText' => sprintf($yearlyString, $value) . ' ' . $appendDiscount,
                                    'discount' => $discount,
                                    'discounted_price' => $discountedPrice,
                                ];
                            }
                        }
                    }

                    $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');

                    if ($id_product) {
                        // Check if this product combination in temp cart
                        $tempCart = WkSubscriptionCartProducts::getByIdProductByIdCart(
                            $this->context->cart->id,
                            $id_product,
                            $id_product_attribute,
                            true
                        );

                        // Apply default selection conditions of one time purchase radio button
                        $selectctedCheckbox = 1;  // 1 for subscription option
                        if (Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE') == 1) {
                            $subsInCart = false;
                            $cartProduct = false;
                            $cartProducts = $this->context->cart->getProducts();
                            if ($cartProducts) {
                                if ($tempCart) {
                                    $subsInCart = true;
                                    $cartProduct = true;
                                } else {
                                    $isExists = WkSubscriptionCartProducts::getByIdProductByIdCart(
                                        $this->context->cart->id,
                                        $id_product,
                                        $id_product_attribute
                                    );
                                    if ($isExists) {
                                        $cartProduct = true;
                                    }
                                }
                            }
                            if ($cartProduct && $subsInCart) {
                                $selectctedCheckbox = 1;
                            } elseif ($cartProduct) {
                                $selectctedCheckbox = 0;
                            } else {
                                $selectctedCheckbox = (int) Configuration::get('WK_DEFAULT_SELECT_ON_PRODUCTPAGE');
                            }
                        }

                        $subscribeBtnText = Configuration::get('WK_SUBSCRIPTION_SUBS_BTN_TXT', $idLang);
                        $otpBtnText = Configuration::get('WK_SUBSCRIPTION_OTP_BTN_TXT', $idLang);
                        $subscriptionMsg = Configuration::get('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE', $idLang);
                        $wkDisplayOtpBtn = (int) Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE');

                        $offerMsgText = '';
                        if ($hasDiscountFreqency && Configuration::get('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG')) {
                            $productPrice = Product::getPriceStatic(
                                $id_product,
                                true,
                                $id_product_attribute
                            );
                            $maxDiscount = max($discountFreqency);
                            if ($productPrice > 0 && $maxDiscount) {
                                $discountedAmt = (($productPrice / 100) * $maxDiscount);
                                $offerMsgText = Configuration::get('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE', $idLang);
                                $offerMsgText = str_replace(
                                    '{AMOUNT}',
                                    WkProductSubscription::displayPrice(
                                        $discountedAmt,
                                        new Currency((int) $this->context->currency->id)
                                    ),
                                    $offerMsgText
                                );
                            }
                        }

                        $commonlyUsedText = '';
                        if (Configuration::get('WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ')) {
                            $commonlyUsed = WkProductSubscriptionGlobal::getProductSubscriptionFrequencyCount(
                                $id_product
                            );
                            if ($commonlyUsed) {
                                foreach ($availableCycles as $avail) {
                                    if ($avail['cycle'] == $commonlyUsed['cycle']
                                        && $avail['frequency'] == $commonlyUsed['frequency']
                                    ) {
                                        $commonlyUsedText = sprintf(
                                            $this->l('%s is the most commonly used frequency for this product.'),
                                            $avail['frequencyTxt']
                                        );
                                    }
                                }
                            }
                        }

                        $noSubscriberMsg = false;
                        if (Configuration::get('WK_SUBSCRIPTION_DISPLAY_NO_SUBS')) {
                            if (!WkProductSubscriptionGlobal::getProductSubscriberCount($id_product)) {
                                $noSubscriberMsg = true;
                            }
                        }

                        if ($tempCart) {
                            $firstDelDate = '';
                            $firstDelDateStamp = strtotime(date('Y-m-d', strtotime('+' . $wkOrderDays . ' days')));
                            $firstDbDelStamp = strtotime($tempCart['first_delivery_date']);
                            if ($firstDelDateStamp > $firstDbDelStamp) {
                                $firstDelDate = date('Y-m-d', strtotime('+' . $wkOrderDays . ' days'));
                            } else {
                                $firstDelDate = $tempCart['first_delivery_date'];
                            }

                            $this->context->smarty->assign([
                                'availableCycles' => $availableCycles,
                                'as_subscription' => (int) $tempCart['as_subscription'],
                                'frequency' => $tempCart['frequency'],
                                'cycle' => $tempCart['cycle'],
                                'firstDelDate' => $firstDelDate,
                                'id_sub_temp' => $tempCart['id_wk_subscription_temp_cart'],
                                'is_virtual' => $product->is_virtual,
                                'today_date' => date('Y-m-d'),
                                'subscribeBtnText' => $subscribeBtnText,
                                'otpBtnText' => $otpBtnText,
                                'subscriptionMsg' => $subscriptionMsg,
                                'offerMsgText' => $offerMsgText,
                                'wkDisplayOtpBtn' => $wkDisplayOtpBtn,
                                'commonlyUsedText' => $commonlyUsedText,
                                'noSubscriberMsg' => $noSubscriberMsg,
                                'selectctedCheckbox' => $selectctedCheckbox,
                            ]);

                            return $this->display(__FILE__, 'subscribe_block.tpl');
                        } else {
                            $this->context->smarty->assign([
                                'availableCycles' => $availableCycles,
                                'firstDelDate' => date('Y-m-d', strtotime('+' . $wkOrderDays . ' days')),
                                'id_sub_temp' => 0,
                                'is_virtual' => $product->is_virtual,
                                'today_date' => date('Y-m-d'),
                                'subscribeBtnText' => $subscribeBtnText,
                                'otpBtnText' => $otpBtnText,
                                'subscriptionMsg' => $subscriptionMsg,
                                'offerMsgText' => $offerMsgText,
                                'wkDisplayOtpBtn' => $wkDisplayOtpBtn,
                                'commonlyUsedText' => $commonlyUsedText,
                                'noSubscriberMsg' => $noSubscriberMsg,
                                'selectctedCheckbox' => $selectctedCheckbox,
                            ]);

                            return $this->display(__FILE__, 'subscribe_block.tpl');
                        }
                    }
                }
            }
        }

        if ($this->context->controller->php_self == 'cart'
            || $this->context->controller->php_self == 'order'
        ) {
            if ($params['type'] == 'unit_price') {
                $idProductAttribute = $params['product']->id_product_attribute;
                $idProduct = $params['product']->id_product;
                $tempCart = WkSubscriptionCartProducts::getByIdProductByIdCart(
                    (int) $this->context->cart->id,
                    $idProduct,
                    $idProductAttribute,
                    true
                );
                if ($tempCart) {
                    return $this->display(__FILE__, 'subscrption_label.tpl');
                }
            }
        }
    }

    public function hookActionObjectProductUpdateAfter($params)
    {
        $idProduct = (int) $params['object']->id;
        if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)) {
            $objProduct = new Product((int) $idProduct);
            if (!$objProduct->active) {
                $objGlobal = new WkProductSubscriptionGlobal();
                $objGlobal->disableProductSubscription($idProduct);
                $objGlobal->cancelAllSubscriptions($idProduct);
            }
        }
    }

    public function hookActionProductDelete($params)
    {
        $idProduct = (int) $params['id_product'];
        if ($idProduct) {
            // Check if this product is already subscription
            if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)) {
                $objGlobal = new WkProductSubscriptionGlobal();
                $objGlobal->disableProductSubscription($idProduct);
                $objGlobal->cancelAllSubscriptions($idProduct, true);
            }
        }
    }

    public function hookActionObjectCombinationDeleteAfter($params)
    {
        $idProduct = (int) $params['object']->id_product;
        $idProductAttr = (int) $params['object']->id;
        if ($idProduct && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)) {
            $objGlobal = new WkProductSubscriptionGlobal();
            $objGlobal->cancelAllSubscriptions($idProduct, true, $idProductAttr);
        }
    }

    /**
     * Create admin tabs
     */
    public function callInstallTab()
    {
        // Parent hidden class
        $this->installTab('AdminWKSubscription', 'Subscription');
        // Main Tab
        $this->installTab('AdminWkSubsModule', 'Subscription', 'AdminWKSubscription');
        // Manage Subscribed Products Tab
        $this->installTab('AdminSubscribedConfig', 'Configuration', 'AdminWkSubsModule');
        // Manage Subscriptions Tab
        $this->installTab('AdminSubscriptions', 'Products', 'AdminWkSubsModule');
        // Manage Subscribers Tab
        $this->installTab('AdminSubscribers', 'Subscribers', 'AdminWkSubsModule');
        // Manage Subscriber Orders Tab
        $this->installTab('AdminSubscriberOrders', 'Subscriber Orders', 'AdminWkSubsModule');
        // Manage Subscriber Scheduled Order Tab
        $this->installTab('AdminScheduledOrders', 'Scheduled Orders', 'AdminWkSubsModule');
        // Manage Subscriber Subscriptions Tab
        $this->installTab('AdminCustomerSubscription', 'Subscription by Customers', 'AdminWkSubsModule');

        return true;
    }

    public function installTab($className, $tabName, $tabParentName = false)
    {
        // Create instance of Tab class
        $tab = new Tab();
        $tab->name = [];
        $tab->class_name = $className;
        $tab->active = true;
        // Set tab name for all installed languages
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $tabName;
        }

        // Set parent tab ID
        if ($tabParentName) {
            $tab->id_parent = (int) Tab::getIdFromClassName($tabParentName);
        } else {
            $tab->id_parent = 0;
        }

        if ($className == 'AdminWkSubsModule') {
            $tab->icon = 'today';
        }

        // Assing module name
        $tab->module = $this->name;

        return $tab->add();
    }

    /**
     * Uninstall admin tabs
     *
     * @return bool
     */
    public function uninstallTab()
    {
        $moduleTabs = Tab::getCollectionFromModule($this->name);
        if (!empty($moduleTabs)) {
            foreach ($moduleTabs as $moduleTab) {
                $moduleTab->delete();
            }
        }

        return true;
    }

    /**
     * Load module configuration form
     */
    public function getContent()
    {
        $params = ['configure' => $this->name];
        $moduleAdminLink = Context::getContext()->link->getAdminLink('AdminModules', true, [], $params);
        Media::addJsDef([
            'module_token' => $this->secure_key,
        ]);
        // cross selling banner
        Media::addJsDef([
            'wkModuleAddonKey' => $this->module_key,
            'wkModuleAddonsId' => 49381,
            'wkModuleTechName' => $this->name,
            'wkModuleDoc' => file_exists(_PS_MODULE_DIR_ . $this->name . '/docs/doc_en.pdf'),
        ]);
        $this->context->controller->addJs('https://prestashop.webkul.com/crossselling/wkcrossselling.min.js?t=' . time());

        if (Tools::isSubmit('submitGeneral')
            || Tools::isSubmit('submitDisplay')
            || Tools::isSubmit('submitPayment')
            || Tools::isSubmit('submitCron')
            || Tools::isSubmit('submitEmail')
        ) {
            $this->postValidation();
            if (!count($this->postErrors)) {
                $this->postProcess();
            } else {
                $this->output .= $this->displayError($this->postErrors);
            }
        }
        $this->context->controller->addCSS([
            $this->_path . 'views/css/admin/menu.css',
        ]);
        Media::addJsDef([
            'wk_display_otp' => (int) Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE'),
            'wk_display_subs_msg' => (int) Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG'),
            'wk_display_offer_msg' => (int) Configuration::get('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG'),
            'wk_send_email' => (int) Configuration::get('WK_SUBSCRIPTION_SEND_EMAIL'),
        ]);
        $this->context->controller->addJS([
            $this->_path . 'views/js/admin/vue.min.js',
            $this->_path . 'views/js/admin/menu.js',
            $this->_path . 'views/js/wkproductsubscription_back.js',
        ]);
        // get current page
        $currentPage = 'general';
        $page = Tools::getValue('page');
        if (!empty($page)) {
            $currentPage = Tools::getValue('page');
        }

        $this->context->smarty->assign([
            'module_version' => $this->version,
            'ps_base_dir' => Tools::getHttpHost(true),
            'currentPage' => $currentPage,
            'module_dir' => $this->_path,
            'ps_module_dir' => _PS_MODULE_DIR_,
            'moduleAdminLink' => $moduleAdminLink,
            'module_name' => $this->name,
            'generalSettingForm' => $this->renderGeneralSettingForm(),
            'displaySettingForm' => $this->renderDisplaySettingForm(),
            'paymentSettingForm' => $this->renderPaymentSettingForm(),
            'addonSettingForm' => $this->renderAddonSettingForm(),
            'cronSettingForm' => $this->renderCronSettingForm(),
            'emailSettingForm' => $this->renderEmailSettingForm(),
            'docPath' => $this->_path . 'docs/doc_en.pdf',
        ]);

        $this->output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/menu.tpl');

        return $this->output;
    }

    public function renderEmailSettingForm()
    {
        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('Email'),
                'icon' => 'icon-envelope',
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_EMAIL',
                    'label' => $this->l('Send subscription email notifications'),
                    'hint' => $this->l('If yes, admin and subscribers will get email notifications related to subscriptions.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_CREATE_EMAIL',
                    'label' => $this->l('On create'),
                    'hint' => $this->l('If yes, subscribers will get email when subscribed a product.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_CREATE_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_CREATE_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL',
                    'label' => $this->l('On update'),
                    'hint' => $this->l('If yes, subscribers will get email when subscription is updated.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL',
                    'label' => $this->l('On cancel'),
                    'hint' => $this->l('If yes, subscribers will get email when subscription is canceled.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_RENEW_EMAIL',
                    'label' => $this->l('On renew'),
                    'hint' => $this->l('If yes, subscribers will get email before subscription will renew.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_RENEW_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_RENEW_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL',
                    'label' => $this->l('On pause'),
                    'hint' => $this->l('If yes, subscribers will get email on pause subscription.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SEND_RESUME_EMAIL',
                    'label' => $this->l('On resume'),
                    'hint' => $this->l('If yes, subscribers will get email on resume subscription.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_RESUME_EMAIL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SEND_RESUME_EMAIL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
            ],
            'submit' => [
                'name' => 'submitEmailSettings',
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right',
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitEmail';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=email';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => $this->getConfigEmailFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function getConfigEmailFormValues()
    {
        $keys = [
            'WK_SUBSCRIPTION_SEND_EMAIL',
            'WK_SUBSCRIPTION_SEND_CREATE_EMAIL',
            'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL',
            'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL',
            'WK_SUBSCRIPTION_SEND_RENEW_EMAIL',
            'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL',
            'WK_SUBSCRIPTION_SEND_RESUME_EMAIL',
        ];
        $formValues = [];
        foreach ($keys as $key) {
            $formValues[$key] = Configuration::get($key);
        }

        return $formValues;
    }

    public function renderGeneralSettingForm()
    {
        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('General'),
                'icon' => 'icon-cogs',
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_CAN_CANCEL',
                    'label' => $this->l('Cancel subscription'),
                    'hint' => $this->l('If yes, subscribers can cancel their subscription.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_CANCEL_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_CANCEL_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_CAN_UPDATE',
                    'label' => $this->l('Update subscription quantity'),
                    'hint' => $this->l('If yes, subscribers can update their subscription product quantity.'),
                    'desc' => $this->l('Enable this setting if your payment gateway support update feature.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_UPDATE_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_UPDATE_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_CAN_PAUSE',
                    'label' => $this->l('Pause subscription'),
                    'hint' => $this->l('If yes, subscribers can pause their subscription for no of days.'),
                    'desc' => $this->l('Enable this setting if your payment gateway support pause feature.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_PAUSE_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_PAUSE_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_CAN_RESUME',
                    'label' => $this->l('Resume subscription'),
                    'hint' => $this->l('If yes, subscribers can resume their subscription.'),
                    'desc' => $this->l('Enable this setting if your payment gateway support resume feature.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_RESUME_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_RESUME_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE',
                    'label' => $this->l('Frequency update subscription'),
                    'hint' => $this->l('If yes, subscribers can update frequency of their subscription.'),
                    'desc' => $this->l('Enable this setting if your payment gateway support frequency update feature.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK',
                    'label' => $this->l('Apply virtual/pack product for subscription'),
                    'hint' => $this->l('If yes, subscribers can subscribe virtual as well as pack of product.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION',
                    'disabled' => (Module::isEnabled('wkcustomerwallet') ? false : true),
                    'label' => $this->l('Allow multiple normal product with single subscription product in a single cart'),
                    'hint' => $this->l('If yes, we will use PrestaShop order split feature and your payment gateway should support this feature.'),
                    'desc' => $this->l('If yes, we will use PrestaShop order split feature and your payment gateway should support this feature.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_VOUCHER_APPLY',
                    'label' => $this->l('Apply voucher on subscription cart'),
                    'hint' => $this->l('If yes, Voucher can added to subscription product cart.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_VOUCHER_APPLY_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_VOUCHER_APPLY_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'name' => 'WK_SUBSCRIPTION_SHIPPING_FREE',
                    'label' => $this->l('Allow free shipping for subscription product'),
                    'hint' => $this->l('If yes, free shipping applied to the cart if subscription product added.'),
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_SHIPPING_FREE_on',
                            'value' => true,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_SHIPPING_FREE_off',
                            'value' => false,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
            ],
            'submit' => [
                'name' => 'submitGeneralSettings',
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right',
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitGeneral';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=general';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => $this->getConfigGeneralFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function getConfigGeneralFormValues()
    {
        $keys = [
            'WK_SUBSCRIPTION_CAN_CANCEL',
            'WK_SUBSCRIPTION_CAN_UPDATE',
            'WK_SUBSCRIPTION_CAN_PAUSE',
            'WK_SUBSCRIPTION_CAN_RESUME',
            'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE',
            'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK',
            'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION',
            'WK_SUBSCRIPTION_VOUCHER_APPLY',
            'WK_SUBSCRIPTION_SHIPPING_FREE',
        ];
        $formValues = [];
        foreach ($keys as $key) {
            $formValues[$key] = Configuration::get($key);
        }

        return $formValues;
    }

    public function renderDisplaySettingForm()
    {
        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('Display'),
                'icon' => 'icon-image',
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'label' => $this->l('Display subscribe button in quick view'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, subscription option will be displayed in quick view popup.'),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Display most used frequency message'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, a message will display for the most used frequencies of the proudct.'),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Display no subscribers yet message'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_NO_SUBS',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_NO_SUBS_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_NO_SUBS_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, a message will display if no subscriber yet for the proudct.'),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Allow customer to select delivery date'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, customer can select first delivery date for the subscription product.'),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Display one time purchase option'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, customer can purchase subscription product as a normal product.'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('One time purchase button text'),
                    'name' => 'WK_SUBSCRIPTION_OTP_BTN_TXT',
                    'required' => true,
                    'class' => 'form-control',
                    'hint' => $this->l('Enter the one time purchase button text.'),
                    'lang' => true,
                ],
                [
                    'type' => 'select',
                    'name' => 'WK_DEFAULT_SELECT_ON_PRODUCTPAGE',
                    'label' => $this->l('Default selected option'),
                    'hint' => $this->l('Please select the default selected option on the product page initially.'),
                    'class' => 'input fixed-width-xxl',
                    'options' => [
                        'query' => [
                            [
                                'id' => 0,
                                'name' => $this->l('One-time purchase'),
                            ],
                            [
                                'id' => 1,
                                'name' => $this->l('Subscribe'),
                            ],
                        ],
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Subscribe button text'),
                    'name' => 'WK_SUBSCRIPTION_SUBS_BTN_TXT',
                    'required' => true,
                    'class' => 'form-control',
                    'hint' => $this->l('Enter the subscribe button text.'),
                    'lang' => true,
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Display subscription message'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, you can display a custom message on the subscription product page.'),
                ],
                [
                    'label' => $this->l('Subscription message'),
                    'hint' => $this->l('It will be displayed on details page of the subscription product.'),
                    'name' => 'WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE',
                    'lang' => true,
                    'type' => 'textarea',
                    'autoload_rte' => true,
                    'required' => true,
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Display subscription offer message'),
                    'name' => 'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id' => 'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                    'hint' => $this->l('If yes, you can display a discount message on the subscription product page.'),
                ],
                [
                    'label' => $this->l('Subscription offer message'),
                    'hint' => $this->l('It will be displayed on details page of the discounted subscription product.'),
                    'name' => 'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE',
                    'lang' => true,
                    'type' => 'textarea',
                    'autoload_rte' => true,
                    'required' => true,
                ],
                [
                    'type' => 'html',
                    'name' => 'html_data',
                    'html_content' => $this->context->smarty->fetch(
                        _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/place_holder.tpl'
                    ),
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'name' => 'submitDisplaySettings',
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitDisplay';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=display';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => $this->getConfigDisplayFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function getConfigDisplayFormValues()
    {
        $subsBtnText = [];
        $otpBtnText = [];
        $subsMsg = [];
        $offerMsg = [];
        $formValues = [];
        foreach (Language::getLanguages(false) as $lang) {
            $subsBtnText[$lang['id_lang']] = Configuration::get('WK_SUBSCRIPTION_SUBS_BTN_TXT', $lang['id_lang']);
            $otpBtnText[$lang['id_lang']] = Configuration::get('WK_SUBSCRIPTION_OTP_BTN_TXT', $lang['id_lang']);
            $subsMsg[$lang['id_lang']] = Configuration::get('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE', $lang['id_lang']);
            $offerMsg[$lang['id_lang']] = Configuration::get('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE', $lang['id_lang']);
        }
        $formValues = [
            'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV')
            ),
            'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')
            ),
            'WK_DEFAULT_SELECT_ON_PRODUCTPAGE' => Tools::getValue(
                'WK_DEFAULT_SELECT_ON_PRODUCTPAGE',
                Configuration::get('WK_DEFAULT_SELECT_ON_PRODUCTPAGE')
            ),
            'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ')
            ),
            'WK_SUBSCRIPTION_DISPLAY_NO_SUBS' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_NO_SUBS',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_NO_SUBS')
            ),
            'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')
            ),
            'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')
            ),
            'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG' => Tools::getValue(
                'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG',
                Configuration::get('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG')
            ),
            'WK_SUBSCRIPTION_SUBS_BTN_TXT' => $subsBtnText,
            'WK_SUBSCRIPTION_OTP_BTN_TXT' => $otpBtnText,
            'WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE' => $subsMsg,
            'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE' => $offerMsg,
        ];

        return $formValues;
    }

    public function renderAddonSettingForm()
    {
        $paymentMethods = WkProductSubscriptionGlobal::getAllSupportedModuleList();
        foreach ($paymentMethods as $key => $module) {
            if ($module == 'wkstripepayment') {
                $paymentMethods[$key] = [
                    'name' => $this->l('Stripe Payment Gateway'),
                    'tech_name' => 'wkstripepayment',
                    'description' => $this->l('Stripe payment gateway with refund and recurring system'),
                    'logo' => _MODULE_DIR_ . $this->name . '/views/img/addons/wkstripepayment_logo.png',
                    'installed' => Module::isInstalled($module),
                    'addon_link' => 'https://addons.prestashop.com/en/other-payment-methods/24520-stripe-recurring-payment-sca-ready-subscription.html',
                ];
            } elseif ($module == 'psadyenpayment') {
                $paymentMethods[$key] = [
                    'name' => $this->l('Adyen Payment Gateway'),
                    'tech_name' => 'psadyenpayment',
                    'description' => $this->l('Adyen as your payment method'),
                    'logo' => _MODULE_DIR_ . $this->name . '/views/img/addons/psadyenpayment_logo.png',
                    'installed' => Module::isInstalled($module),
                    'addon_link' => 'https://addons.prestashop.com/en/other-payment-methods/24428-adyen-payment-with-recurring-and-refund-sca-ready.html',
                ];
            } elseif ($module == 'wkwepay') {
                $paymentMethods[$key] = [
                    'name' => $this->l('WePay checkout'),
                    'tech_name' => 'wkwepay',
                    'description' => $this->l('WePay payment gateway'),
                    'logo' => _MODULE_DIR_ . $this->name . '/views/img/addons/wkwepay_logo.png',
                    'installed' => Module::isInstalled($module),
                    'addon_link' => 'https://addons.prestashop.com/en/other-payment-methods/21324-wepay-payment-gateway.html#specifications',
                ];
            } elseif ($module == 'wkpaypalsubscription') {
                $paymentMethods[$key] = [
                    'name' => $this->l('PayPal subscription'),
                    'tech_name' => 'wkpaypalsubscription',
                    'description' => $this->l('Allows customers to subscribe plans via PayPal'),
                    'logo' => _MODULE_DIR_ . $this->name . '/views/img/addons/wkpaypalsubscription_logo.png',
                    'installed' => Module::isInstalled($module),
                    'addon_link' => 'https://addons.prestashop.com/en/recurring-payment-subscription/87028-paypal-recurring-payment-gateway.html',
                ];
            } elseif ($module == 'wkcustomerwallet') {
                $paymentMethods[$key] = [
                    'name' => $this->l('Customer Wallet'),
                    'tech_name' => 'wkcustomerwallet',
                    'description' => $this->l('Allow customer(s) to add money in wallet and pay with wallet also.'),
                    'logo' => _MODULE_DIR_ . $this->name . '/views/img/addons/wkcustomerwallet_logo.png',
                    'installed' => Module::isInstalled($module),
                    'addon_link' => 'https://addons.prestashop.com/en/payment-card-wallet/26851-customer-wallet-system.html',
                ];
            } else {
                unset($paymentMethods[$key]);
            }
        }
        $this->context->smarty->assign([
            'paymentMethods' => $paymentMethods,
        ]);
        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('Compatible payment addons'),
                'icon' => 'icon-puzzle-piece',
            ],
            'input' => [
                [
                    'type' => 'html',
                    'name' => 'html_data',
                    'html_content' => $this->context->smarty->fetch(
                        _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/tabs/addon_setting.tpl'
                    ),
                ],
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPayment';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=payment';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => [],
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function renderPaymentSettingForm()
    {
        $paymentMethods = [];
        $paymentModes = PaymentModule::getInstalledPaymentModules();
        foreach ($paymentModes as $module) {
            $moduleObj = Module::getInstanceById($module['id_module']);
            $paymentMethods[$moduleObj->id] = [
                'id' => $moduleObj->id,
                'name' => $moduleObj->displayName,
                'tech_name' => $moduleObj->name,
                'description' => $moduleObj->description,
                'logo' => _MODULE_DIR_ . $moduleObj->name . '/logo.png',
                'status' => $moduleObj->active,
                'version' => $moduleObj->version,
                'author' => $moduleObj->author,
                'enabled' => 0,
            ];
        }

        $allowedPayments = json_decode(Configuration::get('WK_SUBSCRIPTION_PAYMENT_METHODS'), true);
        if ($allowedPayments && $paymentMethods) {
            foreach ($paymentMethods as $key => $sellerDetailsVal) {
                if (in_array($sellerDetailsVal['id'], $allowedPayments)) {
                    $paymentMethods[$key]['enabled'] = 1;
                } else {
                    $paymentMethods[$key]['enabled'] = 0;
                }
            }
        }
        $this->context->smarty->assign([
            'paymentMethods' => $paymentMethods,
        ]);
        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('Payment'),
                'icon' => 'icon-credit-card',
            ],
            'input' => [
                [
                    'type' => 'html',
                    'name' => 'html_data',
                    'html_content' => $this->context->smarty->fetch(
                        _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/tabs/payment_setting.tpl'
                    ),
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'name' => 'submitPaymentSettings',
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPayment';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=payment';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => [],
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function renderCronSettingForm()
    {
        $cronLink = $this->context->link->getModuleLink(
            'wkproductsubscription',
            'cron',
            [
                'token' => Configuration::get('WK_SUBSCRIPTION_CRON_TOKEN'),
            ]
        );

        $this->context->smarty->assign([
            'cron_link' => $cronLink,
        ]);

        $fieldsForm['form'] = [
            'legend' => [
                'title' => $this->l('CRON'),
                'icon' => 'icon-cog',
            ],
            'description' => $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->name . '/views/templates/admin/_partials/cron_block.tpl'
            ),
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Create automatic order prior to delivery date'),
                    'name' => 'WK_SUBSCRIPTION_CRON_PRIOR_DAYS',
                    'class' => 'fixed-width-lg',
                    'required' => true,
                    'disabled' => (count(WkProductSubscriptionGlobal::hasActiveSubscriptions()) > 0) ? true : false,
                    'prefix' => $this->l('Days'),
                    'desc' => $this->l('Enter the number of days to create automatic order prior to delivery date.') .
                    ' ' . $this->l('You cannot edit this field if any subscription is active.'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Token'),
                    'name' => 'WK_SUBSCRIPTION_CRON_TOKEN',
                    'required' => true,
                    'class' => 'fixed-width-xxl',
                    'hint' => $this->l('Update secure string to protect cron url.'),
                    'desc' => $this->l('After updating cron token, you have to update cron link in cron task manager.'),
                ],
                [
                    'type' => 'select',
                    'name' => 'WK_SUBSCRIPTION_CRON_ORDER_STATUS',
                    'label' => $this->l('Cron order status'),
                    'hint' => $this->l('Select the order status that will be applied on cron order.'),
                    'class' => 'input fixed-width-xxl',
                    'options' => [
                        'query' => OrderState::getOrderStates((int) $this->context->employee->id_lang),
                        'id' => 'id_order_state',
                        'name' => 'name',
                    ],
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'name' => 'submitCronSettings',
            ],
        ];

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitCron';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&page=cron';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => $this->getConfigCronFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fieldsForm]);
    }

    public function getConfigCronFormValues()
    {
        $keys = [
            'WK_SUBSCRIPTION_CRON_PRIOR_DAYS',
            'WK_SUBSCRIPTION_CRON_TOKEN',
            'WK_SUBSCRIPTION_CRON_ORDER_STATUS',
        ];
        $formValues = [];
        foreach ($keys as $key) {
            $formValues[$key] = Configuration::get($key);
        }

        return $formValues;
    }

    public function postValidation()
    {
        if (Tools::isSubmit('submitDisplay')) {
            foreach (Language::getLanguages(false) as $lang) {
                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')) {
                    if (!empty(trim(Tools::getValue('WK_SUBSCRIPTION_OTP_BTN_TXT_' . $lang['id_lang'])))) {
                        if (!Validate::isName(
                            trim(Tools::getValue('WK_SUBSCRIPTION_OTP_BTN_TXT_' . $lang['id_lang']))
                        )
                        ) {
                            $this->postErrors[] = sprintf(
                                $this->l('Invalid one time purchase button text for %s language.'),
                                $lang['name']
                            );
                            break;
                        }

                        if (Tools::strlen(
                            trim(Tools::getValue('WK_SUBSCRIPTION_OTP_BTN_TXT_' . $lang['id_lang']))
                        ) > 50
                        ) {
                            $this->postErrors[] = sprintf(
                                $this->l('One time purchase text should not greater than 50 characters for %s language.'),
                                $lang['name']
                            );
                            break;
                        }
                    } else {
                        $this->postErrors[] = sprintf(
                            $this->l('One time purchase button text required for %s language.'),
                            $lang['name']
                        );
                    }
                }
                if (!empty(trim(Tools::getValue('WK_SUBSCRIPTION_SUBS_BTN_TXT_' . $lang['id_lang'])))) {
                    if (!Validate::isName(trim(Tools::getValue('WK_SUBSCRIPTION_SUBS_BTN_TXT_' . $lang['id_lang'])))) {
                        $this->postErrors[] = sprintf(
                            $this->l('Invalid subscribe button text for %s language.'),
                            $lang['name']
                        );
                        break;
                    }

                    if (Tools::strlen(trim(Tools::getValue('WK_SUBSCRIPTION_SUBS_BTN_TXT_' . $lang['id_lang']))) > 50) {
                        $this->postErrors[] = sprintf(
                            $this->l('Subscribe button text should not greater than 50 characters for %s language.'),
                            $lang['name']
                        );
                        break;
                    }
                } else {
                    $this->postErrors[] = sprintf(
                        $this->l('Subscribe button text required for %s language.'),
                        $lang['name']
                    );
                }

                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')) {
                    if (!empty(trim(Tools::getValue('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE_' . $lang['id_lang'])))) {
                        if (!Validate::isCleanHtml(
                            trim(Tools::getValue('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE_' . $lang['id_lang']))
                        )
                        ) {
                            $this->postErrors[] = sprintf(
                                $this->l('Invalid subscription message for %s language.'),
                                $lang['name']
                            );
                            break;
                        }
                    } else {
                        $this->postErrors[] = sprintf(
                            $this->l('Subscription message required for %s language.'),
                            $lang['name']
                        );
                    }
                }

                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG')) {
                    if (!empty(trim(Tools::getValue('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE_' . $lang['id_lang'])))) {
                        if (!Validate::isCleanHtml(
                            trim(Tools::getValue('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE_' . $lang['id_lang']))
                        )
                        ) {
                            $this->postErrors[] = sprintf(
                                $this->l('Invalid subscription offer message for %s language.'),
                                $lang['name']
                            );
                            break;
                        }
                    } else {
                        $this->postErrors[] = sprintf(
                            $this->l('Subscription offer message required for %s language.'),
                            $lang['name']
                        );
                    }
                }
            }
        } elseif (Tools::isSubmit('submitCron')) {
            if (count(WkProductSubscriptionGlobal::hasActiveSubscriptions()) == 0) {
                if (empty(trim(Tools::getValue('WK_SUBSCRIPTION_CRON_PRIOR_DAYS')))) {
                    $this->postErrors[] = $this->l('Number of days field is required in cron setting.');
                } elseif (!Validate::isUnsignedInt(Tools::getValue('WK_SUBSCRIPTION_CRON_PRIOR_DAYS'))) {
                    $this->postErrors[] = $this->l('Invalid number of days value in cron setting.');
                }
            }
            if (empty(trim(Tools::getValue('WK_SUBSCRIPTION_CRON_TOKEN')))) {
                $this->postErrors[] = $this->l('Cron token field is required.');
            } elseif (!Validate::isModuleName(trim(Tools::getValue('WK_SUBSCRIPTION_CRON_TOKEN')))) {
                $this->postErrors[] = $this->l('Cron token must be alphanumeric without special character & space.');
            }
        }
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitGeneral')) {
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CAN_CANCEL',
                Tools::getValue('WK_SUBSCRIPTION_CAN_CANCEL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CAN_UPDATE',
                Tools::getValue('WK_SUBSCRIPTION_CAN_UPDATE')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CAN_PAUSE',
                Tools::getValue('WK_SUBSCRIPTION_CAN_PAUSE')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CAN_RESUME',
                Tools::getValue('WK_SUBSCRIPTION_CAN_RESUME')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE',
                Tools::getValue('WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK',
                Tools::getValue('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION',
                Tools::getValue('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_VOUCHER_APPLY',
                Tools::getValue('WK_SUBSCRIPTION_VOUCHER_APPLY')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SHIPPING_FREE',
                Tools::getValue('WK_SUBSCRIPTION_SHIPPING_FREE')
            );
            $this->output .= $this->displayConfirmation($this->l('Updated successfully.'));
        } elseif (Tools::isSubmit('submitDisplay')) {
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')
            );
            Configuration::updateValue(
                'WK_DEFAULT_SELECT_ON_PRODUCTPAGE',
                Tools::getValue('WK_DEFAULT_SELECT_ON_PRODUCTPAGE')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_NO_SUBS',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_NO_SUBS')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG',
                Tools::getValue('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG')
            );
            $langArr = [];
            $langOtpArr = [];
            $langMsgArr = [];
            $langOfferArr = [];
            foreach (Language::getLanguages(false) as $lang) {
                if (!empty(trim(Tools::getValue('WK_SUBSCRIPTION_SUBS_BTN_TXT_' . $lang['id_lang'])))) {
                    $langArr[$lang['id_lang']] = trim(
                        Tools::getValue('WK_SUBSCRIPTION_SUBS_BTN_TXT_' . $lang['id_lang'])
                    );
                }

                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')) {
                    $langOtpArr[$lang['id_lang']] = trim(
                        Tools::getValue('WK_SUBSCRIPTION_OTP_BTN_TXT_' . $lang['id_lang'])
                    );
                }

                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_SUBS_MSG')) {
                    $langMsgArr[$lang['id_lang']] = trim(
                        Tools::getValue('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE_' . $lang['id_lang'])
                    );
                }

                if (Tools::getValue('WK_SUBSCRIPTION_DISPLAY_OFFER_MSG')) {
                    $langOfferArr[$lang['id_lang']] = trim(
                        Tools::getValue('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE_' . $lang['id_lang'])
                    );
                }
            }
            Configuration::updateValue('WK_SUBSCRIPTION_SUBS_BTN_TXT', $langArr);
            Configuration::updateValue('WK_SUBSCRIPTION_OTP_BTN_TXT', $langOtpArr);
            Configuration::updateValue('WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE', $langMsgArr, true);
            Configuration::updateValue('WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE', $langOfferArr, true);
            $this->output .= $this->displayConfirmation($this->l('Updated successfully.'));
        } elseif (Tools::isSubmit('submitPayment')) {
            $paymentModes = PaymentModule::getInstalledPaymentModules();
            $enabledPayments = [];
            foreach ($paymentModes as $module) {
                $moduleObj = Module::getInstanceById($module['id_module']);
                if (Tools::getIsset('paymentMethods_' . $moduleObj->id)
                    && (Tools::getValue('paymentMethods_' . $moduleObj->id) == 1)
                ) {
                    $enabledPayments[] = $moduleObj->id;
                }
            }
            Configuration::updateValue(
                'WK_SUBSCRIPTION_PAYMENT_METHODS',
                json_encode($enabledPayments)
            );
            $this->output .= $this->displayConfirmation($this->l('Updated successfully.'));
        } elseif (Tools::isSubmit('submitCron')) {
            if (count(WkProductSubscriptionGlobal::hasActiveSubscriptions()) == 0) {
                Configuration::updateValue(
                    'WK_SUBSCRIPTION_CRON_PRIOR_DAYS',
                    (int) Tools::getValue('WK_SUBSCRIPTION_CRON_PRIOR_DAYS')
                );
            }
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CRON_TOKEN',
                trim(Tools::getValue('WK_SUBSCRIPTION_CRON_TOKEN'))
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_CRON_ORDER_STATUS',
                trim(Tools::getValue('WK_SUBSCRIPTION_CRON_ORDER_STATUS'))
            );
            $this->output .= $this->displayConfirmation($this->l('Updated successfully.'));
        } elseif (Tools::isSubmit('submitEmail')) {
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_CREATE_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_CREATE_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_UPDATE_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_CANCEL_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_RENEW_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_RENEW_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_PAUSE_EMAIL')
            );
            Configuration::updateValue(
                'WK_SUBSCRIPTION_SEND_RESUME_EMAIL',
                Tools::getValue('WK_SUBSCRIPTION_SEND_RESUME_EMAIL')
            );
            $this->output .= $this->displayConfirmation($this->l('Updated successfully.'));
        }
    }

    public function hookActionValidateOrder($params)
    {
        $idCustomer = $params['order']->id_customer;
        $idCart = $params['order']->id_cart;
        $idOrder = $params['order']->id;
        $idShop = $params['order']->id_shop;
        $idLang = $params['order']->id_lang;
        $idCurrency = $params['order']->id_currency;
        $idCarrier = $params['order']->id_carrier;
        $paymentMethod = $params['order']->payment;
        $paymentModule = $params['order']->module;
        $idAddressDelivery = $params['order']->id_address_delivery;
        $idAddressInvoice = $params['order']->id_address_invoice;
        $objOrderDetail = new OrderDetail();
        $orderData = $objOrderDetail->getList($idOrder);
        $objSubGlobal = new WkProductSubscriptionGlobal();
        $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');
        if (!empty($orderData)) {
            foreach ($orderData as $data) {
                $idAttrib = $data['product_attribute_id'];
                $idProduct = $data['product_id'];
                $boughtQuantity = $data['product_quantity'];
                $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idAttrib, true);
                if ($isCartExist
                    && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct, $idAttrib)
                ) {
                    $idSubscriber = WkProductSubscriptionGlobal::isSubscriber($idCustomer);
                    if (!$idSubscriber) {
                        $objSub = new WkSubscriberModal();
                        $objSub->id_customer = (int) $idCustomer;
                        $objSub->id_shop = (int) $this->context->shop->id;
                        $objSub->id_shop_group = (int) Shop::getContextShopGroupID();
                        $objSub->active = 1;
                        if ($objSub->save()) {
                            $idSubscriber = $objSub->id;
                        }
                    }

                    $subMod = new WkSubscriberProductModal();
                    $subMod->id_subscriber = (int) $idSubscriber;
                    $subMod->id_lang = (int) $idLang;

                    $subMod->id_shop = (int) $this->context->shop->id;
                    $subMod->id_shop_group = (int) Shop::getContextShopGroupID();

                    $firstDelDate = date('Y-m-d');
                    $prodObj = new Product((int) $idProduct);
                    if (!$prodObj->is_virtual) {
                        // Save carrier reference id instead of carrier id
                        $objCarrier = new Carrier((int) $idCarrier);
                        $subMod->id_carrier = (int) $objCarrier->id_reference;
                        $subMod->is_virtual = 0;
                        unset($objCarrier);
                        $firstDelDateStamp = strtotime(date('Y-m-d', strtotime('+' . $wkOrderDays . ' days')));
                        if (!Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')) {
                            $firstDelDate = date('Y-m-d', strtotime('+' . $wkOrderDays . ' days'));
                        } else {
                            $firstDbDelStamp = strtotime($isCartExist['first_delivery_date']);
                            if ($firstDelDateStamp > $firstDbDelStamp) {
                                $firstDelDate = date('Y-m-d', strtotime('+' . $wkOrderDays . ' days'));
                            } else {
                                $firstDelDate = $isCartExist['first_delivery_date'];
                            }
                        }
                    } else {
                        $subMod->is_virtual = 1;
                        $subMod->id_carrier = 0;
                    }
                    $subMod->id_address_delivery = (int) $idAddressDelivery;
                    $subMod->id_address_invoice = (int) $idAddressInvoice;
                    $subMod->id_payment = 0;
                    $subMod->payment_method = $paymentMethod;
                    $subMod->payment_module = $paymentModule;
                    $subMod->payment_response = '';

                    $subMod->id_product = (int) $idProduct;
                    $subMod->quantity = (int) $boughtQuantity;
                    $subMod->base_price = $data['unit_price_tax_excl'];
                    $subMod->unit_price = $data['unit_price_tax_incl'];
                    $subMod->total_price = $data['total_price_tax_incl'];
                    $subMod->discount = $params['order']->total_discounts_tax_incl;
                    $subMod->tax_amount = $data['total_price_tax_incl'] - $data['total_price_tax_excl'];
                    $subMod->id_customization = (int) $data['id_customization'];
                    $subMod->id_product_attribute = (int) $idAttrib;
                    $subMod->frequency = $isCartExist['frequency'];
                    $subMod->order_product_details = json_encode($data);
                    $subMod->cycle = (int) $isCartExist['cycle'];
                    $subMod->first_delivery_date = $firstDelDate;
                    $subMod->first_order_date = date('Y-m-d');
                    $subMod->first_order_id = (int) $idOrder;
                    if (!$prodObj->is_virtual) {
                        $subMod->shipping_charge = $params['order']->total_shipping_tax_incl;
                    } else {
                        $subMod->shipping_charge = 0;
                    }
                    $subMod->total_amount = $params['order']->total_paid_tax_incl;
                    $subMod->id_currency = (int) $idCurrency;
                    $subMod->active = 1;
                    if ($subMod->save()) {
                        $idSubscription = (int) $subMod->id;
                        $idSchedule = $objSubGlobal->createOrderSchedule(
                            $idSubscription,
                            $firstDelDate
                        );
                        $subObj = new WkSubscriberOrderModel();
                        $subObj->id_order = (int) $idOrder;
                        $subObj->id_shop = (int) $this->context->shop->id;
                        $subObj->id_shop_group = (int) Shop::getContextShopGroupID();
                        $subObj->id_cart = (int) $idCart;
                        $subObj->id_subscription = (int) $idSubscription;
                        $subObj->id_schedule = (int) $idSchedule;
                        if ($subObj->save()) {
                            // Update status in order schedule table
                            $scheudleObj = new WkSubscriberScheduleModel((int) $idSchedule);
                            $scheudleObj->is_order_created = 1;
                            $scheudleObj->save();
                        }
                        $objSubGlobal->sendSubscriptionCreationMail((int) $idSubscription);
                        if ($paymentModule == 'wkstripepayment'
                            && WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
                        ) {
                            $paymentData = WkSubscriptionStripe::getSubscriptionDetailsByCartId(
                                $idCart,
                                $idProduct,
                                $idAttrib
                            );

                            if ($paymentData) {
                                $subMod1 = new WkSubscriberProductModal((int) $idSubscription);
                                $subMod1->payment_response = json_encode($paymentData);
                                $subMod1->update();
                            }

                            WkSubscriptionStripe::deactivateStripeProduct(
                                $idCart,
                                $idProduct,
                                $idAttrib
                            );
                        }

                        if ($paymentModule == 'psadyenpayment'
                            && WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
                        ) {
                            $adyenPlanName = 'PLAN_' . $idCart . '_' . $isCartExist['frequency'] . '_' . $isCartExist['cycle'];

                            if ($isExists = WkSubscriptionAdyen::checkIfPlanExists($adyenPlanName)) {
                                WkSubscriptionAdyen::deactivatePlanProduct($isExists['id_adyen_plan']);
                                $paymentData = WkSubscriptionAdyen::getAdyenSubscriptionDetails(
                                    $isExists['id_adyen_plan'],
                                    $idOrder,
                                    $idProduct
                                );
                                if ($paymentData) {
                                    $subMod1 = new WkSubscriberProductModal((int) $idSubscription);
                                    $subMod1->payment_response = json_encode($paymentData);
                                    $subMod1->update();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function getSubscriptionOrderDetails($idOrder)
    {
        $subscriptions = [];
        if ($idOrder && WkProductSubscriptionGlobal::isSubscriptionOrder((int) $idOrder)) {
            // $objOrder = new Order((int)$idOrder);
            $objOrderDetail = new OrderDetail();
            $orderData = $objOrderDetail->getList($idOrder);
            $objSubGlobal = new WkProductSubscriptionGlobal();
            foreach ($orderData as $data) {
                $idAttrib = $data['product_attribute_id'];
                $idProduct = $data['product_id'];
                $hasSubscription = $objSubGlobal->getSubscriptionDetailsByOrderId($idOrder, $idProduct, $idAttrib);
                if ($hasSubscription) {
                    $subscriptions[] = $hasSubscription;
                }
            }
            if ($subscriptions) {
                $dailyString = $this->l('Every %d day');
                $everyDayString = $this->l('Everyday');
                $weeklyString = $this->l('Every %d week');
                $everyWeekString = $this->l('Every week');
                $monthlyString = $this->l('Every %d month');
                $everyMonthString = $this->l('Every month');
                $yearlyString = $this->l('Every %d year');
                $everyYearString = $this->l('Every year');

                // $id_lang = (int)$this->context->language->id;

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

                    $subscriptions[$k]['detail_link_admin'] = $this->context->link->getAdminLink(
                        'AdminCustomerSubscription',
                        true,
                        [],
                        [
                            'id_wk_subscription_subscriber_products' => $sub['id_subscription'],
                            'viewwk_subscription_subscriber_products' => 1,
                        ]
                    );
                }
            }
        }

        return $subscriptions;
    }

    public function hookDisplayOrderConfirmation1()
    {
        $idOrder = (int) Tools::getValue('id_order');
        $objOrder = new Order((int) $idOrder);
        if (Validate::isLoadedObject($objOrder)
            && WkProductSubscriptionGlobal::isSubscriptionOrder((int) $idOrder)
        ) {
            if ($subscriptions = $this->getSubscriptionOrderDetails($idOrder)) {
                $paymentModule = $objOrder->module;
                if ($paymentModule == 'wkpaypalsubscription'
                    && WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()
                    && $subscriptions['0']['payment_response'] == ''
                ) {
                    $payPalSubsId = WkSubscriptionPayPal::getSubscriptionDetailsByCartId(
                        $objOrder->id_cart,
                        $subscriptions['0']['id_product'],
                        $subscriptions['0']['id_product_attribute']
                    );
                    if ($payPalSubsId) {
                        $idSubscription = $subscriptions['0']['id_subscription'];
                        $subMod1 = new WkSubscriberProductModal((int) $idSubscription);
                        $subMod1->payment_response = $payPalSubsId;
                        $subMod1->update();
                    }
                    // Deactivate plan product
                    WkSubscriptionPayPal::deactivateProduct(
                        $objOrder->id_cart,
                        $subscriptions['0']['id_product'],
                        $subscriptions['0']['id_product_attribute']
                    );
                }

                if ($paymentModule == 'wkwepay'
                    && WkProductSubscriptionGlobal::isWkWepayRecurringEnabled()
                    && $subscriptions['0']['payment_response'] == ''
                ) {
                    $idCart = (int) $objOrder->id_cart;
                    $planName = 'PLAN_' . $idCart . '_' . $subscriptions['0']['frequency'] . '_' . $subscriptions['0']['cycle'];
                    if ($isExists = WkSubscriptionWepay::checkIfPlanExists($planName)) {
                        $idSubscription = $subscriptions['0']['id_subscription'];
                        WkSubscriptionWepay::deactivatePlanProduct($isExists['id_wk_wepay_subscription_plan']);
                        $paymentData = WkSubscriptionWepay::getWepaySubscriptionDetails(
                            $isExists['id_wk_wepay_subscription_plan'],
                            $idCart,
                            $subscriptions['0']['id_product']
                        );
                        if ($paymentData) {
                            $subMod1 = new WkSubscriberProductModal((int) $idSubscription);
                            $subMod1->payment_response = json_encode($paymentData);
                            $subMod1->update();
                        }
                    }
                }
                $this->context->smarty->assign([
                    'subscriptionData' => $subscriptions,
                ]);

                return $this->context->smarty->fetch(
                    'module:' . $this->name . '/views/templates/hook/displayOrderConfirmation1.tpl'
                );
            }
        }
    }

    public function hookDisplayCartExtraProductActions($params)
    {
        $idProduct = $params['product']['id_product'];
        $idProductAttribute = $params['product']['id_product_attribute'];
        $idCart = $this->context->cart->id;
        $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
            $idCart,
            $idProduct,
            $idProductAttribute,
            true
        );
        if ($isCartExist) {
            $this->context->smarty->assign([
                'product' => $params['product'],
            ]);

            return $this->context->smarty->fetch(
                'module:' . $this->name . '/views/templates/hook/displayCartExtraProductActions.tpl'
            );
        }
    }

    public function hookActionFrontControllerSetMedia($params)
    {
        // Display on customer account page only
        if ('my-account' == $this->context->controller->php_self
            || 'product' == $this->context->controller->php_self
            || 'category' == $this->context->controller->php_self
            || 'search' == $this->context->controller->php_self
            || 'index' == $this->context->controller->php_self
            || 'cart' == $this->context->controller->php_self
            || 'order' == $this->context->controller->php_self
            || 'order-confirmation' == $this->context->controller->php_self
        ) {
            $this->context->controller->registerJavascript(
                'datepicker-i18n.js',
                'js/jquery/ui/i18n/jquery-ui-i18n.js',
                ['position' => 'bottom', 'priority' => 999]
            );
            $this->context->controller->addJqueryUI('ui.datepicker');

            // Remove subscription button from quick view popup
            Media::addJsDef([
                'wk_subscribe_show_modal_btn' => Configuration::get('WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV'),
                'wkProdSubsAjaxLink' => $this->context->link->getModuleLink('wkproductsubscription', 'ajax', []),
                'wkProdSubToken' => $this->secure_key,
                'wkOrderDays' => (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS'),
                'wkSubCartUpdate' => addslashes($this->l('Subscription details updated successfully.')),
                'wkSubCartConf' => addslashes($this->l('Do you want to remove product as subscription from cart?')),
                'wkStripeInstalled' => WkProductSubscriptionGlobal::isWkStripeRecurringEnabled(),
                'wkAdyenInstalled' => WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled(),
                'wkWepayInstalled' => WkProductSubscriptionGlobal::isWkWepayRecurringEnabled(),
                'wkPayPalInstalled' => WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled(),
            ]);

            if ('order' == $this->context->controller->php_self) {
                $this->context->controller->registerJavascript(
                    'module-wkproductsubscription-checkout-js',
                    'modules/' . $this->name . '/views/js/wksubscription_checkout.js'
                );
            }

            // Register CSS
            $this->context->controller->registerStylesheet(
                'module-wkproductsubscription-css',
                'modules/' . $this->name . '/views/css/wkproductsubscription_front.css',
                [
                    'priority' => 100,
                ]
            );

            // Register JavaScript
            $this->context->controller->registerJavascript(
                'module-wkproductsubscription-js',
                'modules/' . $this->name . '/views/js/wkproductsubscription_front.js',
                [
                    'priority' => 200,
                    'position' => 'bottom',
                ]
            );
        }
    }

    public function hookActionAdminControllerSetMedia()
    {
        if (Module::isEnabled($this->name)) {
            $this->context->controller->addCSS($this->_path . 'views/css/wkproductsubscription_back.css');
            $this->context->controller->addJS($this->_path . 'views/js/wkproductsubscription_back.js');
            $controller = Tools::getValue('controller');
            if ('AdminProducts' == $controller) {
                $this->context->controller->addCSS(
                    [
                        $this->_path . 'views/css/wk_catalog_back.css',
                    ]
                );
                $this->context->controller->addJS(
                    [
                        $this->_path . 'views/js/wk_catalog_back.js',
                    ]
                );
            }
            if ('AdminModules' == $controller) {
                Media::addJsDef([
                    'wkajax_url' => $this->context->link->getAdminLink(
                        'AdminSubscriptions',
                        true
                    ),
                ]);
            }
        }
    }

    // Display user link on top navbar
    public function hookDisplayCustomerAccount()
    {
        $this->context->smarty->assign(
            'mysubscription',
            $this->context->link->getModuleLink('wkproductsubscription', 'mysubscription')
        );

        return $this->context->smarty->fetch('module:' . $this->name . '/views/templates/hook/mysubscription.tpl');
    }

    /**
     * Reset module
     */
    public function reset()
    {
        if (!$this->uninstall()) {
            return false;
        }
        if (!$this->install()) {
            return false;
        }

        return true;
    }

    /**
     * Uninstall Module
     */
    public function uninstall()
    {
        $wkDbObj = new WkProductSubscriptionDb();
        if (!parent::uninstall()
            || !$wkDbObj->deleteTables()
            || !$this->uninstallTab()
            || !$this->deleteConfigKeys()
        ) {
            return false;
        }

        return true;
    }

    /**
     * Delete module config keys
     */
    public function deleteConfigKeys()
    {
        $var = [
            'WK_SUBSCRIPTION_SEND_EMAIL',
            'WK_SUBSCRIPTION_SEND_CREATE_EMAIL',
            'WK_SUBSCRIPTION_SEND_UPDATE_EMAIL',
            'WK_SUBSCRIPTION_SEND_CANCEL_EMAIL',
            'WK_SUBSCRIPTION_SEND_RENEW_EMAIL',
            'WK_SUBSCRIPTION_SEND_PAUSE_EMAIL',
            'WK_SUBSCRIPTION_SEND_RESUME_EMAIL',
            'WK_SUBSCRIPTION_CAN_CANCEL',
            'WK_SUBSCRIPTION_CAN_UPDATE',
            'WK_SUBSCRIPTION_CAN_PAUSE',
            'WK_SUBSCRIPTION_CAN_RESUME',
            'WK_SUBSCRIPTION_CAN_FREQUENCY_UPDATE',
            'WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK',
            'WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION',
            'WK_SUBSCRIPTION_DISPLAY_SUBS_BTN_QV',
            'WK_SUBSCRIPTION_CRON_TOKEN',
            'WK_SUBSCRIPTION_CRON_ORDER_STATUS',
            'WK_SUBSCRIPTION_CRON_PRIOR_DAYS',
            'WK_SUBSCRIPTION_SUBS_BTN_TXT',
            'WK_SUBSCRIPTION_OTP_BTN_TXT',
            'WK_SUBSCRIPTION_PRODUCT_PAGE_MESSAGE',
            'WK_SUBSCRIPTION_PAYMENT_METHODS',
            'WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE',
            'WK_SUBSCRIPTION_DISPLAY_MOST_USED_FREQ',
            'WK_SUBSCRIPTION_DISPLAY_NO_SUBS',
            'WK_SUBSCRIPTION_DISPLAY_SUBS_MSG',
            'WK_SUBSCRIPTION_PRODUCT_OFFER_MESSAGE',
            'WK_SUBSCRIPTION_DISPLAY_OFFER_MSG',
            'WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE',
            'WK_SUBSCRIPTION_VOUCHER_APPLY',
            'WK_SUBSCRIPTION_SHIPPING_FREE',
        ];

        foreach ($var as $key) {
            if (!Configuration::deleteByName($key)) {
                return false;
            }
        }

        return true;
    }

    public static function displayPrice($price, $currency = null)
    {
        $context = Context::getContext();
        $currency = $currency ?: $context->currency;

        if (is_int($currency)) {
            $currency = Currency::getCurrencyInstance($currency);
        }

        if (Tools::version_compare(_PS_VERSION_, '8.0.0', '<')) {
            return Tools::displayPrice((float) $price, $currency);
        }

        if (!is_numeric($price)) {
            return $price;
        }

        $locale = Tools::getContextLocale($context);
        $currencyCode = is_array($currency) ? $currency['iso_code'] : $currency->iso_code;

        return $locale->formatPrice($price, $currencyCode);
    }

    public function installOverrideFiles()
    {
        if (version_compare(_PS_VERSION_, '9.0.0', '>=')) {
            return true;
        }

        $wkSourcePath = _PS_MODULE_DIR_ . $this->name . '/override_content/version8';

        $wkDestinationPath = _PS_MODULE_DIR_ . $this->name . '/override/';

        if (file_exists($wkDestinationPath)) {
            WkProductSubscription::deleteFolderContents($wkDestinationPath);
        } else {
            mkdir($wkDestinationPath, 0755, true);
        }

        WkProductSubscription::copyFolderContents($wkSourcePath, $wkDestinationPath);

        return true;
    }

    /**
     * Recursively deletes all files and folders inside a directory.
     *
     * @param string $dir path to the directory to clean
     *
     * @return void
     */
    public static function deleteFolderContents($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = array_diff(scandir($dir), ['.', '..']);
        foreach ($items as $item) {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                self::deleteFolderContents($path);
                rmdir($path);
            } else {
                unlink($path);
            }
        }
    }

    /**
     * Recursively copies all files and folders from source to destination.
     *
     * @param string $source source directory
     * @param string $destination destination directory
     *
     * @return void
     */
    public static function copyFolderContents($source, $destination)
    {
        if (!is_dir($source)) {
            return;
        }

        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $items = array_diff(scandir($source), ['.', '..']);
        foreach ($items as $item) {
            $srcPath = $source . DIRECTORY_SEPARATOR . $item;
            $destPath = $destination . DIRECTORY_SEPARATOR . $item;

            if (is_dir($srcPath)) {
                mkdir($destPath, 0755, true);
                self::copyFolderContents($srcPath, $destPath);
            } else {
                copy($srcPath, $destPath);
            }
        }
    }
}
