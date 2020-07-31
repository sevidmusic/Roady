<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingDataManagementSystem\classes\component\Web\Routing\Request as CoreRequest;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\PrimaryFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;

abstract class RequestFactory extends CoreStoredComponentFactory implements RequestFactoryInterface
{

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud, StoredComponentRegistry $storedComponentRegistry)
    {
        parent::__construct($primaryFactory, $componentCrud, $storedComponentRegistry);
    }

    public function buildRequest(string $name, string $container, string $url): Request
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
