<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.txt
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to a newer
 * versions in the future. If you wish to customize this module for your needs
 * please refer to CustomizationPolicy.txt file inside our module for more information.
 *
 * @author Webkul IN
 * @copyright Since 2010 Webkul
 * @license https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(_PS_MODULE_DIR_ . 'wkauthorizepayment/libs/vendor/autoload.php')) {
    include_once _PS_MODULE_DIR_ . 'wkauthorizepayment/libs/vendor/autoload.php';
}

class WkSubscriptionAuthorize
{
    public static function createPlanAndAssignProduct($params, $frequency)
    {
        $idCart = (int) $params['id_cart'];
        $cart = new Cart((int) $idCart);
        $planName = [];
        $planNameTxt = 'PLAN_' . $idCart . '_' . $frequency['frequency'] . '_' . $frequency['cycle'];
        foreach (Language::getLanguages(false) as $lang) {
            $planName[$lang['id_lang']] = $planNameTxt;
        }

        $subsFreq = 'months';
        $frequencyInterval = $frequency['cycle'];
        $cycle = 0;
        if ($frequency['frequency'] == 'daily') {
            $subsFreq = 'days';
        } elseif ($frequency['frequency'] == 'weekly') {
            $subsFreq = 'weeks';
        } elseif ($frequency['frequency'] == 'monthly') {
            $subsFreq = 'months';
        } elseif ($frequency['frequency'] == 'yearly') {
            $subsFreq = 'years';
        }

        $subscriptionPlan = new WkAuthorizePlan();
        $subscriptionPlan->name = $planName;
        $subscriptionPlan->unit = $subsFreq;
        $subscriptionPlan->measurement = $frequencyInterval;
        $subscriptionPlan->occurrences = $cycle;
        $subscriptionPlan->active = 1;
        if ($subscriptionPlan->save()) {
            $objSubscription = new WkAuthorizeSubscriptionProduct();
            $objSubscription->id_wk_authorize_plan = $subscriptionPlan->id;
            $objSubscription->id_product = $params['products']['0']['id_product'];
            $objSubscription->attribute_id = $params['products']['0']['id_product_attribute'];
            $objSubscription->active = 1;
            $objSubscription->save();

            return $subscriptionPlan->id;
        }

        return false;
    }

    /**
     * deleteTempCartProduct
     *
     * @param mixed $idCart
     * @param mixed $idProduct
     * @param mixed $idProductAttr
     *
     * @return void
     */
    public static function deleteTempCartProduct($idCart, $idProduct, $idProductAttr = 0)
    {
        $objProdCart = new WkAuthorizeSubscriptionProductCart();
        $tempData = $objProdCart->getByIdProductByIdCart($idProduct, $idProductAttr, $idCart, true);
        if ($tempData && $tempData['id_wk_authorize_subscription_product_cart']) {
            $id = (int) $tempData['id_wk_authorize_subscription_product_cart'];
            $objProdCart = new WkAuthorizeSubscriptionProductCart($id);
            $objProdCart->delete();
        }

        return true;
    }

    /**
     * Deactivate Authorize plan product
     *
     * @param int $idPlan
     *
     * @return array
     */
    public static function deactivateProduct($idPlan)
    {
        $objProdCart = new WkAuthorizeSubscriptionProduct();
        $prodData = $objProdCart->getAssignedProductsByIdPlan($idPlan);
        if ($prodData && $prodData[0]['id_wk_authorize_subscription_product']) {
            $id = (int) $prodData[0]['id_wk_authorize_subscription_product'];
            $objProd = new WkAuthorizeSubscriptionProduct($id);
            $objProd->active = 0;
            $objProd->save();
        }

        return true;
    }

    /**
     * Get Authorized subscription details by cart
     *
     * @param int $idOrder
     * @param int $idProduct
     * @param int $idProductAttr
     *
     * @return array
     */
    public static function getSubscriptionDetailsByOrderId($idOrder, $idProduct, $idProductAttr = 0)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT `authorize_subscription_id`, `id_wk_authorize_plan`
            FROM `' . _DB_PREFIX_ . 'wk_authorize_subscription`
            WHERE `id_order` = ' . (int) $idOrder . '
                AND `id_product` = ' . (int) $idProduct . '
                AND `id_product_attribute` = ' . (int) $idProductAttr . '
            '
        );
    }

    public static function deleteOldCartPlans($idCart, $idPlan)
    {
        $string = 'PLAN_' . $idCart;
        $sql = 'SELECT wk_authorize_plan_shop.`id_wk_authorize_plan` FROM `' . _DB_PREFIX_ . 'wk_authorize_plan` splan ' .
                Shop::addSqlAssociation('wk_authorize_plan', 'splan');
        $sql .= ' LEFT JOIN `' . _DB_PREFIX_ . 'wk_authorize_plan_lang` wkplanlang
        ON (splan.`id_wk_authorize_plan` = wkplanlang.`id_wk_authorize_plan`) WHERE 1 = 1 ';
        $sql .= Shop::addSqlRestrictionOnLang('wkplanlang');
        $sql .= ' AND wk_authorize_plan_shop.`active` = 1 AND wkplanlang.`name` LIKE "' . pSQL($string) . '%"';
        $sql .= ' AND wk_authorize_plan_shop.`id_wk_authorize_plan` != ' . (int) $idPlan;
        $sql .= ' GROUP BY splan.`id_wk_authorize_plan`';
        $result = Db::getInstance()->executeS($sql);
        if ($result) {
            foreach ($result as $value) {
                $objPlan = new WkAuthorizePlan($value['id_wk_authorize_plan']);
                if (Validate::isLoadedObject($objPlan)) {
                    $objPlan->delete();
                }
            }
        }
    }

    public function cancelSubscription($idAuthSubscription)
    {
        if (!$idAuthSubscription) {
            return false;
        }
        $response = WkAuthorizePaymentHelper::cancelSubscription($idAuthSubscription);
        if ($response && $response['success']) {
            $idSubscription = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
                'SELECT `id_wk_authorize_subscription`
                FROM `' . _DB_PREFIX_ . 'wk_authorize_subscription`
                WHERE `authorize_subscription_id` = ' . $idAuthSubscription
            );
            if ($idSubscription) {
                $objSubscription = new WkAuthorizeSubscription((int) $idSubscription);
                if (Validate::isLoadedObject($objSubscription)) {
                    $objSubscription->is_subscription_cancel = 1;
                    $objSubscription->status = WkAuthorizePaymentHelper::WK_AUTHORIZE_NET_SUBSCRIPTION_CANCELLED;

                    return $objSubscription->save();
                }
            }
        }

        return false;
    }

    public static function getSubscriptionByAuthId($idAuthSubscription)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            'SELECT `id_wk_subscription_subscriber_products`
            FROM `' . _DB_PREFIX_ . 'wk_subscription_subscriber_products`
            WHERE `payment_response` = \'' . pSQL($idAuthSubscription) . '\'
            AND `active` = 1'
        );
    }

    public function getSubscriptionDetailsAPI($idAuthSubscription)
    {
        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(Configuration::get('WK_AUTHORIZE_NET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(Configuration::get('WK_AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();

        $request = new AnetAPI\ARBGetSubscriptionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setSubscriptionId($idAuthSubscription);

        $controller = new AnetController\ARBGetSubscriptionController($request);
        $response = false;
        if (Configuration::get('WK_AUTHORIZE_NET_MODE') == 1) {
            $response = $controller->executeWithApiResponse(net\authorize\api\constants\ANetEnvironment::SANDBOX);
        } elseif (Configuration::get('WK_AUTHORIZE_NET_MODE') == 2) {
            $response = $controller->executeWithApiResponse(net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }

        if (($response != null) && ($response->getMessages()->getResultCode() == 'Ok')) {
            return ['success' => 1, 'data' => $response->getSubscription()];
        } else {
            $errorMessages = $response->getMessages()->getMessage();

            return ['success' => 0, 'msg' => $errorMessages[0]->getCode() . '  ' . $errorMessages[0]->getText()];
        }
    }

    public function checkSubscriptionStatus($idAuthSubscription)
    {
        $subscriptionDetails = $this->getSubscriptionDetailsAPI($idAuthSubscription);
        if ($subscriptionDetails && $subscriptionDetails['success']) {
            return strtolower($subscriptionDetails['data']->getStatus()) == 'active';
        }

        return false;
    }
}
