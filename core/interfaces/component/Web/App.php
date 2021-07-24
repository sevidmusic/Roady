<?php

namespace roady\interfaces\component\Web;

use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

interface App extends CoreSwitchableComponent
{

    public const APP_CONTAINER = "APP";

    public static function deriveAppLocationFromRequest(RequestInterface $request): string;

    public function getAppDomain(): RequestInterface;

}
