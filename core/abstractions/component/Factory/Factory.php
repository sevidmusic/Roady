<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\abstractions\component\Component;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\interfaces\component\Factory\Factory as FactoryInterface;
use DarlingCms\interfaces\component\Web\App;

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
