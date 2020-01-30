<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingCms\abstractions\component\SwitchableComponent;

abstract class Response extends SwitchableComponent implements ResponseInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
