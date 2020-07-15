<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Web\Routing\Request;

interface RequestFactory extends StoredComponentFactoryInterface
{

    public function buildRequest(string $name, string $container, string $url): Request;

}
