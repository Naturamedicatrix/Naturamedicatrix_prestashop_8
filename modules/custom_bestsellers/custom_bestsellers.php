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

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/custom_bestsellers.css', 'all');
        $this->context->controller->addJS($this->_path.'views/js/product-carousel.js');
    }

    public function hookDisplayHome()
    {
        // IDs des produits spécifiques à afficher (3 par page pour le carousel)
        // Page 1
        $page1ProductIds = [19, 17, 16];
        // Page 2
        $page2ProductIds = [1, 2, 3];
        // Page 3
        $page3ProductIds = [4, 5, 6];
        
        // Combine tous les IDs de produits
        $allProductIds = array_merge($page1ProductIds, $page2ProductIds, $page3ProductIds);
        
        // Récupère les produits spécifiques
        $products = [];
        $productsPage1 = [];
        $productsPage2 = [];
        $productsPage3 = [];
        
        foreach ($allProductIds as $index => $productId) {
            $product = new Product($productId, true, $this->context->language->id);
            if (Validate::isLoadedObject($product) && $product->active) {
                // Ajoute à la liste complète
                $products[] = $product;
                
                // Ajoute à la page correspondante
                if (in_array($productId, $page1ProductIds)) {
                    $productsPage1[] = $product;
                } elseif (in_array($productId, $page2ProductIds)) {
                    $productsPage2[] = $product;
                } elseif (in_array($productId, $page3ProductIds)) {
                    $productsPage3[] = $product;
                }
            }
        }
        
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
            $productData = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $this->context->language
            );
            $productsPage3ForTemplate[] = $productData;
            $allProductsForTemplate[] = $productData; // Ajoute à la liste complète pour mobile
        }
        
        $this->smarty->assign([
            'productsPage1' => $productsPage1ForTemplate,
            'productsPage2' => $productsPage2ForTemplate,
            'productsPage3' => $productsPage3ForTemplate,
            'allProducts' => $allProductsForTemplate, // Pour l'affichage mobile
            'allProductsLink' => $this->context->link->getCategoryLink(2),
            'homeLink' => $this->context->link->getPageLink('index'),
            'pricesDropLink' => $this->context->link->getPageLink('prices-drop'),
            'newProductsLink' => $this->context->link->getPageLink('new-products'),
            'link' => $this->context->link
        ]);
        
        return $this->display(__FILE__, 'views/templates/hook/custom_bestsellers.tpl');
    }
}
