<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Service\Hook\HookFinder;

class PaymentOptionsFinder extends PaymentOptionsFinderCore
{
    /**
     * Collects available payment options from three different hooks.
     *
     * @return array An array of available payment options
     *
     * @see HookFinder::find()
     */
    public function find() // getPaymentOptions()
    {
        $this->hookName = 'displayPaymentEU';
        $rawDisplayPaymentEUOptions = HookFinder::find();

        $paymentOptions = array_map(
            ['PrestaShop\PrestaShop\Core\Payment\PaymentOption', 'convertLegacyOption'],
            $rawDisplayPaymentEUOptions
        );

        $this->hookName = 'advancedPaymentOptions';
        $paymentOptions = array_merge($paymentOptions, parent::find());
        $this->hookName = 'paymentOptions';
        $this->expectedInstanceClasses = ['PrestaShop\PrestaShop\Core\Payment\PaymentOption'];
        $paymentOptions = array_merge($paymentOptions, parent::find());
        foreach ($paymentOptions as $moduleName => $paymentOption) {
            if (!is_array($paymentOption)) {
                unset($paymentOptions[$moduleName]);
            }
        }
        if (Module::isEnabled('wkproductsubscription')) {
            include_once _PS_MODULE_DIR_ . 'wkproductsubscription/classes/WkSubscriptionRequired.php';
            if (!empty(Context::getContext()->cart)) {
                $products = Context::getContext()->cart->getProducts();
                $idCart = (int) Context::getContext()->cart->id;
                $product_ids = []; // get products in cart
                if ($products) {
                    foreach ($products as $product) {
                        $idProduct = (int) $product['id_product'];
                        $idProductAttribute = (int) $product['id_product_attribute'];
                        $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                            $idCart,
                            $idProduct,
                            $idProductAttribute,
                            true
                        );

                        if ($isCartExist) {
                            $product_ids[] = (int) $product['id_product'];
                        }
                    }
                }
                $allowedPayments = json_decode(Configuration::get('WK_SUBSCRIPTION_PAYMENT_METHODS'));
                if (count($product_ids)) {
                    if (isset($allowedPayments) && $allowedPayments) {
                        if ($paymentOptions) {
                            foreach ($paymentOptions as $moduleName => $paymentOption) {
                                $module = Module::getInstanceByName($moduleName);
                                if (is_array($allowedPayments)) {
                                    if (!in_array($module->id, $allowedPayments)) {
                                        unset($paymentOptions[$moduleName]);
                                    } else {
                                        $context = Context::getContext();
                                        if ($cartProducts = $context->cart->getProducts()) {
                                            $subProdCount = 0;
                                            $cartProdCount = 0;
                                            $hasSubProd = false;
                                            $cartRules = $context->cart->getCartRules(CartRule::FILTER_ACTION_GIFT);
                                            $giftProducts = [];
                                            if ($cartRules) {
                                                foreach ($cartRules as $rule) {
                                                    $giftProducts[] = $rule['gift_product'] . '_' . $rule['gift_product_attribute'];
                                                }
                                            }
                                            foreach ($cartProducts as $productData) {
                                                $idProduct = $productData['id_product'];
                                                $idAttr = $productData['id_product_attribute'];
                                                $idCart = $context->cart->id;
                                                if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct)
                                                    && WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idAttr, true)
                                                ) {
                                                    ++$subProdCount;
                                                    $hasSubProd = true;
                                                }
                                                if (!in_array($idProduct . '_' . $idAttr, $giftProducts)) {
                                                    ++$cartProdCount;
                                                }
                                            }
                                            if (($subProdCount !== $cartProdCount) && $hasSubProd) {
                                                if (!WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($moduleName, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_SPLIT_ORDER)) {
                                                    unset($paymentOptions[$moduleName]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($paymentOptions as $moduleName => $paymentOption) {
                            unset($paymentOptions[$moduleName]);
                        }
                    }
                }
            }
        }

        return $paymentOptions;
    }
}
