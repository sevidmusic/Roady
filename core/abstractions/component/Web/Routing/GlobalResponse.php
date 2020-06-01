<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\abstractions\component\Web\Routing\Response as CoreResponse;
use DarlingCms\classes\component\Web\App as CoreApp;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Switchable;

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
