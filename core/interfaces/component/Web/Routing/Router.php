<?php

namespace DarlingCms\interfaces\component\Web\Routing;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\SwitchableComponent;

interface Router extends SwitchableComponent
{

    public function getCrud(): ComponentCrud;

    public function getRequest(): Request;

    public function getResponses(string $location, string $container): array;

}
