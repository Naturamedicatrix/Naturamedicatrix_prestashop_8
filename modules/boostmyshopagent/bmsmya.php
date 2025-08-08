<?php
/**
 * 2007-2017 PrestaShop
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

class Bmsmya
{
    protected $_module;
    protected $_context;

    public function __construct($module, $context)
    {
        $this->_module = $module;
        $this->_context = $context;
        $this->_module->fields = [
            'BMS_GSC_DISABLE',
            'BMS_GSC_INCLUDE_SCRIPT',
            'BMS_GSC_GAD_ID',
            'BMS_GSC_CONVERSION_TRACKING_ID',
            'BMS_GSC_CONVERSION_TRACKING_LABEL',
            'BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN',
        ];
    }

    protected function initDefaultConfigValues()
    {
        Configuration::updateValue('BMS_GSC_DISABLE', '1');
        Configuration::updateValue('BMS_GSC_INCLUDE_SCRIPT', '0');
        Configuration::updateValue('BMS_GSC_GAD_ID', 'AW-');
        Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_ID', 'AW-');
        Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_LABEL', '');
        Configuration::updateValue('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN', '');
    }

    public function install()
    {
        if (!$this->_module->registerHook('displayFooter')) {
            return false;
        }
        if (!$this->_module->registerHook('displayHeader')) {
            return false;
        }
        $this->initDefaultConfigValues();

        return true;
    }

    public function uninstall()
    {
        Configuration::deleteByName('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN');

        return true;
    }

    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submit' . $this->_module->name)) {
            $output = $this->save();
        }

        $this->_context->controller->addCSS($this->_module->getPathUri() . 'views/css/form.css');

        return $output . $this->displayForm();
    }

    protected function save()
    {
        Configuration::updateValue('BMS_GSC_DISABLE', Tools::getValue('BMS_GSC_DISABLE'));
        Configuration::updateValue('BMS_GSC_INCLUDE_SCRIPT', Tools::getValue('BMS_GSC_INCLUDE_SCRIPT'));
        Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_ID', Tools::getValue('BMS_GSC_CONVERSION_TRACKING_ID'));
        Configuration::updateValue('BMS_GSC_GAD_ID', Tools::getValue('BMS_GSC_GAD_ID'));
        Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_LABEL', Tools::getValue('BMS_GSC_CONVERSION_TRACKING_LABEL'));
        Configuration::updateValue('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN', Tools::getValue('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN'));

        return $this->_module->displayConfirmation($this->_module->l('Settings saved'));
    }

    protected function displayForm()
    {
        $fields_form = $this->getForm();
        $helper = new HelperForm();

        $helper->module = $this->_module;
        $helper->name_controller = $this->_module->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->_module->name;
        $helper->title = $this->_module->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->_module->name;

        $fields_value = [];
        $fields_value['BMS_GSC_DISABLE'] = Configuration::get('BMS_GSC_DISABLE');
        $fields_value['BMS_GSC_INCLUDE_SCRIPT'] = Configuration::get('BMS_GSC_INCLUDE_SCRIPT');
        $fields_value['BMS_GSC_GAD_ID'] = Configuration::get('BMS_GSC_GAD_ID');
        $fields_value['BMS_GSC_CONVERSION_TRACKING_LABEL'] = Configuration::get('BMS_GSC_CONVERSION_TRACKING_LABEL');
        $fields_value['BMS_GSC_CONVERSION_TRACKING_ID'] = Configuration::get('BMS_GSC_CONVERSION_TRACKING_ID');
        $fields_value['BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN'] = Configuration::get('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN');

        $helper->fields_value = $fields_value;

        return $helper->generateForm($fields_form);
    }

    protected function getForm()
    {
        $fields_form = [];

        $fields_form[]['form'] = [
            'legend' => [
                'title' => $this->_module->l('MyAds Gtag and conversion tracker settings'),
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'required' => false,
                    'label' => $this->_module->l('Disable'),
                    'name' => 'BMS_GSC_DISABLE',
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => '1',
                            'label' => $this->_module->l('Yes'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => '0',
                            'label' => $this->_module->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'switch',
                    'required' => false,
                    'label' => $this->_module->l('Include GTAG script'),
                    'name' => 'BMS_GSC_INCLUDE_SCRIPT',
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => '1',
                            'label' => $this->_module->l('Yes'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => '0',
                            'label' => $this->_module->l('No'),
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Google Ads ID'),
                    'name' => 'BMS_GSC_GAD_ID',
                ],
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Conversion tracking ID'),
                    'name' => 'BMS_GSC_CONVERSION_TRACKING_ID',
                ],
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Conversion tracking label'),
                    'name' => 'BMS_GSC_CONVERSION_TRACKING_LABEL',
                ],
                [
                    'type' => 'text',
                    'required' => false,
                    'label' => $this->_module->l('Website verification Token'),
                    'name' => 'BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN',
                ],
            ],
            'submit' => [
                'title' => $this->_module->l('Save'),
            ],
        ];

        return $fields_form;
    }

    public function hookDisplayHeader()
    {
        if (Configuration::get('BMS_GSC_DISABLE')) {
            return;
        }

        $verificationToken = Configuration::get('BMS_GSC_AGENT_SITE_VERIFICATION_TOKEN');
        if (empty($verificationToken)) {
            return;
        }

        return '<meta name="google-site-verification" content="' . $verificationToken . '" />';
    }

    public function hookDisplayFooter()
    {
        if (Configuration::get('BMS_GSC_DISABLE')) {
            return false;
        }

        $smarty = Context::getContext()->smarty;

        // default variables
        $smarty->assign([
            'disabled' => Configuration::get('BMS_GSC_DISABLE'),
            'gad_id' => Configuration::get('BMS_GSC_GAD_ID'),
            'tracking_id' => Configuration::get('BMS_GSC_CONVERSION_TRACKING_ID'),
            'tracking_label' => Configuration::get('BMS_GSC_CONVERSION_TRACKING_LABEL'),
            'include_google_tag' => false,
            'include_product_tag' => false,
            'include_conversion_tag' => false,
        ]);

        // google tag
        if (Configuration::get('BMS_GSC_INCLUDE_SCRIPT') && Configuration::get('BMS_GSC_GAD_ID')) {
            $smarty->assign([
                'include_google_tag' => Configuration::get('BMS_GSC_INCLUDE_SCRIPT'),
            ]);
        }

        // product tag
        $productId = Tools::getValue('id_product');
        if ($productId) {
            $product = new Product($productId);
            $price = Product::getPriceStatic($productId) ?: $product->price;
            $smarty->assign([
                'include_product_tag' => true,
                'ref' => $product->reference,
                'price' => $price,
            ]);
        }

        // conversion tag
        if (Tools::getValue('controller') == 'orderconfirmation') {
            $orderId = Tools::getValue('id_order');
            $order = new Order((int) $orderId);
            $currency = new Currency($order->id_currency);
            $smarty->assign([
                'include_conversion_tag' => true,
                'total_paid_excl_tax' => $order->total_paid_tax_excl,
                'currency' => $currency->iso_code,
                'transaction_id' => $order->reference,
            ]);
        }

        $smarty->display(dirname(__FILE__) . '/views/templates/admin/mya/footer.tpl');
    }
}
