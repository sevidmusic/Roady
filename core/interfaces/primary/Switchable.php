<?php

namespace DarlingDataManagementSystem\interfaces\primary;

interface Switchable
{

    public function getState(): bool;

    public function switchState(): bool;

}
