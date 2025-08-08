<?php
/**
 * 2007-2023 boostmyshop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . 'boostmyshopagent/MyfWs.php';

class Bmsmyf
{
    protected $_configurationFields;
    protected $_module;
    protected $_context;

    public function __construct($module, $context)
    {
        $this->_module = $module;
        $this->_context = $context;
        $this->_configurationFields = [
            'bmserpcloud_account_server',
            'bmserpcloud_account_login',
            'bmserpcloud_account_password',
        ];
    }

    public function install()
    {
        return $this->_module->registerHook('displayAdminProductsExtra')
            && $this->_module->registerHook('displayAdminOrder');
    }

    public function uninstall()
    {
        return true;
    }

    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('submit' . $this->_module->name)) {
            foreach ($this->_configurationFields as $field) {
                $value = Tools::getValue($field);
                $value = (is_array($value) ? implode(',', $value) : $value);
                $value = trim($value, '/');

                if ($value) {    // prevent to save empty password
                    Configuration::updateValue($field, $value);
                }
            }
            $output .= $this->_module->displayConfirmation($this->_module->l('Settings updated'));
        }

        if (!$this->checkCanConnectMyF()) {
            return $output . $this->displayForm();
        }

        try {
            MyfWs::initToken();
            $output .= $this->_module->displayConfirmation('Connection with MyFulfillment Works !');
        } catch (\Exception $ex) {
            $output .= $this->_module->displayError('Connection with MyFulfillment doesnt work : ' . $ex->getMessage());
        }

        return $output . $this->displayForm();
    }

    private function checkCanConnectMyF()
    {
        if (empty(trim(Configuration::get('bmserpcloud_account_server'))) || empty(trim(Configuration::get('bmserpcloud_account_login'))) || empty(trim(Configuration::get('bmserpcloud_account_password')))) {
            return false;
        }

        return true;
    }

    public function displayForm()
    {
        $fields_form = [];

        $fields_form[0]['form'] = [
            'legend' => [
                'title' => $this->_module->l('Show MyFulfillment information in Prestashop'),
            ],
            'input' => [
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Server URL'),
                    'name' => 'bmserpcloud_account_server',
                    'options' => [
                        'query' => $this->getServerOptions(),
                        'id' => 'id_option',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Login'),
                    'name' => 'bmserpcloud_account_login',
                ],
                [
                    'type' => 'password',
                    'required' => false,
                    'label' => $this->_module->l('Password'),
                    'name' => 'bmserpcloud_account_password',
                ],
            ],
            'submit' => [
                'title' => $this->_module->l('Save'),
            ],
        ];

        $fields_form[1]['form'] = [
            'legend' => [
                'title' => $this->_module->l('Duplicate products'),
            ],
            'input' => [
                [
                    'type' => 'html',
                    'label' => '',
                    'name' => 'bmserpcloud_download_duplicates',
                    'html_content' => $this->getDuplicates(),
                ],
            ],
        ];

        $helper = new HelperForm();

        $helper->module = $this->_module;
        $helper->name_controller = $this->_module->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->_module->name;
        $helper->title = $this->_module->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->_module->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->_module->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->_module->name . '&save' . $this->_module->name . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ],
        ];

        $fields_value = [];
        foreach ($this->_configurationFields as $field) {
            $value = Configuration::get($field);
            $fields_value[$field] = (strpos($value, ',') !== false ? explode(',', $value) : $value);
        }
        $helper->fields_value = $fields_value;

        return $helper->generateForm($fields_form);
    }

    public function getServerOptions()
    {
        $options = [];

        $countries = ['FR', 'UK', 'US', 'DE', 'AU'];
        foreach ($countries as $countryId) {
            for ($i = 1; $i < 5; ++$i) {
                $options[] = ['id_option' => $countryId . $i, 'name' => $countryId . $i];
            }
        }

        return $options;
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        if (!$this->checkCanConnectMyF()) {
            return;
        }

        $idProduct = isset($params['id_product']) ? $params['id_product'] : Tools::getValue('id_product');
        if ($idProduct) {
            $product = new Product((int) $idProduct, $this->_context->language->id);
            if ($product->hasAttributes() > 0) {
                $attributeIds = array_keys($this->getProductAttributeCombinations($product));
            } else {
                $attributeIds = [0];
            }

            $tpl = Context::getContext()->smarty->createTemplate(_PS_MODULE_DIR_ . 'boostmyshopagent/views/templates/hook/hookProductTab.tpl');
            $tpl->assign('id_product', $idProduct);

            try {
                MyfWs::initToken();
                $productIds = $this->getProductKey($idProduct, $attributeIds);
                $productIds = implode(',', $productIds);
                $productDetail = MyfWs::callWs('erpcloud/product/?externalIds=' . $productIds);
                $productDetail = json_decode($productDetail, true);
                if (!isset($productDetail)) {
                    return $this->_module->displayError('This product not found on myFulfillment.');
                }
                $tpl->assign('ws_data', $productDetail);
            } catch (\Exception $ex) {
                return $this->_module->displayError('Connection with MyFulfillment doesnt work. Please check configuration: ' . $ex->getMessage());
            }

            return $tpl->fetch();
        }
    }

    public function getProductAttributeCombinations($product)
    {
        $data = [];
        $combinations = $product->getAttributeCombinations($this->_context->language->id);
        foreach ($combinations as $combination) {
            $data[$combination['id_product_attribute']] = [
                'group_name' => $combination['group_name'],
                'attribute_name' => $combination['attribute_name'],
            ];
            $data[] = $combination['id_product_attribute'];
        }

        return $data;
    }

    public function hookDisplayAdminOrder($params)
    {
        if (!$this->checkCanConnectMyF()) {
            return;
        }
        $orderId = $params['id_order'];
        if ($orderId) {
            $tpl = Context::getContext()->smarty->createTemplate(_PS_MODULE_DIR_ . 'boostmyshopagent/views/templates/hook/hookOrderTab.tpl');
            $tpl->assign(['order_id' => $orderId]);

            try {
                MyfWs::initToken();
                $order = MyfWs::callWs('erpcloud/order/' . $orderId);
                $order = json_decode($order, true);
                if (count($order['products']) == 0 && count($order['shipments']) == 0) {
                    return $this->_module->displayError('This order not found in myFulfillment.');
                }
                $tpl->assign('products', $order['products']);
                $tpl->assign('shipments', $order['shipments']);
            } catch (\Exception $ex) {
                return $this->_module->displayError('Connection with MyFulfillment doesnt work. Please check configuration: ' . $ex->getMessage());
            }

            return $tpl->fetch();
        }
    }

    protected function getProductKey($productId, $attributeIds)
    {
        $ids = [];
        foreach ($attributeIds as $attributeId) {
            $ids[] = str_pad($productId, 6, '0', STR_PAD_LEFT) . '_' . str_pad($attributeId, 6, '0', STR_PAD_LEFT);
        }

        return $ids;
    }

    /*
     * Return duplicate reference as html
     */
    protected function getDuplicates()
    {
        $sql = '
            select
                reference,
                count(*) as  total,
                group_concat("Id product: ", id_product, " - Id attribute: ", id_product_attribute, "<br>" SEPARATOR " ") as products
            from (
                select reference, id_product, 0 as id_product_attribute from ' . _DB_PREFIX_ . 'product where reference is not null and reference <> "" and id_product not in (select distinct id_product from ' . _DB_PREFIX_ . 'product_attribute)
                UNION
                select reference, id_product, id_product_attribute from ' . _DB_PREFIX_ . 'product_attribute where reference is not null and reference <> ""
            ) as tbl
            group by
                reference
            having
                count(*) > 1

        ';
        $results = Db::getInstance()->executeS($sql);

        $tpl = Context::getContext()->smarty->createTemplate(_PS_MODULE_DIR_ . 'boostmyshopagent/views/templates/admin/myf/duplicates.tpl');
        $tpl->assign('results', $results);

        return $tpl->fetch();
    }
}
