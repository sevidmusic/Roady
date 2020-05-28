<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use DarlingCms\interfaces\component\OutputComponent;

interface OutputComponentFactory extends StoredComponentFactoryInterface
{

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponent;
}
