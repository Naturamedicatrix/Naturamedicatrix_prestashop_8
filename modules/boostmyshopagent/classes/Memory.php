<?php
/**
 * Class BoostMyShopAgentClassesMemory
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesMemory
{
    const SP_MEMORY_LIMIT = 2048; // Mo

    public static function setMemoryLimit()
    {
        set_time_limit(0);
        $phpIniValue = ini_get('memory_limit');
        $phpIniValue = self::convertToBytes($phpIniValue);

        if ($phpIniValue >= self::SP_MEMORY_LIMIT * 1024 * 1024) {
            return;
        }

        ini_set('memory_limit', self::SP_MEMORY_LIMIT . 'M');
    }

    private static function convertToBytes($size_str)
    {
        switch (Tools::substr($size_str, -1)) {
            case 'G':
            case 'g':
                return (int) $size_str * 1073741824;

            case 'M':
            case 'm':
                return (int) $size_str * 1048576;

            case 'K':
            case 'k':
                return (int) $size_str * 1024;

            default:
                return (int) $size_str;
        }
    }
}
