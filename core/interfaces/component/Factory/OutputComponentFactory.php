<?php

namespace roady\interfaces\component\Factory;

use roady\interfaces\component\Factory\StoredComponentFactory as StoredComponentFactoryInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;

interface OutputComponentFactory extends StoredComponentFactoryInterface
{

    public function buildOutputComponent(string $name, string $container, string $output, float $position): OutputComponentInterface;

    public function buildDynamicOutputComponent(string $name, string $container, float $position, string $appDirectoryName, string $dynamicFileName): DynamicOutputComponentInterface;
}
