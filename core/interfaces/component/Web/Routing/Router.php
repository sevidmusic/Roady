<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

interface Router extends SwitchableComponentInterface
{

    public function getCrud(): ComponentCrudInterface;

    public function getRequest(): Request;

    // @todo Router should return a Response that emulates a 404 error if the current request does not exist in storage.
    //       This will prevent responses that are assigned requests that dont exist from being returned
    // @todo Also, add test to RouterTestTrait: testGetResponsesReturnsArrayWithOne404ResponseIfCurrentRequestDoesNotExistInStorage
    /**
     * @return array<int, ResponseInterface>
     */
    public function getResponses(string $location, string $container): array;

    public function getResponseContainer(): string;
}
