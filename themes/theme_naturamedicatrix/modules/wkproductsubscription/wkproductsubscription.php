<?php
/**
 * Override du module wkproductsubscription pour le thème Naturamedicatrix
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class WkProductSubscription extends WkProductSubscriptionCore
{
    /**
     * Override de la méthode hookDisplayProductPriceBlock
     * Corrige le calcul des prix avec réduction
     */
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
                        $id_product,
                        Tools::getValue('group')
                    );
                } else {
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                }
            }

            if (WkProductSubscriptionModel::checkIfSubscriptionProduct($id_product, $id_product_attribute)) {
                $subscriptionData = WkProductSubscriptionModel::getSubscriptionDataByProductId(
                    $id_product,
                    $id_product_attribute
                );
                if ($subscriptionData) {
                    $productPrice = Product::getPriceStatic(
                        $id_product,
                        true,
                        $id_product_attribute
                    );

                    $availableCycles = [];
                    $hasDiscountFreqency = false;
                    $discountFreqency = [];

                    $discountTxt = $this->l('(%s%% off)');
                    // Check for daily
                    if ($subscriptionData['daily_frequency']) {
                        $dailyCycles = json_decode($subscriptionData['daily_cycles']);
                        if ($dailyCycles) {
                            foreach ($dailyCycles as $key => $value) {
                                $appendDiscount = '';
                                $discountedPrice = $productPrice;
                                $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                    'daily',
                                    $value,
                                    $id_product,
                                    $id_product_attribute
                                );
                                if ($discount) {
                                    $appendDiscount = sprintf(
                                        $discountTxt,
                                        $discount
                                    );
                                    $hasDiscountFreqency = true;
                                    $discountFreqency[] = $discount;
                                    // MODIFICATION : Calcul correct du prix avec réduction
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
                    }

                    // Check for weekly frequency
                    if ($subscriptionData['weekly_frequency']) {
                        $weeklyCycles = json_decode($subscriptionData['weekly_cycles']);
                        if ($weeklyCycles) {
                            foreach ($weeklyCycles as $key => $value) {
                                $appendDiscount = '';
                                $discountedPrice = $productPrice;
                                $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                    'weekly',
                                    $value,
                                    $id_product,
                                    $id_product_attribute
                                );
                                if ($discount) {
                                    $appendDiscount = sprintf(
                                        $discountTxt,
                                        $discount
                                    );
                                    $hasDiscountFreqency = true;
                                    $discountFreqency[] = $discount;
                                    // MODIFICATION : Calcul correct du prix avec réduction
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
                    }
                    // Check for monthly frequency
                    if ($subscriptionData['monthly_frequency']) {
                        $monthlyCycles = json_decode($subscriptionData['monthly_cycles']);
                        if ($monthlyCycles) {
                            foreach ($monthlyCycles as $key => $value) {
                                $appendDiscount = '';
                                $discountedPrice = $productPrice;
                                $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                    'monthly',
                                    $value,
                                    $id_product,
                                    $id_product_attribute
                                );
                                if ($discount) {
                                    $appendDiscount = sprintf(
                                        $discountTxt,
                                        $discount
                                    );
                                    $hasDiscountFreqency = true;
                                    $discountFreqency[] = $discount;
                                    // MODIFICATION : Calcul correct du prix avec réduction
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
                    }
                    // Check for yearly frequency
                    if ($subscriptionData['yearly_frequency']) {
                        $yearlyCycles = json_decode($subscriptionData['yearly_cycles']);
                        if ($yearlyCycles) {
                            foreach ($yearlyCycles as $key => $value) {
                                $appendDiscount = '';
                                $discountedPrice = $productPrice;
                                $discount = WkProductSubscriptionModel::getDiscountPercentageByFrequencyAndCycle(
                                    'yearly',
                                    $value,
                                    $id_product,
                                    $id_product_attribute
                                );
                                if ($discount) {
                                    $appendDiscount = sprintf(
                                        $discountTxt,
                                        $discount
                                    );
                                    $hasDiscountFreqency = true;
                                    $discountFreqency[] = $discount;
                                    // MODIFICATION : Calcul correct du prix avec réduction
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
                    }

                    if (!empty($availableCycles)) {
                        // Appeler la méthode parent pour le reste de la logique
                        return parent::hookDisplayProductPriceBlock($params);
                    }
                }
            }
        }

        // Pour tous les autres cas, appeler la méthode parent
        return parent::hookDisplayProductPriceBlock($params);
    }
}
