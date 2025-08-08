<?php
/**
 * 2007-2023 boostmyshop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
include dirname(__FILE__) . '/../../../config/config.inc.php';
define('_PS_MODE_DEV_', true);

try {
    $token = Tools::getValue('token') ? Tools::getValue('token') : false;
    if (!$token || $token != Configuration::get('BOOSTMYSHOPAGENT_ACCOUNT_TOKEN')) {
        exit('Wrong token');
    }

    $shopId = Tools::getValue('shopId') ?: 1;

    $fields = [
        "IF(pa.id_product_attribute > 0, CONCAT(p.id_product, '_', pa.id_product_attribute), p.id_product) as seller_reference",
        'p.id_product as id_product',
        'pa.id_product_attribute as id_product_attribute',
        'IF(pa.reference, pa.reference, p.reference) as reference',
        'p.supplier_reference as supplier_reference',
        'IF(pa.ean13, pa.ean13, p.ean13) as ean',
        'IF(pa.upc, pa.upc, p.upc) as upc',
        'IF(pa.wholesale_price > 0, pa.wholesale_price, ps.wholesale_price) as wholesale_price',
        'IF(pa.price, p.price + pa.price, ps.price) as price',
        'p.ecotax as ecotax',
        't.rate as tax_rate',
    ];

    $sql = 'SELECT ' . implode(', ', $fields) . ' FROM ' . _DB_PREFIX_ . 'product p
        left join ' . _DB_PREFIX_ . 'product_shop ps on (ps.id_product = p.id_product)
        left join ' . _DB_PREFIX_ . 'product_attribute pa on (pa.id_product = p.id_product)
        left join ' . _DB_PREFIX_ . 'tax_rule tr on (tr.id_tax_rules_group = p.id_tax_rules_group)
        left join ' . _DB_PREFIX_ . 'tax t on (t.id_tax = tr.id_tax)
        where ps.id_shop = ' . $shopId . ' group by seller_reference';

    $collection = Db::getInstance()->executeS($sql);
    $header = current($collection);
    reset($collection);

    echo implode(';', array_keys($header)) . "\n";
    foreach ($collection as $item) {
        $line = [];
        foreach (array_keys($header) as $field) {
            $line[] = $item[$field];
        }
        echo implode(';', $line) . "\n";
    }

    exit;
} catch (Exception $e) {
    exit($e->getMessage());
}
