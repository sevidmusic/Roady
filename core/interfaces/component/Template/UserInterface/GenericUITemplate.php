<?php

namespace DarlingCms\interfaces\component\Template\UserInterface;

use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\primary\Positionable;

interface GenericUITemplate extends SwitchableComponent, Positionable
{
    public function addType(OutputComponent $outputComponent): void;

    public function removeType(string $type): void;

    public function getTypes(): array;
}
