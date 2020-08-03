<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as CoreSwitchableComponent;

interface StoredComponentFactory extends CoreSwitchableComponent, Factory
{
    public function getComponentCrud(): ComponentCrud;

    public function getPrimaryFactory(): PrimaryFactory;

    public function getStoredComponentRegistry(): StoredComponentRegistry;

    public function storeAndRegister(Component $component): bool;
}
