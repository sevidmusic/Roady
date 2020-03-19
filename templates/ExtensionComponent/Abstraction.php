<?php

namespace Extensions\DS_EXTENSION_NAME\core\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\abstractions\component\DS_PARENT_COMPONENT_SUBTYPE\DS_PARENT_COMPONENT_NAME as BaseComponent;
use DarlingCms\interfaces\primary\Storable;
use Extensions\DS_EXTENSION_NAME\core\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME as DS_COMPONENT_NAMEInterface;

abstract class DS_COMPONENT_NAME extends BaseComponent implements DS_COMPONENT_NAMEInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
