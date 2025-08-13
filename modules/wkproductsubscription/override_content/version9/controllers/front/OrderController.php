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

use PrestaShop\PrestaShop\Core\Foundation\Templating\RenderableProxy;

class OrderController extends OrderControllerCore
{
    public function initContent(): void
    {
        if (Configuration::isCatalogMode()) {
            Tools::redirect('index.php');
        }
        $this->restorePersistedData($this->checkoutProcess);
        $this->checkoutProcess->handleRequest(
            Tools::getAllValues()
        );
        $presentedCart = $this->cart_presenter->present($this->context->cart, true);
        if (count($presentedCart['products']) <= 0 || $presentedCart['minimalPurchaseRequired']) {
            $cartLink = $this->context->link->getPageLink('cart');
            Tools::redirect($cartLink);
        }
        $product = $this->context->cart->checkQuantities(true);
        $idProduct = 0;
        $idCart = 0;
        $idAttr = 0;
        if (Module::isEnabled('wkproductsubscription')) {
            $context = Context::getContext();
            include_once _PS_MODULE_DIR_ . 'wkproductsubscription/classes/WkSubscriptionRequired.php';
            if ($cartProducts = $context->cart->getProducts()) {
                $subProdCount = 0;
                $cartProdCount = 0;
                $hasSubProd = false;

                $cartRules = $this->context->cart->getCartRules(CartRule::FILTER_ACTION_GIFT);
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
                    // Gift product
                    if (!in_array($idProduct . '_' . $idAttr, $giftProducts)) {
                        ++$cartProdCount;
                    }
                }
                if (($subProdCount !== $cartProdCount) && $hasSubProd) {
                    if (!(new WkProductSubscriptionGlobal())->isAllowBothNormalAndSubsProduct()) {
                        $product = [];
                    }
                } elseif (($subProdCount > 1) && $hasSubProd) {
                    $product = [];
                }
            }

            $isCartExist = false;
            if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()
                    && WkPaypalHelper::checkPaypalConfigured()
                    && $product
            ) {
                $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idAttr, true);
                $cacheParams = [
                    'id_cart' => $idCart,
                    'id_address_invoice' => $context->cart->id_address_invoice,
                    'id_currency' => $context->cart->id_currency,
                    'products' => $cartProducts,
                    'total' => $context->cart->getOrderTotal(true),
                ];
                $hash = WkProductSubscriptionCache::calculateSubscriptionHash($cacheParams);
                $cacheParams['hash'] = $hash;
                $cacheData = WkProductSubscriptionCache::getSubscriptionCacheData($cacheParams);
                if (($isCartExist && $context->cart->id_address_invoice)
                    && (($cacheData && ($cacheData['id_plan'] == '')) || !$cacheData)
                ) {
                    foreach ($this->checkoutProcess->getSteps() as $step) {
                        if ($step instanceof CheckoutAddressesStep) {
                            $step->setCurrent(true);
                        }
                    }
                }
            }

            if (WkProductSubscriptionGlobal::isWkAuthorizeNetEnabled()
            && $product
            ) {
                $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart($idCart, $idProduct, $idAttr, true);
                $cacheParams = [
                    'id_cart' => $idCart,
                    'id_address_invoice' => $context->cart->id_address_invoice,
                    'id_currency' => $context->cart->id_currency,
                    'products' => $cartProducts,
                    'total' => $context->cart->getOrderTotal(true),
                ];
                $hash = WkProductSubscriptionCache::calculateSubscriptionHash($cacheParams);
                $cacheParams['hash'] = $hash;
                $cacheData = WkProductSubscriptionCache::getSubscriptionCacheData($cacheParams);
                if (($isCartExist && $context->cart->id_address_invoice)
                    && (($cacheData && ($cacheData['id_plan'] == '')) || !$cacheData)
                ) {
                    foreach ($this->checkoutProcess->getSteps() as $step) {
                        if ($step instanceof CheckoutAddressesStep) {
                            $step->setCurrent(true);
                        }
                    }
                }
            }
        }

        if (is_array($product)) {
            $cartLink = $this->context->link->getPageLink('cart', null, null, ['action' => 'show']);
            Tools::redirect($cartLink);
        }
        $this->checkoutProcess
            ->setNextStepReachable()
            ->markCurrentStep()
            ->invalidateAllStepsAfterCurrent();
        $this->saveDataToPersist($this->checkoutProcess);
        if (!$this->checkoutProcess->hasErrors()) {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET' && !$this->ajax) {
                $this->redirectWithNotifications(
                    $this->checkoutProcess->getCheckoutSession()->getCheckoutURL()
                );
                return;
            }
        }
        $this->context->smarty->assign([
            'checkout_process' => new RenderableProxy($this->checkoutProcess),
            'cart' => $presentedCart,
        ]);
        $this->context->smarty->assign([
            'display_transaction_updated_info' => Tools::getIsset('updatedTransaction'),
        ]);
        parent::initContent();
        $this->setTemplate('checkout/checkout');
    }
}
