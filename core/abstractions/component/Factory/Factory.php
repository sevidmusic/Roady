<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Component;
use DarlingCms\interfaces\component\Factory\Factory as FactoryInterface;
use DarlingCms\interfaces\component\Web\App;
use DarlingCms\classes\primary\Storable as CoreStorable;
abstract class Factory extends Component implements FactoryInterface
{

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        $storable = new CoreStorable(
            'Factory',
            $app->getLocation(),
            $app->getContainer()
        );
        parent::__construct($storable);
    }

}
