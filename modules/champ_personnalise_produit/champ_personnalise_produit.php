<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Champ_Personnalise_Produit extends Module
{
    public function __construct()
    {
        $this->name = 'champ_personnalise_produit';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Naturamedicatrix';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => _PS_VERSION_,
        ];
        
        parent::__construct();
        
        $this->displayName = $this->l('Champ personnalisé produit');
        $this->description = $this->l('Ajoute des champs personnalisés à la fiche produit');
    }

    public function install()
    {
        if (_PS_CACHE_ENABLED_) {
            Tools::clearCache();
        }
        
        // Ajoute la colonne num_lot à la table product
        $sql = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `num_lot` VARCHAR(255) NULL AFTER `reference`;';
        
        // Vérifie si la colonne existe déjà
        $columnExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "num_lot"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        $result = true;
        if (empty($columnExists)) {
            $result = Db::getInstance()->execute($sql);
        }
        
        return $result && 
               parent::install() && 
               $this->registerHook(['actionProductFormBuilderModifier', 'actionObjectProductUpdateAfter']);
    }
    
    public function uninstall()
    {
        if (_PS_CACHE_ENABLED_) {
            Tools::clearCache();
        }
        
        // On ne supprime pas la colonne lors de la désinstallation pour ne pas perdre les données
        // Décommenter la ligne suivante si on veut supprimer la colonne entièrement (data comprise)
        // Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'product` DROP COLUMN `num_lot`');
        
        return parent::uninstall();
    }
    
    public function hookActionProductFormBuilderModifier(array $params): void
    {
        if (!isset($params['form_builder']) || !isset($params['id'])) {
            return;
        }
        
        $productId = (int) $params['id'];
        $formBuilder = $params['form_builder'];
        
        // Récupère la valeur actuelle du champ personnalisé
        $numLot = '';
        $result = Db::getInstance()->getRow(
            'SELECT num_lot FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . (int) $productId
        );
        
        if ($result && isset($result['num_lot'])) {
            $numLot = $result['num_lot'];
        }
        
        // Onglet "details"
        if (!$formBuilder->has('details')) {
            return;
        }
        $detailsTabFormBuilder = $formBuilder->get('details');
        
        // Cible le block "group-form" references
        if ($detailsTabFormBuilder->has('references')) {
            $referencesGroup = $detailsTabFormBuilder->get('references');
            
            // Ajoute le champ "Numéro de lot en cours" dans le block "group-form" references
            $referencesGroup->add('num_lot', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', [
                'label' => 'Numéro de lot en cours',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisissez le numéro de lot en cours',
                    'class' => 'form-control',
                ],
                'data' => $numLot,
                'empty_data' => '',
            ]);
        } else {
            // Fallback si le groupe de références n'existe pas
            $formBuilderModifier = $this->get('form.form_builder_modifier');
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'ean13',
                'num_lot',
                'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType',
                [
                    'label' => 'Numéro de lot en cours',
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Saisissez le numéro de lot en cours',
                        'class' => 'form-control',
                    ],
                    'data' => $numLot,
                    'empty_data' => '',
                ]
            );
        }
    }
    
    public function hookActionObjectProductUpdateAfter($params)
    {
        if (!isset($params['object']) || !is_object($params['object'])) {
            return;
        }
        
        $product = $params['object'];
        $productId = (int) $product->id;
        
        // Récupère la valeur du champ personnalisé depuis POST
        $numLot = '';
        
        // Vérifie dans les différents endroits possibles
        if (isset($_POST['product']['details']['references']['num_lot'])) {
            $numLot = pSQL($_POST['product']['details']['references']['num_lot']);
        } elseif (isset($_POST['product']['details']['num_lot'])) {
            $numLot = pSQL($_POST['product']['details']['num_lot']);
        } elseif (isset($_POST['details']['references']['num_lot'])) {
            $numLot = pSQL($_POST['details']['references']['num_lot']);
        } elseif (isset($_POST['num_lot'])) {
            $numLot = pSQL($_POST['num_lot']);
        }
        
        // Si on n'a pas trouvé de valeur, on quitte
        if (empty($numLot)) {
            return;
        }
        
        // Sauvegarde la valeur dans la table product
        Db::getInstance()->execute(
            'UPDATE `' . _DB_PREFIX_ . 'product` 
            SET num_lot = "' . $numLot . '" 
            WHERE id_product = ' . $productId
        );
    }
}
