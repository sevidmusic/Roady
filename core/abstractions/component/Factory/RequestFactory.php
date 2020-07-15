<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Request as CoreRequest;

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
