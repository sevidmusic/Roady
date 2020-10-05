<?php

namespace DarlingDataManagementSystem\abstractions\component\Crud;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\StandardStorageDriver as StorageDriver;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class ComponentCrud extends SwitchableComponent implements ComponentCrudInterface
{

    private $storageDriver;

    public function __construct(Storable $storable, Switchable $switchable, StorageDriver $storageDriver)
    {
        parent::__construct($storable, $switchable);
        $this->storageDriver = $storageDriver;
        if ($this->storageDriver->getState() === false) {
            $this->storageDriver->switchState();
        }
    }

    public function read(Storable $storable): Component
    {
        if ($this->getState() === false) {
            return new \DarlingDataManagementSystem\classes\component\Component(
                new \DarlingDataManagementSystem\classes\primary\Storable(
                    '__MOCK_COMPONENT__',
                    '__MOCK_COMPONENT__',
                    '__MOCK_COMPONENT__'
                )
            );
        }
        return $this->getStorageDriver()->read($storable);
    }

    private function getStorageDriver(): StorageDriver
    {
        return $this->storageDriver;
    }

    public function update(Storable $storable, Component $component): bool
    {
        if ($this->getState() !== false && $this->delete($storable) === true) {
            return $this->create($component);
        }
        return false;
    }

    public function delete(Storable $storable): bool
    {
        return ($this->getState() === false
            ? false
            : $this->getStorageDriver()->delete($storable)
        );
    }

    public function create(Component $component): bool
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
}
