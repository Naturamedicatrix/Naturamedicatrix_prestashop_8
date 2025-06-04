<?php
/**
 * Fonctions utilitaires pour récupérer les produits d'une catégorie spécifique
 * Ce fichier est utilisé par le module ps_newproducts
 */

// Protection contre l'accès direct
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
 * @param Context $context Contexte PrestaShop
 * @return array Produits formatés pour l'affichage
 */
function getProductsFromCategory($categoryName, $limit, $context)
{
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
    
    if (version_compare(_PS_VERSION_, '1.7.5', '>=')) {
        $presenter = new \PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingPresenter(
            new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever($context->link),
            $context->link,
            new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(),
            new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(),
            $context->getTranslator()
        );
    } else {
        $presenter = new \PrestaShop\PrestaShop\Core\Product\ProductListingPresenter(
            new \PrestaShop\PrestaShop\Adapter\Image\ImageRetriever($context->link),
            $context->link,
            new \PrestaShop\PrestaShop\Adapter\Product\PriceFormatter(),
            new \PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever(),
            $context->getTranslator()
        );
    }
    
    $products_for_template = [];
    
    foreach ($productIds as $productData) {
        $productId = $productData['id_product'];
        
        // Assembler le produit avec toutes ses données
        $products_for_template[] = $presenter->present(
            $presentationSettings,
            $assembler->assembleProduct(['id_product' => $productId]),
            $context->language
        );
    }
    
    return $products_for_template;
}

/**
 * Récupère le lien vers une catégorie par son nom
 * @param string $categoryName Nom de la catégorie
 * @param int $idLang ID de la langue
 * @param Context $context Contexte PrestaShop
 * @return string URL de la catégorie ou URL par défaut si non trouvée
 */
function getCategoryLinkByName($categoryName, $idLang, $context)
{
    $defaultUrl = $context->link->getPageLink('new-products');
    
    $categoryId = getCategoryIdByName($categoryName, $idLang);
    
    if ($categoryId !== null) {
        return $context->link->getCategoryLink($categoryId);
    }
    
    return $defaultUrl;
}
