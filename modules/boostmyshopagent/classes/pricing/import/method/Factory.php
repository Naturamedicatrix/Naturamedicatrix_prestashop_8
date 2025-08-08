<?php
/**
 * Class BoostMyShopAgentClassesPricingImportFactory
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
require_once _PS_MODULE_DIR_ . 'boostmyshopagent/classes/Autoloader.php';
new BoostMyShopAgentClassesAutoloader();

class BoostMyShopAgentClassesPricingImportFactory
{
    public static function createImporter($channelConfiguration)
    {
        $method = isset($channelConfiguration['method']['value']) ? $channelConfiguration['method']['value'] : null;

        if (empty($method)) {
            return null;
        }

        if (strpos($method, 'specificprice') !== false) {
            $method = 'specificprice';
        }

        $className = 'BoostMyShopAgentClassesPricingImportMethod' . Tools::ucfirst($method);

        if (!class_exists($className)) {
            throw new Exception('Unsupported import method: ' . $method, 400);
        }

        return new $className();
    }
}
