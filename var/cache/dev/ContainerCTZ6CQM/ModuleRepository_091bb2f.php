<?php

class ModuleRepository_091bb2f extends \PrestaShop\PrestaShop\Core\Module\ModuleRepository implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \PrestaShop\PrestaShop\Core\Module\ModuleRepository|null wrapped object, if the proxy is initialized
     */
    private $valueHolderf37bc = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer323fc = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesccb56 = [
        
    ];

    public function getList() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getList', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getList();
    }

    public function getInstalledModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getInstalledModules', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getInstalledModules();
    }

    public function getMustBeConfiguredModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getMustBeConfiguredModules', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getMustBeConfiguredModules();
    }

    public function getUpgradableModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getUpgradableModules', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getUpgradableModules();
    }

    public function getModule(string $moduleName) : \PrestaShop\PrestaShop\Core\Module\ModuleInterface
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getModule', array('moduleName' => $moduleName), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getModule($moduleName);
    }

    public function getModulePath(string $moduleName) : ?string
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getModulePath', array('moduleName' => $moduleName), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getModulePath($moduleName);
    }

    public function setActionUrls(\PrestaShop\PrestaShop\Core\Module\ModuleCollection $collection) : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'setActionUrls', array('collection' => $collection), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->setActionUrls($collection);
    }

    public function clearCache(?string $moduleName = null, bool $allShops = false) : bool
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'clearCache', array('moduleName' => $moduleName, 'allShops' => $allShops), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->clearCache($moduleName, $allShops);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $instance, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($instance);

        $instance->initializer323fc = $initializer;

        return $instance;
    }

    public function __construct(\PrestaShop\PrestaShop\Adapter\Module\ModuleDataProvider $moduleDataProvider, \PrestaShop\PrestaShop\Adapter\Module\AdminModuleDataProvider $adminModuleDataProvider, \Doctrine\Common\Cache\CacheProvider $cacheProvider, \PrestaShop\PrestaShop\Adapter\HookManager $hookManager, string $modulePath, int $contextLangId)
    {
        static $reflection;

        if (! $this->valueHolderf37bc) {
            $reflection = $reflection ?? new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');
            $this->valueHolderf37bc = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);

        }

        $this->valueHolderf37bc->__construct($moduleDataProvider, $adminModuleDataProvider, $cacheProvider, $hookManager, $modulePath, $contextLangId);
    }

    public function & __get($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__get', ['name' => $name], $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        if (isset(self::$publicPropertiesccb56[$name])) {
            return $this->valueHolderf37bc->$name;
        }

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf37bc;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf37bc;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf37bc;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf37bc;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__isset', array('name' => $name), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf37bc;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderf37bc;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__unset', array('name' => $name), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf37bc;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderf37bc;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__clone', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        $this->valueHolderf37bc = clone $this->valueHolderf37bc;
    }

    public function __sleep()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__sleep', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return array('valueHolderf37bc');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer323fc = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer323fc;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'initializeProxy', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderf37bc;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderf37bc;
    }
}
