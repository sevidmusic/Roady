<?php

namespace DS_CORE_NAMESPACE_PREFIX\abstractions\component\DS_COMPONENT_SUBTYPE;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use DS_CORE_NAMESPACE_PREFIX\interfaces\component\DS_COMPONENT_SUBTYPE\DS_COMPONENT_NAME as DS_COMPONENT_NAMEInterface;

abstract class DS_COMPONENT_NAME extends Component implements DS_COMPONENT_NAMEInterface
{

    public function __construct(Storable $storable)
    {
        parent::__construct($storable);
    }

}
