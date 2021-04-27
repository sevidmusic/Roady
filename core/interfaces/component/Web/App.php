<?php

namespace DarlingDataManagementSystem\interfaces\component\Web;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

interface App extends CoreSwitchableComponent
{

    public const APP_CONTAINER = "APP";

    public static function deriveNameLocationFromRequest(RequestInterface $request): string;

    public function getAppDomain(): RequestInterface;

}
