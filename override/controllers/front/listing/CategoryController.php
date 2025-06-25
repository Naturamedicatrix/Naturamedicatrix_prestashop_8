<?php
/**
 * Override du CategoryController pour modifier le layout de la catégorie "Principes actifs"
 * et enrichir les données des sous-catégories avec le champ additional_description
 */
class CategoryController extends CategoryControllerCore
{
    /**
     * Override de la méthode getLayout pour utiliser un layout sans colonne de gauche 
     * spécifiquement pour la catégorie ID 25 (Principes actifs)
     *
     * @return bool|string
     */
    public function getLayout()
    {
        // Si la catégorie n'est pas visible ou n'existe pas, utilise le layout d'erreur (comportement par défaut)
        if (!$this->category->checkAccess($this->context->customer->id) || $this->notFound) {
            return $this->context->shop->theme->getLayoutRelativePathForPage('error');
        }
        
        // Si c'est la catégorie "Principes actifs" (ID 25), utilise le layout sans colonne
        if ($this->category->id == 25) {
            return 'layouts/layout-full-width.tpl';
        }
        
        // Sinon, utilise le layout par défaut
        return parent::getLayout();
    }
    



    /**
     * Méthode qui récupère les sous-catégories avec toutes leurs données complètes
     * Peut être appelée depuis le template : {CategoryController::getChildrenCategory(25, $language.id)}
     * 
     * @param int $id_parent ID de la catégorie parente
     * @param int $id_lang ID de la langue
     * @param bool $active Récupérer seulement les catégories actives
     * @param int $id_shop ID du magasin
     * 
     * @return array Tableau avec les données enrichies
     */
    public static function getChildrenCategory($id_parent, $id_lang, $active = true, $id_shop = null)
    {
        if (is_null($id_shop)) {
            $id_shop = Context::getContext()->shop->id;
        }
        
        // Récupère les sous-catégories
        $categories = Category::getChildren($id_parent, $id_lang, $active, $id_shop);
        
        // Enrichit les sous-catégories avec additional_description, description standard, images et nombre de produits
        foreach ($categories as &$category) {
            // Récupère les descriptions
            $sql = 'SELECT cl.`additional_description`, cl.`description` 
                   FROM `'._DB_PREFIX_.'category_lang` cl 
                   WHERE cl.`id_category` = '.(int)$category['id_category'].' 
                   AND cl.`id_lang` = '.(int)$id_lang.' 
                   AND cl.`id_shop` = '.(int)$id_shop;
            
            $result = Db::getInstance()->getRow($sql);
            $category['additional_description'] = $result['additional_description'];
            $category['description'] = $result['description'];
            
            // Récupérer le nombre de produits
            $sql = 'SELECT COUNT(cp.`id_product`) as nb_products
                   FROM `'._DB_PREFIX_.'category_product` cp
                   LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.`id_product` = cp.`id_product`)
                   WHERE cp.`id_category` = '.(int)$category['id_category'].'
                   AND p.`active` = 1';
            
            $result = Db::getInstance()->getRow($sql);
            $category['nb_products'] = (int)$result['nb_products'];
            
            // Récupérer l'image (utilisation de la méthode native)
            $cat_obj = new Category($category['id_category'], $id_lang, $id_shop);
            $link = Context::getContext()->link;
            
            // Ajouter l'URL de l'image (comme dans le controller de base)
            $category['image'] = [
                'small' => $link->getCatImageLink($category['link_rewrite'], $category['id_category'], 'small_default'),
                'medium' => $link->getCatImageLink($category['link_rewrite'], $category['id_category'], 'medium_default'),
                'large' => $link->getCatImageLink($category['link_rewrite'], $category['id_category'], 'large_default'),
                'default' => $link->getCatImageLink($category['link_rewrite'], $category['id_category'], 'category_default')
            ];
        }
        
        return $categories;
    }
    
    /**
     * Override de getTemplateVarSubCategories pour enrichir les sous-catégories
     */
    protected function getTemplateVarSubCategories()
    {
        // Appelle d'abord la méthode parente pour récupérer les données de base
        $subcategories = parent::getTemplateVarSubCategories();
        
        // Enrichir chaque sous-catégorie avec les champs additional_description, description et nombre de produits
        foreach ($subcategories as &$subcategory) {
            // Récupérer les descriptions
            $sql = 'SELECT cl.`additional_description`, cl.`description` 
                   FROM `'._DB_PREFIX_.'category_lang` cl 
                   WHERE cl.`id_category` = '.(int)$subcategory['id_category'].' 
                   AND cl.`id_lang` = '.(int)$this->context->language->id.' 
                   AND cl.`id_shop` = '.(int)$this->context->shop->id;
            
            $result = Db::getInstance()->getRow($sql);
            $subcategory['additional_description'] = $result['additional_description'];
            $subcategory['description'] = $result['description'];
            
            // Récupérer le nombre de produits
            $sql = 'SELECT COUNT(cp.`id_product`) as nb_products
                   FROM `'._DB_PREFIX_.'category_product` cp
                   LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.`id_product` = cp.`id_product`)
                   WHERE cp.`id_category` = '.(int)$subcategory['id_category'].'
                   AND p.`active` = 1';
            
            $result = Db::getInstance()->getRow($sql);
            $subcategory['nb_products'] = (int)$result['nb_products'];
        }
        
        return $subcategories;
    }
}
