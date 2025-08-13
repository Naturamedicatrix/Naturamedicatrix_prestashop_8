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

class WkSubscriptionStripe
{
    /**
     * deleteStripeTempCartProduct
     *
     * @param mixed $idCart
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     *
     * @return void
     */
    public static function deleteStripeTempCartProduct($idCart, $idProduct, $idProductAttr)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'DELETE
            FROM `' . _DB_PREFIX_ . 'wk_stripe_subscribe_cart_product`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    /**
     * updateStripeTempCartProduct
     *
     * @param mixed $idCart
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     * @param mixed $asSubscription
     *
     * @return void
     */
    public static function updateStripeTempCartProduct($idCart, $idProduct, $idProductAttr, $asSubscription)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'UPDATE
            `' . _DB_PREFIX_ . 'wk_stripe_subscribe_cart_product`
            SET as_subscription = ' . (int) $asSubscription . '
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    public static function deactivateStripeProduct($idCart, $idProduct, $idProductAttr)
    {
        $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'wk_stripe_subscribe_cart_product`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
                AND `as_subscription` = 1
            '
        );

        if ($data) {
            return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'UPDATE
                `' . _DB_PREFIX_ . 'wk_stripe_subscription`
                SET active = 0
                WHERE `id_product` = ' . (int) $idProduct . '
                    AND `attribute_id` = ' . (int) $idProductAttr . '
                '
            );
        }
    }

    public static function getSubscriptionDetailsByCartId($idCart, $idProduct, $idProductAttr)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT plan_id as stripe_plan_id, stripe_id_customer as stripe_subscription_id
            FROM `' . _DB_PREFIX_ . 'wk_stripe_customer_subscription`
            WHERE `id_cart` = ' . (int) $idCart . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `attribute_id` = ' . (int) $idProductAttr . '
            '
        );
    }

    public function cancelStripeSubscription($idCustomer, $stripeSubscriptionId, $redirect = false)
    {
        $objCustomer = new StripeCustomerSubscription();
        $idStripeCustomer = $stripeSubscriptionId;
        if ($idStripeCustomer) {
            $stripePublishableKey = WkStripeApiService::getSecretKey();
            WkStripeApiService::setApiKey($stripePublishableKey);
            try {
                $sub = WkStripeApiService::retrieveSubscription($idStripeCustomer);
                if ($sub->id) {
                    if (Tools::strtolower($sub->status) != 'canceled') {
                        $sub->cancel();
                    }
                    $stripeCustomer = $objCustomer->getAllSubscriptionPlanByStripeCustomerId(
                        $idCustomer,
                        $idStripeCustomer
                    );
                    if ($stripeCustomer) {
                        $objCustomer = new StripeCustomerSubscription($stripeCustomer['id']);
                        $objCustomer->is_plan_cancel = 1;
                        $objCustomer->update();
                    }

                    return true;
                } else {
                    if ($redirect) {
                        Tools::redirect(
                            Context::getContext()->link->getModuleLink(
                                'wkproductsubscription',
                                'subscriptiondetails',
                                ['err' => 1]
                            )
                        );
                    } else {
                        return false;
                    }
                }
            } catch (Stripe\Error\InvalidRequest $e) {
                $this->handleError($e);
                if ($redirect) {
                    Tools::redirect(Context::getContext()->link->getModuleLink(
                        'wkproductsubscription',
                        'subscriptiondetails',
                        ['invalid' => $e->getMessage()]
                    ));
                } else {
                    return false;
                }
            }
        }
    }

    public function pauseStripeSubscription($stripeSubscriptionId, $noOfDays)
    {
        $idStripeCustomer = $stripeSubscriptionId;
        if ($idStripeCustomer && !empty($noOfDays)) {
            $stripePublishableKey = WkStripeApiService::getSecretKey();
            WkStripeApiService::setApiKey($stripePublishableKey);
            try {
                $sub = WkStripeApiService::retrieveSubscription($idStripeCustomer);
                $currentDate = date('Y-m-d');
                $nextEndDate = date('Y-m-d', strtotime($currentDate . ' + ' . $noOfDays . ' days'));
                if ($sub->id) {
                    if (Tools::strtolower($sub->status) != 'canceled') {
                        $sub->update(
                            $sub->id,
                            [
                                'pause_collection' => [
                                    'behavior' => 'void',
                                    'resumes_at' => strtotime($nextEndDate),
                                ],
                            ]
                        );

                        return true;
                    }

                    return false;
                } else {
                    Tools::redirect(
                        Context::getContext()->link->getModuleLink(
                            'wkproductsubscription',
                            'subscriptiondetails',
                            ['err' => 1]
                        )
                    );
                }
            } catch (Stripe\Error\InvalidRequest $e) {
                $this->handleError($e);
                Tools::redirect(Context::getContext()->link->getModuleLink(
                    'wkproductsubscription',
                    'subscriptiondetails',
                    ['invalid' => $e->getMessage()]
                ));
            }
        }
    }

    public function resumeSubscription($stripeSubscriptionId)
    {
        if ($stripeSubscriptionId) {
            $stripePublishableKey = WkStripeApiService::getSecretKey();
            WkStripeApiService::setApiKey($stripePublishableKey);
            try {
                $sub = WkStripeApiService::retrieveSubscription($stripeSubscriptionId);
                if ($sub->id) {
                    if (Tools::strtolower($sub->status) != 'canceled') {
                        $sub->update(
                            $sub->id,
                            [
                                'pause_collection' => [
                                    'behavior' => 'void',
                                    'resumes_at' => strtotime(date('Y-m-d')),
                                ],
                            ]
                        );

                        return true;
                    }

                    return false;
                } else {
                    Tools::redirect(
                        Context::getContext()->link->getModuleLink(
                            'wkproductsubscription',
                            'subscriptiondetails',
                            ['err' => 1]
                        )
                    );
                }
            } catch (Stripe\Error\InvalidRequest $e) {
                $this->handleError($e);
                Tools::redirect(Context::getContext()->link->getModuleLink(
                    'wkproductsubscription',
                    'subscriptiondetails',
                    ['invalid' => $e->getMessage()]
                ));
            }
        }
    }

    public function handleError($exception, $check = false)
    {
        WkStripeApiService::createErrorLog($exception, $check);
    }
}
