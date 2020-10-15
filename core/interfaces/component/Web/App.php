<?php

namespace DarlingDataManagementSystem\interfaces\component\Web;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

interface App extends CoreSwitchableComponent
{

    public static function deriveNameLocationFromRequest(RequestInterface $request): string;

    public static function getRequestedApp(RequestInterface $request, ComponentCrudInterface $componentCrud): App;

    public function getAppDomain(): RequestInterface;

}
