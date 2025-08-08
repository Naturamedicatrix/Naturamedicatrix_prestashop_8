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

class BoostMyShopAgent
{
    private $action;

    private $actions = [
        'export-catalog',
        'export-catalog-batch',
        'export-catalog-incremental',
        'import-pricing',
        'check-token',
        'get-pricing-info',
        'get-context-info',
        'get-catalog-info',
        'get-logs',
    ];

    public function __construct()
    {
        BoostMyShopAgentClassesMemory::setMemoryLimit();

        if (Tools::getValue('token') !== Configuration::get('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN')) {
            throw new Exception('Invalid token', 401);
        }

        if (!in_array(Tools::getValue('action'), $this->actions)) {
            throw new Exception('Invalid action', 400);
        }

        $this->action = Tools::getValue('action');
    }

    public function run()
    {
        $method = str_replace('-', '', lcfirst(ucwords($this->action, '-')));
        $this->$method();
    }

    private function checkToken()
    {
        echo 'OK';
    }

    private function getLogs()
    {
        $filename = 'logs.txt';
        header('Content-Type: text/html');
        header('Content-disposition: attachment; filename="' . basename($filename) . '"');
        readfile($filename);
    }

    private function exportCatalog()
    {
        $configuration = [
            'features' => Tools::getValue('features', []),
            'product_fields' => Tools::getValue('product_fields', []),
            'id_lang' => (int) Tools::getValue('id_lang', Configuration::get('PS_LANG_DEFAULT')),
            'use_cache' => (bool) Tools::getValue('use_cache', true),
        ];
        $catalog = new BoostMyShopAgentClassesCatalog();
        $filename = $catalog->generateCatalog($configuration);

        header('Content-Type: application/json');
        header('Content-disposition: attachment; filename="' . basename($filename) . '"');
        readfile($filename);
    }

    private function exportCatalogBatch()
    {
        $configuration = [
            'features' => Tools::getValue('features', []),
            'product_fields' => Tools::getValue('product_fields', []),
            'id_lang' => (int) Tools::getValue('id_lang', Configuration::get('PS_LANG_DEFAULT')),
            'start' => (int) Tools::getValue('start', 0),
            'limit' => (int) Tools::getValue('limit', 500),
        ];
        $catalog = new BoostMyShopAgentClassesCatalogbatch();
        $data = $catalog->generateCatalog($configuration);

        foreach ($data['headers'] as $headerName => $headerValue) {
            header("$headerName: $headerValue");
        }
        header('Content-Type: application/json');
        exit(json_encode($data));
    }

    private function exportCatalogIncremental()
    {
        $configuration = [
            'features' => Tools::getValue('features', []),
            'product_fields' => Tools::getValue('product_fields', []),
            'id_lang' => (int) Tools::getValue('id_lang', Configuration::get('PS_LANG_DEFAULT')),
            'start' => (int) Tools::getValue('start', 0),
            'limit' => (int) Tools::getValue('limit', 500),
            'since' => (string) Tools::getValue('since', 0),
        ];
        $catalog = new BoostMyShopAgentClassesCatalogincremental();
        $data = $catalog->generateCatalog($configuration);

        foreach ($data['headers'] as $headerName => $headerValue) {
            header("$headerName: $headerValue");
        }
        header('Content-Type: application/json');
        exit(json_encode($data));
    }

    private function importPricing()
    {
        $configuration = Tools::getValue('configuration', []);
        $pricing = Tools::getValue('pricing', []);

        $pricingImport = new BoostMyShopAgentClassesPricingImport($configuration);
        $pricingImport->run($pricing);
    }

    private function getPricingInfo()
    {
        $data = new BoostMyShopAgentClassesData();
        exit(json_encode([
            'shops' => $data->getActiveShops(),
            'countries' => $data->getActiveCountries(),
            'currencies' => $data->getActiveCurrencies(),
        ]));
    }

    private function getContextInfo()
    {
        $data = new BoostMyShopAgentClassesData();
        exit(json_encode([
            'languages' => $data->getAllActiveLanguages(),
        ]));
    }

    private function getCatalogInfo()
    {
        $idLang = Tools::getValue('languages', Configuration::get('PS_LANG_DEFAULT'));
        $data = new BoostMyShopAgentClassesData();
        exit(json_encode([
            'features' => $data->getAllFeatures($idLang),
            'product_fields' => $data->getAllProductFields(),
        ]));
    }
}

try {
    $cronEntry = new BoostMyShopAgent();
    $cronEntry->run();
} catch (\Exception $e) {
    $logger = new BoostMyShopAgentClassesLog();
    $logger->error((string) $e);

    switch ($e->getCode()) {
        case 401:
            header('HTTP/1.0 401 Unauthorized');
            break;
        case 400:
            header('HTTP/1.0 400 Bad Request');
            break;
    }
    exit(json_encode(['error' => (string) $e]));
}
