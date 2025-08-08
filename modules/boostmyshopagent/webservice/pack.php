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

$data = ['order_id' => '', 'product_id' => '', 'kit_content' => [], 'error' => false, 'msg' => ''];

try {
    // GET params
    $apiKey = Tools::getValue('api_key') ? Tools::getValue('api_key') : '';
    $orderId = Tools::getValue('order_id') ? Tools::getValue('order_id') : '';
    $productId = Tools::getValue('product_id') ? Tools::getValue('product_id') : '';

    if (!$apiKey || !$orderId || !$productId) {
        http_response_code(403);
        throw new Exception('Order ID or api_key or Product ID missing');
    }

    // check that API key exists
    $query = new DbQuery();
    $query->select('*');
    $query->from('webservice_account');
    $query->where('`key` = "' . $apiKey . '"');
    $queryResult = Db::getInstance()->executeS($query);
    if (!isset($queryResult[0]) || $queryResult[0]['key'] != $apiKey) {
        throw new \Exception('Wrong API key');
    }

    // load product
    $collection = Db::getInstance()->executeS('SELECT
                                                    *
                                              FROM
                                                    ' . _DB_PREFIX_ . 'pack
                                              WHERE
                                                    id_product_pack = ' . (int) $productId);

    $data['order_id'] = $orderId;
    $data['product_id'] = $productId;
    $data['kit_content'] = $collection;
} catch (Exception $e) {
    $data['error'] = true;
    $data['msg'] = $e->getMessage();
}

exit(json_encode($data));
