<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;

abstract class AppComponentsFactory extends CoreStoredComponentFactory implements AppComponentsFactoryInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

}