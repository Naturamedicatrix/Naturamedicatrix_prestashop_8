<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesCatalogincremental extends BoostMyShopAgentClassesCatalog
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
        $since = $configuration['since'];
        $date = date('Y-m-d H:i:s', strtotime($since));

        foreach ($this->getProducts($startId, $limit, $date) as $product) {
            $rows['products'][] = $this->addProduct($product);
        }
        $lastId = empty($rows['products']) ? $startId : $this->getLastId($rows['products']);
        $hasNext = $this->getHasNext($lastId, $date);
        $rows['headers'] = $this->getHeader($startId, $lastId, $limit, $hasNext, $since);

        return $rows;
    }

    private function checkParams($configuration)
    {
        foreach (['start', 'limit'] as $param) {
            if (!is_numeric($configuration[$param]) || $configuration[$param] < 0) {
                throw new \Exception("$param is not valid", 400);
            }
        }

        if (empty($configuration['since'])) {
            throw new \Exception("missing param 'since'", 400);
        }
    }

    private function getHeader($startId, $lastId, $limit, $hasNext, $since)
    {
        return [
            'time' => time(),
            'type' => 'catalog-incremental',
            'start' => $startId,
            'last' => $lastId,
            'limit' => $limit,
            'has_next' => $hasNext,
            'since' => $since,
        ];
    }

    private function getHasNext($lastId, $date)
    {
        return count($this->getProductCollectionSince($lastId, 1, $date)) > 0;
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

    protected function getProducts($start = 0, $limit = self::PRODUCT_COLLECTION_LIMIT, $date = null)
    {
        $collection = [];

        $products = $this->listProductsWithCombinationsSince($start, $limit, $date);
        foreach ($products as $product) {
            if (empty($product['id_product'])) {
                continue;
            }

            $collection[] = $product;
        }

        return $collection;
    }

    protected function listProductsWithCombinationsSince($start, $limit, $date)
    {
        $products = [];

        $res = $this->getProductCollectionSince($start, $limit, $date);
        foreach ($res as $product) {
            $combinations = $this->collectionClass->newInstanceArgs(['classname' => 'Combination']);
            $combinations->where('id_product', '=', $product['id_product']);
            foreach ($combinations as $combination) {
                $tmp = $product;

                foreach ((array) $combination as $field => $value) {
                    if (!is_array($value)) {
                        if ($field == 'ean13') {
                            $tmp['ean13'] = $value;
                        } else {
                            $tmp[$this->normalizeFeatureName($field)] = $value;
                        }
                    }
                }

                foreach ($combination->getAttributesName($this->configuration['id_lang']) as $infos) {
                    $attribute = new Attribute($infos['id_attribute']);
                    $attributeGroup = new AttributeGroup($attribute->id_attribute_group, $this->configuration['id_lang']);
                    $tmp[$this->normalizeFeatureName($attributeGroup->name)] = $infos['name'];
                }

                $combinationPrice = Combination::getPrice($combination->id);
                $tmp['price'] = $product['price'];
                if ($combinationPrice != 0) {
                    $tmp['price'] = $tmp['price'] + $combinationPrice;
                }
                $tmp['id_product'] = $product['id_product'] . '_' . $combination->id;
                $tmp['id_product_parent'] = $product['id_product'];

                if (!($tmp['wholesale_price'] > 0)) {
                    $tmp['wholesale_price'] = $product['wholesale_price'];
                }

                if (!($tmp['ecotax'] > 0)) {
                    $tmp['ecotax'] = $product['ecotax'];
                }

                $tmp['name'] = Product::getProductName($tmp['id_product'], $combination->id, $this->configuration['id_lang']);
                $tmp['name'] = ($combination->reference ? $combination->reference : $product['reference']) . ' ' . $tmp['name'];

                $tmp['weight'] = (string) $product['weight'] + $combination->weight;

                $tmp['cms_created_at'] = (new \DateTime($product['cms_created_at']))->format('c');
                $tmp['cms_updated_at'] = (new \DateTime($product['cms_updated_at']))->format('c');

                $products[] = $tmp;
            }

            if (count($combinations) == 0) {
                $product['name'] = $product['reference'] . ' ' . $product['name'];
                $product['cms_created_at'] = (new \DateTime($product['cms_created_at']))->format('c');
                $product['cms_updated_at'] = (new \DateTime($product['cms_updated_at']))->format('c');
                $products[] = $product;
            }
        }

        return $products;
    }

    protected function getProductCollectionSince($start, $limit, $date)
    {
        Shop::setContext(Shop::CONTEXT_ALL);
        $sql = 'SELECT ' . implode(', ', $this->getSelectForCollection()) . ' ';
        $sql .= 'FROM `' . _DB_PREFIX_ . 'product` p
				' . Shop::addSqlAssociation('product', 'p') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (p.`id_product` = pl.`id_product` ' . Shop::addSqlRestrictionOnLang('pl') . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				LEFT JOIN `' . _DB_PREFIX_ . 'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
				WHERE p.`id_product` > ' . (int) $start . ' AND pl.`id_lang` = ' . $this->configuration['id_lang'] .
            (!empty($date) ? ' AND p.`date_upd` > "' . $date . '"' : '') .
            ' ORDER BY p.id_product LIMIT ' . (int) $limit;

        $products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        foreach ($products as &$row) {
            $row = Product::getTaxesInformations($row);
        }

        return $products;
    }
}
