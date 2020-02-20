<?php

namespace DarlingCms\interfaces\component;

use DarlingCms\interfaces\primary\Positionable;

interface OutputComponent extends SwitchableComponent, Positionable
{

    public function getOutput(): string;

    public function getPosition(): float;

    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
