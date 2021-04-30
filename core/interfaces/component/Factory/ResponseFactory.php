<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse as GlobalResponseInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;

interface ResponseFactory extends StoredComponentFactoryInterface
{

    public function buildResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): ResponseInterface;

    public function buildGlobalResponse(string $name, float $position, ComponentInterface ...$componentsToAssign): GlobalResponseInterface;

}
