<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate;

interface StandardUITemplateFactory extends StoredComponentFactoryInterface
{

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponent ...$types
    ): StandardUITemplate;
}
