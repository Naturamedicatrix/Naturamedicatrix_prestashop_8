<?php
/**
 * Class BoostMyShopAgent
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
require_once dirname(__FILE__) . '/../../config/config.inc.php';
require_once dirname(__FILE__) . '/classes/Autoloader.php';
new BoostMyShopAgentClassesAutoloader();

class BoostMyShopExportCatalog
{
    public function run()
    {
        $token = $this->getToken();
        $curlSession = curl_init("https://api.pricinglab.com/api/v2/connector/configuration?token=$token&connector=prestashop");
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($curlSession), true);

        $configuration = [
            'features' => isset($response['catalog']['features']) ? $response['catalog']['features'] : [],
            'product_fields' => isset($response['catalog']['product_fields']) ? $response['catalog']['product_fields'] : [],
            'id_lang' => isset($response['context']['id_lang']) ? $response['context']['id_lang'] : Configuration::get('PS_LANG_DEFAULT'),
        ];

        $catalog = new BoostMyShopAgentClassesCatalog();
        $catalog->generateCatalog($configuration);
    }

    private function getToken()
    {
        $query = new DbQuery();
        $query->select('value')
            ->from('configuration')
            ->where("name = 'BOOSTMYSHOPAGENT_ACCOUNT_TOKEN'");

        $result = Db::getInstance()->executeS($query);

        return isset($result[0]['value']) ? $result[0]['value'] : '';
    }
}

BoostMyShopAgentClassesMemory::setMemoryLimit();
$cron = new BoostMyShopExportCatalog();
$cron->run();
