<?php

namespace DarlingDataManagementSystem\interfaces\component\Factory;

use DarlingDataManagementSystem\interfaces\component\Action;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;

interface BaseComponentFactory extends PrimaryFactory
{

    public function buildComponent(string $name, string $container): Component;

    public function buildSwitchableComponent(string $name, string $container): SwitchableComponent;

    public function buildOutputComponent(string $name, string $container, string $output, float $initialPosition): OutputComponent;

    public function buildAction(string $name, string $container, float $initialPosition): Action;

}
