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

class Cart extends CartCore
{
    public $typeWiseProducts;

    /**
     * Add a CartRule to the Cart.
     *
     * @param int $id_cart_rule CartRule ID
     * @param bool $useOrderPrices
     *
     * @return bool Whether the CartRule has been successfully added
     */
    public function addCartRule($id_cart_rule, bool $useOrderPrices = false)
    {
        if (Module::isEnabled('wkproductsubscription')) {
            include_once _PS_MODULE_DIR_ . 'wkproductsubscription/classes/WkSubscriptionRequired.php';
            if (!empty(Context::getContext()->cart)) {
                $idCart = (int) Context::getContext()->cart->id;
                $isCartExist = WkSubscriptionCartProducts::checkIfCartRuleExists($id_cart_rule);
                if ($isCartExist
                    && ($id_cart_rule == $isCartExist['id_cart_rule'])
                    && ($isCartExist['id_cart'] != $idCart)
                ) {
                    return false;
                } else {
                    return parent::addCartRule($id_cart_rule, $useOrderPrices);
                }
            } else {
                return parent::addCartRule($id_cart_rule, $useOrderPrices);
            }
        } else {
            return parent::addCartRule($id_cart_rule, $useOrderPrices);
        }
    }

    /**
     * Add a CartRule to the Cart.
     *
     * @param int $id_cart_rule CartRule ID
     * @param bool $useOrderPrices
     *
     * @return bool Whether the CartRule has been successfully added
     */
    public function getPackageShippingCost(
        $id_carrier = null,
        $use_tax = true,
        Country $default_country = null,
        $product_list = null,
        $id_zone = null,
        bool $keepOrderPrices = false
    ) {
        if (Module::isEnabled('wkproductsubscription') && Configuration::get('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION')) {
            include_once _PS_MODULE_DIR_ . 'wkproductsubscription/classes/WkSubscriptionRequired.php';
            if (!$default_country) {
                $default_country = Context::getContext()->country;
            }
            if (!is_null($product_list)) {
                foreach ($product_list as $key => $value) {
                    if ($value['is_virtual'] == 1) {
                        unset($product_list[$key]);
                    }
                }
            }
            if (is_null($product_list)) {
                $products = $this->getProducts();
            } else {
                $products = $product_list;
            }
            if (is_null($id_carrier) && !empty($this->id_carrier)) {
                $id_carrier = (int) $this->id_carrier;
            }
            $sellerWiseProdList = [];
            foreach ($products as $product) {
                $isCartExist = WkSubscriptionCartProducts::getByIdProductByIdCart(
                    Context::getContext()->cart->id,
                    $product['id_product'],
                    $product['id_product_attribute'],
                    true
                );
                $productType = 0;
                if ($isCartExist
                && WkProductSubscriptionModel::checkIfSubscriptionProduct($product['id_product'])) {
                    $productType = 1;
                }
                $sellerWiseProdList[$productType][] = $product;
            }
            unset($product_list);
            $shipping_cost = null;
            foreach ($sellerWiseProdList as $product_list) {
                $sellerWiseShippingCost = $this->getSubscriptionPackageShippingCost($id_carrier, $use_tax, $default_country, $product_list, $id_zone, $keepOrderPrices);
                if ($sellerWiseShippingCost !== false) {
                    if (is_null($shipping_cost)) {
                        $shipping_cost = $sellerWiseShippingCost;
                    } else {
                        $shipping_cost += $sellerWiseShippingCost;
                    }
                }
            }
            if (Configuration::get('WK_SUBSCRIPTION_SHIPPING_FREE')) {
                return 0;
            }

            return !is_null($shipping_cost) ? $shipping_cost : false;
        } else {
            return parent::getPackageShippingCost($id_carrier, $use_tax, $default_country, $product_list, $id_zone, $keepOrderPrices);
        }
    }

    public function getSubscriptionPackageShippingCost(
        $id_carrier = null,
        $use_tax = true,
        Country $default_country = null,
        $product_list = null,
        $id_zone = null,
        bool $keepOrderPrices = false
    ) {
        if ($this->isVirtualCart()) {
            return 0;
        }
        if (!$default_country) {
            $default_country = Context::getContext()->country;
        }
        if (null === $product_list) {
            $products = $this->getProducts(false, false, null, true, $keepOrderPrices);
        } else {
            foreach ($product_list as $key => $value) {
                if ($value['is_virtual'] == 1) {
                    unset($product_list[$key]);
                }
            }
            $products = $product_list;
        }
        // code to apply shipping on subscription product if cart have both normal and subscription product
        if (!empty($products)) {
            $objSubsCart = new WkSubscriptionCartProducts();
            $whProductWise = $objSubsCart->getSplittedProductList($this);
            if (is_array($whProductWise) && in_array(1, $whProductWise)) {
                foreach ($products as $pro) {
                    if (isset($whProductWise[$pro['id_product']]) && $whProductWise[$pro['id_product']] == 0) {
                        return 0;
                    }
                }
            }
        }
        // end code
        if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_invoice') {
            $address_id = (int) $this->id_address_invoice;
        } elseif (is_array($product_list) && count($product_list)) {
            $prod = current($product_list);
            $address_id = (int) $prod['id_address_delivery'];
        } else {
            $address_id = null;
        }
        if (!Address::addressExists($address_id)) {
            $address_id = null;
        }
        if (null === $id_carrier && !empty($this->id_carrier)) {
            $id_carrier = (int) $this->id_carrier;
        }
        $cache_id = 'getPackageShippingCost_' . (int) $this->id . '_' . (int) $address_id . '_' . (int) $id_carrier . '_' . (int) $use_tax . '_' . (int) $default_country->id . '_' . (int) $id_zone;
        if ($products) {
            foreach ($products as $product) {
                $cache_id .= '_' . (int) $product['id_product'] . '_' . (int) $product['id_product_attribute'];
            }
        }
        if (Cache::isStored($cache_id)) {
            return Cache::retrieve($cache_id);
        }
        $order_total = $this->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING, $product_list, $id_carrier, false, $keepOrderPrices);
        $shipping_cost = 0;
        if (!count($products)) {
            Cache::store($cache_id, $shipping_cost);

            return $shipping_cost;
        }
        if (!isset($id_zone)) {
            if (!$this->isMultiAddressDelivery()
                && isset($this->id_address_delivery) // Be careful, id_address_delivery is not useful one 1.5
                && $this->id_address_delivery
                && Customer::customerHasAddress($this->id_customer, $this->id_address_delivery)
            ) {
                $id_zone = Address::getZoneById((int) $this->id_address_delivery);
            } else {
                if (!Validate::isLoadedObject($default_country)) {
                    $default_country = new Country(Configuration::get('PS_COUNTRY_DEFAULT'), Configuration::get('PS_LANG_DEFAULT'));
                }
                $id_zone = (int) $default_country->id_zone;
            }
        }
        $this->typeWiseProducts = $product_list;
        if ($id_carrier && !$this->isCarrierInRange((int) $id_carrier, (int) $id_zone)) {
            $id_carrier = '';
        }
        if (empty($id_carrier) && $this->isCarrierInRange((int) Configuration::get('PS_CARRIER_DEFAULT'), (int) $id_zone)) {
            $id_carrier = (int) Configuration::get('PS_CARRIER_DEFAULT');
        }
        if (empty($id_carrier)) {
            if ((int) $this->id_customer) {
                $customer = new Customer((int) $this->id_customer);
                $result = Carrier::getCarriers((int) Configuration::get('PS_LANG_DEFAULT'), true, false, (int) $id_zone, $customer->getGroups());
                unset($customer);
            } else {
                $result = Carrier::getCarriers((int) Configuration::get('PS_LANG_DEFAULT'), true, false, (int) $id_zone);
            }
            foreach ($result as $k => $row) {
                if ($row['id_carrier'] == Configuration::get('PS_CARRIER_DEFAULT')) {
                    continue;
                }
                if (!isset(self::$_carriers[$row['id_carrier']])) {
                    self::$_carriers[$row['id_carrier']] = new Carrier((int) $row['id_carrier']);
                }
                $carrier = self::$_carriers[$row['id_carrier']];
                $shipping_method = $carrier->getShippingMethod();
                if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $carrier->getMaxDeliveryPriceByWeight((int) $id_zone) === false)
                    || ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $carrier->getMaxDeliveryPriceByPrice((int) $id_zone) === false)) {
                    unset($result[$k]);
                    continue;
                }
                if ($row['range_behavior']) {
                    $check_delivery_price_by_weight = Carrier::checkDeliveryPriceByWeight($row['id_carrier'], $this->getTotalWeight(), (int) $id_zone);
                    $check_delivery_price_by_price = Carrier::checkDeliveryPriceByPrice($row['id_carrier'], $order_total, (int) $id_zone, (int) $this->id_currency);
                    if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && !$check_delivery_price_by_weight)
                        || ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && !$check_delivery_price_by_price)) {
                        unset($result[$k]);
                        continue;
                    }
                }
                if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT) {
                    $shipping = $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list), (int) $id_zone);
                } else {
                    $shipping = $carrier->getDeliveryPriceByPrice($order_total, (int) $id_zone, (int) $this->id_currency);
                }
                if (!isset($min_shipping_price)) {
                    $min_shipping_price = $shipping;
                }
                if ($shipping <= $min_shipping_price) {
                    $id_carrier = (int) $row['id_carrier'];
                    $min_shipping_price = $shipping;
                }
            }
        }
        if (empty($id_carrier)) {
            $id_carrier = Configuration::get('PS_CARRIER_DEFAULT');
        }
        if (!isset(self::$_carriers[$id_carrier])) {
            self::$_carriers[$id_carrier] = new Carrier((int) $id_carrier, Configuration::get('PS_LANG_DEFAULT'));
        }
        $carrier = self::$_carriers[$id_carrier];
        if (!Validate::isLoadedObject($carrier)) {
            Cache::store($cache_id, 0);

            return 0;
        }
        $shipping_method = $carrier->getShippingMethod();
        if (!$carrier->active) {
            Cache::store($cache_id, $shipping_cost);

            return $shipping_cost;
        }
        if ($carrier->is_free == 1) {
            Cache::store($cache_id, 0);

            return 0;
        }
        if ($use_tax && !Tax::excludeTaxeOption()) {
            $address = Address::initialize((int) $address_id);
            if (Configuration::get('PS_ATCP_SHIPWRAP')) {
                $carrier_tax = 0;
            } else {
                $carrier_tax = $carrier->getTaxesRate($address);
            }
        }
        $configuration = Configuration::getMultiple([
            'PS_SHIPPING_FREE_PRICE',
            'PS_SHIPPING_HANDLING',
            'PS_SHIPPING_METHOD',
            'PS_SHIPPING_FREE_WEIGHT',
        ]);
        $free_fees_price = 0;
        if (isset($configuration['PS_SHIPPING_FREE_PRICE'])) {
            $free_fees_price = Tools::convertPrice((float) $configuration['PS_SHIPPING_FREE_PRICE'], Currency::getCurrencyInstance((int) $this->id_currency));
        }
        $orderTotalwithDiscounts = $this->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING, null, null, false);
        if ($orderTotalwithDiscounts >= (float) $free_fees_price && (float) $free_fees_price > 0) {
            $shipping_cost = $this->getPackageShippingCostFromModule($carrier, $shipping_cost, $products);
            Cache::store($cache_id, $shipping_cost);

            return $shipping_cost;
        }
        if (isset($configuration['PS_SHIPPING_FREE_WEIGHT'])
            && $this->getTotalWeight() >= (float) $configuration['PS_SHIPPING_FREE_WEIGHT']
            && (float) $configuration['PS_SHIPPING_FREE_WEIGHT'] > 0) {
            $shipping_cost = $this->getPackageShippingCostFromModule($carrier, $shipping_cost, $products);
            Cache::store($cache_id, $shipping_cost);

            return $shipping_cost;
        }
        if ($carrier->range_behavior) {
            if (!$id_zone) {
                if (isset($this->id_address_delivery)
                    && $this->id_address_delivery
                    && Customer::customerHasAddress($this->id_customer, $this->id_address_delivery)) {
                    $id_zone = Address::getZoneById((int) $this->id_address_delivery);
                } else {
                    $id_zone = (int) $default_country->id_zone;
                }
            }
            if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && !Carrier::checkDeliveryPriceByWeight($carrier->id, $this->getTotalWeight(), (int) $id_zone))
                || (
                    $shipping_method == Carrier::SHIPPING_METHOD_PRICE && !Carrier::checkDeliveryPriceByPrice($carrier->id, $order_total, $id_zone, (int) $this->id_currency)
                )) {
                $shipping_cost += 0;
            } else {
                if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT) {
                    $shipping_cost += $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list), $id_zone);
                } else { // by price
                    $shipping_cost += $carrier->getDeliveryPriceByPrice($order_total, $id_zone, (int) $this->id_currency);
                }
            }
        } else {
            if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT) {
                $shipping_cost += $carrier->getDeliveryPriceByWeight($this->getTotalWeight($product_list), $id_zone);
            } else {
                $shipping_cost += $carrier->getDeliveryPriceByPrice($order_total, $id_zone, (int) $this->id_currency);
            }
        }
        if (isset($configuration['PS_SHIPPING_HANDLING']) && $carrier->shipping_handling) {
            $shipping_cost += (float) $configuration['PS_SHIPPING_HANDLING'];
        }
        foreach ($products as $product) {
            if (!$product['is_virtual']) {
                $shipping_cost += $product['additional_shipping_cost'] * $product['cart_quantity'];
            }
        }
        $shipping_cost = Tools::convertPrice($shipping_cost, Currency::getCurrencyInstance((int) $this->id_currency));
        $shipping_cost = $this->getPackageShippingCostFromModule($carrier, $shipping_cost, $products);
        if ($shipping_cost === false) {
            Cache::store($cache_id, false);

            return false;
        }
        if (Configuration::get('PS_ATCP_SHIPWRAP')) {
            if (!$use_tax) {
                $shipping_cost /= (1 + $this->getAverageProductsTaxRate());
            }
        } else {
            if ($use_tax && isset($carrier_tax)) {
                $shipping_cost *= 1 + ($carrier_tax / 100);
            }
        }
        $shipping_cost = (float) Tools::ps_round((float) $shipping_cost, Context::getContext()->getComputingPrecision());
        Cache::store($cache_id, $shipping_cost);

        return $shipping_cost;
    }

    public function isCarrierInRange($id_carrier, $id_zone)
    {
        if (Module::isEnabled('wkproductsubscription') && Configuration::get('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION')) {
            $product_list = $this->typeWiseProducts;
            $carrier = new Carrier((int) $id_carrier, Configuration::get('PS_LANG_DEFAULT'));
            $shipping_method = $carrier->getShippingMethod();
            if (!$carrier->range_behavior) {
                return true;
            }
            if ($shipping_method == Carrier::SHIPPING_METHOD_FREE) {
                return true;
            }
            $check_delivery_price_by_weight = Carrier::checkDeliveryPriceByWeight(
                (int) $id_carrier,
                $this->getTotalWeight($product_list),
                $id_zone
            );
            if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $check_delivery_price_by_weight) {
                return true;
            }
            $check_delivery_price_by_price = Carrier::checkDeliveryPriceByPrice(
                (int) $id_carrier,
                $this->getOrderTotal(
                    true,
                    Cart::BOTH_WITHOUT_SHIPPING,
                    $product_list
                ),
                $id_zone,
                (int) $this->id_currency
            );
            if ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $check_delivery_price_by_price) {
                return true;
            }

            return false;
        } else {
            return parent::isCarrierInRange($id_carrier, $id_zone);
        }
    }
}
