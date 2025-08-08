<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesCatalogbatch extends BoostMyShopAgentClassesCatalog
{
    public function generateCatalog($configuration)
    {
        $this->checkParams($configuration);
        $this->init($configuration);
        $this->setContext();
        $rows = [];
        $rows['products'] = [];

        $startId = $configuration['start'];
        $limit = $configuration['limit'];

        foreach ($this->getProducts($startId, $limit) as $product) {
            $rows['products'][] = $this->addProduct($product);
        }
        $lastId = empty($rows['products']) ? $startId : $this->getLastId($rows['products']);
        $hasNext = $this->getHasNext($lastId);
        $rows['headers'] = $this->getHeader($startId, $lastId, $limit, $hasNext);

        return $rows;
    }

    private function checkParams($configuration)
    {
        foreach (['start', 'limit'] as $param) {
            if (!is_numeric($configuration[$param]) || $configuration[$param] < 0) {
                throw new \Exception("$param is not valid", 401);
            }
        }
    }

    private function getHeader($startId, $lastId, $limit, $hasNext)
    {
        return [
            'time' => time(),
            'type' => 'catalog-batch',
            'start' => $startId,
            'limit' => $limit,
            'last' => $lastId,
            'has_next' => $hasNext,
            'total' => $this->getProductsCount(),
        ];
    }

    private function getHasNext($lastId)
    {
        return count($this->getProductCollection($lastId, 1)) > 0;
    }

    private function getLastId($products)
    {
        $lastId = 0;
        if (($productsCount = count($products)) > 0) {
            $lastId = $products[$productsCount - 1]['id_product'];
        }
        if (($pos = strpos($lastId, '_')) !== false) {
            $lastId = Tools::substr($lastId, 0, $pos);
        }

        return $lastId;
    }

    protected function getProducts($start = 0, $limit = self::PRODUCT_COLLECTION_LIMIT)
    {
        $collection = [];

        $products = $this->listProductsWithCombinations($start, $limit);
        foreach ($products as $product) {
            if (empty($product['id_product'])) {
                continue;
            }

            $collection[] = $product;
        }

        return $collection;
    }

    private function getProductsCount()
    {
        $sql = 'select count(*) as total from ' . _DB_PREFIX_ . 'product p left join ' . _DB_PREFIX_ . 'product_attribute pa on p.id_product = pa.id_product';
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        return empty($result[0]['total']) ? 0 : $result[0]['total'];
    }
}
