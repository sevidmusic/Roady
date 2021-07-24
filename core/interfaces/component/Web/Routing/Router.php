<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;

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
