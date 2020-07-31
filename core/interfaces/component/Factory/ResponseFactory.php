<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\GlobalResponse;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response;

interface ResponseFactory extends StoredComponentFactoryInterface
{

    public function buildResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): Response;

    public function buildGlobalResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): GlobalResponse;

}
