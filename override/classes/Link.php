<?php
/**
 * PrestaChamps
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact leo@prestachamps.com
 *
 * @author    PrestaChamps <leo@prestachamps.com>
 * @copyright PrestaChamps
 * @license   commercial
 */
if (!defined('_PS_VERSION_')) {
    exit;
}
/**
 * Class Link
 */
class Link extends LinkCore
{
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    protected $webpSupported = false;
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function __construct($protocolLink = null, $protocolContent = null)
    {
        parent::__construct($protocolLink, $protocolContent);
        $this->webpSupported = $this->isWebPSupported();
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function getImageLink($name, $ids, $type = null, string $extension = 'jpg')
    {
        $parent = parent::getImageLink($name, $ids, $type);
        if ($this->webpSupported) {
            return str_replace('.jpg', '.webp', $parent);
        }
        return $parent;
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function getCatImageLink($name, $idCategory, $type = null, string $extension = 'jpg')
    {
        $parent = parent::getCatImageLink($name, $idCategory, $type);
        if ($this->webpSupported) {
            return str_replace('.jpg', '.webp', $parent);
        }
        return $parent;
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function getSupplierImageLink($idSupplier, $type = null, string $extension = 'jpg')
    {
        $parent = parent::getSupplierImageLink($idSupplier, $type);
        if ($this->webpSupported) {
            return str_replace('.jpg', '.webp', $parent);
        }
        return $parent;
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function getStoreImageLink($name, $idStore, $type = null, string $extension = 'jpg')
    {
        $parent = parent::getStoreImageLink($name, $idStore, $type);
        if ($this->webpSupported) {
            return str_replace('.jpg', '.webp', $parent);
        }
        return $parent;
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function getManufacturerImageLink($idManufacturer, $type = null, string $extension = 'jpg')
    {
        $parent = parent::getManufacturerImageLink($idManufacturer, $type);
        if ($this->webpSupported) {
            return str_replace('.jpg', '.webp', $parent);
        }
        return $parent;
    }
    /*
    * module: webpgenerator
    * date: 2025-05-08 17:02:10
    * version: 1.0.23
    */
    public function isWebPSupported()
    {
        if (Configuration::get('module-webpconverter-demo-mode')) {
            return false;
        }
        return Module::isEnabled('webpgenerator') &&
            (isset($_SERVER['HTTP_ACCEPT']) === true) &&
            (false !== strpos($_SERVER['HTTP_ACCEPT'], 'image/webp'));
    }
}
