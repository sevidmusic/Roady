<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as StoredComponentFactoryBase;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry as StoredComponentRegistryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;

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
