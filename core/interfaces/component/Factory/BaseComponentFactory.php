<?php

namespace DarlingCms\interfaces\component\Factory;

use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Action;

interface BaseComponentFactory extends PrimaryFactory
{

    public function buildComponent(string $name, string $container): Component;

    public function buildSwitchableComponent(string $name, string $container): SwitchableComponent;

    public function buildOutputComponent(string $name, string $container, string $output, float $initialPosition): OutputComponent;

    public function buildAction(string $name, string $container, float $initialPosition): Action;

}
