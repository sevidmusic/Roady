<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;

interface ResponseFactory extends StoredComponentFactoryInterface
{

    public function buildResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): ResponseInterface;

    public function buildGlobalResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): GlobalResponseInterface;

}
