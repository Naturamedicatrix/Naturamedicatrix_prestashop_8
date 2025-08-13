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

class WkSubscriptionAdyen
{
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
            FROM `' . _DB_PREFIX_ . 'adyen_plan`
            WHERE `name` LIKE "' . pSQL($planName) . '"
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
                FROM `' . _DB_PREFIX_ . 'adyen_plan`
                WHERE `id_adyen_plan` = ' . (int) $idPlan . '
                '
            );

            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'DELETE
                FROM `' . _DB_PREFIX_ . 'adyen_subscription`
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
     * @return bool
     */
    public static function deactivatePlanProduct($idPlan)
    {
        if ($idPlan) {
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                'UPDATE
                `' . _DB_PREFIX_ . 'adyen_subscription`
                SET active = 0
                WHERE `plan_id` = ' . (int) $idPlan . '
                '
            );
        }

        return true;
    }

    public static function getAdyenSubscriptionDetails($idPlan, $idOrder, $idProduct)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'adyen_customer_subscription`
            WHERE `plan_id` = ' . (int) $idPlan . '
            AND `id_order` = ' . (int) $idOrder . '
            AND `id_product` = ' . (int) $idProduct . '
            '
        );
    }

    public function cancelAdyenSubscriptionById($customerSubscriptionId)
    {
        $success = 0;
        if ($customerSubscriptionId) {
            $objCustSubcription = new AdyenCustomerSubscription($customerSubscriptionId);
            if ($objCustSubcription->id_customer) {
                $settings = AdyenPaymentData::loadConfiguration();
                if ($settings['merchantAccount']) {
                    $client = AdyenPaymentData::createClient(); // initialize client
                    $recurringService = new Adyen\Service\Recurring($client); // initialize service
                    $shopperReference = $objCustSubcription->shopper_reference;
                    $recurringJson = '{
                                "recurring": {
                                    "contract": "RECURRING"
                                },
                                "merchantAccount": "' . $settings['merchantAccount'] . '",
                                "shopperReference": "' . $shopperReference . '"
                            }';

                    $recurringParams = json_decode($recurringJson, true);
                    $e = null;
                    try {
                        // Get shopper last card details of recurring data
                        $recurringResult = $recurringService->listRecurringDetails($recurringParams);
                        if ($recurringResult
                        && isset($recurringResult['details'][0]['RecurringDetail']['recurringDetailReference'])) {
                            $recurringResult1 = $recurringResult['details'][0]['RecurringDetail'];
                            $recurringDetailReference = $recurringResult1['recurringDetailReference'];

                            $json = '{
                                        "merchantAccount": "' . $settings['merchantAccount'] . '",
                                        "shopperReference": "' . $shopperReference . '",
                                        "recurringDetailReference": "' . $recurringDetailReference . '"
                                    }';

                            $params = json_decode($json, true);
                            $e = null;
                            try {
                                $result = $recurringService->disable($params);
                                if (isset($result['response'])
                                && $result['response'] == '[detail-successfully-disabled]') {
                                    // deactive from adyen customer subscription table
                                    $objCustSubcription->active = 0;
                                    $objCustSubcription->save();

                                    $success = 1;
                                }
                            } catch (Exception $e) {
                                AdyenCustomerSubscription::storedErrorTxt($e);
                            }
                        }
                    } catch (Exception $e) {
                        AdyenCustomerSubscription::storedErrorTxt($e);
                    }
                }
            }
        }

        return $success;
    }

    public function cancelAdyenSubscription($idCustomer, $subsData)
    {
        if ($idCustomer == $subsData['id_customer']) {
            $adyenSubscription = $this->getAdyenSubscriptionDetailsByIdCustomer(
                $idCustomer,
                $subsData['first_order_id'],
                $subsData['id_product']
            );

            if ($adyenSubscription) {
                return $this->cancelAdyenSubscriptionById($adyenSubscription['id']);
            }
        }

        return false;
    }

    public function getAdyenSubscriptionDetailsByIdCustomer($idCustomer, $idOrder, $idProduct)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT *
            FROM `' . _DB_PREFIX_ . 'adyen_customer_subscription`
            WHERE `id_customer` = ' . (int) $idCustomer . '
            AND `id_order` = ' . (int) $idOrder . '
            AND `id_product` = ' . (int) $idProduct . '
            '
        );
    }

    public function checkIfAdyenSubscriptionActive($customerSubscriptionId)
    {
        $success = 0;
        if ($customerSubscriptionId) {
            $objCustSubcription = new AdyenCustomerSubscription($customerSubscriptionId);
            if ($objCustSubcription->id_customer) {
                $settings = AdyenPaymentData::loadConfiguration();
                if ($settings['merchantAccount']) {
                    $client = AdyenPaymentData::createClient(); // initialize client
                    $recurringService = new Adyen\Service\Recurring($client); // initialize service
                    $shopperReference = $objCustSubcription->shopper_reference;
                    $recurringJson = '{
                                "recurring": {
                                    "contract": "RECURRING"
                                },
                                "merchantAccount": "' . $settings['merchantAccount'] . '",
                                "shopperReference": "' . $shopperReference . '"
                            }';

                    $recurringParams = json_decode($recurringJson, true);
                    $e = null;
                    try {
                        // Get shopper last card details of recurring data
                        $recurringResult = $recurringService->listRecurringDetails($recurringParams);
                        if ($recurringResult
                            && isset($recurringResult['details'][0]['RecurringDetail']['recurringDetailReference'])) {
                            $success = 1;
                        }
                    } catch (Exception $e) {
                        AdyenCustomerSubscription::storedErrorTxt($e);
                    }
                }
            }
        }

        return $success;
    }
}
