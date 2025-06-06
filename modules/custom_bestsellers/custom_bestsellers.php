<?php
/**
 * Module personnalisé pour afficher des produits spécifiques
 * comme "meilleures ventes" sur la page d'accueil
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Custom_Bestsellers extends Module
{
    // Nom de la sous-catégorie
    const CATEGORY_NAME = 'Best deals';
    
    /**
     * Obtient le lien vers une catégorie en se basant sur son nom
     * @param string $categoryName Nom de la catégorie
     * @param int $idLang ID de la langue
     * @return string URL de la catégorie ou URL par défaut si non trouvée
     */
    private function getCategoryLinkByName($categoryName, $idLang)
    {
        // URL par défaut si la catégorie n'est pas trouvée
        $defaultUrl = $this->context->link->getPageLink('index');
        
        try {
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
                            
                            // Génère le lien vers cette catégorie
                            return $this->context->link->getCategoryLink($tempCategory->id);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // En cas d'erreur, retourner l'URL par défaut
        }
        
        return $defaultUrl;
    }
    
    public function __construct()
    {
        $this->name = 'custom_bestsellers';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Naturamedicatrix';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Produits sélectionnés (Meilleures ventes personnalisées)');
        $this->description = $this->l('Affiche des produits sélectionnés manuellement sur la page d\'accueil.');
        $this->confirmUninstall = $this->l('Êtes-vous sûr de vouloir désinstaller ce module?');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayHome') &&
            $this->registerHook('header');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
    
    /**
     * Ajoute les informations de toutes les catégories pour chaque produit
     * 
     * @param array &$products Liste des produits à enrichir avec les catégories
     * @return void
     */
    private function addCategoriesInfoToProducts(&$products)
    {
        if (!is_array($products)) {
            return;
        }
        
        foreach ($products as &$productData) {
            if (!isset($productData['id_product'])) {
                continue;
            }
            
            try {
                // Créer un objet Product temporaire pour accéder à ses catégories
                $product = new Product((int)$productData['id_product'], false, $this->context->language->id);
                $categories = $product->getCategories();
                $categoryNames = [];
                
                // Récupérer les noms des catégories
                foreach ($categories as $catId) {
                    $category = new Category((int)$catId, $this->context->language->id);
                    if (Validate::isLoadedObject($category)) {
                        $categoryNames[$catId] = $category->name;
                    }
                }
                
                // Ajouter les informations aux données du produit
                $productData['all_categories'] = $categoryNames;
            } catch (Exception $e) {
                // En cas d'erreur, continuer avec le produit suivant
                continue;
            }
        }
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/custom_bestsellers.css', 'all');
        $this->context->controller->addJS($this->_path.'views/js/product-carousel.js');
    }

    public function hookDisplayHome()
    {
        // Recherche de la sous-catégorie par son nom (défini dans la constante)
        $categoryName = self::CATEGORY_NAME;
        $idLang = $this->context->language->id;
        $bestDealsId = null;
        
        try {
            // Récupère toutes les catégories correspondant au nom
            $categories = Category::searchByName($idLang, $categoryName, false);
            
            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    if (isset($cat['id_category'])) {
                        $tempCategory = new Category((int)$cat['id_category'], $idLang);
                        
                        if (Validate::isLoadedObject($tempCategory) && 
                            $tempCategory->level_depth > 1 && 
                            strtolower($tempCategory->name) == strtolower($categoryName)) {
                            $bestDealsId = $tempCategory->id;
                            break;
                        }
                    }
                }
            }
            
            // Si aucune sous-catégorie "Best deals" n'a été trouvée, essayer avec l'ID 23
            if ($bestDealsId === null) {
                $fallbackCategory = new Category(23, $idLang);
                if (Validate::isLoadedObject($fallbackCategory)) {
                    $bestDealsId = 23;
                } else {
                    return '';
                }
            }
        } catch (Exception $e) {
            return '';
        }
        
        // Récupère les informations sur la catégorie
        $category = new Category((int)$bestDealsId);
        
        if (!Validate::isLoadedObject($category)) {
            return '';
        }
        
        // Récupère tous les produits de la catégorie (limité à 9 maximum)
        $productIds = $category->getProducts($this->context->language->id, 0, 9, 'position', 'asc');
        
        if (empty($productIds)) {
            return '';
        }
        
        // Initialise les arrays pour stocker les produits
        $products = [];
        $productsPage1 = [];
        $productsPage2 = [];
        $productsPage3 = [];
        
       // 3 produits par page
        $productsPerPage = 3;
        $filteredIndex = 0;
        
        foreach ($productIds as $productData) {
            $productId = $productData['id_product'];
            $product = new Product($productId, true, $this->context->language->id);
            
            if (Validate::isLoadedObject($product) && $product->active) {
                $products[] = $product;
                
                $pageIndex = floor($filteredIndex / $productsPerPage);
                
                if ($pageIndex == 0) {
                    $productsPage1[] = $product;
                } elseif ($pageIndex == 1) {
                    $productsPage2[] = $product;
                } elseif ($pageIndex == 2) {
                    $productsPage3[] = $product;
                }
                
                $filteredIndex++;
            }
        }
        
        // Si après filtrage --> pas de produits
        if (empty($products)) {
            return '';
        }
        
        // Prépare les données des produits pour l'affichage
        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = $presenterFactory->getPresenter();
        
        // Prépare les produits pour chaque page
        $productsPage1ForTemplate = [];
        $productsPage2ForTemplate = [];
        $productsPage3ForTemplate = [];
        $allProductsForTemplate = [];
        
        // Page 1
        foreach ($productsPage1 as $product) {
            // Récupère les données complètes du produit
            $productData = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $this->context->language
            );
            

            $productsPage1ForTemplate[] = $productData;
            $allProductsForTemplate[] = $productData; // Ajoute à la liste complète pour mobile
        }
        
        // Page 2
        foreach ($productsPage2 as $product) {
            // Récupère les données complètes du produit
            $productData = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $this->context->language
            );
            

            $productsPage2ForTemplate[] = $productData;
            $allProductsForTemplate[] = $productData; // Ajoute à la liste complète pour mobile
        }
        
        // Page 3
        foreach ($productsPage3 as $product) {
            // Récupère les données complètes du produit
            $productData = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $this->context->language
            );
            

            $productsPage3ForTemplate[] = $productData;
            $allProductsForTemplate[] = $productData; // Ajoute à la liste complète pour mobile
        }
        
        // Aucun code de débogage dans la version finale
        
        // Ajoute les informations de catégories pour chaque produit
        $this->addCategoriesInfoToProducts($productsPage1ForTemplate);
        $this->addCategoriesInfoToProducts($productsPage2ForTemplate);
        $this->addCategoriesInfoToProducts($productsPage3ForTemplate);
        $this->addCategoriesInfoToProducts($allProductsForTemplate);
        
        $this->smarty->assign([
            'productsPage1' => $productsPage1ForTemplate,
            'productsPage2' => $productsPage2ForTemplate,
            'productsPage3' => $productsPage3ForTemplate,
            'allProducts' => $allProductsForTemplate, // mobile
            'allProductsLink' => $this->getCategoryLinkByName(self::CATEGORY_NAME, $idLang), // Lien avec le nom de la catégorie
            'categoryName' => $category->name[$idLang],
            'homeLink' => $this->context->link->getPageLink('index'),
            'pricesDropLink' => $this->context->link->getPageLink('prices-drop'),
            'newProductsLink' => $this->context->link->getPageLink('new-products'),
            'link' => $this->context->link
        ]);
        
        return $this->display(__FILE__, 'views/templates/hook/custom_bestsellers.tpl');
    }
}
