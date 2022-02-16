<?php

namespace roady\abstractions\component\Crud;

use roady\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use roady\classes\component\Component as CoreComponent;
use roady\classes\primary\Storable as CoreStorable;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;
use RuntimeException;

abstract class ComponentCrud extends SwitchableComponentBase implements ComponentCrudInterface
{

    private const MOCK_COMPONENT = 'MOCKCOMPONENT';
    private StandardStorageDriverInterface $storageDriver;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, StandardStorageDriverInterface $storageDriver)
    {
        parent::__construct($storable, $switchable);
        $this->storageDriver = $storageDriver;
        if ($this->storageDriver->getState() === false) {
            $this->storageDriver->switchState();
        }
    }

    private function getDefaultComponent(): ComponentInterface
    {
        return new CoreComponent(
            new CoreStorable(
                self::MOCK_COMPONENT,
                self::MOCK_COMPONENT,
                self::MOCK_COMPONENT
            )
        );
    }

    public function read(StorableInterface $storable): ComponentInterface
    {
        if ($this->getState() === false) {
            return $this->getDefaultComponent();
        }
        return $this->getStorageDriver()->read($storable);
    }

    private function getStorageDriver(): StandardStorageDriverInterface
    {
        return $this->storageDriver;
    }

    public function update(StorableInterface $storable, ComponentInterface $component): bool
    {
        if ($this->getState() !== false && $this->delete($storable) === true) {
            return $this->create($component);
        }
        return false;
    }

    public function delete(StorableInterface $storable): bool
    {
        return (!($this->getState() === false) && $this->getStorageDriver()->delete($storable)
        );
    }

    public function create(ComponentInterface $component): bool
    {
        return (!($this->getState() === false) && $this->getStorageDriver()->write($component)
        );
    }

    /**
     * @return array<ComponentInterface>
     */
    public function readAll(string $location, string $container): array
    {
        return ($this->getState() === false
            ? []
            : $this->getStorageDriver()->readAll($location, $container)
        );
    }

    public function readByNameAndType(string $name, string $type, string $location, string $container): ComponentInterface
    {
        $components = $this->readAll($location, $container);
        foreach($components as $component)
        {
            if($component->getName() === $name && $component->getType() === $type) {
                return $component;
            }
        }
        throw new RuntimeException("A component named $name of type $type does not exist in the $container container in the $location location");
    }

}
