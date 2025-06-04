<?php
/**
 * Récupère les produits d'une catégorie spécifique par son nom
 * Ce fichier est utilisé par le template ps_newproducts.tpl
 */

// Sécurité
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Récupère l'ID d'une catégorie par son nom
 * @param string $categoryName Nom de la catégorie
 * @param int $idLang ID de la langue
 * @return int|null ID de la catégorie ou null si non trouvée
 */
function getCategoryIdByName($categoryName, $idLang)
{
    // Recherche la catégorie par son nom
    $categories = Category::searchByName($idLang, $categoryName, false);
    
    if (!empty($categories)) {
        foreach ($categories as $cat) {
            if (isset($cat['id_category'])) {
                $tempCategory = new Category((int)$cat['id_category'], $idLang);
                
                // Vérifie si c'est une sous-catégorie et si le nom correspond
                if (Validate::isLoadedObject($tempCategory) && 
                    $tempCategory->level_depth > 1 && 
                    strtolower($tempCategory->name) == strtolower($categoryName)) {
                    
                    return $tempCategory->id;
                }
            }
        }
    }
    
    return null;
}

/**
 * Récupère les produits d'une catégorie spécifique
 * @param string $categoryName Nom de la catégorie
 * @param int $limit Nombre maximum de produits à récupérer
 * @return array Produits formatés pour l'affichage
 */
function getProductsFromCategory($categoryName, $limit = 9)
{
    $context = Context::getContext();
    $idLang = $context->language->id;
    $categoryId = getCategoryIdByName($categoryName, $idLang);
    
    // Si la catégorie n'est pas trouvée, retourner un tableau vide
    if ($categoryId === null) {
        return [];
    }
    
    // Récupère la catégorie
    $category = new Category((int)$categoryId);
    
    if (!Validate::isLoadedObject($category)) {
        return [];
    }
    
    // Récupère les produits de la catégorie
    $productIds = $category->getProducts($idLang, 0, $limit, 'position', 'asc');
    
    if (empty($productIds)) {
        return [];
    }
    
    // Prépare les données des produits pour l'affichage
    $assembler = new ProductAssembler($context);
    $presenterFactory = new ProductPresenterFactory($context);
    $presentationSettings = $presenterFactory->getPresentationSettings();
    $presenter = $presenterFactory->getPresenter();
    
    $products = [];
    
    foreach ($productIds as $productData) {
        $productId = $productData['id_product'];
        $product = new Product($productId, true, $idLang);
        
        if (Validate::isLoadedObject($product) && $product->active) {
            // Récupère les données complètes du produit
            $productForTemplate = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $context->language
            );
            
            $products[] = $productForTemplate;
        }
    }
    
    return $products;
}

/**
 * Récupère le lien vers une catégorie par son nom
 * @param string $categoryName Nom de la catégorie
 * @param int $idLang ID de la langue
 * @return string URL de la catégorie ou URL par défaut si non trouvée
 */
function getCategoryLinkByName($categoryName, $idLang)
{
    $context = Context::getContext();
    $defaultUrl = $context->link->getPageLink('index');
    
    $categoryId = getCategoryIdByName($categoryName, $idLang);
    
    if ($categoryId !== null) {
        return $context->link->getCategoryLink($categoryId);
    }
    
    return $defaultUrl;
}
