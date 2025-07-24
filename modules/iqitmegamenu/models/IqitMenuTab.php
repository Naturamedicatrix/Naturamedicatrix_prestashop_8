<?php
/**
 * 2017 IQIT-COMMERCE.COM
 *
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement
 *
 *  @author    IQIT-COMMERCE.COM <support@iqit-commerce.com>
 *  @copyright 2017 IQIT-COMMERCE.COM
 *  @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
class IqitMenuTab extends ObjectModel
{
    public $id;
    public $menu_type;
    public $id_tab;
    public $id_shop_list = [];
    public $id_shop;
    public $active;
    public $active_label;
    public $position;
    public $url_type;
    public $id_url;
    public $icon_type;
    public $icon_class;
    public $icon;
    public $legend_icon;
    public $new_window;
    public $float;
    public $submenu_type;
    public $submenu_width;
    public $submenu_bg_color;
    public $submenu_image;
    public $submenu_repeat;
    public $submenu_bg_position;
    public $submenu_link_color;
    public $submenu_hover_color;
    public $submenu_content;
    public $submenu_title_color;
    public $submenu_title_colorh;
    public $submenu_titleb_color;
    public $submenu_border_t;
    public $submenu_border_r;
    public $submenu_border_b;
    public $submenu_border_l;
    public $submenu_border_i;
    public $title;
    public $label;
    public $url;
    public $bg_color;
    public $txt_color;
    public $h_bg_color;
    public $h_txt_color;
    public $labelbg_color;
    public $labeltxt_color;
    public $group_access;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'iqitmegamenu_tabs',
        'primary' => 'id_tab',
        'multilang' => true,
        'fields' => [
            'menu_type' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'active_label' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'position' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'url_type' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'id_url' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'icon_type' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'icon_class' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'legend_icon' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'icon' => ['type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255],
            'new_window' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'float' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true],
            'submenu_content' => ['type' => self::TYPE_STRING],
            'submenu_type' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'submenu_width' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true],
            'submenu_bg_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_image' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_repeat' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'submenu_bg_position' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'submenu_link_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_hover_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_title_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_title_colorh' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_titleb_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_border_t' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_border_r' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_border_b' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_border_l' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'submenu_border_i' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'bg_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'txt_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'h_bg_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'h_txt_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'labelbg_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'labeltxt_color' => ['type' => self::TYPE_STRING, 'validate' => 'isString'],
            'title' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255],
            'label' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 255],
            'url' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrl', 'size' => 255],
            'group_access' => ['type' => self::TYPE_STRING],
        ],
    ];

    public function __construct($id_menu = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation('iqitmegamenu_tabs', ['type' => 'shop']);
        parent::__construct($id_menu, $id_lang, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        $res = parent::add($autodate, $null_values);
        $this->associateTo($this->id_shop_list);

        return $res;
    }

    public function delete()
    {
        $res = true;
        $tab = new IqitMenuTab((int) $this->id);
        $res &= $this->reOrderPositions($tab->menu_type);
        $res &= Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop`
			WHERE `id_tab` = ' . (int) $this->id);

        $res &= parent::delete();

        return $res;
    }

    public function update($null_values = false)
    {
        if (isset($this->id)) {
            Db::getInstance()->delete('iqitmegamenu_tabs_shop', 'id_tab = ' . (int) $this->id);
        }
        $this->associateTo($this->id_shop_list);

        return parent::update();
    }

    public static function getTabs($menu_type)
    {
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $id_lang = $context->language->id;

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT hs.`id_tab` as id_tab, hssl.`title`, hss.`position`
			FROM ' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop hs
			LEFT JOIN ' . _DB_PREFIX_ . 'iqitmegamenu_tabs hss ON (hs.id_tab = hss.id_tab)
			LEFT JOIN ' . _DB_PREFIX_ . 'iqitmegamenu_tabs_lang hssl ON (hss.id_tab = hssl.id_tab)
			WHERE id_shop = ' . (int) $id_shop . ' AND menu_type = ' . (int) $menu_type . '
			AND hssl.id_lang = ' . (int) $id_lang . '
			ORDER BY hss.position');
    }

    public static function getTabsFrontend($menu_type, $css_generator)
    {
        $context = Context::getContext();
        $id_shop = $context->shop->id;
        $id_lang = $context->language->id;

        $tabs = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT hs.`id_tab` as id_tab, hssl.`title`, hssl.`label`, hssl.`url`,
			hss.`position`,  hss.`active_label`, hss.`url_type`, hss.`id_url`, hss.`icon_type`, hss.`icon_class`, hss.`icon`, hss.`legend_icon`,
			hss.`new_window`, hss.`float`, hss.`submenu_type`, hss.`submenu_content`, hss.`submenu_width`, hss.`group_access`
			' . ($css_generator ? ', hss.`bg_color`, hss.`txt_color`,  hss.`h_bg_color`, hss.`h_txt_color`, hss.`labelbg_color`, hss.`labeltxt_color`,
			hss.`submenu_bg_color`, hss.`submenu_image`, hss.`submenu_repeat`, hss.`submenu_bg_position`,
			hss.`submenu_link_color`, hss.`submenu_hover_color`, hss.`submenu_link_color`, hss.`submenu_hover_color`, hss.`submenu_title_color`,
			hss.`submenu_title_colorh`, hss.`submenu_titleb_color`, hss.`submenu_border_t`, hss.`submenu_border_r`, hss.`submenu_border_b`,
			hss.`submenu_border_l`, hss.`submenu_border_i` ' : '') . '
			FROM ' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop hs
			LEFT JOIN ' . _DB_PREFIX_ . 'iqitmegamenu_tabs hss ON (hs.id_tab = hss.id_tab)
			LEFT JOIN ' . _DB_PREFIX_ . 'iqitmegamenu_tabs_lang hssl ON (hss.id_tab = hssl.id_tab)
			WHERE id_shop = ' . (int) $id_shop . ' AND menu_type = ' . (int) $menu_type . ' AND active = 1
			AND hssl.id_lang = ' . (int) $id_lang . '
			ORDER BY hss.position');

        if (Context::getContext()->customer) {
            foreach ($tabs as $key => $tab) {
                if ($userGroups = Context::getContext()->customer->getGroups()) {
                    $tmpLinkGroups = json_decode($tab['group_access']);
                    $linkGroups = [];

                    foreach ($tmpLinkGroups as $groupID => $status) {
                        if ($status) {
                            $linkGroups[] = $groupID;
                        }
                    }

                    $intersect = array_intersect($userGroups, $linkGroups);
                    if (!count($intersect)) {
                        unset($tabs[$key]);
                    }
                }
            }

            return $tabs;
        } else {
            return $tabs;
        }
    }

    public static function getNextPosition($menu_type)
    {
        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT MAX(hss.`position`) AS `next_position`
			FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs` hss, `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs
			WHERE hss.`id_tab` = hs.`id_tab` AND hss.`menu_type` = ' . (int) $menu_type . ' AND hs.`id_shop` = ' . (int) $id_shop);

        return ++$row['next_position'];
    }

    public static function tabExists($id_tab)
    {
        $req = 'SELECT hs.`id_tab` as id_tab
				FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs
				WHERE hs.`id_tab` = ' . (int) $id_tab;
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

        return $row;
    }

    public static function getAllShopTabs()
    {
        $id_shop = Context::getContext()->shop->id;

        $req = 'SELECT hs.`id_tab` as id_tab
                FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs
                WHERE hs.`id_shop` = ' . (int) $id_shop;
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($req);

        $tabs = [];

        foreach ($rows as $id => $tab) {
            $tabs[$tab['id_tab']] = new IqitMenuTab($tab['id_tab']);
            $tabs[$tab['id_tab']]->id_shop_list = $id_shop;
        }

        return $tabs;
    }

    public static function importTabs($id_tab)
    {
        $req = 'SELECT hs.`id_tab` as id_tab
                FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs
                WHERE hs.`id_tab` = ' . (int) $id_tab;
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

        return $row;
    }

    public function reOrderPositions($menu_type)
    {
        $id_tab = $this->id;
        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT MAX(hss.`position`) as position
			FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs` hss, `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs
			WHERE hss.`id_tab` = hs.`id_tab` AND hss.`menu_type` = ' . (int) $menu_type . ' AND hs.`id_shop` = ' . (int) $id_shop);

        if ((int) $max == (int) $id_tab) {
            return true;
        }

        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT hss.`position` as position, hss.`id_tab` as id_tab
			FROM `' . _DB_PREFIX_ . 'iqitmegamenu_tabs` hss
			LEFT JOIN `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop` hs ON (hss.`id_tab` = hs.`id_tab`)
			WHERE hs.`id_shop` = ' . (int) $id_shop . ' AND hss.`menu_type` = ' . (int) $menu_type . ' AND hss.`position` > ' . (int) $this->position);

        foreach ($rows as $row) {
            $current_tab = new IqitMenuTab($row['id_tab']);
            --$current_tab->position;
            $current_tab->update();
            unset($current_tab);
        }

        return true;
    }

    public function verifyAccess()
    {
        if (Context::getContext()->customer) {
            if ($userGroups = Context::getContext()->customer->getGroups()) {
                $tmpLinkGroups = json_decode($this->group_access);
                $linkGroups = [];

                foreach ($tmpLinkGroups as $groupID => $status) {
                    if ($status) {
                        $linkGroups[] = $groupID;
                    }
                }

                $intersect = array_intersect($userGroups, $linkGroups);
                if (!count($intersect)) {
                    return false;
                }
            }

            return true;
        } else {
            return true;
        }
    }
}
