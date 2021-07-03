<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

interface Router extends SwitchableComponentInterface
{

    public function getCrud(): ComponentCrudInterface;

    public function getRequest(): Request;

    public function getResponseContainer(): string;

    /**
     * @return array<int, ResponseInterface>
     */
    public function getResponses(string $location, string $container): array;

}
