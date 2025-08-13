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
$moduleManager = PrestaShop\PrestaShop\Core\Addon\Module\ModuleManagerBuilder::getInstance()->build();
// Stripe library file
if ($moduleManager->isEnabled('wkstripepayment')) {
    $objStripe = Module::getInstanceByName('wkstripepayment');
    if (version_compare($objStripe->version, '5.3.1', '>=')) {
        if (file_exists(_PS_MODULE_DIR_ . 'wkstripepayment/stripelibs/init.php')) {
            if (!$moduleManager->isEnabled('stripe_official') && !class_exists('Stripe\\Stripe')) {
                include_once _PS_MODULE_DIR_ . 'wkstripepayment/stripelibs/init.php';
            }
            include_once _PS_MODULE_DIR_ . 'wkstripepayment/classes/stripeclasses.php';
        }
    } elseif (file_exists(_PS_MODULE_DIR_ . 'wkstripepayment/libs/init.php')) {
        if (!$moduleManager->isEnabled('stripe_official') && !class_exists('Stripe\\Stripe')) {
            include_once _PS_MODULE_DIR_ . 'wkstripepayment/libs/init.php';
        }
        include_once _PS_MODULE_DIR_ . 'wkstripepayment/classes/stripeclasses.php';
    }
}

// Adyen library file
if ($moduleManager->isEnabled('psadyenpayment')) {
    if (file_exists(_PS_MODULE_DIR_ . 'psadyenpayment/libs/vendor/autoload.php')) {
        include_once _PS_MODULE_DIR_ . 'psadyenpayment/classes/AdyenClassIncluded.php';
        include_once _PS_MODULE_DIR_ . 'psadyenpayment/libs/vendor/autoload.php';
    }
}

// Wepay library file
if ($moduleManager->isEnabled('wkwepay')) {
    if (file_exists(_PS_MODULE_DIR_ . 'wkwepay/lib/wepay.php')) {
        if (file_exists(_PS_MODULE_DIR_ . 'wkwepay/classes/WepayClassIncluded.php')) {
            include_once _PS_MODULE_DIR_ . 'wkwepay/classes/WepayClassIncluded.php';
        } else {
            include_once _PS_MODULE_DIR_ . 'wkwepay/classes/wepayclassincluded.php';
        }
    }
}

// PayPal library file - PayPal recurring
if ($moduleManager->isEnabled('wkpaypalsubscription')) {
    if (file_exists(_PS_MODULE_DIR_ . 'wkpaypalsubscription/classes/WkPaypalRequiredClasses.php')) {
        include_once _PS_MODULE_DIR_ . 'wkpaypalsubscription/classes/WkPaypalRequiredClasses.php';
    }
}

include_once 'WkProductSubscriptionDb.php';
include_once 'WkProductSubscriptionModel.php';
include_once 'WkSubscriberModal.php';
include_once 'WkSubscriberProductModal.php';
include_once 'WkSubscriberOrderModel.php';
include_once 'WkSubscriberScheduleModel.php';
include_once 'WkSubscriptionCartProducts.php';
include_once 'WkProductSubscriptionGlobal.php';
include_once 'WkProductSubscriptionCache.php';
include_once 'WkSubscriptionStripe.php';
include_once 'WkSubscriptionAdyen.php';
include_once 'WkSubscriptionWepay.php';
include_once 'WkSubscriptionPayPal.php';
include_once 'WkSubscriptionWallet.php';
