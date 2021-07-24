<?php

namespace roady\abstractions\component\Factory;

use roady\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use roady\classes\component\Web\Routing\Request as CoreRequest;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use roady\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use roady\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

abstract class RequestFactory extends StoredComponentFactoryBase implements RequestFactoryInterface
{

    public function __construct(PrimaryFactoryInterface $primaryFactory, ComponentCrudInterface $componentCrud, StoredComponentRegistryInterface $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildRequest(string $name, string $container, string $url): RequestInterface
    {
        $request = new CoreRequest(
            $this->getPrimaryFactory()->buildStorable($name, $container),
            $this->getPrimaryFactory()->buildSwitchable()
        );
        $request->import(['url' => $url]);
        $this->storeAndRegister($request);
        return $request;
    }
}
