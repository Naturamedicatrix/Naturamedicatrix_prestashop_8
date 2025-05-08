<?php
/**
 * @author Presta-Module.com <support@presta-module.com>
 * @copyright Presta-Module
 * @license   see file: LICENSE.txt
 *
 *           ____     __  __
 *          |  _ \   |  \/  |
 *          | |_) |  | |\/| |
 *          |  __/   | |  | |
 *          |_|      |_|  |_|
 *
 ****/

if (!defined('_PS_VERSION_')) {
    exit;
}
class AdvancedTopMenuElementsClass extends ObjectModel
{
    public $id;
    public $link;
    public $name;
    public $id_column;
    public $id_category;
    public $id_cms;
    public $id_cms_category;
    public $id_supplier;
    public $id_manufacturer;
    public $id_specific_page;
    public $have_icon;
    public $image_type;
    public $image_legend;
    public $image_class;
    public $privacy;
    public $chosen_groups = '';
    public $type;
    public $id_column_depend;
    public $position = 0;
    public $active = 1;
    public $active_desktop = 1;
    public $active_mobile = 1;
    public $target;
    public $prevent_obfuscate = 0;
    protected $tables = [
        'pm_advancedtopmenu_elements',
        'pm_advancedtopmenu_elements_lang',
    ];
    protected $fieldsRequired = [
        'active',
        'id_column',
        'type',
    ];
    protected $fieldsSize = [
        'active' => 1,
    ];
    protected $fieldsValidate = [
        'active' => 'isBool',
    ];
    protected $fieldsSizeLang = [
        'name' => 256,
        'link' => 256,
        'image_legend' => 256,
    ];
    protected $fieldsValidateLang = [
        'name' => 'isCatalogName',
        'link' => 'isUrl',
        'have_icon' => 'isBool',
        'image_type' => 'isString',
        'image_legend' => 'isCatalogName',
        'image_class' => 'isString',
    ];
    protected $table = 'pm_advancedtopmenu_elements';
    protected $identifier = 'id_element';
    public static $definition = [
        'table' => 'pm_advancedtopmenu_elements',
        'primary' => 'id_element',
        'multishop' => false,
        'multilang_shop' => false,
        'multilang' => true,
        'fields' => [
            'name' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
            'link' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
            'have_icon' => [
                'type' => 3, 'lang' => true, 'required' => false,
            ],
            'image_type' => [
                'type' => 3, 'lang' => true, 'required' => false,
            ],
            'image_legend' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
            'image_class' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
        ],
    ];
    public function __construct($id_element = null, $id_lang = null)
    {
        parent::__construct($id_element, $id_lang);
        $this->chosen_groups = json_decode($this->chosen_groups);
    }
    public function getFields()
    {
        parent::validateFields();
        $fields = [];
        if (isset($this->id)) {
            $fields['id_element'] = (int)$this->id;
        }
        $fields['id_column'] = (int)$this->id_column;
        $fields['id_category'] = (int)$this->id_category;
        $fields['id_cms'] = (int)$this->id_cms;
        $fields['id_cms_category'] = (int)$this->id_cms_category;
        $fields['id_supplier'] = (int)$this->id_supplier;
        $fields['id_manufacturer'] = (int)$this->id_manufacturer;
        $fields['id_specific_page'] = pSQL($this->id_specific_page);
        $fields['type'] = (int)$this->type;
        $fields['active'] = (int)$this->active;
        $fields['active_desktop'] = (int)$this->active_desktop;
        $fields['active_mobile'] = (int)$this->active_mobile;
        $fields['position'] = (int)$this->position;
        $fields['privacy'] = (int)$this->privacy;
        $fields['chosen_groups'] = pSQL($this->chosen_groups);
        $fields['id_column_depend'] = (int)$this->id_column_depend;
        $fields['target'] = pSQL($this->target);
        $fields['prevent_obfuscate'] = (int)$this->prevent_obfuscate;
        return $fields;
    }
    public function getTranslationsFieldsChild()
    {
        parent::validateFieldsLang();
        $fieldsArray = [
            'name', 'link', 'have_icon', 'image_type', 'image_legend', 'image_class',
        ];
        $fields = [];
        $languages = Language::getLanguages(false);
        $defaultLanguage = Configuration::get('PS_LANG_DEFAULT');
        foreach ($languages as $language) {
            $fields[$language['id_lang']]['id_lang'] = $language['id_lang'];
            $fields[$language['id_lang']][$this->identifier] = (int)$this->id;
            foreach ($fieldsArray as $field) {
                if (!Validate::isTableOrIdentifier($field)) {
                    die(Tools::displayError());
                }
                if (isset($this->{$field}[$language['id_lang']]) and !empty($this->{$field}[$language['id_lang']])) {
                    $fields[$language['id_lang']][$field] = pSQL($this->{$field}[$language['id_lang']]);
                } elseif (in_array($field, $this->fieldsRequiredLang)) {
                    $fields[$language['id_lang']][$field] = pSQL($this->{$field}[$defaultLanguage]);
                } else {
                    $fields[$language['id_lang']][$field] = '';
                }
            }
        }
        return $fields;
    }
    public function delete()
    {
        $languages = Language::getLanguages(false);
        foreach ($languages as $language) {
            if (file_exists(_PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/element_icons/' . (int)$this->id . '-' . $language['iso_code'] . '.' . (isset($this->image_type[$language['id_lang']]) && !preg_match('/^i-(fa|mi)$/', $this->image_type[$language['id_lang']]) ? $this->image_type[$language['id_lang']] : 'jpg'))) {
                @unlink(_PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/element_icons/' . (int)$this->id . '-' . $language['iso_code'] . '.' . (isset($this->image_type[$language['id_lang']]) && !preg_match('/^i-(fa|mi)$/', $this->image_type[$language['id_lang']]) ? $this->image_type[$language['id_lang']] : 'jpg'));
            }
        }
        Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` WHERE `id_element`=' . (int)$this->id);
        Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang` WHERE `id_element`=' . (int)$this->id);
        return true;
    }
    public static function getMenuColumnElements($id_column, $id_lang, $active = true, $groupRestrict = false)
    {
        $sql_groups_join = '';
        $sql_groups_where = '';
        if ($groupRestrict && Group::isFeatureActive()) {
            $groups = PM_AdvancedTopMenu::getCustomerGroups();
            if (count($groups)) {
                $sql_groups_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'category_group` cg ON (cg.`id_category` = ca.`id_category`)';
                $sql_groups_where = 'AND IF (ate.`id_category` IS NULL OR ate.`id_category` = 0, 1, cg.`id_group` IN (' . implode(',', array_map('intval', $groups)) . '))';
            }
        }
        $sql = 'SELECT ate.*, atel.*,
        cl.link_rewrite, cl.meta_title,
        cal.link_rewrite as category_link_rewrite, cal.name as category_name,
        m.name as manufacturer_name,
        s.name as supplier_name
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` ate
                LEFT JOIN `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang` atel ON (ate.`id_element` = atel.`id_element` AND atel.`id_lang` = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'cms c ON (c.id_cms = ate.`id_cms`)
                ' . Shop::addSqlAssociation('cms', 'c', false) . '
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_lang cl ON (c.id_cms = cl.id_cms AND cl.id_lang = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_category cc ON (cc.id_cms_category = ate.`id_cms_category`)
                ' . Shop::addSqlAssociation('cms_category', 'cc', false) . '
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_category_lang ccl ON (cc.id_cms_category = ccl.id_cms_category AND ccl.id_lang = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'category ca ON (ca.id_category = ate.`id_category`)
                ' . $sql_groups_join . '
                LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cal ON (ca.id_category = cal.id_category AND cal.id_lang = ' . (int)$id_lang . Shop::addSqlRestrictionOnLang('cal') . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (ate.`id_manufacturer` = m.`id_manufacturer`)
                ' . Shop::addSqlAssociation('manufacturer', 'm', false) . '
                LEFT JOIN `' . _DB_PREFIX_ . 'supplier` s ON (ate.`id_supplier` = s.`id_supplier`)
                ' . Shop::addSqlAssociation('supplier', 's', false) . '
                WHERE ' . ($active ? ' ate.`active` = 1 AND (ate.`active_desktop` = 1 || ate.`active_mobile` = 1) AND' : '') . ' ate.`id_column` = ' . (int)$id_column . '
                ' . ($active ? 'AND ((ate.`id_manufacturer` = 0 AND ate.`id_supplier` = 0 AND ate.`id_category` = 0 AND ate.`id_cms` = 0 AND ate.`id_cms_category` = 0)
                OR c.id_cms IS NOT NULL OR cc.id_cms_category IS NOT NULL OR m.id_manufacturer IS NOT NULL OR ca.id_category IS NOT NULL OR s.`id_supplier` IS NOT NULL)' : '') . '
                AND (cms_shop.`id_shop` = ' . (int)Context::getContext()->shop->id . ' OR cms_shop.`id_shop` IS NULL) AND (manufacturer_shop.`id_shop` = ' . (int)Context::getContext()->shop->id . ' OR manufacturer_shop.`id_shop` IS NULL) AND (supplier_shop.`id_shop` = ' . (int)Context::getContext()->shop->id . ' OR supplier_shop.`id_shop` IS NULL)'
                . $sql_groups_where . '
                GROUP BY ate.`id_element`
                ORDER BY ate.`position`';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenuColumnsElements($menus, $id_lang, $active = true, $groupRestrict = false)
    {
        $elements = [];
        if (is_array($menus) && count($menus)) {
            foreach ($menus as $columns) {
                if (is_array($columns) && count($columns)) {
                    foreach ($columns as $column) {
                        $elements[$column['id_column']] = self::getMenuColumnElements($column['id_column'], $id_lang, $active, $groupRestrict);
                    }
                }
            }
        }
        return $elements;
    }
    public static function getElementIds($ids_column)
    {
        if (!is_array($ids_column)) {
            $ids_column = [(int)$ids_column];
        }
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
        SELECT `id_element`
        FROM ' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements
        WHERE `id_column` IN(' . implode(',', array_map('intval', $ids_column)) . ')');
        $elements = [];
        foreach ($result as $row) {
            $elements[] = $row['id_element'];
        }
        return $elements;
    }
    public static function getElementsFromIdCategory($idCategory)
    {
        $sql = 'SELECT atp.`id_element`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 3
        AND atp.`id_category` = ' . (int)$idCategory;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getElementsFromIdManufacturer($idManufacturer)
    {
        $sql = 'SELECT atp.`id_element`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 4
        AND atp.`id_manufacturer` = ' . (int)$idManufacturer;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getElementsFromIdCms($idCms)
    {
        $sql = 'SELECT atp.`id_element`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 1
        AND atp.`id_cms` = ' . (int)$idCms;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getElementsFromIdSupplier($idSupplier)
    {
        $sql = 'SELECT atp.`id_element`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 5
        AND atp.`id_supplier` = ' . (int)$idSupplier;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getElementsFromIdCmsCategory($idCmsCategory)
    {
        $sql = 'SELECT atp.`id_element`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 10
        AND atp.`id_cms_category` = ' . (int)$idCmsCategory;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function disableById($idElement)
    {
        return Db::getInstance()->update('pm_advancedtopmenu_elements', [
            'active' => 0,
        ], 'id_element = ' . (int)$idElement);
    }
    public static function getIdElementCategoryDepend($id_column, $id_category)
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT `id_element`
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements`
                WHERE `id_column_depend` = ' . (int)$id_column . ' AND `id_category` = ' . (int)$id_category);
    }
    public static function getIdElementCmsDepend($idColumn, $idCms)
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT `id_element`
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements`
                WHERE `id_column_depend` = ' . (int)$idColumn . ' AND `id_cms` = ' . (int)$idCms);
    }
    public static function getIdElementManufacturerDepend($id_column, $id_manufacturer)
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT `id_element`
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements`
                WHERE `id_column_depend` = ' . (int)$id_column . ' AND `id_manufacturer` = ' . (int)$id_manufacturer);
    }
    public static function getIdElementSupplierDepend($id_column, $id_supplier)
    {
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT `id_element`
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements`
                WHERE `id_column_depend` = ' . (int)$id_column . ' AND `id_supplier` = ' . (int)$id_supplier);
    }
}
