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
if (!defined('_PS_VERSION_')) {
    exit;
}

class WkSubscriptionWepay
{
    public $errors = [];

    /**
     * checkIfPlanExists
     *
     * @param mixed $planName
     *
     * @return array|false
     */
    public static function checkIfPlanExists($planName)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'wk_wepay_subscription_plan`
            WHERE `short_description` LIKE "' . pSQL($planName) . '"
            '
        );
    }

    /**
     * deletePlanProduct
     *
     * @param mixed $idPlan
     *
     * @return bool
     */
    public static function deletePlanProduct($idPlan)
    {
        if ($idPlan) {
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'DELETE
                FROM `' . _DB_PREFIX_ . 'wk_wepay_subscription_plan`
                WHERE `id_wk_wepay_subscription_plan` = ' . (int) $idPlan . '
                '
            );

            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'DELETE
                FROM `' . _DB_PREFIX_ . 'wk_wepay_customer_subscription_plan`
                WHERE `plan_id` = ' . (int) $idPlan . '
                '
            );
        }

        return true;
    }

    /**
     * deactivatePlanProduct
     *
     * @param mixed $idPlan
     *
     * @return void
     */
    public static function deactivatePlanProduct($idPlan)
    {
        if ($idPlan) {
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'UPDATE
                `' . _DB_PREFIX_ . 'wk_wepay_assign_subscription_plan`
                SET active = 0
                WHERE `plan_id` = ' . (int) $idPlan . '
                '
            );
        }

        return true;
    }

    /**
     * getWepaySubscriptionDetails
     *
     * @param mixed $idPlan
     * @param mixed $idCart
     * @param mixed $idProduct
     *
     * @return array
     */
    public static function getWepaySubscriptionDetails($idPlan, $idCart, $idProduct)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'wk_wepay_customer_subscription_plan`
            WHERE `plan_id` = ' . (int) $idPlan . '
            AND `id_cart` = ' . (int) $idCart . '
            AND `id_product` = ' . (int) $idProduct . '
            '
        );
    }

    /**
     * cancelWepaySubscription
     *
     * @param mixed $id_customer
     * @param mixed $customerSubscriptionId
     *
     * @return int
     */
    public function cancelWepaySubscription($id_customer, $customerSubscriptionId)
    {
        if (!class_exists('WePay')) {
            include_once _PS_MODULE_DIR_ . 'wkwepay/lib/wepay.php';
        }
        $success = 0;
        $objCustSubcription = new WepayCustomerSubscriptionPlan($customerSubscriptionId);
        if ($objCustSubcription->id_customer == $id_customer) {
            $mode = Configuration::get('WK_WEPAY_MODE');
            $client_id = Configuration::get('WK_WEPAY_CLIENT_ID');
            $client_secret = Configuration::get('WK_WEPAY_CLIENT_SECRET');
            $access_token = Configuration::get('WK_WEPAY_ACCESS_TOKEN');

            try {
                if ($mode == 1) { // test mode
                    Wepay::useStaging($client_id, $client_secret);
                } else { // live mode
                    Wepay::useProduction($client_id, $client_secret);
                }
                $wepay = new WePay($access_token);
                $response = $wepay->request('preapproval', [
                    'preapproval_id' => $objCustSubcription->preapproval_id,
                ]);
                if ($response->state == 'approved') {
                    $res = $wepay->request('preapproval/cancel', [
                        'preapproval_id' => $objCustSubcription->preapproval_id,
                    ]);
                    if ($res->state == 'cancelled') {
                        $objCustSubcription->is_plan_cancel = 1;
                        $objCustSubcription->save();
                        $success = 1;
                    }
                }
            } catch (Exception $e) {
                $this->errors[] = Tools::displayError($e->getMessage());
            }
        }

        return $success;
    }

    /**
     * getWepaySubscriptionDetailsByIdCustomer
     *
     * @param mixed $idCustomer
     * @param mixed $idOrder
     * @param mixed $idProduct
     *
     * @return array|false|null
     */
    public function getWepaySubscriptionDetailsByIdCustomer($idCustomer, $idOrder, $idProduct)
    {
        $idCart = (int) Order::getCartIdStatic((int) $idOrder);

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'wk_wepay_customer_subscription_plan`
            WHERE `id_customer` = ' . (int) $idCustomer . '
            AND `id_cart` = ' . (int) $idCart . '
            AND `id_product` = ' . (int) $idProduct . '
            '
        );
    }
}
