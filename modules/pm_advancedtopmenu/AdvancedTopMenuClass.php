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
class AdvancedTopMenuClass extends ObjectModel
{
    public $id;
    public $id_category;
    public $id_cms;
    public $id_cms_category;
    public $id_supplier;
    public $id_manufacturer;
    public $id_specific_page;
    public $id_shop;
    public $name;
    public $link;
    public $active = 1;
    public $active_desktop = 1;
    public $active_mobile = 1;
    public $type;
    public $privacy;
    public $chosen_groups = '';
    public $have_icon;
    public $image_type;
    public $image_legend;
    public $image_class;
    public $value_over;
    public $value_under;
    public $target;
    public $txt_color_menu_tab;
    public $txt_color_menu_tab_hover;
    public $fnd_color_menu_tab;
    public $fnd_color_menu_tab_over;
    public $width_submenu;
    public $minheight_submenu;
    public $position_submenu;
    public $fnd_color_submenu;
    public $border_color_submenu;
    public $border_color_tab;
    public $border_size_tab;
    public $border_size_submenu;
    protected $tables = [
        'pm_advancedtopmenu',
        'pm_advancedtopmenu_lang',
    ];
    protected $fieldsRequired = [
        'active',
        'type',
    ];
    protected $fieldsSize = [
        'active' => 1,
    ];
    protected $fieldsValidate = [
        'active' => 'isBool',
    ];
    protected $fieldsRequiredLang = [];
    protected $fieldsSizeLang = [
        'name' => 255,
        'link' => 255,
        'image_legend' => 255,
    ];
    protected $fieldsValidateLang = [
        'name' => 'isCatalogName',
        'link' => 'isUrl',
        'have_icon' => 'isBool',
        'image_type ' => 'isString',
        'image_legend' => 'isCatalogName',
        'image_class ' => 'isString',
        'value_over' => 'isString',
        'value_under' => 'isString',
    ];
    protected $table = 'pm_advancedtopmenu';
    protected $identifier = 'id_menu';
    public static $definition = [
        'table' => 'pm_advancedtopmenu',
        'primary' => 'id_menu',
        'multishop' => true,
        'multilang_shop' => false,
        'multilang' => true,
        'fields' => [
            'name' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
            'link' => [
                'type' => 3, 'lang' => true, 'required' => false, 'size' => 255,
            ],
            'value_over' => [
                'type' => 3, 'lang' => true, 'required' => false,
            ],
            'value_under' => [
                'type' => 3, 'lang' => true, 'required' => false,
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
    public function __construct($id_menu = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation(self::$definition['table'], ['type' => 'shop']);
        parent::__construct($id_menu, $id_lang, $id_shop);
        $this->chosen_groups = json_decode($this->chosen_groups);
    }
    public function getFields()
    {
        parent::validateFields();
        $fields = [];
        if (isset($this->id)) {
            $fields['id_menu'] = (int)$this->id;
        }
        $fields['active'] = (int)$this->active;
        $fields['active_desktop'] = (int)$this->active_desktop;
        $fields['active_mobile'] = (int)$this->active_mobile;
        $fields['id_shop'] = (int)$this->id_shop;
        $fields['id_category'] = (int)$this->id_category;
        $fields['id_cms'] = (int)$this->id_cms;
        $fields['id_cms_category'] = (int)$this->id_cms_category;
        $fields['id_supplier'] = (int)$this->id_supplier;
        $fields['id_manufacturer'] = (int)$this->id_manufacturer;
        $fields['id_specific_page'] = pSQL($this->id_specific_page);
        $fields['type'] = (int)$this->type;
        $fields['target'] = pSQL($this->target);
        $fields['privacy'] = (int)$this->privacy;
        $fields['chosen_groups'] = pSQL($this->chosen_groups);
        $fields['txt_color_menu_tab'] = pSQL($this->txt_color_menu_tab);
        $fields['txt_color_menu_tab_hover'] = pSQL($this->txt_color_menu_tab_hover);
        $fields['fnd_color_menu_tab'] = pSQL($this->fnd_color_menu_tab);
        $fields['fnd_color_menu_tab_over'] = pSQL($this->fnd_color_menu_tab_over);
        $fields['width_submenu'] = pSQL($this->width_submenu);
        $fields['minheight_submenu'] = pSQL($this->minheight_submenu);
        $fields['position_submenu'] = (int)$this->position_submenu;
        $fields['fnd_color_submenu'] = pSQL($this->fnd_color_submenu);
        $fields['border_color_submenu'] = pSQL($this->border_color_submenu);
        $fields['border_color_tab'] = pSQL($this->border_color_tab);
        $fields['border_size_tab'] = pSQL($this->border_size_tab);
        $fields['border_size_submenu'] = pSQL($this->border_size_submenu);
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
            $fields[$language['id_lang']]['value_over'] = isset($this->value_over[$language['id_lang']]) ? pSQL($this->value_over[$language['id_lang']], true) : '';
            $fields[$language['id_lang']]['value_under'] = isset($this->value_under[$language['id_lang']]) ? pSQL($this->value_under[$language['id_lang']], true) : '';
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
    public function add($autodate = true, $nullValues = false)
    {
        $this->id_shop = Context::getContext()->shop->id;
        return parent::add($autodate, $nullValues);
    }
    public function update($nullValues = false)
    {
        $this->id_shop = Context::getContext()->shop->id;
        return parent::update($nullValues);
    }
    public function delete()
    {
        if (!isset($this->id) || !$this->id) {
            return;
        }
        $languages = Language::getLanguages(false);
        foreach ($languages as $language) {
            if (file_exists(_PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/menu_icons/' . (int)$this->id . '-' . $language['iso_code'] . '.' . (isset($this->image_type[$language['id_lang']]) && !preg_match('/^i-(fa|mi)$/', $this->image_type[$language['id_lang']]) ? $this->image_type[$language['id_lang']] : 'jpg'))) {
                @unlink(_PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/menu_icons/' . (int)$this->id . '-' . $language['iso_code'] . '.' . (isset($this->image_type[$language['id_lang']]) && !preg_match('/^i-(fa|mi)$/', $this->image_type[$language['id_lang']]) ? $this->image_type[$language['id_lang']] : 'jpg'));
            }
        }
        $columnsWrap = AdvancedTopMenuColumnWrapClass::getColumnWrapIds($this->id);
        foreach ($columnsWrap as $id_wrap) {
            $obj = new AdvancedTopMenuColumnWrapClass($id_wrap);
            $obj->delete();
        }
        return parent::delete();
    }
    public static function menuHaveDepend($id_menu)
    {
        $sql = 'SELECT `id_column`
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns`
                WHERE `id_menu_depend` = ' . (int)$id_menu;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusId()
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusFromIdCategory($idCategory)
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 3
        AND atp.`id_category` = ' . (int)$idCategory;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusFromIdManufacturer($idManufacturer)
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 4
        AND atp.`id_manufacturer` = ' . (int)$idManufacturer;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusFromIdCms($idCms)
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 1
        AND atp.`id_cms` = ' . (int)$idCms;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusFromIdSupplier($idSupplier)
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 5
        AND atp.`id_supplier` = ' . (int)$idSupplier;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function getMenusFromIdCmsCategory($idCmsCategory)
    {
        $sql = 'SELECT atp.`id_menu`
        FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
        WHERE atp.`active` = 1
        AND atp.`type` = 10
        AND atp.`id_cms_category` = ' . (int)$idCmsCategory;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function disableById($idMenu)
    {
        return Db::getInstance()->update('pm_advancedtopmenu', [
            'active' => 0,
        ], 'id_menu = ' . (int)$idMenu);
    }
    public static function getMenus($id_lang, $active = true, $get_from_all_shops = false, $groupRestrict = false)
    {
        $sql_groups_join = '';
        $sql_groups_where = '';
        if ($groupRestrict && Group::isFeatureActive()) {
            $groups = PM_AdvancedTopMenu::getCustomerGroups();
            if (count($groups)) {
                $sql_groups_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'category_group` cg ON (cg.`id_category` = ca.`id_category`)';
                $sql_groups_where = 'AND IF (atp.`id_category` IS NULL OR atp.`id_category` = 0, 1, cg.`id_group` IN (' . implode(',', array_map('intval', $groups)) . '))';
            }
        }
        $sql = 'SELECT atp.*, atpl.*,
                cl.link_rewrite, cl.meta_title,
                cal.link_rewrite as category_link_rewrite, cal.name as category_name,
                m.name as manufacturer_name,
                s.name as supplier_name,
                ccl.name as cms_category_name
                FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu` atp
                ' . (Shop::isFeatureActive() ? self::addSqlAssociation('pm_advancedtopmenu', 'atp', 'id_menu', true, null, $get_from_all_shops ? 'all' : false) : '') . '
                LEFT JOIN `' . _DB_PREFIX_ . 'pm_advancedtopmenu_lang` atpl ON (atp.`id_menu` = atpl.`id_menu` AND atpl.`id_lang` = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'cms c ON (c.id_cms = atp.`id_cms`)
                ' . Shop::addSqlAssociation('cms', 'c', false, null, $get_from_all_shops ? true : false) . '
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_lang cl ON (c.id_cms = cl.id_cms AND cl.id_lang = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_category cc ON (cc.id_cms_category = atp.`id_cms_category`)
                ' . Shop::addSqlAssociation('cms_category', 'cc', false, null, $get_from_all_shops ? true : false) . '
                LEFT JOIN ' . _DB_PREFIX_ . 'cms_category_lang ccl ON (cc.id_cms_category = ccl.id_cms_category AND ccl.id_lang = ' . (int)$id_lang . ')
                LEFT JOIN ' . _DB_PREFIX_ . 'category ca ON (ca.id_category = atp.`id_category`)
                ' . $sql_groups_join . '
                LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cal ON (ca.id_category = cal.id_category AND cal.id_lang = ' . (int)$id_lang . Shop::addSqlRestrictionOnLang('cal') . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m ON (atp.`id_manufacturer` = m.`id_manufacturer`)
                ' . Shop::addSqlAssociation('manufacturer', 'm', false, null, $get_from_all_shops ? true : false) . '
                LEFT JOIN `' . _DB_PREFIX_ . 'supplier` s ON (atp.`id_supplier` = s.`id_supplier`)
                ' . Shop::addSqlAssociation('supplier', 's', false, null, $get_from_all_shops ? true : false) . '
                ' . ($active ? '
                WHERE atp.`active` = 1 AND (atp.`active_desktop` = 1 || atp.`active_mobile` = 1)
                AND ((atp.`id_manufacturer` = 0 AND atp.`id_supplier` = 0 AND atp.`id_category` = 0 AND atp.`id_cms` = 0 AND atp.`id_cms_category` = 0)
                OR c.id_cms IS NOT NULL OR cc.id_cms_category IS NOT NULL OR m.id_manufacturer IS NOT NULL OR ca.id_category IS NOT NULL OR s.`id_supplier` IS NOT NULL)
                ' . $sql_groups_where : '') . '
                GROUP BY atp.`id_menu`
                ORDER BY atp.`position`';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
    }
    public static function addSqlAssociation($table, $alias, $identifier, $inner_join = true, $on = null, $shops = false)
    {
        if (Shop::isFeatureActive()) {
            if ($shops == 'all') {
                $ids_shop = array_values(Shop::getCompleteListOfShopsID());
            } elseif (is_array($shops) && count($shops)) {
                $ids_shop = array_values($shops);
            } elseif (is_numeric($shops)) {
                $ids_shop = [$shops];
            } else {
                $ids_shop = array_values(Shop::getContextListShopID());
            }
            $table_alias = $alias . '_shop';
            if (strpos($table, '.') !== false) {
                list($table_alias, $table) = explode('.', $table);
            }
            return ($inner_join ? ' INNER' : ' LEFT') . ' JOIN `' . _DB_PREFIX_ . $table . '_shop` ' . $table_alias . '
                        ON ' . $table_alias . '.' . $identifier . ' = ' . $alias . '.' . $identifier . '
                        AND ' . $table_alias . '.id_shop IN (' . implode(', ', array_map('intval', $ids_shop)) . ') '
                        . ($on ? ' AND ' . $on : '');
        }
        return '';
    }
}
