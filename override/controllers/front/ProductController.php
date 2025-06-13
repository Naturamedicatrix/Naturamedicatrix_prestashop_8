<?php
/**
 * Surcharge du ProductController pour ajouter les champs personnalisés directement
 */
class ProductController extends ProductControllerCore
{
    /**
     * Initializes the template variables for the product template
     */
    public function initContent()
    {
        // Exécuter le code parent d'abord
        parent::initContent();
        
        // Enrichir l'objet produit après le chargement
        $this->enrichProductWithCustomFields();
    }
    
    /**
     * Enrichit l'objet produit avec les champs personnalisés
     */
    protected function enrichProductWithCustomFields()
    {
        // Vérifier si le produit est chargé
        if (!isset($this->context->smarty->getTemplateVars('product')['id'])) {
            return;
        }
        
        // Récupérer les variables produit actuelles
        $productVars = $this->context->smarty->getTemplateVars('product');
        $productId = (int)$productVars['id'];
        
        // Récupère les champs personnalisés de base
        $result = Db::getInstance()->getRow(
            'SELECT lot, dlu, dlu_checkbox, nm_days, amazon, amazon_be, product_popup_redirection, video_iframe 
            FROM `' . _DB_PREFIX_ . 'product` 
            WHERE id_product = ' . $productId
        );
        
        // Ajouter les champs personnalisés aux variables produit
        if ($result && is_array($result)) {
            foreach ($result as $key => $value) {
                if (isset($value) && $value !== '') {
                    $productVars[$key] = $value;
                }
            }
        }
        
        // Récupère les champs personnalisés multilingues
        $idLang = $this->context->language->id;
        $resultLang = Db::getInstance()->getRow(
            'SELECT mode_emploi, contre_indications, ingredients, tab_nutri, thera_sup, popup_info 
            FROM `' . _DB_PREFIX_ . 'product_lang` 
            WHERE id_product = ' . $productId . ' AND id_lang = ' . $idLang
        );
        
        // Ajouter les champs multilingues aux variables produit
        if ($resultLang && is_array($resultLang)) {
            foreach ($resultLang as $key => $value) {
                if (isset($value) && $value !== '') {
                    $productVars[$key] = $value;
                }
            }
        }
        
        // Marquer que les champs personnalisés ont été chargés
        $productVars['champ_personnalise_loaded'] = true;
        
        // Mettre à jour les variables smarty
        $this->context->smarty->assign('product', $productVars);
    }
}
