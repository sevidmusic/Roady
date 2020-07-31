<?php

namespace DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\abstractions\component\OutputComponent as CoreOutputComponent;
use DS_CORE_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME as DS_COMPONENT_NAMEInterface;

abstract class DS_COMPONENT_NAME extends CoreOutputComponent implements DS_COMPONENT_NAMEInterface
{

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

}
