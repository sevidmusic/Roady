<?php

namespace DarlingCms\interfaces\component\Factory\App;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
interface StoredComponentFactory extends CoreSwitchableComponent
{
    public function getComponentCrud(): ComponentCrud;

    public function getPrimaryFactory(): PrimaryFactory;

    public function getStoredComponentRegistry(): StoredComponentRegistry;
}
