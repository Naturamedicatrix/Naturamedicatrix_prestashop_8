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
    }

    public function hookDisplayHome()
    {
        // IDs des produits spécifiques à afficher
        $specificProductIds = [19, 17, 16];
        
        // Récupérer les produits spécifiques
        $products = [];
        foreach ($specificProductIds as $productId) {
            $product = new Product($productId, true, $this->context->language->id);
            if (Validate::isLoadedObject($product) && $product->active) {
                $products[] = $product;
            }
        }
        
        if (empty($products)) {
            return '';
        }
        
        // Préparer les données des produits pour l'affichage
        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = $presenterFactory->getPresenter();
        
        $products_for_template = [];
        
        foreach ($products as $product) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct(['id_product' => $product->id]),
                $this->context->language
            );
        }
        
        $this->smarty->assign([
            'products' => $products_for_template,
            'allProductsLink' => $this->context->link->getCategoryLink(2),
            'homeLink' => $this->context->link->getPageLink('index'),
            'pricesDropLink' => $this->context->link->getPageLink('prices-drop'),
            'newProductsLink' => $this->context->link->getPageLink('new-products'),
            'link' => $this->context->link
        ]);
        
        return $this->display(__FILE__, 'views/templates/hook/custom_bestsellers.tpl');
    }
}
