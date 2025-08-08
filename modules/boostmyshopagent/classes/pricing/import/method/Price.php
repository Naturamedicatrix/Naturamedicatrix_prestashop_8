<?php
/**
 * Class BoostMyShopAgentClassesPricingImportMethodPrice
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesPricingImportMethodPrice extends BoostMyShopAgentClassesPricingImportMethodBase
{
    private $logger;
    private $logData = [];

    public function __construct()
    {
        $this->logger = new BoostMyShopAgentClassesLog();
    }

    public function importPrice($productId, $finalPrice, $configuration)
    {
        if ($this->isCombination($productId)) {
            $this->updateCombinationPrice($productId, $finalPrice);

            return;
        }

        $this->updatePrice($productId, $finalPrice);
    }

    private function updateCombinationPrice($productId, $finalPrice)
    {
        try {
            list($productId, $productAttributeId) = explode('_', $productId);

            $product = new Product($productId);
            $combinationPrice = $finalPrice - $product->price;
            $combination = new Combination($productAttributeId);
            $combination->price = $combinationPrice;

            $this->logData = [
                'id_product' => $productId,
                'id_product_attribute' => $productAttributeId,
                'final_price' => $finalPrice,
                'product_price' => $product->price,
                'combination_price' => $combinationPrice,
            ];

            $this->logger->info('Update combination price: ' . json_encode($this->logData));

            if (!$result = $combination->save()) {
                throw new \Exception('Update combination price : FAILED !');
            }
        } catch (\Exception $e) {
            $this->logger->error('Exception: ' . (string) $e);
        }
    }

    private function updatePrice($productId, $finalPrice)
    {
        $context = BoostMyShopAgentClassesFrontcontext::setContext();
        if (!Validate::isLoadedObject($product = new Product((int) $productId, false, null, null, $context))) {
            $this->logger->error('Product with ID: ' . $productId . ' does not exist');

            return;
        }

        try {
            $product->price = $finalPrice;

            $this->logData = [
                'id_product' => $productId,
                'final_price' => $finalPrice,
            ];

            if (!$result = $product->save()) {
                throw new \Exception('Update price : FAILED !');
            }

            $this->logger->info('Update product price: ' . json_encode($this->logData));
        } catch (\Exception $e) {
            $this->logger->error('Exception: ' . (string) $e);
        }
    }
}
