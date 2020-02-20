<?php

namespace DarlingCms\interfaces\primary;

interface Positionable
{
    public function increasePosition(): bool;

    public function decreasePosition(): bool;

}
