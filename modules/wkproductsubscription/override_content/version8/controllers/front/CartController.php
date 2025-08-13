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

class CartController extends CartControllerCore
{
    /**
     * Check if the products in the cart are available.
     *
     * @return bool|string
     */
    protected function areProductsAvailable()
    {
        $product = $this->context->cart->checkQuantities(true);
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
                        return (new WkProductSubscriptionGlobal())->getTransStringSubsWithNormal();
                    }
                } elseif (($subProdCount > 1) && $hasSubProd) {
                    return (new WkProductSubscriptionGlobal())->getTransStringSubsWithSubs();
                }
            }
        }
        if (true === $product || !is_array($product)) {
            return true;
        }
        if ($product['active']) {
            return $this->trans(
                'The item %product% in your cart is no longer available in this quantity. Please adjust the quantity.',
                ['%product%' => $product['name']],
                'Shop.Notifications.Error'
            );
        }

        return $this->trans(
            'This product (%product%) is no longer available.',
            ['%product%' => $product['name']],
            'Shop.Notifications.Error'
        );
    }

    public function displayAjaxUpdate()
    {
        if (Configuration::isCatalogMode()) {
            return;
        }

        $productsInCart = $this->context->cart->getProducts();
        $updatedProducts = array_filter($productsInCart, [$this, 'productInCartMatchesCriteria']);
        $updatedProduct = reset($updatedProducts);
        $productQuantity = $updatedProduct['quantity'] ?? 0;

        if (Module::isInstalled('wkproductsubscription') && Module::isEnabled('wkproductsubscription')) {
            $module = Module::getInstanceByName('wkproductsubscription');
            $cart = $this->context->cart;
            $cartRules = $cart->getCartRules();
            if ($cartRules) {
                if (!Configuration::get('WK_SUBSCRIPTION_VOUCHER_APPLY')) {
                    foreach ($cartRules as $cartRule) {
                        $cart->removeCartRule($cartRule['id_cart_rule']);
                    }

                    $this->errors[] = $module->l('You can not use voucher in this cart.');
                }
            }
        }

        if (!$this->errors) {
            $presentedCart = $this->cart_presenter->present($this->context->cart);

            // filter product output
            $presentedCart['products'] = $this->get('prestashop.core.filter.front_end_object.product_collection')
                ->filter($presentedCart['products']);

            $this->ajaxRender(json_encode([
                'success' => true,
                'id_product' => $this->id_product,
                'id_product_attribute' => $this->id_product_attribute,
                'id_customization' => $this->customization_id,
                'quantity' => $productQuantity,
                'cart' => $presentedCart,
                'errors' => empty($this->updateOperationError) ? '' : reset($this->updateOperationError),
            ]));

            return;
        } else {
            $this->ajaxRender(json_encode([
                'hasError' => true,
                'errors' => $this->errors,
                'quantity' => $productQuantity,
            ]));

            return;
        }
    }
}
