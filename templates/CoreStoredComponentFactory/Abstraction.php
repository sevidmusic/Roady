<?php

namespace DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DS_CORE_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME as DS_COMPONENT_NAMEInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;

abstract class DS_COMPONENT_NAME extends CoreStoredComponentFactory implements DS_COMPONENT_NAMEInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

}
