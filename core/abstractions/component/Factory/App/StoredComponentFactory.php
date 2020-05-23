<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory as StoredComponentFactoryInterface;

abstract class StoredComponentFactory extends CoreSwitchableComponent implements StoredComponentFactoryInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }


}