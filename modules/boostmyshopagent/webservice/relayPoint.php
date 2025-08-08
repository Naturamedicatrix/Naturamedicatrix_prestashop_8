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

$data = ['order_id' => '', 'relay_code' => '', 'error' => false, 'msg' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET params
        $apiKey = Tools::getValue('api_key');
        $orderId = Tools::getValue('order_id');

        if (!$apiKey || !$orderId) {
            http_response_code(403);
            throw new Exception('Order ID or api_key missing');
        }

        // check that API key exists
        $query = new DbQuery();
        $query->select('*');
        $query->from('webservice_account');
        $query->where('`key` = "' . pSQL($apiKey) . '"');
        $queryResult = Db::getInstance()->executeS($query);
        if (!isset($queryResult[0]) || $queryResult[0]['key'] != $apiKey) {
            throw new \Exception('Wrong API key');
        }

        $data['order_id'] = $orderId;
        $data['timestamp'] = time();
        $data['relay_code'] = '';
        $data['source'] = '';

        // Search point relay in Boxtal (envoiemoinscher) module
        $DBtable = 'emc_points';
        $query = new DbQuery();
        $query->select('point_ep');
        $query->from($DBtable);
        $query->where('ps_orders_id_order = ' . (int) $orderId);
        $queryResult = Db::getInstance()->executeS($query);
        if (isset($queryResult[0])) {
            $data['relay_code'] = $queryResult[0]['point_ep'] ? $queryResult[0]['point_ep'] : '';
            $data['source'] = 'envoiemoincher';
        }

        // search point relay in Boxtal module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('value');
            $query->from('bx_order_storage');
            $query->where('id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0]) && isset($queryResult[0]['value']) && $queryResult[0]['value']) {
                $object = unserialize($queryResult[0]['value']);
                if (isset($object->code) && $object->code) {
                    $data['relay_code'] = $object->code;
                    $data['source'] = 'boxtal';
                }
            }
        }

        // search point relais in common service / mondial relay module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('MR_Selected_Num');
            $query->from('mr_selected');
            $query->where('id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['MR_Selected_Num'] ? $queryResult[0]['MR_Selected_Num'] : '';
                $data['source'] = 'mondialrelay';
            }
        }

        // search point relais in mondial relay module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('selected_relay_num');
            $query->from('mondialrelay_selected_relay');
            $query->where('id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['selected_relay_num'] ? $queryResult[0]['selected_relay_num'] : '';
                $data['source'] = 'mondialrelay2';
            }
        }

        // search point relais in common service / colissimo module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('prid');
            $query->from('colissimo_delivery_info', 'cdi');
            $query->innerJoin('orders', 'o', 'o.id_cart = cdi.id_cart');
            $query->where('o.id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['prid'] ? $queryResult[0]['prid'] : '';
                $data['source'] = 'colissimo';
            }
        }

        // search point relais in bpost (bePost) module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('service_point_id');
            $query->from('cart_bpost', 'cb');
            $query->innerJoin('orders', 'o', 'o.id_cart = cb.id_cart');
            $query->where('o.id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['service_point_id'] ? $queryResult[0]['service_point_id'] : '';
                $data['source'] = 'bpost';
            }
        }

        // search point relais in socolissimo module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('prid');
            $query->from('socolissimo_delivery_info', 'scdi');
            $query->innerJoin('orders', 'o', 'o.id_cart = scdi.id_cart');
            $query->where('o.id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['prid'] ? $queryResult[0]['prid'] : '';
                $data['source'] = 'socolissimo';
            }
        }

        // search point relais in chronopost module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('id_pr');
            $query->from('chrono_cart_relais', 'scdi');
            $query->innerJoin('orders', 'o', 'o.id_cart = scdi.id_cart');
            $query->innerJoin('carrier', 'c', 'c.id_carrier = o.id_carrier');
            $query->where('o.id_order = ' . (int) $orderId);
            $query->where('c.external_module_name = "chronopost"');
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['id_pr'] ? $queryResult[0]['id_pr'] : '';
                $data['source'] = 'chronopost';
            }
        }

        // search point relais in DPD table
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('relay_id');
            $query->from('dpdfrance_shipping', 'cdi');
            $query->innerJoin('orders', 'o', 'o.id_cart = cdi.id_cart');
            $query->innerJoin('carrier', 'c', 'c.id_carrier = o.id_carrier');
            $query->where('o.id_order = ' . (int) $orderId);
            $query->where('c.external_module_name = "dpdfrance"');
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['relay_id'] ? $queryResult[0]['relay_id'] : '';
                $data['source'] = 'dpdfrance';
            }
        }

        // search point relais for module colissimo point relay by agencya
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('id_point_pickup');
            $query->from('colissimo_pickup', 'cp');
            $query->innerJoin('orders', 'o', 'o.id_cart = cp.id_cart');
            $query->where('o.id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['id_point_pickup'] ? $queryResult[0]['id_point_pickup'] : '';
                $data['source'] = 'socolissimo_agencya';
            }
        }

        // search point relais in UPS access point
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('ap_id');
            $query->from('ups_openorder', 'ups');
            $query->innerJoin('orders', 'o', 'o.id_order = ups.id_order');
            $query->innerJoin('carrier', 'c', 'c.id_carrier = o.id_carrier');
            $query->where('o.id_order = ' . (int) $orderId);
            $query->where('c.external_module_name = "upsmodule"');
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['ap_id'] ? $queryResult[0]['ap_id'] : '';
                $data['source'] = 'upsmodule';
            }
        }

        // search point relais in UPS access point (other module)
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('public_access_point_id');
            $query->from('ups_selected_service', 'ups');
            $query->innerJoin('orders', 'o', 'o.id_cart = ups.id_cart');
            $query->innerJoin('carrier', 'c', 'c.id_carrier = o.id_carrier');
            $query->where('o.id_order = ' . (int) $orderId);
            $query->where('c.external_module_name = "upsshipping"');
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['public_access_point_id'] ? $queryResult[0]['public_access_point_id'] : '';
                $data['source'] = 'upsshipping';
            }
        }

        // gls by nkmgls
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('parcel_shop_id');
            $query->from('gls_cart_carrier', 'gls');
            $query->innerJoin('orders', 'o', 'o.id_cart = gls.id_cart');
            $query->innerJoin('carrier', 'c', 'c.id_carrier = o.id_carrier');
            $query->where('o.id_order = ' . (int) $orderId);
            $query->where('c.external_module_name = "nkmgls"');
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['parcel_shop_id'] ? $queryResult[0]['parcel_shop_id'] : '';
                $data['source'] = 'gls';
            }
        }

        // lengow / veepee
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('extra');
            $query->from('lengow_orders');
            $query->where('id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $json = json_decode($queryResult[0]['extra'], true);
                if (isset($json['packages'][0]['cart'][0]['order_line_meta']['relay_id'])) {
                    $data['relay_code'] = $json['packages'][0]['cart'][0]['order_line_meta']['relay_id'];
                    $data['source'] = 'lengow';
                }
            }
        }

        // search point relais in relais colis module
        if (!$data['relay_code']) {
            $query = new DbQuery();
            $query->select('rel');
            $query->from('relaiscolis_info', 'cdi');
            $query->innerJoin('orders', 'o', 'o.id_cart = cdi.id_cart');
            $query->where('o.id_order = ' . (int) $orderId);
            $queryResult = Db::getInstance()->executeS($query);
            if (isset($queryResult[0])) {
                $data['relay_code'] = $queryResult[0]['rel'] ? $queryResult[0]['rel'] : '';
                $data['source'] = 'relaiscolis';    // source ?
            }
        }

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
