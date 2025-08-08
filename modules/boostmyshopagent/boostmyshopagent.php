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

require_once _PS_MODULE_DIR_ . 'boostmyshopagent/bmsmyp.php';
require_once _PS_MODULE_DIR_ . 'boostmyshopagent/bmsmyf.php';
require_once _PS_MODULE_DIR_ . 'boostmyshopagent/bmsmya.php';

class Boostmyshopagent extends Module
{
    protected $bmsmyp;
    protected $bmsmyf;
    protected $bmsmya;
    public $fields;

    public $publicIdentifier;

    public function __construct()
    {
        $this->name = 'boostmyshopagent';
        $this->tab = 'smart_shopping';
        $this->version = '1.1.10';
        $this->author = 'BoostMyShop';
        $this->need_instance = 1;
        $this->module_key = 'f6086fffe0ed39f0e0b071b897168c1b';

        /*
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('BoostMyShop');
        $this->description = $this->l('Improve your online performances with our shopping ads optimizer, repricing, order & warehouse management softwares');

        $this->ps_versions_compliancy = ['min' => '1.5', 'max' => _PS_VERSION_];

        $context = $this->context;
        // $this->publicIdentifier = $this->identifier;  // dont know what it is....
        $this->bmsmyp = new Bmsmyp($this, $context);
        $this->bmsmya = new Bmsmya($this, $context);
        $this->bmsmyf = new Bmsmyf($this, $context);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        if (version_compare(_PS_VERSION_, '1.7') < 0) {
            $this->registerHook('displayBackOfficeHeader');
        }

        return parent::install()
            && $this->_installTab()
            && $this->bmsmyp->install()
            && $this->bmsmya->install()
            && $this->bmsmyf->install();
    }

    protected function _installTab()
    {
        $tab = new Tab();
        $tab->class_name = 'Boostmyshopagent';
        $tab->module = $this->name;
        $tab->id_parent = (int) Tab::getIdFromClassName('DEFAULT');
        $tab->icon = 'settings_applications';
        $languages = Language::getLanguages();
        foreach ($languages as $lang) {
            $tab->name[$lang['id_lang']] = 'Boostmyshop';
        }
        try {
            $tab->save();
        } catch (Exception $e) {
            echo $e->getMessage();

            return false;
        }

        return true;
    }

    protected function _uninstallTab()
    {
        $idTab = (int) Tab::getIdFromClassName('Boostmyshopagent');
        if ($idTab) {
            $tab = new Tab($idTab);
            try {
                $tab->delete();
            } catch (Exception $e) {
                echo $e->getMessage();

                return false;
            }
        }

        return true;
    }

    public function uninstall()
    {
        if (version_compare(_PS_VERSION_, '1.7') < 0) {
            $this->unregisterHook('displayBackOfficeHeader');
        }

        return parent::uninstall()
            && $this->_uninstallTab()
            && $this->bmsmyp->uninstall()
            && $this->bmsmya->uninstall()
            && $this->bmsmyf->uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        return $this->bmsmyp->getContent() .
        $this->bmsmya->getContent() .
        $this->bmsmyf->getContent();
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'hook') === false) {
            return null;
        }
        foreach ([$this, $this->bmsmyp, $this->bmsmyf, $this->bmsmya] as $module) {
            if (!method_exists($module, $name)) {
                continue;
            }
            $module->$name($arguments);
        }

        return null;
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addJS($this->getPathUri() . 'views/js/back.js');
        $this->context->controller->addCSS($this->getPathUri() . 'views/css/back.css');
    }

    public function hookDisplayAdminOrder($params)
    {
        return $this->bmsmyf->hookDisplayAdminOrder($params);
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        return $this->bmsmyf->hookDisplayAdminProductsExtra($params);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addJS($this->getPathUri() . '/views/js/front.js');
        $this->context->controller->addCSS($this->getPathUri() . '/views/css/front.css');

        return $this->bmsmya->hookDisplayHeader();
    }

    public function hookDisplayFooter()
    {
        return $this->bmsmya->hookDisplayFooter();
    }
}
