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

class BoostMyShopCampaigns
{
    private $action;

    private $actions = [
        'is_installed',
    ];

    public function __construct()
    {
        BoostMyShopAgentClassesMemory::setMemoryLimit();

        if (!in_array(Tools::getValue('action'), $this->actions)) {
            throw new Exception('Invalid action', 400);
        }

        $this->action = Tools::getValue('action');
    }

    public function run()
    {
        $method = str_replace('_', '', lcfirst(ucwords($this->action, '_')));
        $this->$method();
    }

    private function isInstalled()
    {
        echo 'OK';
    }
}

try {
    $cronEntry = new BoostMyShopCampaigns();
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
