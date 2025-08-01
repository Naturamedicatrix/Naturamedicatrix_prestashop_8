<?php
/**
 * Override Product class to add batch_number field (numéro de lot)
 */

class Product extends ProductCore
{
    public $batch_number;

    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        self::$definition['fields']['batch_number'] = ['type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 255];
        
        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }
    
    

    
    
}
