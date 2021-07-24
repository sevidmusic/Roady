<?php

namespace roady\interfaces\component\UserInterface;

use roady\interfaces\component\OutputComponent as CoreOutputComponent;
use roady\interfaces\component\Web\Routing\Router as RouterInterface;

interface ResponseUI extends CoreOutputComponent
{

    public function getRouter(): RouterInterface;
}
