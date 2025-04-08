<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
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

    public function getConnection()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getConnection', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getMetadataFactory', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getExpressionBuilder', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'beginTransaction', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getCache', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getCache();
    }

    public function transactional($func)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'transactional', array('func' => $func), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'wrapInTransaction', array('func' => $func), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'commit', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->commit();
    }

    public function rollback()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'rollback', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getClassMetadata', array('className' => $className), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'createQuery', array('dql' => $dql), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'createNamedQuery', array('name' => $name), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'createQueryBuilder', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'flush', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'clear', array('entityName' => $entityName), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->clear($entityName);
    }

    public function close()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'close', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->close();
    }

    public function persist($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'persist', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'remove', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'refresh', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'detach', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'merge', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getRepository', array('entityName' => $entityName), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'contains', array('entity' => $entity), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getEventManager', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getConfiguration', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'isOpen', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getUnitOfWork', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getProxyFactory', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'initializeObject', array('obj' => $obj), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'getFilters', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'isFiltersStateClean', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, 'hasFilters', array(), $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        return $this->valueHolderad663->hasFilters();
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

        $instance->initializer211df = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderad663) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderad663 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderad663->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer211df && ($this->initializer211df->__invoke($valueHolderad663, $this, '__get', ['name' => $name], $this->initializer211df) || 1) && $this->valueHolderad663 = $valueHolderad663;

        if (isset(self::$publicPropertiesa4d60[$name])) {
            return $this->valueHolderad663->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

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
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
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
