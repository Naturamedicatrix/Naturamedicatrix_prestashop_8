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

class WkSubscriptionWallet
{
    public static function pauseSubscription($subscriptionId, $noOfDays)
    {
        if ($subscriptionId && !empty($noOfDays) && Validate::isUnsignedInt($noOfDays)) {
            $subObj = new WkSubscriberProductModal($subscriptionId);
            if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE) {
                return false;
            }
            $currentDate = date('Y-m-d');
            $subObj->pause_up_to = date('Y-m-d', strtotime($currentDate . ' + ' . $noOfDays . ' days'));
            $subObj->no_of_pause_day = $noOfDays;
            $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE;
            if ($subObj->save()) {
                return true;
            }
        }

        return false;
    }

    public static function resumeSubscription($subscriptionId)
    {
        if ($subscriptionId) {
            $subObj = new WkSubscriberProductModal($subscriptionId);
            if ($subObj->active != WkSubscriberProductModal::WK_SUBS_STATUS_PAUSE) {
                return false;
            }
            $currentDate = date('Y-m-d');
            $pauseDate = date('Y-m-d', strtotime($subObj->pause_up_to . ' - ' . $subObj->no_of_pause_day . ' days'));
            $diff = strtotime($currentDate) - strtotime($pauseDate);
            $days = (int) abs(round($diff / 86400));
            $subObj->pause_up_to = date('Y-m-d', strtotime($pauseDate . ' + ' . $days . ' days'));
            $subObj->no_of_pause_day = $days;
            $subObj->active = WkSubscriberProductModal::WK_SUBS_STATUS_ACTIVE;
            if ($subObj->save()) {
                return true;
            }
        }

        return false;
    }
}
