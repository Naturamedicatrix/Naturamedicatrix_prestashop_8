<?php
/**
 * Helper class for product variants
 * Used to retrieve all variants of a product
 */
class VariantsHelper
{
    /**
     * Get all variants for a product
     *
     * @param int $id_product Product ID
     * @return array Grouped variants by attribute group
     */
    public static function getAllProductVariants($id_product)
    {
        $result = [];
        if (!$id_product) {
            return $result;
        }
        
        $id_lang = Context::getContext()->language->id;
        
        $query = 'SELECT DISTINCT 
            agl.name AS group_name, 
            al.name AS attribute_name,
            a.id_attribute_group
          FROM '._DB_PREFIX_.'product_attribute pa
          JOIN '._DB_PREFIX_.'product_attribute_combination pac ON pa.id_product_attribute = pac.id_product_attribute
          JOIN '._DB_PREFIX_.'attribute a ON a.id_attribute = pac.id_attribute
          JOIN '._DB_PREFIX_.'attribute_lang al ON (a.id_attribute = al.id_attribute AND al.id_lang = '.(int)$id_lang.')
          JOIN '._DB_PREFIX_.'attribute_group_lang agl ON (a.id_attribute_group = agl.id_attribute_group AND agl.id_lang = '.(int)$id_lang.')
          WHERE pa.id_product = '.(int)$id_product.'
          ORDER BY a.id_attribute_group, a.position';
        
        $attributes = Db::getInstance()->executeS($query);
        
        if (!$attributes) {
            return $result;
        }
        
        $grouped = [];
        foreach ($attributes as $attr) {
            if (!isset($grouped[$attr['id_attribute_group']])) {
                $grouped[$attr['id_attribute_group']] = [
                    'group_name' => $attr['group_name'],
                    'attributes' => []
                ];
            }
            if (!in_array($attr['attribute_name'], $grouped[$attr['id_attribute_group']]['attributes'])) {
                $grouped[$attr['id_attribute_group']]['attributes'][] = $attr['attribute_name'];
            }
        }
        
        return $grouped;
    }
}
