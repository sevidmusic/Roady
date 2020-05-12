<?php

namespace DarlingCms\abstractions\component\Web;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Web\App as AppInterface;

abstract class App extends CoreSwitchableComponent implements AppInterface
{
    public const APP_CONTAINER = "APP";

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }


}
