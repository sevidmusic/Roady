<?php

namespace DarlingCms\abstractions\component\Registry\Storage;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\component\Component;
use DarlingCms\abstractions\component\Component as AbstractComponent;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;

use DarlingCms\interfaces\component\Crud\ComponentCrud;

abstract class StoredComponentRegistry extends AbstractComponent implements StoredComponentRegistryInterface
{

    private $acceptedImplementation = 'DarlingCms\interfaces\component\Component';
    private $componentCrud;
    private $registry = [];

    public function __construct(Storable $storable, ComponentCrud $componentCrud)
    {
        parent::__construct($storable);
        $this->componentCrud = $componentCrud;
    }

    public function getAcceptedImplementation(): string
    {
        return $this->acceptedImplementation;
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->componentCrud;
    }

    public function registerComponent(Component $component): bool
    {
        if ($this->isRegistered($component) === true) {
            return false;
        }
        if($this->isStored($component) === false) {
            return false;
        }
        if($this->isAcceptedImplementation($component) === false)
        {
            return false;
        }
        array_push($this->registry, $component->export()['storable']);
        return true;
    }

    private function isRegistered(Component $component): bool
    {
        return in_array($component->export()['storable'], $this->registry, true);
    }

    private function isStored(Component $component): bool
    {
        return ($this->componentCrud->read($component) == $component);
    }

    private function isAcceptedImplementation(Component $component): bool
    {
        return in_array(
            $this->acceptedImplementation,
            class_implements($component)
        );
    }

    private function storableIsAComponent(Storable $storable): bool
    {
        return in_array('DarlingCms\interfaces\component\Component', class_implements($storable));
    }

    private function getStorableFromComponent(Component $component): Storable
    {
        return $component->export()['storable'];
    }

    public function unRegisterComponent(Storable $storable): bool
    {
        $actualStorable = (
            $this->storableIsAComponent($storable) === true
            ? $this->getStorableFromComponent($storable)
            : $storable
        );
        if(!in_array($actualStorable, $this->registry)=== true) {
            return false;
        }
        if(in_array($actualStorable, $this->registry) === true)
        {
            unset($this->registry[array_search($actualStorable, $this->registry)]);
        }
        return !in_array($actualStorable, $this->registry);
    }
}
