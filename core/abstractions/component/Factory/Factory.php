<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Component;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\interfaces\component\Factory\Factory as FactoryInterface;
use DarlingDataManagementSystem\interfaces\component\Web\App;

abstract class Factory extends Component implements FactoryInterface
{

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $storable = new CoreStorable(
            'Factory',
            $app->getLocation(),
            self::CONTAINER
        );
        parent::__construct($storable);
    }

}
