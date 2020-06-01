<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Component;

interface StoredComponentFactory extends CoreSwitchableComponent
{
    public function getComponentCrud(): ComponentCrud;

    public function getPrimaryFactory(): PrimaryFactory;

    public function getStoredComponentRegistry(): StoredComponentRegistry;

    public function storeAndRegister(Component $component): bool;
}
