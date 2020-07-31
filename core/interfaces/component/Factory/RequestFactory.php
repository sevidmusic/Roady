<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

interface RequestFactory extends StoredComponentFactoryInterface
{

    public function buildRequest(string $name, string $container, string $url): Request;

}
