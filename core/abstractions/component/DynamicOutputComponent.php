<?php

namespace DarlingDataManagementSystem\abstractions\component;

use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\abstractions\component\OutputComponent as OutputCompoenentBase;
use DarlingDataManagementSystem\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;

abstract class DynamicOutputComponent extends OutputCompoenentBase implements DynamicOutputComponentInterface
{

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

}
