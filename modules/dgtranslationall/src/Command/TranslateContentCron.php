<?php
/**
 * License limited to a single site, for use on another site please purchase a license for this module.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @author    Dingedi.com
 * @copyright Copyright 2023 © Dingedi All right reserved
 * @license   http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 * @category  Dingedi PrestaShop Modules
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class TranslateContentCron
{
    /**
     * @param string $from_lang
     * @param string $dest_lang
     * @param string $tables
     * @param string $overwrite
     * @param string $range
     * @param string $type
     */
    public static function translate($from_lang, $dest_lang, $tables, $overwrite, $range, $type)
    {
        $_POST['DG_TYPE'] = 'cron';

        $fromLangId = \Language::getIdByIso($from_lang);

        if (\Validate::isLoadedObject(new \Language($fromLangId)) === false) {
            throw new \Exception(sprintf('%s is not a valid iso code.', $from_lang));
        }

        if (!in_array($overwrite, ['on', 'off'])) {
            throw new \Exception('Overwrite must be set "on" or "off"');
        }

        $overwrite = $overwrite === "on";

        $module = \Module::getInstanceByName('dgtranslationall');

        if ($type === 'modules' && method_exists($module, 'initModules')) {
            $module->initModules(true);
        }

        $module->initContent(true);

        $destLang = $dest_lang;
        $langsToTranslate = [];

        if (strpos($destLang, ',') !== false) {
            $langsToTranslate = explode(',', $destLang);
        } else {
            $langsToTranslate[] = $destLang;
        }

        $tables = self::parseTables($tables, $type);

        $perRequest = \Dingedi\PsTranslationsApi\DgTranslationTools::getPerRequest() * 3;

        \Configuration::set('dingedi_per_request', $perRequest);

        $totalLanguages = count($langsToTranslate);
        $totalTables = count($tables);
        $totalGroups = $totalLanguages * $totalTables;
        $counter = 0;

        foreach ($langsToTranslate as $langDest) {
            $destLangId = \Language::getIdByIso($langDest);

            if (\Validate::isLoadedObject(new \Language($destLangId)) === false) {
                throw new \Exception(sprintf('%s is not a valid iso code.', $langDest));
            }


            foreach ($tables as $tableName => $fields) {
                $table = $module->getContentTable($tableName);

                $requests = max(1, ceil($table->getTotalItems() / $perRequest));

                $_POST['translation_data'] = array();

                if ($range !== 'off') {
                    $ids = explode(':', $range);

                    $_POST['translation_data']['plage_enabled'] = 'true';

                    $requests = max(1, ceil(($ids[1] - $ids[0]) / $perRequest));
                }

                if (is_array($fields)) {
                    $_POST['translation_data']['selected_fields'] = $fields;
                }

                $counter++;

                for ($i = 1; $i <= $requests; $i++) {
                    if ($range !== 'off') {
                        $startId = $ids[0] + ($i - 1) * $perRequest;
                        $endId = min($startId + $perRequest - 1, $ids[1]);

                        $_POST['translation_data']['start_id'] = $startId;
                        $_POST['translation_data']['end_id'] = $endId;
                    }

                    $module->translateContentTable($tableName, $fromLangId, $destLangId, 0, $overwrite, $range !== 'off' ? 0 : $i);

                    echo '(' . $counter . '/' . $totalGroups . ') ' . $from_lang . ' -> ' . $langDest . ': ' . $tableName . ' ' . round(($i / $requests) * 100, 2) . '%' . PHP_EOL;
                }
            }
        }
    }

    private static function parseTables($tables, $type)
    {
        if ($tables === "*") {
            return self::getAllTablesList($type);
        }

        $r = [];

        foreach (explode('|', $tables) as $table) {
            $e = explode(':', $table);

            if (isset($e[1])) {
                $r[$e[0]] = explode(',', $e[1]);
            } else {
                $r[$e[0]] = '';
            }
        }

        return $r;
    }

    /**
     * @return mixed[]
     */
    private static function getAllTablesList($type)
    {
        $tables = [];

        $module = \Module::getInstanceByName('dgtranslationall');

        if ($type === 'modules' && method_exists($module, 'getModulesTranslatableTablesList')) {
            $contentTablesGroups = $module->getModulesTranslatableTablesList();
        } else {
            $contentTablesGroups = $module->getContentTables();
        }

        foreach ($contentTablesGroups as $group) {
            foreach ($group['tables'] as $table) {
                $tables[$table->getTableName(false)] = '';
            }
        }

        return $tables;
    }

}
