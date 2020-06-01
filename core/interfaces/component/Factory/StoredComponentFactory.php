<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\SwitchableComponent as CoreSwitchableComponent;

interface StoredComponentFactory extends CoreSwitchableComponent
{
    public function getComponentCrud(): ComponentCrud;

    public function getPrimaryFactory(): PrimaryFactory;

    public function getStoredComponentRegistry(): StoredComponentRegistry;

    public function storeAndRegister(Component $component): bool;
}
