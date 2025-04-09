<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
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

    public function getConnection()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getConnection', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getMetadataFactory', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getExpressionBuilder', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'beginTransaction', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getCache', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getCache();
    }

    public function transactional($func)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'transactional', array('func' => $func), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'wrapInTransaction', array('func' => $func), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'commit', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->commit();
    }

    public function rollback()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'rollback', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getClassMetadata', array('className' => $className), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'createQuery', array('dql' => $dql), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'createNamedQuery', array('name' => $name), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'createQueryBuilder', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'flush', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'clear', array('entityName' => $entityName), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->clear($entityName);
    }

    public function close()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'close', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->close();
    }

    public function persist($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'persist', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'remove', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'refresh', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'detach', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'merge', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getRepository', array('entityName' => $entityName), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'contains', array('entity' => $entity), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getEventManager', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getConfiguration', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'isOpen', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getUnitOfWork', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getProxyFactory', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'initializeObject', array('obj' => $obj), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'getFilters', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'isFiltersStateClean', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, 'hasFilters', array(), $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        return $this->valueHolderf37bc->hasFilters();
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

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer323fc = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderf37bc) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderf37bc = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderf37bc->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer323fc && ($this->initializer323fc->__invoke($valueHolderf37bc, $this, '__get', ['name' => $name], $this->initializer323fc) || 1) && $this->valueHolderf37bc = $valueHolderf37bc;

        if (isset(self::$publicPropertiesccb56[$name])) {
            return $this->valueHolderf37bc->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
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
