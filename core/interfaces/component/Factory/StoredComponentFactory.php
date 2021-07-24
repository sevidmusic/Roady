<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

interface StoredComponentFactory extends SwitchableComponentInterface, FactoryInterface
{
    public function getComponentCrud(): ComponentCrudInterface;

    public function getPrimaryFactory(): PrimaryFactoryInterface;

    public function getStoredComponentRegistry(): StoredComponentRegistryInterface;

    public function storeAndRegister(ComponentInterface $component): bool;
}
