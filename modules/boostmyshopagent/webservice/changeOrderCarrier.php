<?php
/**
 * Class BoostMyShopAgentClassesCatalog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2023 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
include dirname(__FILE__) . '/../../../config/config.inc.php';

$data = ['order_id' => '', 'carrier_id' => '', 'error' => false, 'msg' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET params
        $apiKey = Tools::getValue('api_key');
        $orderId = Tools::getValue('order_id');
        $carrierId = Tools::getValue('carrier_id');

        if (!$apiKey || !$orderId || !$carrierId) {
            http_response_code(403);
            throw new Exception('Order ID, Carrier Id or API key missing');
        }

        $data['order_id'] = $orderId;
        $data['carrier_id'] = $carrierId;

        // check that API key exists
        $query = new DbQuery();
        $query->select('*');
        $query->from('webservice_account');
        $query->where('`key` = "' . pSQL($apiKey) . '"');
        $queryResult = Db::getInstance()->executeS($query);
        if (!isset($queryResult[0]) || $queryResult[0]['key'] != $apiKey) {
            throw new \Exception('Wrong API key');
        }

        $sql = DB::getInstance();
        $sql->update(
            'orders',
            ['id_carrier' => $carrierId],
            'id_order = ' . (int) $orderId
        );
        $sql->update(
            'order_carrier',
            ['id_carrier' => $carrierId],
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
