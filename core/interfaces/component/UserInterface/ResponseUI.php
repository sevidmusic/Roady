<?php

namespace DarlingDataManagementSystem\interfaces\component\UserInterface;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;

interface ResponseUI extends CoreOutputComponent
{

    public function getRouter(): RouterInterface;
}
