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
class AdvancedTopMenuProductColumnClass extends ObjectModel
{
    public $id;
    public $id_column;
    public $id_product;
    public $p_image_type;
    public $show_title = 1;
    public $show_price = 1;
    public $show_add_to_cart = 1;
    public $show_more_info = 1;
    public $show_quick_view = 1;
    protected $tables = ['pm_advancedtopmenu_prod_column'];
    protected $fieldsRequired = [
        'id_column',
        'id_product',
    ];
    protected $fieldsSize = [];
    protected $fieldsValidate = [];
    protected $table = 'pm_advancedtopmenu_prod_column';
    protected $identifier = 'id_product_column';
    public static $definition = [
        'table' => 'pm_advancedtopmenu_prod_column',
        'primary' => 'id_product_column',
        'multishop' => false,
        'multilang_shop' => false,
        'multilang' => false,
    ];
    public function getFields()
    {
        parent::validateFields();
        $fields = [];
        if (isset($this->id)) {
            $fields['id_product_column'] = (int)$this->id;
        }
        $fields['id_column'] = (int)$this->id_column;
        $fields['id_product'] = (int)$this->id_product;
        $fields['show_title'] = (int)$this->show_title;
        $fields['show_price'] = (int)$this->show_price;
        $fields['show_add_to_cart'] = (int)$this->show_add_to_cart;
        $fields['show_more_info'] = (int)$this->show_more_info;
        $fields['show_quick_view'] = (int)$this->show_quick_view;
        $fields['p_image_type'] = pSQL($this->p_image_type);
        return $fields;
    }
    public static function getByIdColumn($id_column)
    {
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            'SELECT `id_product_column`
            FROM `' . _DB_PREFIX_ . 'pm_advancedtopmenu_prod_column`
            WHERE `id_column`=' . (int)$id_column
        );
        if (isset($row['id_product_column'])) {
            return new self($row['id_product_column']);
        }
        return false;
    }
}
