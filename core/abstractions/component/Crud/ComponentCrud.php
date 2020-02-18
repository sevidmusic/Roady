<?php

namespace DarlingCms\abstractions\component\Crud;

use DarlingCms\abstractions\component\SwitchableComponent;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingCms\interfaces\component\Driver\Storage\Standard as StorageDriver;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

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
            return new \DarlingCms\classes\component\Component(
                new \DarlingCms\classes\primary\Storable(
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
