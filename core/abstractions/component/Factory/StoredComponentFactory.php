<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;

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

    public function getPrimaryFactory(): PrimaryFactory
    {
        return $this->primaryFactory;
    }

    public function storeAndRegister(Component $component): bool
    {
        return ($this->getComponentCrud()->create($component) === true ? $this->getStoredComponentRegistry()->registerComponent($component) : false);
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->export()['switchable'];
    }

    public function getStoredComponentRegistry(): StoredComponentRegistry
    {
        return $this->storedComponentRegistry;
    }
}
