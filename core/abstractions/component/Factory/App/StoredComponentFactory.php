<?php

namespace DarlingCms\abstractions\component\Factory\App;

use DarlingCms\abstractions\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Factory\App\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
abstract class StoredComponentFactory extends CoreSwitchableComponent implements StoredComponentFactoryInterface
{

    private $primaryFactory;

    public function __construct(PrimaryFactory $primaryFactory, ComponentCrud $componentCrud)
    {
        $this->primaryFactory = $primaryFactory;
        $storable = $this->primaryFactory->buildStorable('StoredComponentFactory', $this->primaryFactory::CONTAINER);
        parent::__construct($storable, $componentCrud);
    }

    public function getComponentCrud(): ComponentCrud
    {
        return $this->export()['switchable'];
    }

}
