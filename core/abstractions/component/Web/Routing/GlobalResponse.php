<?php

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\Web\Routing\Response as CoreResponse;
use DarlingDataManagementSystem\classes\component\Web\App as CoreApp;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App as AppInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class GlobalResponse extends CoreResponse implements GlobalResponseInterface
{

    public function __construct(AppInterface $app, SwitchableInterface $switchable, PositionableInterface $positionable = null)
    {
        if (empty($positionable) === true) {
            parent::__construct($app, $switchable);
        }
        parent::__construct($app, $switchable, $positionable);
    }

    public function respondsToRequest(RequestInterface $request, ComponentCrudInterface $componentCrud): bool
    {
        if(parent::respondsToRequest($request, $componentCrud) === true) {
            return true;
        }
        if (CoreApp::deriveAppLocationFromRequest($request) === $this->getLocation()) {
            return true;
        }
        return false;
    }

}
