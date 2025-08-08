<?php
/**
 * 2007-2023 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
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
 * @copyright 2007-2023 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class Bmsmyp
{
    protected $_module;
    protected $_context;

    public function __construct($module, $context)
    {
        $this->_module = $module;
        $this->_context = $context;
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        $token = !empty(Configuration::get('PRICINGLABAGENT_ACCOUNT_TOKEN')) ?
            Configuration::get('PRICINGLABAGENT_ACCOUNT_TOKEN') :
            md5(time());
        Configuration::updateValue('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN', $token);
        Configuration::updateValue('BOOSTMYSHOPAGENT_ACCOUNT_EMAIL', Context::getContext()->employee->email);

        return true;
    }

    public function uninstall()
    {
        Configuration::deleteByName('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN');
        Configuration::deleteByName('BOOSTMYSHOPAGENT_ACCOUNT_EMAIL');

        return true;
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /*
         * If values have been submitted in the form, process.
         */
        if (((bool) Tools::isSubmit('submitBoostMyShopagentModule')) == true) {
            $this->postProcess();
        }

        $this->_context->smarty->assign('module_dir', $this->_module->getPathUri());

        return $this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = 'module';
        $helper->module = $this->_module;
        $helper->default_form_language = $this->_context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->_module->publicIdentifier;
        $helper->submit_action = 'submitBoostMyShopagentModule';
        $helper->currentIndex = $this->_context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->_module->name . '&tab_module=' . $this->_module->tab . '&module_name=' . $this->_module->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->_context->controller->getLanguages(),
            'id_language' => $this->_context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                    'title' => $this->_module->l('Import your catalog in Boostmyshop'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'name' => 'BOOSTMYSHOPAGENT_ACCOUNT_TOKEN',
                        'label' => $this->_module->l('Token'),
                    ],
                    [
                        'type' => 'html',
                        'label' => 'Product data url',
                        'name' => 'PRODUCT_DATA_URL',
                        'html_content' => '<a href="' . $this->getProductDataUrl() . '">' . $this->getProductDataUrl() . '</a>',
                    ],
                ],
            ],
        ];
    }

    protected function getProductDataUrl()
    {
        return Context::getContext()->shop->getBaseURL(true) . 'modules/boostmyshopagent/webservice/productData.php?token=' . Configuration::get('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN');
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return [
            'BOOSTMYSHOPAGENT_ACCOUNT_TOKEN' => Configuration::get('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN', null),
        ];
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }
}
