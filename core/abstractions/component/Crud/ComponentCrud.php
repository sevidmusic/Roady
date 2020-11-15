<?php

namespace DarlingDataManagementSystem\abstractions\component\Crud;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\classes\component\Component as CoreComponent;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use \RuntimeException;

abstract class ComponentCrud extends SwitchableComponentBase implements ComponentCrudInterface
{

    private const MOCK_COMPONENT = '__MOCK_COMPONENT__';
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
        return ($this->getState() === false
            ? false
            : $this->getStorageDriver()->delete($storable)
        );
    }

    public function create(ComponentInterface $component): bool
    {
        return ($this->getState() === false
            ? false
            : $this->getStorageDriver()->write($component)
        );
    }

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
        throw new RuntimeException("A component named $name of type $type does not exist in the $container container in the $location location: Using defualt Component of type " . $this->getDefaultComponent()->getType());
        return $this->getDefaultComponent();
    }

}
