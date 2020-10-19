<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\Factory as FactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

interface StoredComponentFactory extends SwitchableComponentInterface, FactoryInterface
{
    public function getComponentCrud(): ComponentCrudInterface;

    public function getPrimaryFactory(): PrimaryFactoryInterface;

    public function getStoredComponentRegistry(): StoredComponentRegistryInterface;

    public function storeAndRegister(ComponentInterface $component): bool;
}
