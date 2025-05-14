<?php
/**
 * Advanced Top Menu
 *
 * @author    Presta-Module.com <support@presta-module.com> - https://www.presta-module.com
 * @copyright Presta-Module - https://www.presta-module.com
 * @license   see file: LICENSE.txt
 *
 * @version   1.13.6
 *
 *           ____     __  __
 *          |  _ \   |  \/  |
 *          | |_) |  | |\/| |
 *          |  __/   | |  | |
 *          |_|      |_|  |_|
 */

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once _PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/AdvancedTopMenuClass.php';
include_once _PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/AdvancedTopMenuColumnWrapClass.php';
include_once _PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/AdvancedTopMenuColumnClass.php';
include_once _PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/AdvancedTopMenuElementsClass.php';
include_once _PS_ROOT_DIR_ . '/modules/pm_advancedtopmenu/AdvancedTopMenuProductColumnClass.php';
class PM_AdvancedTopMenu extends Module implements PrestaShop\PrestaShop\Core\Module\WidgetInterface
{
    protected $_html;
    protected static $_module_prefix = 'ATM';
    protected $errors = [];
    protected $defaultLanguage;
    protected $languages;
    protected $_iso_lang;
    protected $base_config_url;
    protected $gradient_separator = '-';
    protected $rebuildable_type = [
        3,
        4,
        5,
        10,
    ];
    protected $font_families = [
        'Arial, Helvetica, sans-serif',
        "'Arial Black', Gadget, sans-serif",
        "'Bookman Old Style', serif",
        "'Comic Sans MS', cursive",
        'Courier, monospace',
        "'Courier New', Courier, monospace",
        'Garamond, serif',
        'Georgia, serif',
        'Impact, Charcoal, sans-serif',
        "'Lucida Console', Monaco, monospace",
        "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
        "'MS Sans Serif', Geneva, sans-serif",
        "'MS Serif', 'New York', sans-serif",
        "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        'Symbol, sans-serif',
        'Tahoma, Geneva, sans-serif',
        "'Times New Roman', Times, serif",
        "'Trebuchet MS', Helvetica, sans-serif",
        'Verdana, Geneva, sans-serif',
        'Webdings, sans-serif',
        "Wingdings, 'Zapf Dingbats', sans-serif",
    ];
    protected $allowFileExtension = [
        'gif',
        'jpg',
        'jpeg',
        'png',
        'svg',
        'webp',
    ];
    protected $_fieldsOptions = [];
    protected $link_targets;
    protected static $_forceCompile;
    protected static $_caching;
    protected static $_compileCheck;
    protected $_copyright_link = [
        'link' => '',
        'img' => '//www.presta-module.com/img/logo-module.JPG',
    ];
    protected $_support_link = false;
    protected $_getting_started = false;
    protected $_cacheIsInMaintenance = null;
    const INSTALL_SQL_FILE = 'sql/install.sql';
    const GLOBAL_CSS_FILE = 'views/css/pm_advancedtopmenu_global.css';
    const ADVANCED_CSS_FILE = 'views/css/pm_advancedtopmenu_advanced.css';
    const ADVANCED_CSS_FILE_RESTORE = 'views/css/reset-pm_advancedtopmenu_advanced.css';
    const DYN_CSS_FILE = 'views/css/pm_advancedtopmenu.css';
    public function __construct()
    {
        $this->name = 'pm_advancedtopmenu';
        $this->author = 'Presta-Module';
        $this->tab = 'front_office_features';
        $this->module_key = '22fb589ff4648a10756b4ad805180259';
        $this->version = '1.13.6';
        $this->bootstrap = true;
        $this->ps_versions_compliancy = [
            'min' => '1.7.4.0',
            'max' => _PS_VERSION_,
        ];
        $this->displayName = $this->l('Advanced Top Menu');
        $this->description = $this->l('Horizontal menu with sub menu in column');
        parent::__construct();
        $this->initClassVar();
        if ($this->onBackOffice()) {
            $this->_fieldsOptions = [
                'ATM_CONT_CLASSES' => [
                    'title' => $this->l('Menu container (.adtm_menu_container)'),
                    'desc' => $this->l('On bootstrap themes, you may have to enter "container" in order to center the menu'),
                    'type' => 'text',
                    'default' => 'container',
                    'advanced' => true,
                ],
                'ATM_RESP_CONT_CLASSES' => [
                    'title' => $this->l('Menu (#adtm_menu)'),
                    'type' => 'text',
                    'default' => '',
                    'advanced' => true,
                ],
                'ATM_MENU_HAMBURGER_SELECTORS' => [
                    'title' => $this->l('Selector of hamburger icon'),
                    'desc' => $this->l('On default theme, should be "#menu-icon, .menu-icon" most of the time'),
                    'type' => 'text',
                    'default' => '#menu-icon, .menu-icon',
                    'advanced' => true,
                ],
                'ATM_INNER_CLASSES' => [
                    'title' => $this->l('Menu subcontainer (#adtm_menu_inner)'),
                    'desc' => $this->l('On bootstrap themes, you may have to enter "container" in order to center the menu when using sticky view'),
                    'type' => 'text',
                    'default' => 'clearfix',
                    'advanced' => true,
                ],
                'ATM_RESPONSIVE_MODE' => [
                    'title' => $this->l('Activate responsive mode'),
                    'desc' => $this->l('Enable only if your theme manage this behaviour'),
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                    'mobile' => true,
                ],
                'ATM_RESPONSIVE_THRESHOLD' => [
                    'title' => $this->l('Activate mobile mode up to'),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '767',
                    'mobile' => true,
                    'suffix' => 'px',
                ],
                'ATM_RESP_TOGGLE_ENABLED' => [
                    'title' => $this->l('Activate menu toggle mode'),
                    'desc' => $this->l('Enable only if your theme doesn\'t manage an "hamburger" icon'),
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                    'mobile' => true,
                ],
                'ATM_RESP_TOGGLE_HEIGHT' => [
                    'title' => $this->l('Height'),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '40',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                    'suffix' => 'px',
                ],
                'ATM_RESP_TOGGLE_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 16,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_TEXT' => [
                    'title' => $this->l('Text'),
                    'desc' => '',
                    'type' => 'textLang',
                    'default' => $this->l('Menu'),
                    'size' => 20,
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_BG_COLOR_OP' => [
                    'title' => $this->l('Background color (open state)'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#ffffff',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_BG_COLOR_CL' => [
                    'title' => $this->l('Background color (close state)'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#e5e5e5',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_COLOR_OP' => [
                    'title' => $this->l('Text color (opened state)'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#333333',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_COLOR_CL' => [
                    'title' => $this->l('Text color (closed state)'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#666666',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_TOGGLE_ICON' => [
                    'title' => $this->l('Icon'),
                    'desc' => '',
                    'type' => 'image',
                    'default' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYAgMAAACdGdVrAAAACVBMVEUAAAAAAAAAAACDY+nAAAAAAnRSTlMA3Pn2U8cAAAAaSURBVAjXY4CCrFVAsJJhFRigUjA5FEBvfQDmRTo/uCG3BQAAAABJRU5ErkJggg==',
                    'mobile' => true,
                    'class' => 'resp_toggle',
                ],
                'ATM_RESP_ENABLE_STICKY' => [
                    'title' => $this->l('Enable Sticky mode on mobile?'),
                    'desc' => $this->l('We recommend to disable the sticky mode if the menu is in a hamburger type sidebar'),
                    'type' => 'bool',
                    'default' => false,
                    'identifier' => 'id',
                    'mobile' => true,
                    'class' => 'mobile_sticky',
                ],
                'ATM_RESP_MENU_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '5px 10px 5px 10px',
                    'mobile' => true,
                ],
                'ATMR_MENU_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                    'mobile' => true,
                ],
                'ATM_RESP_MENU_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 18,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_MENU_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                    'mobile' => true,
                ],
                'ATMR_MENU_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'uppercase',
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_MENU_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_MENU_BGCOLOR_OP' => [
                    'title' => $this->l('Background color (opened state)'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#333333-#000000',
                    'mobile' => true,
                ],
                'ATMR_MENU_BGCOLOR_CL' => [
                    'title' => $this->l('Background color (closed state)'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '',
                    'mobile' => true,
                ],
                'ATMR_MENU_COLOR' => [
                    'title' => $this->l('Text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#484848',
                    'mobile' => true,
                ],
                'ATMR_MENU_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#d6d4d4',
                    'mobile' => true,
                ],
                'ATMR_MENU_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 1px 1px 1px',
                    'mobile' => true,
                ],
                'ATMR_SUBMENU_BGCOLOR' => [
                    'title' => $this->l('Background color'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#ffffff-#fcfcfc',
                    'mobile' => true,
                ],
                'ATMR_SUBMENU_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#e5e5e5',
                    'mobile' => true,
                ],
                'ATMR_SUBMENU_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 1px 0 1px',
                    'mobile' => true,
                ],
                'ATM_RESP_SUBMENU_ICON_OP' => [
                    'title' => $this->l('Icon for opened state'),
                    'desc' => '',
                    'type' => 'image',
                    'default' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYBAMAAAASWSDLAAAAFVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAASAQCkAAAABnRSTlMAHiXy6t8iJwLjAAAARUlEQVQY02OgKWBUAJFMYJJB1AhEChuCOSLJCkBpNxAHRBsBRVIUIJpUkhVgEmAlIKVgAFIDUgmXgkmAzXWCMqA20hgAAI+xB05evnCbAAAAAElFTkSuQmCC',
                    'mobile' => true,
                ],
                'ATM_RESP_SUBMENU_ICON_CL' => [
                    'title' => $this->l('Icon for closed state'),
                    'desc' => '',
                    'type' => 'image',
                    'default' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYBAMAAAASWSDLAAAAFVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAASAQCkAAAABnRSTlMAHiXy6t8iJwLjAAAANUlEQVQY02MgFwgisZmMFZA4Zo5IUiLJSFKMbkZESqUoYKjDNFw5RYAYCSckW0IEULxAPgAAZQ0HP01tIysAAAAASUVORK5CYII=',
                    'mobile' => true,
                ],
                'ATMR_COLUMNWRAP_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                    'mobile' => true,
                ],
                'ATMR_COLUMNWRAP_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                    'mobile' => true,
                ],
                'ATMR_COLUMNWRAP_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#e5e5e5',
                    'mobile' => true,
                ],
                'ATMR_COLUMNWRAP_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 1px 0',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 5px 0',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 10px 5px 10px',
                    'mobile' => true,
                ],
                'ATMR_COLUMNTITLE_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                    'mobile' => true,
                ],
                'ATMR_COLUMNTITLE_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '8px 10px 8px 0',
                    'mobile' => true,
                ],
                'ATM_RESP_COLUMN_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 18,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                    'mobile' => true,
                ],
                'ATMR_COLUMN_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'none',
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_TITLE_COLOR' => [
                    'title' => $this->l('Text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#333333',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '5px 0 5px 10px',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '15px 0 15px 0',
                    'mobile' => true,
                ],
                'ATM_RESP_COLUMN_ITEM_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 16,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'none',
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                    'mobile' => true,
                ],
                'ATMR_COLUMN_ITEM_COLOR' => [
                    'title' => $this->l('Text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#777777',
                    'mobile' => true,
                ],
                'ATM_MENU_CONT_HOOK' => [
                    'title' => $this->l('Menu position'),
                    'onchange' => 'setMenuContHook(this.value);',
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'top',
                    'list' => [
                        [
                            'id' => 'top',
                            'name' => 'displayTop ' . $this->l('(default)'),
                        ],
                        [
                            'id' => 'nav',
                            'name' => 'displayNav',
                        ],
                    ],
                    'identifier' => 'id',
                ],
                'ATM_THEME_COMPATIBILITY_MODE' => [
                    'title' => $this->l('Activate theme compatibility mode'),
                    'desc' => $this->l('Enable only if theme layout is corrupted after installation'),
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                ],
                'ATM_CACHE' => [
                    'title' => $this->l('Activate cache (faster processing)'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                ],
                'ATM_OBFUSCATE_LINK' => [
                    'title' => $this->l('Obfuscate all menu links except level 1 (improve link juice - SEO)'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                /*
                'ATM_AUTOCOMPLET_SEARCH' => array(
                    'title' => $this->l('Activate autocompletion in search input'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                ),
                */
                'ATM_MENU_CONT_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_MENU_CONT_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '20px 0 0 0',
                ],
                'ATM_MENU_CONT_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#333333',
                ],
                'ATM_MENU_CONT_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '5px 0 0 0',
                ],
                'ATM_MENU_CONT_POSITION' => [
                    'title' => $this->l('Position'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'relative',
                    'list' => [
                        [
                            'id' => 'relative',
                            'name' => $this->l('Relative (default)'),
                        ],
                        [
                            'id' => 'absolute',
                            'name' => $this->l('Absolute'),
                        ],
                        [
                            'id' => 'sticky',
                            'name' => $this->l('Sticky'),
                        ],
                    ],
                    'identifier' => 'id',
                ],
                'ATM_MENU_CONT_POSITION_TRBL' => [
                    'title' => $this->l('Positioning (px)'),
                    'desc' => '',
                    'type' => '4size_position',
                    'default' => '',
                ],
                'ATM_MENU_GLOBAL_ACTIF' => [
                    'title' => $this->l('Highlight current tab (status:active)'),
                    'desc' => $this->l('Background and font color values from over settings will be used'),
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                ],
                'ATM_MENU_GLOBAL_WIDTH' => [
                    'title' => $this->l('Width'),
                    'desc' => $this->l('Put 0 for automatic width'),
                    'type' => 'text',
                    'default' => '0',
                    'suffix' => 'px',
                ],
                'ATM_MENU_GLOBAL_HEIGHT' => [
                    'title' => $this->l('Height'),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '56',
                    'suffix' => 'px',
                ],
                'ATM_MENU_GLOBAL_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_MENU_GLOBAL_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_MENU_GLOBAL_ZINDEX' => [
                    'title' => $this->l('Z-index value (CSS)'),
                    'desc' => $this->l('Increase if your cart block is under the menu bar'),
                    'type' => 'text',
                    'default' => '9',
                    'short' => true,
                ],
                'ATM_MENU_GLOBAL_BGCOLOR' => [
                    'title' => $this->l('Background color'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#f6f6f6-#e6e6e6',
                ],
                'ATM_MENU_GLOBAL_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#e9e9e9',
                ],
                'ATM_MENU_GLOBAL_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 3px 0',
                ],
                'ATM_MENU_BOX_SHADOW' => [
                    'title' => $this->l('Drop shadow'),
                    'desc' => '',
                    'type' => 'shadow',
                    'default' => '0px 5px 13px 0px',
                ],
                'ATM_MENU_BOX_SHADOWCOLOR' => [
                    'title' => $this->l('Drop shadow color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#000000',
                ],
                'ATM_MENU_BOX_SHADOWOPACITY' => [
                    'title' => $this->l('Drop shadow opacity'),
                    'desc' => '',
                    'type' => 'slider',
                    'default' => 20,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'suffix' => '%',
                ],
                'ATM_MENU_CENTER_TABS' => [
                    'title' => $this->l('Tabs centering'),
                    'desc' => $this->l('Choose a position for the tabs within the menu bar (desktop only)'),
                    'type' => 'select',
                    'list' => [
                        [
                            'id' => 1,
                            'name' => $this->l('Align to the left (default)'),
                        ],
                        [
                            'id' => 2,
                            'name' => $this->l('Center'),
                        ],
                        [
                            'id' => 4,
                            'name' => $this->l('Align to the right'),
                        ],
                        [
                            'id' => 3,
                            'name' => $this->l('Justify'),
                        ],
                    ],
                    'default' => 1,
                    'identifier' => 'id',
                ],
                'ATM_MENU_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 20px 0 20px',
                ],
                'ATM_MENU_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_MENU_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 18,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_MENU_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_MENU_FONT_UNDERLINE' => [
                    'title' => $this->l('Underline text'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_MENU_FONT_UNDERLINEOV' => [
                    'title' => $this->l('Underline text (on mouse over)'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_MENU_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'none',
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_MENU_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_MENU_COLOR' => [
                    'title' => $this->l('Text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#484848',
                ],
                'ATM_MENU_COLOR_OVER' => [
                    'title' => $this->l('Text color (on mouse over)'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#ffffff',
                ],
                'ATM_MENU_BGCOLOR' => [
                    'title' => $this->l('Background color'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '',
                ],
                'ATM_MENU_BGCOLOR_OVER' => [
                    'title' => $this->l('Background color (on mouse over)'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#333333-#000000',
                ],
                'ATM_MENU_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#d6d4d4',
                ],
                'ATM_MENU_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 1px 0 1px',
                ],
                'ATM_SUBMENU_WIDTH' => [
                    'title' => $this->l('Width'),
                    'desc' => $this->l('Put 0 for automatic width'),
                    'type' => 'text',
                    'default' => '0',
                    'suffix' => 'px',
                ],
                'ATM_SUBMENU_HEIGHT' => [
                    'title' => $this->l('Minimum height'),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '0',
                    'suffix' => 'px',
                ],
                'ATM_SUBMENU_ZINDEX' => [
                    'title' => $this->l('Z-index value (CSS)'),
                    'desc' => $this->l('Increase if submenus are under your main content'),
                    'type' => 'text',
                    'default' => '1000',
                ],
                'ATM_SUBMENU_OPEN_METHOD' => [
                    'title' => $this->l('Opening method'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'select',
                    'default' => 1,
                    'list' => [
                        [
                            'id' => 1,
                            'name' => $this->l('On mouse over'),
                        ],
                        [
                            'id' => 2,
                            'name' => $this->l('On mouse click'),
                        ],
                    ],
                    'identifier' => 'id',
                ],
                'ATM_SUBMENU_POSITION' => [
                    'title' => $this->l('Position'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'select',
                    'default' => 2,
                    'list' => [
                        [
                            'id' => 1,
                            'name' => $this->l('Left-aligned current menu'),
                        ],
                        [
                            'id' => 2,
                            'name' => $this->l('Left-aligned global menu'),
                        ],
                    ],
                    'identifier' => 'id',
                ],
                'ATM_SUBMENU_BGCOLOR' => [
                    'title' => $this->l('Background color'),
                    'desc' => '',
                    'type' => 'gradient',
                    'default' => '#ffffff-#fcfcfc',
                ],
                'ATM_SUBMENU_BGOPACITY' => [
                    'title' => $this->l('Background color opacity'),
                    'desc' => '',
                    'type' => 'slider',
                    'default' => 100,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'suffix' => '%',
                ],
                'ATM_SUBMENU_BORDERCOLOR' => [
                    'title' => $this->l('Border color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#e5e5e5',
                ],
                'ATM_SUBMENU_BORDERSIZE' => [
                    'title' => $this->l('Border width (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 1px 1px 1px',
                ],
                'ATM_SUBMENU_BOX_SHADOW' => [
                    'title' => $this->l('Drop shadow'),
                    'desc' => '',
                    'type' => 'shadow',
                    'default' => '0px 5px 13px 0px',
                ],
                'ATM_SUBMENU_BOX_SHADOWCOLOR' => [
                    'title' => $this->l('Drop shadow color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#000000',
                ],
                'ATM_SUBMENU_BOX_SHADOWOPACITY' => [
                    'title' => $this->l('Drop shadow opacity'),
                    'desc' => '',
                    'type' => 'slider',
                    'default' => 20,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'suffix' => '%',
                ],
                'ATM_SUBMENU_OPEN_DELAY' => [
                    'title' => $this->l('Opening delay'),
                    'desc' => '',
                    'type' => 'slider',
                    'default' => 0.3,
                    'min' => 0,
                    'max' => 2,
                    'step' => 0.1,
                    'suffix' => 's',
                ],
                'ATM_SUBMENU_FADE_SPEED' => [
                    'title' => $this->l('Fading effect duration'),
                    'desc' => '',
                    'type' => 'slider',
                    'default' => 0.3,
                    'min' => 0,
                    'max' => 2,
                    'step' => 0.1,
                    'suffix' => 's',
                ],
                'ATM_COLUMNWRAP_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_COLUMN_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_COLUMN_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 10px 0 10px',
                ],
                'ATM_COLUMNTITLE_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_COLUMNTITLE_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 10px 0 0',
                ],
                'ATM_COLUMN_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 16,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => true,
                ],
                'ATM_COLUMN_FONT_UNDERLINE' => [
                    'title' => $this->l('Underline text'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_COLUMN_FONT_UNDERLINEOV' => [
                    'title' => $this->l('Underline text (on mouse over)'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_COLUMN_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'none',
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_TITLE_COLOR' => [
                    'title' => $this->l('Heading text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#333333',
                ],
                'ATM_COLUMN_TITLE_COLOR_OVER' => [
                    'title' => $this->l('Heading text color (on mouse over)'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#515151',
                ],
                'ATM_COLUMN_ITEM_PADDING' => [
                    'title' => $this->l('Inner spaces - padding (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '3px 0 3px 0',
                ],
                'ATM_COLUMN_ITEM_MARGIN' => [
                    'title' => $this->l('Outer spaces - margin (px)'),
                    'desc' => '',
                    'type' => '4size',
                    'default' => '0 0 0 0',
                ],
                'ATM_COLUMN_ITEM_FONT_SIZE' => [
                    'title' => $this->l('Text size (px)'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 13,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_ITEM_FONT_BOLD' => [
                    'title' => $this->l('Text in bold'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_COLUMN_ITEM_FONT_UNDERLINE' => [
                    'title' => $this->l('Underline text'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_COLUMN_ITEM_FONT_UNDERLINEOV' => [
                    'title' => $this->l('Underline text (on mouse over)'),
                    'desc' => '',
                    'cast' => 'intval',
                    'type' => 'bool',
                    'default' => false,
                ],
                'ATM_COLUMN_ITEM_FONT_TRANSFORM' => [
                    'title' => $this->l('Text transformation'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 'none',
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_ITEM_FONT_FAMILY' => [
                    'title' => $this->l('Text font'),
                    'desc' => '',
                    'type' => 'select',
                    'default' => 0,
                    'list' => [],
                    'identifier' => 'id',
                ],
                'ATM_COLUMN_ITEM_COLOR' => [
                    'title' => $this->l('Text color'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#777777',
                ],
                'ATM_COLUMN_ITEM_COLOR_OVER' => [
                    'title' => $this->l('Text color (on mouse over)'),
                    'desc' => '',
                    'type' => 'color',
                    'default' => '#333333',
                ],
            ];
            $this->_fieldsOptions['ATM_MENU_CONT_HOOK'] = [
                'title' => $this->l('Menu position'),
                'onchange' => 'setMenuContHook(this.value);',
                'desc' => '',
                'type' => 'select',
                'default' => 'nav-full',
                'list' => [
                    [
                        'id' => 'top',
                        'name' => 'displayTop',
                    ],
                    [
                        'id' => 'nav-full',
                        'name' => 'displayNavFullWidth ' . $this->l('(default)'),
                    ],
                    [
                        'id' => 'widget',
                        'name' => $this->l('Widget (advanced user only)'),
                    ],
                ],
                'identifier' => 'id',
            ];
            $this->_fieldsOptions['ATM_THEME_COMPATIBILITY_MODE']['default'] = false;
            $this->_fieldsOptions['ATM_MENU_CONT_MARGIN']['default'] = '10px 0 0 0';
            $this->_fieldsOptions['ATM_COLUMNWRAP_PADDING']['default'] = '10px 10px 10px 10px';
            $this->_fieldsOptions['ATM_COLUMN_MARGIN']['default'] = '0 10px 10px 10px';
            $this->_fieldsOptions['ATMR_MENU_BGCOLOR_CL']['default'] = '#ffffff';
            if (!preg_match('#^crea.+#', $this->context->shop->theme_name)) {
                $this->_fieldsOptions['ATM_RESP_TOGGLE_ENABLED']['default'] = false;
            }
            foreach (array_keys($this->_fieldsOptions) as $key) {
                if (strpos($key, 'FONT_TRANSFORM') !== false) {
                    $this->_fieldsOptions[$key]['list'] = [
                        [
                            'id' => 'none',
                            'name' => $this->l('Normal (inherit)'),
                        ],
                        [
                            'id' => 'lowercase',
                            'name' => $this->l('lowercase'),
                        ],
                        [
                            'id' => 'uppercase',
                            'name' => $this->l('UPPERCASE'),
                        ],
                        [
                            'id' => 'capitalize',
                            'name' => $this->l('Capitalize'),
                        ],
                    ];
                } elseif (strpos($key, 'FONT_FAMILY') !== false) {
                    $this->_fieldsOptions[$key]['list'][] = [
                        'id' => 0,
                        'name' => $this->l('Inherit from my theme'),
                    ];
                    foreach ($this->font_families as $font_family) {
                        $this->_fieldsOptions[$key]['list'][] = [
                            'id' => $font_family,
                            'name' => $font_family,
                        ];
                    }
                } elseif (strpos($key, 'FONT_SIZE') !== false) {
                    $this->_fieldsOptions[$key]['list'][] = [
                        'id' => 0,
                        'name' => $this->l('Inherit from my theme'),
                    ];
                    for ($i = 8; $i <= 30; $i++) {
                        $this->_fieldsOptions[$key]['list'][] = [
                            'id' => $i,
                            'name' => $i,
                        ];
                    }
                }
            }
            $this->link_targets = [
                0 => $this->l('No target. W3C compliant.'),
                '_self' => $this->l('Open document in the same frame (_self)'),
                '_blank' => $this->l('Open document in a new window (_blank)'),
                '_top' => $this->l('Open document in the same window (_top)'),
                '_parent' => $this->l('Open document in the parent frame (_parent)'),
            ];
            $doc_url_tab = [];
            $doc_url_tab['fr'] = '#/fr/advancedtopmenu/';
            $doc_url_tab['en'] = '#/en/advancedtopmenu/';
            $doc_url = $doc_url_tab['en'];
            if ($this->_iso_lang == 'fr') {
                $doc_url = $doc_url_tab['fr'];
            }
            $forum_url_tab = [];
            $forum_url_tab['fr'] = 'http://www.prestashop.com/forums/topic/89128-module-pm-advancedtopmenu-menu-de-navigation-horizontal-en-colonnes/';
            $forum_url_tab['en'] = 'http://www.prestashop.com/forums/topic/89175-module-advancedtopmenu-horizontal-navigation-menu-with-columns/';
            $forum_url = $forum_url_tab['en'];
            if ($this->_iso_lang == 'fr') {
                $forum_url = $forum_url_tab['fr'];
            }
            $this->_support_link = [
                [
                    'link' => $forum_url,
                    'target' => '_blank',
                    'label' => $this->l('Forum topic'),
                ],
                
                [
                    'link' => 'https://addons.prestashop.com/contact-form.php?id_product=2072',
                    'target' => '_blank',
                    'label' => $this->l('Support contact'),
                ],
            ];
        }
    }
    public function install()
    {
        if (!$this->updateDB() || !parent::install()) {
            return false;
        }
        if (!$this->registerHook('displayTop') ||
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('actionCategoryUpdate') ||
            !$this->registerHook('actionObjectManufacturerUpdateAfter') ||
            !$this->registerHook('actionObjectCmsUpdateAfter') ||
            !$this->registerHook('actionObjectSupplierUpdateAfter') ||
            !$this->registerHook('actionObjectProductUpdateAfter') ||
            !$this->registerHook('actionObjectCmsCategoryUpdateAfter') ||
            !$this->registerHook('actionProductDelete') ||
            !$this->registerHook('actionObjectLanguageAddAfter') ||
            !$this->registerHook('actionShopDataDuplication') ||
            !$this->registerHook('displayNav') ||
            !$this->registerHook('displayNavFullWidth') ||
            !$this->installDefaultConfig()) {
            return false;
        }
        Db::getInstance()->update('hook_module', ['position' => 255], 'id_module = ' . (int)$this->id . ' AND id_hook = ' . (int)Hook::getIdByName('top'));
        return true;
    }
    protected function updateDB()
    {
        if (!file_exists(dirname(__FILE__) . '/' . self::INSTALL_SQL_FILE)) {
            return false;
        } elseif (!$sql = Tools::file_get_contents(dirname(__FILE__) . '/' . self::INSTALL_SQL_FILE)) {
            return false;
        }
        $sql = str_replace('PREFIX_', _DB_PREFIX_, $sql);
        $sql = str_replace('MYSQL_ENGINE', _MYSQL_ENGINE_, $sql);
        $sql = preg_split("/;\s*[\r\n]+/", $sql);
        foreach ($sql as $query) {
            if (empty(trim($query))) {
                continue;
            }
            if (!Db::getInstance()->Execute(trim($query))) {
                return false;
            }
        }
        return true;
    }
    protected function columnExists($table, $column, $createIfNotExist = false, $type = false, $insertAfter = false)
    {
        $resultset = Db::getInstance()->ExecuteS('SHOW COLUMNS FROM `' . _DB_PREFIX_ . $table . '`', true, false);
        foreach ($resultset as $row) {
            if ($row['Field'] == $column) {
                return true;
            }
        }
        if ($createIfNotExist && Db::getInstance()->Execute('ALTER TABLE `' . _DB_PREFIX_ . $table . '` ADD `' . $column . '` ' . $type . ' ' . ($insertAfter ? ' AFTER `' . $insertAfter . '`' : '') . '')) {
            return true;
        }
        return false;
    }
    protected function installDefaultConfig()
    {
        foreach ($this->_fieldsOptions as $key => $field) {
            $val = $field['default'];
            if (trim($val)) {
                if (Configuration::get($key) === false) {
                    if (!Configuration::updateValue($key, $val)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
    protected function checkIfModuleIsUpdate($updateDb = false, $displayConfirm = true)
    {
        if (!$updateDb && $this->version != Configuration::get('ATM_LAST_VERSION')) {
            return false;
        }
        $isUpdate = true;
        $this->updateDB();
        if (Shop::isFeatureActive()) {
            $nb_shop_entry = Db::getInstance()->getRow('SELECT COUNT(DISTINCT id_shop) as nb_shop_entry FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_shop`');
            $nb_shop_entry = $nb_shop_entry['nb_shop_entry'];
            $nb_menu_entry = Db::getInstance()->getRow('SELECT COUNT(DISTINCT id_menu) as nb_menu_entry FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu`');
            $nb_menu_entry = $nb_menu_entry['nb_menu_entry'];
            if (!$nb_shop_entry && $nb_menu_entry) {
                $menus_id = AdvancedTopMenuClass::getMenusId();
                foreach ($menus_id as $menu) {
                    foreach (Shop::getCompleteListOfShopsID() as $id_shop) {
                        Db::getInstance()->execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedtopmenu_shop` (id_shop, id_menu)
                        VALUES (' . (int)$id_shop . ', ' . (int)$menu['id_menu'] . ')');
                    }
                }
            }
        }
        $toUpdate = [
            [
                'pm_advancedtopmenu',
                'id_shop',
                'int(10) unsigned NOT NULL DEFAULT "0"',
                'id_manufacturer',
            ],
            [
                'pm_advancedtopmenu',
                'width_submenu',
                'varchar(5) NOT NULL',
                'border_color_tab',
            ],
            [
                'pm_advancedtopmenu',
                'minheight_submenu',
                'varchar(5) NOT NULL',
                'width_submenu',
            ],
            [
                'pm_advancedtopmenu',
                'position_submenu',
                'tinyint(3) unsigned NOT NULL',
                'minheight_submenu',
            ],
            [
                'pm_advancedtopmenu_elements',
                'active',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'target',
            ],
            [
                'pm_advancedtopmenu',
                'active_mobile',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_columns',
                'active_mobile',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_columns_wrap',
                'active_mobile',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_elements',
                'active_mobile',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_lang',
                'have_icon',
                "varchar(1) NOT NULL DEFAULT ''",
                'link',
            ],
            [
                'pm_advancedtopmenu_lang',
                'image_type',
                'varchar(4) NOT NULL',
                'have_icon',
            ],
            [
                'pm_advancedtopmenu_lang',
                'image_legend',
                "varchar(256) NOT NULL DEFAULT ''",
                'image_type',
            ],
            [
                'pm_advancedtopmenu_columns_lang',
                'have_icon',
                "varchar(1) NOT NULL DEFAULT ''",
                'link',
            ],
            [
                'pm_advancedtopmenu_columns_lang',
                'image_type',
                'varchar(4) NOT NULL',
                'have_icon',
            ],
            [
                'pm_advancedtopmenu_columns_lang',
                'image_legend',
                "varchar(256) NOT NULL DEFAULT ''",
                'image_type',
            ],
            [
                'pm_advancedtopmenu_elements_lang',
                'have_icon',
                "varchar(1) NOT NULL DEFAULT ''",
                'name',
            ],
            [
                'pm_advancedtopmenu_elements_lang',
                'image_type',
                'varchar(4) NOT NULL',
                'have_icon',
            ],
            [
                'pm_advancedtopmenu_elements_lang',
                'image_legend',
                "varchar(256) NOT NULL DEFAULT ''",
                'image_type',
            ],
            [
                'pm_advancedtopmenu',
                'chosen_groups',
                'text NOT NULL',
                'privacy',
            ],
            [
                'pm_advancedtopmenu_columns',
                'chosen_groups',
                'text NOT NULL',
                'privacy',
            ],
            [
                'pm_advancedtopmenu_columns_wrap',
                'chosen_groups',
                'text NOT NULL',
                'privacy',
            ],
            [
                'pm_advancedtopmenu_elements',
                'chosen_groups',
                'text NOT NULL',
                'privacy',
            ],
            [
                'pm_advancedtopmenu',
                'active_desktop',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_columns',
                'active_desktop',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_columns_wrap',
                'active_desktop',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu_elements',
                'active_desktop',
                "tinyint(4)  NOT NULL DEFAULT '1'",
                'active',
            ],
            [
                'pm_advancedtopmenu',
                'id_specific_page',
                'varchar(64)  NOT NULL',
                'id_manufacturer',
            ],
            [
                'pm_advancedtopmenu_columns',
                'id_specific_page',
                'varchar(64)  NOT NULL',
                'id_manufacturer',
            ],
            [
                'pm_advancedtopmenu_elements',
                'id_specific_page',
                'varchar(64)  NOT NULL',
                'id_manufacturer',
            ],
            [
                'pm_advancedtopmenu',
                'id_cms_category',
                "int(10) unsigned NOT NULL DEFAULT '0'",
                'id_cms',
            ],
            [
                'pm_advancedtopmenu_columns',
                'id_cms_category',
                "int(10) unsigned NOT NULL DEFAULT '0'",
                'id_cms',
            ],
            [
                'pm_advancedtopmenu_elements',
                'id_cms_category',
                "int(10) unsigned NOT NULL DEFAULT '0'",
                'id_cms',
            ],
            [
                'pm_advancedtopmenu_lang',
                'image_class',
                'varchar(255) NULL',
                'image_legend',
            ],
            [
                'pm_advancedtopmenu_columns_lang',
                'image_class',
                'varchar(255) NULL',
                'image_legend',
            ],
            [
                'pm_advancedtopmenu_elements_lang',
                'image_class',
                'varchar(255) NULL',
                'image_legend',
            ],
            [
                'pm_advancedtopmenu_columns',
                'prevent_obfuscate',
                'tinyint(4) NOT NULL DEFAULT \'0\'',
                'target',
            ],
            [
                'pm_advancedtopmenu_elements',
                'prevent_obfuscate',
                'tinyint(4) NOT NULL DEFAULT \'0\'',
                'target',
            ],
        ];
        foreach ($toUpdate as $infos) {
            if (!$this->columnExists($infos[0], $infos[1], $updateDb, $infos[2], $infos[3])) {
                $isUpdate = false;
            }
        }
        $languages = Language::getLanguages(false);
        $iconsDatabaseUpdate = [
            [
                'pm_advancedtopmenu',
                'id_menu',
                'menu_icons',
            ],
            [
                'pm_advancedtopmenu_columns',
                'id_column',
                'column_icons',
            ],
            [
                'pm_advancedtopmenu_elements',
                'id_element',
                'element_icons',
            ],
        ];
        foreach ($iconsDatabaseUpdate as $iconsUpdateRow) {
            if ($this->columnExists($iconsUpdateRow[0], 'have_icon') && $this->columnExists($iconsUpdateRow[0] . '_lang', 'have_icon')) {
                $res = true;
                $imageList = Db::getInstance()->ExecuteS('SELECT `' . $iconsUpdateRow[1] . '`, `have_icon`, `image_type` FROM `' . _DB_PREFIX_ . $iconsUpdateRow[0] . '`');
                if (self::isFilledArray($imageList)) {
                    foreach ($imageList as $imageRow) {
                        $res &= Db::getInstance()->Execute('UPDATE `' . _DB_PREFIX_ . $iconsUpdateRow[0] . '_lang` SET `have_icon`="' . (int)$imageRow['have_icon'] . '", `image_type`="' . pSQL($imageRow['image_type']) . '" WHERE `' . $iconsUpdateRow[1] . '`="' . (int)$imageRow[$iconsUpdateRow[1]] . '"');
                        if (is_writable(dirname(__FILE__) . '/' . $iconsUpdateRow[2])) {
                            $imgPath = dirname(__FILE__) . '/' . $iconsUpdateRow[2] . '/' . (int)$imageRow[$iconsUpdateRow[1]] . '.' . $imageRow['image_type'];
                        }
                        if (isset($imgPath) && file_exists($imgPath) && is_readable($imgPath)) {
                            foreach ($languages as $language) {
                                $imgPathLang = dirname(__FILE__) . '/' . $iconsUpdateRow[2] . '/' . (int)$imageRow[$iconsUpdateRow[1]] . '-' . $language['iso_code'] . '.' . $imageRow['image_type'];
                                file_put_contents($imgPathLang, Tools::file_get_contents($imgPath));
                            }
                        }
                    }
                }
                if ($res) {
                    $res &= Db::getInstance()->Execute('ALTER TABLE `' . _DB_PREFIX_ . $iconsUpdateRow[0] . '` DROP COLUMN `have_icon`, DROP COLUMN `image_type`');
                }
            }
        }
        $toChange = [
            [
                'pm_advancedtopmenu',
                'fnd_color_menu_tab',
                'varchar(15)',
            ],
            [
                'pm_advancedtopmenu',
                'fnd_color_menu_tab_over',
                'varchar(15)',
            ],
            [
                'pm_advancedtopmenu',
                'fnd_color_submenu',
                'varchar(15)',
            ],
            [
                'pm_advancedtopmenu_columns_wrap',
                'bg_color',
                'varchar(15)',
            ],
        ];
        foreach ($toChange as $infos) {
            $resultset = Db::getInstance()->ExecuteS('SHOW COLUMNS FROM `' . _DB_PREFIX_ . $infos[0] . "` WHERE `Field` = '" . $infos[1] . "'", true, false);
            foreach ($resultset as $row) {
                if ($row['Type'] != $infos[2]) {
                    $isUpdate = false;
                    if ($updateDb) {
                        Db::getInstance()->Execute('ALTER TABLE `' . _DB_PREFIX_ . $infos[0] . '` CHANGE `' . $infos[1] . '` `' . $infos[1] . '` ' . $infos[2] . '');
                    }
                }
            }
        }
        if ($updateDb) {
            $this->installDefaultConfig();
            if (Configuration::get('ATM_LAST_VERSION') && version_compare(Configuration::get('ATM_LAST_VERSION'), '1.9.8', '<=')) {
                if (Shop::isFeatureActive()) {
                    foreach (Shop::getShops(true, null, true) as $id_shop) {
                        Configuration::updateValue('ATM_MENU_PADDING', '0 10px 0 10px', false, null, $id_shop);
                    }
                } else {
                    Configuration::updateValue('ATM_MENU_PADDING', '0 10px 0 10px');
                }
            }
            Configuration::updateValue('ATM_LAST_VERSION', $this->version);
            if (Shop::isFeatureActive()) {
                foreach (Shop::getShops(true, null, true) as $id_shop) {
                    $this->generateGlobalCss($id_shop);
                }
            } else {
                $this->generateGlobalCss();
            }
            $this->generateCss();
            $this->clearModuleCache();
        }
        return $isUpdate;
    }
    protected function checkPermissions()
    {
        $verifs = [
            dirname(__FILE__) . '/views/css',
            dirname(__FILE__) . '/column_icons',
            dirname(__FILE__) . '/menu_icons',
            dirname(__FILE__) . '/element_icons',
        ];
        if (defined('_PS_CACHE_DIR_')) {
            $verifs[] = _PS_CACHE_DIR_;
        } else {
            $verifs[] = dirname(__FILE__) . '/../../cache/smarty/cache';
        }
        $errors = [];
        foreach ($verifs as $fileOrDir) {
            if (!is_writable($fileOrDir)) {
                $errors[] = $fileOrDir;
            }
        }
        return $errors;
    }
    public function resetInstall()
    {
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_lang`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_wrap`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_wrap_lang`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_lang`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang`');
        if (!file_exists(dirname(__FILE__) . '/' . self::INSTALL_SQL_FILE)) {
            return false;
        } elseif (!$sql = Tools::file_get_contents(dirname(__FILE__) . '/' . self::INSTALL_SQL_FILE)) {
            return false;
        }
        $sql = str_replace('PREFIX_', _DB_PREFIX_, $sql);
        $sql = preg_split("/;\s*[\r\n]+/", $sql);
        foreach ($sql as $query) {
            if (!Db::getInstance()->Execute(trim($query))) {
                return false;
            }
        }
        return true;
    }
    protected function saveConfig()
    {
        if (Tools::isSubmit('submitATMOptions') || Tools::isSubmit('submitATMMobileOptions') || Tools::isSubmit('submitAdvancedConfig')) {
            foreach ($this->_fieldsOptions as $key => $field) {
                if (Tools::isSubmit('submitATMMobileOptions') && (!isset($field['mobile']) || (isset($field['mobile']) && !$field['mobile']))) {
                    continue;
                } elseif (Tools::isSubmit('submitAdvancedConfig') && (!isset($field['advanced']) || (isset($field['advanced']) && !$field['advanced']))) {
                    continue;
                } elseif (Tools::isSubmit('submitATMOptions') && ((isset($field['mobile']) && $field['mobile']) || (isset($field['advanced']) && $field['advanced']))) {
                    continue;
                }
                if ($field['type'] == '4size' || $field['type'] == 'shadow') {
                    Configuration::updateValue($key, $this->getBorderSizeFromArray(Tools::getValue($key)));
                } elseif ($field['type'] == '4size_position') {
                    Configuration::updateValue($key, $this->getPositionSizeFromArray(Tools::getValue($key), false));
                } elseif ($field['type'] == 'gradient') {
                    $gradientValue = Tools::getValue($key);
                    $newValue = $gradientValue[0] . (Tools::getValue($key . '_gradient') && isset($gradientValue[1]) && $gradientValue[1] ? $this->gradient_separator . $gradientValue[1] : '');
                    Configuration::updateValue($key, $newValue);
                } elseif ($field['type'] == 'textLang') {
                    $languages = Language::getLanguages(false);
                    $list = [];
                    foreach ($languages as $language) {
                        $list[(int)$language['id_lang']] = (isset($field['cast']) ? $field['cast'](Tools::getValue($key . '_' . $language['id_lang'])) : Tools::getValue($key . '_' . $language['id_lang']));
                    }
                    Configuration::updateValue($key, $list);
                } elseif ($field['type'] == 'image') {
                    if (isset($_FILES[$key]) && is_array($_FILES[$key]) && isset($_FILES[$key]['size']) && $_FILES[$key]['size'] > 0 && isset($_FILES[$key]['tmp_name']) && isset($_FILES[$key]['error']) && !$_FILES[$key]['error'] && file_exists($_FILES[$key]['tmp_name']) && filesize($_FILES[$key]['tmp_name']) > 0) {
                        $val = 'data:' . (isset($_FILES[$key]['type']) && !empty($_FILES[$key]['type']) && preg_match('/image/', $_FILES[$key]['type']) ? $_FILES[$key]['type'] : 'image/jpg') . ';base64,' . self::getDataSerialized(Tools::file_get_contents($_FILES[$key]['tmp_name']));
                        Configuration::updateValue($key, $val);
                    } elseif (Configuration::get($key) === false && !Tools::getValue($key . '_delete')) {
                        Configuration::updateValue($key, $field['default']);
                    }
                    if (Tools::getValue($key . '_delete')) {
                        Configuration::updateValue($key, '');
                    }
                } else {
                    if (Tools::isSubmit('submitATMMobileOptions') && $key == 'ATM_RESP_TOGGLE_ENABLED' && !Tools::getIsset('ATM_RESP_TOGGLE_ENABLED')) {
                        $value = (isset($field['cast']) ? $field['cast']($field['default']) : $field['default']);
                    } elseif (Tools::isSubmit('submitAdvancedConfig') && $key == 'ATM_MENU_HAMBURGER_SELECTORS' && !Tools::getIsset('ATM_MENU_HAMBURGER_SELECTORS')) {
                        $value = (isset($field['cast']) ? $field['cast']($field['default']) : $field['default']);
                    } else {
                        $value = (isset($field['cast']) ? $field['cast'](Tools::getValue($key)) : Tools::getValue($key));
                    }
                    Configuration::updateValue($key, $value);
                }
            }
            if (Shop::isFeatureActive()) {
                foreach (Shop::getShops(true, null, true) as $id_shop) {
                    $this->generateGlobalCss($id_shop);
                }
            } else {
                $this->generateGlobalCss();
            }
            $this->generateCss();
            $this->clearModuleCache();
            $this->context->controller->confirmations[] = $this->l('Configuration updated successfully');
        }
    }
    protected function saveAdvancedConfig()
    {
        if (Tools::isSubmit('submitAdvancedConfig')) {
            $contextShops = array_values(Shop::getContextListShopID());
            $error = false;
            foreach ($contextShops as $id_shop) {
                $advanced_css_file_shop = str_replace('.css', '-' . $id_shop . '.css', dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE);
                if (!file_put_contents($advanced_css_file_shop, Tools::getValue('advancedConfig'))) {
                    $error = $this->l('Error while saving advanced styles');
                }
            }
            if ($error) {
                $this->context->controller->errors[] = $error;
            } else {
                $this->context->controller->confirmations[] = $this->l('Styles updated successfully');
            }
        }
    }
    public function getContent()
    {
        $this->initClassVar();
        if (Tools::getValue('makeUpdate')) {
            $this->checkIfModuleIsUpdate(true);
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules') . '&configure=' . $this->name . '&updateDone=1');
        } elseif (Tools::getValue('updateDone')) {
            $this->context->controller->confirmations[] = $this->l('Module updated successfully');
        }
        $moduleIsUpToDate = $this->checkIfModuleIsUpdate(false);
        if (!$moduleIsUpToDate) {
            return $this->fetchTemplate('module/new_version.tpl', ['css_js_assets' => $this->includeAdminCssJs()]);
        }
        $permissionsErrors = $this->checkPermissions();
        if (!empty($permissionsErrors)) {
            $this->context->controller->warnings[] = $this->l('Before being able to configure the module, make sure to set write permissions to files and folders listed below:');
            $this->context->controller->warnings[] = implode(nl2br("\n"), $permissionsErrors);
        }
        $isNativeMenuModuleEnabled = $this->nativeMenuModuleIsEnabled();
        $nativeMenuModuleDisplayName = $this->getNativeMenuModuleDisplayName();
        if ($isNativeMenuModuleEnabled) {
            $this->context->controller->warnings[] = sprintf($this->l('We\'ve detected that the native menu module “%s“ is enabled. In order to avoid having 2 menus displayed at the same time, we recommend to disable it'), $nativeMenuModuleDisplayName);
        }
        if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP) {
            $this->context->controller->warnings[] = $this->l('Configuration can not be different by shop. It will be applied to all shop. However, you can create a menu for a particular shop.');
        }
        $vars = [
            'module_display_name' => $this->displayName,
            'module_is_up_to_date' => $moduleIsUpToDate,
            'permissions_errors' => $permissionsErrors,
            'context_is_shop' => (Shop::getContext() == Shop::CONTEXT_SHOP),
            'css_js_assets' => $this->includeAdminCssJs(),
            'rating_invite' => $this->showRating(true),
        ];
        if (!count($permissionsErrors)) {
            $this->postProcess();
            $vars['display_maintenance'] = $this->displayMaintenanceZone();
            $vars['display_form'] = $this->displayMenuForm();
            $vars['display_config'] = $this->displayConfig();
            $vars['display_mobile_config'] = $this->displayMobileConfig();
            $vars['display_advanced_styles'] = $this->displayAdvancedConfig();
        }
        $isInMaintenance = (int)Configuration::get('PM_' . self::$_module_prefix . '_MAINTENANCE');
        if ($isInMaintenance) {
            $this->context->controller->warnings[] = $this->l('The module is currently running in Maintenance Mode.');
        }
        return $this->fetchTemplate('module/content.tpl', $vars);
    }
    protected function nativeMenuModuleIsEnabled()
    {
        return Module::isEnabled('ps_mainmenu');
    }
    protected function getNativeMenuModuleDisplayName()
    {
        $psMainMenuModule = Module::getInstanceByName('ps_mainmenu');
        if (!empty($psMainMenuModule->displayName)) {
            return $psMainMenuModule->displayName;
        }
        return null;
    }
    protected function displayAdvancedConfig()
    {
        $id_shop = (int)$this->context->shop->id;
        $advanced_css_file = str_replace('.css', '-' . $id_shop . '.css', dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE);
        if (!file_exists($advanced_css_file)) {
            file_put_contents($advanced_css_file, Tools::file_get_contents(dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE_RESTORE));
        }
        $fieldsOptions = $this->_fieldsOptions;
        foreach ($fieldsOptions as $key => $field) {
            if (!isset($field['advanced']) || isset($field['advanced']) && !$field['advanced']) {
                unset($fieldsOptions[$key]);
            }
        }
        $vars = [
            'fieldsOptions' => $fieldsOptions,
            'advancedStylesContent' => Tools::file_get_contents($advanced_css_file),
        ];
        return $this->fetchTemplate('module/tabs/display_advanced_styles.tpl', $vars);
    }
    protected function includeAdminCssJs()
    {
        $this->context->controller->addJquery();
        $this->context->controller->addJqueryPlugin('colorpicker');
        $this->context->controller->addJqueryPlugin(['autocomplete']);
        $this->context->controller->addJS(__PS_BASE_URI__ . 'js/admin/tinymce.inc.js');
        $this->context->controller->addJS(__PS_BASE_URI__ . 'js/tiny_mce/tiny_mce.js');
        $this->context->controller->addJS($this->_path . 'views/js/pm_tinymce.inc.js');
        $this->context->controller->addJS($this->_path . 'views/js/admin.js');
        $this->context->controller->addJS($this->_path . 'views/js/popover.js');
        $this->context->controller->addJS($this->_path . 'views/js/bootstrap-iconpicker.bundle.min.js');
        $this->context->controller->addJS($this->_path . 'views/js/colorpicker/colorpicker.js');
        $this->context->controller->addJS($this->_path . 'views/js/codemirror/codemirror.js');
        $this->context->controller->addJS($this->_path . 'views/js/codemirror/css.js');
        $this->context->controller->addJS($this->_path . 'views/js/jquery.tipTip.js');
        $this->context->controller->addCSS($this->_path . 'views/css/admin.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/popover.css', 'all');
        $this->context->controller->addCSS('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css', 'all');
        $this->context->controller->addCSS('https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/bootstrap-iconpicker.min.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/custom-font.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/colorpicker/colorpicker.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/codemirror/codemirror.css', 'all');
        $this->context->controller->addCSS($this->_path . 'views/css/codemirror/default.css', 'all');
        $this->context->controller->addJqueryUI(['ui.draggable', 'ui.droppable', 'ui.sortable', 'ui.widget', 'ui.tabs'], '../../../../modules/' . $this->name . '/views/css/jquery-ui-theme');
        return $this->fetchTemplate('module/javascript.tpl', [
            'isoTinyMCE' => (file_exists(_PS_ROOT_DIR_ . '/js/tiny_mce/langs/' . $this->_iso_lang . '.js') ? $this->_iso_lang : 'en'),
            'ad' => dirname($_SERVER['PHP_SELF']),
            'idLang' => $this->context->cookie->id_lang,
            'defaultLanguage' => $this->defaultLanguage,
            'baseConfigUrl' => $this->base_config_url,
            'searchAnIcon' => $this->l('Search an icon'),
        ]);
    }
    protected function displayConfig()
    {
        if (!isset($this->_fieldsOptions) or !count($this->_fieldsOptions)) {
            return;
        }
        $fieldsOptions = $this->_fieldsOptions;
        foreach ($fieldsOptions as $key => $field) {
            if (isset($field['mobile']) && $field['mobile'] || isset($field['advanced']) && $field['advanced']) {
                unset($fieldsOptions[$key]);
            }
        }
        $vars = [
            'fieldsOptions' => $fieldsOptions,
        ];
        return $this->fetchTemplate('module/tabs/display_config.tpl', $vars);
    }
    protected function displayMobileConfig()
    {
        if (!isset($this->_fieldsOptions) or !count($this->_fieldsOptions)) {
            return;
        }
        $fieldsOptions = $this->_fieldsOptions;
        foreach ($fieldsOptions as $key => $field) {
            if (!isset($field['mobile']) || isset($field['mobile']) && !$field['mobile']) {
                unset($fieldsOptions[$key]);
            }
        }
        $vars = [
            'fieldsOptions' => $fieldsOptions,
        ];
        return $this->fetchTemplate('module/tabs/display_mobile_config.tpl', $vars);
    }
    public function outputFormItem($key, $field)
    {
        $languages = Language::getLanguages(false);
        $val = Tools::getValue($key, Configuration::get($key));
        $field['title'] = html_entity_decode($field['title']);
        $vars = [
            'val' => $val,
            'key' => $key,
            'field' => $field,
        ];
        switch ($field['type']) {
            case 'select':
                foreach ($field['list'] as &$value) {
                    $value[$field['identifier']] = (isset($field['cast']) ? $field['cast']($value[$field['identifier']]) : $value[$field['identifier']]);
                    $value['is_selected'] = (($val === false && isset($field['default']) && $field['default'] === $value[$field['identifier']]) || ($val == $value[$field['identifier']]));
                }
                $vars['field'] = $field;
                return $this->fetchTemplate('core/form/select.tpl', $vars);
            case 'bool':
                return $this->fetchTemplate('core/form/bool.tpl', $vars);
            case 'textLang':
                $vars['values'] = [];
                foreach ($languages as $language) {
                    $vars['lang_values'][(int)$language['id_lang']] = Tools::getValue($key . '_' . (int)$language['id_lang'], Configuration::get($key, (int)$language['id_lang']));
                }
                return $this->fetchTemplate('core/form/input_text_lang.tpl', $vars);
            case 'color':
                return $this->fetchTemplate('core/form/input_color.tpl', $vars);
            case 'gradient':
                if (!is_array($val)) {
                    $val = explode($this->gradient_separator, $val);
                }
                $vars['color1'] = $val[0];
                $vars['color2'] = null;
                if (isset($val[1])) {
                    $vars['color2'] = $val[1];
                }
                return $this->fetchTemplate('core/form/input_gradient_color.tpl', $vars);
            case '4size':
                $vars['borders_size_tab'] = null;
                if ($val || (isset($field['default']) && $field['default'])) {
                    $borders_size_tab = ($val !== false ? $val : $field['default']);
                    if (!is_array($borders_size_tab)) {
                        $borders_size_tab = explode(' ', $borders_size_tab);
                    }
                    if (is_array($borders_size_tab)) {
                        foreach ($borders_size_tab as &$borderValue) {
                            if ($borderValue == '' || $borderValue == 'unset') {
                                $borderValue = '';
                            } elseif ($borderValue != 'auto') {
                                $borderValue = (int)preg_replace('#px#', '', $borderValue);
                            }
                        }
                    }
                    $vars['borders_size_tab'] = $borders_size_tab;
                }
                return $this->fetchTemplate('core/form/input_4size.tpl', $vars);
            case '4size_position':
                $vars['borders_size_tab'] = null;
                if ($val || (isset($field['default']) && $field['default'])) {
                    $borders_size_tab = ($val !== false ? $val : $field['default']);
                    if (!is_array($borders_size_tab)) {
                        $borders_size_tab = explode(' ', $borders_size_tab);
                    }
                    if (is_array($borders_size_tab)) {
                        foreach ($borders_size_tab as &$borderValue) {
                            if (Tools::strlen($borderValue)) {
                                $borderValue = (int)preg_replace('#px#', '', $borderValue);
                            } else {
                                $borderValue = '';
                            }
                        }
                    }
                    $vars['borders_size_tab'] = $borders_size_tab;
                }
                return $this->fetchTemplate('core/form/input_4size_position.tpl', $vars);
            case 'image':
                return $this->fetchTemplate('core/form/input_image.tpl', $vars);
            case 'shadow':
                $vars['borders_size_tab'] = null;
                if ($val || (isset($field['default']) && $field['default'])) {
                    $borders_size_tab = ($val !== false ? $val : @$field['default']);
                    if (!is_array($borders_size_tab)) {
                        $borders_size_tab = explode(' ', $borders_size_tab);
                    }
                    if (is_array($borders_size_tab)) {
                        foreach ($borders_size_tab as &$borderValue) {
                            if (Tools::strlen($borderValue)) {
                                $borderValue = (int)preg_replace('#px#', '', $borderValue);
                            } else {
                                $borderValue = 0;
                            }
                        }
                    }
                    $vars['borders_size_tab'] = $borders_size_tab;
                }
                return $this->fetchTemplate('core/form/input_shadow.tpl', $vars);
            case 'slider':
                return $this->fetchTemplate('core/form/slider.tpl', $vars);
            case 'text':
            default:
                return $this->fetchTemplate('core/form/input_text.tpl', $vars);
        }
    }
    protected function initClassVar()
    {
        if (defined('_PS_ADMIN_DIR_')) {
            $this->base_config_url = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules');
        }
        $languages = Language::getLanguages(false);
        $this->defaultLanguage = (int)Configuration::get('PS_LANG_DEFAULT');
        $this->_iso_lang = !empty($this->context->cookie->id_lang) ? Language::getIsoById($this->context->cookie->id_lang) : Language::getIsoById($this->defaultLanguage);
        $this->languages = $languages;
    }
    protected function displayMenuForm()
    {
        $this->initClassVar();
        $menus = AdvancedTopMenuClass::getMenus($this->context->cookie->id_lang, false);
        if (is_array($menus) && count($menus)) {
            foreach ($menus as &$menu) {
                $menu['columnsWrap'] = AdvancedTopMenuColumnWrapClass::getMenuColumnsWrap($menu['id_menu'], $this->context->cookie->id_lang, false);
                if (count($menu['columnsWrap'])) {
                    foreach ($menu['columnsWrap'] as &$columnWrap) {
                        $columnWrap['columns'] = AdvancedTopMenuColumnClass::getMenuColums($columnWrap['id_wrap'], $this->context->cookie->id_lang, false);
                        if (count($columnWrap['columns'])) {
                            foreach ($columnWrap['columns'] as &$column) {
                                $column['columnElements'] = AdvancedTopMenuElementsClass::getMenuColumnElements($column['id_column'], $this->context->cookie->id_lang, false);
                                if ($column['type'] == 8) {
                                    $productInfos = AdvancedTopMenuProductColumnClass::getByIdColumn($column['id_column']);
                                    if (Validate::isLoadedObject($productInfos)) {
                                        $productObj = new Product($productInfos->id_product, false, $this->context->cookie->id_lang);
                                        if (Validate::isLoadedObject($productObj)) {
                                            $column['productObj'] = $productObj;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $cms = CMS::listCms((int)$this->context->cookie->id_lang);
        $cmsNestedCategories = $this->getNestedCmsCategories((int)$this->context->cookie->id_lang);
        $manufacturer = Manufacturer::getManufacturers(false, $this->context->cookie->id_lang, true);
        $supplier = Supplier::getSuppliers(false, $this->context->cookie->id_lang, true);
        $cmsCategories = [];
        foreach ($cmsNestedCategories as $cmsCategory) {
            $cmsCategory['level_depth'] = (int)$cmsCategory['level_depth'];
            $cmsCategories[] = $cmsCategory;
            $this->getChildrenCmsCategories($cmsCategories, $cmsCategory, null);
        }
        $alreadyDefinedCurrentIdMenu = $this->context->smarty->getTemplateVars('current_id_menu');
        if (empty($alreadyDefinedCurrentIdMenu)) {
            $currentIdMenu = Tools::getValue('id_menu', false);
        } else {
            $currentIdMenu = $alreadyDefinedCurrentIdMenu;
        }
        $vars = [
            'menus' => $menus,
            'current_id_menu' => $currentIdMenu,
            'displayTabElement' => (!Tools::getValue('editColumnWrap') && !Tools::getValue('editColumn') && !Tools::getValue('editElement')),
            'displayColumnElement' => (!Tools::getValue('editMenu') && !Tools::getValue('editColumn') && !Tools::getValue('editElement')),
            'displayGroupElement' => (!Tools::getValue('editMenu') && !Tools::getValue('editColumnWrap') && !Tools::getValue('editElement')),
            'displayItemElement' => (!Tools::getValue('editMenu') && !Tools::getValue('editColumnWrap') && !Tools::getValue('editColumn')),
            'editMenu' => (Tools::getValue('editMenu') && Tools::getValue('id_menu')),
            'editColumn' => (Tools::getValue('editColumnWrap') && Tools::getValue('id_wrap')),
            'editGroup' => (Tools::getValue('editColumn') && Tools::getValue('id_column')),
            'editElement' => (Tools::getValue('editElement') && Tools::getValue('id_element')),
            'cms' => $cms,
            'cmsCategories' => $cmsCategories,
            'manufacturer' => $manufacturer,
            'supplier' => $supplier,
        ];
        $ObjAdvancedTopMenuClass = false;
        $ObjAdvancedTopMenuColumnWrapClass = false;
        $ObjAdvancedTopMenuColumnClass = false;
        $ObjAdvancedTopMenuProductColumnClass = new AdvancedTopMenuProductColumnClass();
        $ObjAdvancedTopMenuElementsClass = false;
        if (!Tools::getValue('editColumnWrap') && !Tools::getValue('editColumn') && !Tools::getValue('editElement')) {
            if (Tools::getValue('editMenu') && Tools::getValue('id_menu')) {
                $ObjAdvancedTopMenuClass = new AdvancedTopMenuClass(Tools::getValue('id_menu'));
            }
        }
        if (!Tools::getValue('editMenu') && !Tools::getValue('editColumn') && !Tools::getValue('editElement')) {
            if (Tools::getValue('editColumnWrap') && Tools::getValue('id_wrap')) {
                $ObjAdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass(Tools::getValue('id_wrap'));
            }
        }
        if (!Tools::getValue('editMenu') && !Tools::getValue('editColumnWrap') && !Tools::getValue('editElement')) {
            if (Tools::getValue('editColumn') && Tools::getValue('id_column')) {
                $ObjAdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass(Tools::getValue('id_column'));
                $ObjAdvancedTopMenuProductColumnClass = AdvancedTopMenuProductColumnClass::getByIdColumn(Tools::getValue('id_column'));
            }
        }
        if (!Tools::getValue('editMenu') && !Tools::getValue('editColumnWrap') && !Tools::getValue('editColumn')) {
            if (Tools::getValue('editElement') && Tools::getValue('id_element')) {
                $ObjAdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass(Tools::getValue('id_element'));
            }
        }
        $vars['ObjAdvancedTopMenuClass'] = $ObjAdvancedTopMenuClass;
        $vars['ObjAdvancedTopMenuColumnWrapClass'] = $ObjAdvancedTopMenuColumnWrapClass;
        $vars['ObjAdvancedTopMenuColumnClass'] = $ObjAdvancedTopMenuColumnClass;
        $vars['ObjAdvancedTopMenuProductColumnClass'] = $ObjAdvancedTopMenuProductColumnClass;
        $vars['ObjAdvancedTopMenuElementsClass'] = $ObjAdvancedTopMenuElementsClass;
        return $this->fetchTemplate('module/tabs/display_form.tpl', $vars);
    }
    public function outputChosenGroups($object)
    {
        $vars = [
            'groups' => Group::getGroups((int)$this->defaultLanguage),
            'object' => $object,
        ];
        return $this->fetchTemplate('module/form_components/chosen_groups.tpl', $vars);
    }
    public function outputMenuForm($ObjAdvancedTopMenuClass)
    {
        $imgIconMenuDirIsWritable = is_writable(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/menu_icons');
        $haveDepend = false;
        $ids_lang = 'menuname¤menulink¤menu_value_over¤menu_value_under¤menuimage¤menuimagelegend¤iconPickingButton';
        if ($ObjAdvancedTopMenuClass) {
            $haveDepend = AdvancedTopMenuClass::menuHaveDepend($ObjAdvancedTopMenuClass->id);
        }
        $vars = [
            'ids_lang' => $ids_lang,
            'ObjAdvancedTopMenuClass' => $ObjAdvancedTopMenuClass,
            'rebuildable_type' => $this->rebuildable_type,
            'haveDepend' => $haveDepend,
            'imgIconMenuDirIsWritable' => $imgIconMenuDirIsWritable,
            'moduleRootDirectory' => _PS_ROOT_DIR_ . '/modules/' . $this->name,
        ];
        $vars['fnd_color_menu_tab_color1'] = false;
        $vars['fnd_color_menu_tab_color2'] = false;
        if ($ObjAdvancedTopMenuClass && $ObjAdvancedTopMenuClass->fnd_color_menu_tab) {
            $val = explode($this->gradient_separator, $ObjAdvancedTopMenuClass->fnd_color_menu_tab);
            $vars['fnd_color_menu_tab_color1'] = $val[0];
            if (isset($val[1])) {
                $vars['fnd_color_menu_tab_color2'] = $val[1];
            }
        }
        $vars['fnd_color_menu_tab_over_color1'] = false;
        $vars['fnd_color_menu_tab_over_color2'] = false;
        if ($ObjAdvancedTopMenuClass && $ObjAdvancedTopMenuClass->fnd_color_menu_tab_over) {
            $val = explode($this->gradient_separator, $ObjAdvancedTopMenuClass->fnd_color_menu_tab_over);
            $vars['fnd_color_menu_tab_over_color1'] = $val[0];
            if (isset($val[1])) {
                $vars['fnd_color_menu_tab_over_color2'] = $val[1];
            }
        }
        $vars['borders_size_tab'] = null;
        if ($ObjAdvancedTopMenuClass) {
            $vars['borders_size_tab'] = explode(' ', $ObjAdvancedTopMenuClass->border_size_tab);
            if (is_array($vars['borders_size_tab'])) {
                foreach ($vars['borders_size_tab'] as &$borderValue) {
                    $borderValue = (int)preg_replace('#px#', '', $borderValue);
                }
            }
        }
        $vars['fnd_color_submenu_color1'] = false;
        $vars['fnd_color_submenu_color2'] = false;
        if ($ObjAdvancedTopMenuClass && $ObjAdvancedTopMenuClass->fnd_color_submenu) {
            $val = explode($this->gradient_separator, $ObjAdvancedTopMenuClass->fnd_color_submenu);
            $vars['fnd_color_submenu_color1'] = $val[0];
            if (isset($val[1])) {
                $vars['fnd_color_submenu_color2'] = $val[1];
            }
        }
        $vars['borders_size_submenu'] = null;
        if ($ObjAdvancedTopMenuClass) {
            $vars['borders_size_submenu'] = explode(' ', $ObjAdvancedTopMenuClass->border_size_submenu);
            if (is_array($vars['borders_size_submenu'])) {
                foreach ($vars['borders_size_submenu'] as &$borderValue) {
                    $borderValue = (int)preg_replace('#px#', '', $borderValue);
                }
            }
        }
        $vars['hasAdditionnalText'] = false;
        foreach ($this->languages as $language) {
            if ($ObjAdvancedTopMenuClass && isset($ObjAdvancedTopMenuClass->value_over[$language['id_lang']]) && !empty($ObjAdvancedTopMenuClass->value_over[$language['id_lang']]) || isset($ObjAdvancedTopMenuClass->value_under[$language['id_lang']]) && !empty($ObjAdvancedTopMenuClass->value_under[$language['id_lang']])) {
                $vars['hasAdditionnalText'] = true;
                break;
            }
        }
        return $this->fetchTemplate('module/tabs/display_menu_form.tpl', $vars);
    }
    public function outputColumnWrapForm($menus, $ObjAdvancedTopMenuColumnWrapClass)
    {
        $ids_lang = 'columnwrap_value_over¤columnwrap_value_under';
        $vars = [
            'ids_lang' => $ids_lang,
            'menus' => $menus,
            'ObjAdvancedTopMenuColumnWrapClass' => $ObjAdvancedTopMenuColumnWrapClass,
        ];
        $vars['bg_color_color1'] = false;
        $vars['bg_color_color2'] = false;
        if ($ObjAdvancedTopMenuColumnWrapClass && $ObjAdvancedTopMenuColumnWrapClass->bg_color) {
            $val = explode($this->gradient_separator, $ObjAdvancedTopMenuColumnWrapClass->bg_color);
            $vars['bg_color_color1'] = $val[0];
            if (isset($val[1])) {
                $vars['bg_color_color2'] = $val[1];
            }
        }
        $vars['hasAdditionnalText'] = false;
        foreach ($this->languages as $language) {
            if (isset($ObjAdvancedTopMenuColumnWrapClass->value_over[$language['id_lang']]) && !empty($ObjAdvancedTopMenuColumnWrapClass->value_over[$language['id_lang']]) || isset($ObjAdvancedTopMenuColumnWrapClass->value_under[$language['id_lang']]) && !empty($ObjAdvancedTopMenuColumnWrapClass->value_under[$language['id_lang']])) {
                $vars['hasAdditionnalText'] = true;
                break;
            }
        }
        return $this->fetchTemplate('module/tabs/display_columnwrap_form.tpl', $vars);
    }
    public function outputColumnForm($menus, $cms, $manufacturer, $supplier, $ObjAdvancedTopMenuColumnClass, $ObjAdvancedTopMenuProductColumnClass)
    {
        $ids_lang = 'columnname¤columnlink¤column_value_over¤column_value_under¤columnimage¤columnimagelegend¤iconPickingButton';
        $imgIconColumnDirIsWritable = is_writable(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/column_icons');
        $haveDepend = false;
        if ($ObjAdvancedTopMenuColumnClass) {
            $haveDepend = AdvancedTopMenuColumnClass::columnHaveDepend($ObjAdvancedTopMenuColumnClass->id);
        }
        $currentProductName = 'N/A';
        if ($ObjAdvancedTopMenuProductColumnClass && isset($ObjAdvancedTopMenuProductColumnClass->id_product) && $ObjAdvancedTopMenuProductColumnClass->id_product) {
            $productObj = new Product($ObjAdvancedTopMenuProductColumnClass->id_product, false, $this->context->cookie->id_lang);
            if (Validate::isLoadedObject($productObj)) {
                $currentProductName = $productObj->name;
            }
        }
        $hasAdditionnalText = false;
        foreach ($this->languages as $language) {
            if (isset($ObjAdvancedTopMenuColumnClass->value_over[$language['id_lang']]) && !empty($ObjAdvancedTopMenuColumnClass->value_over[$language['id_lang']]) || isset($ObjAdvancedTopMenuColumnClass->value_under[$language['id_lang']]) && !empty($ObjAdvancedTopMenuColumnClass->value_under[$language['id_lang']])) {
                $hasAdditionnalText = true;
                break;
            }
        }
        $vars = [
            'ids_lang' => $ids_lang,
            'haveDepend' => $haveDepend,
            'imgIconColumnDirIsWritable' => $imgIconColumnDirIsWritable,
            'moduleRootDirectory' => _PS_ROOT_DIR_ . '/modules/' . $this->name,
            'menus' => $menus,
            'cms' => $cms,
            'manufacturer' => $manufacturer,
            'supplier' => $supplier,
            'ObjAdvancedTopMenuColumnClass' => $ObjAdvancedTopMenuColumnClass,
            'ObjAdvancedTopMenuProductColumnClass' => $ObjAdvancedTopMenuProductColumnClass,
            'currentProductName' => $currentProductName,
            'productImagesTypes' => $this->getProductsImagesTypes(),
            'hasAdditionnalText' => $hasAdditionnalText,
            'rebuildable_type' => $this->rebuildable_type,
        ];
        return $this->fetchTemplate('module/tabs/display_column_form.tpl', $vars);
    }
    public function outputElementForm($menus, $cms, $manufacturer, $supplier, $ObjAdvancedTopMenuElementClass)
    {
        $imgIconElementDirIsWritable = is_writable(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/element_icons');
        $ids_lang = 'elementname¤elementlink¤elementimage¤elementimagelegend¤iconPickingButton';
        $vars = [
            'ids_lang' => $ids_lang,
            'imgIconElementDirIsWritable' => $imgIconElementDirIsWritable,
            'moduleRootDirectory' => _PS_ROOT_DIR_ . '/modules/' . $this->name,
            'menus' => $menus,
            'cms' => $cms,
            'manufacturer' => $manufacturer,
            'supplier' => $supplier,
            'ObjAdvancedTopMenuElementClass' => $ObjAdvancedTopMenuElementClass,
        ];
        return $this->fetchTemplate('module/tabs/display_element_form.tpl', $vars);
    }
    protected function getChildrensCategories(&$categoryList, $categoryInformations, $selected, $levelDepth = false)
    {
        if (isset($categoryInformations['children']) && self::isFilledArray($categoryInformations['children'])) {
            foreach ($categoryInformations['children'] as $categoryInformations) {
                $categoryList[] = $categoryInformations;
                $this->getChildrensCategories($categoryList, $categoryInformations, $selected, $levelDepth !== false ? $levelDepth + 1 : $levelDepth);
            }
        }
    }
    protected function getChildrenCmsCategories(&$cmsList, $cmsCategory, $levelDepth = false)
    {
        if (isset($cmsCategory['children']) && self::isFilledArray($cmsCategory['children'])) {
            foreach ($cmsCategory['children'] as $cmsInformation) {
                $cmsInformation['level_depth'] = (int)$cmsInformation['level_depth'];
                $cmsList[] = $cmsInformation;
                $this->getChildrenCmsCategories($cmsList, $cmsInformation, $levelDepth !== false ? $levelDepth + 1 : $levelDepth);
            }
        }
    }
    protected function getNestedCategories($root_category = null, $id_lang = false)
    {
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT c.*, cl.*
            FROM `' . _DB_PREFIX_ . 'category` c
            ' . Shop::addSqlAssociation('category', 'c') . '
            LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON c.`id_category` = cl.`id_category`' . Shop::addSqlRestrictionOnLang('cl') . '
            RIGHT JOIN `' . _DB_PREFIX_ . 'category` c2 ON c2.`id_category` = ' . (int)$root_category . ' AND c.`nleft` >= c2.`nleft` AND c.`nright` <= c2.`nright`
            WHERE `id_lang` = ' . (int)$id_lang . '
            ORDER BY c.`level_depth` ASC, category_shop.`position` ASC'
        );
        $categories = [];
        $buff = [];
        foreach ($result as $row) {
            $current = &$buff[$row['id_category']];
            $current = $row;
            if (!$row['active']) {
                $current['name'] .= ' ' . $this->l('(disabled)');
            }
            if ($row['id_category'] == $root_category) {
                $categories[$row['id_category']] = &$current;
            } else {
                $buff[$row['id_parent']]['children'][$row['id_category']] = &$current;
            }
        }
        return $categories;
    }
    protected function getNestedCmsCategories($id_lang)
    {
        $nestedArray = [];
        $cmsCategories = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT cc.*, ccl.*
            FROM `' . _DB_PREFIX_ . 'cms_category` cc
            ' . Shop::addSqlAssociation('cms_category', 'cc') . '
            LEFT JOIN `' . _DB_PREFIX_ . 'cms_category_lang` ccl ON cc.`id_cms_category` = ccl.`id_cms_category`' . Shop::addSqlRestrictionOnLang('ccl') . '
            WHERE ccl.`id_lang` = ' . (int)$id_lang . '
            AND cc.`id_parent` != 0
            ORDER BY cc.`level_depth` ASC, cc.`position` ASC'
        );
        $buff = [];
        foreach ($cmsCategories as $row) {
            $current = &$buff[$row['id_cms_category']];
            $current = $row;
            if (!$row['active']) {
                $current['name'] .= ' ' . $this->l('(disabled)');
            }
            if ((int)$row['id_parent'] == 1) {
                $nestedArray[$row['id_cms_category']] = &$current;
            } else {
                $buff[$row['id_parent']]['children'][$row['id_cms_category']] = &$current;
            }
        }
        return $nestedArray;
    }
    protected function getCmsByCategory($idCategory)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT c.*
            FROM `' . _DB_PREFIX_ . 'cms` c
            ' . Shop::addSqlAssociation('cms', 'c') . '
            WHERE c.`id_cms_category` = ' . (int)$idCategory . '
            AND c.`active` = 1;'
        );
    }
    public function outputCategoriesSelect($object)
    {
        $rootCategoryId = Category::getRootCategory()->id;
        $selected = ($object ? $object->id_category : 0);
        $categoryList = [];
        foreach ($this->getNestedCategories($rootCategoryId, $this->context->cookie->id_lang) as $idCategory => $categoryInformations) {
            if ($rootCategoryId != $idCategory) {
                $categoryList[] = $categoryInformations;
            }
            $this->getChildrensCategories($categoryList, $categoryInformations, $selected);
        }
        $vars = [
            'categoryList' => $categoryList,
            'selected' => $selected,
        ];
        return $this->fetchTemplate('module/form_components/category_select.tpl', $vars);
    }
    public function outputTargetSelect($object)
    {
        $vars = [
            'link_targets' => $this->link_targets,
            'selected' => ($object ? $object->target : 0),
        ];
        return $this->fetchTemplate('module/form_components/target_select.tpl', $vars);
    }
    public function outputCmsCategoriesSelect($cmsCategories, $object)
    {
        $vars = [
            'cmsCategoriesList' => $cmsCategories,
            'selected' => ($object ? $object->id_cms_category : 0),
        ];
        return $this->fetchTemplate('module/form_components/cms_category_select.tpl', $vars);
    }
    public function outputCmsSelect($cmss, $object)
    {
        $vars = [
            'cmsList' => $cmss,
            'selected' => ($object ? $object->id_cms : 0),
        ];
        return $this->fetchTemplate('module/form_components/cms_select.tpl', $vars);
    }
    public function outputManufacturerSelect($manufacturers, $object)
    {
        $vars = [
            'manufacturerList' => $manufacturers,
            'selected' => ($object ? $object->id_manufacturer : 0),
        ];
        return $this->fetchTemplate('module/form_components/manufacturer_select.tpl', $vars);
    }
    public function outputSupplierSelect($suppliers, $object)
    {
        $vars = [
            'supplierList' => $suppliers,
            'selected' => ($object ? $object->id_supplier : 0),
        ];
        return $this->fetchTemplate('module/form_components/supplier_select.tpl', $vars);
    }
    public function outputSpecificPageSelect($object)
    {
        $pages = Meta::getMetasByIdLang((int)$this->context->cookie->id_lang);
        $default_routes = Dispatcher::getInstance()->default_routes;
        foreach ($pages as $p => $page) {
            if (isset($default_routes[$page['page']]) && is_array($default_routes[$page['page']]['keywords']) && count($default_routes[$page['page']]['keywords'])) {
                unset($pages[$p]);
            } elseif (isset($default_routes[$page['page']])) {
                if (empty($page['title'])) {
                    $pages[$p]['title'] = $default_routes[$page['page']]['rule'];
                }
            }
        }
        $vars = [
            'pagesList' => $pages,
            'selected' => ($object ? $object->id_specific_page : 0),
        ];
        return $this->fetchTemplate('module/form_components/specific_page_select.tpl', $vars);
    }
    public function getType($type)
    {
        if ($type == 1) {
            return $this->l('CMS');
        } elseif ($type == 2) {
            return $this->l('Link');
        } elseif ($type == 3) {
            return $this->l('Category');
        } elseif ($type == 4) {
            return $this->l('Manufacturer');
        } elseif ($type == 5) {
            return $this->l('Supplier');
        } elseif ($type == 6) {
            return $this->l('Search');
        } elseif ($type == 7) {
            return $this->l('Only image or icon');
        } elseif ($type == 9) {
            return $this->l('Specific page');
        } elseif ($type == 10) {
            return $this->l('CMS category');
        }
    }
    public function getLinkOutputValue($row, $type, $withExtra = true, $haveSub = false, $first_level = false)
    {
        $link = $this->context->link;
        $return = false;
        $name = false;
        $image_legend = false;
        $icone = false;
        $url = false;
        $linkNotClickable = false;
        if (trim($row['link']) == '#') {
            $linkNotClickable = true;
        }
        $data_type = [
            'type' => null,
            'id' => null,
        ];
        if ($row['type'] == 1) {
            if (trim($row['name'])) {
                $name .= $row['name'];
            } else {
                $name .= $row['meta_title'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            $url .= $link->getCMSLink((int)$row['id_cms'], $row['link_rewrite']);
            $data_type['type'] = 'cms';
            $data_type['id'] = (int)$row['id_cms'];
        } elseif ($row['type'] == 2) {
            if (trim($row['name'])) {
                $name .= $row['name'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            if (trim($row['link'])) {
                $url .= $row['link'];
            } else {
                $linkNotClickable = true;
            }
        } elseif ($row['type'] == 3) {
            if (trim($row['name'])) {
                $name .= $row['name'];
            } else {
                $name .= $row['category_name'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            $url .= $link->getCategoryLink((int)$row['id_category'], $row['category_link_rewrite']);
            $data_type['type'] = 'category';
            $data_type['id'] = (int)$row['id_category'];
        } elseif ($row['type'] == 4) {
            if (trim($row['name'])) {
                $name .= $row['name'];
            } else {
                $name .= $row['manufacturer_name'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            if ((int)$row['id_manufacturer']) {
                $data_type['type'] = 'brands';
                $data_type['id'] = (int)$row['id_manufacturer'];
                $url .= $link->getManufacturerLink((int)$row['id_manufacturer'], Tools::link_rewrite($row['manufacturer_name']));
            } else {
                $data_type['type'] = 'custom';
                $data_type['id'] = 'manufacturer';
                $url .= $link->getPageLink('manufacturer.php');
            }
        } elseif ($row['type'] == 5) {
            if (trim($row['name'])) {
                $name .= $row['name'];
            } else {
                $name .= $row['supplier_name'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            if ((int)$row['id_supplier']) {
                $data_type['type'] = 'supplier';
                $data_type['id'] = (int)$row['id_supplier'];
                $url .= $link->getSupplierLink((int)$row['id_supplier'], Tools::link_rewrite($row['supplier_name']));
            } else {
                $data_type['type'] = 'custom';
                $data_type['id'] = 'supplier';
                $url .= $link->getPageLink('supplier.php');
            }
        } elseif ($row['type'] == 6) {
            $currentSearchQuery = trim(Tools::getValue('search_query', Tools::getValue('s')));
            $this->context->smarty->assign([
                'atm_form_action_link' => $link->getPageLink('search'),
                'atm_search_id' => 'search_query_atm_' . $type . '_' . $row['id_' . $type],
                'atm_have_icon' => trim($row['have_icon']),
                'atm_withExtra' => $withExtra,
                'atm_icon_image_source' => $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg'),
                'atm_search_value' => (Tools::strlen($currentSearchQuery) ? $currentSearchQuery : trim(htmlentities($row['name'], ENT_COMPAT, 'UTF-8'))),
                'atm_is_autocomplete_search' => false,
                'atm_cookie_id_lang' => $this->context->cookie->id_lang,
                'atm_pagelink_search' => $link->getPageLink('search'),
            ]);
            $cache = Configuration::get('ATM_CACHE');
            if (!Configuration::get('PS_SMARTY_CACHE')) {
                $cache = false;
            }
            if ($cache) {
                $adtmCacheId = sprintf('ADTM|%d|%s|%d|%s', $this->context->cookie->id_lang, Validate::isLoadedObject($this->context->customer) && $this->context->customer->isLogged(), Shop::isFeatureActive() ? $this->context->shop->id : 0, implode('-', self::getCustomerGroups()));
                return $this->display(__FILE__, 'views/templates/front/pm_advancedtopmenu_search.tpl', $adtmCacheId);
            }
            return $this->display(__FILE__, 'views/templates/front/pm_advancedtopmenu_search.tpl');
        } elseif ($row['type'] == 7) {
            $name = '';
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
            if (trim($row['link'])) {
                $url .= $row['link'];
            } else {
                $linkNotClickable = true;
            }
        } elseif ($row['type'] == 9) {
            $page = Meta::getMetaByPage($row['id_specific_page'], (int)$this->context->cookie->id_lang);
            $name = (!empty($page['title']) ? $page['title'] : $page['page']);
            if (preg_match('#module-([a-z0-9_-]+)-([a-z0-9]+)$#i', $page['page'], $m)) {
                $url = $link->getModuleLink($m[1], $m[2]);
                $data_type['id'] = '';
            } else {
                $url = $link->getPageLink($page['page']);
                $data_type['id'] = $page['page'];
            }
            $data_type['type'] = 'custom';
            if (trim($row['name'])) {
                $name = $row['name'];
            }
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
        } elseif ($row['type'] == 10) {
            if (trim($row['name'])) {
                $name = $row['name'];
            } else {
                $cmsCategory = new CMSCategory($row['id_cms_category']);
                $cmsCategoryName = $cmsCategory->getName((int)$this->context->cookie->id_lang);
                $name = $cmsCategoryName;
            }
            $data_type['type'] = 'cms-category';
            $data_type['id'] = (int)$row['id_cms_category'];
            $url .= $link->getCMSCategoryLink((int)$row['id_cms_category'], $row['link_rewrite']);
            if ($withExtra && trim($row['have_icon'])) {
                $icone .= $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
            }
        }
        $linkSettings = [
            'tag' => 'a',
            'linkAttribute' => 'href',
            'url' => ($linkNotClickable ? '#' : $url),
            'title' => $name,
            'isNotClickable' => $linkNotClickable,
            'isMultiline' => strpos($name, "\n") !== false,
            'isFirstLevel' => $first_level,
            'data_type' => $data_type,
            'type' => $type,
            'icon' => false,
        ];
        if ($icone) {
            if (in_array($row['image_type'], ['i-fa', 'i-mi'])) {
                if ($row['image_type'] == 'i-mi') {
                    $row['image_class'] = 'zmdi ' . $row['image_class'];
                }
                $linkSettings['icon'] = true;
            } else {
                $iconWidth = $iconHeight = false;
                $iconPath = dirname(__FILE__) . '/' . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg');
                if (file_exists($iconPath) && is_readable($iconPath)) {
                    list($iconWidth, $iconHeight) = getimagesize($iconPath);
                }
                $linkSettings['icon'] = [
                    'src' => str_replace(['https://', 'http://'], ['//', '//'], $link->getMediaLink($icone)),
                    'width' => $iconWidth,
                    'height' => $iconHeight,
                    'alt' => trim($row['image_legend']) ? $row['image_legend'] : $name,
                ];
            }
        }
        if (!$first_level && Configuration::get('ATM_OBFUSCATE_LINK') && empty($row['prevent_obfuscate'])) {
            $linkSettings['tag'] = 'span';
            $linkSettings['linkAttribute'] = 'data-href';
            $linkSettings['url'] = ($linkNotClickable ? '#' : self::getDataSerialized($url));
        }
        $linkSettings['row'] = $row;
        $this->context->smarty->assign([
            'atmLink' => $linkSettings,
        ]);
        $cache = Configuration::get('ATM_CACHE');
        if (!Configuration::get('PS_SMARTY_CACHE')) {
            $cache = false;
        }
        if ($cache) {
            $adtmCacheId = sprintf('ADTM|%d|%s|%d|%s|%s', $this->context->cookie->id_lang, Validate::isLoadedObject($this->context->customer) && $this->context->customer->isLogged(), Shop::isFeatureActive() ? $this->context->shop->id : 0, implode('-', self::getCustomerGroups()), sha1(json_encode($linkSettings)));
            return $this->context->smarty->fetch(dirname(__FILE__) . '/views/templates/front/partials/menu_link.tpl', $adtmCacheId);
        }
        return $this->context->smarty->fetch(dirname(__FILE__) . '/views/templates/front/partials/menu_link.tpl');
    }
    public function getAdminOutputPrivacyValue($privacy)
    {
        $vars = [
            'privacy' => $privacy,
        ];
        return $this->fetchTemplate('module/form_components/privacy.tpl', $vars);
    }
    protected function getAdminOutputImageIcon($type, $row, $withExtra)
    {
        $this->context->smarty->assign([
            'atmItem' => $row,
            'atmItemWithExtraIcon' => $withExtra,
            'iconPath' => !empty($type) && !empty($row['id_' . $type]) ? $this->_path . $type . '_icons/' . $row['id_' . $type] . '-' . $this->_iso_lang . '.' . ($row['image_type'] ?: 'jpg') : null,
        ]);
        return $this->context->smarty->fetch(dirname(__FILE__) . '/views/templates/admin/module/partials/icon.tpl');
    }
    public function getAdminOutputNameValue($row, $withExtra = true, $type = false)
    {
        if (isset($row['type']) && $withExtra && !empty($row['have_icon']) && trim($row['have_icon']) && $row['image_type'] == 'i-mi') {
            $row['image_class'] = 'zmdi ' . $row['image_class'];
        }
        $row['name'] = isset($row['name']) ? trim($row['name']) : '';
        if ($row['type'] == 1) {
            if (empty($row['name'])) {
                $row['name'] = $row['meta_title'];
            }
        } elseif ($row['type'] == 2) {
            if (empty($row['name'])) {
                $row['name'] = $this->l('No label');
            }
        } elseif ($row['type'] == 3) {
            if (empty($row['name'])) {
                $row['name'] = $row['category_name'];
            }
        } elseif ($row['type'] == 4) {
            if (empty($row['name']) && empty($row['id_manufacturer'])) {
                $row['name'] = $this->l('No label');
            } elseif (empty($row['name']) && !empty($row['id_manufacturer'])) {
                $row['name'] = $row['manufacturer_name'];
            }
        } elseif ($row['type'] == 5) {
            if (empty($row['name']) && empty($row['id_supplier'])) {
                $row['name'] = $this->l('No label');
            } elseif (empty($row['name']) && !empty($row['id_supplier'])) {
                $row['name'] = $row['supplier_name'];
            }
        } elseif ($row['type'] == 6) {
            if (empty($row['name'])) {
                $row['name'] = $this->l('No label');
            }
        } elseif ($row['type'] == 7) {
            $row['name'] = $this->l('No label');
        } elseif ($row['type'] == 9) {
            if (!trim($row['name'])) {
                $page = Meta::getMetaByPage($row['id_specific_page'], (int)$this->context->cookie->id_lang);
                $row['name'] = (!empty($page['title']) ? $page['title'] : $page['page']);
            }
        } elseif ($row['type'] == 10) {
            if (!trim($row['name'])) {
                $cmsCategory = new CMSCategory((int)$row['id_cms_category']);
                $row['name'] = $cmsCategory->getName((int)$this->context->cookie->id_lang);
            }
        }
        return $this->getAdminOutputImageIcon($type, $row, $withExtra);
    }
    protected function copyFromPost(&$object)
    {
        if (method_exists('Tools', 'getAllValues')) {
            $data = Tools::getAllValues();
        } else {
            $data = $_POST;
        }
        foreach ($data as $key => $value) {
            if ($key == 'active_column' || $key == 'active_menu' || $key == 'active_element') {
                $key = 'active';
            } elseif ($key == 'active_desktop_column' || $key == 'active_desktop_menu' || $key == 'active_desktop_element') {
                $key = 'active_desktop';
            } elseif ($key == 'active_mobile_column' || $key == 'active_mobile_menu' || $key == 'active_mobile_element') {
                $key = 'active_mobile';
            }
            if (property_exists($object, $key)) {
                $object->{$key} = $value;
            }
        }
        $rules = call_user_func([get_class($object), 'getValidationRules'], get_class($object));
        if (count($rules['validateLang'])) {
            $languages = Language::getLanguages(false);
            foreach ($languages as $language) {
                foreach (array_keys($rules['validateLang']) as $field) {
                    if (Tools::getIsset($field . '_' . (int)$language['id_lang'])) {
                        $object->{$field}[(int)$language['id_lang']] = Tools::getValue($field . '_' . (int)$language['id_lang']);
                    }
                }
            }
        }
    }
    protected function updateMenuType($AdvancedTopMenuClass)
    {
        if (Tools::getValue('rebuild') && in_array($AdvancedTopMenuClass->type, $this->rebuildable_type)) {
            $columnsWrap = AdvancedTopMenuColumnWrapClass::getColumnWrapIds($AdvancedTopMenuClass->id);
            foreach ($columnsWrap as $idWrap) {
                $columnWrap = new AdvancedTopMenuColumnWrapClass((int)$idWrap);
                $columnWrap->delete();
            }
        }
        switch ($AdvancedTopMenuClass->type) {
            case 3:
                if (!Tools::getValue('include_subs') || empty($AdvancedTopMenuClass->id_category)) {
                    return;
                }
                $firstChildCategories = $this->getSubCategoriesId($AdvancedTopMenuClass->id_category, true, true);
                $lastChildCategories = [];
                $columnWithNoDepth = $columnWrapWithNoDepth = false;
                if (!count($firstChildCategories)) {
                    return;
                }
                $nbColumnsToCreate = (int)Tools::getValue('nbColumnsToCreate');
                $nbColumnsToCreate = max(1, $nbColumnsToCreate);
                $nbCategories = count($firstChildCategories);
                if ($nbCategories < $nbColumnsToCreate) {
                    $nbColumnsToCreate = $nbCategories;
                }
                $nbCategoriesByColumn = round($nbCategories / $nbColumnsToCreate);
                $nbColumnWrapsCreated = $nbElementsInCurrentColumnWrap = 0;
                $currentColumnWrap = null;
                foreach ($firstChildCategories as $firstChildCategory) {
                    $idColumn = false;
                    if (Tools::getValue('id_menu', false)) {
                        $idColumn = AdvancedTopMenuColumnClass::getIdColumnCategoryDepend($AdvancedTopMenuClass->id, $firstChildCategory['id_category']);
                        if (!$idColumn && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($idColumn, $AdvancedTopMenuClass, 'id_category', $firstChildCategory);
                    if (!$idColumn) {
                        if ($nbColumnWrapsCreated == 0 || ($nbColumnWrapsCreated < $nbColumnsToCreate && $nbElementsInCurrentColumnWrap == $nbCategoriesByColumn)) {
                            $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                            $AdvancedTopMenuColumnClass->id_wrap = $AdvancedTopMenuColumnWrapClass->id;
                            $currentColumnWrap = $AdvancedTopMenuColumnWrapClass;
                            $nbElementsInCurrentColumnWrap = 0;
                            $nbColumnWrapsCreated++;
                        }
                        $AdvancedTopMenuColumnClass->id_wrap = $currentColumnWrap->id;
                        $nbElementsInCurrentColumnWrap++;
                    }
                    if (!$AdvancedTopMenuColumnClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving children category');
                        continue;
                    }
                    $lastChildCategories = $this->getSubCategoriesId($firstChildCategory['id_category'], true, true);
                    if (!count($lastChildCategories)) {
                        continue;
                    }
                    $elementPosition = 0;
                    foreach ($lastChildCategories as $lastChildCategory) {
                        $idElement = false;
                        if (Tools::getValue('id_menu', false)) {
                            $idElement = AdvancedTopMenuElementsClass::getIdElementCategoryDepend($idColumn, $lastChildCategory['id_category']);
                            if (!$idElement && !Tools::getValue('rebuild')) {
                                continue;
                            }
                        }
                        $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_category', $lastChildCategory, $AdvancedTopMenuClass->type);
                        if (!$idElement) {
                            $AdvancedTopMenuElementsClass->position = $elementPosition;
                        }
                        if (!$AdvancedTopMenuElementsClass->save()) {
                            $this->context->controller->errors[] = $this->l('An error occurred while saving children category');
                        }
                        $elementPosition++;
                    }
                }
                break;
            case 4:
                if (!Tools::getValue('include_subs_manu')) {
                    return;
                }
                $manufacturersId = $this->getManufacturersId();
                $columnWithNoDepth = false;
                if (!count($manufacturersId)) {
                    return;
                }
                $nbColumnsToCreate = (int)Tools::getValue('nbManufacturersColumnsToCreate');
                $nbColumnsToCreate = max(1, $nbColumnsToCreate);
                $nbManufacturers = count($manufacturersId);
                if ($nbManufacturers < $nbColumnsToCreate) {
                    $nbColumnsToCreate = $nbManufacturers;
                }
                $nbManufacturersByColumn = round($nbManufacturers / $nbColumnsToCreate);
                $nbColumnWrapsCreated = $nbElementsInCurrentColumnWrap = $elementPosition = 0;
                $currentColumnWrap = null;
                foreach ($manufacturersId as $manufacturerId) {
                    $idColumn = $columnWithNoDepth = false;
                    if (Tools::getValue('id_menu', false) && $nbColumnsToCreate <= 1) {
                        $idColumn = AdvancedTopMenuColumnClass::getIdColumnManufacturerDependEmptyColumn($AdvancedTopMenuClass->id, $manufacturerId['id_manufacturer']);
                        if (!$idColumn && !Tools::getValue('rebuild')) {
                            continue;
                        }
                        if ($idColumn) {
                            $columnWithNoDepth = $idColumn;
                        }
                    }
                    if (!$columnWithNoDepth) {
                        if ($nbColumnWrapsCreated == 0 || ($nbColumnWrapsCreated < $nbColumnsToCreate && $nbElementsInCurrentColumnWrap == $nbManufacturersByColumn)) {
                            $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                            $currentColumnWrap = $AdvancedTopMenuColumnWrapClass;
                            $nbElementsInCurrentColumnWrap = 0;
                            $nbColumnWrapsCreated++;
                            $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($columnWithNoDepth, $AdvancedTopMenuClass, 'id_manufacturer', $manufacturerId, 2);
                            $AdvancedTopMenuColumnClass->id_wrap = $currentColumnWrap->id;
                        }
                    } else {
                        $AdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass($columnWithNoDepth);
                    }
                    if (!isset($AdvancedTopMenuColumnClass) || !$AdvancedTopMenuColumnClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving manufacturers');
                        continue;
                    }
                    if (!$columnWithNoDepth) {
                        $columnWithNoDepth = $AdvancedTopMenuColumnClass->id;
                    }
                    $idElement = false;
                    if (Tools::getValue('id_menu', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementManufacturerDepend($columnWithNoDepth, $manufacturerId['id_manufacturer']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_manufacturer', $manufacturerId, $AdvancedTopMenuClass->type);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving manufacturers');
                    }
                    $nbElementsInCurrentColumnWrap++;
                    $elementPosition++;
                }
                break;
            case 5:
                if (!Tools::getValue('include_subs_suppl')) {
                    return;
                }
                $suppliersId = $this->getSuppliersId();
                $columnWithNoDepth = false;
                if (!count($suppliersId)) {
                    return;
                }
                $nbColumnsToCreate = (int)Tools::getValue('nbSuppliersColumnsToCreate');
                $nbColumnsToCreate = max(1, $nbColumnsToCreate);
                $nbSuppliers = count($suppliersId);
                if ($nbSuppliers < $nbColumnsToCreate) {
                    $nbColumnsToCreate = $nbSuppliers;
                }
                $nbSuppliersByColumn = round($nbSuppliers / $nbColumnsToCreate);
                $nbColumnWrapsCreated = $elementPosition = $nbElementsInCurrentColumnWrap = 0;
                $currentColumnWrap = null;
                foreach ($suppliersId as $supplierId) {
                    $idColumn = $columnWithNoDepth = false;
                    if (Tools::getValue('id_menu', false)) {
                        $idColumn = AdvancedTopMenuColumnClass::getIdColumnSupplierDependEmptyColumn($AdvancedTopMenuClass->id, $supplierId['id_supplier']);
                        if (!$idColumn && !Tools::getValue('rebuild')) {
                            continue;
                        }
                        if ($idColumn) {
                            $columnWithNoDepth = $idColumn;
                        }
                    }
                    if (!$columnWithNoDepth) {
                        if ($nbColumnWrapsCreated == 0 || ($nbColumnWrapsCreated < $nbColumnsToCreate && $nbElementsInCurrentColumnWrap == $nbSuppliersByColumn)) {
                            $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                            $currentColumnWrap = $AdvancedTopMenuColumnWrapClass;
                            $nbElementsInCurrentColumnWrap = 0;
                            $nbColumnWrapsCreated++;
                            $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($columnWithNoDepth, $AdvancedTopMenuClass, 'id_supplier', $supplierId, 2);
                            $AdvancedTopMenuColumnClass->id_wrap = $currentColumnWrap->id;
                        }
                    } else {
                        $AdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass($columnWithNoDepth);
                    }
                    if (!isset($AdvancedTopMenuColumnClass) || !$AdvancedTopMenuColumnClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving suppliers');
                        continue;
                    }
                    if (!$columnWithNoDepth) {
                        $columnWithNoDepth = $AdvancedTopMenuColumnClass->id;
                    }
                    $idElement = false;
                    if (Tools::getValue('id_menu', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementSupplierDepend($columnWithNoDepth, $supplierId['id_supplier']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_supplier', $supplierId, $AdvancedTopMenuClass->type);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving suppliers');
                    }
                    $nbElementsInCurrentColumnWrap++;
                    $elementPosition++;
                }
                break;
            case 10:
                if (!Tools::getValue('include_subs_cms') || empty($AdvancedTopMenuClass->id_cms_category)) {
                    return;
                }
                $firstChildCategories = $this->getCmsSubCategoriesId($AdvancedTopMenuClass->id_cms_category, true, true);
                $columnWithNoDepth = $columnWrapWithNoDepth = false;
                if (count($firstChildCategories)) {
                    foreach ($firstChildCategories as $firstChildCategory) {
                        $childCmsPages = $this->getCmsByCategory((int)$firstChildCategory['id_cms_category']);
                        if (count($childCmsPages)) {
                            $idColumn = false;
                            if (Tools::getValue('id_menu', false)) {
                                $idColumn = AdvancedTopMenuColumnClass::getIdColumnCmsCategoryDepend($AdvancedTopMenuClass->id, $firstChildCategory['id_cms_category']);
                                if (!$idColumn && !Tools::getValue('rebuild')) {
                                    continue;
                                }
                            }
                            $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($idColumn, $AdvancedTopMenuClass, 'id_cms_category', $firstChildCategory);
                            if (!$idColumn) {
                                $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                                $AdvancedTopMenuColumnClass->id_wrap = $AdvancedTopMenuColumnWrapClass->id;
                            }
                            if ($AdvancedTopMenuColumnClass->save()) {
                                $elementPosition = 0;
                                foreach ($childCmsPages as $cmsPage) {
                                    $idElement = false;
                                    if (Tools::getValue('id_menu', false)) {
                                        $idElement = AdvancedTopMenuElementsClass::getIdElementCmsDepend($idColumn, (int)$cmsPage['id_cms']);
                                        if (!$idElement && !Tools::getValue('rebuild')) {
                                            continue;
                                        }
                                    }
                                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_cms', $cmsPage, 1);
                                    if (!$idElement) {
                                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                                    }
                                    if (!$AdvancedTopMenuElementsClass->save()) {
                                        $this->context->controller->errors[] = $this->l('An error occurred while saving children CMS page');
                                    }
                                    $elementPosition++;
                                }
                            } else {
                                $this->context->controller->errors[] = $this->l('An error occurred while saving children CMS page');
                            }
                        } else {
                            $idColumn = false;
                            $columnWithNoDepth = false;
                            if (Tools::getValue('id_menu', false)) {
                                $idColumn = AdvancedTopMenuColumnClass::getIdColumnCmsCategoryDepend($AdvancedTopMenuClass->id, $firstChildCategory['id_cms_category']);
                                if (!$idColumn && !Tools::getValue('rebuild')) {
                                    continue;
                                }
                                if ($idColumn) {
                                    $columnWithNoDepth = $idColumn;
                                }
                            }
                            $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($columnWithNoDepth, $AdvancedTopMenuClass, 'id_cms_category', $firstChildCategory, $AdvancedTopMenuClass->type);
                            if (!$columnWithNoDepth) {
                                $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                                $AdvancedTopMenuColumnClass->id_wrap = $AdvancedTopMenuColumnWrapClass->id;
                            }
                            if (!$AdvancedTopMenuColumnClass->save()) {
                                $this->context->controller->errors[] = $this->l('An error occurred while saving children category');
                                continue;
                            }
                            if (!$columnWrapWithNoDepth) {
                                $columnWrapWithNoDepth = $AdvancedTopMenuColumnClass->id_wrap;
                            }
                        }
                    }
                } else {
                    $categoryCmsPages = $this->getCmsByCategory($AdvancedTopMenuClass->id_cms_category);
                    if (count($categoryCmsPages)) {
                        $idColumn = false;
                        $columnWithNoDepth = false;
                        if (Tools::getValue('id_menu', false)) {
                            $idColumn = AdvancedTopMenuColumnClass::getIdColumnCmsCategoryDepend($AdvancedTopMenuClass->id, (int)$AdvancedTopMenuClass->id_cms_category);
                            if (!$idColumn && !Tools::getValue('rebuild')) {
                                return;
                            }
                            if ($idColumn) {
                                $columnWithNoDepth = $idColumn;
                            }
                        }
                        $AdvancedTopMenuColumnClass = $this->fetchOrCreateColumnObject($columnWithNoDepth, $AdvancedTopMenuClass, 'id_cms_category', null, 2);
                        if (!$columnWithNoDepth) {
                            $AdvancedTopMenuColumnWrapClass = $this->createColumnWrap($AdvancedTopMenuClass->id);
                            $AdvancedTopMenuColumnClass->id_wrap = $AdvancedTopMenuColumnWrapClass->id;
                        }
                        if (!$AdvancedTopMenuColumnClass->save()) {
                            $this->context->controller->errors[] = $this->l('An error occurred while saving children CMS page');
                            return;
                        }
                        $elementPosition = 0;
                        foreach ($categoryCmsPages as $cmsPage) {
                            $idElement = false;
                            if (Tools::getValue('id_menu', false)) {
                                $idElement = AdvancedTopMenuElementsClass::getIdElementCmsDepend($columnWithNoDepth, (int)$cmsPage['id_cms']);
                                if (!$idElement && !Tools::getValue('rebuild')) {
                                    continue;
                                }
                            }
                            $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_cms', $cmsPage, 1);
                            if (!$idElement) {
                                $AdvancedTopMenuElementsClass->position = $elementPosition;
                            }
                            if (!$AdvancedTopMenuElementsClass->save()) {
                                $this->context->controller->errors[] = $this->l('An error occurred while saving children CMS page');
                            }
                            $elementPosition++;
                        }
                    }
                }
                break;
        }
    }
    protected function createColumnWrap($idMenu)
    {
        $AdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass();
        $AdvancedTopMenuColumnWrapClass->active = 1;
        $AdvancedTopMenuColumnWrapClass->id_menu = $idMenu;
        $AdvancedTopMenuColumnWrapClass->id_menu_depend = $idMenu;
        $AdvancedTopMenuColumnWrapClass->save();
        $AdvancedTopMenuColumnWrapClass->internal_name = $this->l('column') . '-' . $AdvancedTopMenuColumnWrapClass->id_menu . '-' . $AdvancedTopMenuColumnWrapClass->id;
        if (!$AdvancedTopMenuColumnWrapClass->save()) {
            $this->context->controller->errors[] = $this->l('An error occurred while saving column');
        }
        return $AdvancedTopMenuColumnWrapClass;
    }
    protected function fetchOrCreateColumnObject($idColumn, $advancedTopMenuClass, $fieldName, $entity, $columnType = null)
    {
        $AdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass($idColumn);
        $AdvancedTopMenuColumnClass->active = ($idColumn ? $AdvancedTopMenuColumnClass->active : 1);
        $AdvancedTopMenuColumnClass->id_menu = $advancedTopMenuClass->id;
        $AdvancedTopMenuColumnClass->id_menu_depend = $advancedTopMenuClass->id;
        $AdvancedTopMenuColumnClass->type = (!empty($columnType) ? $columnType : $advancedTopMenuClass->type);
        $AdvancedTopMenuColumnClass->{$fieldName} = (!empty($entity) && isset($entity[$fieldName]) ? $entity[$fieldName] : null);
        $AdvancedTopMenuColumnClass->position = isset($entity['position']) ? $entity['position'] : '0';
        return $AdvancedTopMenuColumnClass;
    }
    protected function fetchOrCreateElementObject($idElement, $advancedTopMenuColumnClass, $fieldName, $entity, $columnType = null)
    {
        $advancedTopMenuElementsClass = new AdvancedTopMenuElementsClass($idElement);
        $advancedTopMenuElementsClass->active = ($idElement ? $advancedTopMenuElementsClass->active : 1);
        if (!empty($columnType)) {
            $advancedTopMenuElementsClass->type = $columnType;
        } else {
            $advancedTopMenuElementsClass->type = 2;
        }
        $advancedTopMenuElementsClass->{$fieldName} = $entity[$fieldName];
        $advancedTopMenuElementsClass->id_column = $advancedTopMenuColumnClass->id;
        $advancedTopMenuElementsClass->id_column_depend = $advancedTopMenuColumnClass->id;
        $advancedTopMenuElementsClass->position = isset($entity['position']) ? $entity['position'] : '0';
        return $advancedTopMenuElementsClass;
    }
    protected function updateColumnType($AdvancedTopMenuColumnClass)
    {
        if (Tools::getValue('rebuild') && in_array($AdvancedTopMenuColumnClass->type, $this->rebuildable_type)) {
            $elements = AdvancedTopMenuElementsClass::getElementIds((int)$AdvancedTopMenuColumnClass->id);
            foreach ($elements as $idElement) {
                $element = new AdvancedTopMenuElementsClass((int)$idElement);
                $element->delete();
            }
        }
        switch ($AdvancedTopMenuColumnClass->type) {
            case 3:
                if (!Tools::getValue('include_subs') || empty($AdvancedTopMenuColumnClass->id_category)) {
                    return;
                }
                $childCategories = $this->getSubCategoriesId($AdvancedTopMenuColumnClass->id_category);
                if (!count($childCategories)) {
                    return;
                }
                $elementPosition = 0;
                foreach ($childCategories as $childCategory) {
                    $idElement = false;
                    if (Tools::getValue('id_column', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementCategoryDepend(Tools::getValue('id_column'), $childCategory['id_category']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_category', $childCategory, $AdvancedTopMenuColumnClass->type);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving children category');
                    }
                    $elementPosition++;
                }
                break;
            case 4:
                if (!Tools::getValue('include_subs_manu')) {
                    return;
                }
                $manufacturers = $this->getManufacturersId();
                if (!count($manufacturers)) {
                    return;
                }
                $elementPosition = 0;
                foreach ($manufacturers as $manufacturer) {
                    $idElement = false;
                    if (Tools::getValue('id_column', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementManufacturerDepend(Tools::getValue('id_column'), $manufacturer['id_manufacturer']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_manufacturer', $manufacturer, $AdvancedTopMenuColumnClass->type);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving manufacturers');
                    }
                    $elementPosition++;
                }
                break;
            case 5:
                if (!Tools::getValue('include_subs_suppl')) {
                    return;
                }
                $suppliers = $this->getSuppliersId();
                if (!count($suppliers)) {
                    return;
                }
                $elementPosition = 0;
                foreach ($suppliers as $supplier) {
                    $idElement = false;
                    if (Tools::getValue('id_column', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementSupplierDepend(Tools::getValue('id_column'), $supplier['id_supplier']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_supplier', $supplier, $AdvancedTopMenuColumnClass->type);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving suppliers');
                    }
                    $elementPosition++;
                }
                break;
            case 10:
                if (!Tools::getValue('include_subs_cms') || empty($AdvancedTopMenuColumnClass->id_cms_category)) {
                    return;
                }
                $cmsPages = $this->getCmsByCategory((int)$AdvancedTopMenuColumnClass->id_cms_category);
                if (!count($cmsPages)) {
                    return;
                }
                $elementPosition = 0;
                foreach ($cmsPages as $cmsPage) {
                    $idElement = false;
                    if (Tools::getValue('id_column', false)) {
                        $idElement = AdvancedTopMenuElementsClass::getIdElementCmsDepend(Tools::getValue('id_column'), (int)$cmsPage['id_cms']);
                        if (!$idElement && !Tools::getValue('rebuild')) {
                            continue;
                        }
                    }
                    $AdvancedTopMenuElementsClass = $this->fetchOrCreateElementObject($idElement, $AdvancedTopMenuColumnClass, 'id_cms', $cmsPage, 1);
                    if (!$idElement) {
                        $AdvancedTopMenuElementsClass->position = $elementPosition;
                    }
                    if (!$AdvancedTopMenuElementsClass->save()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while saving children CMS page');
                    }
                    $elementPosition++;
                }
                break;
        }
    }
    protected function getManufacturersId()
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
    SELECT m.`id_manufacturer`
    FROM `' . _DB_PREFIX_ . 'manufacturer` m
    ORDER BY m.`name` ASC');
    }
    protected function getSuppliersId()
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
    SELECT s.`id_supplier`
    FROM `' . _DB_PREFIX_ . 'supplier` s
    ORDER BY s.`name` ASC');
    }
    protected function getSubCategoriesId($id_category, $active = true, $with_position = false)
    {
        if (!Validate::isBool($active)) {
            die(Tools::displayError());
        }
        if (!Validate::isBool($with_position)) {
            die(Tools::displayError());
        }
        $orderBy = 'category_shop.`position`';
        $with_position_field = 'category_shop.`position`';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
            SELECT c.id_category' . ($with_position ? ', ' . $with_position_field : '') . '
            FROM `' . _DB_PREFIX_ . 'category` c
            ' . Shop::addSqlAssociation('category', 'c') . '
            WHERE `id_parent` = ' . (int)$id_category . '
            ' . ($active ? 'AND `active` = 1' : '') . '
            GROUP BY c.`id_category`
            ORDER BY ' . $orderBy . ' ASC');
    }
    protected function getCmsSubCategoriesId($id_cms_category, $active = true, $with_position = false)
    {
        if (!Validate::isBool($active)) {
            die(Tools::displayError());
        }
        if (!Validate::isBool($with_position)) {
            die(Tools::displayError());
        }
        $orderBy = 'c.`position`';
        $with_position_field = 'c.`position`';
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
            SELECT c.id_cms_category' . ($with_position ? ', ' . $with_position_field : '') . '
            FROM `' . _DB_PREFIX_ . 'cms_category` c
            ' . Shop::addSqlAssociation('cms_category', 'c') . '
            WHERE `id_parent` = ' . (int)$id_cms_category . '
            ' . ($active ? 'AND `active` = 1' : '') . '
            GROUP BY c.`id_cms_category`
            ORDER BY ' . $orderBy . ' ASC');
    }
    protected function getFileExtension($filename)
    {
        $split = explode('.', $filename);
        $extension = end($split);
        return Tools::strtolower($extension);
    }
    protected function postProcessMenu()
    {
        $id_menu = Tools::getValue('id_menu', false);
        $AdvancedTopMenuClass = new AdvancedTopMenuClass($id_menu);
        $this->context->controller->errors = $AdvancedTopMenuClass->validateController();
        if (!Tools::getValue('type', 0)) {
            $this->context->controller->errors[] = $this->l('The type of the tab is required.');
        } elseif (Tools::getValue('type') == 1 && !Tools::getValue('id_cms')) {
            $this->context->controller->errors[] = $this->l('You need to select the related CMS.');
        } elseif (Tools::getValue('type') == 3 && !Tools::getValue('id_category')) {
            $this->context->controller->errors[] = $this->l('You need to select the related category.');
        } elseif (Tools::getValue('type') == 4 && !Tools::getValue('include_subs_manu') && !Tools::getValue('id_manufacturer')) {
            $this->context->controller->errors[] = $this->l('You need to select the related manufacturer.');
        } elseif (Tools::getValue('type') == 5 && !Tools::getValue('include_subs_suppl') && !Tools::getValue('id_supplier')) {
            $this->context->controller->errors[] = $this->l('You need to select the related supplier.');
        } elseif (Tools::getValue('type') == 9 && !Tools::getValue('id_specific_page')) {
            $this->context->controller->errors[] = $this->l('You need to select the related specific page.');
        }
        if (!count($this->context->controller->errors)) {
            $this->copyFromPost($AdvancedTopMenuClass);
            $AdvancedTopMenuClass->border_size_tab = $this->getBorderSizeFromArray(Tools::getValue('border_size_tab'));
            $AdvancedTopMenuClass->border_size_submenu = $this->getBorderSizeFromArray(Tools::getValue('border_size_submenu'));
            $fnd_color_menu_tab = Tools::getValue('fnd_color_menu_tab');
            $AdvancedTopMenuClass->fnd_color_menu_tab = $fnd_color_menu_tab[0] . (Tools::getValue('fnd_color_menu_tab_gradient') && isset($fnd_color_menu_tab[1]) && $fnd_color_menu_tab[1] ? $this->gradient_separator . $fnd_color_menu_tab[1] : '');
            $fnd_color_menu_tab_over = Tools::getValue('fnd_color_menu_tab_over');
            $AdvancedTopMenuClass->fnd_color_menu_tab_over = $fnd_color_menu_tab_over[0] . (Tools::getValue('fnd_color_menu_tab_over_gradient') && isset($fnd_color_menu_tab_over[1]) && $fnd_color_menu_tab_over[1] ? $this->gradient_separator . $fnd_color_menu_tab_over[1] : '');
            $fnd_color_submenu = Tools::getValue('fnd_color_submenu');
            $AdvancedTopMenuClass->fnd_color_submenu = $fnd_color_submenu[0] . (Tools::getValue('fnd_color_submenu_gradient') && isset($fnd_color_submenu[1]) && $fnd_color_submenu[1] ? $this->gradient_separator . $fnd_color_submenu[1] : '');
            $AdvancedTopMenuClass->chosen_groups = Tools::getIsset('chosen_groups') ? json_encode(Tools::getValue('chosen_groups')) : '';
            if (!Tools::getValue('tinymce_container_toggle_menu', 0)) {
                $AdvancedTopMenuClass->value_over = [];
                $AdvancedTopMenuClass->value_under = [];
            }
            if (($AdvancedTopMenuClass->type == 4 && Tools::getValue('include_subs_manu')) || ($AdvancedTopMenuClass->type == 5 && Tools::getValue('include_subs_suppl'))) {
                $AdvancedTopMenuClass->id_manufacturer = 0;
                $AdvancedTopMenuClass->id_supplier = 0;
                if ($AdvancedTopMenuClass->type == 4) {
                    foreach ($AdvancedTopMenuClass->name as $id_lang => $name) {
                        $title = '';
                        if (empty($name)) {
                            if (class_exists('Meta') && method_exists('Meta', 'getMetaByPage')) {
                                $title = Meta::getMetaByPage('manufacturer', $id_lang);
                                if (is_array($title) && isset($title['title']) && !empty($title['title'])) {
                                    $title = $title['title'];
                                }
                            }
                            if (empty($title)) {
                                $title = $this->l('Manufacturers');
                            }
                            $AdvancedTopMenuClass->name[$id_lang] = $title;
                        }
                    }
                } elseif ($AdvancedTopMenuClass->type == 5) {
                    foreach ($AdvancedTopMenuClass->name as $id_lang => $name) {
                        $title = '';
                        if (empty($name)) {
                            if (class_exists('Meta') && method_exists('Meta', 'getMetaByPage')) {
                                $title = Meta::getMetaByPage('supplier', $id_lang);
                                if (is_array($title) && isset($title['title']) && !empty($title['title'])) {
                                    $title = $title['title'];
                                }
                            }
                            if (empty($title)) {
                                $title = $this->l('Suppliers');
                            }
                            $AdvancedTopMenuClass->name[$id_lang] = $title;
                        }
                    }
                }
            }
            $languages = Language::getLanguages(false);
            if (!$id_menu) {
                if (!$AdvancedTopMenuClass->add()) {
                    $this->context->controller->errors[] = $this->l('An error occurred while adding the tab');
                } else {
                    $this->context->smarty->assign([
                        'current_id_menu' => $AdvancedTopMenuClass->id,
                    ]);
                }
            } elseif (!$AdvancedTopMenuClass->update()) {
                $this->context->controller->errors[] = $this->l('An error occurred while updating the tab');
            }
            if (!count($this->context->controller->errors)) {
                $this->updateMenuType($AdvancedTopMenuClass);
                if (!count($this->context->controller->errors)) {
                    foreach ($languages as $language) {
                        $fileKey = 'icon_' . $language['id_lang'];
                        if (isset($_FILES[$fileKey]['tmp_name']) and $_FILES[$fileKey]['tmp_name'] != null) {
                            $ext = $this->getFileExtension($_FILES[$fileKey]['name']);
                            if (!in_array($ext, $this->allowFileExtension) || ($ext != 'svg' && !getimagesize($_FILES[$fileKey]['tmp_name'])) || !move_uploaded_file($_FILES[$fileKey]['tmp_name'], _PS_ROOT_DIR_ . '/modules/' . $this->name . '/menu_icons/' . $AdvancedTopMenuClass->id . '-' . $language['iso_code'] . '.' . $ext)) {
                                $this->context->controller->errors[] = $this->l('An error occurred during the image upload');
                            } else {
                                $AdvancedTopMenuClass->image_class[$language['id_lang']] = null;
                                $AdvancedTopMenuClass->image_type[$language['id_lang']] = $ext;
                                $AdvancedTopMenuClass->have_icon[$language['id_lang']] = 1;
                                $AdvancedTopMenuClass->update();
                            }
                        } elseif (Tools::getValue('unlink_icon_' . $language['id_lang'])) {
                            unlink(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/menu_icons/' . $AdvancedTopMenuClass->id . '-' . $language['iso_code'] . '.' . ($AdvancedTopMenuClass->image_type[$language['id_lang']] ?: 'jpg'));
                            $AdvancedTopMenuClass->have_icon[$language['id_lang']] = '';
                            $AdvancedTopMenuClass->image_type[$language['id_lang']] = '';
                            $AdvancedTopMenuClass->image_legend[$language['id_lang']] = '';
                            $AdvancedTopMenuClass->update();
                        }
                        if (!isset($_FILES[$fileKey]['tmp_name']) || $_FILES[$fileKey]['tmp_name'] == null) {
                            $iconLibraryKey = 'iconLibrary_' . $language['id_lang'];
                            $iconLibraryValue = Tools::getValue($iconLibraryKey);
                            if (!in_array($iconLibraryValue, ['fa', 'mi'])) {
                                $this->context->controller->errors[] = $this->l('An error occurred while saving the selected icon');
                            }
                            $libIconKey = 'lib_icon_' . $language['id_lang'];
                            $libIconValue = Tools::getValue($libIconKey);
                            if (!empty($libIconValue)) {
                                if ($libIconValue === 'empty') {
                                    $AdvancedTopMenuClass->image_type[$language['id_lang']] = '';
                                    $AdvancedTopMenuClass->image_class[$language['id_lang']] = '';
                                    $AdvancedTopMenuClass->have_icon[$language['id_lang']] = '';
                                } else {
                                    $AdvancedTopMenuClass->image_type[$language['id_lang']] = 'i-' . $iconLibraryValue;
                                    $AdvancedTopMenuClass->image_class[$language['id_lang']] = $libIconValue;
                                    $AdvancedTopMenuClass->have_icon[$language['id_lang']] = 1;
                                }
                                $AdvancedTopMenuClass->update();
                            }
                        }
                    }
                    $this->generateCss();
                    $this->context->controller->confirmations[] = $this->l('The tab has successfully been updated');
                }
            }
            unset($_POST['active']);
        }
    }
    protected function postProcessColumnWrap()
    {
        $id_wrap = Tools::getValue('id_wrap', false);
        $id_menu = Tools::getValue('id_menu', false);
        if (!$id_menu) {
            $this->context->controller->errors[] = $this->l('An error occurred while adding the column - Parent tab is not set');
        } else {
            $AdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass($id_wrap);
            $this->context->controller->errors = $AdvancedTopMenuColumnWrapClass->validateController();
            if (!count($this->context->controller->errors)) {
                $this->copyFromPost($AdvancedTopMenuColumnWrapClass);
                $bg_color = Tools::getValue('bg_color');
                $AdvancedTopMenuColumnWrapClass->bg_color = $bg_color[0] . (Tools::getValue('bg_color_gradient') && isset($bg_color[1]) && $bg_color[1] ? $this->gradient_separator . $bg_color[1] : '');
                $AdvancedTopMenuColumnWrapClass->chosen_groups = Tools::getIsset('chosen_groups') ? json_encode(Tools::getValue('chosen_groups')) : '';
                if (!Tools::getValue('tinymce_container_toggle_menu', 0)) {
                    $AdvancedTopMenuColumnWrapClass->value_over = [];
                    $AdvancedTopMenuColumnWrapClass->value_under = [];
                }
                unset($_POST['active']);
                if (!$id_wrap) {
                    if (!$AdvancedTopMenuColumnWrapClass->add()) {
                        $this->context->controller->errors[] = $this->l('An error occurred while adding the column');
                    }
                } elseif (!$AdvancedTopMenuColumnWrapClass->update()) {
                    $this->context->controller->errors[] = $this->l('An error occurred while updating the column');
                }
                if (!count($this->context->controller->errors)) {
                    $this->generateCss();
                    $this->context->controller->confirmations[] = $this->l('The column has successfully been updated');
                }
            }
        }
    }
    protected function postProcessColumn()
    {
        $id_column = Tools::getValue('id_column', false);
        $AdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass($id_column);
        $this->context->controller->errors = $AdvancedTopMenuColumnClass->validateController();
        if (!Tools::getValue('type', 0)) {
            $this->context->controller->errors[] = $this->l('The type of the column is required.');
        } elseif (Tools::getValue('type') == 1 && !Tools::getValue('id_cms')) {
            $this->context->controller->errors[] = $this->l('You need to select the related CMS.');
        } elseif (Tools::getValue('type') == 3 && !Tools::getValue('id_category')) {
            $this->context->controller->errors[] = $this->l('You need to select the related category.');
        } elseif (Tools::getValue('type') == 4 && !Tools::getValue('include_subs_manu') && !Tools::getValue('id_manufacturer')) {
            $this->context->controller->errors[] = $this->l('You need to select the related manufacturer.');
        } elseif (Tools::getValue('type') == 5 && !Tools::getValue('include_subs_suppl') && !Tools::getValue('id_supplier')) {
            $this->context->controller->errors[] = $this->l('You need to select the related supplier.');
        } elseif (Tools::getValue('type') == 9 && !Tools::getValue('id_specific_page')) {
            $this->context->controller->errors[] = $this->l('You need to select the related specific page.');
        }
        if (!count($this->context->controller->errors)) {
            $this->copyFromPost($AdvancedTopMenuColumnClass);
            $AdvancedTopMenuColumnClass->chosen_groups = Tools::getIsset('chosen_groups') ? json_encode(Tools::getValue('chosen_groups')) : '';
            if (!(int)$AdvancedTopMenuColumnClass->id_wrap) {
                $this->context->controller->errors[] = $this->l('You need to choose the parent column');
            }
            if (!Tools::getValue('tinymce_container_toggle_menu', 0)) {
                $AdvancedTopMenuColumnClass->value_over = [];
                $AdvancedTopMenuColumnClass->value_under = [];
            }
            $productElementsObj = false;
            if (!count($this->context->controller->errors)) {
                if ($AdvancedTopMenuColumnClass->type == 8) {
                    if ($id_column) {
                        $productElementsObj = AdvancedTopMenuProductColumnClass::getByIdColumn($id_column);
                    }
                    if (!$productElementsObj) {
                        $productElementsObj = new AdvancedTopMenuProductColumnClass();
                        $productElementsObj->id_column = 1;
                    }
                    $this->copyFromPost($productElementsObj);
                    $this->context->controller->errors = $productElementsObj->validateController();
                }
                if (count($this->context->controller->errors)) {
                    return;
                }
            }
            if (($AdvancedTopMenuColumnClass->type == 4 && Tools::getValue('include_subs_manu')) || ($AdvancedTopMenuColumnClass->type == 5 && Tools::getValue('include_subs_suppl'))) {
                $AdvancedTopMenuColumnClass->id_manufacturer = 0;
                $AdvancedTopMenuColumnClass->id_supplier = 0;
                if ($AdvancedTopMenuColumnClass->type == 4) {
                    foreach ($AdvancedTopMenuColumnClass->name as $id_lang => $name) {
                        $title = '';
                        if (empty($name)) {
                            if (class_exists('Meta') && method_exists('Meta', 'getMetaByPage')) {
                                $title = Meta::getMetaByPage('manufacturer', $id_lang);
                                if (is_array($title) && isset($title['title']) && !empty($title['title'])) {
                                    $title = $title['title'];
                                }
                            }
                            if (empty($title)) {
                                $title = $this->l('Manufacturers');
                            }
                            $AdvancedTopMenuColumnClass->name[$id_lang] = $title;
                        }
                    }
                } elseif ($AdvancedTopMenuColumnClass->type == 5) {
                    foreach ($AdvancedTopMenuColumnClass->name as $id_lang => $name) {
                        $title = '';
                        if (empty($name)) {
                            if (class_exists('Meta') && method_exists('Meta', 'getMetaByPage')) {
                                $title = Meta::getMetaByPage('supplier', $id_lang);
                                if (is_array($title) && isset($title['title']) && !empty($title['title'])) {
                                    $title = $title['title'];
                                }
                            }
                            if (empty($title)) {
                                $title = $this->l('Suppliers');
                            }
                            $AdvancedTopMenuColumnClass->name[$id_lang] = $title;
                        }
                    }
                }
            }
            $languages = Language::getLanguages(false);
            unset($_POST['active']);
            if (!$id_column) {
                if (!$AdvancedTopMenuColumnClass->add()) {
                    $this->context->controller->errors[] = $this->l('An error occurred while adding the group of items');
                }
            } elseif (!$AdvancedTopMenuColumnClass->update()) {
                $this->context->controller->errors[] = $this->l('An error occurred while updating the group of items');
            }
            if (!count($this->context->controller->errors)) {
                $this->updateColumnType($AdvancedTopMenuColumnClass);
                foreach ($languages as $language) {
                    $fileKey = 'icon_' . $language['id_lang'];
                    if (isset($_FILES[$fileKey]['tmp_name']) and $_FILES[$fileKey]['tmp_name'] != null) {
                        $ext = $this->getFileExtension($_FILES[$fileKey]['name']);
                        if (!in_array($ext, $this->allowFileExtension) || ($ext != 'svg' && !getimagesize($_FILES[$fileKey]['tmp_name'])) || !move_uploaded_file($_FILES[$fileKey]['tmp_name'], _PS_ROOT_DIR_ . '/modules/' . $this->name . '/column_icons/' . $AdvancedTopMenuColumnClass->id . '-' . $language['iso_code'] . '.' . $ext)) {
                            $this->context->controller->errors[] = $this->l('An error occurred during the image upload');
                        } else {
                            $AdvancedTopMenuColumnClass->image_class[$language['id_lang']] = null;
                            $AdvancedTopMenuColumnClass->image_type[$language['id_lang']] = $ext;
                            $AdvancedTopMenuColumnClass->have_icon[$language['id_lang']] = 1;
                            $AdvancedTopMenuColumnClass->update();
                        }
                    } elseif (Tools::getValue('unlink_icon_' . $language['id_lang'])) {
                        unlink(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/column_icons/' . $AdvancedTopMenuColumnClass->id . '-' . $language['iso_code'] . '.' . ($AdvancedTopMenuColumnClass->image_type[$language['id_lang']] ?: 'jpg'));
                        $AdvancedTopMenuColumnClass->have_icon[$language['id_lang']] = '';
                        $AdvancedTopMenuColumnClass->image_type[$language['id_lang']] = '';
                        $AdvancedTopMenuColumnClass->image_legend[$language['id_lang']] = '';
                        $AdvancedTopMenuColumnClass->update();
                    }
                    if (!isset($_FILES[$fileKey]['tmp_name']) || $_FILES[$fileKey]['tmp_name'] == null) {
                        $iconLibraryKey = 'iconLibrary_' . $language['id_lang'];
                        $iconLibraryValue = Tools::getValue($iconLibraryKey);
                        if (!in_array($iconLibraryValue, ['fa', 'mi'])) {
                            $this->context->controller->errors[] = $this->l('An error occurred while saving the selected icon');
                        }
                        $libIconKey = 'lib_icon_' . $language['id_lang'];
                        $libIconValue = Tools::getValue($libIconKey);
                        if (!empty($libIconValue)) {
                            if ($libIconValue === 'empty') {
                                $AdvancedTopMenuColumnClass->image_type[$language['id_lang']] = '';
                                $AdvancedTopMenuColumnClass->image_class[$language['id_lang']] = '';
                                $AdvancedTopMenuColumnClass->have_icon[$language['id_lang']] = '';
                            } else {
                                $AdvancedTopMenuColumnClass->image_type[$language['id_lang']] = 'i-' . $iconLibraryValue;
                                $AdvancedTopMenuColumnClass->image_class[$language['id_lang']] = $libIconValue;
                                $AdvancedTopMenuColumnClass->have_icon[$language['id_lang']] = 1;
                            }
                            $AdvancedTopMenuColumnClass->update();
                        }
                    }
                }
                if ($AdvancedTopMenuColumnClass->type == 8) {
                    $productElementsObj->id_column = $AdvancedTopMenuColumnClass->id;
                    $productElementsObj->save();
                }
                $this->context->controller->confirmations[] = $this->l('The group of items has successfully been updated');
            }
        }
    }
    protected function postProcessColumnElement()
    {
        $id_element = Tools::getValue('id_element', false);
        $AdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass($id_element);
        $this->context->controller->errors = $AdvancedTopMenuElementsClass->validateController();
        if (!Tools::getValue('id_column', 0)) {
            $this->context->controller->errors[] = $this->l('The parent group of the element is required.');
        }
        if (!Tools::getValue('type', 0)) {
            $this->context->controller->errors[] = $this->l('The type of the element is required.');
        } elseif (Tools::getValue('type') == 1 && !Tools::getValue('id_cms')) {
            $this->context->controller->errors[] = $this->l('You need to select the related CMS.');
        } elseif (Tools::getValue('type') == 3 && !Tools::getValue('id_category')) {
            $this->context->controller->errors[] = $this->l('You need to select the related category.');
        } elseif (Tools::getValue('type') == 4 && !Tools::getValue('include_subs_manu') && !Tools::getValue('id_manufacturer')) {
            $this->context->controller->errors[] = $this->l('You need to select the related manufacturer.');
        } elseif (Tools::getValue('type') == 5 && !Tools::getValue('include_subs_suppl') && !Tools::getValue('id_supplier')) {
            $this->context->controller->errors[] = $this->l('You need to select the related supplier.');
        } elseif (Tools::getValue('type') == 9 && !Tools::getValue('id_specific_page')) {
            $this->context->controller->errors[] = $this->l('You need to select the related specific page.');
        }
        if (!count($this->context->controller->errors)) {
            $this->copyFromPost($AdvancedTopMenuElementsClass);
            $AdvancedTopMenuElementsClass->chosen_groups = Tools::getIsset('chosen_groups') ? json_encode(Tools::getValue('chosen_groups')) : '';
            $languages = Language::getLanguages(false);
            if (!$id_element) {
                if (!$AdvancedTopMenuElementsClass->add()) {
                    $this->context->controller->errors[] = $this->l('An error occurred while adding the item');
                }
            } elseif (!$AdvancedTopMenuElementsClass->update()) {
                $this->context->controller->errors[] = $this->l('An error occurred while updating the item');
            }
            if (!count($this->context->controller->errors)) {
                foreach ($languages as $language) {
                    $fileKey = 'icon_' . $language['id_lang'];
                    if (isset($_FILES[$fileKey]['tmp_name']) and $_FILES[$fileKey]['tmp_name'] != null) {
                        $ext = $this->getFileExtension($_FILES[$fileKey]['name']);
                        if (!in_array($ext, $this->allowFileExtension) || ($ext != 'svg' && !getimagesize($_FILES[$fileKey]['tmp_name'])) || !move_uploaded_file($_FILES[$fileKey]['tmp_name'], _PS_ROOT_DIR_ . '/modules/' . $this->name . '/element_icons/' . $AdvancedTopMenuElementsClass->id . '-' . $language['iso_code'] . '.' . $ext)) {
                            $this->context->controller->errors[] = $this->l('An error occurred during the image upload');
                        } else {
                            $AdvancedTopMenuElementsClass->image_class[$language['id_lang']] = null;
                            $AdvancedTopMenuElementsClass->image_type[$language['id_lang']] = $ext;
                            $AdvancedTopMenuElementsClass->have_icon[$language['id_lang']] = 1;
                            $AdvancedTopMenuElementsClass->update();
                        }
                    } elseif (Tools::getValue('unlink_icon_' . $language['id_lang'])) {
                        unlink(_PS_ROOT_DIR_ . '/modules/' . $this->name . '/element_icons/' . $AdvancedTopMenuElementsClass->id . '-' . $language['iso_code'] . '.' . ($AdvancedTopMenuElementsClass->image_type[$language['id_lang']] ?: 'jpg'));
                        $AdvancedTopMenuElementsClass->have_icon[$language['id_lang']] = '';
                        $AdvancedTopMenuElementsClass->image_type[$language['id_lang']] = '';
                        $AdvancedTopMenuElementsClass->image_legend[$language['id_lang']] = '';
                        $AdvancedTopMenuElementsClass->update();
                    }
                    if (!isset($_FILES[$fileKey]['tmp_name']) || $_FILES[$fileKey]['tmp_name'] == null) {
                        $iconLibraryKey = 'iconLibrary_' . $language['id_lang'];
                        $iconLibraryValue = Tools::getValue($iconLibraryKey);
                        if (!in_array($iconLibraryValue, ['fa', 'mi'])) {
                            $this->context->controller->errors[] = $this->l('An error occurred while saving the selected icon');
                        }
                        $libIconKey = 'lib_icon_' . $language['id_lang'];
                        $libIconValue = Tools::getValue($libIconKey);
                        if (!empty($libIconValue)) {
                            if ($libIconValue === 'empty') {
                                $AdvancedTopMenuElementsClass->image_type[$language['id_lang']] = '';
                                $AdvancedTopMenuElementsClass->image_class[$language['id_lang']] = '';
                                $AdvancedTopMenuElementsClass->have_icon[$language['id_lang']] = '';
                            } else {
                                $AdvancedTopMenuElementsClass->image_type[$language['id_lang']] = 'i-' . $iconLibraryValue;
                                $AdvancedTopMenuElementsClass->image_class[$language['id_lang']] = $libIconValue;
                                $AdvancedTopMenuElementsClass->have_icon[$language['id_lang']] = 1;
                            }
                            $AdvancedTopMenuElementsClass->update();
                        }
                    }
                }
                $this->context->controller->confirmations[] = $this->l('The element has successfully been updated');
            }
        }
    }
    public function outputSelectColumns($id_menu = false, $column_selected = false)
    {
        $columns = AdvancedTopMenuColumnClass::getMenuColumsByIdMenu((int)$id_menu, $this->context->cookie->id_lang, false);
        if (is_array($columns)) {
            foreach ($columns as $k => $column) {
                $columns[$k]['admin_name'] = html_entity_decode($this->getAdminOutputNameValue($column, false));
            }
        }
        $this->context->smarty->assign([
            'columns' => $columns,
            'column_selected' => $column_selected,
        ]);
        return $this->context->smarty->fetch(dirname(__FILE__) . '/views/templates/admin/column_select.tpl');
    }
    public function outputSelectColumnsWrap($id_menu = false, $columnWrap_selected = false)
    {
        $columnsWrap = AdvancedTopMenuColumnWrapClass::getMenuColumnsWrap((int)$id_menu, $this->context->cookie->id_lang, false);
        $this->context->smarty->assign([
            'columnsWrap' => $columnsWrap,
            'columnWrap_selected' => $columnWrap_selected,
        ]);
        return $this->context->smarty->fetch(dirname(__FILE__) . '/views/templates/admin/columnwrap_select.tpl');
    }
    protected function postProcess()
    {
        if (Tools::getIsset('dismissRating')) {
            $this->_html = '';
            self::cleanBuffer();
            Configuration::updateGlobalValue('PM_' . self::$_module_prefix . '_DISMISS_RATING', 1);
            die;
        }
        $this->saveConfig();
        $this->saveAdvancedConfig();
        if (Tools::getIsset('activeMaintenance')) {
            $this->postProcessMaintenance(Tools::getValue('activeMaintenance'));
        } elseif (Tools::getValue('actionColumn') == 'get_select_columns') {
            $id_menu = Tools::getValue('id_menu', false);
            $column_selected = Tools::getValue('column_selected', false);
            self::cleanBuffer();
            echo $this->outputSelectColumns($id_menu, $column_selected);
            die;
        } elseif (Tools::getValue('actionColumn') == 'get_select_columnsWrap') {
            $id_menu = Tools::getValue('id_menu', false);
            $columnWrap_selected = Tools::getValue('columnWrap_selected', false);
            self::cleanBuffer();
            echo $this->outputSelectColumnsWrap($id_menu, $columnWrap_selected);
            die;
        } elseif (Tools::getIsset('elementChange')) {
            $elementId = (int)Tools::getValue('elementChange');
            $newGroupId = (int)Tools::getValue('idGroup');
            if (!empty($elementId) && !empty($newGroupId)) {
                Db::getInstance()->update('pm_advancedtopmenu_elements', ['id_column' => $newGroupId], 'id_element =' . (int)$elementId);
                $order = Tools::getValue('columnElementsPosition') ? explode(',', Tools::getValue('columnElementsPosition')) : [];
                foreach ($order as $position => $id_element) {
                    if (!trim($id_element)) {
                        continue;
                    }
                    $row = ['position' => (int)$position];
                    Db::getInstance()->update('pm_advancedtopmenu_elements', $row, 'id_element =' . (int)$id_element);
                }
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getIsset('columnElementsPosition')) {
            $order = Tools::getValue('columnElementsPosition') ? explode(',', Tools::getValue('columnElementsPosition')) : [];
            foreach ($order as $position => $id_element) {
                $row = ['position' => (int)$position];
                Db::getInstance()->update('pm_advancedtopmenu_elements', $row, 'id_element =' . (int)$id_element);
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getIsset('menuPosition')) {
            $order = Tools::getValue('menuPosition') ? explode(',', Tools::getValue('menuPosition')) : [];
            foreach ($order as $position => $id_menu) {
                if (!trim($id_menu)) {
                    continue;
                }
                $row = ['position' => (int)$position];
                Db::getInstance()->update('pm_advancedtopmenu', $row, 'id_menu =' . (int)$id_menu);
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getIsset('columnPosition')) {
            $order = Tools::getValue('columnPosition') ? explode(',', Tools::getValue('columnPosition')) : [];
            foreach ($order as $position => $id_column) {
                if (!trim($id_column)) {
                    continue;
                }
                $row = ['position' => (int)$position];
                Db::getInstance()->update('pm_advancedtopmenu_columns', $row, 'id_column =' . (int)$id_column);
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getIsset('groupChange')) {
            $columnId = (int)Tools::getValue('idColumn');
            $newGroupId = (int)Tools::getValue('groupChange');
            if (!empty($columnId) && !empty($newGroupId)) {
                Db::getInstance()->update('pm_advancedtopmenu_columns', ['id_wrap' => $newGroupId], 'id_column =' . (int)$columnId);
                $order = Tools::getValue('orderColumn') ? explode(',', Tools::getValue('orderColumn')) : [];
                foreach ($order as $position => $id_column) {
                    if (!trim($id_column)) {
                        continue;
                    }
                    $row = ['position' => (int)$position];
                    Db::getInstance()->update('pm_advancedtopmenu_columns', $row, 'id_column =' . (int)$id_column);
                }
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getIsset('columnWrapPosition')) {
            $order = Tools::getValue('columnWrapPosition') ? explode(',', Tools::getValue('columnWrapPosition')) : [];
            foreach ($order as $position => $id_wrap) {
                if (!trim($id_wrap)) {
                    continue;
                }
                $row = ['position' => (int)$position];
                Db::getInstance()->update('pm_advancedtopmenu_columns_wrap', $row, 'id_wrap =' . (int)$id_wrap);
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $this->l('Saved');
            die;
        } elseif (Tools::getValue('activeMenu') && Tools::getValue('id_menu')) {
            $return = '';
            $ObjAdvancedTopMenuClass = new AdvancedTopMenuClass(Tools::getValue('id_menu'));
            $ObjAdvancedTopMenuClass->active = ($ObjAdvancedTopMenuClass->active ? 0 : 1);
            if ($ObjAdvancedTopMenuClass->save()) {
                if ($ObjAdvancedTopMenuClass->active) {
                    $return .= '$("#imgActiveMenu' . $ObjAdvancedTopMenuClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveMenu' . $ObjAdvancedTopMenuClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activemenu","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activemenu","' . $this->l('An error occurred while updating the tab') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeColumnWrap') && Tools::getValue('id_wrap')) {
            $return = '';
            $ObjAdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass(Tools::getValue('id_wrap'));
            $ObjAdvancedTopMenuColumnWrapClass->active = ($ObjAdvancedTopMenuColumnWrapClass->active ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnWrapClass->save()) {
                if ($ObjAdvancedTopMenuColumnWrapClass->active) {
                    $return .= '$("#imgActiveColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activecolumnwrap","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activecolumnwrap","' . $this->l('An error occurred while updating the column') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeColumn') && Tools::getValue('id_column')) {
            $return = '';
            $ObjAdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass(Tools::getValue('id_column'));
            $ObjAdvancedTopMenuColumnClass->active = ($ObjAdvancedTopMenuColumnClass->active ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnClass->save()) {
                if ($ObjAdvancedTopMenuColumnClass->active) {
                    $return .= '$("#imgActiveColumn' . $ObjAdvancedTopMenuColumnClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveColumn' . $ObjAdvancedTopMenuColumnClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activegroup","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activegroup","' . $this->l('An error occurred while updating the group of items') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeElement') && Tools::getValue('id_element')) {
            $return = '';
            $AdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass(Tools::getValue('id_element'));
            $AdvancedTopMenuElementsClass->active = ($AdvancedTopMenuElementsClass->active ? 0 : 1);
            if ($AdvancedTopMenuElementsClass->save()) {
                if ($AdvancedTopMenuElementsClass->active) {
                    $return .= '$("#imgActiveElement' . $AdvancedTopMenuElementsClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveElement' . $AdvancedTopMenuElementsClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activeelement","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activeelement","' . $this->l('An error occurred while updating the item') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeDesktopMenu') && Tools::getValue('id_menu')) {
            $return = '';
            $ObjAdvancedTopMenuClass = new AdvancedTopMenuClass(Tools::getValue('id_menu'));
            $ObjAdvancedTopMenuClass->active_desktop = ($ObjAdvancedTopMenuClass->active_desktop ? 0 : 1);
            if ($ObjAdvancedTopMenuClass->save()) {
                if ($ObjAdvancedTopMenuClass->active_desktop) {
                    $return .= '$("#imgActiveDesktopMenu' . $ObjAdvancedTopMenuClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveDesktopMenu' . $ObjAdvancedTopMenuClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activedesktopmenu","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activedesktopmenu","' . $this->l('An error occurred while updating the tab') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeMobileMenu') && Tools::getValue('id_menu')) {
            $return = '';
            $ObjAdvancedTopMenuClass = new AdvancedTopMenuClass(Tools::getValue('id_menu'));
            $ObjAdvancedTopMenuClass->active_mobile = ($ObjAdvancedTopMenuClass->active_mobile ? 0 : 1);
            if ($ObjAdvancedTopMenuClass->save()) {
                if ($ObjAdvancedTopMenuClass->active_mobile) {
                    $return .= '$("#imgActiveMobileMenu' . $ObjAdvancedTopMenuClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveMobileMenu' . $ObjAdvancedTopMenuClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activemobilemenu","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activemobilemenu","' . $this->l('An error occurred while updating the tab') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeDesktopColumnWrap') && Tools::getValue('id_wrap')) {
            $return = '';
            $ObjAdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass(Tools::getValue('id_wrap'));
            $ObjAdvancedTopMenuColumnWrapClass->active_desktop = ($ObjAdvancedTopMenuColumnWrapClass->active_desktop ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnWrapClass->save()) {
                if ($ObjAdvancedTopMenuColumnWrapClass->active_desktop) {
                    $return .= '$("#imgActiveDesktopColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveDesktopColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activedesktopcolumnwrap","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activedesktopcolumnwrap","' . $this->l('An error occurred while updating the column') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeMobileColumnWrap') && Tools::getValue('id_wrap')) {
            $return = '';
            $ObjAdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass(Tools::getValue('id_wrap'));
            $ObjAdvancedTopMenuColumnWrapClass->active_mobile = ($ObjAdvancedTopMenuColumnWrapClass->active_mobile ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnWrapClass->save()) {
                if ($ObjAdvancedTopMenuColumnWrapClass->active_mobile) {
                    $return .= '$("#imgActiveMobileColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveMobileColumnWrap' . $ObjAdvancedTopMenuColumnWrapClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activemobilecolumnwrap","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activemobilecolumnwrap","' . $this->l('An error occurred while updating the column') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeDesktopColumn') && Tools::getValue('id_column')) {
            $return = '';
            $ObjAdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass(Tools::getValue('id_column'));
            $ObjAdvancedTopMenuColumnClass->active_desktop = ($ObjAdvancedTopMenuColumnClass->active_desktop ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnClass->save()) {
                if ($ObjAdvancedTopMenuColumnClass->active_desktop) {
                    $return .= '$("#imgActiveDesktopColumn' . $ObjAdvancedTopMenuColumnClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveDesktopColumn' . $ObjAdvancedTopMenuColumnClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activedesktopgroup","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activedesktopgroup","' . $this->l('An error occurred while updating the group of items') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeMobileColumn') && Tools::getValue('id_column')) {
            $return = '';
            $ObjAdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass(Tools::getValue('id_column'));
            $ObjAdvancedTopMenuColumnClass->active_mobile = ($ObjAdvancedTopMenuColumnClass->active_mobile ? 0 : 1);
            if ($ObjAdvancedTopMenuColumnClass->save()) {
                if ($ObjAdvancedTopMenuColumnClass->active_mobile) {
                    $return .= '$("#imgActiveMobileColumn' . $ObjAdvancedTopMenuColumnClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveMobileColumn' . $ObjAdvancedTopMenuColumnClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activemobilegroup","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activemobilegroup","' . $this->l('An error occurred while updating the group of items') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeDesktopElement') && Tools::getValue('id_element')) {
            $return = '';
            $AdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass(Tools::getValue('id_element'));
            $AdvancedTopMenuElementsClass->active_desktop = ($AdvancedTopMenuElementsClass->active_desktop ? 0 : 1);
            if ($AdvancedTopMenuElementsClass->save()) {
                if ($AdvancedTopMenuElementsClass->active_desktop) {
                    $return .= '$("#imgActiveDesktopElement' . $AdvancedTopMenuElementsClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveDesktopElement' . $AdvancedTopMenuElementsClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activedesktopelement","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activedesktopelement","' . $this->l('An error occurred while updating the item') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('activeMobileElement') && Tools::getValue('id_element')) {
            $return = '';
            $AdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass(Tools::getValue('id_element'));
            $AdvancedTopMenuElementsClass->active_mobile = ($AdvancedTopMenuElementsClass->active_mobile ? 0 : 1);
            if ($AdvancedTopMenuElementsClass->save()) {
                if ($AdvancedTopMenuElementsClass->active_mobile) {
                    $return .= '$("#imgActiveMobileElement' . $AdvancedTopMenuElementsClass->id . '").addClass("active").text("check");';
                } else {
                    $return .= '$("#imgActiveMobileElement' . $AdvancedTopMenuElementsClass->id . '").removeClass("active").text("clear");';
                }
                $return .= 'show_info("activemobileelement","' . $this->l('Saved') . '");';
            } else {
                $return .= 'show_info("activemobileelement","' . $this->l('An error occurred while updating the item') . '");';
            }
            $this->clearModuleCache();
            self::cleanBuffer();
            echo $return;
            die;
        } elseif (Tools::getValue('deleteMenu') && Tools::getValue('id_menu')) {
            $ObjAdvancedTopMenuClass = new AdvancedTopMenuClass(Tools::getValue('id_menu'));
            if ($ObjAdvancedTopMenuClass->delete()) {
                $this->context->controller->confirmations[] = $this->l('The tab was successfully deleted');
            } else {
                $this->context->controller->errors[] = $this->l('An error occurred while deleting the column');
            }
            $this->clearModuleCache();
        } elseif (Tools::getValue('deleteColumnWrap') && Tools::getValue('id_wrap')) {
            $ObjAdvancedTopMenuColumnWrapClass = new AdvancedTopMenuColumnWrapClass(Tools::getValue('id_wrap'));
            if ($ObjAdvancedTopMenuColumnWrapClass->delete()) {
                $this->context->controller->confirmations[] = $this->l('The column was successfully deleted');
            } else {
                $this->context->controller->errors[] = $this->l('An error occurred while deleting the column');
            }
            $this->clearModuleCache();
        } elseif (Tools::getValue('deleteColumn') && Tools::getValue('id_column')) {
            $ObjAdvancedTopMenuColumnClass = new AdvancedTopMenuColumnClass(Tools::getValue('id_column'));
            if ($ObjAdvancedTopMenuColumnClass->delete()) {
                $this->context->controller->confirmations[] = $this->l('The group of items was successfully deleted');
            } else {
                $this->context->controller->errors[] = $this->l('An error occurred while deleting the group of items');
            }
            $this->clearModuleCache();
        } elseif (Tools::getValue('deleteElement') && Tools::getValue('id_element')) {
            $AdvancedTopMenuElementsClass = new AdvancedTopMenuElementsClass(Tools::getValue('id_element'));
            if ($AdvancedTopMenuElementsClass->delete()) {
                $this->context->controller->confirmations[] = $this->l('The item was successfully deleted');
            } else {
                $this->context->controller->errors[] = $this->l('An error occurred while deleting the item');
            }
            $this->clearModuleCache();
        } elseif (Tools::isSubmit('submitMenu')) {
            $this->postProcessMenu();
            $this->clearModuleCache();
        } elseif (Tools::isSubmit('submitColumnWrap')) {
            $this->postProcessColumnWrap();
            $this->clearModuleCache();
        } elseif (Tools::isSubmit('submitColumn')) {
            $this->postProcessColumn();
            $this->clearModuleCache();
        } elseif (Tools::isSubmit('submitElement')) {
            $this->postProcessColumnElement();
            $this->clearModuleCache();
        }
    }
    protected function getBorderSizeFromArray($borderArray)
    {
        if (!is_array($borderArray)) {
            return false;
        }
        $borderStr = '';
        foreach ($borderArray as $border) {
            if ($border == 'auto') {
                $borderStr .= 'auto ';
            } else {
                if (is_numeric($border)) {
                    $borderStr .= (int)$border . 'px ';
                } else {
                    $borderStr .= 'unset ';
                }
            }
        }
        return rtrim($borderStr);
    }
    protected function getPositionSizeFromArray($positionArray, $toCSSString = true)
    {
        if (!is_array($positionArray) || count($positionArray) < 4) {
            return '';
        }
        $positionStr = '';
        if ($toCSSString) {
            if (Tools::strlen(trim($positionArray[0])) > 0) {
                $positionStr .= 'top:' . $positionArray[0] . ';';
            }
            if (Tools::strlen(trim($positionArray[1])) > 0) {
                $positionStr .= 'right:' . $positionArray[1] . ';';
            }
            if (Tools::strlen(trim($positionArray[2])) > 0) {
                $positionStr .= 'bottom:' . $positionArray[2] . ';';
            }
            if (Tools::strlen(trim($positionArray[3])) > 0) {
                $positionStr .= 'left:' . $positionArray[3] . ';';
            }
        } else {
            foreach ($positionArray as $position) {
                if (Tools::strlen(trim($position)) > 0 && is_numeric($position)) {
                    $positionStr .= (int)$position . 'px ';
                } else {
                    $positionStr .= ' ';
                }
            }
        }
        return $positionStr;
    }
    protected function getConfigKeys()
    {
        $config = $configResponsive = [];
        foreach ($this->_fieldsOptions as $key => $data) {
            if (isset($data['mobile']) && $data['mobile']) {
                $configResponsive[] = $key;
            } else {
                $config[] = $key;
            }
        }
        return [
            $config,
            $configResponsive,
        ];
    }
    protected function generateGlobalCss($id_shop = false)
    {
        list($config, $configResponsive) = $this->getConfigKeys();
        if ($id_shop != false) {
            $configGlobalCss = Configuration::getMultiple($config, null, null, $id_shop);
            $configResponsiveCss = Configuration::getMultiple($configResponsive, null, null, $id_shop);
        } else {
            $configGlobalCss = Configuration::getMultiple($config);
            $configResponsiveCss = Configuration::getMultiple($configResponsive);
        }
        if (empty($configResponsiveCss['ATMR_MENU_BGCOLOR_OP'])) {
            $configResponsiveCss['ATMR_MENU_BGCOLOR_OP'] = $configGlobalCss['ATM_MENU_BGCOLOR_OVER'];
        }
        if (empty($configResponsiveCss['ATMR_MENU_BGCOLOR_CL'])) {
            $configResponsiveCss['ATMR_MENU_BGCOLOR_CL'] = $configGlobalCss['ATM_MENU_BGCOLOR'];
        }
        $hoverCSSselector = ':hover';
        if (!empty($configGlobalCss['ATM_SUBMENU_OPEN_METHOD']) && $configGlobalCss['ATM_SUBMENU_OPEN_METHOD'] == 2) {
            $hoverCSSselector = '.atm_clicked';
        }
        $specificDesktopCss = [];
        $css = [];
        $configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR'] = explode($this->gradient_separator, $configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR']);
        if (isset($configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR'][1])) {
            $color1 = htmlentities($configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR'][0], ENT_COMPAT, 'UTF-8');
            $color2 = htmlentities($configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR'][1], ENT_COMPAT, 'UTF-8');
            $css[] = '#adtm_menu_inner {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
        } else {
            $css[] = '#adtm_menu_inner {background-color:' . htmlentities($configGlobalCss['ATM_MENU_GLOBAL_BGCOLOR'][0], ENT_COMPAT, 'UTF-8') . ';}';
        }
        $configGlobalCss['ATM_MENU_BOX_SHADOWOPACITY'] = round($configGlobalCss['ATM_MENU_BOX_SHADOWOPACITY'] / 100, 1);
        if ($configGlobalCss['ATM_MENU_CONT_POSITION'] == 'sticky') {
            $css[] = '#adtm_menu {position:relative;' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_MENU_CONT_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_MENU_CONT_MARGIN']) . ';border-color:' . htmlentities($configGlobalCss['ATM_MENU_CONT_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configGlobalCss['ATM_MENU_CONT_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';box-shadow: ' . htmlentities($configGlobalCss['ATM_MENU_BOX_SHADOW'], ENT_COMPAT, 'UTF-8') . ' ' . htmlentities($this->hex2rgb($configGlobalCss['ATM_MENU_BOX_SHADOWCOLOR'], $configGlobalCss['ATM_MENU_BOX_SHADOWOPACITY']), ENT_COMPAT, 'UTF-8') . ';}';
        } else {
            $css[] = '#adtm_menu {position:' . htmlentities($configGlobalCss['ATM_MENU_CONT_POSITION'], ENT_COMPAT, 'UTF-8') . ';' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_MENU_CONT_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_MENU_CONT_MARGIN']) . ';border-color:' . htmlentities($configGlobalCss['ATM_MENU_CONT_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configGlobalCss['ATM_MENU_CONT_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . '; box-shadow: ' . htmlentities($configGlobalCss['ATM_MENU_BOX_SHADOW'], ENT_COMPAT, 'UTF-8') . ' ' . htmlentities($this->hex2rgb($configGlobalCss['ATM_MENU_BOX_SHADOWCOLOR'], $configGlobalCss['ATM_MENU_BOX_SHADOWOPACITY']), ENT_COMPAT, 'UTF-8') . ';}';
        }
        $configGlobalCss['ATM_MENU_CONT_POSITION_TRBL'] = $this->getPositionSizeFromArray(explode(' ', $configGlobalCss['ATM_MENU_CONT_POSITION_TRBL']));
        if (!empty($configGlobalCss['ATM_MENU_CONT_POSITION_TRBL'])) {
            $css[] = '#adtm_menu {' . htmlentities($configGlobalCss['ATM_MENU_CONT_POSITION_TRBL'], ENT_COMPAT, 'UTF-8') . '}';
        }
        $css[] = '#adtm_menu_inner {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_MENU_GLOBAL_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_MENU_GLOBAL_MARGIN']) . ';border-color:' . htmlentities($configGlobalCss['ATM_MENU_GLOBAL_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configGlobalCss['ATM_MENU_GLOBAL_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '#adtm_menu .li-niveau1 a.a-niveau1 {min-height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px;line-height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px;}';
        $css[] = '#adtm_menu .li-niveau1 a.a-niveau1.a-multiline {line-height:' . number_format((int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] / 2, 2) . 'px;}';
        if ($configGlobalCss['ATM_MENU_GLOBAL_WIDTH']) {
            $css[] = '#adtm_menu_inner {width:' . htmlentities($configGlobalCss['ATM_MENU_GLOBAL_WIDTH'], ENT_COMPAT, 'UTF-8') . 'px !important;}';
        }
        $css[] = '#adtm_menu .li-niveau1 {min-height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px; line-height:' . ((int)$configGlobalCss['ATM_COLUMN_FONT_SIZE'] + 5) . 'px;}';
        $css[] = '#adtm_menu .li-niveau1 a.a-niveau1 .advtm_menu_span {min-height:' . ((int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT']) . 'px;line-height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px;}';
        $css[] = '#adtm_menu .li-niveau1 a.a-niveau1.a-multiline .advtm_menu_span {line-height:' . number_format((int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] / 2, 2) . 'px;}';
        $css[] = '#adtm_menu .li-niveau1 .searchboxATM { display: table-cell; height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px; vertical-align: middle; }';
        $css[] = '#adtm_menu .li-niveau1 .searchboxATM .adtm_search_submit_button { height:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] . 'px; }';
        $topDiff = 0;
        $atmMenuMarginTable = explode(' ', $configGlobalCss['ATM_MENU_MARGIN']);
        $atmMenuPaddingTable = explode(' ', $configGlobalCss['ATM_MENU_PADDING']);
        if (count($atmMenuMarginTable) == 4) {
            $topDiff += (int)$atmMenuMarginTable[0] + (int)$atmMenuMarginTable[2];
        }
        if (count($atmMenuPaddingTable) == 4) {
            $topDiff += (int)$atmMenuPaddingTable[0] + (int)$atmMenuPaddingTable[2];
        }
        $css[] = '#adtm_menu ul#menu li div.adtm_sub {top:' . ((int)$configGlobalCss['ATM_MENU_GLOBAL_HEIGHT'] + $topDiff) . 'px;}';
        $css[] = '.li-niveau1 a span {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_MENU_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_MENU_MARGIN']) . '}';
        $css[] = '.li-niveau1 .advtm_menu_span, .li-niveau1 a .advtm_menu_span {color:' . htmlentities($configGlobalCss['ATM_MENU_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '@media (min-width: ' . ((int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) {';
        $css[] = '#adtm_menu ul#menu {display:flex;flex-wrap:wrap;}';
        $css[] = '}';
        if ((int)$configGlobalCss['ATM_MENU_CENTER_TABS'] == 1) {
            $css[] = '@media (min-width: ' . ((int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) {';
            $css[] = '#adtm_menu ul#menu {justify-content:flex-start;}';
            $css[] = '}';
        } elseif (in_array((int)$configGlobalCss['ATM_MENU_CENTER_TABS'], [2, 3])) {
            $css[] = '@media (min-width: ' . ((int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) {';
            $css[] = '#adtm_menu ul#menu {justify-content:center;}';
            $css[] = '}';
            if ((int)$configGlobalCss['ATM_MENU_CENTER_TABS'] == 3) {
                $css[] = '@media (min-width: ' . ((int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) {';
                $css[] = '#adtm_menu ul#menu li.li-niveau1 {flex:1;}';
                $css[] = '#adtm_menu ul#menu li.li-niveau1 a.a-niveau1 {float:none;}';
                $css[] = '#adtm_menu ul#menu li.li-niveau1 a.a-niveau1 .advtm_menu_span {display:flex;justify-content:center;flex:1;align-items:center;}';
                $css[] = '}';
            }
        } elseif ((int)$configGlobalCss['ATM_MENU_CENTER_TABS'] == 4) {
            $css[] = '@media (min-width: ' . ((int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) {';
            $css[] = '#adtm_menu ul#menu {justify-content:flex-end;}';
            $css[] = '}';
        }
        $configGlobalCss['ATM_MENU_BGCOLOR'] = explode($this->gradient_separator, $configGlobalCss['ATM_MENU_BGCOLOR']);
        if (isset($configGlobalCss['ATM_MENU_BGCOLOR'][1])) {
            $color1 = htmlentities($configGlobalCss['ATM_MENU_BGCOLOR'][0], ENT_COMPAT, 'UTF-8');
            $color2 = htmlentities($configGlobalCss['ATM_MENU_BGCOLOR'][1], ENT_COMPAT, 'UTF-8');
            $css[] = '.li-niveau1 a .advtm_menu_span, .li-niveau1 .advtm_menu_span {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
        } else {
            $css[] = '.li-niveau1 a .advtm_menu_span, .li-niveau1 .advtm_menu_span {background-color:' . htmlentities($configGlobalCss['ATM_MENU_BGCOLOR'][0], ENT_COMPAT, 'UTF-8') . ';}';
        }
        $configGlobalCss['ATM_MENU_BGCOLOR_OVER'] = explode($this->gradient_separator, $configGlobalCss['ATM_MENU_BGCOLOR_OVER']);
        if (isset($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][1])) {
            $color1 = htmlentities($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][0], ENT_COMPAT, 'UTF-8');
            $color2 = htmlentities($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][1], ENT_COMPAT, 'UTF-8');
            $specificDesktopCss[] = '.li-niveau1 a:hover .advtm_menu_span, .li-niveau1 .advtm_menu_span:hover, .li-niveau1:hover > a.a-niveau1 .advtm_menu_span {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            $css[] = '.li-niveau1 a.advtm_menu_actif .advtm_menu_span {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            if ($hoverCSSselector != ':hover') {
                $css[] = '.li-niveau1' . $hoverCSSselector . ' a .advtm_menu_span, .li-niveau1 a.advtm_menu_actif .advtm_menu_span, .li-niveau1' . $hoverCSSselector . ' .advtm_menu_span, .li-niveau1' . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            }
        } else {
            $specificDesktopCss[] = '.li-niveau1 a:hover .advtm_menu_span, .li-niveau1 .advtm_menu_span:hover, .li-niveau1:hover > a.a-niveau1 .advtm_menu_span {background-color:' . htmlentities($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][0], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '.li-niveau1 a.advtm_menu_actif .advtm_menu_span {background-color:' . htmlentities($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][0], ENT_COMPAT, 'UTF-8') . ';}';
            if ($hoverCSSselector != ':hover') {
                $css[] = '.li-niveau1' . $hoverCSSselector . ' a .advtm_menu_span, .li-niveau1 a.advtm_menu_actif .advtm_menu_span, .li-niveau1' . $hoverCSSselector . ' .advtm_menu_span, .li-niveau1' . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span {background-color:' . htmlentities($configGlobalCss['ATM_MENU_BGCOLOR_OVER'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
        }
        $css[] = '.li-niveau1 a.a-niveau1 {border-color:' . htmlentities($configGlobalCss['ATM_MENU_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configGlobalCss['ATM_MENU_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';}';
        $configGlobalCss['ATM_SUBMENU_BOX_SHADOWOPACITY'] = round($configGlobalCss['ATM_SUBMENU_BOX_SHADOWOPACITY'] / 100, 1);
        $css[] = '.li-niveau1 .adtm_sub {border-color:' . htmlentities($configGlobalCss['ATM_SUBMENU_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . '; border-width:' . htmlentities($configGlobalCss['ATM_SUBMENU_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . '; box-shadow: ' . htmlentities($configGlobalCss['ATM_SUBMENU_BOX_SHADOW'], ENT_COMPAT, 'UTF-8') . ' ' . htmlentities($this->hex2rgb($configGlobalCss['ATM_SUBMENU_BOX_SHADOWCOLOR'], $configGlobalCss['ATM_SUBMENU_BOX_SHADOWOPACITY']), ENT_COMPAT, 'UTF-8') . ';}';
        $configGlobalCss['ATM_SUBMENU_BGOPACITY'] = round($configGlobalCss['ATM_SUBMENU_BGOPACITY'] / 100, 1);
        $configGlobalCss['ATM_SUBMENU_BGCOLOR'] = explode($this->gradient_separator, $configGlobalCss['ATM_SUBMENU_BGCOLOR']);
        if (isset($configGlobalCss['ATM_SUBMENU_BGCOLOR'][1])) {
            $color1 = htmlentities($this->hex2rgb($configGlobalCss['ATM_SUBMENU_BGCOLOR'][0], $configGlobalCss['ATM_SUBMENU_BGOPACITY']), ENT_COMPAT, 'UTF-8');
            $color2 = htmlentities($this->hex2rgb($configGlobalCss['ATM_SUBMENU_BGCOLOR'][1], $configGlobalCss['ATM_SUBMENU_BGOPACITY']), ENT_COMPAT, 'UTF-8');
            $css[] = '.li-niveau1 .adtm_sub {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
        } else {
            $css[] = '.li-niveau1 .adtm_sub {background-color:' . htmlentities($this->hex2rgb($configGlobalCss['ATM_SUBMENU_BGCOLOR'][0], $configGlobalCss['ATM_SUBMENU_BGOPACITY']), ENT_COMPAT, 'UTF-8') . ';}';
        }
        if ($configGlobalCss['ATM_SUBMENU_WIDTH']) {
            $css[] = '.li-niveau1 .adtm_sub {width:' . htmlentities($configGlobalCss['ATM_SUBMENU_WIDTH'], ENT_COMPAT, 'UTF-8') . 'px;}';
        }
        if ($configGlobalCss['ATM_SUBMENU_HEIGHT']) {
            $css[] = '.li-niveau1 .adtm_sub {min-height:' . htmlentities($configGlobalCss['ATM_SUBMENU_HEIGHT'], ENT_COMPAT, 'UTF-8') . 'px;}';
            $css[] = '* html .li-niveau1 .adtm_sub {height:' . htmlentities($configGlobalCss['ATM_SUBMENU_HEIGHT'], ENT_COMPAT, 'UTF-8') . 'px;}';
            $css[] = '#adtm_menu div.adtm_column_wrap {min-height:' . htmlentities($configGlobalCss['ATM_SUBMENU_HEIGHT'], ENT_COMPAT, 'UTF-8') . 'px;}';
            $css[] = '* html #adtm_menu div.adtm_column_wrap {height:' . htmlentities($configGlobalCss['ATM_SUBMENU_HEIGHT'], ENT_COMPAT, 'UTF-8') . 'px;}';
        }
        $css[] = '#adtm_menu ul#menu .li-niveau1 div.adtm_sub {opacity: 0; visibility: hidden;}';
        $openingDelay = (!empty($configGlobalCss['ATM_SUBMENU_OPEN_DELAY']) ? (float)$configGlobalCss['ATM_SUBMENU_OPEN_DELAY'] : 0);
        $fadingSpeed = (!empty($configGlobalCss['ATM_SUBMENU_FADE_SPEED']) ? (float)$configGlobalCss['ATM_SUBMENU_FADE_SPEED'] : 0);
        $css[] = '#adtm_menu ul#menu .li-niveau1' . $hoverCSSselector . ' div.adtm_sub { opacity: 1;visibility: visible; transition:visibility 0s linear ' . $openingDelay . 's, opacity ' . $fadingSpeed . 's linear ' . $openingDelay . 's;}';
        $css[] = '.adtm_column_wrap span.column_wrap_title, .adtm_column_wrap span.column_wrap_title a, .adtm_column_wrap span.column_wrap_title span[data-href] {color:' . htmlentities($configGlobalCss['ATM_COLUMN_TITLE_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '.adtm_column_wrap a, .adtm_column_wrap span[data-href] {color:' . htmlentities($configGlobalCss['ATM_COLUMN_ITEM_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '#adtm_menu .adtm_column_wrap {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_COLUMNWRAP_PADDING']) . '}';
        $css[] = '#adtm_menu .adtm_column {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_COLUMN_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_COLUMN_MARGIN']) . '}';
        $css[] = '#adtm_menu .adtm_column ul.adtm_elements li a, #adtm_menu .adtm_column ul.adtm_elements li span[data-href] {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_COLUMN_ITEM_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_COLUMN_ITEM_MARGIN']) . '}';
        $css[] = '#adtm_menu .adtm_column_wrap span.column_wrap_title {' . $this->generateOptimizedCssRule('padding', $configGlobalCss['ATM_COLUMNTITLE_PADDING']) . $this->generateOptimizedCssRule('margin', $configGlobalCss['ATM_COLUMNTITLE_MARGIN']) . '}';
        $css[] = '#adtm_menu .li-niveau1 a.a-niveau1 .advtm_menu_span {' . ($configGlobalCss['ATM_MENU_FONT_SIZE'] ? 'font-size:' . htmlentities($configGlobalCss['ATM_MENU_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configGlobalCss['ATM_MENU_FONT_BOLD'] ? 'bold' : 'normal') . '; text-decoration:' . ($configGlobalCss['ATM_MENU_FONT_UNDERLINE'] ? 'underline' : 'none') . '; text-transform:' . htmlentities($configGlobalCss['ATM_MENU_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';}';
        $specificDesktopCss[] = '#adtm_menu .li-niveau1 a.a-niveau1:hover .advtm_menu_span, .li-niveau1:hover > a.a-niveau1 .advtm_menu_span {color:' . htmlentities($configGlobalCss['ATM_MENU_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_MENU_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
        $css[] = '#adtm_menu .li-niveau1 a.advtm_menu_actif .advtm_menu_span {color:' . htmlentities($configGlobalCss['ATM_MENU_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_MENU_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
        if ($hoverCSSselector != ':hover') {
            $css[] = '#adtm_menu .li-niveau1' . $hoverCSSselector . ' a.a-niveau1 .advtm_menu_span, #adtm_menu .li-niveau1 a.advtm_menu_actif .advtm_menu_span, .li-niveau1' . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span {color:' . htmlentities($configGlobalCss['ATM_MENU_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_MENU_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
        }
        if ($configGlobalCss['ATM_MENU_FONT_FAMILY']) {
            $css[] = '#adtm_menu .li-niveau1 a.a-niveau1 .advtm_menu_span {font-family:' . htmlentities($configGlobalCss['ATM_MENU_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';}';
        }
        $css[] = '#adtm_menu .adtm_column span.column_wrap_title, #adtm_menu .adtm_column span.column_wrap_title a, #adtm_menu .adtm_column span.column_wrap_title span[data-href] {' . ($configGlobalCss['ATM_COLUMN_FONT_SIZE'] ? 'font-size:' . htmlentities($configGlobalCss['ATM_COLUMN_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configGlobalCss['ATM_COLUMN_FONT_BOLD'] ? 'bold' : 'normal') . '; text-decoration:' . ($configGlobalCss['ATM_COLUMN_FONT_UNDERLINE'] ? 'underline' : 'none') . '; text-transform:' . htmlentities($configGlobalCss['ATM_COLUMN_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '#adtm_menu .adtm_column span.column_wrap_title:hover, #adtm_menu .adtm_column span.column_wrap_title a:hover, #adtm_menu .adtm_column span.column_wrap_title span[data-href]:hover {color:' . htmlentities($configGlobalCss['ATM_COLUMN_TITLE_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_COLUMN_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
        if ($configGlobalCss['ATM_COLUMN_FONT_FAMILY']) {
            $css[] = '#adtm_menu .adtm_column span.column_wrap_title, #adtm_menu .adtm_column span.column_wrap_title a, #adtm_menu .adtm_column span.column_wrap_title span[data-href] {font-family:' . htmlentities($configGlobalCss['ATM_COLUMN_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';}';
        }
        $css[] = '#adtm_menu .adtm_column ul.adtm_elements li, #adtm_menu .adtm_column ul.adtm_elements li a, #adtm_menu .adtm_column ul.adtm_elements li span[data-href] {' . ($configGlobalCss['ATM_COLUMN_ITEM_FONT_SIZE'] ? 'font-size:' . htmlentities($configGlobalCss['ATM_COLUMN_ITEM_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configGlobalCss['ATM_COLUMN_ITEM_FONT_BOLD'] ? 'bold' : 'normal') . '; text-decoration:' . ($configGlobalCss['ATM_COLUMN_ITEM_FONT_UNDERLINE'] ? 'underline' : 'none') . '; text-transform:' . htmlentities($configGlobalCss['ATM_COLUMN_ITEM_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';}';
        $css[] = '#adtm_menu .adtm_column ul.adtm_elements li:hover, #adtm_menu .adtm_column ul.adtm_elements li a:hover, #adtm_menu .adtm_column ul.adtm_elements li span[data-href]:hover {color:' . htmlentities($configGlobalCss['ATM_COLUMN_ITEM_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_COLUMN_ITEM_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
        if ($configGlobalCss['ATM_COLUMN_ITEM_FONT_FAMILY']) {
            $css[] = '#adtm_menu .adtm_column ul.adtm_elements li, #adtm_menu .adtm_column ul.adtm_elements li a, #adtm_menu .adtm_column ul.adtm_elements li span[data-href] {font-family:' . htmlentities($configGlobalCss['ATM_COLUMN_ITEM_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';}';
        }
        if ((int)$configGlobalCss['ATM_SUBMENU_POSITION'] == 1) {
            $css[] = '#adtm_menu ul#menu li.li-niveau1' . $hoverCSSselector . ', #adtm_menu ul#menu li.li-niveau1 a.a-niveau1' . $hoverCSSselector . ' {position:relative;}';
        } elseif ((int)$configGlobalCss['ATM_SUBMENU_POSITION'] == 2) {
            $css[] = '.li-niveau1 .adtm_sub {width: 100%}';
            $css[] = '#adtm_menu table.columnWrapTable {table-layout:fixed;}';
        }
        if ($configGlobalCss['ATM_MENU_GLOBAL_ZINDEX']) {
            $css[] = '#adtm_menu {z-index:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_ZINDEX'] . ';}';
        }
        if ($configGlobalCss['ATM_MENU_CONT_POSITION'] == 'sticky') {
            $css[] = '#adtm_menu-sticky-wrapper {z-index:' . (int)$configGlobalCss['ATM_MENU_GLOBAL_ZINDEX'] . ';}';
        }
        if ($configGlobalCss['ATM_SUBMENU_ZINDEX']) {
            $css[] = '.li-niveau1 .adtm_sub {z-index:' . (int)$configGlobalCss['ATM_SUBMENU_ZINDEX'] . ';}';
        }
        $css[] = '#adtm_menu .advtm_hide_desktop {display:none!important;}';
        if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
            $css[] = '@media (min-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) {';
            $css[] = implode("\n", $specificDesktopCss);
            $css[] = '}';
        } else {
            $css[] = implode("\n", $specificDesktopCss);
        }
        if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
            $css[] = 'div#adtm_menu_inner {width: inherit;}';
            $css[] = '#adtm_menu ul .advtm_menu_toggle {display: none;}';
            $css[] = '@media (max-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) {';
            $css[] = '#adtm_menu {position:relative; top:initial; left:initial; right:initial; bottom:initial;}';
            $css[] = '#adtm_menu .advtm_hide_mobile {display:none!important;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.advtm_search.advtm_hide_mobile {display:none!important;}';
            $css[] = '#adtm_menu a.a-niveau1, #adtm_menu .advtm_menu_span { height: auto !important; }';
            $css[] = '#adtm_menu ul li.li-niveau1 {display: none;}';
            if (empty($configResponsiveCss['ATM_RESP_TOGGLE_ENABLED'])) {
                $css[] = '#adtm_menu ul li.advtm_menu_toggle {width: 1px; height: 1px; visibility: hidden; min-height: 1px !important; border: none; padding: 0; margin: 0; line-height: 1px;}';
            } else {
                $css[] = '#adtm_menu ul li.advtm_menu_toggle {display: block; width: 100%;}';
            }
            $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button {width: 100%; cursor: pointer;}';
            $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-position: right 15px center; background-repeat: no-repeat;}';
            $css[] = '#adtm_menu .adtm_menu_icon { height: auto; max-width: 100%; }';
            $css[] = '#adtm_menu ul .li-niveau1 .adtm_sub {width: auto; height: auto; min-height: inherit;}';
            $css[] = '#adtm_menu ul div.adtm_column_wrap {min-height: inherit; width: 100% !important;}';
            if (isset($configResponsiveCss['ATM_RESP_TOGGLE_ICON']) && !empty($configResponsiveCss['ATM_RESP_TOGGLE_ICON'])) {
                $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-image: url(' . $configResponsiveCss['ATM_RESP_TOGGLE_ICON'] . '); background-position: right 15px center; background-repeat: no-repeat;}';
            }
            $css[] = '#adtm_menu .li-niveau1 a.a-niveau1 .advtm_menu_span {' . ($configResponsiveCss['ATM_RESP_MENU_FONT_SIZE'] ? 'font-size:' . htmlentities($configResponsiveCss['ATM_RESP_MENU_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configResponsiveCss['ATMR_MENU_FONT_BOLD'] ? 'bold' : 'normal') . '; text-transform:' . htmlentities($configResponsiveCss['ATMR_MENU_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';' . (!empty($configResponsiveCss['ATMR_MENU_FONT_FAMILY']) ? 'font-family:' . htmlentities($configResponsiveCss['ATMR_MENU_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';' : '') . '}';
            $css[] = '#adtm_menu .adtm_column span.column_wrap_title, #adtm_menu .adtm_column span.column_wrap_title a, #adtm_menu .adtm_column span.column_wrap_title span[data-href] {' . ($configResponsiveCss['ATM_RESP_COLUMN_FONT_SIZE'] ? 'font-size:' . htmlentities($configResponsiveCss['ATM_RESP_COLUMN_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configResponsiveCss['ATMR_COLUMN_FONT_BOLD'] ? 'bold' : 'normal') . '; text-transform:' . htmlentities($configResponsiveCss['ATMR_COLUMN_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';' . (!empty($configResponsiveCss['ATMR_COLUMN_FONT_FAMILY']) ? 'font-family:' . htmlentities($configResponsiveCss['ATMR_COLUMN_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';' : '') . '}';
            $css[] = '#adtm_menu .adtm_column ul.adtm_elements li, #adtm_menu .adtm_column ul.adtm_elements li a, #adtm_menu .adtm_column ul.adtm_elements li span[data-href] {' . ($configResponsiveCss['ATM_RESP_COLUMN_ITEM_FONT_SIZE'] ? 'font-size:' . htmlentities($configResponsiveCss['ATM_RESP_COLUMN_ITEM_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . ' font-weight:' . ($configResponsiveCss['ATMR_COLUMN_ITEM_FONT_BOLD'] ? 'bold' : 'normal') . '; text-transform:' . htmlentities($configResponsiveCss['ATMR_COLUMN_ITEM_FONT_TRANSFORM'], ENT_COMPAT, 'UTF-8') . ';' . (!empty($configResponsiveCss['ATMR_COLUMN_ITEM_FONT_FAMILY']) ? 'font-family:' . htmlentities($configResponsiveCss['ATMR_COLUMN_ITEM_FONT_FAMILY'], ENT_COMPAT, 'UTF-8') . ';' : '') . '}';
            $css[] = '#adtm_menu .li-niveau1.adtm_sub_open a.a-niveau1 .advtm_menu_span, #adtm_menu .li-niveau1 a.a-niveau1:focus .advtm_menu_span, .li-niveau1:focus > a.a-niveau1 .advtm_menu_span {color:' . htmlentities($configGlobalCss['ATM_MENU_COLOR_OVER'], ENT_COMPAT, 'UTF-8') . '; text-decoration:' . ($configGlobalCss['ATM_MENU_FONT_UNDERLINEOV'] ? 'underline' : 'none') . ';}';
            if (isset($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_OP']) && !empty($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_OP'])) {
                $css[] = '#adtm_menu.adtm_menu_toggle_open ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {color:' . htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_OP'], ENT_COMPAT, 'UTF-8') . ';}';
            }
            if (isset($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_CL']) && !empty($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_CL'])) {
                $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {color:' . htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_COLOR_CL'], ENT_COMPAT, 'UTF-8') . ';}';
            }
            $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {' . ($configResponsiveCss['ATM_RESP_MENU_FONT_SIZE'] ? 'font-size:' . htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_FONT_SIZE'], ENT_COMPAT, 'UTF-8') . 'px;' : '') . 'min-height:' . (int)$configResponsiveCss['ATM_RESP_TOGGLE_HEIGHT'] . 'px;line-height:' . (int)$configResponsiveCss['ATM_RESP_TOGGLE_HEIGHT'] . 'px;}';
            $configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP'] = explode($this->gradient_separator, $configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP']);
            if (isset($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP'][1])) {
                $color1 = htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP'][0], ENT_COMPAT, 'UTF-8');
                $color2 = htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP'][1], ENT_COMPAT, 'UTF-8');
                if (isset($configResponsiveCss['ATM_RESP_TOGGLE_ICON']) && !empty($configResponsiveCss['ATM_RESP_TOGGLE_ICON'])) {
                    $css[] = '#adtm_menu.adtm_menu_toggle_open li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_TOGGLE_ICON'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                } else {
                    $css[] = '#adtm_menu.adtm_menu_toggle_open li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                }
            } else {
                $css[] = '#adtm_menu.adtm_menu_toggle_open li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color:' . htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_OP'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
            $configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL'] = explode($this->gradient_separator, $configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL']);
            if (isset($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL'][1])) {
                $color1 = htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL'][0], ENT_COMPAT, 'UTF-8');
                $color2 = htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL'][1], ENT_COMPAT, 'UTF-8');
                if (isset($configResponsiveCss['ATM_RESP_TOGGLE_ICON']) && !empty($configResponsiveCss['ATM_RESP_TOGGLE_ICON'])) {
                    $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_TOGGLE_ICON'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                } else {
                    $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                }
            } else {
                $css[] = '#adtm_menu ul li.advtm_menu_toggle a.adtm_toggle_menu_button span.adtm_toggle_menu_button_text {background-color:' . htmlentities($configResponsiveCss['ATM_RESP_TOGGLE_BG_COLOR_CL'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'])) {
                $css[] = '#adtm_menu.adtm_menu_toggle_open.atmRtl ul#menu li.li-niveau1.sub a.a-niveau1 span {background-position: left 15px center;}';
                $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.sub a.a-niveau1 span {background-image: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'] . '); background-repeat: no-repeat; background-position: right 15px center;}';
            }
            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'])) {
                $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.sub.adtm_sub_open a.a-niveau1 span {background-image: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'] . '); background-repeat: no-repeat; background-position: right 15px center;}';
            }
            $css[] = '.li-niveau1 a span {' . $this->generateOptimizedCssRule('padding', $configResponsiveCss['ATM_RESP_MENU_PADDING']) . $this->generateOptimizedCssRule('margin', $configResponsiveCss['ATMR_MENU_MARGIN']) . '}';
            $css[] = '.li-niveau1 a.a-niveau1 {border-color:' . htmlentities($configResponsiveCss['ATMR_MENU_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configResponsiveCss['ATMR_MENU_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '.li-niveau1 .advtm_menu_span, .li-niveau1 a .advtm_menu_span {color:' . htmlentities($configResponsiveCss['ATMR_MENU_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
            $configResponsiveCss['ATMR_MENU_BGCOLOR_CL'] = explode($this->gradient_separator, $configResponsiveCss['ATMR_MENU_BGCOLOR_CL']);
            if (isset($configResponsiveCss['ATMR_MENU_BGCOLOR_CL'][1])) {
                $color1 = htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_CL'][0], ENT_COMPAT, 'UTF-8');
                $color2 = htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_CL'][1], ENT_COMPAT, 'UTF-8');
                if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'])) {
                    $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.sub a.a-niveau1 span {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                }
                $css[] = '.li-niveau1 a .advtm_menu_span, .li-niveau1 .advtm_menu_span {background: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            } else {
                $css[] = '.li-niveau1 a .advtm_menu_span, .li-niveau1 .advtm_menu_span {background:' . htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_CL'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
            $configResponsiveCss['ATMR_MENU_BGCOLOR_OP'] = explode($this->gradient_separator, $configResponsiveCss['ATMR_MENU_BGCOLOR_OP']);
            if (isset($configResponsiveCss['ATMR_MENU_BGCOLOR_OP'][1])) {
                $color1 = htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_OP'][0], ENT_COMPAT, 'UTF-8');
                $color2 = htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_OP'][1], ENT_COMPAT, 'UTF-8');
                if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'])) {
                    $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.sub.adtm_sub_open a.a-niveau1 span, #adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.sub a.a-niveau1.advtm_menu_actif span {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ');}';
                }
                $css[] = '#adtm_menu.adtm_menu_toggle_open .li-niveau1.sub.adtm_sub_open a .advtm_menu_span, .li-niveau1 a:focus .advtm_menu_span, .li-niveau1 a.advtm_menu_actif .advtm_menu_span, .li-niveau1 .advtm_menu_span:focus, .li-niveau1:focus > a.a-niveau1 .advtm_menu_span {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            } else {
                $css[] = '#adtm_menu.adtm_menu_toggle_open .li-niveau1.sub.adtm_sub_open a .advtm_menu_span, .li-niveau1 a:focus .advtm_menu_span, .li-niveau1 a.advtm_menu_actif .advtm_menu_span, .li-niveau1 .advtm_menu_span:focus, .li-niveau1:focus > a.a-niveau1 .advtm_menu_span {background-color:' . htmlentities($configResponsiveCss['ATMR_MENU_BGCOLOR_OP'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
            $configResponsiveCss['ATMR_SUBMENU_BGCOLOR'] = explode($this->gradient_separator, $configResponsiveCss['ATMR_SUBMENU_BGCOLOR']);
            if (isset($configResponsiveCss['ATMR_SUBMENU_BGCOLOR'][1])) {
                $color1 = htmlentities($configResponsiveCss['ATMR_SUBMENU_BGCOLOR'][0], ENT_COMPAT, 'UTF-8');
                $color2 = htmlentities($configResponsiveCss['ATMR_SUBMENU_BGCOLOR'][1], ENT_COMPAT, 'UTF-8');
                $css[] = '.li-niveau1 .adtm_sub {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ');}';
            } else {
                $css[] = '.li-niveau1 .adtm_sub {background-color:' . htmlentities($configResponsiveCss['ATMR_SUBMENU_BGCOLOR'][0], ENT_COMPAT, 'UTF-8') . ';}';
            }
            $css[] = '.li-niveau1 .adtm_sub {border-color:' . htmlentities($configResponsiveCss['ATMR_SUBMENU_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . '; border-width:' . htmlentities($configResponsiveCss['ATMR_SUBMENU_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '#adtm_menu .adtm_column_wrap {' . $this->generateOptimizedCssRule('padding', $configResponsiveCss['ATMR_COLUMNWRAP_PADDING']) . $this->generateOptimizedCssRule('margin', $configResponsiveCss['ATMR_COLUMNWRAP_MARGIN']) . '}';
            $css[] = '#adtm_menu .adtm_column_wrap_td {border-color:' . htmlentities($configResponsiveCss['ATMR_COLUMNWRAP_BORDERCOLOR'], ENT_COMPAT, 'UTF-8') . ';border-width:' . htmlentities($configResponsiveCss['ATMR_COLUMNWRAP_BORDERSIZE'], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '#adtm_menu .adtm_column {' . $this->generateOptimizedCssRule('padding', $configResponsiveCss['ATMR_COLUMN_PADDING']) . $this->generateOptimizedCssRule('margin', $configResponsiveCss['ATMR_COLUMN_MARGIN']) . '}';
            $css[] = '#adtm_menu .adtm_column_wrap span.column_wrap_title {' . $this->generateOptimizedCssRule('padding', $configResponsiveCss['ATMR_COLUMNTITLE_PADDING']) . $this->generateOptimizedCssRule('margin', $configResponsiveCss['ATMR_COLUMNTITLE_MARGIN']) . '}';
            $css[] = '.adtm_column_wrap span.column_wrap_title, .adtm_column_wrap span.column_wrap_title a, .adtm_column_wrap span.column_wrap_title span[data-href] {color:' . htmlentities($configResponsiveCss['ATMR_COLUMN_TITLE_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '#adtm_menu .adtm_column ul.adtm_elements li a, #adtm_menu .adtm_column ul.adtm_elements li span[data-href] {' . $this->generateOptimizedCssRule('padding', $configResponsiveCss['ATMR_COLUMN_ITEM_PADDING']) . $this->generateOptimizedCssRule('margin', $configResponsiveCss['ATMR_COLUMN_ITEM_MARGIN']) . '}';
            $css[] = '.adtm_column_wrap a {color:' . htmlentities($configResponsiveCss['ATMR_COLUMN_ITEM_COLOR'], ENT_COMPAT, 'UTF-8') . ';}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu .advtm_hide_desktop {display: block !important;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1 {display: block !important;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.advtm_hide_mobile {display: none !important;}';
            if (empty($configResponsiveCss['ATM_RESP_TOGGLE_ENABLED'])) {
                $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1.advtm_menu_toggle.adtm_menu_mobile_mode {display: none !important;}';
            }
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.li-niveau1 a.a-niveau1 {float: none;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li div.adtm_sub  {display: none; position: static; height: auto;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li div.adtm_sub.adtm_submenu_toggle_open  {display: block;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open table.columnWrapTable {display: table !important; width: 100% !important;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open table.columnWrapTable tr td {display: block;}';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.advtm_search .searchboxATM { display: flex; }';
            $css[] = '#adtm_menu.adtm_menu_toggle_open ul#menu li.advtm_search .searchboxATM .search_query_atm { padding: 15px 5px; width: 100%; }';
            $css[] = '#adtm_menu ul#menu .li-niveau1 div.adtm_sub {opacity: 1;visibility:visible;}';
            $css[] = '#adtm_menu ul#menu .li-niveau1:hover div.adtm_sub, #adtm_menu ul#menu .li-niveau1:focus div.adtm_sub {transition: none;}';
            $css[] = '}';
        }
        if ($id_shop != false) {
            $ids_shop = [$id_shop];
        } else {
            $ids_shop = array_values(Shop::getContextListShopID());
        }
        $global_css_file = [];
        foreach ($ids_shop as $id_shop) {
            $global_css_file[] = str_replace('.css', '-' . $id_shop . '.css', dirname(__FILE__) . '/' . self::GLOBAL_CSS_FILE);
        }
        if (count($css) && count($global_css_file)) {
            foreach ($global_css_file as $value) {
                file_put_contents($value, implode("\n", $css));
            }
        }
    }
    protected function generateOptimizedCssRule($property, $value)
    {
        $instruction = '';
        $shortPropertyOrder = [
            'top',
            'right',
            'bottom',
            'left',
        ];
        switch ($property) {
            case 'padding':
            case 'margin':
                if (substr_count($value, 'unset') == 4) {
                    return $instruction;
                }
                $containsUnset = strpos($value, 'unset');
                $explodedValues = array_map('trim', explode(' ', $value));
                $filteredValues = array_filter($explodedValues);
                $nbValues = count($filteredValues);
                if (!$nbValues) {
                    return $instruction;
                }
                if ($nbValues == 4 && $containsUnset === false) {
                    return $property . ':' . $value . ';';
                }
                foreach ($filteredValues as $key => $val) {
                    if ($val == 'unset' || !isset($shortPropertyOrder[$key])) {
                        continue;
                    }
                    $instruction .= $property . '-' . $shortPropertyOrder[$key] . ':' . $val . ';';
                }
                break;
            default:
                break;
        }
        return $instruction;
    }
    protected function generateCss()
    {
        list($config, $configResponsive) = $this->getConfigKeys();
        $menus = AdvancedTopMenuClass::getMenus($this->context->cookie->id_lang, true, true);
        $columnsWrap = AdvancedTopMenuColumnWrapClass::getColumnsWrap();
        $css = [];
        if (is_array($menus) && count($menus)) {
            foreach ($menus as $menu) {
                if ((int)$menu['id_shop'] != false) {
                    $configGlobalCss = Configuration::getMultiple($config, null, null, (int)$menu['id_shop']);
                    $configResponsiveCss = Configuration::getMultiple($configResponsive, null, null, (int)$menu['id_shop']);
                } else {
                    $configGlobalCss = Configuration::getMultiple($config);
                    $configResponsiveCss = Configuration::getMultiple($configResponsive);
                }
                $hoverCSSselector = ':hover';
                if (!empty($configGlobalCss['ATM_SUBMENU_OPEN_METHOD']) && $configGlobalCss['ATM_SUBMENU_OPEN_METHOD'] == 2) {
                    $hoverCSSselector = '.atm_clicked';
                }
                if ($menu['txt_color_menu_tab']) {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a .advtm_menu_span_' . $menu['id_menu'] . ' {color:' . htmlentities($menu['txt_color_menu_tab'], ENT_COMPAT, 'UTF-8') . '!important;}';
                }
                if ($menu['txt_color_menu_tab_hover']) {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ':hover > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {color:' . htmlentities($menu['txt_color_menu_tab_hover'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    $css[] = '* html .advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', * html .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {color:' . htmlentities($menu['txt_color_menu_tab_hover'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    if ($hoverCSSselector != ':hover') {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {color:' . htmlentities($menu['txt_color_menu_tab_hover'], ENT_COMPAT, 'UTF-8') . '!important;}';
                        $css[] = '* html .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', * html .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {color:' . htmlentities($menu['txt_color_menu_tab_hover'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    }
                }
                if ($menu['fnd_color_menu_tab']) {
                    $menu['fnd_color_menu_tab'] = explode($this->gradient_separator, $menu['fnd_color_menu_tab']);
                    if (isset($menu['fnd_color_menu_tab'][1])) {
                        $color1 = htmlentities($menu['fnd_color_menu_tab'][0], ENT_COMPAT, 'UTF-8');
                        $color2 = htmlentities($menu['fnd_color_menu_tab'][1], ENT_COMPAT, 'UTF-8');
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' a .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ')!important;}';
                        if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
                            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'])) {
                                $css[] = '@media (max-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) { .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . ' a .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ')!important;} }';
                            }
                            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'])) {
                                $css[] = '@media (max-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) { .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . '.adtm_sub_open a .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ')!important;} }';
                            }
                        }
                    } else {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' a .advtm_menu_span_' . $menu['id_menu'] . ' {background:' . htmlentities($menu['fnd_color_menu_tab'][0], ENT_COMPAT, 'UTF-8') . '!important;filter: none!important;}';
                    }
                }
                if ($menu['fnd_color_menu_tab_over']) {
                    $menu['fnd_color_menu_tab_over'] = explode($this->gradient_separator, $menu['fnd_color_menu_tab_over']);
                    if (isset($menu['fnd_color_menu_tab_over'][1])) {
                        $color1 = htmlentities($menu['fnd_color_menu_tab_over'][0], ENT_COMPAT, 'UTF-8');
                        $color2 = htmlentities($menu['fnd_color_menu_tab_over'][1], ENT_COMPAT, 'UTF-8');
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ':hover > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '!important; background: linear-gradient(' . $color1 . ', ' . $color2 . ')!important;}';
                        $css[] = '* html .advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', * html .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {background-color:transparent!important;background:transparent!important;filter:none!important;}';
                        if ($hoverCSSselector != ':hover') {
                            $css[] = '.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '!important; background: linear-gradient(' . $color1 . ', ' . $color2 . ')!important;}';
                            $css[] = '* html .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', * html .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {background-color:transparent!important;background:transparent!important;filter:none!important;}';
                        }
                        if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
                            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'])) {
                                $css[] = '@media (max-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) { .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . ':hover > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_CL'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ')!important;} }';
                            }
                            if (isset($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP']) && !empty($configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'])) {
                                $css[] = '@media (max-width: ' . (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] . 'px) { .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . '.adtm_sub_open a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . '.adtm_sub_open a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .adtm_menu_toggle_open .advtm_menu_' . $menu['id_menu'] . '.adtm_sub_open:hover > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background-color: ' . $color1 . '; background: url(' . $configResponsiveCss['ATM_RESP_SUBMENU_ICON_OP'] . ') no-repeat right 15px center, linear-gradient(' . $color1 . ', ' . $color2 . ')!important;} }';
                            }
                        }
                    } else {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ':hover > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background:' . htmlentities($menu['fnd_color_menu_tab_over'][0], ENT_COMPAT, 'UTF-8') . '!important;filter: none!important;}';
                        $css[] = '* html .advtm_menu_' . $menu['id_menu'] . ' a:hover .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {background:' . htmlentities($menu['fnd_color_menu_tab_over'][0], ENT_COMPAT, 'UTF-8') . '!important;filter:none!important;}';
                        $css[] = '* html .advtm_menu_' . $menu['id_menu'] . ' a:hover, .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif {filter:none!important;}';
                        if ($hoverCSSselector != ':hover') {
                            $css[] = '.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' > a.a-niveau1 .advtm_menu_span_' . $menu['id_menu'] . ' {background:' . htmlentities($menu['fnd_color_menu_tab_over'][0], ENT_COMPAT, 'UTF-8') . '!important;filter: none!important;}';
                            $css[] = '* html .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a .advtm_menu_span_' . $menu['id_menu'] . ', .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif .advtm_menu_span_' . $menu['id_menu'] . ' {background:' . htmlentities($menu['fnd_color_menu_tab_over'][0], ENT_COMPAT, 'UTF-8') . '!important;filter:none!important;}';
                            $css[] = '* html .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a, .advtm_menu_' . $menu['id_menu'] . ' a.advtm_menu_actif {filter:none!important;}';
                        }
                    }
                }
                if ($menu['border_size_tab']) {
                    $css[] = 'li.advtm_menu_' . $menu['id_menu'] . ' a.a-niveau1 {border-width:' . htmlentities($menu['border_size_tab'], ENT_COMPAT, 'UTF-8') . '!important;}';
                }
                if ($menu['border_color_tab']) {
                    $css[] = 'li.advtm_menu_' . $menu['id_menu'] . ' a.a-niveau1 {border-color:' . htmlentities($menu['border_color_tab'], ENT_COMPAT, 'UTF-8') . '!important;}';
                }
                if ($menu['width_submenu']) {
                    if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
                        $css[] = '@media (min-width: ' . (int)($configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) { .advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {width:' . htmlentities($menu['width_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;} }';
                    } else {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {width:' . htmlentities($menu['width_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                    }
                }
                if ($menu['minheight_submenu']) {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {min-height:' . htmlentities($menu['minheight_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                    $css[] = '* html .advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {height:' . htmlentities($menu['minheight_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                    $css[] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ' div.adtm_column_wrap {min-height:' . htmlentities($menu['minheight_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                    $css[] = '* html #adtm_menu .advtm_menu_' . $menu['id_menu'] . ' div.adtm_column_wrap {height:' . htmlentities($menu['minheight_submenu'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                } elseif ($menu['minheight_submenu'] === '0') {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {height:auto!important;min-height:0!important;}';
                    $css[] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ' div.adtm_column_wrap {height:auto!important;min-height:0!important;}';
                }
                if ($menu['position_submenu']) {
                    if ((int)$menu['position_submenu'] == 1 || (int)$menu['position_submenu'] == 3) {
                        $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ':hover, #adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ' a.a-niveau1:hover {position:relative!important;}';
                    } elseif ((int)$menu['position_submenu'] == 2) {
                        $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ':hover, #adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ' a.a-niveau1:hover {position:static!important;}';
                    }
                    if ((int)$menu['position_submenu'] == 3) {
                        $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ':hover div.adtm_sub {left:auto!important;right:0!important;}';
                        $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . ' a:hover div.adtm_sub {left:auto!important;right:1px!important;}';
                    }
                    if ($hoverCSSselector != ':hover') {
                        if ((int)$menu['position_submenu'] == 1 || (int)$menu['position_submenu'] == 3) {
                            $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ', #adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a.a-niveau1 {position:relative!important;}';
                        } elseif ((int)$menu['position_submenu'] == 2) {
                            $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ', #adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a.a-niveau1 {position:static!important;}';
                        }
                        if ((int)$menu['position_submenu'] == 3) {
                            $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' div.adtm_sub {left:auto!important;right:0!important;}';
                            $css[] = '#adtm_menu ul#menu li.advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' a div.adtm_sub {left:auto!important;right:1px!important;}';
                        }
                    }
                }
                if ($menu['fnd_color_submenu']) {
                    $menu['fnd_color_submenu'] = explode($this->gradient_separator, $menu['fnd_color_submenu']);
                    if (isset($menu['fnd_color_submenu'][1])) {
                        $color1 = htmlentities($menu['fnd_color_submenu'][0], ENT_COMPAT, 'UTF-8');
                        $color2 = htmlentities($menu['fnd_color_submenu'][1], ENT_COMPAT, 'UTF-8');
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ')!important;}';
                    } else {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {background:' . htmlentities($menu['fnd_color_submenu'][0], ENT_COMPAT, 'UTF-8') . '!important;filter: none!important;}';
                    }
                }
                if ($menu['border_color_submenu']) {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' div.adtm_sub {border-color:' . htmlentities($menu['border_color_submenu'], ENT_COMPAT, 'UTF-8') . '!important;}';
                }
                if ($menu['border_size_submenu']) {
                    $css[] = '.advtm_menu_' . $menu['id_menu'] . ' div.adtm_sub {border-width:' . htmlentities($menu['border_size_submenu'], ENT_COMPAT, 'UTF-8') . '!important;}';
                }
                foreach ($columnsWrap as $columnWrap) {
                    if ($columnWrap['id_menu'] != $menu['id_menu']) {
                        continue;
                    }
                    if ($columnWrap['bg_color']) {
                        $columnWrap['bg_color'] = explode($this->gradient_separator, $columnWrap['bg_color']);
                        if (isset($columnWrap['bg_color'][1])) {
                            $color1 = htmlentities($columnWrap['bg_color'][0], ENT_COMPAT, 'UTF-8');
                            $color2 = htmlentities($columnWrap['bg_color'][1], ENT_COMPAT, 'UTF-8');
                            $css[] = '.advtm_column_wrap_td_' . $columnWrap['id_wrap'] . ' {background-color: ' . $color1 . '; background: linear-gradient(' . $color1 . ', ' . $color2 . ')!important;}';
                        } else {
                            $css[] = '.advtm_column_wrap_td_' . $columnWrap['id_wrap'] . ' {background:' . htmlentities($columnWrap['bg_color'][0], ENT_COMPAT, 'UTF-8') . '!important;filter: none!important;}';
                        }
                    }
                    if ($columnWrap['width']) {
                        if (empty($menu['position_submenu']) && (int)$configGlobalCss['ATM_SUBMENU_POSITION'] == 2 || $menu['position_submenu'] == 2) {
                            if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
                                $css[] = '@media (min-width: ' . (int)($configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) { .advtm_column_wrap_td_' . $columnWrap['id_wrap'] . ' {width:' . htmlentities($columnWrap['width'], ENT_COMPAT, 'UTF-8') . 'px!important;} }';
                            } else {
                                $css[] = '.advtm_column_wrap_td_' . $columnWrap['id_wrap'] . ' {width:' . htmlentities($columnWrap['width'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                            }
                            $css['fix_table_layout_' . $menu['id_menu'] . '_2'] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ' table.columnWrapTable {table-layout:fixed}';
                        } else {
                            if ($configResponsiveCss['ATM_RESPONSIVE_MODE'] == 1 && (int)$configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] > 0) {
                                $css[] = '@media (min-width: ' . (int)($configResponsiveCss['ATM_RESPONSIVE_THRESHOLD'] + 1) . 'px) { .advtm_column_wrap_td_' . $columnWrap['id_wrap'] . ' {width:' . htmlentities($columnWrap['width'], ENT_COMPAT, 'UTF-8') . 'px!important;} }';
                            } else {
                                $css[] = '.advtm_column_wrap_' . $columnWrap['id_wrap'] . ' {width:' . htmlentities($columnWrap['width'], ENT_COMPAT, 'UTF-8') . 'px!important;}';
                            }
                            $css['fix_table_layout_' . $menu['id_menu'] . '_1'] = '.li-niveau1.advtm_menu_' . $menu['id_menu'] . ' .adtm_sub {width: auto}';
                            $css['fix_table_layout_' . $menu['id_menu'] . '_2'] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ' table.columnWrapTable {table-layout:auto}';
                        }
                    }
                    if ($columnWrap['txt_color_column']) {
                        $css[] = '.advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span.column_wrap_title, .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span.column_wrap_title a, .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span.column_wrap_title span[data-href] {color:' . htmlentities($columnWrap['txt_color_column'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    }
                    if ($columnWrap['txt_color_column_over']) {
                        $css[] = '.advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span.column_wrap_title a:hover, .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span.column_wrap_title span[data-href]:hover {color:' . htmlentities($columnWrap['txt_color_column_over'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    }
                    if ($columnWrap['txt_color_element']) {
                        $css[] = '.advtm_column_wrap_' . $columnWrap['id_wrap'] . ', .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' a, .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span[data-href] {color:' . htmlentities($columnWrap['txt_color_element'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    }
                    if ($columnWrap['txt_color_element_over']) {
                        $css[] = '.advtm_column_wrap_' . $columnWrap['id_wrap'] . ' a:hover, .advtm_column_wrap_' . $columnWrap['id_wrap'] . ' span[data-href]:hover {color:' . htmlentities($columnWrap['txt_color_element_over'], ENT_COMPAT, 'UTF-8') . '!important;}';
                    }
                    if ((int)$configGlobalCss['ATM_SUBMENU_POSITION'] != 2 && $menu['position_submenu'] == 2) {
                        $css[] = '.advtm_menu_' . $menu['id_menu'] . ' .li-niveau1 .adtm_sub {width: 100%;}';
                        $css['fix_table_layout_' . $menu['id_menu'] . '_2'] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ' table.columnWrapTable {table-layout:fixed; width: 0}';
                        $css['fix_table_layout_' . $menu['id_menu'] . '_3'] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . ':hover table.columnWrapTable {width: 100%}';
                        if ($hoverCSSselector != ':hover') {
                            $css['fix_table_layout_' . $menu['id_menu'] . '_3'] = '#adtm_menu .advtm_menu_' . $menu['id_menu'] . $hoverCSSselector . ' table.columnWrapTable {width: 100%}';
                        }
                    }
                }
            }
        }
        $advanced_css_file = dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE;
        $old_advanced_css_file_exists = file_exists($advanced_css_file);
        $ids_shop = array_values(Shop::getCompleteListOfShopsID());
        foreach ($ids_shop as $id_shop) {
            $advanced_css_file_shop = str_replace('.css', '-' . $id_shop . '.css', $advanced_css_file);
            if (!$old_advanced_css_file_exists && !file_exists($advanced_css_file_shop)) {
                file_put_contents($advanced_css_file_shop, Tools::file_get_contents(dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE_RESTORE));
            } elseif ($old_advanced_css_file_exists && count($ids_shop) == 1 && !file_exists($advanced_css_file_shop)) {
                file_put_contents($advanced_css_file_shop, Tools::file_get_contents(dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE));
                @unlink(dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE);
            } elseif (!file_exists($advanced_css_file_shop)) {
                file_put_contents($advanced_css_file_shop, Tools::file_get_contents(dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE_RESTORE));
            }
        }
        $ids_shop = array_values(Shop::getCompleteListOfShopsID());
        $specific_css_file = [];
        foreach ($ids_shop as $id_shop) {
            $specific_css_file[] = str_replace('.css', '-' . $id_shop . '.css', dirname(__FILE__) . '/' . self::DYN_CSS_FILE);
        }
        if (count($css) && count($specific_css_file)) {
            foreach ($specific_css_file as $value) {
                file_put_contents($value, implode("\n", $css));
            }
        } elseif (!count($css) && count($specific_css_file)) {
            foreach ($specific_css_file as $value) {
                file_put_contents($value, '');
            }
        }
    }
    protected function hex2rgb($hexstr, $opacity = false)
    {
        $hexstr = ltrim($hexstr, '#');
        if (Tools::strlen($hexstr) < 6) {
            $hexstr .= str_repeat(Tools::substr($hexstr, -1), 6 - Tools::strlen($hexstr));
        }
        $int = hexdec($hexstr);
        if ($opacity === false) {
            return 'rgb(' . (0xFF & ($int >> 0x10)) . ', ' . (0xFF & ($int >> 0x8)) . ', ' . (0xFF & $int) . ')';
        }
        return 'rgba(' . (0xFF & ($int >> 0x10)) . ', ' . (0xFF & ($int >> 0x8)) . ', ' . (0xFF & $int) . ', ' . $opacity . ')';
    }
    protected function enableCachePM($level = 1)
    {
        if (!Configuration::get('PS_SMARTY_CACHE')) {
            return;
        }
        if ($this->context->smarty->force_compile == 0 and $this->context->smarty->compile_check == 0 and $this->context->smarty->caching == $level) {
            return;
        }
        self::$_forceCompile = (bool)$this->context->smarty->force_compile;
        self::$_compileCheck = (int)$this->context->smarty->compile_check;
        self::$_caching = (int)$this->context->smarty->caching;
        $this->context->smarty->force_compile = false;
        $this->context->smarty->compile_check = 0;
        $this->context->smarty->caching = (int)$level;
    }
    protected function restoreCacheSettingsPM()
    {
        if (isset(self::$_forceCompile)) {
            $this->context->smarty->force_compile = (bool)self::$_forceCompile;
        }
        if (isset(self::$_compileCheck)) {
            $this->context->smarty->compile_check = (int)self::$_compileCheck;
        }
        if (isset(self::$_caching)) {
            $this->context->smarty->caching = (int)self::$_caching;
        }
    }
    public function clearModuleCache()
    {
        $this->context->smarty->clearCompiledTemplate(dirname(__FILE__) . '/pm_advancedtopmenu.tpl');
        return $this->context->smarty->clearCache(null, 'ADTM');
    }
    public function hookDisplayHeader()
    {
        if ($this->isInMaintenance()) {
            return;
        }
        $global_css_file = __PS_BASE_URI__ . 'modules/' . $this->name . '/' . self::GLOBAL_CSS_FILE;
        $specific_css_file = __PS_BASE_URI__ . 'modules/' . $this->name . '/' . self::DYN_CSS_FILE;
        $advanced_css_file = __PS_BASE_URI__ . 'modules/' . $this->name . '/' . self::ADVANCED_CSS_FILE;
        $global_css_file_path = dirname(__FILE__) . '/' . self::GLOBAL_CSS_FILE;
        $specific_css_file_path = dirname(__FILE__) . '/' . self::DYN_CSS_FILE;
        $advanced_css_file_path = dirname(__FILE__) . '/' . self::ADVANCED_CSS_FILE;
        $current_shop_id = (int)$this->context->shop->id;
        $global_css_file = str_replace('.css', '-' . $current_shop_id . '.css', $global_css_file);
        $global_css_file_path = str_replace('.css', '-' . $current_shop_id . '.css', $global_css_file_path);
        $advanced_css_file = str_replace('.css', '-' . $current_shop_id . '.css', $advanced_css_file);
        $advanced_css_file_path = str_replace('.css', '-' . $current_shop_id . '.css', $advanced_css_file_path);
        $specific_css_file = str_replace('.css', '-' . $current_shop_id . '.css', $specific_css_file);
        $specific_css_file_path = str_replace('.css', '-' . $current_shop_id . '.css', $specific_css_file_path);
        $advtmIsSticky = (Configuration::get('ATM_MENU_CONT_POSITION') == 'sticky');
        $this->context->controller->addCSS(__PS_BASE_URI__ . 'modules/' . $this->name . '/views/css/pm_advancedtopmenu_base.css', 'all');
        $this->context->controller->addCSS(__PS_BASE_URI__ . 'modules/' . $this->name . '/views/css/pm_advancedtopmenu_product.css', 'all');
        $currentLangId = $this->context->language->id;
        if ($this->hasAtLeastOneMiIcon($currentLangId)) {
            $this->context->controller->registerStylesheet('modules-' . $this->name . '-mi', 'https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css', ['server' => 'remote']);
        }
        if ($this->hasAtLeastOneFaIcon($currentLangId)) {
            $this->context->controller->registerStylesheet('modules-' . $this->name . '-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css', ['server' => 'remote']);
        }
        if (file_exists($global_css_file_path) && filesize($global_css_file_path) > 0) {
            $this->context->controller->addCSS($global_css_file, 'all');
        }
        if (file_exists($advanced_css_file_path) && filesize($advanced_css_file_path) > 0) {
            $this->context->controller->addCSS($advanced_css_file, 'all');
        }
        if (file_exists($specific_css_file_path) && filesize($specific_css_file_path) > 0) {
            $this->context->controller->addCSS($specific_css_file, 'all');
        }
        if ($advtmIsSticky) {
            $this->context->controller->addJS(__PS_BASE_URI__ . 'modules/' . $this->name . '/views/js/jquery.sticky.js');
        }
        $this->context->controller->addJS(__PS_BASE_URI__ . 'modules/' . $this->name . '/views/js/pm_advancedtopmenu.js');
        Media::addJsDef([
            'adtm_isToggleMode' => (bool)Configuration::get('ATM_RESP_TOGGLE_ENABLED'),
            'adtm_stickyOnMobile' => (bool)Configuration::get('ATM_MENU_CONT_POSITION') == 'sticky' && (bool)Configuration::get('ATM_RESP_ENABLE_STICKY'),
            'adtm_menuHamburgerSelector' => Configuration::get('ATM_MENU_HAMBURGER_SELECTORS', null, null, null, '#menu-icon, .menu-icon'),
        ]);
        if (Configuration::get('ATM_MENU_GLOBAL_ACTIF')) {
            Media::addJsDef([
                'adtm_activeLink' => $this->getLinkActive(),
            ]);
        }
    }
    public function hookActionObjectLanguageAddAfter($params)
    {
        $lang = $params['object'];
        if (Validate::isLoadedObject($lang)) {
            $res = Db::getInstance()->Execute('
                INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang`
                (
                    SELECT `id_element`, "' . (int)$lang->id . '" AS `id_lang`, `link`, `name`, `have_icon`, `image_type`, `image_legend`, `image_class`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang`
                    WHERE `id_lang` = ' . (int)$this->context->cookie->id_lang . '
                )
            ');
            $res &= Db::getInstance()->Execute('
                INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_wrap_lang`
                (
                    SELECT `id_wrap`, "' . (int)$lang->id . '" AS `id_lang`, `value_over`, `value_under`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_wrap_lang`
                    WHERE `id_lang` = ' . (int)$this->context->cookie->id_lang . '
                )
            ');
            $res &= Db::getInstance()->Execute('
                INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_lang`
                (
                    SELECT `id_column`, "' . (int)$lang->id . '" AS `id_lang`, `name`, `value_over`, `value_under`, `link`, `have_icon`, `image_type`, `image_legend`, `image_class`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_lang`
                    WHERE `id_lang` = ' . (int)$this->context->cookie->id_lang . '
                )
            ');
            $res &= Db::getInstance()->Execute('
                INSERT IGNORE INTO `' . _DB_PREFIX_ . 'pm_advancedtopmenu_lang`
                (
                    SELECT `id_menu`, "' . (int)$lang->id . '" AS `id_lang`, `name`, `value_over`, `value_under`, `link`, `have_icon`, `image_type`, `image_legend`, `image_class`
                    FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_lang`
                    WHERE `id_lang` = ' . (int)$this->context->cookie->id_lang . '
                )
            ');
            $newIsoLang = $lang->iso_code;
            $moduleRoot = _PS_ROOT_DIR_ . '/modules/' . $this->name;
            $elementsList = Db::getInstance()->ExecuteS('SELECT `id_element`, `image_type` FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_elements_lang` WHERE `have_icon`=1 AND `id_lang` = ' . (int)$this->context->cookie->id_lang);
            if (self::isFilledArray($elementsList)) {
                foreach ($elementsList as $image) {
                    $src = $moduleRoot . '/element_icons/' . $image['id_element'] . '-' . $this->_iso_lang . '.' . $image['image_type'];
                    $dest = $moduleRoot . '/element_icons/' . $image['id_element'] . '-' . $newIsoLang . '.' . $image['image_type'];
                    if (file_exists($src)) {
                        $res &= copy($src, $dest);
                    }
                }
            }
            $columnsList = Db::getInstance()->ExecuteS('SELECT `id_column`, `image_type` FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_columns_lang` WHERE `have_icon`=1 AND `id_lang` = ' . (int)$this->context->cookie->id_lang);
            if (self::isFilledArray($columnsList)) {
                foreach ($columnsList as $image) {
                    $src = $moduleRoot . '/column_icons/' . $image['id_column'] . '-' . $this->_iso_lang . '.' . $image['image_type'];
                    $dest = $moduleRoot . '/column_icons/' . $image['id_column'] . '-' . $newIsoLang . '.' . $image['image_type'];
                    if (file_exists($src)) {
                        $res &= copy($src, $dest);
                    }
                }
            }
            $menusList = Db::getInstance()->ExecuteS('SELECT `id_menu`, `image_type` FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_lang` WHERE `have_icon`=1 AND `id_lang` = ' . (int)$this->context->cookie->id_lang);
            if (self::isFilledArray($menusList)) {
                foreach ($menusList as $image) {
                    $src = $moduleRoot . '/menu_icons/' . $image['id_menu'] . '-' . $this->_iso_lang . '.' . $image['image_type'];
                    $dest = $moduleRoot . '/menu_icons/' . $image['id_menu'] . '-' . $newIsoLang . '.' . $image['image_type'];
                    if (file_exists($src)) {
                        $res &= copy($src, $dest);
                    }
                }
            }
        }
    }
    public function hookActionShopDataDuplication($params)
    {
        if (Tools::getIsset('importData')) {
            $importData = Tools::getValue('importData');
            if (isset($importData['product'])) {
                $query = new DbQuery();
                $query->select('id_menu');
                $query->from('pm_advancedtopmenu_shop');
                $query->where('id_shop = ' . (int)$params['old_id_shop']);
                $menus = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($query);
                if (is_array($menus) && count($menus)) {
                    foreach ($menus as $menu) {
                        Db::getInstance()->insert(
                            'pm_advancedtopmenu_shop',
                            [
                                'id_menu' => (int)$menu['id_menu'],
                                'id_shop' => (int)$params['new_id_shop'],
                            ]
                        );
                        $this->generateGlobalCss((int)$params['new_id_shop']);
                        $this->generateCss();
                        $this->clearModuleCache();
                    }
                }
            }
        }
    }
    public function hookDisplayNav()
    {
        if (Configuration::get('ATM_MENU_CONT_HOOK') == 'nav') {
            return $this->outputMenuContent();
        }
    }
    public function hookDisplayNavFullWidth()
    {
        if (Configuration::get('ATM_MENU_CONT_HOOK') == 'nav-full') {
            return $this->outputMenuContent();
        }
    }
    public function hookDisplayTop()
    {
        if (Configuration::get('ATM_MENU_CONT_HOOK') == 'top') {
            return $this->outputMenuContent();
        }
    }
    public function outputMenuContent()
    {
        if ($this->isInMaintenance()) {
            return;
        }
        $return = '';
        $cache = Configuration::get('ATM_CACHE');
        if (!Configuration::get('PS_SMARTY_CACHE')) {
            $cache = false;
        }
        if ($cache) {
            $adtmCacheId = sprintf('ADTM|%d|%d|%s|%d|%s', $this->context->cookie->id_lang, $this->context->cookie->id_currency, Validate::isLoadedObject($this->context->customer) && $this->context->customer->isLogged(), Shop::isFeatureActive() ? $this->context->shop->id : 0, implode('-', self::getCustomerGroups()));
            $this->enableCachePM(2);
        }
        $templatePath = 'module:pm_advancedtopmenu/views/templates/front/pm_advancedtopmenu.tpl';
        if (!$cache || !$this->isCached($templatePath, $adtmCacheId)) {
            $menus = AdvancedTopMenuClass::getMenus($this->context->cookie->id_lang, true, false, true);
            if (!is_array($menus) || !count($menus)) {
                $this->restoreCacheSettingsPM();
                return;
            }
            $columnsWrap = AdvancedTopMenuColumnWrapClass::getMenusColumnsWrap($menus, $this->context->cookie->id_lang);
            $columns = AdvancedTopMenuColumnClass::getMenusColums($columnsWrap, $this->context->cookie->id_lang, true);
            $elements = AdvancedTopMenuElementsClass::getMenuColumnsElements($columns, $this->context->cookie->id_lang, true, true);
            $advtmThemeCompatibility = (bool)Configuration::get('ATM_THEME_COMPATIBILITY_MODE') && ((bool)Configuration::get('ATM_MENU_CONT_HOOK') == 'top');
            $advtmResponsiveMode = ((bool)Configuration::get('ATM_RESPONSIVE_MODE') && (int)Configuration::get('ATM_RESPONSIVE_THRESHOLD') > 0);
            $advtmResponsiveToggleText = (Configuration::get('ATM_RESP_TOGGLE_TEXT', $this->context->cookie->id_lang) !== false && Configuration::get('ATM_RESP_TOGGLE_TEXT', $this->context->cookie->id_lang) != '' ? Configuration::get('ATM_RESP_TOGGLE_TEXT', $this->context->cookie->id_lang) : $this->l('Menu'));
            $advtmResponsiveContainerClasses = trim(Configuration::get('ATM_RESP_CONT_CLASSES'));
            $advtmContainerClasses = trim(Configuration::get('ATM_CONT_CLASSES'));
            $advtmInnerClasses = trim(Configuration::get('ATM_INNER_CLASSES'));
            $advtmIsSticky = (Configuration::get('ATM_MENU_CONT_POSITION') == 'sticky');
            $advtmOpenMethod = (int)Configuration::get('ATM_SUBMENU_OPEN_METHOD');
            if ($advtmOpenMethod == 2) {
                $advtmInnerClasses .= ' advtm_open_on_click';
            } else {
                $advtmInnerClasses .= ' advtm_open_on_hover';
            }
            $advtmInnerClasses = trim($advtmInnerClasses);
            $customerGroups = self::getCustomerGroups();
            foreach ($menus as &$menu) {
                $menuHaveSub = count($columnsWrap[$menu['id_menu']]) > 0;
                $menu['link_output_value'] = $this->getLinkOutputValue($menu, 'menu', true, $menuHaveSub, true);
                foreach ($columnsWrap[$menu['id_menu']] as &$columnWrap) {
                    foreach ($columns[$columnWrap['id_wrap']] as &$column) {
                        $column['link_output_value'] = $this->getLinkOutputValue($column, 'column', true);
                        foreach ($elements[$column['id_column']] as &$element) {
                            $element['link_output_value'] = $this->getLinkOutputValue($element, 'element', true);
                        }
                    }
                }
            }
            $this->context->smarty->assign([
                'advtmIsSticky' => $advtmIsSticky,
                'advtmOpenMethod' => $advtmOpenMethod,
                'advtmInnerClasses' => $advtmInnerClasses,
                'advtmContainerClasses' => $advtmContainerClasses,
                'advtmResponsiveContainerClasses' => $advtmResponsiveContainerClasses,
                'advtmResponsiveToggleText' => $advtmResponsiveToggleText,
                'advtmResponsiveMode' => $advtmResponsiveMode,
                'advtmThemeCompatibility' => $advtmThemeCompatibility,
                'advtm_menus' => $menus,
                'advtm_columns_wrap' => $columnsWrap,
                'advtm_columns' => $columns,
                'advtm_elements' => $elements,
                'advtm_obj' => $this,
                'isLogged' => (Validate::isLoadedObject($this->context->customer) && $this->context->customer->isLogged()),
                'customerGroups' => $customerGroups,
                'advtmUrlActive' => $this->getLinkActive(),
                'advtmIsRtl' => $this->context->language->is_rtl,
            ]);
        }
        if ($cache) {
            $this->context->smarty->cache_lifetime = 3600;
            $return = $this->fetch($templatePath, $adtmCacheId);
            $this->restoreCacheSettingsPM();
            return $return;
        }
        $return = $this->fetch($templatePath);
        $this->context->smarty->caching = 0;
        return $return;
    }
    protected function getLinkActive()
    {
        $urlActive = [
            'id' => '',
            'type' => '',
        ];
        if (!Configuration::get('ATM_MENU_GLOBAL_ACTIF') || empty($this->context->controller) || empty($this->context->controller->php_self)) {
            return $urlActive;
        }
        if ($this->context->controller->php_self == 'manufacturer') {
            $urlActive['type'] = 'brands';
            if (method_exists($this->context->controller, 'getManufacturer')) {
                $manufacturer = $this->context->controller->getManufacturer();
                if ($manufacturer !== null) {
                    $urlActive['id'] = (int)$manufacturer->id;
                }
            } elseif (Tools::getIsset('id_manufacturer') && Tools::getValue('id_manufacturer')) {
                $urlActive['id'] = (int)Tools::getValue('id_manufacturer');
            }
        } elseif ($this->context->controller->php_self == 'category') {
            $urlActive['type'] = 'category';
            if (method_exists($this->context->controller, 'getCategory')) {
                $urlActive['id'] = (int)$this->context->controller->getCategory()->id;
            } elseif (Tools::getIsset('id_category') && Tools::getValue('id_category')) {
                $urlActive['id'] = (int)Tools::getValue('id_category');
            }
        } elseif ($this->context->controller->php_self == 'product') {
            $urlActive['type'] = 'category';
            if (method_exists($this->context->controller, 'getProduct')) {
                $urlActive['id'] = (int)$this->context->controller->getProduct()->id_category_default;
            } elseif (Tools::getIsset('id_product') && Tools::getValue('id_product')) {
                $product = new Product(Tools::getValue('id_product'));
                $urlActive['id'] = (int)$product->id_category_default;
            }
        } elseif ($this->context->controller->php_self == 'cms') {
            $urlActive['type'] = 'cms';
            if (method_exists($this->context->controller, 'getCms')) {
                $cmsPage = $this->context->controller->getCms();
                if (!empty($cmsPage) && Validate::isLoadedObject($cmsPage)) {
                    $urlActive['id'] = (int)$cmsPage->id;
                } elseif (method_exists($this->context->controller, 'getCmsCategory')) {
                    $cmsCategoryPage = $this->context->controller->getCmsCategory();
                    if (!empty($cmsCategoryPage) && Validate::isLoadedObject($cmsCategoryPage)) {
                        $urlActive['id'] = (int)$cmsCategoryPage->id;
                        $urlActive['type'] = 'cms-category';
                    }
                }
            } elseif (Tools::getIsset('id_cms') && Tools::getValue('id_cms')) {
                $urlActive['id'] = (int)Tools::getValue('id_cms');
            }
        } elseif ($this->context->controller->php_self == 'supplier') {
            $urlActive['type'] = 'supplier';
            if (method_exists($this->context->controller, 'getSupplier')) {
                $urlActive['id'] = (int)$this->context->controller->getSupplier()->id;
            } elseif (Tools::getIsset('id_supplier') && Tools::getValue('id_supplier')) {
                $urlActive['id'] = (int)Tools::getValue('id_supplier');
            }
        } else {
            $urlActive['type'] = 'custom';
            $urlActive['id'] = $this->context->controller->php_self;
        }
        if ($urlActive['type'] != 'custom' && empty($urlActive['id'])) {
            $urlActive['type'] = 'custom';
            $urlActive['id'] = $this->context->controller->php_self;
        }
        return $urlActive;
    }
    public function hookActionCategoryUpdate($params)
    {
        if (empty($params['category']) || !Validate::isLoadedObject($params['category']) || !empty($params['category']->active)) {
            return;
        }
        $this->disableCategoryInMenu((int)$params['category']->id);
        $this->clearModuleCache();
    }
    protected function disableCategoryInMenu($idCategory)
    {
        $menus = AdvancedTopMenuClass::getMenusFromIdCategory($idCategory);
        $this->disableMenus($menus);
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdCategory($idCategory);
        $this->disableColumns($columns);
        $elements = AdvancedTopMenuElementsClass::getElementsFromIdCategory($idCategory);
        $this->disableElements($elements);
    }
    protected function disableMenus($menus)
    {
        foreach ($menus as $menu) {
            $idMenu = (int)$menu['id_menu'];
            if (empty($idMenu)) {
                continue;
            }
            if (!AdvancedTopMenuClass::disableById($idMenu)) {
                $this->context->controller->errors[] = $this->l('An error occurred while attempting to disable menu elements that use this resource');
            }
        }
    }
    protected function disableColumns($columns)
    {
        foreach ($columns as $column) {
            $idColumn = (int)$column['id_column'];
            if (empty($idColumn)) {
                continue;
            }
            if (!AdvancedTopMenuColumnClass::disableById($idColumn)) {
                $this->context->controller->errors[] = $this->l('An error occurred while attempting to disable menu elements that use this resource');
            }
        }
    }
    protected function disableElements($elements)
    {
        foreach ($elements as $element) {
            $idElement = (int)$element['id_element'];
            if (empty($idElement)) {
                continue;
            }
            if (!AdvancedTopMenuElementsClass::disableById($idElement)) {
                $this->context->controller->errors[] = $this->l('An error occurred while attempting to disable menu elements that use this resource');
            }
        }
    }
    public function hookActionObjectManufacturerUpdateAfter($params)
    {
        if (empty($params['object']) || !Validate::isLoadedObject($params['object']) || !empty($params['object']->active)) {
            return;
        }
        $this->disableManufacturerInMenu((int)$params['object']->id);
        $this->clearModuleCache();
    }
    protected function disableManufacturerInMenu($idManufacturer)
    {
        $menus = AdvancedTopMenuClass::getMenusFromIdManufacturer($idManufacturer);
        $this->disableMenus($menus);
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdManufacturer($idManufacturer);
        $this->disableColumns($columns);
        $elements = AdvancedTopMenuElementsClass::getElementsFromIdManufacturer($idManufacturer);
        $this->disableElements($elements);
    }
    public function hookActionObjectCmsUpdateAfter($params)
    {
        if (empty($params['object']) || !Validate::isLoadedObject($params['object']) || !empty($params['object']->active)) {
            return;
        }
        $this->disableCmsPageInMenu((int)$params['object']->id);
        $this->clearModuleCache();
    }
    protected function disableCmsPageInMenu($idCms)
    {
        $menus = AdvancedTopMenuClass::getMenusFromIdCms($idCms);
        $this->disableMenus($menus);
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdCms($idCms);
        $this->disableColumns($columns);
        $elements = AdvancedTopMenuElementsClass::getElementsFromIdCms($idCms);
        $this->disableElements($elements);
    }
    public function hookActionObjectSupplierUpdateAfter($params)
    {
        if (empty($params['object']) || !Validate::isLoadedObject($params['object']) || !empty($params['object']->active)) {
            return;
        }
        $this->disableSupplierInMenu((int)$params['object']->id);
        $this->clearModuleCache();
    }
    protected function disableSupplierInMenu($idSupplier)
    {
        $menus = AdvancedTopMenuClass::getMenusFromIdSupplier($idSupplier);
        $this->disableMenus($menus);
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdSupplier($idSupplier);
        $this->disableColumns($columns);
        $elements = AdvancedTopMenuElementsClass::getElementsFromIdSupplier($idSupplier);
        $this->disableElements($elements);
    }
    public function hookActionObjectProductUpdateAfter($params)
    {
        if (empty($params['object']) || !Validate::isLoadedObject($params['object']) || !empty($params['object']->active)) {
            return;
        }
        $this->disableProductInMenu((int)$params['object']->id);
        $this->clearModuleCache();
    }
    protected function disableProductInMenu($idProduct)
    {
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdProduct($idProduct);
        $this->disableColumns($columns);
    }
    public function hookActionObjectCmsCategoryUpdateAfter($params)
    {
        if (empty($params['object']) || !Validate::isLoadedObject($params['object']) || !empty($params['object']->active)) {
            return;
        }
        $this->disableCmsCategoryInMenu((int)$params['object']->id);
        $this->clearModuleCache();
    }
    protected function disableCmsCategoryInMenu($idCmsCategory)
    {
        $menus = AdvancedTopMenuClass::getMenusFromIdCmsCategory($idCmsCategory);
        $this->disableMenus($menus);
        $columns = AdvancedTopMenuColumnClass::getColumnsFromIdCmsCategory($idCmsCategory);
        $this->disableColumns($columns);
        $elements = AdvancedTopMenuElementsClass::getElementsFromIdCmsCategory($idCmsCategory);
        $this->disableElements($elements);
    }
    public function hookActionProductDelete($params)
    {
        if (isset($params['id_product']) && is_int($params['id_product'])) {
            $this->deleteProductColumns($params['id_product']);
            $this->clearModuleCache();
        }
    }
    protected function deleteProductColumns($idProduct)
    {
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT `id_column`
            FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_prod_column' . '`
            WHERE `id_product` = ' . (int)$idProduct);
        if (!empty($rows)) {
            foreach ($rows as $productColumn) {
                $advancedTopMenuColumnClass = new AdvancedTopMenuColumnClass((int)$productColumn['id_column']);
                $advancedTopMenuColumnClass->delete();
            }
        }
    }
    public static function isFilledArray($array)
    {
        return $array && is_array($array) && count($array);
    }
    public function displayTitle($title)
    {
        $vars = [
            'text' => $title,
        ];
        return $this->fetchTemplate('core/title.tpl', $vars);
    }
    
    private function getPMdata()
    {
        $param = [];
        $param[] = 'ver-' . _PS_VERSION_;
        $param[] = 'current-' . $this->name;
        
        $result = $this->getPMAddons();
        if ($result && self::isFilledArray($result)) {
            foreach ($result as $moduleName => $moduleVersion) {
                $param[] = $moduleName . '-' . $moduleVersion;
            }
        }
        return self::getDataSerialized(implode('|', $param));
    }
    private function getPMAddons()
    {
        $pmAddons = [];
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('SELECT DISTINCT name FROM ' . _DB_PREFIX_ . 'module WHERE name LIKE "pm_%"');
        if ($result && self::isFilledArray($result)) {
            foreach ($result as $module) {
                $instance = Module::getInstanceByName($module['name']);
                if ($instance) {
                    $pmAddons[$module['name']] = $instance->version;
                }
            }
        }
        return $pmAddons;
    }
    private function doHttpRequest($data = [], $c = 'prestashop', $s = 'api.addons')
    {
        $data = array_merge([
            'version' => _PS_VERSION_,
            'iso_lang' => Tools::strtolower($this->_iso_lang),
            'iso_code' => Tools::strtolower(Country::getIsoById((int)Configuration::get('PS_COUNTRY_DEFAULT'))),
            'module_key' => $this->module_key,
            'method' => 'contributor',
            'action' => 'all_products',
        ], $data);
        $postData = http_build_query($data);
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'content' => $postData,
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'timeout' => 15,
            ],
        ]);
        $response = Tools::file_get_contents('https://' . $s . '.' . $c . '.com', false, $context);
        if (empty($response)) {
            return false;
        }
        $responseToJson = json_decode($response);
        if (empty($responseToJson)) {
            return false;
        }
        return $responseToJson;
    }
    private function getAddonsModulesFromApi()
    {
        $modules = Configuration::get('PM_' . self::$_module_prefix . '_AM');
        $modules_date = (int)Configuration::get('PM_' . self::$_module_prefix . '_AMD');
        if ($modules && strtotime('+2 day', $modules_date) > time()) {
            return json_decode($modules, true);
        }
        $jsonResponse = $this->doHttpRequest();
        if (empty($jsonResponse->products)) {
            return [];
        }
        $dataToStore = [];
        foreach ($jsonResponse->products as $addonsEntry) {
            $dataToStore[(int)$addonsEntry->id] = [
                'name' => $addonsEntry->name,
                'displayName' => $addonsEntry->displayName,
                'url' => $addonsEntry->url,
                'compatibility' => $addonsEntry->compatibility,
                'version' => $addonsEntry->version,
                'description' => $addonsEntry->description,
            ];
        }
        Configuration::updateValue('PM_' . self::$_module_prefix . '_AM', json_encode($dataToStore));
        Configuration::updateValue('PM_' . self::$_module_prefix . '_AMD', time());
        return json_decode(Configuration::get('PM_' . self::$_module_prefix . '_AM'), true);
    }
    private function getPMModulesFromApi()
    {
        $modules = Configuration::get('PM_' . self::$_module_prefix . '_PMM');
        $modules_date = (int)Configuration::get('PM_' . self::$_module_prefix . '_PMMD');
        if ($modules && strtotime('+2 day', $modules_date) > time()) {
            return json_decode($modules, true);
        }
        $jsonResponse = $this->doHttpRequest(['list' => $this->getPMAddons()], 'presta-module', 'api-addons');
        if (empty($jsonResponse)) {
            return [];
        }
        Configuration::updateValue('PM_' . self::$_module_prefix . '_PMM', json_encode($jsonResponse));
        Configuration::updateValue('PM_' . self::$_module_prefix . '_PMMD', time());
        return json_decode(Configuration::get('PM_' . self::$_module_prefix . '_PMM'), true);
    }
    public function displaySupport()
    {
        $get_started_image_list = [];
        if (isset($this->_getting_started) && self::isFilledArray($this->_getting_started)) {
            foreach ($this->_getting_started as $get_started_image) {
                $get_started_image_list[] = "{ 'href': '" . $get_started_image['href'] . "', 'title': '" . htmlentities($get_started_image['title'], ENT_QUOTES, 'UTF-8') . "' }";
            }
        }
        $pm_addons_products = $this->getAddonsModulesFromApi();
        $pm_products = $this->getPMModulesFromApi();
        if (!is_array($pm_addons_products)) {
            $pm_addons_products = [];
        }
        if (!is_array($pm_products)) {
            $pm_products = [];
        }
        $this->shuffleArray($pm_addons_products);
        if (self::isFilledArray($pm_addons_products)) {
            if (!empty($pm_products['ignoreList']) && self::isFilledArray($pm_products['ignoreList'])) {
                foreach ($pm_products['ignoreList'] as $ignoreId) {
                    if (isset($pm_addons_products[$ignoreId])) {
                        unset($pm_addons_products[$ignoreId]);
                    }
                }
            }
            $addonsList = $this->getPMAddons();
            if ($addonsList && self::isFilledArray($addonsList)) {
                foreach (array_keys($addonsList) as $moduleName) {
                    foreach ($pm_addons_products as $k => $pm_addons_product) {
                        if ($pm_addons_product['name'] == $moduleName) {
                            unset($pm_addons_products[$k]);
                            break;
                        }
                    }
                }
            }
        }
        $vars = [
            'support_links' => (self::isFilledArray($this->_support_link) ? $this->_support_link : []),
            'copyright_link' => (self::isFilledArray($this->_copyright_link) ? $this->_copyright_link : false),
            'get_started_image_list' => (isset($this->_getting_started) && self::isFilledArray($this->_getting_started) ? $this->_getting_started : []),
            'pm_module_version' => $this->version,
            'pm_data' => $this->getPMdata(),
            'pm_products' => $pm_products,
            'pm_addons_products' => $pm_addons_products,
            'html_at_end' => (method_exists($this, '_includeHTMLAtEnd') ? $this->_includeHTMLAtEnd() : ''),
        ];
        return $this->fetchTemplate('core/support.tpl', $vars);
    }
    protected function shuffleArray(&$a)
    {
        if (is_array($a) && count($a)) {
            $ks = array_keys($a);
            shuffle($ks);
            $new = [];
            foreach ($ks as $k) {
                $new[$k] = $a[$k];
            }
            $a = $new;
            return true;
        }
        return false;
    }
    protected function displayMaintenanceZone()
    {
        $vars = [
            'pm_maintenance' => Configuration::get('PM_' . self::$_module_prefix . '_MAINTENANCE'),
            'ip_maintenance' => Configuration::get('PS_MAINTENANCE_IP'),
            'maintenanceTabUrl' => $this->context->link->getAdminLink('AdminMaintenance'),
        ];
        return $this->fetchTemplate('core/maintenance.tpl', $vars);
    }
    protected function postProcessMaintenance($newMaintenanceState)
    {
        $castedValue = (int)$newMaintenanceState;
        if ($castedValue != 0 && $castedValue != 1) {
            return $this->context->controller->errors[] = $this->l('An error occurred while updating the module');
        }
        Configuration::updateValue('PM_' . self::$_module_prefix . '_MAINTENANCE', $castedValue);
        $this->clearModuleCache();
    }
    protected function isInMaintenance()
    {
        if (isset($this->_cacheIsInMaintenance)) {
            return $this->_cacheIsInMaintenance;
        }
        if (Configuration::get('PM_' . self::$_module_prefix . '_MAINTENANCE')) {
            $ips = explode(',', Configuration::get('PS_MAINTENANCE_IP'));
            if (in_array($this->getCurrentIp(), $ips)) {
                $this->_cacheIsInMaintenance = false;
                return false;
            }
            $this->_cacheIsInMaintenance = true;
            return true;
        }
        $this->_cacheIsInMaintenance = false;
        return false;
    }
    protected function getCurrentIp()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            return $_SERVER['HTTP_X_REAL_IP'];
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $explodedForwardedFor = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return current($explodedForwardedFor);
        }
        return $_SERVER['REMOTE_ADDR'];
    }
    protected static function cleanBuffer()
    {
        if (ob_get_length() > 0) {
            ob_clean();
        }
    }
    protected function showRating($show = false)
    {
        $dismiss = (int)Configuration::getGlobalValue('PM_' . self::$_module_prefix . '_DISMISS_RATING');
        if ($show && $dismiss != 1 && $this->getNbDaysModuleUsage() >= 3) {
            return $this->fetchTemplate('core/rating.tpl');
        }
        return '';
    }
    protected function getNbDaysModuleUsage()
    {
        $sql = 'SELECT DATEDIFF(NOW(),date_add)
                FROM ' . _DB_PREFIX_ . 'configuration
                WHERE name = \'' . pSQL('ATM_LAST_VERSION') . '\'
                ORDER BY date_add ASC';
        return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }
    protected function onBackOffice()
    {
        if (isset($this->context->cookie->id_employee) && Validate::isUnsignedId($this->context->cookie->id_employee)) {
            return true;
        }
        return false;
    }
    public static function getCustomerGroups()
    {
        $groups = [];
        if (Group::isFeatureActive()) {
            if (Validate::isLoadedObject(Context::getContext()->customer)) {
                $groups = FrontController::getCurrentCustomerGroups();
            } else {
                $groups = [(int)Configuration::get('PS_UNIDENTIFIED_GROUP')];
            }
        }
        sort($groups);
        return $groups;
    }
    protected static function getProductsImagesTypes()
    {
        $a = [];
        foreach (ImageType::getImagesTypes('products') as $imageType) {
            $a[$imageType['name']] = $imageType['name'] . ' (' . $imageType['width'] . ' x ' . $imageType['height'] . ' pixels)';
        }
        return $a;
    }
    private static function getDataSerialized($data, $type = 'base64')
    {
        if (is_array($data)) {
            return array_map($type . '_encode', [$data]);
        }
        return current(array_map($type . '_encode', [$data]));
    }
    public function smartyNoFilterModifier($s)
    {
        return $s;
    }
    protected function registerFrontSmartyObjects()
    {
        static $registeredFO = false;
        if (!$registeredFO && !empty($this->context->smarty)) {
            $this->context->smarty->unregisterPlugin('modifier', Tools::strtolower(self::$_module_prefix) . '_nofilter');
            $this->context->smarty->registerPlugin('modifier', Tools::strtolower(self::$_module_prefix) . '_nofilter', [$this, 'smartyNoFilterModifier']);
            $registeredFO = true;
        }
    }
    protected function registerSmartyObjects()
    {
        static $registered = false;
        if (!$registered && !empty($this->context->smarty)) {
            $this->registerFrontSmartyObjects();
            $this->context->smarty->registerObject('module', $this, [
                'getAdminOutputPrivacyValue',
                'getType',
                'getAdminOutputNameValue',
                'displayTitle',
                'outputFormItem',
                'displayFlags',
                'outputMenuForm',
                'outputColumnWrapForm',
                'outputColumnForm',
                'outputElementForm',
                'outputTargetSelect',
                'outputChosenGroups',
                'outputCategoriesSelect',
                'outputCmsCategoriesSelect',
                'outputCmsSelect',
                'outputManufacturerSelect',
                'outputSupplierSelect',
                'outputSpecificPageSelect',
                'outputSelectColumnsWrap',
                'outputSelectColumns',
                'showWarning',
                'displaySupport',
            ], false);
            $registered = true;
        }
    }
    protected function fetchTemplate($tpl, $customVars = [], $configOptions = [])
    {
        $this->registerSmartyObjects();
        $this->context->smarty->assign([
            'ps_major_version' => Tools::substr(str_replace('.', '', _PS_VERSION_), 0, 2),
            'module_name' => $this->name,
            'module_path' => $this->_path,
            'base_config_url' => $this->base_config_url,
            'current_iso_lang' => $this->_iso_lang,
            'current_id_lang' => (int)$this->context->language->id,
            'default_language' => $this->defaultLanguage,
            'languages' => $this->languages,
            'options' => $configOptions,
            'shopFeatureActive' => Shop::isFeatureActive(),
            'allowedImageFileExtension' => $this->allowFileExtension,
        ]);
        if (is_array($customVars) && count($customVars)) {
            $this->context->smarty->assign($customVars);
        }
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->name . '/views/templates/admin/' . $tpl);
    }
    public function showWarning($text)
    {
        $vars = [
            'text' => $text,
        ];
        return $this->fetchTemplate('core/warning.tpl', $vars);
    }
    public function renderWidget($hookName, array $configuration)
    {
        if (defined('_PS_ADMIN_DIR_')) {
            return;
        }
        return $this->outputMenuContent();
    }
    public function getWidgetVariables($hookName, array $configuration)
    {
        return [];
    }
    protected function hasAtLeastOneMiIcon($idLang)
    {
        return $this->lookForIcon('i-mi', $idLang);
    }
    protected function hasAtLeastOneFaIcon($idLang)
    {
        return $this->lookForIcon('i-fa', $idLang);
    }
    protected function lookForIcon($type, $idLang)
    {
        if ($this->lookForIconInTable('pm_advancedtopmenu_lang', $type, $idLang)) {
            return true;
        }
        if ($this->lookForIconInTable('pm_advancedtopmenu_columns_lang', $type, $idLang)) {
            return true;
        }
        if ($this->lookForIconInTable('pm_advancedtopmenu_elements_lang', $type, $idLang)) {
            return true;
        }
        return false;
    }
    protected function lookForIconInTable($table, $type, $idLang)
    {
        $hasIcon = false;
        $rows = Db::getInstance()->executeS('
            SELECT `image_type`
            FROM `' . _DB_PREFIX_ . $table . '`
            WHERE `image_type` NOT IN ("jpg", "png", "gif")
            AND `id_lang` = ' . (int)$idLang);
        foreach ($rows as $row) {
            if ($row['image_type'] == $type) {
                $hasIcon = true;
                break;
            }
        }
        return $hasIcon;
    }
}
