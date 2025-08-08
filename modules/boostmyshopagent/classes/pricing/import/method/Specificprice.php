<?php
/**
 * Class BoostMyShopAgentClassesPricingImportMethodSpecificprice
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesPricingImportMethodSpecificprice extends BoostMyShopAgentClassesPricingImportMethodBase
{
    const DEFAULT_ID_GROUP = 0;
    const FROM_QUANTITY = 1;
    const DEFAULT_ID_CUSTOMER = 0;

    private $mode;
    private $shopId;
    private $countryId;
    private $currencyId;
    private $specificPrices = [];
    private $logger;
    private $logData = [];

    public function __construct()
    {
        $this->logger = new BoostMyShopAgentClassesLog();
    }

    public function importPrice($productId, $finalPrice, $configuration)
    {
        $this->mode = $this->getMode($configuration);
        $this->shopId = isset($configuration['shop']['value']) ? (int) $configuration['shop']['value'] : 0;
        $this->countryId = isset($configuration['country']['value']) ? (int) $configuration['country']['value'] : 0;
        $this->currencyId = isset($configuration['currency']['value']) ? (int) $configuration['currency']['value'] : 0;

        $productAttributeId = null;
        if ($this->isCombination($productId)) {
            list($productId, $productAttributeId) = explode('_', $productId);
        }

        $productPrice = $this->getProductPrice($productId, $productAttributeId);
        if (empty($productPrice)) {
            return false;
        }

        $this->logData = [
            'id_product' => $productId,
            'id_product_attribute' => $productAttributeId,
            'product_price' => $productPrice,
            'final_price' => $finalPrice,
        ];

        $this->addOrUpdateSpecificPrice($productId, $finalPrice, $productPrice, $productAttributeId);
    }

    private function getMode($configuration)
    {
        return str_replace('specificprice_', '', $configuration['method']['value']);
    }

    protected function addOrUpdateSpecificPrice($productId, $finalPrice, $productPrice, $productAttributeId = null)
    {
        $reduction = abs($productPrice - $finalPrice);
        if ($this->mode === 'percentage') {
            $reduction = $this->getReductionAsPercent($reduction, $productPrice);
            if ($reduction === null) {
                return false;
            }
        }

        $specificPrice = $this->getSpecificPrice($productId, $productAttributeId);
        $needToDeleteSpecificPrice = $finalPrice >= round($productPrice, 2);

        if (empty($specificPrice)) {
            if ($needToDeleteSpecificPrice) {
                return false;
            }
            $this->addSpecificPrice($productId, $reduction, $productAttributeId);
        } else {
            if ($needToDeleteSpecificPrice) {
                $specificPrice->delete();
            } else {
                $this->updateSpecificPrice($specificPrice, $reduction);
            }
        }
    }

    protected function getSpecificPrice($productId, $productAttributeId = null)
    {
        $key = $productId . '-' . $productAttributeId;
        if (isset($this->specificPrices[$key])) {
            return $this->specificPrices[$key];
        }

        $specificPrice = null;
        $existingSpecificPrice = $this->getSpecificPriceFromSql($productId, $productAttributeId);
        if (!empty($existingSpecificPrice[0]['id_specific_price'])) {
            $specificPrice = new SpecificPrice($existingSpecificPrice[0]['id_specific_price']);
        }

        $this->specificPrices[$key] = $specificPrice;

        return $this->specificPrices[$key];
    }

    private function getSpecificPriceFromSql($productId, $productAttributeId = null)
    {
        $query = new DbQuery();
        $query->select('*')
            ->from('specific_price')
            ->where(
                ' id_product = ' . (int) $productId .
                ' AND id_product_attribute = ' . (int) $productAttributeId .
                ' AND id_shop = ' . $this->shopId .
                ' AND id_currency = ' . $this->currencyId .
                ' AND id_country = ' . $this->countryId .
                ' AND id_cart = 0'
            );

        return Db::getInstance()->executeS($query);
    }

    protected function addSpecificPrice($productId, $reduction, $productAttributeId = null)
    {
        try {
            $specificPrice = new SpecificPrice();
            $specificPrice = $this->initSpecificPrice($specificPrice, $productId, $productAttributeId);
            $specificPrice = $this->setReduction($specificPrice, $reduction);

            $this->hydrateLogData($specificPrice);
            $this->logger->info('Add specific price: ' . json_encode($this->logData));

            if (!$result = $specificPrice->add()) {
                throw new Exception('Add specific price: FAILED !');
            }
        } catch (\Exception $e) {
            $this->logger->error('Exception: ' . (string) $e);
        }
    }

    protected function updateSpecificPrice($specificPrice, $reduction)
    {
        try {
            $specificPrice = $this->setReduction($specificPrice, $reduction);

            $this->hydrateLogData($specificPrice);
            $this->logger->info('Update specific price: ' . json_encode($this->logData));

            if (!$result = $specificPrice->update()) {
                throw new Exception('Update specific price: FAILED !');
            }
        } catch (\Exception $e) {
            $this->logger->error('Exception: ' . (string) $e);
        }
    }

    protected function initSpecificPrice($specificPrice, $productId, $productAttributeId = null)
    {
        $specificPrice->id_shop = $this->shopId;
        $specificPrice->id_shop_group = self::DEFAULT_ID_GROUP;
        $specificPrice->id_currency = $this->currencyId;
        $specificPrice->id_country = $this->countryId;
        $specificPrice->id_group = self::DEFAULT_ID_GROUP;
        $specificPrice->id_customer = self::DEFAULT_ID_CUSTOMER;

        $specificPrice->id_product = $productId;
        $specificPrice->id_product_attribute = 0;
        if (isset($productAttributeId)) {
            $specificPrice->id_product_attribute = $productAttributeId;
        }

        return $specificPrice;
    }

    protected function setReduction($specificPrice, $reduction)
    {
        $specificPrice->price = -1;
        $specificPrice->from_quantity = self::FROM_QUANTITY;
        $specificPrice->reduction = $reduction;
        $specificPrice->reduction_type = $this->mode;
        $specificPrice->reduction_tax = 0;
        $specificPrice->from = '0000-00-00 00:00:00';
        $specificPrice->to = '0000-00-00 00:00:00';

        return $specificPrice;
    }

    private function getReductionAsPercent($reduction, $productPrice)
    {
        $reductionAsPercent = round($reduction / $productPrice * 100, 2) / 100;
        if ($reductionAsPercent >= 1 || $reductionAsPercent < 0) {
            return null;
        }

        return $reductionAsPercent;
    }

    private function hydrateLogData($specificPrice)
    {
        $this->logData['specific_price'] = [
            'id_shop' => $specificPrice->id_shop,
            'id_country' => $specificPrice->id_country,
            'id_currency' => $specificPrice->id_currency,
            'reduction' => $specificPrice->reduction,
            'reduction_type' => $specificPrice->reduction_type,
        ];
    }
}
