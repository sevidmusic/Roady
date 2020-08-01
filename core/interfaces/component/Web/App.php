<?php

namespace DarlingDataManagementSystem\interfaces\component\Web;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

interface App extends CoreSwitchableComponent
{

    public static function deriveNameLocationFromRequest(Request $request): string;

    public static function getRequestedApp(Request $request, ComponentCrud $componentCrud): App;

    public function getAppDomain(): Request;

}
