<?php

namespace DarlingCms\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME as DS_COMPONENT_NAMEInterface;
use DarlingCms\abstractions\component\DS_PARENT_COMPONENT_SUBTYPE\DS_PARENT_COMPONENT_NAME;

abstract class DS_COMPONENT_NAME extends DS_PARENT_COMPONENT_NAME implements DS_COMPONENT_NAMEInterface
{

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

}
