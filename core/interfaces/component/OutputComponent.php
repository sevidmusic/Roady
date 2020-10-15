<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;

interface OutputComponent extends SwitchableComponentInterface, PositionableInterface
{

    public function getOutput(): string;

    public function getPosition(): float;

    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
