<?php

namespace roady\interfaces\primary;

interface Positionable
{
    public function increasePosition(): bool;

    public function decreasePosition(): bool;

    public function getPosition(): float;
}
