<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

interface RequestFactory extends StoredComponentFactoryInterface
{

    public function buildRequest(string $name, string $container, string $url): RequestInterface;

}
