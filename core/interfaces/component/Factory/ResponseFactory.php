<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Web\Routing\Response;
use DarlingCms\interfaces\component\Web\Routing\GlobalResponse;

interface ResponseFactory extends StoredComponentFactoryInterface
{

    public function buildResponse(string $name, float $position, Component ...$requestsOutputComponentsStandardUITemplates): Response;

    public function buildGlobalResponse(float $position, Component ...$requestsOutputComponentsStandardUITemplates): GlobalResponse;

}
