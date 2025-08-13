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

class AdminSubscriptionsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->className = 'WkProductSubscriptionModel';
        $this->table = 'wk_subscription_products';
        $this->identifier = 'id_wk_subscription_products';
        $this->bootstrap = true;
        $this->list_no_link = true;
        $this->lang = false;
        parent::__construct();
        Shop::addTableAssociation(
            'wk_subscription_products',
            ['type' => 'shop', 'primary' => 'id_wk_subscription_products']
        );
        $idLang = (int) $this->context->language->id;
        $idShop = (int) $this->context->shop->id;
        $this->_select = 'wk_subscription_products_shop.*, pl.name as product_name, p.price, p.quantity, p.state,
        p.id_product as image, p.id_product as subscriptions, p.id_product as subscribers, a.id_product as product_preview';
        $this->_join = Shop::addSqlAssociation('wk_subscription_products', 'a', false);
        $this->_join .= 'INNER JOIN ' . _DB_PREFIX_ . 'product p ON (p.id_product = a.id_product)
        INNER JOIN ' . _DB_PREFIX_ . 'product_lang pl ON (pl.id_product = a.id_product AND pl.id_lang = ' .
        (int) $idLang . ' AND pl.id_shop = ' . (int) $idShop . ')
        INNER JOIN `' . _DB_PREFIX_ . 'product_shop` ps ON (ps.id_product = a.id_product AND pl.id_shop = ' .
        (int) $idShop . ')';
        $this->_where .= ' AND pl.name != \'\'';

        $this->_group = 'GROUP BY a.id_product';
        $this->_orderBy = 'a.id_product';
        $this->_orderWay = 'DESC';

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->_select .= ', shp.`name` as wk_ps_shop_name';
            $this->_join .= ' JOIN `' . _DB_PREFIX_ . 'shop` shp
            ON (shp.`id_shop` = wk_subscription_products_shop.`id_shop`)';
        }

        $this->toolbar_title = $this->module->l('Products', get_class());

        // Table Definition
        $this->fields_list = [
            'id_product' => [
                'title' => $this->module->l('Product ID', get_class()),
                'align' => 'center',
                'class' => 'fixed-width-xs',
                'filter_key' => 'a!id_product',
                'havingFilter' => true,
            ],
            'image' => [
                'title' => $this->module->l('Image', get_class()),
                'search' => false,
                'orderBy' => false,
                'align' => 'center',
                'callback' => 'displayProductImage',
            ],
            'product_name' => [
                'title' => $this->module->l('Name', get_class()),
                'align' => 'left',
                'havingFilter' => true,
                'callback' => 'getProductLink',
            ],
            'product_preview' => [
                'title' => $this->module->l('Preview', get_class()),
                'align' => 'center',
                'havingFilter' => false,
                'search' => false,
                'callback' => 'getProductPreviewURL',
            ],
            'subscriptions' => [
                'title' => $this->module->l('Subscriptions', get_class()),
                'align' => 'center',
                'type' => 'int',
                'search' => false,
                'callback' => 'displayProductSubscriptionCount',
            ],
        ];

        if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
            // In case of All Shops
            $this->fields_list['wk_ps_shop_name'] = [
                'title' => $this->module->l('Shop', get_class()),
                'align' => 'center',
                'havingFilter' => true,
            ];
        }

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->module->l('Delete selected', get_class()),
                'icon' => 'icon-trash',
                'confirm' => $this->module->l('Delete selected items?', get_class()),
            ],
        ];
    }

    public function initProcess()
    {
        if (Tools::isSubmit('submitBulkdeletewk_subscription_products')) {
            $this->processBulkDeleteWksubscriptionProudct();
        }
        if (Tools::isSubmit('submitBulkenableSelectionwk_subscription_products')) {
            $this->processBulkStatusWksubscriptionProudct(1);
        }
        if (Tools::isSubmit('submitBulkdisableSelectionwk_subscription_products')) {
            $this->processBulkStatusWksubscriptionProudct(0);
        }

        parent::initProcess();
    }

    /**
     * Change object status (active, inactive).
     */
    public function processStatus()
    {
        $id_subscription_product = Tools::getValue('id_wk_subscription_products');
        if ($id_subscription_product) {
            self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . $id_subscription_product;
        }

        if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
            $this->errors[] = $this->module->l('You can not perform enable/disable operation in this shop context. Select a shop instead of a group of shops.', get_class());
        } else {
            if (Validate::isLoadedObject($object = $this->loadObject())) {
                if ($object->toggleStatus()) {
                    $matches = [];
                    if (preg_match('/[\?|&]controller=([^&]*)/', (string) $_SERVER['HTTP_REFERER'], $matches) !== false
                        && strtolower($matches[1]) != strtolower(preg_replace('/controller/i', '', get_class($this)))) {
                        $this->redirect_after = preg_replace('/[\?|&]conf=([^&]*)/i', '', (string) $_SERVER['HTTP_REFERER']);
                    } else {
                        $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
                    }

                    $id_category = (($id_category = (int) Tools::getValue('id_category')) && Tools::getValue('id_product')) ? '&id_category=' . $id_category : '';

                    $page = (int) Tools::getValue('page');
                    $page = $page > 1 ? '&submitFilter' . $this->table . '=' . (int) $page : '';
                    $this->redirect_after .= '&conf=5' . $id_category . $page;
                } else {
                    $this->errors[] = $this->trans('An error occurred while updating the status.', [], 'Admin.Notifications.Error');
                }
            } else {
                $this->errors[] = $this->trans('An error occurred while updating the status for an object.', [], 'Admin.Notifications.Error') .
                    ' <b>' . $this->table . '</b> ' .
                    $this->trans('(cannot load object)', [], 'Admin.Notifications.Error');
            }

            return $object;
        }

        return true;
    }

    protected function processBulkStatusSelection($status)
    {
        if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
            $this->errors[] = $this->module->l('You can not perform enable/disable operation in this shop context. Select a shop instead of a group of shops.', get_class());
        } else {
            return parent::processBulkStatusSelection($status);
        }

        return true;
    }

    public function displayCombinationName($idProductAttr)
    {
        if ($idProductAttr) {
            $objProdAttr = new Combination((int) $idProductAttr);
            $attributeName = $objProdAttr->getAttributesName((int) $this->context->language->id);

            return implode('-', array_column($attributeName, 'name'));
        }

        return '--';
    }

    public function initPageHeaderToolbar()
    {
        if (empty($this->display)) {
            $this->page_header_toolbar_btn['new'] = [
                'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
                'desc' => $this->module->l('Add new', get_class()),
                'icon' => 'process-icon-new',
            ];
        }

        if ($this->display == 'edit' || $this->display == 'add' || $this->display == 'view') {
            if ($this->display == 'edit' || $this->display == 'add') {
                $this->page_header_toolbar_title = $this->module->l('Subscription product', get_class());
            }
            $this->page_header_toolbar_btn['back_to_list'] = [
                'href' => self::$currentIndex . '&token=' . $this->token,
                'desc' => $this->module->l('Back to list', get_class()),
                'icon' => 'process-icon-back',
            ];
        }
        parent::initPageHeaderToolbar();
    }

    public function renderForm()
    {
        if (Shop::isFeatureActive()
            && ($this->display == 'edit')
            && (Shop::getContext() != Shop::CONTEXT_SHOP)
        ) {
            return $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/_partials/shop_warning.tpl'
            );
        }

        $displayShopWarning = false;
        $productName = '';
        $idProduct = 0;
        $subscriptionData = [];
        $idLang = $this->context->language->id;

        $dailyString = $this->module->l('Every %d day', get_class());
        $everyDayString = $this->module->l('Everyday', get_class());
        $weeklyString = $this->module->l('Every %d week', get_class());
        $everyWeekString = $this->module->l('Every week', get_class());
        $monthlyString = $this->module->l('Every %d month', get_class());
        $everyMonthString = $this->module->l('Every month', get_class());
        $yearlyString = $this->module->l('Every %d year', get_class());
        $everyYearString = $this->module->l('Every year', get_class());

        $dailyCycles = [];
        $weeklyCycles = [];
        $monthlyCycles = [];
        $yearlyCycles = [];

        // Daily cycles
        $dailyCycles[1] = $everyDayString;
        for ($day = 2; $day <= 6; ++$day) {
            $dailyCycles[$day] = sprintf($dailyString, $day);
        }

        // Weekly cycles
        $weeklyCycles[1] = $everyWeekString;
        for ($week = 2; $week <= 4; ++$week) {
            $weeklyCycles[$week] = sprintf($weeklyString, $week);
        }

        // Monthly cycles
        $monthlyCycles[1] = $everyMonthString;
        for ($month = 2; $month <= 6; ++$month) {
            $monthlyCycles[$month] = sprintf($monthlyString, $month);
        }

        // Yearly cycles
        $yearlyCycles[1] = $everyYearString;
        for ($year = 2; $year <= 2; ++$year) {
            $yearlyCycles[$year] = sprintf($yearlyString, $year);
        }

        if (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_ALL) {
            $displayShopWarning = true;
        }

        $combinations = [
            ['id_product_attribute' => 0, 'attributes' => $this->module->l('No combination', get_class())],
        ];

        $hasAttr = true;
        $subscriptionProductAttr = [];
        if ($id = Tools::getValue('id_wk_subscription_products')) {
            $objectVars = get_object_vars($this->object);
            // Decode json string into array
            foreach ($objectVars as $key => $value) {
                if ($key == 'daily_cycles'
                    || $key == 'weekly_cycles'
                    || $key == 'monthly_cycles'
                    || $key == 'yearly_cycles'
                    || $key == 'daily_cycles_discount'
                    || $key == 'weekly_cycles_discount'
                    || $key == 'monthly_cycles_discount'
                    || $key == 'yearly_cycles_discount'
                ) {
                    $subscriptionData[$key] = json_decode($value);
                } else {
                    $subscriptionData[$key] = $value;
                }
                $productObj = new Product((int) $this->object->id_product, false, $idLang);
                if ($productObj->hasAttributes()) {
                    $combinations = WkProductSubscriptionModel::getProductCombinations(
                        $this->object->id_product,
                        $idLang
                    );
                } else {
                    $hasAttr = false;
                }
                $productName = $productObj->name;
                $idProduct = $this->object->id_product;
            }

            if (Validate::isLoadedObject($this->object)) {
                $subscriptionProductAttr = WkProductSubscriptionModel::getSubscriptionProductAttributes($this->object->id_product);
                if (is_array($subscriptionProductAttr) && count($subscriptionProductAttr) > 0) {
                    $subscriptionProductAttr = array_column($subscriptionProductAttr, 'id_product_attribute');
                }
            }
        }

        $this->context->smarty->assign([
            'id' => $id,
            'displayShopWarning' => $displayShopWarning,
            'product_name' => $productName,
            'id_product' => (int) $idProduct,
            'combinations' => $combinations,
            'subscriptionProductAttr' => $subscriptionProductAttr,
            'hasAttr' => $hasAttr,
            'subscriptionData' => $subscriptionData,
            'daily_cycles' => $dailyCycles,
            'weekly_cycles' => $weeklyCycles,
            'monthly_cycles' => $monthlyCycles,
            'yearly_cycles' => $yearlyCycles,
        ]);

        $this->fields_form = [
            'submit' => [
                'title' => $this->module->l('Save', get_class()),
                'name' => 'submit' . $this->table,
            ],
        ];

        return parent::renderForm();
    }

    public function initToolbar()
    {
        if ($this->display == 'view') {
            $idWkSubscription = Tools::getValue('id_wk_subscription_products');
            if ($idWkSubscription) {
                $this->toolbar_title = $this->module->l('Products', get_class()) . ' > ' .
                $this->displayToolbarTitleLocationPath($idWkSubscription);
            }
        }
        parent::initToolbar();
    }

    private function displayToolbarTitleLocationPath($idWkSubscription)
    {
        $objWkProductSubscriptionModel = new WkProductSubscriptionModel((int) $idWkSubscription);

        if (Validate::isLoadedObject($objWkProductSubscriptionModel)) {
            $objProduct = new Product((int) $objWkProductSubscriptionModel->id_product);
            if (Validate::isLoadedObject($objProduct)) {
                return $objProduct->name[$this->context->language->id];
            }
        }

        return '--';
    }

    public function processSave()
    {
        $subscriptionData = [];
        $idLang = $this->context->language->id;
        $idProduct = Tools::getValue('id_product');
        $idProductAttr = Tools::getValue('id_product_attribute');
        $hasAttr = false;
        $id = Tools::getValue('id');
        if ((int) $idProduct == 0) {
            $this->errors[] = $this->module->l('Please select a product.', get_class());
        } else {
            $productObj = new Product((int) $idProduct, false, (int) $idLang);
            if (Validate::isLoadedObject($productObj)) {
                if ($productObj->hasAttributes()) {
                    $hasAttr = true;
                }
            }

            if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')) {
                if ($productObj->getType() == Product::PTYPE_PACK || $productObj->getType() == Product::PTYPE_VIRTUAL) {
                    $this->errors[] = $this->module->l('Enable "Apply virtual/pack product for subscription" setting to activate this product.', get_class());
                }
            }
        }
        if ($hasAttr) {
            if (!$idProductAttr) {
                $this->errors[] = $this->module->l('Please select a product combination.', get_class());
            }
        }

        $flag = true;
        if (isset($id) && $id) {
            $objProdSubs = new WkProductSubscriptionModel((int) $id);
            if ($objProdSubs->id_product == $idProduct
                && $objProdSubs->id_product_attribute == $idProductAttr
            ) {
                $flag = false;
            }
        }

        if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct, $idProductAttr) && $flag) {
            $this->errors[] = $this->module->l('Subscription is already exists for this product and combination.', get_class());
        }

        $hasSelectedFrequency = false;

        $subscriptionData['subscription_only'] = Tools::getValue('subscription_only');

        if (Tools::getValue('daily_frequency')) {
            $subscriptionData['daily_frequency'] = (int) Tools::getValue('daily_frequency');
            $hasSelectedFrequency = true;
            if (Tools::getIsset('daily_cycles')) {
                $subscriptionData['daily_cycles'] = json_encode(Tools::getValue('daily_cycles'));
                $discounts = Tools::getValue('daily_cycles_discount');
                $discountArray = [];
                foreach ($discounts as $discount) {
                    if (!Validate::isPrice($discount)) {
                        $discount = '0.00';
                    }
                    $discountArray[] = $discount;
                }
                $subscriptionData['daily_cycles_discount'] = json_encode($discountArray);
            } else {
                $this->errors[] = $this->module->l('Please select at least one daily cycle!', get_class());
            }
        } else {
            $subscriptionData['daily_cycles'] = '';
            $subscriptionData['daily_frequency'] = 0;
            $subscriptionData['daily_cycles_discount'] = '';
        }

        if (Tools::getValue('weekly_frequency')) {
            $subscriptionData['weekly_frequency'] = (int) Tools::getValue('weekly_frequency');
            $hasSelectedFrequency = true;
            if (Tools::getIsset('weekly_cycles')) {
                $subscriptionData['weekly_cycles'] = json_encode(Tools::getValue('weekly_cycles'));
                $discounts = Tools::getValue('weekly_cycles_discount');
                $discountArray = [];
                foreach ($discounts as $discount) {
                    if (!Validate::isPrice($discount)) {
                        $discount = '0.00';
                    }
                    $discountArray[] = $discount;
                }
                $subscriptionData['weekly_cycles_discount'] = json_encode($discountArray);
            } else {
                $this->errors[] = $this->module->l('Please select at least one weekly cycle!', get_class());
            }
        } else {
            $subscriptionData['weekly_cycles'] = '';
            $subscriptionData['weekly_frequency'] = 0;
            $subscriptionData['weekly_cycles_discount'] = '';
        }

        if (Tools::getValue('monthly_frequency')) {
            $subscriptionData['monthly_frequency'] = (int) Tools::getValue('monthly_frequency');
            $hasSelectedFrequency = true;
            if (Tools::getIsset('monthly_cycles')) {
                $subscriptionData['monthly_cycles'] = json_encode(Tools::getValue('monthly_cycles'));
                $discounts = Tools::getValue('monthly_cycles_discount');
                $discountArray = [];
                foreach ($discounts as $discount) {
                    if (!Validate::isPrice($discount)) {
                        $discount = '0.00';
                    }
                    $discountArray[] = $discount;
                }
                $subscriptionData['monthly_cycles_discount'] = json_encode($discountArray);
            } else {
                $this->errors[] = $this->module->l('Please select at least one monthly cycle!', get_class());
            }
        } else {
            $subscriptionData['monthly_cycles'] = '';
            $subscriptionData['monthly_frequency'] = 0;
            $subscriptionData['monthly_cycles_discount'] = '';
        }

        if (Tools::getValue('yearly_frequency')) {
            $subscriptionData['yearly_frequency'] = (int) Tools::getValue('yearly_frequency');
            $hasSelectedFrequency = true;
            if (Tools::getIsset('yearly_cycles')) {
                $subscriptionData['yearly_cycles'] = json_encode(Tools::getValue('yearly_cycles'));
                $discounts = Tools::getValue('yearly_cycles_discount');
                $discountArray = [];
                foreach ($discounts as $discount) {
                    if (!Validate::isPrice($discount)) {
                        $discount = '0.00';
                    }
                    $discountArray[] = $discount;
                }
                $subscriptionData['yearly_cycles_discount'] = json_encode($discountArray);
            } else {
                $this->errors[] = $this->module->l('Please select at least one yearly cycle!', get_class());
            }
        } else {
            $subscriptionData['yearly_cycles'] = '';
            $subscriptionData['yearly_frequency'] = 0;
            $subscriptionData['yearly_cycles_discount'] = '';
        }

        if (!$hasSelectedFrequency) {
            $this->errors[] = $this->module->l('Please select at least one cycle of any frequency!', get_class());
        }

        if (empty($this->errors)) {
            $subscriptionData['id_product'] = (int) $idProduct;
            // $subscriptionData['id_product_attribute'] = $idProductAttr;
            $subscriptionData['active'] = (int) Tools::getValue('active');
            $subscriptionData['id_shop_default'] = (int) $this->context->shop->id;
            // Save data
            $result = $this->saveProductSubscriptionOption($subscriptionData, $idProductAttr, $id);
            if ($result) {
                $wkConf = ($id > 0) ? 4 : 3;
                if (Tools::isSubmit('submitAddwk_subscription_productsAndStay')) {
                    Tools::redirectAdmin(
                        self::$currentIndex . '&conf=' . $wkConf . '&updatewk_subscription_products&id_wk_subscription_products=' .
                        $id . '&token=' . $this->token
                    );
                } else {
                    if ($wkConf == 3) {
                        Tools::redirectAdmin(self::$currentIndex . '&conf=' . $wkConf . '&token=' . $this->token);
                    }
                    Tools::redirectAdmin(self::$currentIndex . '&conf=' . $wkConf . '&viewwk_subscription_products&id_wk_subscription_products=' .
                    $id . '&token=' . $this->token);
                }
            } else {
                $this->errors[] = $this->module->l('Something went wrong when saving subscription details.', get_class());
                $this->display = 'edit';
            }
        } else {
            if ($id) {
                $this->display = 'edit';
            } else {
                $this->display = 'add';
            }
        }
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitFilter') && Tools::isSubmit('viewwk_subscription_products')) {
            $id = Tools::getValue('id_wk_subscription_products');
            self::$currentIndex = self::$currentIndex . '&id_wk_subscription_products=' . $id . '&viewwk_subscription_products';
        } elseif (Tools::isSubmit('submitResetwk_subscription_products')) {
            $this->processResetFilters();
        }

        parent::postProcess();
    }

    private function saveProductSubscriptionOption(
        $subscriptionData,
        $idProductAttr = 0,
        $id = 0
    ) {
        $result = true;
        if ($id) {
            $wkObj = new WkProductSubscriptionModel($id);
            foreach ($subscriptionData as $key => $value) {
                $wkObj->{$key} = $value;
            }

            return $wkObj->save();
        } else {
            if ($idProductAttr && $idProductAttr[0] === 'all') {
                $combinations = WkProductSubscriptionModel::getProductCombinations(
                    $subscriptionData['id_product'],
                    (int) $this->context->language->id
                );

                foreach ($combinations as $comb) {
                    // If editing in "All shop context or shop group" then delete existing
                    if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
                        if ($idSubs = WkProductSubscriptionModel::checkIfSubscriptionProduct($subscriptionData['id_product'], $comb['id_product_attribute'])) {
                            $wkObj = new WkProductSubscriptionModel((int) $idSubs);
                            if (Validate::isLoadedObject($wkObj)) {
                                $wkObj->delete();
                            }
                            unset($wkObj);
                        }
                    }

                    $idExist = WkProductSubscriptionModel::checkIfSubscriptionProductNoShop(
                        (int) $subscriptionData['id_product'],
                        (int) $comb['id_product_attribute']
                    );

                    // Check if this product is already subscription
                    if ($idExist) {
                        $wkObj = new WkProductSubscriptionModel($idExist);
                    } else {
                        $wkObj = new WkProductSubscriptionModel();
                    }
                    $subscriptionData['id_product_attribute'] = $comb['id_product_attribute'];
                    foreach ($subscriptionData as $key => $value) {
                        $wkObj->{$key} = $value;
                    }
                    $result &= $wkObj->save();
                    unset($wkObj);
                }

                return $result;
            } else {
                if (is_array($idProductAttr) && count($idProductAttr) > 0) {
                    $success = true;
                    foreach ($idProductAttr as $idAttr) {
                        // If editing in "All shop context or shop group" then delete existing
                        if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
                            if ($idSubs = WkProductSubscriptionModel::checkIfSubscriptionProduct($subscriptionData['id_product'], $idAttr)) {
                                $wkObj = new WkProductSubscriptionModel((int) $idSubs);
                                if (Validate::isLoadedObject($wkObj)) {
                                    $wkObj->delete();
                                }
                                unset($wkObj);
                            }
                        }

                        $idExist = WkProductSubscriptionModel::checkIfSubscriptionProductNoShop(
                            (int) $subscriptionData['id_product'],
                            (int) $idAttr
                        );
                        // Check if this product is already subscription
                        if ($idExist) {
                            $wkObj = new WkProductSubscriptionModel($idExist);
                        } else {
                            $wkObj = new WkProductSubscriptionModel();
                        }
                        $subscriptionData['id_product_attribute'] = $idAttr;
                        foreach ($subscriptionData as $key => $value) {
                            $wkObj->{$key} = $value;
                        }

                        $success &= $wkObj->save();
                    }

                    return $success;
                }

                // If editing in "All shop context or shop group" then delete existing
                if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
                    if ($idSubs = WkProductSubscriptionModel::checkIfSubscriptionProduct($subscriptionData['id_product'], $idProductAttr)) {
                        $wkObj = new WkProductSubscriptionModel((int) $idSubs);
                        if (Validate::isLoadedObject($wkObj)) {
                            $wkObj->delete();
                        }
                        unset($wkObj);
                    }
                }
                $idExist = WkProductSubscriptionModel::checkIfSubscriptionProductNoShop(
                    (int) $subscriptionData['id_product'],
                    (int) $idProductAttr
                );
                // Check if this product is already subscription
                if ($idExist) {
                    $wkObj = new WkProductSubscriptionModel($idExist);
                } else {
                    $wkObj = new WkProductSubscriptionModel();
                }
                $subscriptionData['id_product_attribute'] = $idProductAttr;
                foreach ($subscriptionData as $key => $value) {
                    $wkObj->{$key} = $value;
                }

                return $wkObj->save();
            }
        }
    }

    public function ajaxProcessGetProducts()
    {
        $this->context = Context::getContext();
        $idLang = $this->context->language->id;
        $query = Tools::getValue('query');
        if ($query) {
            $allproducts = Product::searchByName($idLang, $query, null);
            if ($allproducts) {
                foreach ($allproducts as $key => $prod) {
                    if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')) {
                        $objProduct = new Product($prod['id_product']);
                        if (Validate::isLoadedObject($objProduct)) {
                            if ($objProduct->getProductType() == 'virtual' || $objProduct->product_type == 'pack') {
                                unset($allproducts[$key]);
                                continue;
                            }
                        }
                    }

                    if (!$prod['active']) {
                        unset($allproducts[$key]);
                        continue;
                    } else {
                        $allproducts[$key]['id'] = $prod['id_product'];
                        $allproducts[$key]['label'] = $prod['name'];
                        $allproducts[$key]['value'] = $prod['name'];
                        $allproducts[$key]['attr'] = WkProductSubscriptionModel::hasAttributes($prod['id_product']);
                    }
                }
                $jdata = 'false';

                if (!empty($allproducts)) {
                    foreach ($allproducts as $key => &$prod) {
                        $isSubscriptionExist = WkProductSubscriptionModel::checkIfSubscriptionProduct($prod['id_product']);
                        if ($isSubscriptionExist) {
                            unset($allproducts[$key]);
                        }
                    }
                    $jdata = json_encode($allproducts);
                }

                echo $jdata;
                exit;
            } else {
                echo 'false';
                exit;
            }
        }
        echo 'false';
        exit;
    }

    public function ajaxProcessGetCombinations()
    {
        $this->context = Context::getContext();
        $idLang = $this->context->language->id;
        $idProduct = Tools::getValue('id_product');
        if ($idProduct) {
            $combinations = WkProductSubscriptionModel::getProductCombinations($idProduct, $idLang);
            if ($combinations) {
                $jdata = json_encode($combinations);
                echo $jdata;
                exit;
            } else {
                echo 'false';
                exit;
            }
        }
        echo 'false';
        exit;
    }

    public function ajaxProcessGetModuleFeaturesContent()
    {
        $moduleIds = WkProductSubscriptionGlobal::getAllSupportedModuleList();
        if (!empty($moduleIds)) {
            $data = [];
            foreach ($moduleIds as $key => $module) {
                $splitOrder = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_SPLIT_ORDER);
                $createSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_CREATE);
                $updateSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE);
                $pauseSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_PAUSE);
                $cancelSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_CANCEL);
                $autoRenewSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_AUTORENEW);
                $freuencyUpdateSubs = WkProductSubscriptionGlobal::checkPaymentModuleHasFeature($module, WkProductSubscriptionGlobal::WK_SUBS_FEATURE_UPDATE_FREQUENCY);
                $showInfoContent = false;
                if ($createSubs || $splitOrder || $updateSubs || $pauseSubs || $cancelSubs) {
                    $showInfoContent = true;
                }
                $this->context->smarty->assign([
                    'split_order' => $splitOrder,
                    'create_subs' => $createSubs,
                    'update_subs' => $updateSubs,
                    'pause_subs' => $pauseSubs,
                    'cancel_subs' => $cancelSubs,
                    'autorenew_subs' => $autoRenewSubs,
                    'freuency_update_subs' => $freuencyUpdateSubs,
                    'show_content' => $showInfoContent,
                ]);
                $tpl = $this->context->smarty->fetch(
                    _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/payment_feature.tpl'
                );
                $data[$key]['tpl'] = $tpl;
                $data[$key]['div_id'] = 'feature_content_' . $module;
            }
            $jdata = json_encode($data);
            echo $jdata;
            exit;
        }
        echo 'false';
        exit;
    }

    public function ajaxProcessValidateForm()
    {
        $this->context = Context::getContext();
        $idLang = $this->context->language->id;
        $hasAttr = false;

        $formData = Tools::getValue('formData');
        parse_str($formData, $formDataArr);

        $idProduct = $formDataArr['id_product'];
        $idProductAttr = isset($formDataArr['id_product_attribute']) ? $formDataArr['id_product_attribute'] : false;

        if ((int) $idProduct == 0) {
            $this->errors[] = $this->module->l('Please select a product.', get_class());
        } else {
            $productObj = new Product((int) $idProduct, false, (int) $idLang);
            if (Validate::isLoadedObject($productObj)) {
                if ($productObj->hasAttributes()) {
                    $hasAttr = true;
                }
            }

            if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')) {
                if ($productObj->getType() == Product::PTYPE_PACK || $productObj->getType() == Product::PTYPE_VIRTUAL) {
                    $this->errors[] = $this->module->l('Enable "Apply virtual/pack product for subscription" setting to activate this product.', get_class());
                }
            }
        }

        if ($hasAttr) {
            if (!$idProductAttr) {
                $this->errors[] = $this->module->l('Please select a product combination.', get_class());
            }
        }

        $flag = true;
        if (isset($formDataArr['id']) && $formDataArr['id']) {
            $objProdSubs = new WkProductSubscriptionModel((int) $formDataArr['id']);

            if (is_array($idProductAttr) && count($idProductAttr) > 0) {
                foreach ($idProductAttr as $prodAtt) {
                    if ($objProdSubs->id_product == $idProduct
                    && $objProdSubs->id_product_attribute == $prodAtt
                    ) {
                        $flag = false;
                    }
                }
            }
        }

        if (is_array($idProductAttr) && count($idProductAttr) > 0) {
            foreach ($idProductAttr as $prodAtt) {
                if (WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct, $prodAtt) && $flag) {
                    $this->errors[] = $this->module->l('Subscription is already exists for this product and combination.', get_class());
                }
            }
        } else {
            if (!isset($formDataArr['id']) && WkProductSubscriptionModel::checkIfSubscriptionProduct($idProduct, $idProductAttr) && $flag) {
                $this->errors[] = $this->module->l('Subscription is already exists for this product and combination.', get_class());
            }
        }

        $hasSelectedFrequency = false;

        if ($formDataArr['daily_frequency']) {
            $hasSelectedFrequency = true;
            if (!isset($formDataArr['daily_cycles']) || !$formDataArr['daily_cycles']) {
                $this->errors[] = $this->module->l('Please select at least one daily cycle!', get_class());
            }
        }

        if ($formDataArr['weekly_frequency']) {
            $hasSelectedFrequency = true;
            if (!isset($formDataArr['weekly_cycles']) || !$formDataArr['weekly_cycles']) {
                $this->errors[] = $this->module->l('Please select at least one weekly cycle!', get_class());
            }
        }

        if ($formDataArr['monthly_frequency']) {
            $hasSelectedFrequency = true;
            if (!isset($formDataArr['monthly_cycles']) || !$formDataArr['monthly_cycles']) {
                $this->errors[] = $this->module->l('Please select at least one monthly cycle!', get_class());
            }
        }

        if ($formDataArr['yearly_frequency']) {
            $hasSelectedFrequency = true;
            if (!isset($formDataArr['yearly_cycles']) || !$formDataArr['yearly_cycles']) {
                $this->errors[] = $this->module->l('Please select at least one yearly cycle!', get_class());
            }
        }

        if (!$hasSelectedFrequency && (int) $idProduct !== 0) {
            $this->errors[] = $this->module->l('Please select at least one cycle of any frequency!', get_class());
        }

        if (count($this->errors)) {
            exit(json_encode([
                'hasError' => true,
                'errors' => $this->errors,
            ]));
        } else {
            exit(json_encode([
                'hasError' => false,
            ]));
        }
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        Media::addJsDef([
            'wkajax_url' => $this->context->link->getAdminLink(
                'AdminSubscriptions',
                true
            ),
            'no_comb_txt' => $this->module->l('No combination', get_class()),
            'all_comb_txt' => $this->module->l('All combination', get_class()),
            'select_comb_txt' => $this->module->l('Select combination', get_class()),
            'enter_valid_value' => $this->module->l('Please enter a valid value', get_class()),
        ]);
        $this->addJqueryUI('ui.autocomplete');
        $this->addjQueryPlugin('growl', null, false);
        $modulePath = _PS_MODULE_DIR_ . $this->module->name;
        $this->addCSS($modulePath . '/views/css/wkproductsubscription_back.css');
        $this->addJS($modulePath . '/views/js/wkproductsubscription_back.js');
    }

    public function renderList()
    {
        // $this->addRowAction('viewProduct');
        $this->addRowAction('view');
        // $this->addRowAction('edit');
        $this->addRowAction('delete');

        return parent::renderList();
    }

    public function renderView()
    {
        $id_subscription_product = Tools::getValue('id_wk_subscription_products');
        if ($id_subscription_product) {
            if (!Tools::isSubmit('submitFilterwk_subscription_products')) {
                $this->processResetFilters();
            }

            $objWkProductSubscriptionModel = new WkProductSubscriptionModel($id_subscription_product);
            if (!Validate::isLoadedObject($objWkProductSubscriptionModel)) {
                Tools::redirectAdmin(self::$currentIndex . '&token=' . Tools::getValue('token'));
            } else {
                self::$currentIndex .= self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . $id_subscription_product;
            }

            unset($this->_group);
            unset($this->_orderWay);

            self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . Tools::getValue('id_wk_subscription_products');
            /** @var WkProductSubscriptionModel $this->object */
            $idProduct = $this->object->id_product;
            if (!$idProduct) {
                $id_Product = WkProductSubscriptionModel::getProductIdByShopAndID($this->object->id, $this->object->id_shop_default);
                $idProduct = $id_Product ?: $id_subscription_product;
            }

            $this->_select .= ', a.`id_product_attribute` as product_attribute_name';
            $this->_where .= ' AND a.id_product = ' . (int) $idProduct;
            $this->_group = 'GROUP BY a.id_product, a.id_product_attribute';

            $this->fields_list = [
                'id_product_attribute' => [
                    'title' => $this->module->l('Attribute ID', get_class()),
                    'type' => 'int',
                    'align' => 'center',
                    'class' => 'fixed-width-xs',
                    'filter_key' => 'a!id_product_attribute',
                    'orderby' => false,
                    'orderBy' => false,
                    'havingFilter' => true,
                ],
                'image' => [
                    'title' => $this->module->l('Image', get_class()),
                    'search' => false,
                    'orderby' => false,
                    'align' => 'center',
                    'callback' => 'displayProductImage',
                ],
                'product_name' => [
                    'title' => $this->module->l('Name', get_class()),
                    'align' => 'left',
                    'havingFilter' => true,
                    'orderby' => false,
                    'callback' => 'getProductLink',
                ],
                'product_attribute_name' => [
                    'title' => $this->module->l('Attribute', get_class()),
                    'search' => false,
                    'orderby' => false,
                    'filter_key' => 'a!id_product_attribute',
                    'callback' => 'displayCombinationName',
                ],
                'subscribers' => [
                    'title' => $this->module->l('Subscribers', get_class()),
                    'search' => false,
                    'orderby' => false,
                    'type' => 'int',
                    'align' => 'center',
                    'callback' => 'displayProductSubscriberAttrCount',
                ],
                'daily_cycles' => [
                    'title' => $this->module->l('Daily cycles', get_class()),
                    'align' => 'center',
                    'search' => false,
                    'orderby' => false,
                    'hint' => $this->module->l('Daily basis cycles are in days separated by comma', get_class()),
                    'callback' => 'dispalyFormattedCycles',
                    'order_key' => 'wk_subscription_products_shop!daily_cycles',
                ],
                'weekly_cycles' => [
                    'title' => $this->module->l('Weekly cycles', get_class()),
                    'align' => 'center',
                    'search' => false,
                    'orderby' => false,
                    'hint' => $this->module->l('Weekly basis cycles are in week separated by comma'),
                    'callback' => 'dispalyFormattedCycles',
                    'order_key' => 'wk_subscription_products_shop!weekly_cycles',
                ],
                'monthly_cycles' => [
                    'title' => $this->module->l('Monthly cycles', get_class()),
                    'align' => 'center',
                    'search' => false,
                    'orderby' => false,
                    'hint' => $this->module->l('Monthly basis cycles are in month separated by comma', get_class()),
                    'callback' => 'dispalyFormattedCycles',
                    'order_key' => 'wk_subscription_products_shop!monthly_cycles',
                ],
                'yearly_cycles' => [
                    'title' => $this->module->l('Yearly cycles', get_class()),
                    'align' => 'center',
                    'search' => false,
                    'orderby' => false,
                    'hint' => $this->module->l('Yearly basis cycles are in year separated by comma', get_class()),
                    'callback' => 'dispalyFormattedCycles',
                    'order_key' => 'wk_subscription_products_shop!yearly_cycles',
                ],
            ];

            if (Shop::isFeatureActive() && Shop::getContext() !== Shop::CONTEXT_SHOP) {
                // In case of All Shops
                $this->fields_list['wk_ps_shop_name'] = [
                    'title' => $this->module->l('Shop', get_class()),
                    'havingFilter' => true,
                ];
            } else {
                $this->fields_list['active'] = [
                    'title' => $this->module->l('Status', get_class()),
                    'align' => 'center',
                    'type' => 'bool',
                    'class' => 'fixed-width-xs',
                    'orderby' => false,
                    'filter_key' => 'a!active',
                    'hint' => $this->module->l('Product subscription status', get_class()),
                    'active' => 'status',
                ];
            }

            if (!Shop::isFeatureActive() || Shop::getContext() === Shop::CONTEXT_SHOP) {
                $this->addRowAction('edit');
                $this->addRowAction('delete');
            }

            $this->bulk_actions = [
                'delete' => [
                    'text' => $this->module->l('Delete selected', get_class()),
                    'icon' => 'icon-trash',
                    'confirm' => $this->module->l('Delete selected items?', get_class()),
                ],
            ];

            if (Tools::isSubmit('submitFilterwk_subscription_products')) {
                $this->processFilter();
            }

            return parent::renderList();
        }

        return parent::renderView();
    }

    public function getProductLink($name, $row)
    {
        $idProduct = (int) $row['id_product'];

        // $link = $this->context->link->getAdminLink(
        //     'AdminProducts',
        //     true,
        //     ['id_product' => (int) $idProduct]
        // ) . '#tab-hooks';

        $link = $this->context->link->getAdminLink(
            'AdminProducts',
            true,
            ['id_product' => $idProduct, 'updateproduct' => '1'],
            ['id_product' => $idProduct, 'viewproduct' => '1']
        );

        $this->context->smarty->assign([
            'btnLabel' => $name,
            'btnLink' => $link,
        ]);

        return $this->context->smarty->fetch(
            _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/custom_link.tpl'
        );
    }

    public function getProductPreviewURL($idProduct)
    {
        if ($idProduct) {
            $objProduct = new Product((int) $idProduct);
            if (Validate::isLoadedObject($objProduct)) {
                $idLang = (int) $this->context->language->id;
                $idShopDefault = (int) $this->context->shop->id;
                $link = $this->context->link->getProductLink(
                    $objProduct,
                    $objProduct->link_rewrite,
                    Category::getLinkRewrite((int) $objProduct->id_category_default, (int) $idLang),
                    null,
                    (int) $idLang,
                    (int) $idShopDefault,
                );

                $this->context->smarty->assign([
                    'btnLabel' => $this->module->l('View', get_class()),
                    'btnLink' => $link,
                    'icon' => 'icon-eye',
                ]);

                return $this->context->smarty->fetch(
                    _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/custom_btn.tpl'
                );
            }
        }

        return '---';
    }

    public function displayProductImage($idProduct, $val)
    {
        $glbObj = new WkProductSubscriptionGlobal();
        $image_url = $glbObj->getProductImageUrl(
            new Product(
                (int) $idProduct,
                false,
                (int) $this->context->language->id
            ),
            $val['id_product_attribute']
        );

        if ($image_url) {
            $this->context->smarty->assign([
                'image_url' => $image_url,
            ]);

            return $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/product_img.tpl'
            );
        } else {
            return '--';
        }
    }

    public function displayProductSubscriberCount($idProduct)
    {
        return WkProductSubscriptionGlobal::getProductSubscriberCount((int) $idProduct);
    }

    public function displayProductSubscriberAttrCount($idProduct, $row)
    {
        return WkProductSubscriptionGlobal::getProductSubscriberCount((int) $idProduct, $row['id_product_attribute']);
    }

    public function displayProductSubscriptionCount($idProduct, $params)
    {
        return WkProductSubscriptionGlobal::getProductSubscriptionCount((int) $idProduct);
    }

    public function displayFormattedPrice($price, $row)
    {
        return WkProductSubscription::displayPrice(Product::getPriceStatic($row['id_product'], true, $row['id_product_attribute']));
    }

    public function dispalyFormattedCycles($cycleString)
    {
        if ($cycleString) {
            return implode(', ', json_decode($cycleString));
        } else {
            return '--';
        }
    }

    public function displayStockQuantity($quantity, $rowData)
    {
        $quantity = (int) StockAvailable::getQuantityAvailableByProduct($rowData['id_product'], $rowData['id_product_attribute']);

        return $quantity;
    }

    public function ajaxProcessGetBulkAssignModal()
    {
        if (Tools::isSubmit('action')
            && (Tools::getAdminTokenLite('AdminSubscriptions') == Tools::getValue('token'))
        ) {
            $displayShopWarning = false;
            $displayShopGroupWarning = false;
            $displayPackWarning = false;
            if (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_ALL) {
                $displayShopWarning = true;
            } elseif (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_GROUP) {
                $displayShopGroupWarning = true;
            }

            if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')) {
                $displayPackWarning = true;
            }

            $dailyString = $this->module->l('Every %d day', get_class());
            $everyDayString = $this->module->l('Everyday', get_class());
            $weeklyString = $this->module->l('Every %d week', get_class());
            $everyWeekString = $this->module->l('Every week', get_class());
            $monthlyString = $this->module->l('Every %d month', get_class());
            $everyMonthString = $this->module->l('Every month', get_class());
            $yearlyString = $this->module->l('Every %d year', get_class());
            $everyYearString = $this->module->l('Every year', get_class());

            $dailyCycles = [];
            $weeklyCycles = [];
            $monthlyCycles = [];
            $yearlyCycles = [];

            // Daily cycles
            $dailyCycles[1] = $everyDayString;
            for ($day = 2; $day <= 6; ++$day) {
                $dailyCycles[$day] = sprintf($dailyString, $day);
            }

            // Weekly cycles
            $weeklyCycles[1] = $everyWeekString;
            for ($week = 2; $week <= 4; ++$week) {
                $weeklyCycles[$week] = sprintf($weeklyString, $week);
            }

            // Monthly cycles
            $monthlyCycles[1] = $everyMonthString;
            for ($month = 2; $month <= 6; ++$month) {
                $monthlyCycles[$month] = sprintf($monthlyString, $month);
            }

            // Yearly cycles
            $yearlyCycles[1] = $everyYearString;
            for ($year = 2; $year <= 2; ++$year) {
                $yearlyCycles[$year] = sprintf($yearlyString, $year);
            }
            $this->context->smarty->assign([
                'daily_cycles' => $dailyCycles,
                'weekly_cycles' => $weeklyCycles,
                'monthly_cycles' => $monthlyCycles,
                'yearly_cycles' => $yearlyCycles,
                'displayShopWarning' => $displayShopWarning,
                'displayShopGroupWarning' => $displayShopGroupWarning,
                'displayPackWarning' => $displayPackWarning,
            ]);
            $catelogModal = $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . 'wkproductsubscription/views/templates/admin/_partials/subscription_bulk_form.tpl'
            );
            exit(json_encode([
                'success' => true,
                'tpl' => $catelogModal,
            ]));
        }
        exit('0');
    }

    public function ajaxProcessAssignBulkSubscriptions()
    {
        if (Tools::isSubmit('action')
            && (Tools::getAdminTokenLite('AdminSubscriptions') == Tools::getValue('token'))
        ) {
            $idProducts = Tools::getValue('idProducts');
            parse_str(Tools::getValue('frequencies'), $frequencies);
            $errors = [];
            if (count($frequencies) && $idProducts && $frequencies['allow_subscription']) {
                $subscriptionData = [];
                $subscriptionData = [
                    'active' => (int) $frequencies['allow_subscription'],
                ];
                $subscriptionData['subscription_only'] = 0;
                $subscriptionData['id_shop_default'] = (int) $this->context->shop->id;
                $hasSelectedFrequency = false;

                if ($frequencies['daily_frequency']) {
                    $subscriptionData['daily_frequency'] = (int) $frequencies['daily_frequency'];
                    $hasSelectedFrequency = true;
                    if (isset($frequencies['daily_cycles'])) {
                        $subscriptionData['daily_cycles'] = json_encode($frequencies['daily_cycles']);
                        $discounts = $frequencies['daily_cycles_discount'];
                        $discountArray = [];
                        foreach ($discounts as $discount) {
                            if (!Validate::isPrice($discount)) {
                                $discount = '0.00';
                            }
                            $discountArray[] = $discount;
                        }
                        $subscriptionData['daily_cycles_discount'] = json_encode($discountArray);
                    } else {
                        $errors[] = [
                            $this->module->l('Please select at least one daily cycle!', get_class()),
                        ];
                    }
                } else {
                    $subscriptionData['daily_cycles'] = '';
                    $subscriptionData['daily_frequency'] = 0;
                    $subscriptionData['daily_cycles_discount'] = '';
                }

                if ($frequencies['weekly_frequency']) {
                    $subscriptionData['weekly_frequency'] = (int) $frequencies['weekly_frequency'];
                    $hasSelectedFrequency = true;
                    if (isset($frequencies['weekly_cycles'])) {
                        $subscriptionData['weekly_cycles'] = json_encode($frequencies['weekly_cycles']);
                        $discounts = $frequencies['weekly_cycles_discount'];
                        $discountArray = [];
                        foreach ($discounts as $discount) {
                            if (!Validate::isPrice($discount)) {
                                $discount = '0.00';
                            }
                            $discountArray[] = $discount;
                        }
                        $subscriptionData['weekly_cycles_discount'] = json_encode($discountArray);
                    } else {
                        $errors[] = [
                            $this->module->l('Please select at least one weekly cycle!', get_class()),
                        ];
                    }
                } else {
                    $subscriptionData['weekly_cycles'] = '';
                    $subscriptionData['weekly_frequency'] = 0;
                    $subscriptionData['weekly_cycles_discount'] = '';
                }

                if ($frequencies['monthly_frequency']) {
                    $subscriptionData['monthly_frequency'] = (int) $frequencies['monthly_frequency'];
                    $hasSelectedFrequency = true;
                    if (isset($frequencies['monthly_cycles'])) {
                        $subscriptionData['monthly_cycles'] = json_encode($frequencies['monthly_cycles']);
                        $discounts = $frequencies['monthly_cycles_discount'];
                        $discountArray = [];
                        foreach ($discounts as $discount) {
                            if (!Validate::isPrice($discount)) {
                                $discount = '0.00';
                            }
                            $discountArray[] = $discount;
                        }
                        $subscriptionData['monthly_cycles_discount'] = json_encode($discountArray);
                    } else {
                        $errors[] = [
                            $this->module->l('Please select at least one monthly cycle!', get_class()),
                        ];
                    }
                } else {
                    $subscriptionData['monthly_cycles'] = '';
                    $subscriptionData['monthly_frequency'] = 0;
                    $subscriptionData['monthly_cycles_discount'] = '';
                }

                if ($frequencies['yearly_frequency']) {
                    $subscriptionData['yearly_frequency'] = (int) $frequencies['yearly_frequency'];
                    $hasSelectedFrequency = true;
                    if (isset($frequencies['yearly_cycles'])) {
                        $subscriptionData['yearly_cycles'] = json_encode($frequencies['yearly_cycles']);
                        $discounts = $frequencies['yearly_cycles_discount'];
                        $discountArray = [];
                        foreach ($discounts as $discount) {
                            if (!Validate::isPrice($discount)) {
                                $discount = '0.00';
                            }
                            $discountArray[] = $discount;
                        }
                        $subscriptionData['yearly_cycles_discount'] = json_encode($discountArray);
                    } else {
                        $errors[] = [
                            $this->module->l('Please select at least one yearly cycle!', get_class()),
                        ];
                    }
                } else {
                    $subscriptionData['yearly_cycles'] = '';
                    $subscriptionData['yearly_frequency'] = 0;
                    $subscriptionData['yearly_cycles_discount'] = '';
                }

                if (!$hasSelectedFrequency && $subscriptionData['active']) {
                    $errors[] = [
                        $this->module->l('Please select at least one cycle of any frequency!', get_class()),
                    ];
                }

                if (count($errors) == 0) {
                    foreach ($idProducts as $id_product) {
                        $objProduct = new Product((int) $id_product);
                        if (!Configuration::get('WK_SUBSCRIPTION_ENABLE_VIRTUAL_PACK')
                            && ($objProduct->getType() != Product::PTYPE_SIMPLE)
                        ) {
                            continue;
                        }

                        // If editing in "All shop context or shop group" then delete existing
                        if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
                            if ($idSubs = WkProductSubscriptionModel::checkIfSubscriptionProduct($id_product)) {
                                $wkObj = new WkProductSubscriptionModel((int) $idSubs);
                                if (Validate::isLoadedObject($wkObj)) {
                                    $wkObj->delete();
                                }
                                unset($wkObj);
                            }
                        }

                        if (!empty($subscriptionData['daily_cycles'])
                            || !empty($subscriptionData['weekly_cycles'])
                            || !empty($subscriptionData['monthly_cycles'])
                            || !empty($subscriptionData['yearly_cycles'])
                        ) {
                            $subscriptionData['id_product'] = $id_product;

                            if ($objProduct->hasAttributes()) {
                                $this->saveProductSubscriptionOption(
                                    $subscriptionData,
                                    'all'
                                );
                            } else {
                                $this->saveProductSubscriptionOption($subscriptionData);
                            }
                        }
                    }
                    $redirectUrl = $this->context->link->getAdminLink(
                        'AdminProducts',
                        true,
                        ['subsAssign' => 1]
                    );
                    exit(json_encode([
                        'success' => true,
                        'message' => $this->module->l('Process Completed!', get_class()),
                        'url' => $redirectUrl,
                    ]));
                } else {
                    exit(json_encode([
                        'success' => false,
                        'message' => $errors,
                    ]));
                }
            } else {
                exit(json_encode([
                    'success' => false,
                    'message' => $this->module->l('Product IDs or subscription frequency missing!', get_class()),
                ]));
            }
        }
        exit(json_encode([
            'success' => false,
            'message' => $this->module->l('Invalid token!', get_class()),
        ]));
    }

    protected function processBulkDeleteWksubscriptionProudct()
    {
        $selectedRows = Tools::getValue('wk_subscription_productsBox');
        $id_subscription_product = Tools::getValue('id_wk_subscription_products');
        if ($id_subscription_product) {
            self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . $id_subscription_product;
        }

        if (!empty($selectedRows)) {
            $objWkProductSubscriptionModel = new WkProductSubscriptionModel();
            $allSelectedRows = [];
            foreach ($selectedRows as $row) {
                $allSelectedRows[] = (int) $row;
                if (!$id_subscription_product) {
                    $subscriptionDetails = $objWkProductSubscriptionModel->getDatadBySubsId($row);
                    if (isset($subscriptionDetails['id_product'])) {
                        $allGroupedRows = WkProductSubscriptionModel::getGroupByRecord($subscriptionDetails['id_product']);
                        if ($allGroupedRows && (is_array($allGroupedRows) && count($allGroupedRows) > 0)) {
                            $allSelectedRows = array_merge(array_column($allGroupedRows, 'id_wk_subscription_products'), $allSelectedRows);
                        } else {
                            $allSelectedRows[] = (int) $row;
                        }
                    }
                }
            }

            if (count($allSelectedRows) > 0) {
                $allSelectedRows = array_unique($allSelectedRows);
                foreach ($allSelectedRows as $row) {
                    $objWkProductSubscriptionModel = new WkProductSubscriptionModel($row);
                    $objWkProductSubscriptionModel->delete();
                }
            }

            Tools::redirectAdmin(self::$currentIndex . '&conf=2&token=' . $this->token);
        }
    }

    protected function processBulkStatusWksubscriptionProudct($status)
    {
        $selectedRows = Tools::getValue('wk_subscription_productsBox');
        $id_subscription_product = Tools::getValue('id_wk_subscription_products');
        if ($id_subscription_product) {
            self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . $id_subscription_product;
        }

        if (empty($selectedRows)) {
            $this->errors[] = $this->module->l('You must select at least one element.', get_class());
        }

        if (empty($this->errors)) {
            foreach ($selectedRows as $row) {
                $objWkProductSubscriptionModel = new WkProductSubscriptionModel($row);
                $objWkProductSubscriptionModel->active = $status;
                $objWkProductSubscriptionModel->save();
            }

            Tools::redirectAdmin(self::$currentIndex . '&conf=5&token=' . $this->token);
        }
    }

    public function processDelete()
    {
        $objSubscriptionProduct = $this->loadObject();
        if (Validate::isLoadedObject($objSubscriptionProduct)) {
            $id_subscription_product = Tools::getValue('id_wk_subscription_products');
            if ($id_subscription_product && Tools::getIsset('viewwk_subscription_products')) {
                self::$currentIndex .= '&viewwk_subscription_products&id_wk_subscription_products=' . $id_subscription_product;
            }

            $allSelectedRows = [];
            if (!Tools::getIsset('viewwk_subscription_products')) {
                $allGroupedData = [];
                // $objWkProductSubscriptionModel = new WkProductSubscriptionModel();
                if (isset($objSubscriptionProduct->id_product)) {
                    $allGroupedRows = WkProductSubscriptionModel::getGroupByRecord($objSubscriptionProduct->id_product);
                    if ($allGroupedRows && (is_array($allGroupedRows) && count($allGroupedRows) > 0)) {
                        $allSelectedRows = array_column($allGroupedRows, 'id_wk_subscription_products');
                    }
                }

                if (count($allSelectedRows) > 0) {
                    $allSelectedRows = array_unique($allSelectedRows);
                    foreach ($allSelectedRows as $row) {
                        $objWkProductSubscriptionModel = new WkProductSubscriptionModel($row);
                        $objWkProductSubscriptionModel->delete();
                    }

                    Tools::redirectAdmin(self::$currentIndex . '&conf=2&token=' . $this->token);
                }
            } else {
                $objWkProductSubscriptionModel = new WkProductSubscriptionModel($objSubscriptionProduct->id);
                if ($objWkProductSubscriptionModel->delete()) {
                    Tools::redirectAdmin(self::$currentIndex . '&conf=2&token=' . $this->token);
                }
            }
        }

        return parent::processDelete();
    }
}
