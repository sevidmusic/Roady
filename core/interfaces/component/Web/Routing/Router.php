<?php

namespace DarlingCms\interfaces\component\Web\Routing;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\SwitchableComponent;

interface Router extends SwitchableComponent
{

    public function getCrud(): ComponentCrud;

    public function getRequest(): Request;

    // @todo Router should return a Response that emulates a 404 error if the current request does not exist in storage.
    //       This will prevent responses that are assigned requests that dont exist from being returned
    // @todo Also, add test to RouterTestTrait: testGetResponsesReturnsArrayWithOne404ResponseIfCurrentRequestDoesNotExistInStorage
    public function getResponses(string $location, string $container): array;

}
