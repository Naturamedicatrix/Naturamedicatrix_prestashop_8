<?php
/**
 * Class BoostMyShopAgentClassesData
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesData
{
    public function getActiveShops()
    {
        $shops = [];
        $shops[] = ['id' => 0, 'name' => 'All shops'];
        $enabledShops = Shop::getShops(true);
        foreach ($enabledShops as $enabledShop) {
            $shops[] = ['id' => (int) $enabledShop['id_shop'], 'name' => $enabledShop['name']];
        }

        return $shops;
    }

    public function getActiveCountries()
    {
        $countries = [];
        $countries[] = ['id' => 0, 'name' => 'All countries'];
        $enabledCountries = Country::getCountries((int) Configuration::get('PS_LANG_DEFAULT'), true);
        foreach ($enabledCountries as $enabledCountry) {
            $countries[] = [
                'id' => (int) $enabledCountry['id_country'],
                'iso_code' => $enabledCountry['iso_code'],
                'name' => $enabledCountry['name'],
            ];
        }

        return $countries;
    }

    public function getActiveCurrencies()
    {
        $currencies = [];
        $currencies[] = ['id' => 0, 'name' => 'All currencies'];
        $enabledCurrencies = Currency::getCurrencies($object = false, $active = 1);
        foreach ($enabledCurrencies as $enabledCurrency) {
            $currencies[] = [
                'id' => (int) $enabledCurrency['id_currency'],
                'iso_code' => $enabledCurrency['iso_code'],
                'sign' => $enabledCurrency['sign'],
                'name' => $enabledCurrency['name'],
            ];
        }

        return $currencies;
    }

    public function getAllActiveLanguages()
    {
        $languages = [];
        $enabledLanguages = Language::getLanguages(true);
        foreach ($enabledLanguages as $enabledLanguage) {
            $languages[] = [
                'id' => (int) $enabledLanguage['id_lang'],
                'name' => $enabledLanguage['name'],
                'iso_code' => $enabledLanguage['iso_code'],
            ];
        }

        return $languages;
    }

    public function getAllFeatures($idLang)
    {
        $features = [];
        $prestaFeatures = Feature::getFeatures($idLang);
        foreach ($prestaFeatures as $prestaFeature) {
            if ($prestaFeature['name'] == null) {
                continue;
            }
            $features[] = [
                'id' => (int) $prestaFeature['id_feature'],
                'name' => $prestaFeature['name'],
            ];
        }

        return $features;
    }

    public function getAllProductFields()
    {
        $fields = [];
        $sql = 'SHOW COLUMNS FROM ' . _DB_PREFIX_ . 'product';
        $productColumns = Db::getInstance()->executeS($sql);
        foreach ($productColumns as $productColumn) {
            $fields[] = [
                'id' => 'p.' . $productColumn['Field'],
                'name' => 'product.' . $productColumn['Field'],
            ];
        }

        return $fields;
    }
}
