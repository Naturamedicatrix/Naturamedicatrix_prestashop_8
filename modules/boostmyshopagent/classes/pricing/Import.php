<?php
/**
 * Class BoostMyShopAgentClassesPricingImport
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
require_once _PS_MODULE_DIR_ . 'boostmyshopagent/classes/pricing/import/method/Factory.php';

class BoostMyShopAgentClassesPricingImport
{
    private $configuration;

    public function __construct($configuration = [])
    {
        $this->configuration = $configuration;
    }

    public function run($pricingList)
    {
        foreach ($pricingList as $pricing) {
            if ($pricing['error'] === 'error' || $pricing['final_price'] == 0) {
                continue;
            }

            $channel = str_replace('_default', '', $pricing['channel']);
            $this->importPricing($pricing['product_id'], $channel, $pricing['final_price']);
        }
    }

    private function importPricing($productId, $channel, $finalPrice)
    {
        if (!isset($this->configuration[$channel])) {
            throw new \Exception('Missing configuration for channel: ' . $channel);
        }

        $importer = BoostMyShopAgentClassesPricingImportFactory::createImporter($this->configuration[$channel]);
        if ($importer) {
            $importer->importPrice($productId, $finalPrice, $this->configuration[$channel]);
        }
    }
}
