<?php

namespace DarlingCms\abstractions\component\UserInterface;

use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\Web\Routing\Router;
use DarlingCms\interfaces\component\UserInterface\StandardUI as StandardUIInterface;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class StandardUI extends CoreOutputComponent implements StandardUIInterface
{

    private $router;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable, Router $router)
    {
        parent::__construct($storable, $switchable, $positionable);
        // @todo define testRouterIsSetOnInstantiation()
        $this->router = $router;
    }

    public function getTemplatesForCurrentRequest(string $location, string $container): array
    {
        // here
        // @todo get templates from storage...
        // Router->getResponses() needs location and container...
        // it is reasonable to assume locations is same as StandardUI,
        // or  rather it is safest to require StandardUIs to only use
        // a location they belong to, in the big picture each "Site"
        // will have its own loacation, so a StandardUI for one "Site"
        // should onlr read from that "Site's" location...
        var_dump($this->getLocation());
        return $this->router->getResponses($location, $container);
    }

}
