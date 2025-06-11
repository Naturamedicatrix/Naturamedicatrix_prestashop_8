<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        
        // Ajoute la colonne dlu_checkbox à la table product
        $sql3 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `dlu_checkbox` TINYINT(1) NOT NULL DEFAULT 0 AFTER `dlu`;';
        
        // Vérifie si la colonne dlu_checkbox existe déjà
        $columnDluCheckboxExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "dlu_checkbox"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnDluCheckboxExists)) {
            $result = $result && Db::getInstance()->execute($sql3);
        }
        
        // Ajoute la colonne nm_days à la table product
        $sql4 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `nm_days` SMALLINT(5) NULL AFTER `dlu_checkbox`;';
        
        // Vérifie si la colonne nm_days existe déjà
        $columnNmDaysExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "nm_days"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnNmDaysExists)) {
            $result = $result && Db::getInstance()->execute($sql4);
        }
        
        // Ajoute la colonne amazon à la table product
        $sql5 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `amazon` TEXT NULL AFTER `nm_days`;';
        
        // Vérifie si la colonne amazon existe déjà
        $columnAmazonExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "amazon"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnAmazonExists)) {
            $result = $result && Db::getInstance()->execute($sql5);
        }
        
        // Ajoute la colonne amazon_be à la table product
        $sql6 = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` ADD COLUMN `amazon_be` TEXT NULL AFTER `amazon`;';
        
        // Vérifie si la colonne amazon_be existe déjà
        $columnAmazonBeExists = Db::getInstance()->executeS(
            'SHOW COLUMNS FROM `' . _DB_PREFIX_ . 'product` LIKE "amazon_be"'
        );
        
        // Exécute la requête SQL seulement si la colonne n'existe pas
        if (empty($columnAmazonBeExists)) {
            $result = $result && Db::getInstance()->execute($sql6);
        }
        
        return $result && 
               parent::install() && 
               $this->registerHook([
                   'actionProductFormBuilderModifier', 
                   'actionObjectProductUpdateAfter', 
                   'actionGetProductPropertiesAfter',
                   'displayOverrideTemplate',
                   'displayHeader'
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
        // Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'product` DROP COLUMN `dlu_checkbox`');
        
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
        $dluCheckbox = false;
        $nmDays = null;
        $amazon = '';
        $amazonBe = '';
        $result = Db::getInstance()->getRow(
            'SELECT lot, dlu, dlu_checkbox, nm_days, amazon, amazon_be FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . (int) $productId
        );
        
        if ($result) {
            if (isset($result['lot'])) {
                $lot = $result['lot'];
            }
            if (isset($result['dlu'])) {
                $dlu = $result['dlu'];
            }
            if (isset($result['dlu_checkbox'])) {
                $dluCheckbox = (bool)$result['dlu_checkbox'];
            }
            if (isset($result['nm_days'])) {
                $nmDays = (int)$result['nm_days'];
            }
            if (isset($result['amazon'])) {
                $amazon = $result['amazon'];
            }
            if (isset($result['amazon_be'])) {
                $amazonBe = $result['amazon_be'];
            }
        }
        
        // Onglet "details"
        if (!$formBuilder->has('details')) {
            return;
        }
        $detailsTabFormBuilder = $formBuilder->get('details');
        
        // Crée un nouveau groupe pour Amazon s'il n'existe pas déjà
        if (!$detailsTabFormBuilder->has('amazon_links')) {
            $detailsTabFormBuilder->add('amazon_links', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\FormType', [
                'label' => 'Amazon',
                'required' => false,
                'attr' => [
                    'class' => 'form-group',
                    'id' => 'product_details_amazon_links'
                ],
                'label_attr' => [
                    'class' => 'form-control-label h3',
                    'style' => 'margin-bottom: 1rem;'
                ],
            ]);
        }
        
        // Récupère le groupe amazon_links
        $amazonGroup = $detailsTabFormBuilder->get('amazon_links');
        
        // Ajoute les champs amazon et amazon_be
        $amazonGroup->add('amazon', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', [
            'label' => 'Bouton Amazon',
            'required' => false,
            'attr' => [
                'placeholder' => 'https://www.amazon.fr/...',
                'class' => 'form-control',
            ],
            'label_attr' => [
                'style' => 'display: inline-block; background-color: orange; padding: 3px 8px; border-radius: 3px; color: black;',
            ],
            'data' => $amazon,
        ]);
        
        $amazonGroup->add('amazon_be', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', [
            'label' => 'Bouton Amazon (be)',
            'required' => false,
            'attr' => [
                'placeholder' => 'https://www.amazon.com.be/...',
                'class' => 'form-control',
            ],
            'label_attr' => [
                'style' => 'display: inline-block; background-color: orange; padding: 3px 8px; border-radius: 3px; color: black;',
            ],
            'data' => $amazonBe,
        ]);
        
        // Cible le block "group-form" references
        if ($detailsTabFormBuilder->has('references')) {
            $referencesGroup = $detailsTabFormBuilder->get('references');
            
            // Ajout du champ jours de prise du produit - maintenant en premier
            $referencesGroup->add('nm_days', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\NumberType', [
                'label' => $this->l('Jours de prise du produit (en jours)'),
                'required' => false,
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control',
                    'min' => 0
                ],
                'data' => $nmDays,
            ]);
            
            // Ajoute le champ "Numéro de lot en cours" dans le block "group-form" references
            $referencesGroup->add('lot', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', [
                'label' => 'Numéro de lot en cours',
                'required' => false,
                'attr' => [
                    'placeholder' => '',
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
            
            // Ajout du champ personnalisé DLU courte (checkbox)
            $referencesGroup->add('dlu_checkbox', CheckboxType::class, [
                'label' => $this->l('DLU courte'),
                'required' => false,
                'data' => $dluCheckbox,
                'attr' => [
                    'id' => 'checkbox_dlu'
                ],
                'row_attr' => [
                    'class' => 'checkbox-align-input',
                    'style' => 'margin-top: -30px; margin-bottom: 20px;',
                ],
                'label_attr' => [
                    'style' => 'padding-top: 0;'
                ]
            ]);
        } else {
            // Fallback si le groupe de références n'existe pas
            // Utilise le service FormBuilderModifier
            $formBuilderModifier = $this->get('prestashop.core.form.identifiable_object.builder.form_builder_modifier');
            
            // Ajoute d'abord le champ jours de prise (nm_days)
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'ean13',
                'nm_days',
                'Symfony\\Component\\Form\\Extension\\Core\\Type\\NumberType',
                [
                    'label' => $this->l('Jours de prise du produit (en jours)'),
                    'required' => false,
                    'attr' => [
                        'placeholder' => '',
                        'class' => 'form-control',
                        'min' => 0,
                    ],
                    'data' => $nmDays,
                ]
            );
            
            // Ajoute le champ Numéro de lot en cours après nm_days
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'nm_days',
                'lot',
                TextType::class, [
                'label' => 'Numéro de lot en cours',
                'required' => false,
                'attr' => [
                    'placeholder' => '',
                    'class' => 'form-control',
                ],
                'data' => $lot,
                'empty_data' => '',
            ]);
            
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
            
            // Ajoute le champ DLU checkbox juste après le champ DLU
            $formBuilderModifier->addAfter(
                $detailsTabFormBuilder,
                'dlu',
                'dlu_checkbox',
                CheckboxType::class,
                [
                    'label' => $this->l('DLU courte'),
                    'required' => false,
                    'data' => $dluCheckbox,
                    'attr' => [
                        'id' => 'checkbox_dlu'
                    ],
                    'row_attr' => [
                        'class' => 'checkbox-align-input'
                    ],
                    'label_attr' => [
                        'style' => 'padding-top: 0;'
                    ]
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
        
        // Vérifie les différents endroits possibles pour la DLU checkbox
        $dluCheckbox = 0;
        if (isset($_POST['product']['details']['references']['dlu_checkbox'])) {
            $dluCheckbox = (int)!empty($_POST['product']['details']['references']['dlu_checkbox']);
        } elseif (isset($_POST['product']['details']['dlu_checkbox'])) {
            $dluCheckbox = (int)!empty($_POST['product']['details']['dlu_checkbox']);
        } elseif (isset($_POST['details']['references']['dlu_checkbox'])) {
            $dluCheckbox = (int)!empty($_POST['details']['references']['dlu_checkbox']);
        } elseif (isset($_POST['dlu_checkbox'])) {
            $dluCheckbox = (int)!empty($_POST['dlu_checkbox']);
        }
        
        // Vérifie les différents endroits possibles pour nm_days
        $nmDays = 'NULL';
        if (isset($_POST['product']['details']['references']['nm_days']) && $_POST['product']['details']['references']['nm_days'] !== '') {
            $nmDays = (int)$_POST['product']['details']['references']['nm_days'];
        } elseif (isset($_POST['product']['details']['nm_days']) && $_POST['product']['details']['nm_days'] !== '') {
            $nmDays = (int)$_POST['product']['details']['nm_days'];
        } elseif (isset($_POST['details']['references']['nm_days']) && $_POST['details']['references']['nm_days'] !== '') {
            $nmDays = (int)$_POST['details']['references']['nm_days'];
        } elseif (isset($_POST['nm_days']) && $_POST['nm_days'] !== '') {
            $nmDays = (int)$_POST['nm_days'];
        }
        
        // Vérifie les différents endroits possibles pour amazon
        $amazon = '';
        if (isset($_POST['product']['details']['amazon_links']['amazon'])) {
            $amazon = pSQL($_POST['product']['details']['amazon_links']['amazon']);
        } elseif (isset($_POST['product']['details']['amazon'])) {
            $amazon = pSQL($_POST['product']['details']['amazon']);
        } elseif (isset($_POST['details']['amazon_links']['amazon'])) {
            $amazon = pSQL($_POST['details']['amazon_links']['amazon']);
        } elseif (isset($_POST['amazon'])) {
            $amazon = pSQL($_POST['amazon']);
        }
        
        // Vérifie les différents endroits possibles pour amazon_be
        $amazonBe = '';
        if (isset($_POST['product']['details']['amazon_links']['amazon_be'])) {
            $amazonBe = pSQL($_POST['product']['details']['amazon_links']['amazon_be']);
        } elseif (isset($_POST['product']['details']['amazon_be'])) {
            $amazonBe = pSQL($_POST['product']['details']['amazon_be']);
        } elseif (isset($_POST['details']['amazon_links']['amazon_be'])) {
            $amazonBe = pSQL($_POST['details']['amazon_links']['amazon_be']);
        } elseif (isset($_POST['amazon_be'])) {
            $amazonBe = pSQL($_POST['amazon_be']);
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
                dlu = ' . $dluFormatted . ',
                dlu_checkbox = ' . $dluCheckbox . ',
                nm_days = ' . $nmDays . ',
                amazon = "' . $amazon . '",
                amazon_be = "' . $amazonBe . '" 
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
        
        // Récupère les données de lot, DLU et autres champs depuis la table product
        $result = Db::getInstance()->getRow(
            'SELECT lot, dlu, dlu_checkbox, nm_days, amazon, amazon_be FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . $productId
        );
        
        if ($result) {
            // Debug pour vérifier les données récupérées
            PrestaShopLogger::addLog('Données produit ID '.$productId.': lot='.(isset($result['lot']) ? $result['lot'] : 'non défini').', dlu='.(isset($result['dlu']) ? $result['dlu'] : 'non défini').', dlu_checkbox='.(isset($result['dlu_checkbox']) ? $result['dlu_checkbox'] : 'non défini').', nm_days='.(isset($result['nm_days']) ? $result['nm_days'] : 'non défini').', amazon='.(isset($result['amazon']) ? 'présent' : 'non défini').', amazon_be='.(isset($result['amazon_be']) ? 'présent' : 'non défini'), 1);
            
            // Ajouter les champs personnalisés à l'objet produit
            if (isset($result['lot'])) {
                $params['product']['lot'] = $result['lot'];
            }
            
            if (isset($result['dlu'])) {
                $params['product']['dlu'] = $result['dlu'];
            }
            
            if (isset($result['dlu_checkbox'])) {
                $params['product']['dlu_checkbox'] = $result['dlu_checkbox'];
            }
            
            if (isset($result['nm_days'])) {
                $params['product']['nm_days'] = $result['nm_days'];
            }
            
            if (isset($result['amazon'])) {
                $params['product']['amazon'] = $result['amazon'];
            }
            
            if (isset($result['amazon_be'])) {
                $params['product']['amazon_be'] = $result['amazon_be'];
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
                    // Récupère les infos lot, DLU et autres champs depuis la base
                    $result = Db::getInstance()->getRow(
                        'SELECT lot, dlu, dlu_checkbox, nm_days, amazon, amazon_be FROM `' . _DB_PREFIX_ . 'product` WHERE id_product = ' . (int)$product['id_product']
                    );
                    
                    if ($result) {
                        // Ajouter les champs au produit
                        if (isset($result['lot'])) {
                            $product['lot'] = $result['lot'];
                        }
                        
                        if (isset($result['dlu'])) {
                            $product['dlu'] = $result['dlu'];
                        }
                        
                        if (isset($result['dlu_checkbox'])) {
                            $product['dlu_checkbox'] = $result['dlu_checkbox'];
                        }
                        
                        if (isset($result['nm_days'])) {
                            $product['nm_days'] = $result['nm_days'];
                        }
                        
                        if (isset($result['amazon'])) {
                            $product['amazon'] = $result['amazon'];
                        }
                        
                        if (isset($result['amazon_be'])) {
                            $product['amazon_be'] = $result['amazon_be'];
                        }
                    }
                }
                
                // Mettre à jour les produits dans le contexte
                Context::getContext()->smarty->assign('cart', ['products' => $products]);
            }
        }
    }
}
