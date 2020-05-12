<?php

namespace DarlingCms\interfaces\component\Web;

use DarlingCms\interfaces\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Web\Routing\Request;

interface App extends CoreSwitchableComponent
{

    public static function deriveNameLocationFromRequest(Request $request): string;

}
