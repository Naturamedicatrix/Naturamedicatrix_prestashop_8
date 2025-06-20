<?php
/**
 * Override du CategoryController pour modifier le layout de la catégorie "Principes actifs"
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
}
