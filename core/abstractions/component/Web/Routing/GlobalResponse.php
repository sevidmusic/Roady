<?php

namespace roady\abstractions\component\Web\Routing;

use roady\abstractions\component\Web\Routing\Response as CoreResponse;
use roady\classes\component\Web\App as CoreApp;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

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
