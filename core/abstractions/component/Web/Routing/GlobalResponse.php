<?php

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Web\App;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class GlobalResponse extends CoreResponse implements GlobalResponseInterface
{

    public function __construct(App $app, Switchable $switchable, Positionable $positionable = null)
    {
        if (empty($positionable) === true) {
            parent::__construct($app, $switchable);
        }
        parent::__construct($app, $switchable, $positionable);
    }

    public function respondsToRequest(Request $request, ComponentCrud $componentCrud): bool
    {
        if (CoreApp::deriveNameLocationFromRequest($request) === $this->getLocation()) {
            return true;
        }
        return false;
    }

}
