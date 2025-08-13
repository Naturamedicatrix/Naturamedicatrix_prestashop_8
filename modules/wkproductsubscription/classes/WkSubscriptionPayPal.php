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

class WkSubscriptionPayPal
{
    public static function addTempCartProduct($idCart, $idProduct, $idProductAttr = 0)
    {
        $objStripeSubscribe = new WkSubscriptionProductCart();
        $objStripeSubscribe->id_cart = $idCart;
        $objStripeSubscribe->id_product = $idProduct;
        $objStripeSubscribe->id_product_attribute = $idProductAttr;
        $objStripeSubscribe->as_subscription = 1;
        $objStripeSubscribe->save();
    }

    /**
     * deleteTempCartProduct
     *
     * @param mixed $idCart
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     *
     * @return void
     */
    public static function deleteTempCartProduct($idCart, $idProduct, $idProductAttr)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'DELETE
            FROM `' . _DB_PREFIX_ . 'wk_subscription_product_cart`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    /**
     * updateTempCartProduct
     *
     * @param mixed $idCart
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     * @param mixed $asSubscription
     *
     * @return void
     */
    public static function updateTempCartProduct($idCart, $idProduct, $idProductAttr, $asSubscription)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'UPDATE
            `' . _DB_PREFIX_ . 'wk_subscription_product_cart`
            SET `as_subscription` = ' . (int) $asSubscription . '
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    public static function createPlanAndAssignProduct($params, $frequency)
    {
        $idCart = (int) $params['id_cart'];
        $cart = new Cart((int) $idCart);
        $amount = $cart->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING);
        $planName = 'PLAN_' . $idCart . '_' . $frequency['frequency'] . '_' . $frequency['cycle'];
        $planDescription = Tools::substr(str_replace("'", '', $params['products']['0']['name']), 0, 10) . ' - ' . $frequency['frequency'] . '_' . $frequency['cycle'];
        $currencyIso = Context::getContext()->currency->iso_code;

        $subsFreq = 'DAY';
        $frequencyInterval = $frequency['cycle'];
        $cycle = 99;
        if ($frequency['frequency'] == 'daily') {
            $subsFreq = 'DAY';
        } elseif ($frequency['frequency'] == 'weekly') {
            $subsFreq = 'WEEK';
        } elseif ($frequency['frequency'] == 'monthly') {
            $subsFreq = 'MONTH';
        } elseif ($frequency['frequency'] == 'yearly') {
            $subsFreq = 'YEAR';
        }

        $subscriptionPlan = new WkSubscriptionPlan();
        $planPayload = [
            'plan_name' => $planName,
            'plan_desc' => $planDescription,
            'frequency' => $subsFreq,
            'frequency_interval' => $frequencyInterval,
            'cycle' => $cycle,
            'amount' => $amount,
            'currency' => $currencyIso,
        ];
        $resp = $subscriptionPlan->createSubscriptionPlan($planPayload);
        if ($resp['success']) {
            $subscriptionPlan->plan_name = $planName;
            $subscriptionPlan->id_paypal_plan = $resp['plan_id'];
            $subscriptionPlan->plan_description = $planDescription;
            $subscriptionPlan->frequency = $subsFreq;
            $subscriptionPlan->frequency_interval = $frequencyInterval;
            $subscriptionPlan->cycle = $cycle;
            $subscriptionPlan->amount = $amount;
            $subscriptionPlan->active = 1;
            $subscriptionPlan->currency = $currencyIso;
            if ($subscriptionPlan->save()) {
                $objSubscription = new WkSubscriptionProduct();
                $objSubscription->id_wk_subscription_plan = $subscriptionPlan->id;
                $objSubscription->id_product = $params['products']['0']['id_product'];
                $objSubscription->attribute_id = $params['products']['0']['id_product_attribute'];
                $objSubscription->active = 1;
                $objSubscription->save();

                return $resp['plan_id'];
            }
        }

        return false;
    }

    /**
     * Get PayPal subscription details by cart
     *
     * @param int $idCart
     * @param int $idProduct
     * @param int $idProductAttr
     *
     * @return array
     */
    public static function getSubscriptionDetailsByCartId($idCart, $idProduct, $idProductAttr = 0)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT `id_subscription`
            FROM `' . _DB_PREFIX_ . 'wk_paypal_subscriber`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    /**
     * Deactivate PayPal plan product
     *
     * @param int $idCart
     * @param int $idProduct
     * @param int $idProductAttr
     *
     * @return int
     */
    public static function deactivateProduct($idCart, $idProduct, $idProductAttr = 0)
    {
        $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'wk_subscription_product_cart`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
                AND `as_subscription` = 1
            ORDER BY `id_wk_subscription_product_cart` DESC
            '
        );

        if ($data) {
            return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'UPDATE
                `' . _DB_PREFIX_ . 'wk_subscription_product`
                SET active = 0
                WHERE `id_product` = ' . (int) $idProduct . '
                    AND `attribute_id` = ' . (int) $idProductAttr . '
                '
            );
        }

        return false;
    }

    public function cancelSubscription($idSubscription, $idOrder)
    {
        if (!$idSubscription) {
            return false;
        }
        $response = WkPaypalSubscriber::cancelSubscription($idSubscription);
        if ($response['success']) {
            $idCart = Order::getCartIdStatic($idOrder);
            $objSubs = new WkPaypalSubscriber();
            $subsData = $objSubs->getSubscriptionDetailByIdCart($idCart);
            if ($subsData) {
                $idWkPaypalSubscription = (int) $subsData['id_wk_paypal_subscriber'];
                $objSubscription = new WkPaypalSubscriber($idWkPaypalSubscription);
                $objSubscription->status = WkPaypalHelper::WK_SUBSCRIPTION_CANCELLED;
                $objSubscription->is_subscription_cancel = 1;

                return $objSubscription->save();
            }
        }

        return false;
    }

    public function pauseSubscription($idSubscription, $idOrder)
    {
        if (!$idSubscription) {
            return false;
        }
        $response = WkPaypalSubscriber::pauseSubscription($idSubscription);
        if ($response['success']) {
            $idCart = Order::getCartIdStatic($idOrder);
            $objSubs = new WkPaypalSubscriber();
            $subsData = $objSubs->getSubscriptionDetailByIdCart($idCart);
            if ($subsData) {
                $idWkPaypalSubscription = (int) $subsData['id_wk_paypal_subscriber'];
                $objSubscription = new WkPaypalSubscriber($idWkPaypalSubscription);
                $objSubscription->status = WkPaypalHelper::WK_SUBSCRIPTION_SUSPENDED;

                return $objSubscription->save();
            }
        }

        return false;
    }

    public function resumeSubscription($idSubscription, $idOrder)
    {
        if (!$idSubscription) {
            return false;
        }
        $response = WkPaypalSubscriber::resumeSubscription($idSubscription);
        if ($response['success']) {
            $idCart = Order::getCartIdStatic($idOrder);
            $objSubs = new WkPaypalSubscriber();
            $subsData = $objSubs->getSubscriptionDetailByIdCart($idCart);
            if ($subsData) {
                $idWkPaypalSubscription = (int) $subsData['id_wk_paypal_subscriber'];
                $objSubscription = new WkPaypalSubscriber($idWkPaypalSubscription);
                $objSubscription->status = WkPaypalHelper::WK_SUBSCRIPTION_ACTIVE;

                return $objSubscription->save();
            }
        }

        return false;
    }

    public static function getSubscriptionIdByPayPalId($idPayPalSubscription)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT `id_wk_subscription_subscriber_products`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`
            WHERE `payment_response` = \'' . pSQL($idPayPalSubscription) . '\'
            AND `active` = 1'
        );
    }
}
