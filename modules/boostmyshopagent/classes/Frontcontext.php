<?php
/**
 * Class BoostMyShopAgentClassesFrontcontext
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesFrontcontext
{
    /**
     * Important: as we are in a front controller context
     * we need to set a new empty cart to allow getPriceStatic method
     * to work correctly.
     *
     * In case of issue during the product save:
     *  - check if the Product class is overridden
     *  - check if the getPriceStatic method is used ( and if the context parameter is correctly set )
     */
    public static function setContext()
    {
        $context = Context::getContext();
        $context->cart = new Cart();

        return $context;
    }
}
