<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;

interface OutputComponentFactory extends StoredComponentFactoryInterface
{

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponent;
}
