<?php

namespace DarlingCms\interfaces\component;

interface OutputComponent extends SwitchableComponent
{

    public function getOutput(): string;

    public function getPosition(): float;

    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
