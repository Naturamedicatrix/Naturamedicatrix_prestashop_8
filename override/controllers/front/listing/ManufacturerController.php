<?php

class ManufacturerController extends ManufacturerControllerCore
{
    public function initContent(): void
    {
        parent::initContent();

        $context = \Context::getContext();
        $id_lang = (int)$context->language->id;
        $id_shop = (int)$context->shop->id;
    

        $manufacturer = $this->getManufacturer();
        if (!$manufacturer || !$manufacturer->id) {
            return;
        }
    
        $id_manufacturer = (int)$manufacturer->id;

        $sql = new \DbQuery();
        $sql->select('p.*, pl.*, ps.quantity AS sales, image.id_image, pl.link_rewrite, pl.name, m.name as manufacturer_name');
        $sql->from('product_sale', 'ps');
        $sql->innerJoin('product', 'p', 'ps.id_product = p.id_product');
        $sql->innerJoin('product_lang', 'pl', 'p.id_product = pl.id_product AND pl.id_lang = '.$id_lang.' AND pl.id_shop = p.id_shop_default');
        $sql->leftJoin('image', 'image', 'image.id_product = p.id_product AND image.cover = 1');
        $sql->leftJoin('manufacturer', 'm', 'm.id_manufacturer = p.id_manufacturer');
        $sql->where('p.id_manufacturer = '.$id_manufacturer);
        $sql->where('p.active = 1');
        $sql->orderBy('ps.quantity DESC');
        $sql->limit(3);

        $bestselles = \Db::getInstance()->executeS($sql);
    
        $context->smarty->assign('bestselles', $bestselles);
    }
}
