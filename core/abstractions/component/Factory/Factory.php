<?php

namespace roady\abstractions\component\Factory;

use roady\abstractions\component\Component as ComponentBase;
use roady\classes\primary\Storable as CoreStorable;
use roady\interfaces\component\Factory\Factory as FactoryInterface;
use roady\interfaces\component\Web\App as AppInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

abstract class Factory extends ComponentBase implements FactoryInterface
{

    private AppInterface $app;

    public function __construct(AppInterface $app)
    {
        $this->app = $app;
        $storable = new CoreStorable(
            'Factory',
            $app->getLocation(),
            self::CONTAINER
        );
        parent::__construct($storable);
    }

    public function getAppDomain(): RequestInterface
    {
        return $this->getApp()->getAppDomain();
    }

    public function getApp(): AppInterface
    {
        return $this->app;
    }

}
