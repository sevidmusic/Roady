<?php

namespace DarlingDataManagementSystem\interfaces\primary;

interface Positionable
{
    public function increasePosition(): bool;

    public function decreasePosition(): bool;

    public function getPosition(): float;
}
