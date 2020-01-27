<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingCms\abstractions\component\SwitchableComponent;

abstract class Request extends SwitchableComponent implements RequestInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
