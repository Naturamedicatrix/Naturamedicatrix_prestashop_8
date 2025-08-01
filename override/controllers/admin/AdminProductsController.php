<?php
/**
 * Override AdminProductsController to add batch_number field to the product form
 */

class AdminProductsController extends AdminProductsControllerCore
{
    public function __construct()
    {
        parent::__construct();

        $this->fields_form_override = array(
            'legend' => array(
                'title' => $this->trans('Product', array(), 'Admin.Catalog.Feature'),
                'icon' => 'icon-info-sign'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->trans('Numéro de lot en cours', array(), 'Admin.Catalog.Feature'),
                    'name' => 'batch_number',
                    'size' => 255,
                    'required' => false,
                    'desc' => $this->trans('Entrez le numéro de lot actuel pour ce produit.', array(), 'Admin.Catalog.Help')
                ),
            ),
        );
    }
}
