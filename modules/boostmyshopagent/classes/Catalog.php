<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesCatalog
{
    const PRODUCT_COLLECTION_LIMIT = 1000;
    const FILENAME = 'catalog.json';
    protected $collectionClass;
    protected $configuration;

    public function generateCatalog($configuration)
    {
        $catalogDir = _PS_DOWNLOAD_DIR_ . 'boostmyshopagent/';
        $this->createCatalogFilesDirectory($catalogDir);
        $fileName = $catalogDir . self::FILENAME;

        if ($configuration['use_cache'] === true && file_exists($fileName) && (time() - filemtime($fileName) < 86400)) {
            return $fileName;
        }

        $this->init($configuration);
        $this->setContext();
        $rows = [];
        $rows['header'] = $this->getHeader();

        foreach ($this->getProducts() as $product) {
            $rows['products'][] = $this->addProduct($product);
        }

        file_put_contents($fileName, json_encode($rows));

        return $fileName;
    }

    private function createCatalogFilesDirectory($catalogDir)
    {
        if (!is_dir(rtrim($catalogDir, '/'))) {
            mkdir(rtrim($catalogDir, '/'), 0777, true);
        }
    }

    protected function init($configuration)
    {
        $this->configuration = $configuration;

        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $this->collectionClass = new ReflectionClass('Collection');

            return;
        }
        $this->collectionClass = new ReflectionClass('PrestashopCollection');
    }

    protected function setContext()
    {
        $context = Context::getContext();
        $context->controller = new FrontController();
        $employee = new Employee();
        $context->employee = $employee->getByEmail(trim(Configuration::get('BOOSTMYSHOPAGENT_ACCOUNT_EMAIL')));
        $context->controller->controller_type = 'admin';
        $context->currency = $context->currency ? $context->currency : new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
    }

    private function getHeader()
    {
        return [
            'time' => time(),
            'type' => 'catalog',
        ];
    }

    protected function getProducts()
    {
        $collection = [];
        $start = 0;
        $limit = self::PRODUCT_COLLECTION_LIMIT;

        do {
            $products = $this->listProductsWithCombinations($start, $limit);
            foreach ($products as $product) {
                if (empty($product['id_product'])) {
                    continue;
                }

                $collection[] = $product;
                $start = (isset($product['id_product_parent']) ? $product['id_product_parent'] : $product['id_product']);
            }
        } while (count($products) > 0);

        return $collection;
    }

    protected function listProductsWithCombinations($start, $limit)
    {
        $products = [];

        $res = $this->getProductCollection($start, $limit);
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
                    $tmp['price'] = (float) $tmp['price'] + (float) $combinationPrice;
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

    protected function getProductCollection($start, $limit)
    {
        Shop::setContext(Shop::CONTEXT_ALL);
        $sql = 'SELECT ' . implode(', ', $this->getSelectForCollection()) . ' ';
        $sql .= 'FROM `' . _DB_PREFIX_ . 'product` p
				' . Shop::addSqlAssociation('product', 'p') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.`id_product` = p.`id_product` ' . Shop::addSqlRestrictionOnLang('pl') . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				LEFT JOIN `' . _DB_PREFIX_ . 'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
				WHERE p.`id_product` > ' . (int) $start . ' AND pl.`id_lang` = ' . $this->configuration['id_lang'] .
            ' ORDER BY p.id_product LIMIT ' . (int) $limit;

        $products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($products as &$row) {
            $row = Product::getTaxesInformations($row);
        }

        return $products;
    }

    protected function getSelectForCollection()
    {
        $requiredFields = [
            'p.id_product',
            'p.ean13',
            'p.upc',
            'p.reference',
            'p.weight',
            'p.quantity',
            'p.id_category_default',
            'p.price',
            'p.ecotax',
            'p.wholesale_price',
            'p.active',
            'p.id_manufacturer',
            'pl.name',
            'pl.description_short',
            'pl.link_rewrite',
            'm.`name` AS manufacturer_name',
            's.`name` AS supplier_name',
            'p.date_add AS cms_created_at',
            'p.date_upd AS cms_updated_at',
        ];

        return array_merge($requiredFields, $this->configuration['product_fields']);
    }

    protected function addProduct($product)
    {
        $product = $this->addStock($product);
        $product = $this->addImageUrl($product);
        $product = $this->addAttributes($product);
        $product = $this->addProductUrl($product);

        return $product;
    }

    private function addImageUrl($product)
    {
        $imageUrl = '';
        $image = Image::getCover($product['id_product']);
        if (is_array($image) && !empty($image)) {
            $link = new Link();
            $imageUrl = $link->getImageLink($product['link_rewrite'], $image['id_image']);
            list($protocol) = explode(':', _PS_BASE_URL_);
            $imageUrl = $protocol . '://' . $imageUrl;
        }
        $product['image_url'] = $imageUrl;

        return $product;
    }

    private function addProductUrl($product)
    {
        $context = Context::getContext();
        $linkRewrite = isset($product['link_rewrite']) ? $product['link_rewrite'] : '';
        $url = $context->link->getProductLink((int) $product['id_product'], $linkRewrite, $product['id_category_default'], $product['ean13']);
        $product['product_url'] = $url;

        return $product;
    }

    private function addStock($product)
    {
        $stock = [];
        if (strpos($product['id_product'], '_') !== false) {
            list($idProduct, $idProductAttribute) = explode('_', $product['id_product']);
        } else {
            $idProduct = $product['id_product'];
            $idProductAttribute = null;
        }

        $stock['qty'] = Product::getQuantity($idProduct, $idProductAttribute);

        $product['stock'] = $stock;

        return $product;
    }

    private function addAttributes($product)
    {
        foreach ($product as $attribute => $value) {
            if (empty($attribute)) {
                continue;
            }

            if (in_array($attribute, $this->getAttributesToExclude())) {
                unset($product[$attribute]);
                continue;
            }

            if (strpos($attribute, '___') === 0) {
                unset($product[$attribute]);
                continue;
            }

            if ($attribute == 'id_product') {
                // todo : line below commented as $attributes does not exist...
                // $attributes['sku'] = $value;
                continue;
            }

            if ($attribute === 'description_short') {
                $product['description'] = trim(strip_tags($product['description_short']));
                unset($product['description_short']);
            }
        }

        $product['special_price'] = $this->getSpecialPrice($product);
        $product['category'] = $this->getCategoryPath($product);

        $features = $this->getFeatures($product);
        if (!empty($features)) {
            $product['features'] = $features;
        }

        return $product;
    }

    private function getSpecialPrice($product)
    {
        if (!Validate::isUnsignedId($product['id_product'])) {
            list($idProduct, $idProductAttribute) = explode('_', $product['id_product']);
        } else {
            $idProduct = $product['id_product'];
            $idProductAttribute = null;
        }

        $special = [];
        $specialPrice = Product::getPriceStatic(
            $idProduct,
            false,
            $idProductAttribute,
            6,
            null,
            false,
            true,
            1,
            false,
            null,
            null,
            null,
            $special,
            false
        );

        if ($special !== false) {
            return $specialPrice;
        }

        return 0;
    }

    private function getFeatures($product)
    {
        $formattedFeatures = [];
        $sql = 'SELECT name, value, pf.id_feature
            FROM ' . _DB_PREFIX_ . 'feature_product pf
            LEFT JOIN ' . _DB_PREFIX_ . 'feature_lang fl ON
            (fl.id_feature = pf.id_feature AND fl.id_lang = ' . $this->configuration['id_lang'] . ')
            LEFT JOIN ' . _DB_PREFIX_ . 'feature_value_lang fvl
            ON (fvl.id_feature_value = pf.id_feature_value AND fvl.id_lang = ' . $this->configuration['id_lang'] . ')
            LEFT JOIN ' . _DB_PREFIX_ . 'feature f ON (f.id_feature = pf.id_feature AND fl.id_lang = ' . $this->configuration['id_lang'] . ')
            ' . Shop::addSqlAssociation('feature', 'f') . '
            WHERE pf.id_product = ' . (int) $product['id_product'];

        if (!empty($this->configuration['features'])) {
            $sql .= ' AND pf.id_feature IN (' . implode(',', $this->configuration['features']) . ')';
        }

        $features = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        foreach ($features as $feature) {
            $featureCode = $this->normalizeFeatureName($feature['name']);
            $formattedFeatures[$featureCode] = $feature['value'];
        }

        return $formattedFeatures;
    }

    protected function normalizeFeatureName($featureName)
    {
        $featureName = Tools::strtolower($featureName);
        $finalName = '';
        for ($i = 0; $i < Tools::strlen($featureName); ++$i) {
            if (ord($featureName[$i]) >= 97 && ord($featureName[$i]) <= 122) {
                $finalName .= $featureName[$i];
            } else {
                $finalName .= '_';
            }
        }

        return $finalName;
    }

    private function getCategoryPath($product)
    {
        $paths = [];
        $idCategory = $product['id_category_default'];

        do {
            $category = new Category($idCategory);
            array_unshift($paths, $category->getName());
            $idCategory = $category->id_parent;
        } while ($idCategory > 1);

        if (count($paths) == 0) {
            return 'unknown category';
        }

        return implode(' > ', $paths);
    }

    private function getAttributesToExclude()
    {
        return [
            'id_shop_list',
            'force_id',
            'default_on',
            'meta_description',
            'meta_title',
            'meta_keywords',
            'link_rewrite',
            'image',
        ];
    }
}
