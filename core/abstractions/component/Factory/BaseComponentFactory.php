<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\abstractions\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Factory\BaseComponentFactory as BaseComponentFactoryInterface;
use DarlingCms\interfaces\component\Web\App;

abstract class BaseComponentFactory extends PrimaryFactory implements BaseComponentFactoryInterface
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

}
