<?php

namespace DarlingCms\abstractions\component\Crud;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingCms\abstractions\component\SwitchableComponent;

abstract class ComponentCrud extends SwitchableComponent implements ComponentCrudInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
