<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ai5Chat extends Module
{
    const AI5_CHAT_CONFIG_URL = 'AI5_CHAT_CONFIG_URL';
    const AI5_CHAT_CONFIG_GROUPS = 'AI5_CHAT_CONFIG_GROUPS';

    public function __construct()
    {
        $this->name = 'ai5chat';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Ai5';
        $this->need_instance = 1;
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => '8.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Ai5 Chat');
        $this->description = $this->l('Ai5 Chat module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return parent::install()
            && Configuration::updateValue(self::AI5_CHAT_CONFIG_URL, '')
            && Configuration::updateValue(self::AI5_CHAT_CONFIG_GROUPS, json_encode([]))
            && $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return parent::uninstall()
            && Configuration::deleteByName(self::AI5_CHAT_CONFIG_URL)
            && Configuration::deleteByName(self::AI5_CHAT_CONFIG_GROUPS);
    }

    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submit' . $this->name)) {
            $chatUrl = Tools::getValue(self::AI5_CHAT_CONFIG_URL);

            if (
                !$chatUrl
                || empty($chatUrl)
            ) {
                $output .= $this->displayError($this->l('Invalid chat URL'));
            } else {
                Configuration::updateValue(self::AI5_CHAT_CONFIG_URL, $chatUrl);
            }

            $groups = Group::getGroups($this->context->language->id, true);
            $groupsData = Tools::getValue(self::AI5_CHAT_CONFIG_GROUPS);
            $groupsApiKey = [];

            foreach ($groups as $group) {
                if (isset($groupsData[$group['id_group']])) {
                    $value = trim($groupsData[$group['id_group']]);

                    if (strlen($value) > 0) {
                        $groupsApiKey[] = (object) [
                            'id' => $group['id_group'],
                            'key' => $value,
                        ];
                    }
                }
            }

            Configuration::updateValue(self::AI5_CHAT_CONFIG_GROUPS, json_encode($groupsApiKey));

            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }

        return $output . $this->displayForm();
    }

    protected function getGroupsConfig()
    {
        $groupsConfig = json_decode(Configuration::get(self::AI5_CHAT_CONFIG_GROUPS));
        if ($groupsConfig === null) {
            $groupsConfig = [];
        }

        return $groupsConfig;
    }

    protected function getGroupApiKey($groupId, $groupsConfig)
    {
        $value = current(array_filter($groupsConfig, function ($current) use ($groupId) {
            return (int) $current->id == (int) $groupId;
        }));

        if (!$value || strlen($value->key) == 0) {
            return null;
        }

        return $value->key;
    }

    protected function getCustomerApiKey($customer)
    {
        $groups = $customer->getGroups();
        $config = $this->getGroupsConfig();
        $defaultGroupId = (int) $this->context->customer->id_default_group;
        $apiKeyByGroupId = [];

        foreach ($groups as $groupId) {
            $apiKey = $this->getGroupApiKey($groupId, $config);
            if (is_null($apiKey)) {
                continue;
            }

            $apiKeyByGroupId['group_' . $groupId] = $apiKey;
        }

        if (count($apiKeyByGroupId) == 1) {
            return array_shift($apiKeyByGroupId);
        }

        $filtered = array_filter($apiKeyByGroupId, function ($v) use ($defaultGroupId) {
            return $v !== 'group_' . $defaultGroupId;
        }, ARRAY_FILTER_USE_KEY);

        ksort($filtered);

        return array_pop($filtered);
    }

    public function displayForm()
    {
        // Get default language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $groups = Group::getGroups($this->context->language->id, true);

        // Init Fields form array
        $fields_form[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs'
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Chat URL'),
                    'name' => self::AI5_CHAT_CONFIG_URL,
                    'required' => true,
                    'desc' => $this->l('Insert here the URL provided by Ai5')
                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-primary'
            ],
        ];


        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&save' . $this->name .
                    '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ],
            'back' => [
                'href' => $this->context->link->getAdminLink('AdminModules', false),
                'desc' => $this->l('Back to list')
            ]
        ];

        // Load current value
        $helper->fields_value[self::AI5_CHAT_CONFIG_URL] = Configuration::get(self::AI5_CHAT_CONFIG_URL);
        $groupsConfig = $this->getGroupsConfig();

        foreach ($groups as $group) {
            $fields_form[0]['form']['input'][] = [
                'type' => 'text',
                'label' => sprintf($this->l('API key for %s group'), $group['name']),
                'name' => self::AI5_CHAT_CONFIG_GROUPS . "[{$group['id_group']}]",
                'required' => false
            ];

            $value = $this->getGroupApiKey($group['id_group'], $groupsConfig);
            $helper->fields_value[self::AI5_CHAT_CONFIG_GROUPS . "[{$group['id_group']}]"] = $value ? $value : '';
        }

        return $helper->generateForm($fields_form);
    }

    public function hookDisplayHeader()
    {
        $apiKey = $this->getCustomerApiKey($this->context->customer);

        if ($apiKey) {
            // Naturamedicatrix: Update for PrestaShop 8.2
            $this->context->controller->registerStylesheet(
                'ai5chat-css',
                'modules/' . $this->name . '/views/css/ai5chat.css',
                ['media' => 'all', 'priority' => 150]
            );
            $this->context->controller->registerJavascript(
                'ai5chat-js',
                'modules/' . $this->name . '/views/js/ai5chat.js',
                ['position' => 'bottom', 'priority' => 150]
            );

            $this->context->smarty->assign([
                'ai5_chat_url' => Configuration::get(self::AI5_CHAT_CONFIG_URL),
                'ai5_chat_api_key' => $apiKey,
                'ai5_chat_lang' => $this->context->language->iso_code,
            ]);

            // Naturamedicatrix: Use of the clients default group ID for the cache
            $defaultGroupId = (int) $this->context->customer->id_default_group;
            return $this->display(__FILE__, 'header.tpl', $this->getCacheId('ai5chat_header|' . $defaultGroupId));
        }
        return '';
    }
}
