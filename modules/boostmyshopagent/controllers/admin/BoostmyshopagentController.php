<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostmyshopagentController extends ModuleAdminController
{
    public function __construct()
    {
        $this->display = 'Boostmyshop Configuration';
        $this->bootstrap = true;
        parent::__construct();
    }

    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign('configLink', $this->getConfigurationLink());
        $content = $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'boostmyshopagent/views/templates/admin/menu.tpl');
        $this->context->smarty->assign([
            'content' => $this->content . $content,
        ]);
    }

    public function getConfigurationLink()
    {
        return $this->context->link->getAdminLink('AdminModules') . '&configure=boostmyshopagent&module_name=boostmyshopagent';
    }
}
