<?php

namespace roady\interfaces\component;

use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;

interface OutputComponent extends SwitchableComponentInterface, PositionableInterface
{

    public function getOutput(): string;

    public function getPosition(): float;

    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
