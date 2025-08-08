<?php
/**
 * 2007-2019 boostmyshop
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

$data = ['success' => true, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405);
        throw new Exception('HTTP method not allowed');
    }

    $apiKey = Tools::getValue('api_key');
    $id = Tools::getValue('id');
    $label = Tools::getValue('label');
    $gad_id = Tools::getValue('gad_id');

    if (!$apiKey || !$id || !$label) {
        http_response_code(403);
        throw new Exception('api_key, conversion id or conversion label missing');
    }

    if (empty($gad_id)) {
        http_response_code(403);
        throw new Exception('Google ads customer id missing');
    }

    // Prestashop API URL
    $apiUrl = $apiKey . '@' . Tools::getHttpHost(false) . __PS_BASE_URI__ . 'api/';

    // API curl call
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $apiUrl,
    ]);
    $apiResult = curl_exec($curl);

    if (!isset($apiResult)) {
        throw new Exception('Could not reach Prestashop API');
    }

    $xml = simplexml_load_string($apiResult);

    if (!empty($xml->errors[0])) {
        http_response_code(403);
        throw new Exception('Invalid API key');
    }

    if (Configuration::get('BMS_GSC_DISABLE')) {
        http_response_code(403);
        throw new Exception('Module disabled');
    }

    Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_ID', $id);
    Configuration::updateValue('BMS_GSC_CONVERSION_TRACKING_LABEL', $label);
    Configuration::updateValue('BMS_GSC_GAD_ID', $gad_id);
    $data['message'] = 'Conversion detail updated';
} catch (Exception $e) {
    $data['success'] = false;
    $data['message'] = $e->getMessage();
}

exit(json_encode($data));
