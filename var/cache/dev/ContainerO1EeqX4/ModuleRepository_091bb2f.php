<?php

class ModuleRepository_091bb2f extends \PrestaShop\PrestaShop\Core\Module\ModuleRepository implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \PrestaShop\PrestaShop\Core\Module\ModuleRepository|null wrapped object, if the proxy is initialized
     */
    private $valueHolderad663 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer211df = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesa4d60 = [
        
    ];

    public function getList() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getList', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getList();
    }

    public function getInstalledModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getInstalledModules', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getInstalledModules();
    }

    public function getMustBeConfiguredModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getMustBeConfiguredModules', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getMustBeConfiguredModules();
    }

    public function getUpgradableModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getUpgradableModules', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getUpgradableModules();
    }

    public function getModule(string $moduleName) : \PrestaShop\PrestaShop\Core\Module\ModuleInterface
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getModule', array('moduleName' => $moduleName), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getModule($moduleName);
    }

    public function getModulePath(string $moduleName) : ?string
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getModulePath', array('moduleName' => $moduleName), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getModulePath($moduleName);
    }

    public function setActionUrls(\PrestaShop\PrestaShop\Core\Module\ModuleCollection $collection) : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'setActionUrls', array('collection' => $collection), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->setActionUrls($collection);
    }

    public function clearCache(?string $moduleName = null, bool $allShops = false) : bool
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'clearCache', array('moduleName' => $moduleName, 'allShops' => $allShops), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->clearCache($moduleName, $allShops);
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

        $instance->initializer211df = $initializer;

        return $instance;
    }

    public function __construct(\PrestaShop\PrestaShop\Adapter\Module\ModuleDataProvider $moduleDataProvider, \PrestaShop\PrestaShop\Adapter\Module\AdminModuleDataProvider $adminModuleDataProvider, \Doctrine\Common\Cache\CacheProvider $cacheProvider, \PrestaShop\PrestaShop\Adapter\HookManager $hookManager, string $modulePath, int $contextLangId)
    {
        static $reflection;

        if (! $this->valueHolderad663) {
            $reflection = $reflection ?? new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');
            $this->valueHolderad663 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);

        }

        $this->valueHolderad663->__construct($moduleDataProvider, $adminModuleDataProvider, $cacheProvider, $hookManager, $modulePath, $contextLangId);
    }

    public function & __get($name)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__get', ['name' => $name], $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        if (isset(self::$publicPropertiesa4d60[$name])) {
            return $this->valueHolderad663->$name;
        }

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderad663;

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

        $targetObject = $this->valueHolderad663;
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
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderad663;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderad663;
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
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__isset', array('name' => $name), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderad663;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderad663;
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
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__unset', array('name' => $name), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderad663;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderad663;
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
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__clone', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        $this->valueHolderad663 = clone $this->valueHolderad663;
    }

    public function __sleep()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__sleep', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return array('valueHolderad663');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer211df = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer211df;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'initializeProxy', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderad663;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderad663;
    }
}
