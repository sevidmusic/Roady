<?php

namespace roady\abstractions\component\Registry\Storage;

use roady\abstractions\component\Component as AbstractComponent;
use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\primary\Storable as StorableInterface;

abstract class StoredComponentRegistry extends AbstractComponent implements StoredComponentRegistryInterface
{

    private string $acceptedImplementation = ComponentInterface::class;
    private ComponentCrudInterface $componentCrud;
    /**
     * @var array<int, StorableInterface> $registry
     */
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
            $this->classImplements($component)
        );
    }

    public function unRegisterComponent(StorableInterface $storable): bool
    {
        $actualStorable = $this->getActualStorable($storable);
        if (!in_array($actualStorable, $this->registry) === true) {
            return false;
        }
        unset($this->registry[array_search($actualStorable, $this->registry)]);
        return !in_array($actualStorable, $this->registry);
    }

    private function storableIsAComponent(StorableInterface $storable): bool
    {
        return in_array(ComponentInterface::class, $this->classImplements($storable));
    }

    /**
     * @param string|object $class
     * @return array<string, string>
     */
    private function classImplements(string|object $class): array
    {
        $classImplements = class_implements($class);
        return (is_array($classImplements) ? $classImplements : []);
    }

    private function getActualStorable(StorableInterface|ComponentInterface $storable): StorableInterface
    {
        if($this->storableIsAComponent($storable) === true) {
            /**
             * @var ComponentInterface $storable
             */
            return $storable->export()['storable'];
        }
        return $storable;
    }

    /**
     * @return array<int, ComponentInterface>
     */
    public function getRegisteredComponents(): array
    {
        $components = [];
        foreach ($this->registry as $storable) {
            array_push($components, $this->componentCrud->read($storable));
        }
        return $components;
    }

    /**
     * @return array<int, StorableInterface> $registry
     */
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
