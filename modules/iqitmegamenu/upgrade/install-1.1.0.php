<?php
/**
 * 2017 IQIT-COMMERCE.COM
 *
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement
 *
 *  @author    IQIT-COMMERCE.COM <support@iqit-commerce.com>
 *  @copyright 2017 IQIT-COMMERCE.COM
 *  @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_1_0($object)
{
    Configuration::updateValue('iqitmegamenu_hor_hook', 0);
    $object->registerHook('displayIqitMenu');

    Db::getInstance()->execute('ALTER TABLE `' . _DB_PREFIX_ . 'iqitmegamenu_tabs` ADD group_access TEXT NOT NULL AFTER submenu_border_i');

    $groups = Group::getGroups(Context::getContext()->language->id);

    $group_access = [];

    foreach ($groups as $group) {
        $group_access[$group['id_group']] = true;
    }
    $group_access = serialize($group_access);

    Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'iqitmegamenu_tabs` SET group_access = "' . $group_access . '" WHERE 1');
    Db::getInstance()->execute('RENAME TABLE  `' . _DB_PREFIX_ . 'iqitmegamenu` TO  `' . _DB_PREFIX_ . 'iqitmegamenu_tabs_shop`');

    return true;
}
