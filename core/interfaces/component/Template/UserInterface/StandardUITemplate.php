<?php

namespace DarlingDataManagementSystem\interfaces\component\Template\UserInterface;

use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\primary\Positionable;

interface StandardUITemplate extends SwitchableComponent, Positionable
{
    public function addType(OutputComponent $outputComponent): void;

    public function removeType(string $type): void;

    public function getTypes(): array;
}
