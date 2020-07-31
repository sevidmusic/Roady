<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\primary\Positionable;

interface OutputComponent extends SwitchableComponent, Positionable
{

    public function getOutput(): string;

    public function getPosition(): float;

    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
