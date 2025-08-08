<?php
/**
 * Class BoostMyShopAgentClassesAutoloader
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesAutoloader
{
    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    /**
     * Autoload method
     *
     * @param string $class
     */
    public function autoload($class)
    {
        if (preg_match('#^BoostMyShopAgentClasses#', $class)) {
            $filename = _PS_MODULE_DIR_ . 'boostmyshopagent/';

            $class = str_replace('BoostMyShopAgent', '', $class);
            $tab = explode('_', preg_replace('/(?<!^)([A-Z])/', '_\\1', $class));
            for ($i = 0; $i < count($tab) - 1; ++$i) {
                $filename .= Tools::strtolower($tab[$i]) . '/';
            }
            $filename .= $tab[count($tab) - 1] . '.php';

            if (file_exists($filename)) {
                require_once $filename;

                return;
            }
        }
    }
}
