<?php

namespace DarlingCms\interfaces\component\Factory\App;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\SwitchableComponent as CoreSwitchableComponent;

interface StoredComponentFactory extends CoreSwitchableComponent
{
    public function getComponentCrud(): ComponentCrud;
}
