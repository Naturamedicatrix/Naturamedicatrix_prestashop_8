<?php
/**
 * Class BoostMyShopAgentClassesPricingImportMethodBase
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesPricingImportMethodBase
{
    public function isCombination($productId)
    {
        return strpos($productId, '_') > 0;
    }

    public function getProductPrice($productId, $productAttributeId = null)
    {
        $specificPriceOutPut = []; // prevent "cannot pass parameter 13 by reference"
        $context = BoostMyShopAgentClassesFrontcontext::setContext();

        return Product::getPriceStatic($productId, false, $productAttributeId, 6, null, false, false, 1, false, null, null, null, $specificPriceOutPut, true, false, $context);
    }
}
