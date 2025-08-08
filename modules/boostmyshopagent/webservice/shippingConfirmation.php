<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2023 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
include dirname(__FILE__) . '/../../../config/config.inc.php';

$data = ['order_id' => '', 'tracking_number' => '', 'error' => false, 'msg' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET params
        $apiKey = Tools::getValue('api_key');
        $orderId = Tools::getValue('order_id');
        $trackingNumber = Tools::getValue('tracking_number');

        if (!$apiKey || !$orderId || !$orderId) {
            http_response_code(403);
            throw new Exception('Order ID, Tracking number or API key missing');
        }

        $data['order_id'] = $orderId;
        $data['tracking_number'] = $trackingNumber;

        // check that API key exists
        $query = new DbQuery();
        $query->select('*');
        $query->from('webservice_account');
        $query->where('`key` = "' . pSQL($apiKey) . '"');
        $queryResult = Db::getInstance()->executeS($query);
        if (!Tools::getIsset($queryResult[0]) || $queryResult[0]['key'] != $apiKey) {
            throw new \Exception('Wrong API key');
        }

        // Store tracking number in orders table
        $DBtable = 'orders';
        $sql = DB::getInstance();
        $sql->update(
            'orders',
            ['shipping_number' => $trackingNumber],
            'id_order = ' . (int) $orderId
        );

        http_response_code(200);
    } else {
        http_response_code(405);
        throw new Exception('HTTP method not allowed');
    }
} catch (Exception $e) {
    $data['error'] = true;
    $data['msg'] = $e->getMessage();
}

exit(json_encode($data));
