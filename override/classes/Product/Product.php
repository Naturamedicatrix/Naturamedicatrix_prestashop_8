<?php
/**
 * Override de la classe Product pour ajouter la fonctionnalité d'affichage des images des variantes
 * 
 * @author Cascade
 */
class Product extends ProductCore
{
    /**
     * Récupère toutes les images associées aux attributs d'un produit
     * 
     * @param int $id_product ID du produit
     * @return array Tableau associatif [id_attribute => id_image]
     */
    public static function getAllAttributeImagesStatic($id_product)
    {
        // Récupérer toutes les combinaisons du produit avec leurs images
        $result = Db::getInstance()->executeS('
            SELECT pac.`id_attribute`, pai.`id_image`
            FROM `' . _DB_PREFIX_ . 'product_attribute` pa
            LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_image` pai ON pai.`id_product_attribute` = pa.`id_product_attribute`
            LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac ON pac.`id_product_attribute` = pa.`id_product_attribute`
            WHERE pa.`id_product` = ' . (int)$id_product . '
            AND pai.`id_image` IS NOT NULL
            GROUP BY pac.`id_attribute`
        ');
        
        $attribute_images = [];
        if ($result) {
            foreach ($result as $row) {
                if (isset($row['id_attribute']) && isset($row['id_image'])) {
                    $attribute_images[$row['id_attribute']] = $row['id_image'];
                }
            }
        }
        
        return $attribute_images;
    }
}
