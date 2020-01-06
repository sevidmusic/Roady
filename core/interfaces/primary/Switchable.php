<?php

namespace DarlingCms\interfaces\primary;

interface Switchable
{

    public function getState(): bool;

    public function switchState(): bool;

}
