<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\classes\primary\Storable as CoreStorable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Web\App;

abstract class StoredComponentFactory extends CoreSwitchableComponent implements StoredComponentFactoryInterface
{
    public const CONTAINER = 'FACTORIES';
    public const NAME_SUFFIX = 'StoredComponentFactory';

    private $app;

    public function __construct(App $app, Switchable $switchable)
    {
        $this->app = $app;
        $storable = new CoreStorable(
            $this->app->getName() . self::NAME_SUFFIX,
            $this->app->getLocation(),
            self::CONTAINER
        ); // @todo ! replace with primaryFatory->buildStorable()
        parent::__construct($storable, $switchable);
    }


}
