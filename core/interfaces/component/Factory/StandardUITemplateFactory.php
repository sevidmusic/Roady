<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;

interface StandardUITemplateFactory extends StoredComponentFactoryInterface
{

    public function buildStandardUITemplate(
        string $name,
        string $container,
        float $position,
        OutputComponent ...$types
    ): StandardUITemplate;
}
