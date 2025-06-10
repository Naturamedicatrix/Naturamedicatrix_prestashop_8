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
        
        $result = true;
        
        // Ajoute la colonne lot à la table product
        $sql1 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `lot` VARCHAR(255) NULL AFTER `reference`;';
        
        // Vérifie si la colonne lot existe déjà
        $columnLotExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "lot"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnLotExists)) {
            $result = $result && Db::getInstance()->execute($sql1);
        }
        
        // Ajoute la colonne dlu à la table product
        $sql2 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `dlu` DATE NULL AFTER `lot`;';
        
        // Vérifie si la colonne dlu existe déjà
        $columnDluExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "dlu"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnDluExists)) {
            $result = $result && Db::getInstance()->execute($sql2);
        }
        
        return $result && 
               parent::install() && 
               $this->registerHook([
                   'actionProductFormBuilderModifier', 
                   'actionObjectProductUpdateAfter', 
                   'actionGetProductPropertiesAfter',
                   'displayOverrideTemplate'
               ]);
    }
    
    public function uninstall()
    {
        if (_PS_CACHE_ENABLED_) {
            Tools::clearCache();
        }
        
        // On ne supprime pas les colonnes lors de la désinstallation pour ne pas perdre les données
        // Décommenter les lignes suivantes si on veut supprimer les colonnes entièrement (data comprise)
        // Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'product` DROP COLUMN `lot`');
        // Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'product` DROP COLUMN `dlu`');
        
        return parent::uninstall();
    }
    
    public function hookActionProductFormBuilderModifier(array $params): void
    {
        if (!isset($params['form_builder']) || !isset($params['id'])) {
            return;
        }
        
        $productId = (int) $params['id'];
        $formBuilder = $params['form_builder'];
        
        // Récupère les valeurs actuelles des champs personnalisés
        $lot = '';
        $dlu = '';
        $result = Db::getInstance()->getRow(
            'SELECT lot, dlu FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . (int) $productId
        );
        
        if ($result) {
            if (isset($result['lot'])) {
                $lot = $result['lot'];
            }
            if (isset($result['dlu'])) {
                $dlu = $result['dlu'];
            }
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
            $referencesGroup->add('lot', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', [
                'label' => 'Numéro de lot en cours',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisissez le numéro de lot en cours',
                    'class' => 'form-control',
                ],
                'data' => $lot,
                'empty_data' => '',
            ]);
            
            // Ajoute le champ "DLU" dans le block "group-form" references
            $referencesGroup->add('dlu', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateType', [
                'label' => 'DLU',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => true,
                'attr' => [
                    'placeholder' => 'AAAA-MM-JJ',
                    'class' => 'form-control',
                ],
                'data' => !empty($dlu) ? new \DateTime($dlu) : null,
            ]);
        } else {
            // Fallback si le groupe de références n'existe pas
            $formBuilderModifier = $this->get('form.form_builder_modifier');
            
            // Ajoute le champ Numéro de lot en cours
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'ean13',
                'lot',
                'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType',
                [
                    'label' => 'Numéro de lot en cours',
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Saisissez le numéro de lot en cours',
                        'class' => 'form-control',
                    ],
                    'data' => $lot,
                    'empty_data' => '',
                ]
            );
            
            // Ajoute le champ DLU juste après le champ lot
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'lot',
                'dlu',
                'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateType',
                [
                    'label' => 'DLU',
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'html5' => true,
                    'attr' => [
                        'placeholder' => 'AAAA-MM-JJ',
                        'class' => 'form-control',
                    ],
                    'data' => !empty($dlu) ? new \DateTime($dlu) : null,
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
        
        // Récupère les valeurs des champs personnalisés depuis POST
        $lot = '';
        $dlu = null;
        
        // Vérifie les différents endroits possibles pour le lot
        if (isset($_POST['product']['details']['references']['lot'])) {
            $lot = pSQL($_POST['product']['details']['references']['lot']);
        } elseif (isset($_POST['product']['details']['lot'])) {
            $lot = pSQL($_POST['product']['details']['lot']);
        } elseif (isset($_POST['details']['references']['lot'])) {
            $lot = pSQL($_POST['details']['references']['lot']);
        } elseif (isset($_POST['lot'])) {
            $lot = pSQL($_POST['lot']);
        }
        
        // Vérifie les différents endroits possibles pour la DLU
        if (isset($_POST['product']['details']['references']['dlu'])) {
            $dlu = $_POST['product']['details']['references']['dlu'];
        } elseif (isset($_POST['product']['details']['dlu'])) {
            $dlu = $_POST['product']['details']['dlu'];
        } elseif (isset($_POST['details']['references']['dlu'])) {
            $dlu = $_POST['details']['references']['dlu'];
        } elseif (isset($_POST['dlu'])) {
            $dlu = $_POST['dlu'];
        }
        
        // Formate la date si elle existe
        $dluFormatted = 'NULL';
        if (!empty($dlu)) {
            $dluFormatted = '"' . pSQL($dlu) . '"';
        }
        
        // Sauvegarde les valeurs dans la table product
        Db::getInstance()->execute(
            'UPDATE `' . _DB_PREFIX_ . 'product` 
            SET lot = "' . $lot . '", 
                dlu = ' . $dluFormatted . ' 
            WHERE id_product = ' . $productId
        );
    }
    
    /**
     * Hook pour ajouter les champs personnalisés à l'objet produit dans le panier
     */
    public function hookActionGetProductPropertiesAfter($params)
    {
        if (!isset($params['product']) || !isset($params['id_product'])) {
            return;
        }
        
        $productId = (int) $params['id_product'];
        
        // Récupère les données de lot et DLU depuis la table product
        $result = Db::getInstance()->getRow(
            'SELECT lot, dlu FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . $productId
        );
        
        if ($result) {
            // Debug pour vérifier les données récupérées
            PrestaShopLogger::addLog('Données produit ID '.$productId.': lot='.(isset($result['lot']) ? $result['lot'] : 'non défini').', dlu='.(isset($result['dlu']) ? $result['dlu'] : 'non défini'), 1);
            
            // Ajouter les champs personnalisés à l'objet produit
            if (isset($result['lot'])) {
                $params['product']['lot'] = $result['lot'];
            }
            
            if (isset($result['dlu'])) {
                $params['product']['dlu'] = $result['dlu'];
            }
        }
        
        return $params['product'];
    }
    
    /**
     * Hook pour enrichir les données des produits dans le panier
     */
    public function hookDisplayOverrideTemplate($params)
    {
        // Vérifie si nous sommes sur la page du panier
        if (isset($params['template_file']) && $params['template_file'] == 'checkout/cart') {
            // Récupère l'objet Cart du contexte
            $cart = Context::getContext()->cart;
            if (!$cart || !$cart->id) {
                return;
            }
            
            // Récupère les produits du panier
            $products = $cart->getProducts();
            
            if (!empty($products)) {
                foreach ($products as &$product) {
                    // Récupère les infos lot et DLU depuis la base
                    $result = Db::getInstance()->getRow(
                        'SELECT lot, dlu FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . (int)$product['id_product']
                    );
                    
                    if ($result) {
                        // Ajouter les champs au produit
                        if (isset($result['lot'])) {
                            $product['lot'] = $result['lot'];
                        }
                        
                        if (isset($result['dlu'])) {
                            $product['dlu'] = $result['dlu'];
                        }
                    }
                }
                
                // Mettre à jour les produits dans le contexte
                Context::getContext()->smarty->assign('cart', ['products' => $products]);
            }
        }
    }
    
}
