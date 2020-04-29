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

    private function isRegistered(Component $component): bool
    {
        return in_array($component->export()['storable'], $this->registry, true);
    }


    public function registerComponent(Component $component): bool {
        if($this->isRegistered($component) === true)
        {
            return false;
        }
        array_push($this->registry, $component->export()['storable']);
        return true;
    }
}
