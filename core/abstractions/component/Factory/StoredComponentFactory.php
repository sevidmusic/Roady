<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Component;
abstract class StoredComponentFactory extends CoreSwitchableComponent implements StoredComponentFactoryInterface
{

    private $primaryFactory;
    private $storedComponentRegistry;

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        $this->storedComponentRegistry = $storedComponentRegistry;
        $this->primaryFactory = $primaryFactory;
        $storable = $this->primaryFactory->buildStorable('StoredComponentFactory', $this->primaryFactory::CONTAINER);
        parent::__construct($storable, $componentCrud);
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->export()['switchable'];
    }

    public function getPrimaryFactory(): PrimaryFactory
    {
        return $this->primaryFactory;
    }


    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }

    public function storeAndRegister(Component $component): bool
    {
        return ($this->getComponentCrud()->create($component) === true ? $this->getStoredComponentRegistry()->registerComponent($component) : false);
    }
}
