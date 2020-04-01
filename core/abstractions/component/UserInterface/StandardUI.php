<?php

namespace DarlingCms\abstractions\component\UserInterface;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class StandardUI extends CoreOutputComponent implements StandardUIInterface
{

    private $router;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Router $router)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

    public function getTemplatesForCurrentRequest(): array
    {
        return array();
    }

}
