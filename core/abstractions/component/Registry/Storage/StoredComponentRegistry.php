<?php

namespace DarlingDataManagementSystem\abstractions\component\Registry\Storage;

use DarlingDataManagementSystem\abstractions\component\Component as AbstractComponent;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

abstract class StoredComponentRegistry extends AbstractComponent implements StoredComponentRegistryInterface
{

    private string $acceptedImplementation = ComponentInterface::class;
    private ComponentCrudInterface $componentCrud;
    private array $registry = [];

    public function __construct(StorableInterface $storable, ComponentCrudInterface $componentCrud)
    {
        parent::__construct($storable);
        $this->componentCrud = $componentCrud;
    }

    public function getAcceptedImplementation(): string
    {
        return $this->acceptedImplementation;
    }

    public function getComponentCrud(): ComponentCrudInterface
    {
        return $this->componentCrud;
    }

    public function registerComponent(ComponentInterface $component): bool
    {
        if ($this->isRegistered($component) === true) {
            return false;
        }
        if ($this->isStored($component) === false) {
            return false;
        }
        if ($this->isAcceptedImplementation($component) === false) {
            return false;
        }
        array_push($this->registry, $component->export()['storable']);
        return true;
    }

    private function isRegistered(ComponentInterface $component): bool
    {
        return in_array($component->export()['storable'], $this->registry, true);
    }

    private function isStored(ComponentInterface $component): bool
    {
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        return ($this->componentCrud->read($component) == $component);
    }

    private function isAcceptedImplementation(ComponentInterface $component): bool
    {
        return in_array(
            $this->acceptedImplementation,
            class_implements($component)
        );
    }

    public function unRegisterComponent(StorableInterface $storable): bool
    {
        /** @noinspection PhpParamsInspection */
        $actualStorable = (
        $this->storableIsAComponent($storable) === true
            ? $this->getStorableFromComponent($storable)
            : $storable
        );
        if (!in_array($actualStorable, $this->registry) === true) {
            return false;
        }
        unset($this->registry[array_search($actualStorable, $this->registry)]);
        return !in_array($actualStorable, $this->registry);
    }

    private function storableIsAComponent(StorableInterface $storable): bool
    {
        return in_array(ComponentInterface::class, class_implements($storable));
    }

    private function getStorableFromComponent(ComponentInterface $component): StorableInterface
    {
        return $component->export()['storable'];
    }

    public function getRegisteredComponents(): array
    {
        $components = [];
        foreach ($this->registry as $storable) {
            array_push($components, $this->componentCrud->read($storable));
        }
        return $components;
    }

    public function getRegistry(): array
    {
        return $this->registry;
    }

    public function emptyRegistry(): void
    {
        $this->registry = [];
    }

    public function purgeRegistry(): void
    {
        foreach ($this->registry as $storable) {
            if ($storable->getUniqueId() !== $this->componentCrud->read($storable)->getUniqueId()) {
                unset($this->registry[array_search($storable, $this->registry)]);
            }
        }
    }

}
