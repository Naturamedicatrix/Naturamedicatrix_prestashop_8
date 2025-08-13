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

class WkProductSubscriptionGlobal
{
    private $context;
    private $id_lang;
    private $id_shop;
    private $currency;
    public $id_currency;
    // public $subscriptionData;
    private $module;

    public const WK_SUBS_DISCOUNT_FIXED = 1;
    public const WK_SUBS_DISCOUNT_PERCENTAGE = 2;

    public const WK_SUBS_FEATURE_CREATE = 1;
    public const WK_SUBS_FEATURE_UPDATE = 2;
    public const WK_SUBS_FEATURE_PAUSE = 3;
    public const WK_SUBS_FEATURE_RESUME = 4;
    public const WK_SUBS_FEATURE_CANCEL = 5;
    public const WK_SUBS_FEATURE_AUTORENEW = 6;
    public const WK_SUBS_FEATURE_SPLIT_ORDER = 7;
    public const WK_SUBS_FEATURE_UPDATE_FREQUENCY = 8;

    public function __construct()
    {
        // Create module instance
        $this->module = Module::getInstanceByName('wkproductsubscription');

        $this->context = Context::getContext();
        $this->id_lang = (int) $this->context->language->id;
        $this->id_shop = (int) $this->context->shop->id;
        $this->id_currency = (int) $this->context->currency->id;
        $this->currency = $this->context->currency;
    }

    /**
     * Get subscription product details by id_product
     *
     * @param int $idProduct
     *
     * @return array details of subscription product
     */
    public function getSubscriptionProductDetails($idProduct)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT wk_subscription_products_shop.*
            FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
            . Shop::addSqlAssociation('wk_subscription_products', 'a') .
            ' WHERE wk_subscription_products_shop.id_product = ' . (int) $idProduct . '
        ');
    }

    /**
     * Return next delivery date based on frequency, cycle and last delivery date
     *
     * @param mixed $frequency
     * @param int $cycle
     * @param mixed $lastDeliveryDate
     *
     * @return mixed
     */
    public function getNextDeliveryDate($frequency, $cycle, $lastDeliveryDate, $no_of_pause_day = 0)
    {
        $frequency1 = null;
        if ($frequency == 'weekly') {
            $frequency1 = 'weeks';
        } elseif ($frequency == 'monthly') {
            $frequency1 = 'months';
        } elseif ($frequency == 'yearly') {
            $frequency1 = 'years';
        } else {
            $frequency1 = 'days';
        }

        $nextDate = date('Y-m-d', strtotime('+' . $cycle . ' ' . $frequency1, strtotime($lastDeliveryDate)));

        if ($no_of_pause_day) {
            $nextDate = date('Y-m-d H:i:s', strtotime($nextDate . ' + ' . $no_of_pause_day . ' days'));
        }

        $todayTimestamp = strtotime(date('Y-m-d'));
        $nextTimestamp = strtotime($nextDate);

        if ($todayTimestamp < $nextTimestamp) {
            return $nextDate;
        } else {
            return $this->getNextDeliveryDate($frequency, $cycle, $nextDate, $no_of_pause_day);
        }
    }

    /**
     * Get upcoming delivery schedule
     *
     * @param mixed $frequency
     * @param int $cycle
     * @param mixed $lastDeliveryDate
     * @param int $count
     *
     * @return array
     */
    public function getUpcomingDeliveryDates($frequency, $cycle, $lastDeliveryDate, $count = 10)
    {
        $deliveryDetails = [];
        $nextDate = $this->getNextDeliveryDate(
            $frequency,
            $cycle,
            $lastDeliveryDate
        );

        $deliveryDetails[] = $nextDate;
        for ($i = 1; $i < $count; ++$i) {
            $nextDate = $this->getNextDeliveryDate(
                $frequency,
                $cycle,
                $nextDate
            );
            $deliveryDetails[] = $nextDate;
        }

        return $deliveryDetails;
    }

    /**
     * Get upcoming delivery details by subscriber id
     *
     * @param int $idSubscriber Subscriber ID
     * @param int $count Number of delivery records
     *
     * @return array<int, array<string, mixed>> List of delivery records
     */
    public function getUpcomingDeliveryDetails($idSubscriber, $count = 10)
    {
        if (!$idSubscriber) {
            return [];
        }

        $deliveryDetails = [];

        $subscriptions = $this->getSubscriberSubscriptionData($idSubscriber, true);

        if ($subscriptions) {
            $k = 0;
            foreach ($subscriptions as $subsData) {
                if ($subsData['is_virtual']) {
                    continue;
                }
                if (!$subsData['active']) {
                    continue;
                }
                foreach ($subsData['next_deliveries'] as $value) {
                    $deliveryDetails[$k]['id_subscription'] = $subsData['id_subscription'];
                    $deliveryDetails[$k]['id_subscriber'] = $subsData['id_subscriber'];
                    $deliveryDetails[$k]['id_address'] = $subsData['id_address_delivery'];
                    $deliveryDetails[$k]['id_carrier'] = $subsData['id_carrier'];
                    $deliveryDetails[$k]['id_payment'] = $subsData['id_payment'];
                    $deliveryDetails[$k]['id_customer'] = $subsData['id_customer'];
                    $deliveryDetails[$k]['id_product'] = $subsData['id_product'];
                    $deliveryDetails[$k]['product_name'] = $subsData['product_name'];
                    $deliveryDetails[$k]['unit_price'] = $subsData['unit_price'];
                    $deliveryDetails[$k]['quantity'] = $subsData['quantity'];
                    $deliveryDetails[$k]['shipping_charge'] = $subsData['shipping_charge'];
                    $deliveryDetails[$k]['discount'] = $subsData['discount'];
                    $deliveryDetails[$k]['total_amount'] = $subsData['total_amount'];
                    $deliveryDetails[$k]['shipping_method'] = $subsData['carrier_details']['name'];
                    $deliveryDetails[$k]['payment_method'] = $subsData['payment_method'];
                    $deliveryDetails[$k]['upcoming_delivery'] = $value;
                    ++$k;
                }
            }
            usort($deliveryDetails, function ($a, $b) {
                $t1 = strtotime($a['upcoming_delivery']);
                $t2 = strtotime($b['upcoming_delivery']);

                return $t1 - $t2;
            });
            $deliveryDetails = array_slice($deliveryDetails, 0, $count);
        }

        return $deliveryDetails;
    }

    /**
     * getProductImageUrl
     *
     * @param Product $product
     *
     * @return mixed
     */
    public function getProductImageUrl(Product $product, $id_product_attribute)
    {
        $imageUrl = '';
        $image = Product::getCover($product->id);
        $coverImg = Product::getCombinationImageById($id_product_attribute, $this->context->language->id);
        if ($coverImg) {
            $image = $coverImg;
        }
        $protocol = (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE')) ?
        'https://' :
        'http://';
        if ($image) {
            $link = new Link(null, $protocol);
            $imageUrl = $link->getImageLink(
                $product->link_rewrite,
                $image['id_image'],
                ImageType::getFormattedName('home')
            );
        } else {
            $imgPath = _THEME_PROD_DIR_ . $this->context->language->iso_code;
            $imageUrl = $imgPath . '-default-' . ImageType::getFormattedName('medium') . '.jpg';
        }

        return $imageUrl;
    }

    /**
     * Get subscriber subscription data
     *
     * @param int $idSubscriber Subscriber ID
     * @param bool $active Active subscription
     *
     * @return array
     */
    public function getSubscriberSubscriptionData($idSubscriber, $active = true)
    {
        $subscriptionData = [];

        if (!$idSubscriber) {
            return [];
        }

        $sql = 'SELECT p.id_wk_subscription_subscriber_products as id_subscription
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` s
            RIGHT JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` p
            ON p.id_subscriber = s.id_wk_subscription_subscribers
            WHERE s.id_wk_subscription_subscribers = ' . (int) $idSubscriber . '
            AND p.deleted = 0 ' .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 's') .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'p')
        ;

        if ($active) {
            $sql .= ' AND p.active = ' . (int) $active;
        }
        $sql .= ' ORDER BY p.id_wk_subscription_subscriber_products DESC';

        $subscriptions = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($subscriptions) {
            foreach ($subscriptions as $value) {
                $subscriptionData[] = $this->getSubscriptionDetails((int) $value['id_subscription']);
            }
        }

        return $subscriptionData;
    }

    public static function hasActiveSubscriptions()
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT p.id_wk_subscription_subscriber_products as id_subscription
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` s
            RIGHT JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` p
            ON p.id_subscriber = s.id_wk_subscription_subscribers
            WHERE s.active = 1 AND p.deleted = 0 AND p.active = 1' .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'p') .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 's')
        );
    }

    public function getTodayResumeSubscriptions($date)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` p
                WHERE p.active = ' . (int) WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE .
                Shop::addSqlRestriction(Shop::SHARE_ORDER, 'p') . ' AND p.`pause_up_to` < \'' . pSQL($date) . '\'
                AND p.deleted = 0';

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    /**
     * Get customer [subscriber] subscription product details
     *
     * @param mixed $idSubscription
     * @param mixed $idCustomer
     *
     * @return array|false
     */
    public function getSubscriptionDetails($idSubscription, $idCustomer = 0)
    {
        if (!$idSubscription) {
            return false;
        }

        $sql = 'SELECT p.*, c.id_customer,
                p.id_wk_subscription_subscriber_products as id_subscription
                FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` p
                INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscribers` c
                ON c.id_wk_subscription_subscribers = p.id_subscriber
                WHERE p.id_wk_subscription_subscriber_products = ' . (int) $idSubscription .
                Shop::addSqlRestriction(Shop::SHARE_ORDER, 'p') . '
                AND p.deleted = 0';

        if ($idCustomer) {
            $sql .= ' AND c.id_customer = ' . (int) $idCustomer;
        }

        $subsData = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

        if ($subsData) {
            $idProduct = (int) $subsData['id_product'];
            $prodObj = new Product($idProduct, false, $this->id_lang, $subsData['id_shop']);

            $subsData['product_name'] = $prodObj->name;
            $subsData['product_ref'] = !empty($prodObj->reference) ? $prodObj->reference : '-';
            $attributes = $prodObj->getAttributeCombinationsById(
                (int) $subsData['id_product_attribute'],
                $this->id_lang
            );

            $subsData['has_attributes'] = $prodObj->hasAttributes();
            $subsData['attributes'] = $attributes;
            if (Shop::isFeatureActive()) {
                if ($subsData['id_shop'] == $this->id_shop) {
                    $subsData['product_link'] = $this->context->link->getProductLink(
                        $prodObj,
                        $prodObj->link_rewrite,
                        Category::getLinkRewrite((int) $prodObj->id_category_default, (int) $this->id_lang)
                    );
                    $subsData['allow_actions'] = true;
                } else {
                    $subsData['product_link'] = 'javascript:void(0);';
                    $subsData['allow_actions'] = false;
                }
            } else {
                $subsData['product_link'] = $this->context->link->getProductLink(
                    $prodObj,
                    $prodObj->link_rewrite,
                    Category::getLinkRewrite((int) $prodObj->id_category_default, (int) $this->id_lang)
                );
                $subsData['allow_actions'] = true;
            }

            if (Tools::getValue('controller') == 'AdminCustomerSubscription') {
                if (version_compare(_PS_VERSION_, '8.0.0', '>=')) {
                    $adminToken = Tools::getAdminTokenLite('AdminProducts');
                    $product_bo_link = $this->context->link->getBaseLink()
                        . basename(_PS_ADMIN_DIR_) . '/'
                        . 'index.php/sell/catalog/products-v2/' . (int) $idProduct . '/edit?_token=' . $adminToken;
                } elseif (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
                    $product_bo_link = $this->context->link->getAdminLink(
                        'AdminProducts',
                        true,
                        ['id_product' => (int) $idProduct]
                    );
                } elseif (version_compare(_PS_VERSION_, '1.7', '>=')) {
                    $product_bo_link = $this->context->link->getAdminLink(
                        'AdminProducts',
                        true,
                        [],
                        ['id_product' => (int) $idProduct]
                    );
                } else {
                    $product_bo_link = $this->context->link->getAdminLink('AdminProducts') . '&id_product=' . (int) $idProduct . '&updateproduct';
                }

                $subsData['product_bo_link'] = $product_bo_link;
            }

            $subsData['raw_unit_price'] = Tools::convertPriceFull(
                $subsData['unit_price'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );
            $subsData['unit_price'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['unit_price'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_total_price'] = Tools::convertPriceFull(
                $subsData['total_price'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );
            $subsData['total_price'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['total_price'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_shipping_charge'] = Tools::convertPriceFull(
                $subsData['shipping_charge'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );

            $subsData['shipping_charge'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['shipping_charge'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_discount'] = Tools::convertPriceFull(
                $subsData['discount'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );

            $subsData['discount'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['discount'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_base_price'] = Tools::convertPriceFull(
                $subsData['base_price'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );

            $subsData['base_price'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['base_price'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_tax_amount'] = Tools::convertPriceFull(
                $subsData['tax_amount'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );

            $subsData['tax_amount'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['tax_amount'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['raw_total_amount'] = Tools::convertPriceFull(
                $subsData['total_amount'],
                new Currency((int) $subsData['id_currency']),
                $this->context->currency
            );

            $subsData['total_amount'] = WkProductSubscription::displayPrice(
                Tools::convertPriceFull(
                    $subsData['total_amount'],
                    new Currency((int) $subsData['id_currency']),
                    $this->context->currency
                ),
                $this->context->currency
            );

            $subsData['image'] = $this->getProductImageUrl($prodObj, $subsData['id_product_attribute']);

            $subsData['frequency_string'] = $this->getFrequencyString($subsData['frequency']);
            $subsData['first_delivery_date'] = date('Y-m-d', strtotime($subsData['first_delivery_date']));

            $subsData['next_delivery_date'] = $this->getNextDeliveryDate(
                $subsData['frequency'],
                $subsData['cycle'],
                $subsData['first_delivery_date'],
                $subsData['no_of_pause_day']
            );

            $subsData['first_order_date'] = date('Y-m-d', strtotime($subsData['first_order_date']));

            $subsData['next_order_date'] = $this->getNextOrderDate(
                $subsData['id_subscription'],
                $subsData['frequency'],
                $subsData['cycle'],
                $subsData['no_of_pause_day'],
                $subsData['is_virtual']
            );

            if (!$subsData['is_virtual']) {
                $orderPriorDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');

                $subsData['next_order_delivery_date'] = date(
                    'Y-m-d',
                    strtotime("+$orderPriorDays days", strtotime($subsData['next_order_date']))
                );
            } else {
                $subsData['next_order_delivery_date'] = $subsData['next_order_date'];
            }

            if (!$subsData['is_virtual']) {
                $subsData['carrier_details'] = [];
                // Set current carrier id
                $carrier = Carrier::getCarrierByReference($subsData['id_carrier'], $this->id_lang);
                if ($carrier) {
                    $subsData['id_carrier'] = (int) $carrier->id;
                } else {
                    $subsData['id_carrier'] = (int) $subsData['id_carrier'];
                }
                if ($subsData['no_of_pause_day']) {
                    $subsData['next_deliveries'] = $this->getUpcomingDeliveryDates(
                        $subsData['frequency'],
                        $subsData['cycle'],
                        date('Y-m-d H:i:s', strtotime($subsData['first_delivery_date'] . ' + ' . $subsData['no_of_pause_day'] . ' days'))
                    );
                } else {
                    $subsData['next_deliveries'] = $this->getUpcomingDeliveryDates(
                        $subsData['frequency'],
                        $subsData['cycle'],
                        date('Y-m-d H:i:s', strtotime($subsData['first_delivery_date']))
                    );
                }

                $objCarrier = new Carrier((int) $subsData['id_carrier'], $this->id_lang);
                if (Validate::isLoadedObject($objCarrier)) {
                    $subsData['carrier_details'] = (array) $objCarrier;
                }
            }

            $custObj = new Customer((int) $subsData['id_customer']);

            $deliveryAddrDetails = $custObj->getSimpleAddress(
                (int) $subsData['id_address_delivery'],
                $this->id_lang
            );

            if (isset($deliveryAddrDetails[0]) && is_array($deliveryAddrDetails[0])) {
                foreach ($deliveryAddrDetails as $addr) {
                    if ($addr['id'] == $subsData['id_address_delivery']) {
                        $subsData['address_details'] = $addr;
                        break;
                    }
                }
            } else {
                $subsData['address_details'] = $deliveryAddrDetails;
            }

            $invoiceAddrDetails = $custObj->getSimpleAddress(
                (int) $subsData['id_address_invoice'],
                $this->id_lang
            );

            if (isset($invoiceAddrDetails[0]) && is_array($invoiceAddrDetails[0])) {
                foreach ($invoiceAddrDetails as $addr) {
                    if ($addr['id'] == $subsData['id_address_invoice']) {
                        $subsData['address_details_invoice'] = $addr;
                        break;
                    }
                }
            } else {
                $subsData['address_details_invoice'] = $invoiceAddrDetails;
            }
        }

        return $subsData;
    }

    /**
     * Get next order date based on last delivery date
     *
     * @param mixed $idSubscription
     * @param mixed $frequency
     * @param mixed $cycle
     *
     * @return string Next order date
     */
    public function getNextOrderDate($idSubscription, $frequency, $cycle, $no_of_pause_day = 0, $virtual = false)
    {
        if (!$idSubscription) {
            return '';
        }

        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );

        $lastOrderDate = Db::getInstance()->getValue('SELECT wk_subscription_schedule_shop.delivery_date
                    FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
                    . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
                    ' WHERE a.id_subscription = ' . (int) $idSubscription . '
                    ORDER BY a.id_wk_subscription_schedule DESC
                    ');

        $frequency1 = null;
        if ($frequency == 'weekly') {
            $frequency1 = 'weeks';
        } elseif ($frequency == 'monthly') {
            $frequency1 = 'months';
        } elseif ($frequency == 'yearly') {
            $frequency1 = 'years';
        } else {
            $frequency1 = 'days';
        }

        $today = date('Y-m-d');
        if (strtotime($lastOrderDate) > strtotime($today)) {
            $lastOrderDate = Db::getInstance()->getValue('SELECT wk_subscription_schedule_shop.delivery_date
                FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
                . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
                ' WHERE a.id_subscription = ' . (int) $idSubscription . '
                AND a.is_order_created != 0
                ORDER BY a.id_wk_subscription_schedule DESC');
        }
        $orderPriorDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');
        $nextOrderDate = date('Y-m-d', strtotime('+' . $cycle . ' ' . $frequency1, strtotime($lastOrderDate)));
        if (!$virtual) {
            $nextOrderDate = date('Y-m-d', strtotime("-$orderPriorDays days", strtotime($nextOrderDate)));
        }
        if ($no_of_pause_day) {
            $nextOrderDate = date('Y-m-d H:i:s', strtotime($nextOrderDate . ' + ' . $no_of_pause_day . ' days'));
        }
        if (strtotime(date('Y-m-d')) > strtotime($nextOrderDate)) {
            return $this->getMissedNextOrderDate($nextOrderDate, $cycle, $frequency1);
        }

        return $nextOrderDate;
    }

    /**
     * Get next order date (future date) if renewal missed
     *
     * @param string $nextOrderDate
     * @param string $cycle
     * @param string $frequency
     *
     * @return string Next order date
     */
    public function getMissedNextOrderDate($nextOrderDate, $cycle, $frequency)
    {
        $nextOrderDate = date('Y-m-d', strtotime("+$cycle $frequency", strtotime($nextOrderDate)));
        if (strtotime(date('Y-m-d')) >= strtotime($nextOrderDate)) {
            return $this->getMissedNextOrderDate($nextOrderDate, $cycle, $frequency);
        } else {
            return $nextOrderDate;
        }
    }

    /**
     * Get upcoming delivery details by subscription id
     *
     * @param int $idSubscription Subscription ID
     * @param int $count Number of delivery records
     *
     * @return array<int, array<string, mixed>> List of delivery detail arrays
     */
    public function getUpcomingSubscriptionDeliveryDetails($idSubscription, $count = 10)
    {
        if (!$idSubscription) {
            return [];
        }

        $deliveryDetails = [];

        $subscriptions = $this->getSubscriptionDetails($idSubscription);

        if ($subscriptions) {
            $k = 0;
            if ($subscriptions['is_virtual']) {
                return [];
            }
            if (!$subscriptions['active']) {
                return [];
            }

            foreach ($subscriptions['next_deliveries'] as $k => $value) {
                $deliveryDetails[$k]['id_subscription'] = $subscriptions['id_subscription'];
                $deliveryDetails[$k]['id_subscriber'] = $subscriptions['id_subscriber'];
                $deliveryDetails[$k]['id_address'] = $subscriptions['id_address_delivery'];
                $deliveryDetails[$k]['id_carrier'] = $subscriptions['id_carrier'];
                $deliveryDetails[$k]['id_payment'] = $subscriptions['id_payment'];
                $deliveryDetails[$k]['id_customer'] = $subscriptions['id_customer'];
                $deliveryDetails[$k]['id_product'] = $subscriptions['id_product'];
                $deliveryDetails[$k]['product_name'] = $subscriptions['product_name'];
                $deliveryDetails[$k]['unit_price'] = $subscriptions['unit_price'];
                $deliveryDetails[$k]['quantity'] = $subscriptions['quantity'];
                $deliveryDetails[$k]['shipping_charge'] = $subscriptions['shipping_charge'];
                $deliveryDetails[$k]['discount'] = $subscriptions['discount'];
                $deliveryDetails[$k]['total_amount'] = $subscriptions['total_amount'];
                $deliveryDetails[$k]['shipping_method'] = $subscriptions['carrier_details']['name'];
                $deliveryDetails[$k]['payment_method'] = $subscriptions['payment_method'];
                $deliveryDetails[$k]['upcoming_delivery'] = $value;
            }

            usort($deliveryDetails, function ($a, $b) {
                $t1 = strtotime($a['upcoming_delivery']);
                $t2 = strtotime($b['upcoming_delivery']);

                return $t1 - $t2;
            });
            $deliveryDetails = array_slice($deliveryDetails, 0, $count);
        }

        return $deliveryDetails;
    }

    /**
     * getFrequencyString
     *
     * @param string $frequency
     *
     * @return string
     */
    public function getFrequencyString($frequency)
    {
        $frequencyString = $this->module->l('Every %d year', 'WkProductSubscriptionGlobal');
        if ($frequency == 'weekly') {
            $frequencyString = $this->module->l('Every %d week', 'WkProductSubscriptionGlobal');
        } elseif ($frequency == 'monthly') {
            $frequencyString = $this->module->l('Every %d month', 'WkProductSubscriptionGlobal');
        } elseif ($frequency == 'yearly') {
            $frequencyString = $this->module->l('Every %d year', 'WkProductSubscriptionGlobal');
        } elseif ($frequency == 'daily') {
            $frequencyString = $this->module->l('Every %d day', 'WkProductSubscriptionGlobal');
        }

        return $frequencyString;
    }

    /**
     * Get product subscriber count by product id
     *
     * @param int $idProduct Product ID
     *
     * @return int Number of subscriber of this product
     */
    public static function getProductSubscriberCount($idProduct, $idProductAttr = 0)
    {
        $sql = 'SELECT
        COUNT(DISTINCT(a.id_subscriber)) AS count
        FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
        WHERE a.id_product = ' . (int) $idProduct;

        if ($idProductAttr) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $idProductAttr;
        }

        $sql .= Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a') . '
             GROUP BY id_product, id_product_attribute';

        $count = Db::getInstance()->getValue($sql);

        if ($count > 0) {
            return (int) $count;
        }

        return 0;
    }

    /**
     * Get product subscription count by product id
     *
     * @param int $idProduct Product ID
     *
     * @return int Number of subscription of this product
     */
    public static function getProductSubscriptionCount($idProduct, $idProductAttr = 0)
    {
        $sql = 'SELECT SUM(a.quantity) AS count
        FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
        WHERE a.id_product = ' . (int) $idProduct;

        if ($idProductAttr) {
            $sql .= ' AND a.`id_product_attribute` = ' . (int) $idProductAttr;
        }

        $sql .= Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a') . '
                GROUP BY id_product, id_product_attribute';

        $count = Db::getInstance()->getValue($sql);

        if ($count > 0) {
            return (int) $count;
        }

        return 0;
    }

    public static function getProductSubscriptionFrequencyCount($idProduct, $idProductAttr = 0)
    {
        $sql = 'SELECT a.frequency,
            a.cycle, COUNT(*) AS count
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
            WHERE a.id_product = ' . (int) $idProduct .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a');

        if ($idProductAttr) {
            $sql .= ' AND a.id_product_attribute = ' . (int) $idProductAttr;
        }

        $sql .= ' GROUP BY a.frequency,
            a.cycle ORDER BY count DESC';

        $counts = Db::getInstance()->getRow($sql);

        return $counts;
    }

    public static function getProductSubsId($idSubsProduct)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        return Db::getInstance()->getValue('SELECT wk_subscription_products_shop.`id_product`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_products` a '
            . Shop::addSqlAssociation('wk_subscription_products', 'a') .
            ' WHERE a.`id_wk_subscription_products` = ' . (int) $idSubsProduct);
    }

    /**
     * Check if customer is subscriber
     *
     * @param int $idCustomer Customer ID
     *
     * @return int Subscriber ID
     */
    public static function isSubscriber($idCustomer)
    {
        if (!$idCustomer) {
            return 0;
        }

        return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT a.`id_wk_subscription_subscribers` FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` a
            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.id_customer = a.id_customer)
            WHERE a.id_customer = ' . (int) $idCustomer .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'a')
        );
    }

    /**
     * Check if customer is active subscriber
     *
     * @param int $idCustomer Customer ID
     *
     * @return int 1 if active, 0 otherwise
     */
    public static function isActiveSubscriber($idCustomer)
    {
        if (!$idCustomer) {
            return 0;
        }

        if (self::isSubscriber($idCustomer)) {
            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
                'SELECT a.`active`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` a
            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.id_customer = a.id_customer)
            WHERE a.id_customer = ' . (int) $idCustomer .
                Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'a')
            );
        }

        return 0;
    }

    /**
     * Get list of active subscribers
     *
     * @return array
     */
    public static function getActiveSubscribers()
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT s.* FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` s
            INNER JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.id_customer = s.id_customer)
            WHERE s.active = 1 AND c.active = 1 ' .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 's')
        );
    }

    /**
     * Get customer id by subsriber id
     *
     * @param int $idSubscriber Subscriber ID
     *
     * @return int Customer ID
     */
    public static function getCustomerID($idSubscriber)
    {
        if (!$idSubscriber) {
            return 0;
        }

        return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT a.id_customer FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` a
            WHERE a.id_wk_subscription_subscribers = ' . (int) $idSubscriber .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'a')
        );
    }

    /**
     * Get the number of products subscribed the subscriber
     *
     * @param mixed $idSubscriber Subscriber ID
     *
     * @return int
     */
    public static function getSubscriberProductCount($idSubscriber)
    {
        $count = Db::getInstance()->getValue('SELECT
            COUNT(DISTINCT(a.id_product)) AS count
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
            WHERE a.id_subscriber = ' . (int) $idSubscriber .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a') . '
            AND a.active = 1
            AND a.deleted = 0
            GROUP BY a.id_subscriber');
        if ($count > 0) {
            return (int) $count;
        }

        return 0;
    }

    /**
     * Get the number of product quantities subscribed the subscriber
     *
     * @param mixed $idSubscriber Subscriber ID
     *
     * @return int
     */
    public static function getSubscriberProductQtyCount($idSubscriber)
    {
        $count = Db::getInstance()->getValue('SELECT SUM(a.quantity) AS count
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
             WHERE a.id_subscriber = ' . (int) $idSubscriber
            . Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a') .
            ' AND a.active = 1
            AND a.deleted = 0
            GROUP BY a.id_subscriber
        ');

        if ($count > 0) {
            return (int) $count;
        }

        return 0;
    }

    /**
     * Get the number of product quantities subscribed the subscriber
     *
     * @param mixed $idSubscriber Subscriber ID
     *
     * @return int
     */
    public static function getSubscriberProductTotalAmount($idSubscriber)
    {
        $totalAmt = 0;
        $subsData = Db::getInstance()->executeS(
            'SELECT a.total_amount, a.id_currency
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
            WHERE a.id_subscriber = ' . (int) $idSubscriber
            . Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a') .
            ' AND a.active = 1 AND a.deleted = 0'
        );

        if ($subsData) {
            foreach ($subsData as $value) {
                $totalAmt += self::convertCurrency(
                    $value['total_amount'],
                    $value['id_currency']
                );
            }
        }

        return $totalAmt;
    }

    /**
     * Convert amount from one currency to another
     *
     * @param float $amount
     * @param int $fromCurrency
     * @param int|null $toCurrency
     *
     * @return float
     */
    public static function convertCurrency($amount, $fromCurrency, $toCurrency = null)
    {
        if (is_null($toCurrency)) {
            $toCurrency = (int) Configuration::get('PS_CURRENCY_DEFAULT');
        }

        $fromCurrencyObj = new Currency($fromCurrency);
        $toCurrencyObj = new Currency($toCurrency);

        return Tools::convertPriceFull(
            $amount,
            $fromCurrencyObj,
            $toCurrencyObj
        );
    }

    public function getTomrowScheduledOrders()
    {
        $scheduledOrders = [];
        $subscriberSubs = [];
        $orderPriorDays = (int) Configuration::get('WK_SUBSCRIPTION_CRON_PRIOR_DAYS');
        $order_date = date('Y-m-d', strtotime('+1 days'));
        ++$orderPriorDays;
        $forDeliveryDate = date('Y-m-d', strtotime("+$orderPriorDays days"));
        $subscribers = self::getActiveSubscribers();
        if ($subscribers) {
            foreach ($subscribers as $subscriber) {
                $idSubscriber = (int) $subscriber['id_wk_subscription_subscribers'];
                $subscriptionData = $this->getSubscriberSubscriptionData($idSubscriber, true);
                if ($subscriptionData) {
                    $subscriberSubs[] = $subscriptionData;
                }
            }
        }

        if ($subscriberSubs) {
            foreach ($subscriberSubs as $subsData) {
                foreach ($subsData as $subsProduct) {
                    if ($subsProduct['active']
                        && ($subsProduct['id_shop'] == $this->id_shop)
                    ) {
                        if ($subsProduct['is_virtual']) {
                            $deliveryTimeStamp = strtotime($order_date);
                        } else {
                            $deliveryTimeStamp = strtotime($forDeliveryDate);
                        }
                        $subDelTimeStamp = strtotime($subsProduct['next_order_delivery_date']);
                        $firstDelTimeStamp = strtotime($subsProduct['first_delivery_date']);
                        if (($deliveryTimeStamp == $subDelTimeStamp)
                            && ($firstDelTimeStamp != $subDelTimeStamp)
                            || ($subsProduct['frequency'] == 'daily' && $subsProduct['cycle'] == '1')
                        ) {
                            $subsProduct['order_date'] = $order_date;
                            $scheduledOrders[] = $subsProduct;
                        }
                    }
                }
            }
        }

        return $scheduledOrders;
    }

    /**
     * getTodayScheduledOrders
     *
     * @param mixed $today
     *
     * @return array
     */
    public function getTodayScheduledOrders($today)
    {
        $scheduledOrders = [];
        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );

        $result = Db::getInstance()->executeS(
            'SELECT wk_subscription_schedule_shop.*
            FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` ss '
            . Shop::addSqlAssociation('wk_subscription_schedule', 'ss') .
            ' INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` ssp
            ON ssp.id_wk_subscription_subscriber_products = ss.id_subscription
            WHERE date(wk_subscription_schedule_shop.`order_date`) = date(\'' . pSQL($today) . '\')
            AND wk_subscription_schedule_shop.`is_order_created` = 0
            AND wk_subscription_schedule_shop.`active` = 1
            AND ssp.`active` = 1 ' .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'ssp')
        );

        if ($result) {
            foreach ($result as $k => $subs) {
                $scheduledData = $this->getSubscriptionDetails((int) $subs['id_subscription']);
                $firstDel = strtotime($scheduledData['first_delivery_date']);
                $nextDel = strtotime($scheduledData['next_delivery_date']);
                if ($firstDel != $nextDel) {
                    $scheduledOrders[$k] = $scheduledData;
                    $scheduledOrders[$k]['schedule'] = $subs;
                }
            }
        }

        return $scheduledOrders;
    }

    /**
     * Get subscription details by schedule id
     *
     * @param int $idSchedule Schedule ID
     *
     * @return array Subscription Date
     */
    public static function getSubscriptionByScheduleId($idSchedule)
    {
        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );

        return Db::getInstance()->getRow(
            'SELECT SQL_CALC_FOUND_ROWS wk_subscription_schedule_shop.* ,
            CONCAT(c.firstname, \' \', c.lastname) as name, c.email, ssp.*,
            pl.name as product_name
            FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
            . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
            ' INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` AS ssp
            ON ssp.id_wk_subscription_subscriber_products = a.id_subscription
            INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscribers` AS s
            ON s.id_wk_subscription_subscribers = ssp.id_subscriber
            INNER JOIN `' . _DB_PREFIX_ . 'customer` c
            ON (c.id_customer = s.id_customer)
            INNER JOIN `' . _DB_PREFIX_ . 'product_lang` pl
            ON (pl.id_product = ssp.id_product)
            WHERE 1 AND pl.id_lang = ' . (int) Context::getContext()->language->id . ' AND pl.name != \'\'
            AND wk_subscription_schedule_shop.id_wk_subscription_schedule = ' . (int) $idSchedule .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 's') .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'ssp')
        );
    }

    /**
     * Get Subscription Order Details
     *
     * @param mixed $idSubscriptionOrder Subscription Order Id
     *
     * @return array Order Details
     */
    public static function getSubscriptionOrderDetails($idSubscriptionOrder)
    {
        return Db::getInstance()->getRow(
            'SELECT o.* FROM `' . _DB_PREFIX_ . 'wk_subscription_orders` so
            INNER JOIN `' . _DB_PREFIX_ . 'orders` o
            ON o.id_order = so.id_order
            WHERE so.id_wk_subscription_orders = ' . (int) $idSubscriptionOrder .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'so')
        );
    }

    public function getSubscriptionDeliveredOrders($idSubscription)
    {
        $orderData = [];
        $orders = Db::getInstance()->executeS(
            'SELECT o.* FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` sp  INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_orders` so
            ON so.id_subscription = sp.id_wk_subscription_subscriber_products
            INNER JOIN `' . _DB_PREFIX_ . 'orders` o
            ON o.id_order = so.id_order
            WHERE sp.id_wk_subscription_subscriber_products = ' . (int) $idSubscription .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'sp') . '
            AND so.is_delivered = 1
            GROUP BY o.id_order
            ORDER BY o.id_order DESC'
        );

        if ($orders) {
            foreach ($orders as $key => $order) {
                $orderData[$key]['id_order'] = $order['id_order'];
                $orderData[$key]['reference'] = $order['reference'];
                $orderData[$key]['payment'] = $order['payment'];
                $orderData[$key]['id_currency'] = $order['id_currency'];
                $orderData[$key]['total_paid'] = WkProductSubscription::displayPrice(
                    Tools::convertPriceFull(
                        $order['total_paid'],
                        new Currency((int) $order['id_currency']),
                        $this->currency
                    ),
                    $this->currency
                );
                $orderData[$key]['delivery_date'] = date('Y-m-d', strtotime($order['delivery_date']));
                $orderData[$key]['order_date'] = date('Y-m-d', strtotime($order['date_add']));
                $ProductDetailObject = new OrderDetail();
                $productDetail = $ProductDetailObject->getList((int) $order['id_order']);
                $orderData[$key]['products'] = $productDetail;
                $carrierObj = new Carrier((int) $order['id_carrier']);
                $orderData[$key]['carrier_name'] = $carrierObj->name;
                $custObj = new Customer((int) $order['id_customer']);
                $deliveryAddrDetails = $custObj->getSimpleAddress(
                    (int) $order['id_address_delivery'],
                    $this->id_lang
                );
                if (isset($deliveryAddrDetails[0]) && is_array($deliveryAddrDetails[0])) {
                    foreach ($deliveryAddrDetails as $addr) {
                        if ($addr['id'] == $order['id_address_delivery']) {
                            $orderData[$key]['address_details'] = $addr;
                            break;
                        }
                    }
                } else {
                    $orderData[$key]['address_details'] = $deliveryAddrDetails;
                }
                $orderData[$key]['order_link_bo'] = $this->context->link->getAdminLink(
                    'AdminOrders',
                    true,
                    [
                        'id_order' => (int) $order['id_order'],
                        'vieworder' => 1,
                    ]
                );
                $orderData[$key]['order_link'] = $this->context->link->getPageLink(
                    'order-detail',
                    true,
                    null,
                    [
                        'id_order' => (int) $order['id_order'],
                    ]
                );
            }
        }

        return $orderData;
    }

    /**
     * Get subscriber delived orders
     *
     * @param mixed $idSubscriber
     *
     * @return array
     */
    public function getSubscriberDeliveredOrders($idSubscriber)
    {
        $orderData = [];
        $orders = Db::getInstance()->executeS(
            'SELECT o.* FROM `' . _DB_PREFIX_ . 'wk_subscription_subscribers` s
            INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` sp
            ON sp.id_subscriber = s.id_wk_subscription_subscribers
            INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_orders` so
            ON so.id_subscription = sp.id_wk_subscription_subscriber_products
            INNER JOIN `' . _DB_PREFIX_ . 'orders` o
            ON o.id_order = so.id_order
            WHERE s.id_wk_subscription_subscribers = ' . (int) $idSubscriber .
            Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 's') .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'sp') . '
            AND so.is_delivered = 1
            GROUP BY o.id_order
            ORDER BY o.id_order DESC'
        );

        if ($orders) {
            foreach ($orders as $key => $order) {
                $orderData[$key]['id_order'] = $order['id_order'];
                $orderData[$key]['reference'] = $order['reference'];
                $orderData[$key]['payment'] = $order['payment'];
                $orderData[$key]['id_currency'] = $order['id_currency'];
                $orderData[$key]['total_paid'] = WkProductSubscription::displayPrice(
                    Tools::convertPriceFull(
                        $order['total_paid'],
                        new Currency((int) $order['id_currency']),
                        $this->currency
                    ),
                    $this->currency
                );
                $orderData[$key]['delivery_date'] = date('Y-m-d', strtotime($order['delivery_date']));
                $orderData[$key]['order_date'] = date('Y-m-d', strtotime($order['date_add']));
                $ProductDetailObject = new OrderDetail();
                $productDetail = $ProductDetailObject->getList((int) $order['id_order']);
                $orderData[$key]['products'] = $productDetail;
                $carrierObj = new Carrier((int) $order['id_carrier']);
                $orderData[$key]['carrier_name'] = $carrierObj->name;
                $custObj = new Customer((int) $order['id_customer']);
                $deliveryAddrDetails = $custObj->getSimpleAddress(
                    (int) $order['id_address_delivery'],
                    $this->id_lang
                );
                if (isset($deliveryAddrDetails[0]) && is_array($deliveryAddrDetails[0])) {
                    foreach ($deliveryAddrDetails as $addr) {
                        if ($addr['id'] == $order['id_address_delivery']) {
                            $orderData[$key]['address_details'] = $addr;
                            break;
                        }
                    }
                } else {
                    $orderData[$key]['address_details'] = $deliveryAddrDetails;
                }
                $orderData[$key]['order_link'] = $this->context->link->getAdminLink(
                    'AdminOrders',
                    true,
                    [],
                    [
                        'id_order' => (int) $order['id_order'],
                        'vieworder' => '',
                    ]
                );
            }
        }

        return $orderData;
    }

    /**
     * Check if order is subscription order
     *
     * @param mixed $idOrder Order ID
     *
     * @return int Subscription Order ID
     */
    public static function isSubscriptionOrder($idOrder)
    {
        $idSubscriptionOrder = Db::getInstance()->getValue(
            'SELECT a.`id_wk_subscription_orders`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_orders` a
            WHERE a.id_order = ' . (int) $idOrder .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a')
        );
        if ($idSubscriptionOrder > 0) {
            return (int) $idSubscriptionOrder;
        } else {
            return 0;
        }
    }

    /**
     * Create order schedule
     *
     * @param int $idSubscription
     * @param string $firstDeliverDate
     *
     * @return bool|int
     */
    public function createOrderSchedule($idSubscription, $firstDeliverDate)
    {
        $scheudleObj = new WkSubscriberScheduleModel();
        $scheudleObj->id_subscription = (int) $idSubscription;
        $scheudleObj->order_date = date('Y-m-d');
        $scheudleObj->delivery_date = date('Y-m-d', strtotime($firstDeliverDate));
        $scheudleObj->is_order_created = 0;
        $scheudleObj->is_email_send = 1;
        $scheudleObj->active = 1;
        if ($scheudleObj->save()) {
            return $scheudleObj->id;
        }

        return false;
    }

    /**
     * Send subscription create mail to subscriber
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendSubscriptionCreationMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_create');

        return true;
    }

    /**
     * Send subscription cancel mail to subscriber
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendSubscriptionCancelMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_cancel');

        return true;
    }

    /**
     * Send subscription pause mail to subscriber and admin
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendSubscriptionPauseMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_pause');

        return true;
    }

    /**
     * Send subscription resume mail to subscriber and admin
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendSubscriptionResumeMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_resume');

        return true;
    }

    /**
     * Send subscription update mail to subscriber
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendSubscriptionUpdateMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_update');

        return true;
    }

    /**
     * Send scheduled order mail by cron
     *
     * @param int $idSubscription
     *
     * @return bool
     */
    public function sendPreOrderMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_renew');

        return true;
    }

    public function sendSubscriptionCancelByAdminMail($idSubscription)
    {
        $this->sendSubscriptionMail($idSubscription, 'subscription_cancel_by_admin');

        return true;
    }

    /**
     * Send Subscription Mail
     *
     * @param mixed $idSubscription
     * @param mixed $mailType
     *
     * @return void
     */
    private function sendSubscriptionMail($idSubscription, $mailType)
    {
        if (!Configuration::get('WK_SUBSCRIPTION_SEND_EMAIL')) {
            return;
        }

        if (!$idSubscription) {
            return;
        }

        $subsData = $this->getSubscriptionDetails((int) $idSubscription);

        if ($subsData) {
            $id_customer = (int) $subsData['id_customer'];
            $customer = new Customer((int) $id_customer);

            $subsData['frequency_label'] = sprintf(
                $subsData['frequency_string'],
                $subsData['cycle']
            );

            $shipping = '--';
            $status = '---';
            if (!$subsData['is_virtual']) {
                if (isset($subsData['carrier_details']['name'])) {
                    $shipping = $subsData['carrier_details']['name'];
                }
            }

            $attributes = '';
            $attributesArr = [];
            if ($subsData['has_attributes']) {
                foreach ($subsData['attributes'] as $value) {
                    $attributesArr[] = $value['group_name'] . ': ' . $value['attribute_name'];
                }
                $attributes = implode(', ', $attributesArr);
            }

            $my_subscription_url = $this->context->link->getModuleLink(
                'wkproductsubscription',
                'mysubscription'
            );

            if ($subsData['active'] == WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
                $status = 'Active';
            } elseif ($subsData['active'] == WkSubscriberProductModal::WK_SUBS_STATUS_CANCELLED) {
                $status = 'Cancelled';
            } elseif ($subsData['active'] == WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE) {
                $status = 'Paused';
            }

            $ship_name = $subsData['address_details']['firstname'] . ' ' . $subsData['address_details']['lastname'];

            $customer_name = $customer->firstname . ' ' . $customer->lastname;

            $renewDate = date('d M, Y', strtotime('+1 days'));

            $mailTpl = '';
            $mailSubject = '';

            $mailTplAdmin = '';
            $mailSubjectAdmin = '';

            if ($mailType == 'subscription_create') {
                $mailTpl = 'subscription_create';
                $mailSubject = $this->module->l(
                    'Your subscription created successfully',
                    'WkProductSubscriptionGlobal'
                );

                $mailTplAdmin = 'subscription_create_admin';
                $mailSubjectAdmin = $this->module->l(
                    'A customer has subscribed a product',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_cancel') {
                $mailTpl = 'subscription_cancel';
                $mailSubject = $this->module->l(
                    'Your subscription cancelled successfully',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_cancel_admin';
                $mailSubjectAdmin = $this->module->l(
                    'A customer has cancelled their subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_pause') {
                $mailTpl = 'subscription_pause';
                $mailSubject = $this->module->l(
                    'Your subscription paused successfully',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_pause_admin';
                $mailSubjectAdmin = $this->module->l(
                    'A customer has paused their subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_resume') {
                $mailTpl = 'subscription_resume';
                $mailSubject = $this->module->l(
                    'Your subscription resume successfully',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_resume_admin';
                $mailSubjectAdmin = $this->module->l(
                    'A customer has resumed their subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_update') {
                $mailTpl = 'subscription_update';
                $mailSubject = $this->module->l(
                    'Your subscription updated successfully',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_update_admin';
                $mailSubjectAdmin = $this->module->l(
                    'A customer has updated their subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_renew') {
                $mailTpl = 'subscription_renew';
                $mailSubject = sprintf(
                    $this->module->l('Your subscription will be renew on %s', 'WkProductSubscriptionGlobal'),
                    $renewDate
                );
                $mailTplAdmin = 'subscription_renew_admin';
                $mailSubjectAdmin = sprintf(
                    $this->module->l('Customer subscription will be renew on %s', 'WkProductSubscriptionGlobal'),
                    $renewDate
                );
            } elseif ($mailType == 'subscription_cancel_by_admin') {
                $mailTpl = 'subscription_cancel_by_admin';
                $mailSubject = $this->module->l(
                    'Your subscription has been cancelled by admin',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_cancel_by_admin_admin';
                $mailSubjectAdmin = $this->module->l(
                    'You have cancelled the subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_pause_by_admin') {
                $mailTpl = 'subscription_pause_by_admin';
                $mailSubject = $this->module->l(
                    'Your subscription has been paused by admin',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_pause_by_admin_admin';
                $mailSubjectAdmin = $this->module->l(
                    'You have paused the subscription',
                    'WkProductSubscriptionGlobal'
                );
            } elseif ($mailType == 'subscription_resume_by_admin') {
                $mailTpl = 'subscription_resume_by_admin';
                $mailSubject = $this->module->l(
                    'Your subscription has been resumed by admin',
                    'WkProductSubscriptionGlobal'
                );
                $mailTplAdmin = 'subscription_resume_by_admin_admin';
                $mailSubjectAdmin = $this->module->l(
                    'You have cancelled the subscription',
                    'WkProductSubscriptionGlobal'
                );
            }

            if (!empty($mailTplAdmin) && !empty($mailSubjectAdmin)) {
                Mail::Send(
                    (int) $this->id_lang,
                    $mailTplAdmin,
                    $mailSubjectAdmin,
                    [
                        '{renew_date}' => $renewDate,
                        '{customer_name}' => $customer_name,
                        '{customer_email}' => $customer->email,
                        '{frequency_label}' => $subsData['frequency_label'],
                        '{id_subscription}' => $subsData['id_subscription'],
                        '{first_order_date}' => Tools::displayDate($subsData['first_order_date']),
                        '{next_order_date}' => Tools::displayDate($subsData['next_order_date']),
                        '{auto_resume_date}' => ($subsData['pause_up_to'] != '0000-00-00 00:00:00') ? Tools::displayDate(date('Y-m-d', strtotime($subsData['pause_up_to'] . ' + 1 days'))) : '',
                        '{payment_method}' => $subsData['payment_method'],
                        '{shipping_method}' => $shipping,
                        '{status}' => $status,
                        '{product_name}' => $subsData['product_name'],
                        '{product_ref}' => $subsData['product_ref'],
                        '{attributes}' => $attributes,
                        '{quantity}' => $subsData['quantity'],
                        '{base_price}' => $subsData['base_price'],
                        '{unit_price}' => $subsData['unit_price'],
                        '{total_price}' => $subsData['total_price'],
                        '{shipping_charge}' => $subsData['shipping_charge'],
                        '{discount}' => $subsData['discount'],
                        '{total_amount}' => $subsData['total_amount'],
                        '{tax_amount}' => $subsData['tax_amount'],
                        '{ship_address_name}' => $ship_name,
                        '{ship_address}' => $subsData['address_details']['address1'],
                        '{city}' => $subsData['address_details']['city'],
                        '{state}' => $subsData['address_details']['state'],
                        '{zipcode}' => $subsData['address_details']['postcode'],
                        '{country}' => $subsData['address_details']['country'],
                        '{phone}' => $subsData['address_details']['phone'],
                        '{my_subscription_url}' => $my_subscription_url,
                        '{shop_name}' => Configuration::get('PS_SHOP_NAME'),
                        '{shop_logo}' => _PS_BASE_URL_ . _PS_IMG_ . Configuration::get('PS_LOGO'),
                        '{shop_url}' => _PS_BASE_URL_ . __PS_BASE_URI__,
                    ],
                    Configuration::get('PS_SHOP_EMAIL'),    // Receiver email
                    Configuration::get('PS_SHOP_NAME'),     // Receiver name
                    Configuration::get('PS_SHOP_EMAIL'),    // From email
                    Configuration::get('PS_SHOP_NAME'),     // From name
                    null,                                   // Attachment
                    null,                                 // Mode (Mail protocol)
                    $this->module->getLocalPath() . 'mails/',  // Template full path
                    false,
                    (int) $subsData['id_shop']
                );
            }

            if (!empty($mailTpl) && !empty($mailSubject)) {
                if ($mailTpl == 'subscription_create'
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_CREATE_EMAIL')
                ) {
                    return;
                }

                if (($mailTpl == 'subscription_cancel' || $mailTpl == 'subscription_cancel_by_admin')
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_CANCEL_EMAIL')
                ) {
                    return;
                }

                if ($mailTpl == 'subscription_update'
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_UPDATE_EMAIL')
                ) {
                    return;
                }

                if ($mailTpl == 'subscription_renew'
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_RENEW_EMAIL')
                ) {
                    return;
                }

                if (($mailTpl == 'subscription_pause' || $mailTpl == 'subscription_pause_by_admin')
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_PAUSE_EMAIL')
                ) {
                    return;
                }

                if (($mailTpl == 'subscription_resume' || $mailTpl == 'subscription_resume_by_admin')
                    && !Configuration::get('WK_SUBSCRIPTION_SEND_RESUME_EMAIL')
                ) {
                    return;
                }

                Mail::Send(
                    (int) $this->id_lang, // Language id
                    $mailTpl,     // Template name
                    $mailSubject,  // Email subject
                    [              // Email data
                        '{renew_date}' => $renewDate,
                        '{customer_name}' => $customer_name,
                        '{customer_email}' => $customer->email,
                        '{frequency_label}' => $subsData['frequency_label'],
                        '{id_subscription}' => $subsData['id_subscription'],
                        '{first_order_date}' => Tools::displayDate($subsData['first_order_date']),
                        '{next_order_date}' => Tools::displayDate($subsData['next_order_date']),
                        '{auto_resume_date}' => Tools::displayDate($subsData['pause_up_to']),
                        '{payment_method}' => $subsData['payment_method'],
                        '{shipping_method}' => $shipping,
                        '{status}' => $status,
                        '{product_name}' => $subsData['product_name'],
                        '{product_ref}' => $subsData['product_ref'],
                        '{attributes}' => $attributes,
                        '{quantity}' => $subsData['quantity'],
                        '{base_price}' => $subsData['base_price'],
                        '{unit_price}' => $subsData['unit_price'],
                        '{total_price}' => $subsData['total_price'],
                        '{shipping_charge}' => $subsData['shipping_charge'],
                        '{discount}' => $subsData['discount'],
                        '{total_amount}' => $subsData['total_amount'],
                        '{tax_amount}' => $subsData['tax_amount'],
                        '{ship_address_name}' => $ship_name,
                        '{ship_address}' => $subsData['address_details']['address1'],
                        '{city}' => $subsData['address_details']['city'],
                        '{state}' => $subsData['address_details']['state'],
                        '{zipcode}' => $subsData['address_details']['postcode'],
                        '{country}' => $subsData['address_details']['country'],
                        '{phone}' => $subsData['address_details']['phone'],
                        '{my_subscription_url}' => $my_subscription_url,
                        '{shop_name}' => Configuration::get('PS_SHOP_NAME'),
                        '{shop_logo}' => _PS_BASE_URL_ . _PS_IMG_ . Configuration::get('PS_LOGO'),
                        '{shop_url}' => _PS_BASE_URL_ . __PS_BASE_URI__,
                    ],
                    $customer->email,    // Receiver email
                    $customer_name,     // Receiver name
                    Configuration::get('PS_SHOP_EMAIL'),    // From email
                    Configuration::get('PS_SHOP_NAME'),     // From name
                    null,                                   // Attachment
                    null,                                 // Mode (Mail protocol)
                    $this->module->getLocalPath() . 'mails/',  // Template full path
                    false,
                    (int) $subsData['id_shop']
                );
            }
        }
    }

    /**
     * Check If Schedule Created
     *
     * @param mixed $idSubscription
     * @param mixed $order_date
     *
     * @return array|false
     */
    public function checkIfScheduleCreated($idSubscription, $order_date)
    {
        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT wk_subscription_schedule_shop.*
            FROM `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
            . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
            ' WHERE wk_subscription_schedule_shop.id_subscription = ' . (int) $idSubscription . '
            AND wk_subscription_schedule_shop.order_date = DATE("' . pSQL($order_date) . '")
        '
        );
    }

    /**
     * getSubscriptionDetailsByOrderId
     *
     * @param mixed $idOrder
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     */
    public function getSubscriptionDetailsByOrderId($idOrder, $idProduct, $idProductAttr)
    {
        $subscriptionData = [];
        $idSubscription = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT ssp.`id_wk_subscription_subscriber_products`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` ssp
            INNER JOIN `' . _DB_PREFIX_ . 'wk_subscription_orders` so
            ON so.id_subscription = ssp.id_wk_subscription_subscriber_products
            WHERE ssp.id_product = ' . (int) $idProduct . '
            AND ssp.id_product_attribute = ' . (int) $idProductAttr . '
            AND so.id_order = ' . (int) $idOrder .
            Shop::addSqlRestriction(Shop::SHARE_ORDER, 'ssp')
        );

        if ($idSubscription) {
            $subscriptionData = $this->getSubscriptionDetails((int) $idSubscription);
        }

        return $subscriptionData;
    }

    /**
     * disableProductSubscription
     *
     * @param mixed $id_product
     */
    public function disableProductSubscription($id_product)
    {
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'UPDATE `' . _DB_PREFIX_ . 'wk_subscription_products` a '
            . Shop::addSqlAssociation('wk_subscription_products', 'a') .
            ' SET wk_subscription_products_shop.active = 0
            WHERE wk_subscription_products_shop.id_product = ' . (int) $id_product
        );
    }

    /**
     * cancelAllSubscriptions
     *
     * @param mixed $id_product
     */
    public function cancelAllSubscriptions($id_product, $deleted = false, $id_product_attribute = 0)
    {
        $shareOrder = Shop::addSqlRestriction(Shop::SHARE_ORDER, 'a');
        $sql = 'SELECT a.id_wk_subscription_subscriber_products
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
            WHERE a.id_product = ' . (int) $id_product . $shareOrder;

        $updateSql = '';
        if ($id_product_attribute) {
            $sql .= ' AND a.id_product_attribute = ' . (int) $id_product_attribute;
            $updateSql = ' AND a.id_product_attribute = ' .
            (int) $id_product_attribute;
        }

        $idSubscriptions = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        if ($idSubscriptions) {
            $idSubscriptionsArr = array_column($idSubscriptions, 'id_wk_subscription_subscriber_products');

            if ($deleted) {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                    'UPDATE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
                    SET a.active = 0, a.deleted = 1
                    WHERE a.id_product = ' . (int) $id_product . $updateSql
                );
            } else {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                    'UPDATE `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products` a
                    SET a.active = 0 WHERE a.id_product = ' . (int) $id_product .
                    $updateSql . $shareOrder
                );
            }
            $this->disabledScheduledOrders($idSubscriptionsArr);
            $this->sendSubscriptionCancelMails($idSubscriptionsArr);
        }

        return true;
    }

    /**
     * disabledScheduledOrders
     *
     * @param mixed $idSubscriptions
     */
    public function disabledScheduledOrders($idSubscriptions)
    {
        Shop::addTableAssociation(
            'wk_subscription_schedule',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_schedule']
        );

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
            'UPDATE `' . _DB_PREFIX_ . 'wk_subscription_schedule` a '
            . Shop::addSqlAssociation('wk_subscription_schedule', 'a') .
            ' SET wk_subscription_schedule_shop.active = 0
            WHERE wk_subscription_schedule_shop.id_subscription IN (' . pSQL(implode(', ', $idSubscriptions)) . ')
            AND wk_subscription_schedule_shop.is_order_created = 0'
        );
    }

    /**
     * sendSubscriptionCancelMails
     *
     * @param mixed $idSubscriptions
     *
     * @return void
     */
    public function sendSubscriptionCancelMails($idSubscriptions)
    {
        if ($idSubscriptions) {
            foreach ($idSubscriptions as $idSubscription) {
                $subscriptionData = $this->getSubscriptionDetails((int) $idSubscription);
                if ($subscriptionData['payment_module'] == 'wkstripepayment'
                    && WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()
                ) {
                    $paymentData = json_decode($subscriptionData['payment_response'], true);
                    $stripeObj = new WkSubscriptionStripe();
                    if ($paymentData) {
                        $stripeObj->cancelStripeSubscription(
                            (int) $subscriptionData['id_customer'],
                            $paymentData['stripe_subscription_id']
                        );
                    }
                } elseif ($subscriptionData['payment_module'] == 'psadyenpayment'
                    && WkProductSubscriptionGlobal::isWkAdyenRecurringEnabled()
                ) {
                    $adyenObj = new WkSubscriptionAdyen();
                    $adyenObj->cancelAdyenSubscription(
                        (int) $subscriptionData['id_customer'],
                        $subscriptionData
                    );
                } elseif ($subscriptionData['payment_module'] == 'wkwepay'
                    && WkProductSubscriptionGlobal::isWkWepayRecurringEnabled()
                ) {
                    $adyenObj = new WkSubscriptionAdyen();
                    $adyenSubData = $adyenObj->getAdyenSubscriptionDetailsByIdCustomer(
                        $subscriptionData['id_customer'],
                        $subscriptionData['first_order_id'],
                        $subscriptionData['id_product']
                    );
                    if ($adyenSubData) {
                        $adyenObj->cancelAdyenSubscription(
                            $adyenSubData['id'],
                            $subscriptionData
                        );
                    }
                }
                $this->sendSubscriptionCancelByAdminMail($idSubscription);
            }
        }
    }

    /**
     * Check if stripe recurring payment is enabled
     *
     * @return bool
     */
    public static function isWkStripeRecurringEnabled()
    {
        return Module::isEnabled('wkstripepayment');
    }

    /**
     * Check if adyen recurring payment is enabled
     *
     * @return bool
     */
    public static function isWkAdyenRecurringEnabled()
    {
        return Module::isEnabled('psadyenpayment');
    }

    /**
     * Check if wepay recurring payment is enabled
     *
     * @return bool
     */
    public static function isWkWepayRecurringEnabled()
    {
        return Module::isEnabled('wkwepay');
    }

    /**
     * Check if PayPal recurring payment is enabled
     *
     * @return bool
     */
    public static function isWkPayPalRecurringEnabled()
    {
        return Module::isEnabled('wkpaypalsubscription');
    }

    /**
     * Check if PayPal recurring payment is enabled
     *
     * @return bool
     */
    public static function isWkCustomerWalletEnabled()
    {
        return Module::isEnabled('wkcustomerwallet');
    }

    /**
     * Check if Authorized net payment is enabled
     *
     * @return bool
     */
    public static function isWkAuthorizeNetEnabled()
    {
        return Module::isEnabled('wkauthorizepayment') && self::isPaymentMethodEnabled('wkauthorizepayment');
    }

    public static function isPaymentMethodEnabled($paymentMod)
    {
        $allowedPayments = self::getAllEnabledPaymentMethods();
        $objModule = Module::getInstanceByName($paymentMod);
        if ($allowedPayments
            && Validate::isLoadedObject($objModule)
            && in_array($objModule->id, $allowedPayments)
        ) {
            return true;
        }

        return false;
    }

    public static function getAllEnabledPaymentMethods()
    {
        return json_decode(Configuration::get('WK_SUBSCRIPTION_PAYMENT_METHODS'));
    }

    /**
     * Duplicate customization data
     *
     * @param int $idOldCustomization
     * @param int $idNewCustomization
     *
     * @return bool
     */
    public function addCustomizationData($idOldCustomization, $idNewCustomization)
    {
        $success = true;
        $custData = Db::getInstance()->executeS(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'customized_data`
            WHERE `id_customization` = ' . (int) $idOldCustomization
        );
        if ($custData) {
            foreach ($custData as $data) {
                $data['id_customization'] = (int) $idNewCustomization;
                $success &= Db::getInstance()->insert('customized_data', $data);
            }
        }

        return $success;
    }

    /**
     * Check if module is enabled on other shop
     *
     * @param int $idModule
     *
     * @return int|false
     */
    public static function checkIfModuleEnabledOtherShop($idModule)
    {
        $sql = 'SELECT `id_module` FROM `' . _DB_PREFIX_ . 'module_shop`
            WHERE `id_module` = ' . (int) $idModule;

        return Db::getInstance()->getValue($sql);
    }

    public function getTransStringSubsWithNormal()
    {
        return $this->module->l('You can not purchase subscription product and normal product together.', 'WkProductSubscriptionGlobal');
    }

    public function getTransStringSubsWithSubs()
    {
        return $this->module->l('You can not purchase more than one subscription product at a time.', 'WkProductSubscriptionGlobal');
    }

    public function getTransStringAlreadySubscription()
    {
        return $this->module->l('You can not purchase this product with subscription product at a time.', 'WkProductSubscriptionGlobal');
    }

    public function isAllowBothNormalAndSubsProduct()
    {
        if (!Configuration::get('WK_SUBSCRIPTION_ALLOW_NORMAL_AND_SUBSCRIPTION')) {
            return false;
        }

        $allowedPayments = json_decode(Configuration::get('WK_SUBSCRIPTION_PAYMENT_METHODS'), true);
        $isAllow = false;

        if (!empty($allowedPayments)) {
            foreach ($allowedPayments as $payment) {
                $module = Module::getInstanceById((int) $payment);
                if (isset($module->name) && WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module->name, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_SPLIT_ORDER)) {
                    $isAllow = true;
                    break;
                }
            }
        }

        if (!$isAllow) {
            return false;
        }

        $cartAmount = (float) $this->context->cart->getOrderTotal(true, Cart::BOTH);
        $customerId = $this->context->customer->id;
        $currencyId = $this->context->currency->id;
        include_once _PS_MODULE_DIR_ . 'wkcustomerwallet/classes/CustomerWalletClassInclude.php';
        $walletAmount = CustomerWallet::getWalletTotalAmount($customerId, $currencyId);
        if ($walletAmount > 0 && $walletAmount >= $cartAmount) {
            return true;
        }

        return false;
    }

    public static function checkPaymentModuleHasFeature($moduleName, $feature)
    {
        switch ($feature) {
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_SPLIT_ORDER:
                if ($moduleName == 'wkcustomerwallet') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE:
                if ($moduleName == 'wkcustomerwallet') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE_FREQUENCY:
                if ($moduleName == 'wkcustomerwallet') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_CREATE:
                if ($moduleName == 'wkcustomerwallet' || $moduleName == 'wkpaypalsubscription' || $moduleName == 'wkstripepayment' || $moduleName == 'wkwepay' || $moduleName == 'psadyenpayment') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_AUTORENEW:
                if ($moduleName == 'wkcustomerwallet' || $moduleName == 'wkpaypalsubscription' || $moduleName == 'wkstripepayment' || $moduleName == 'wkwepay' || $moduleName == 'psadyenpayment') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_PAUSE:
                if ($moduleName == 'wkcustomerwallet' || $moduleName == 'wkstripepayment' || $moduleName == 'wkpaypalsubscription') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_RESUME:
                if ($moduleName == 'wkcustomerwallet' || $moduleName == 'wkstripepayment' || $moduleName == 'wkpaypalsubscription') {
                    return true;
                }

                return false;
            case WkProductSubscriptionGlobal::WK_SUBS_FEATURE_CANCEL:
                if ($moduleName == 'wkcustomerwallet' || $moduleName == 'wkpaypalsubscription' || $moduleName == 'wkstripepayment' || $moduleName == 'wkwepay' || $moduleName == 'psadyenpayment') {
                    return true;
                }

                return false;
            default:
                return false;
        }
    }

    public function resumeSupscription($idSubscription)
    {
        $subObj = new WkSubscriberProductModal($idSubscription);
        if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE) {
            return ['status' => false, 'msg' => $this->module->l('Subscription is not paused.', 'WkProductSubscriptionGlobal')];
        } else {
            $globalObj = new WkProductSubscriptionGlobal();
            switch ($subObj->payment_module) {
                case 'wkcustomerwallet':
                    if (WkProductSubscriptionGlobal::isWkCustomerWalletEnabled()) {
                        $status = WkSubscriptionWallet::resumeSubscription((int) $idSubscription);
                        if ($status) {
                            $globalObj->sendSubscriptionResumeMail($idSubscription);

                            return ['status' => true];
                        } else {
                            return ['status' => false, 'msg' => $this->module->l('Something went worng during resume.', 'WkProductSubscriptionGlobal')];
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('Customer Wallet module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                    // no break
                case 'wkstripepayment':
                    if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()) {
                        $subsData = $globalObj->getSubscriptionDetails((int) $idSubscription);
                        $paymentData = json_decode($subsData['payment_response'], true);
                        $stripeObj = new WkSubscriptionStripe();
                        $status = $stripeObj->resumeSubscription($paymentData['stripe_subscription_id']);
                        if ($status) {
                            $subObj = new WkSubscriberProductModal($idSubscription);
                            $currentDate = date('Y-m-d');
                            $pauseDate = date('Y-m-d', strtotime($subObj->pause_up_to . ' - ' . $subObj->no_of_pause_day . ' days'));
                            $diff = strtotime($currentDate) - strtotime($pauseDate);
                            $days = (int) abs(round($diff / 86400));
                            $subObj->pause_up_to = date('Y-m-d', strtotime($pauseDate . ' + ' . $days . ' days'));
                            $subObj->no_of_pause_day = $days;
                            $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE;
                            if ($subObj->save()) {
                                $globalObj->sendSubscriptionResumeMail($idSubscription);

                                return ['status' => true];
                            } else {
                                return ['status' => false, 'msg' => $this->module->l('Strip subscription is resumed but Something went worng during resume in shop.', 'WkProductSubscriptionGlobal')];
                            }
                        } else {
                            return ['status' => false, 'msg' => $this->module->l('Something went worng during resume.', 'WkProductSubscriptionGlobal')];
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('Customer Wallet module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                    // no break
                case 'wkpaypalsubscription':
                    if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                        $subsData = $globalObj->getSubscriptionDetails((int) $idSubscription);
                        $payPalSubsId = $subsData['payment_response'];
                        if (empty($payPalSubsId)) {
                            return ['status' => false, 'msg' => $this->module->l('PayPal payment response did not update.', 'WkProductSubscriptionGlobal')];
                        } else {
                            $objPayPal = new WkSubscriptionPayPal();
                            $status = $objPayPal->resumeSubscription(
                                $payPalSubsId,
                                $subsData['first_order_id']
                            );
                            if ($status) {
                                $subObj = new WkSubscriberProductModal($idSubscription);
                                $currentDate = date('Y-m-d');
                                $pauseDate = date('Y-m-d', strtotime($subObj->pause_up_to . ' - ' . $subObj->no_of_pause_day . ' days'));
                                $diff = strtotime($currentDate) - strtotime($pauseDate);
                                $days = (int) abs(round($diff / 86400));
                                $subObj->pause_up_to = date('Y-m-d', strtotime($pauseDate . ' + ' . $days . ' days'));
                                $subObj->no_of_pause_day = $days;
                                $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE;
                                if ($subObj->save()) {
                                    $globalObj->sendSubscriptionResumeMail($idSubscription);

                                    return ['status' => true];
                                } else {
                                    return ['status' => false, 'msg' => $this->module->l('Strip subscription is resumed but Something went worng during resume in shop.', 'WkProductSubscriptionGlobal')];
                                }
                            } else {
                                return ['status' => false, 'msg' => $this->module->l('Something went worng during pause.', 'WkProductSubscriptionGlobal')];
                            }
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('Customer Wallet module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                    // no break
                default:
                    return ['status' => false, 'msg' => $this->module->l('You can not resume a subscription.', 'WkProductSubscriptionGlobal')];
            }
        }
    }

    public function pauseSupscription($idSubscription, $noOfDays)
    {
        $subObj = new WkSubscriberProductModal($idSubscription);
        if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
            return ['status' => false, 'msg' => $this->module->l('Subscription is not active.', 'WkProductSubscriptionGlobal')];
        } else {
            $globalObj = new WkProductSubscriptionGlobal();
            switch ($subObj->payment_module) {
                case 'wkcustomerwallet':
                    if (WkProductSubscriptionGlobal::isWkCustomerWalletEnabled()) {
                        $status = WkSubscriptionWallet::pauseSubscription((int) $idSubscription, $noOfDays);
                        if ($status) {
                            $globalObj->sendSubscriptionPauseMail($idSubscription);

                            return ['status' => true];
                        } else {
                            return ['status' => false, 'msg' => $this->module->l('Something went worng during pause.', 'WkProductSubscriptionGlobal')];
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('Customer Wallet module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                case 'wkstripepayment':
                    if (WkProductSubscriptionGlobal::isWkStripeRecurringEnabled()) {
                        $subsData = $globalObj->getSubscriptionDetails((int) $idSubscription);
                        if (empty($subsData['payment_response'])) {
                            return ['status' => false, 'msg' => $this->module->l('Subscription payment response did not update.', 'WkProductSubscriptionGlobal')];
                        } else {
                            $paymentData = json_decode($subsData['payment_response'], true);
                            $stripeObj = new WkSubscriptionStripe();
                            $status = $stripeObj->pauseStripeSubscription(
                                $paymentData['stripe_subscription_id'],
                                $noOfDays
                            );
                            if ($status) {
                                $currentDate = date('Y-m-d');
                                $subObj->pause_up_to = date('Y-m-d', strtotime($currentDate . ' + ' . $noOfDays . ' days'));
                                $subObj->no_of_pause_day = $noOfDays;
                                $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE;
                                if ($subObj->save()) {
                                    $globalObj->sendSubscriptionPauseMail($idSubscription);

                                    return ['status' => true];
                                } else {
                                    return ['status' => false, 'msg' => $this->module->l('Strip subscription is paused but Something went worng during pause in shop.', 'WkProductSubscriptionGlobal')];
                                }
                            } else {
                                return ['status' => false, 'msg' => $this->module->l('Something went worng during pause.', 'WkProductSubscriptionGlobal')];
                            }
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('Stripe module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                    // no break
                case 'wkpaypalsubscription':
                    if (WkProductSubscriptionGlobal::isWkPayPalRecurringEnabled()) {
                        $subsData = $globalObj->getSubscriptionDetails((int) $idSubscription);
                        $payPalSubsId = $subsData['payment_response'];
                        if (empty($payPalSubsId)) {
                            return ['status' => false, 'msg' => $this->module->l('PayPal payment response did not update.', 'WkProductSubscriptionGlobal')];
                        } else {
                            $objPayPal = new WkSubscriptionPayPal();
                            $status = $objPayPal->pauseSubscription(
                                $payPalSubsId,
                                $subsData['first_order_id']
                            );
                            if ($status) {
                                $currentDate = date('Y-m-d');
                                $subObj->pause_up_to = date('Y-m-d', strtotime($currentDate . ' + ' . $noOfDays . ' days'));
                                $subObj->no_of_pause_day = $noOfDays;
                                $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE;
                                if ($subObj->save()) {
                                    $globalObj->sendSubscriptionPauseMail($idSubscription);

                                    return ['status' => true];
                                } else {
                                    return ['status' => false, 'msg' => $this->module->l('PayPal subscription is paused but Something went worng during pause in shop.', 'WkProductSubscriptionGlobal')];
                                }
                            } else {
                                return ['status' => false, 'msg' => $this->module->l('Something went worng during pause.', 'WkProductSubscriptionGlobal')];
                            }
                        }
                    } else {
                        return ['status' => false, 'msg' => $this->module->l('PayPal module is not enabled.', 'WkProductSubscriptionGlobal')];
                    }
                default:
                    return ['status' => false, 'msg' => $this->module->l('You can not pause a subscription.', 'WkProductSubscriptionGlobal')];
            }
        }
    }

    public static function getAllSupportedModuleList()
    {
        return ['wkpaypalsubscription', 'psadyenpayment', 'wkstripepayment', 'wkcustomerwallet', 'wkwepay'];
    }
}
