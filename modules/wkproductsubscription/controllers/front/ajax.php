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

class WkProductSubscriptionAjaxModuleFrontController extends ModuleFrontController
{
    public function displayAjaxAddSubscribe()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (Tools::getIsset('id_product')
            && Tools::getIsset('frequency')
        ) {
            $idProduct = (int) Tools::getValue('id_product');
            $idProductAttribute = (int) Tools::getValue('id_product_attribute');
            $idCustomization = (int) Tools::getValue('id_customization');
            $frequencyComb = Tools::getValue('frequency');
            $isSubscribe = (int) Tools::getValue('is_subscribe');
            $idSubTemp = (int) Tools::getValue('id_sub_temp');
            if (Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')) {
                $deliveryDate = Tools::getValue('delivery_date');
            } else {
                $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');
                $deliveryDate = date('Y-m-d', strtotime('+' . $wkOrderDays . ' days'));
            }

            // Validate product subscription active
            $productSubsData = WkProductSubscriptionModel::getProductSubscriptionData($idProduct, $idProductAttribute);
            if ($productSubsData['active']) {
                $frequencyArr = explode('_', $frequencyComb);
                $frequency = $frequencyArr[0];
                $cycle = $frequencyArr[1];
                $idCart = (int) $this->context->cart->id;
                $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                    $idCart,
                    $idProduct,
                    $idProductAttribute,
                    true
                );

                if ($isCartExist && $isCartExist['id_wk_subscription_temp_cart']) {
                    $idSubTemp = $isCartExist['id_wk_subscription_temp_cart'];
                    $tempCart = new WkSubscriptionCartProducts((int) $idSubTemp);
                } else {
                    $tempCart = new WkSubscriptionCartProducts();
                }

                $tempCart->id_cart = (int) $this->context->cart->id;
                $tempCart->id_product = (int) $idProduct;
                $tempCart->id_product_attribute = (int) $idProductAttribute;
                $tempCart->id_customization = (int) $idCustomization;
                $tempCart->frequency = $frequency;
                $tempCart->cycle = (int) $cycle;
                $tempCart->first_delivery_date = $deliveryDate;
                $tempCart->as_subscription = $isSubscribe;
                if ($tempCart->save()) {
                    $this->applyDiscount($tempCart->id);
                    if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                        WkSubscriptionPayPal::addTempCartProduct(
                            (int) $this->context->cart->id,
                            (int) $idProduct,
                            (int) $idProductAttribute
                        );
                    }
                    // Debug: Log l'abonnement créé
                    error_log('Abonnement temporaire créé - ID: ' . $tempCart->id . 
                             ', Frequency: ' . $tempCart->frequency . 
                             ', Cycle: ' . $tempCart->cycle . 
                             ', Delivery: ' . $tempCart->first_delivery_date . 
                             ', Subscribe: ' . $tempCart->as_subscription);
                    echo $tempCart->id;
                    exit;
                }
            } else {
                exit(json_encode([
                    'success' => 0,
                    'msg' => $this->module->l('Invalid request!', 'ajax'),
                ]));
            }
        } else {
            exit(json_encode([
                'success' => 0,
                'msg' => $this->module->l('Invalid request!', 'ajax'),
            ]));
        }

        return false;
    }

    public function displayAjaxUpdateSubscribe()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (Tools::getIsset('id_sub_temp')
            && Tools::getIsset('frequency')
            && Tools::getValue('id_sub_temp')
        ) {
            $frequencyComb = Tools::getValue('frequency');
            $isSubscribe = (int) Tools::getValue('is_subscribe');
            $idSubTemp = (int) Tools::getValue('id_sub_temp');
            if (Configuration::get('WK_SUBSCRIPTION_DISPLAY_DELIVERY_DATE')) {
                $deliveryDate = Tools::getValue('delivery_date');
            } else {
                $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');
                $deliveryDate = date('Y-m-d', strtotime('+' . $wkOrderDays . ' days'));
            }

            $frequencyArr = explode('_', $frequencyComb);
            $frequency = $frequencyArr[0];
            $cycle = $frequencyArr[1];

            $tempCart = new WkSubscriptionCartProducts((int) $idSubTemp);
            $tempCart->frequency = $frequency;
            $tempCart->cycle = (int) $cycle;
            $tempCart->first_delivery_date = $deliveryDate;
            $tempCart->as_subscription = $isSubscribe;
            if ($tempCart->save()) {
                $this->applyDiscount($tempCart->id, $isSubscribe);
                if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()) {
                    WkSubscriptionStripe::updateStripeTempCartProduct(
                        $tempCart->id_cart,
                        $tempCart->id_product,
                        $tempCart->id_product_attribute,
                        $tempCart->as_subscription
                    );
                }
                if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                    WkSubscriptionPayPal::updateTempCartProduct(
                        $tempCart->id_cart,
                        $tempCart->id_product,
                        $tempCart->id_product_attribute,
                        $tempCart->as_subscription
                    );
                }
                echo $tempCart->id;
                exit;
            }
        } else {
            exit(json_encode([
                'success' => 0,
                'msg' => $this->module->l('Invalid request!', 'ajax'),
            ]));
        }
    }

    public function applyDiscount($idSubTemp, $isSubscribe = 1)
    {
        $tempCart = new WkSubscriptionCartProducts((int) $idSubTemp);
        if (Validate::isLoadedObject($tempCart)) {
            $frequency = $tempCart->frequency;
            $cycle = $tempCart->cycle;
            $idProduct = $tempCart->id_product;
            $idProductAttribute = $tempCart->id_product_attribute;
            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                $frequency,
                (int) $cycle,
                (int) $idProduct,
                (int) $idProductAttribute
            );
            if ($discount && $isSubscribe) {
                $cartRuleName = [];
                if ($tempCart->id_cart_rule) {
                    $objCartRule = new CartRule((int) $tempCart->id_cart_rule);
                } else {
                    $objCartRule = new CartRule();
                }
                foreach (Language::getLanguages(false) as $lang) {
                    $cartRuleName[$lang['id_lang']] = sprintf(
                        $this->module->l('Subscription discount (%s%%)', 'ajax'),
                        $discount
                    );
                }
                $objCartRule->name = $cartRuleName;
                $objCartRule->id_customer = (int) $this->context->customer->id;
                $objCartRule->reduction_percent = $discount;
                $objCartRule->date_from = date('Y-m-d');
                $objCartRule->date_to = date('Y-m-d', strtotime('+12 months'));
                $objCartRule->description = $this->module->l('Subscription discount', 'ajax');
                $objCartRule->quantity = 1;
                $objCartRule->quantity_per_user = 1;
                $objCartRule->priority = 1;
                $objCartRule->partial_use = false;
                $objCartRule->code = '';
                $objCartRule->minimum_amount = 0;
                $objCartRule->product_restriction = true;
                $objCartRule->shop_restriction = Shop::isFeatureActive() ? true : false;
                $objCartRule->reduction_product = (int) $idProduct;
                $objCartRule->active = true;
                $objCartRule->save();
                if ($objCartRule->id) {
                    if (Shop::isFeatureActive()) {
                        Db::getInstance()->delete(
                            'cart_rule_shop',
                            'id_cart_rule =' . (int) $objCartRule->id
                        );
                        Db::getInstance()->insert('cart_rule_shop', [
                            'id_cart_rule' => (int) $objCartRule->id,
                            'id_shop' => (int) $this->context->shop->id,
                        ]);
                    }
                    $tempCart = new WkSubscriptionCartProducts((int) $idSubTemp);
                    $tempCart->id_cart_rule = (int) $objCartRule->id;
                    $tempCart->save();
                }
            } else { // Delete existing frequency discount if any
                if ($tempCart->id_cart_rule) {
                    $this->context->cart->removeCartRule($tempCart->id_cart_rule);
                    $this->context->cart->update();
                    $objCartRule = new CartRule((int) $tempCart->id_cart_rule);
                    $objCartRule->delete();
                }
            }
        }

        return false;
    }

    public function displayAjaxRemoveSubscribe()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (Tools::getIsset('id_product')
            && Tools::getIsset('id_product_attribute')
            && Configuration::get('WK_SUBSCRIPTION_DISPLAY_ONE_TIME_PURCHASE')
        ) {
            $idProduct = (int) Tools::getValue('id_product');
            $idProductAttribute = (int) Tools::getValue('id_product_attribute');
            $idCart = (int) $this->context->cart->id;
            $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                $idCart,
                $idProduct,
                $idProductAttribute,
                true
            );

            if ($isCartExist) {
                $tempCart = new WkSubscriptionCartProducts((int) $isCartExist['id_wk_subscription_temp_cart']);
                if ($tempCart->delete()) {
                    if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()) {
                        WkSubscriptionStripe::deleteStripeTempCartProduct(
                            $idCart,
                            $idProduct,
                            $idProductAttribute
                        );
                    }
                    if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                        WkSubscriptionPayPal::deleteTempCartProduct(
                            $idCart,
                            $idProduct,
                            $idProductAttribute
                        );
                        WkProductSubscriptionCache::deleteExistingCacheByCart($idCart);
                    }
                    // Remove specific price rule
                    if ($isCartExist['id_cart_rule']) {
                        $this->context->cart->removeCartRule($isCartExist['id_cart_rule']);
                        $this->context->cart->update();
                        $objCartRule = new CartRule((int) $isCartExist['id_cart_rule']);
                        $objCartRule->delete();
                    }
                    exit(1);
                }
            } else {
                exit(json_encode([
                    'success' => 0,
                    'msg' => $this->module->l('Invalid request!', 'ajax'),
                ]));
            }
        } else {
            exit(json_encode([
                'success' => 0,
                'msg' => $this->module->l('Invalid request!', 'ajax'),
            ]));
        }
    }

    public function displayAjaxGetSubscribe()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (Tools::getIsset('id_product')
            && Tools::getIsset('id_product_attribute')
        ) {
            $idProduct = (int) Tools::getValue('id_product');
            $idProductAttribute = (int) Tools::getValue('id_product_attribute');
            $idCart = (int) $this->context->cart->id;
            $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                $idCart,
                $idProduct,
                $idProductAttribute,
                true
            );

            if ($isCartExist) {
                $this->assignCartSubscriptionVars($idProduct, $idProductAttribute);
                $popup = $this->context->smarty->fetch(
                    'module:wkproductsubscription/views/templates/front/modal.tpl'
                );
                exit(json_encode([
                    'success' => 1,
                    'popup' => $popup,
                ]));
            } else {
                exit(json_encode([
                    'success' => 0,
                    'msg' => $this->module->l('Invalid request!', 'ajax'),
                ]));
            }
        } else {
            exit(json_encode([
                'success' => 0,
                'msg' => $this->module->l('Invalid request!', 'ajax'),
            ]));
        }
    }

    public function assignCartSubscriptionVars($id_product, $id_product_attribute)
    {
        $dailyString = $this->module->l('Every %d day', 'ajax');
        $everyDayString = $this->module->l('Everyday', 'ajax');
        $weeklyString = $this->module->l('Every %d week', 'ajax');
        $everyWeekString = $this->module->l('Every week', 'ajax');
        $monthlyString = $this->module->l('Every %d month', 'ajax');
        $everyMonthString = $this->module->l('Every month', 'ajax');
        $yearlyString = $this->module->l('Every %d year', 'ajax');
        $everyYearString = $this->module->l('Every year', 'ajax');
        $discountTxt = $this->l('(%s%% off)', 'ajax');

        $idLang = (int) $this->context->language->id;
        $idShop = (int) $this->context->shop->id;
        $product = new Product($id_product, false, $idLang, $idShop);

        if (WkProductSubscriptionModel::checkIfSubscriptionProduct($id_product, $id_product_attribute)
            && Validate::isLoadedObject($product)
        ) {
            // Check for product is virtual or pack of product
            if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')
                && ($product->getType() != Product::PTYPE_SIMPLE)
            ) {
                return false;
            }

            $subscriptionData = WkProductSubscriptionModel::getProductSubscriptionData($id_product, $id_product_attribute);
            $availableCycles = [];
            // Check if product subscription is active
            if ($subscriptionData['active']) {
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
                        if ($discount > 0) {
                            $appendDiscount = sprintf(
                                $discountTxt,
                                $discount
                            );
                        }
                        if ($value == 1) {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'daily',
                                'frequencyText' => $everyDayString . ' ' . $appendDiscount,
                            ];
                        } else {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'daily',
                                'frequencyText' => sprintf($dailyString, $value) . ' ' . $appendDiscount,
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
                        if ($discount > 0) {
                            $appendDiscount = sprintf(
                                $discountTxt,
                                $discount
                            );
                        }
                        if ($value == 1) {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'weekly',
                                'frequencyText' => $everyWeekString . ' ' . $appendDiscount,
                            ];
                        } else {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'weekly',
                                'frequencyText' => sprintf($weeklyString, $value) . ' ' . $appendDiscount,
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
                        if ($discount > 0) {
                            $appendDiscount = sprintf(
                                $discountTxt,
                                $discount
                            );
                        }
                        if ($value == 1) {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'monthly',
                                'frequencyText' => $everyMonthString . ' ' . $appendDiscount,
                            ];
                        } else {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'monthly',
                                'frequencyText' => sprintf($monthlyString, $value) . ' ' . $appendDiscount,
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
                        if ($discount > 0) {
                            $appendDiscount = sprintf(
                                $discountTxt,
                                $discount
                            );
                        }
                        if ($value == 1) {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'yearly',
                                'frequencyText' => $everyYearString . ' ' . $appendDiscount,
                            ];
                        } else {
                            $availableCycles[] = [
                                'id_product' => $id_product,
                                'cycle' => $value,
                                'frequency' => 'yearly',
                                'frequencyText' => sprintf($yearlyString, $value) . ' ' . $appendDiscount,
                            ];
                        }
                    }
                }

                $wkOrderDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');

                $tempCart = WkSubscriptionCartProducts::getByIdProductByIdCart(
                    $this->context->cart->id,
                    $id_product,
                    $id_product_attribute,
                    true
                );

                if ($id_product && $tempCart) {
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
                    ]);
                }
            }
        }
    }

    public function displayAjaxAddStripeProductPlan()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
            && $this->context->cart->id
        ) {
            $idCart = (int) $this->context->cart->id;
            $cart = new Cart((int) $idCart);

            $cartTotalAmount = $cart->getOrderTotal();
            if (!$this->checkCartValue($cartTotalAmount)) {
                Media::addJsDefL('low_value', '1');
                exit('min_order_value'); // cart value is low for stripe transaction
            }

            $getProducts = $cart->getProducts();
            if (!empty($getProducts)) {
                foreach ($getProducts as $product) {
                    $idAttrib = $product['id_product_attribute'];
                    $idProduct = $product['id_product'];
                    $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                        $idCart,
                        $idProduct,
                        $idAttrib,
                        true
                    );
                    if ($isCartExist
                        && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)
                    ) {
                        $stripePublishableKey = WkStripeApiService::getSecretKey();
                        WkStripeApiService::setApiKey($stripePublishableKey);
                        WkStripeApiService::setApiRequest([CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1]);

                        // Deactivate existing plan product
                        WkSubscriptionStripe::deactivateStripeProduct(
                            $idCart,
                            $idProduct,
                            $idAttrib
                        );

                        // Create stripe plan for this product
                        $idStripePlan = $this->createStripePlan($product, $isCartExist);
                        if ($idStripePlan) {
                            $this->stripeDataProcessAndSave($idStripePlan, $idProduct, $idAttrib);
                            exit('1');
                        } else {
                            echo json_encode($this->errors);
                            exit;
                        }
                    }
                }
            }
        }
    }

    /**
     * createStripePlan
     *
     * @param mixed $product
     * @param mixed $frequency
     *
     * @return int
     */
    public function createStripePlan($product, $frequency)
    {
        $idCart = (int) $this->context->cart->id;
        $cart = new Cart((int) $idCart);
        $cartTotalAmount = $cart->getOrderTotal();
        $stripePlanName = 'PLAN_' . $idCart . '_' . $frequency['frequency'] . '_' . $frequency['cycle'];
        $stripeCurrency = $this->context->currency->iso_code;
        $stripePrice = $cartTotalAmount;
        $stripeDesc = Tools::substr(str_replace("'", '', $product['name']), 0, 10) . ' - ' .
        $frequency['frequency'] . '_' . $frequency['cycle'];
        try {
            $productInfo = [
                'name' => $stripePlanName,
            ];
            if (trim($stripeDesc) != '') {
                $productInfo['statement_descriptor'] = $stripeDesc;
            }
            $info = [
                'product' => $productInfo,
                'amount' => $stripePrice * 100,
                'currency' => $stripeCurrency,
            ];

            if ($frequency['frequency'] == 'weekly') {
                $info['interval'] = 'week';
            } elseif ($frequency['frequency'] == 'monthly') {
                $info['interval'] = 'month';
            } elseif ($frequency['frequency'] == 'yearly') {
                $info['interval'] = 'year';
            } elseif ($frequency['frequency'] == 'daily') {
                $info['interval'] = 'day';
            }

            $info['interval_count'] = $frequency['cycle'];

            $objStripe = WkStripeApiService::createPlan($info);

            if ($objStripe) {
                $objPlan = new StripePlan();
                $objPlan->plan_id = $objStripe->id;
                $objPlan->name = $stripePlanName;
                $objPlan->currency = $this->context->currency->iso_code;
                $objPlan->amount = $cartTotalAmount;
                $objPlan->interval = $info['interval'];
                $objPlan->trial_period = 0;
                $objPlan->statement = $stripeDesc;
                $objPlan->save();

                return $objPlan->id;
            }
        } catch (Stripe\Error\InvalidRequest $e) {
            $this->handleError($e);
            $eJson = $e->getJsonBody();
            $error = $eJson['error'];
            $this->errors[] = $error['message'];
        } catch (Exception $e) {
            $this->handleError($e, true);
            $this->errors[] = $e->getMessage();
        }

        return false;
    }

    public function checkCartValue($amount)
    {
        $currArr = [
            'USD' => 0.50,
            'CAD' => 0.50,
            'GBP' => 0.30,
            'EUR' => 0.50,
            'DKK' => 2.50,
            'NOK' => 3.00,
            'SEK' => 3.00,
            'CHF' => 0.50,
            'AUD' => 0.50,
            'JPY' => 50,
            'MXN' => 10,
            'SGD' => 0.50,
        ];
        $currencyExist = false;
        $flag = false;
        if (array_key_exists($this->context->currency->iso_code, $currArr)) {
            $currencyExist = true;
        }

        if (!$currencyExist) {
            $fromCurrency = Currency::getIdByIsoCode($this->context->currency->iso_code);
            $toCurrency = Currency::getIdByIsoCode('eur');
            $convertedAmount = Tools::convertPriceFull(
                $amount,
                Currency::getCurrencyInstance((int) $fromCurrency),
                Currency::getCurrencyInstance((int) $toCurrency)
            );
            $total = round($convertedAmount, 2);
            if ($total < 0.50) {
                $flag = true;
            }
        } else {
            if ($amount < $currArr[$this->context->currency->iso_code]) {
                $flag = true;
            }
        }

        if (!$flag) {
            return true;
        }

        return false;
    }

    public function stripeDataProcessAndSave($idPlan, $idProduct, $idAttr)
    {
        $stripeSubscription = new StripeSubscription();
        $objModuleStripe = Module::getInstanceByName('wkstripepayment');
        if (version_compare($objModuleStripe->version, '5.3.0', '>=')) {
            $stripeSubscription->id_shop = $this->context->shop->id;
        }
        $stripeSubscription->plan_id = $idPlan;
        $stripeSubscription->id_product = $idProduct;
        $stripeSubscription->attribute_id = $idAttr;
        $stripeSubscription->active = 1;
        $stripeSubscription->save();
        unset($stripeSubscription);
    }

    public function handleError($exception, $check = false)
    {
        WkStripeApiService::createErrorLog($exception, $check);
    }

    // Adyen Payment
    public function displayAjaxAddAdyenProductPlan()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
            && $this->context->cart->id
        ) {
            $idCart = (int) $this->context->cart->id;
            $cart = new Cart((int) $idCart);
            $getProducts = $cart->getProducts();
            if (!empty($getProducts)) {
                foreach ($getProducts as $product) {
                    $idAttrib = $product['id_product_attribute'];
                    $idProduct = $product['id_product'];
                    $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                        $idCart,
                        $idProduct,
                        $idAttrib,
                        true
                    );
                    if ($isCartExist
                        && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)
                    ) {
                        // Create adyen plan for this product
                        $idPlan = $this->createAdyenPlan($product, $isCartExist);
                        if ($idPlan) {
                            $this->adyenDataProcessAndSave($idPlan, $idProduct);
                            exit('1');
                        } else {
                            echo json_encode($this->errors);
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function createAdyenPlan($product, $frequency)
    {
        $idCart = (int) $this->context->cart->id;
        $cart = new Cart((int) $idCart);
        $cartTotalAmount = $cart->getOrderTotal();
        $adyenPlanName = 'PLAN_' . $idCart . '_' . $frequency['frequency'] . '_' . $frequency['cycle'];
        $adyenCurrency = $this->context->currency->iso_code;
        $adyenPrice = $cartTotalAmount;
        $adyenDesc = $product['name'] . ' - ' . $frequency['frequency'] . '_' . $frequency['cycle'];

        if ($frequency['frequency'] == 'weekly') {
            $adyenInterval = 'week';
        } elseif ($frequency['frequency'] == 'monthly') {
            $adyenInterval = 'month';
        } elseif ($frequency['frequency'] == 'yearly') {
            $adyenInterval = 'year';
        } elseif ($frequency['frequency'] == 'daily') {
            $adyenInterval = 'day';
        }

        if ($isExists = WkSubscriptionAdyen::checkIfPlanExists($adyenPlanName)) {
            WkSubscriptionAdyen::deletePlanProduct($isExists['id']);
        }

        $objAdyenPlan = new AdyenPlan();
        $objAdyenPlan->name = $adyenPlanName;
        $objAdyenPlan->currency = $adyenCurrency;
        $objAdyenPlan->amount = $adyenPrice;
        $objAdyenPlan->interval = $adyenInterval;
        $objAdyenPlan->description = $adyenDesc;
        if ($objAdyenPlan->save()) {
            return $objAdyenPlan->id;
        }

        return false;
    }

    public function displayAjaxGetPriceWithSubscription()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }
        if (Tools::getIsset('id_product') && Tools::getIsset('wkSubFreq')) {
            $idProduct = (int) Tools::getValue('id_product');
            $idProductAttribute = (int) Tools::getValue('id_product_attribute');
            $isSubscription = (int) Tools::getValue('isSubscription');
            $frequencyArr = explode('_', Tools::getValue('wkSubFreq'));
            $frequency = $frequencyArr[0];
            $cycle = $frequencyArr[1];

            $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                $frequency,
                (int) $cycle,
                (int) $idProduct
            );
            $productPrice = Product::getPriceStatic(
                $idProduct,
                true,
                $idProductAttribute
            );

            if ($isSubscription) {
                $productPrice = $productPrice - ($productPrice / 100) * $discount;
            }
            // $discountedAmt = (($productPrice / 100) * $discount);
            // $finalPrice = $productPrice - $discountedAmt;

            $finPriceWithCurr = WkProductSubscription::displayPrice(
                $productPrice,
                Currency::getCurrencyInstance((int) $this->context->currency->id)
            );
            exit(json_encode([
                'success' => 1,
                'wkDiscountedPrice' => $finPriceWithCurr,
                'msg' => $this->module->l('Final amount discounted', 'ajax'),
            ]));
        } else {
            exit(json_encode([
                'success' => 0,
                'msg' => $this->module->l('Invalid request!', 'ajax'),
            ]));
        }
    }

    public function adyenDataProcessAndSave($idPlan, $idProduct)
    {
        $objSubscription = new AdyenSubscription();
        $objSubscription->plan_id = $idPlan;
        $objSubscription->id_product = $idProduct;
        $objSubscription->active = 1;
        $objSubscription->save();
    }

    // Wepay Payment
    public function displayAjaxAddWepayProductPlan()
    {
        if (Tools::getValue('wkSubToken') != $this->module->secure_key) {
            exit(json_encode([
                'msg' => $this->module->l('Invalid token', 'ajax'),
            ]));
        }

        if (WkProductSubscriptionGlobal::isWkWepayRecurringEnabled()
            && $this->context->cart->id
        ) {
            $idCart = (int) $this->context->cart->id;
            $cart = new Cart((int) $idCart);
            $getProducts = $cart->getProducts();
            if (!empty($getProducts)) {
                foreach ($getProducts as $product) {
                    $idAttrib = $product['id_product_attribute'];
                    $idProduct = $product['id_product'];
                    $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                        $idCart,
                        $idProduct,
                        $idAttrib,
                        true
                    );
                    if ($isCartExist
                        && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)
                    ) {
                        // Create wepay plan for this product
                        $idPlan = $this->createWepayPlan($product, $isCartExist);
                        if ($idPlan) {
                            $this->wePayDataProcessAndSave($idPlan, $idProduct);
                            exit('1');
                        } else {
                            echo json_encode($this->errors);
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function createWepayPlan($product, $frequency)
    {
        $idCart = (int) $this->context->cart->id;
        $cart = new Cart((int) $idCart);
        $cartTotalAmount = $cart->getOrderTotal();
        $planName = 'PLAN_' . $idCart . '_' . $frequency['frequency'] . '_' . $frequency['cycle'];
        $planCurrency = $this->context->currency->iso_code;
        $planPrice = $cartTotalAmount;
        $planDesc = $product['name'] . ' - ' . $frequency['frequency'] . '_' . $frequency['cycle'];

        if ($planCurrency != 'USD') {
            $this->errors[] = $this->module->l('Wepay supports only USD currency.', 'ajax');

            return false;
        }

        if ($isExists = WkSubscriptionWepay::checkIfPlanExists($planName)) {
            WkSubscriptionWepay::deletePlanProduct($isExists['id_wk_wepay_subscription_plan']);
        }

        $accountId = Configuration::get('WK_WEPAY_ACCOUNT_ID');

        $objPlan = new WepaySubscriptionPlan();
        $objPlan->short_description = pSQL($planName);
        $objPlan->long_description = pSQL($planDesc);
        $objPlan->currency = 'USD';
        $objPlan->amount = (float) $planPrice;
        $objPlan->period = pSQL($frequency['frequency']);
        $objPlan->account_id = pSQL($accountId);

        if ($objPlan->save()) {
            return $objPlan->id;
        }

        return false;
    }

    public function wePayDataProcessAndSave($idPlan, $idProduct)
    {
        $objSubscription = new WepayAssignSubscriptionPlan();
        $objSubscription->plan_id = $idPlan;
        $objSubscription->product_id = $idProduct;
        $objSubscription->active = 1;
        $objSubscription->save();
    }
}
